<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Ranking;
use App\Models\RankingItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class RankingController extends Controller
{
    public function index(): JsonResponse
	{
		$rankings = Ranking::with(['user'])->with(['rankingItems' => function ($query) {
			$query->orderBy('rank', 'asc');
		}])->orderBy('created_at', 'desc')->orderBy('id', 'desc')->get();

		if ($rankings->isEmpty()) {
			return response()->json([], Response::HTTP_OK);
		}

		return response()->json($rankings, Response::HTTP_OK, [], JSON_UNESCAPED_UNICODE);
	}

	public function myRankings(): JsonResponse
	{
		$rankings = Ranking::where('user_id', Auth::id())->with(['user'])->with(['rankingItems' => function ($query) {
			$query->orderBy('rank', 'asc');
		}])->orderBy('created_at', 'desc')->orderBy('id', 'desc')->get();

		if ($rankings->isEmpty()) {
			return response()->json([], Response::HTTP_OK);
		}

		return response()->json($rankings, Response::HTTP_OK, [], JSON_UNESCAPED_UNICODE);
	}

	public function store(Request $request): JsonResponse
	{
		// TODO: トランザクションを貼ってRankingItemで失敗したらrollback
		$ranking = Ranking::create([
			'title' => $request->title,
			'user_id' => Auth::id()
		]);

		foreach($request->ranking_items as $index =>$rankingItem) {
			// indexは0から始まるが、ランキングは１位から始まる
			RankingItem::create([
				'ranking_id' => $ranking->id,
				'name' => $rankingItem,
				'rank' => $index+1,
			]);
		}

		return response()->json($ranking, Response::HTTP_OK, [], JSON_UNESCAPED_UNICODE);
	}
}

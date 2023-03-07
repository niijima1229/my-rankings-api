<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Ranking;
use Symfony\Component\HttpFoundation\Response;

class RankingController extends Controller
{
    public function index(): JsonResponse
	{
		$rankings = Ranking::with(['ranking_items' => function ($query) {
			$query->orderBy('rank', 'desc');
		}])->orderBy('created_at', 'desc')->orderBy('id', 'desc')->get();

		if ($rankings->isEmpty()) {
			return response()->json([], Response::HTTP_OK);
		}

		return response()->json($rankings, Response::HTTP_OK, [], JSON_UNESCAPED_UNICODE);
	}
}

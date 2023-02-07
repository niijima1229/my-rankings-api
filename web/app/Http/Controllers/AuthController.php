<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Cookie\CookieJar;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

	public function login(LoginRequest $request, CookieJar $cookie): JsonResponse
	{
		$credentials = $request->safe()->only('email', 'password');
		$token = Auth::attempt($credentials);
		if (!$token) {
			return response()->json([
				'status' => 'error',
				'message' => 'Unauthorized',
			], Response::HTTP_UNAUTHORIZED);
		}

		$user = Auth::user();
		return response()->json([
			'status' => 'success',
			'user' => $user,
			'authorization' => [
				'token' => $token,
				'type' => 'bearer',
			]
		], Response::HTTP_OK)
			->withCookie($cookie->make(
				'token',
				$token,
				config('jwt.refresh_ttl'), // minutes
				'/',
				config('app.front_url'), // domain
				$request->getScheme() === 'https', // secure
				true // httpOnly
			));;
	}

	public function register(RegisterRequest $request): JsonResponse
	{
		$user = User::create([
			'name' => $request->safe()->name,
			'email' => $request->safe()->email,
			'password' => Hash::make($request->safe()->password),
		]);

		$token = Auth::login($user);
		return response()->json([
			'status' => 'success',
			'message' => 'User created successfully',
			'user' => $user,
			'authorization' => [
				'token' => $token,
				'type' => 'bearer',
			]
		], Response::HTTP_OK);
	}

	public function logout()
	{
		Auth::logout();
		return response()->json([
			'status' => 'success',
			'message' => 'Successfully logged out',
		]);
	}

	public function refresh()
	{
		return response()->json([
			'status' => 'success',
			'user' => Auth::user(),
			'authorization' => [
				'token' => Auth::refresh(),
				'type' => 'bearer',
			]
		]);
	}
}

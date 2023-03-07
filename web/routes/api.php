<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RankingController;


Route::prefix('rankings')->controller(RankingController::class)->group(function() {
	Route::get('/', 'index');
	Route::middleware('auth')->group(function() {
		Route::get('/my-rankings', 'myRankings');
	});
});

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::middleware('auth')->controller(AuthController::class)->group(function () {
	Route::post('logout', 'logout')->name('logout');
	Route::post('refresh', 'refresh')->name('refresh');
	Route::post('is-auth', 'isAuth')->name('isAuth');
});


<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::middleware('auth:api')->controller(AuthController::class)->group(function () {
	Route::post('logout', 'logout')->name('logout');
	Route::post('refresh', 'refresh')->name('refresh');
});

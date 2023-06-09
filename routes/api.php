<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EnseignantsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::controller(UserController::class)->group(function () {
    Route::get('users', 'index');
    Route::post('user', 'store');
    Route::get('user/{id}', 'show');
    Route::put('user/{id}', 'update');
    Route::delete('user/{id}', 'destroy');
});

Route::controller(EnseignantsController::class)->group(function () {
    Route::get('enseignants', 'index');
    Route::post('enseignant', 'store');
    Route::get('enseignant/{id}', 'show');
    Route::put('enseignant/{id}', 'update');
    Route::delete('enseignant/{id}', 'destroy');
});

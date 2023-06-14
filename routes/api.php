<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EnseignantsController;
use App\Http\Controllers\FilieresController;
use App\Http\Controllers\HistoriquesController;
use App\Http\Controllers\ProgrammerController;
use App\Http\Controllers\SallesController;
use App\Http\Controllers\MatieresController;
use App\Http\Controllers\UserController;
use App\Models\Matieres;
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

Route::controller(FilieresController::class)->group(function () {
    Route::get('filieres', 'index');
    Route::post('filiere', 'store');
    Route::get('filiere/{id}', 'show');
    Route::put('filiere/{id}', 'update');
    Route::delete('filiere/{id}', 'destroy');
});

Route::controller(MatieresController::class)->group(function () {
    Route::get('matieres', 'index');
    Route::post('matiere', 'store');
    Route::get('matiere/{id}', 'show');
    Route::put('matiere/{id}', 'update');
    Route::delete('matiere/{id}', 'destroy');
});

Route::controller(SallesController::class)->group(function () {
    Route::get('salles', 'index');
    Route::post('salle', 'store');
    Route::get('salle/{id}', 'show');
    Route::put('salle/{id}', 'update');
    Route::delete('salle/{id}', 'destroy');
});

Route::controller(CoursController::class)->group(function () {
    Route::get('cours', 'index');
    Route::post('cours', 'store');
    Route::get('cours/{id}', 'show');
    Route::put('cours/{id}', 'update');
    Route::delete('cours/{id}', 'destroy');
});

Route::controller(ProgrammerController::class)->group(function () {
    Route::get('programmer', 'index');
    Route::post('programmer', 'store');
    Route::get('programmer/{id}', 'show');
    Route::put('programmer/{id}', 'update');
    Route::delete('programmer/{id}', 'destroy');
});

Route::controller(HistoriquesController::class)->group(function () {
    Route::get('historiques', 'index');
    Route::delete('historiques/{id}', 'destroy');
});

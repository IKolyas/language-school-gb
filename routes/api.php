<?php

use App\Http\Controllers\Api\UserController,
    App\Http\Controllers\Api\DictionaryController,
    App\Http\Controllers\Api\WordController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [UserController::class, 'logout']);

//    Route::post('/practice', []);
});
Route::apiResource('dictionary', DictionaryController::class);
Route::apiResource('word', WordController::class);

Route::apiResource('user', UserController::class);
Route::put('/user/{user_id}/task/{dictionary_id}', [UserController::class, 'updateTask'])->name('user_put_task');
Route::get('/user/{user_id}/task/{dictionary_id?}', [UserController::class, 'task'])->name('user_get_task');


Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

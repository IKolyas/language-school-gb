<?php

use App\Http\Controllers\Api\ArenaController;
use App\Http\Controllers\Api\UserController,
    App\Http\Controllers\Api\DictionaryController,
    App\Http\Controllers\Api\WordController;
use App\Http\Controllers\Api\StatisticsController;
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

Route::apiResource('user', UserController::class)->middleware('auth:sanctum');

Route::name('user.')->prefix('user')->group(function () {
    Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('login', [UserController::class, 'login'])->name('login');
    Route::post('register', [UserController::class, 'register']);

    Route::post('auth', function () {
        return response()->json(['success' => boolval(auth()->guard('api')->user())]);
    })->name('get_auth_user');

    Route::put('/{user_id}/task/{dictionary_id}', [UserController::class, 'updateTask'])->name('user_put_task');
    Route::get('/{user_id}/task/{dictionary_id?}', [UserController::class, 'task'])->name('user_get_task');
    Route::post('/addUserDictionary', [UserController::class, 'addUserDictionary'])->name('add_user_dictionary');
    Route::delete('/{user_id}/dictionary/{dictionary_id}', [UserController::class, 'destroyUserDictionary'])->name('destroy_user_dictionary');
});

Route::apiResource('/dictionary', DictionaryController::class);
Route::name('dictionary.')->prefix('dictionary')->group(function () {
    Route::get('/{dictionary_id}/user/{user_id}', [DictionaryController::class, 'getDictionaryWithRatings']);

    Route::delete('/{dictionary_id}/word/{word_id}', [DictionaryController::class, 'destroyDictionaryWord']);
});

Route::name('statistics')->prefix('statistics')->group(function () {
    Route::get('/{user_id}', [StatisticsController::class, 'getStatistics']);
    Route::put('/{user_id}', [StatisticsController::class, 'saveStatistics']);
});

Route::apiResource('word', WordController::class);
Route::name('word.')->prefix('word')->group(function () {
    Route::get('/all/{user_id}', [WordController::class, 'getAllUserWords']);
    Route::put('/{user_id}/updateRating', [WordController::class, 'updateRating']);
});

Route::get('/arena/create-arena', [ArenaController::class, 'createRoom'])->middleware('auth:sanctum');
Route::get('/arena/next-step', [ArenaController::class, 'nextStep'])->middleware('auth:sanctum');
Route::get('/arena/get-users', [ArenaController::class, 'getUsers'])->middleware('auth:sanctum');
Route::get('/arena/users-active', [ArenaController::class, 'userIsActive'])->middleware('auth:sanctum');








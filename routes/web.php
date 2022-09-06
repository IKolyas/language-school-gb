<?php

use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'guest', 'prefix' => 'socialite'], function () {
    Route::get('/auth/vk', [SocialiteController::class, 'init'])->name('vk.init');
    Route::get('/auth/vk/callback', [SocialiteController::class, 'callback'])->name('vk.callback');
});

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*')->name('main');

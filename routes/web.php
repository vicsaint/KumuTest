<?php

use Illuminate\Support\Facades\Route;

use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/redirect/{provider}', [App\Http\Controllers\SocialController::class, 'redirect'])->name('redirectGithub');

Route::get('/callback/{provider}', [App\Http\Controllers\SocialController::class, 'callback'])->name('callbackGithub');;

Route::post('/submit-search', [App\Http\Controllers\SearchController::class, 'processSearch'])->name('processGitHubSearch');;

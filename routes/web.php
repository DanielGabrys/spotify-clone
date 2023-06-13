<?php

use App\Http\Controllers\SpotifyController;
use App\Http\Controllers\SongController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/ballroom/',[SongController::class,'ShowSongs'])->name('ballroom');

Route::get('/',[SpotifyController::class,'authorizeSpotify'])->name('authorizeSpotify');

Route::get('/callback',[SpotifyController::class,'authorizeCallback'])->name('authorizeCallback');

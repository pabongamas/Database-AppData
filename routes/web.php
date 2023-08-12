<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/phpinfo', function() {
    return phpinfo();
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/addMovies',[App\Http\Controllers\movies::class, 'create'])->name('movies.create');
Route::post('/movie',[App\Http\Controllers\movies::class, 'store'])->name('movies.store');

Route::get('/addMoviesUser',[App\Http\Controllers\relUserMovie::class, 'create'])->name('relusermovie.create');
Route::post('/moviesUser',[App\Http\Controllers\relUserMovie::class, 'store'])->name('relusermovie.store');

Route::get('/indexApi',[App\Http\Controllers\movies::class, 'indexApi'])->name('movies.indexApi');
Route::any('/searchApi',[App\Http\Controllers\movies::class, 'searchApi'])->name('movies.searchApi');

Route::post('/loginSpotify',[App\Http\Controllers\spotifyController::class, 'loginSpotify'])->name('spotify.loginSpotify');
Route::get('/autorizadoLogin',[App\Http\Controllers\spotifyController::class, 'autorizadoLogin'])->name('spotify.autorizadoLogin');
Route::get('/spotify',[App\Http\Controllers\spotifyController::class, 'indexApi'])->name('spotify.indexApi');
Route::get('/spotifyIndex',[App\Http\Controllers\spotifyController::class, 'indexSpotify'])->name('spotify.index');
Route::get('/spotify/home',[App\Http\Livewire\HomeSpotify::class, 'render'])->name('spotify.home');
Route::get('/spotify/me',[App\Http\Controllers\spotifyController::class, 'indexMe'])->name('spotify.indexMe');
Route::get('/spotify/categorias/{idCategoria}',[App\Http\Controllers\spotifyController::class, 'getCategoriasById'])->name('spotify.categoriasbyId');
Route::get('/spotify/playlist/{idplaylist}',[App\Http\Controllers\spotifyController::class, 'TracksByGenero'])->name('spotify.TracksByGenero');
Route::get('/spotify/album/{idalbum}',[App\Http\Controllers\spotifyController::class, 'albumByID'])->name('spotify.albumByID');
Route::get('/spotify/artists/{idartist}',[App\Http\Controllers\spotifyController::class, 'artistByID'])->name('spotify.artistByID');
Route::get('/spotify/user/{iduser}',[App\Http\Controllers\spotifyController::class, 'userByID'])->name('spotify.userByID');

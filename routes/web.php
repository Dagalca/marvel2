<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarvelController;
use App\Http\Controllers\FavoriteController;

Route::get('/', function () {
    return redirect()->route('marvel.home');
});

Route::get('/marvel', [MarvelController::class, 'index'])->name('marvel.home');

// Rutas para Personajes
Route::get('/characters', [MarvelController::class, 'characters'])->name('characters.index');
Route::get('/characters/{id}', [MarvelController::class, 'showCharacter'])->name('characters.show');
Route::get('/characters/search', [MarvelController::class, 'searchCharacters'])->name('characters.search');
// Rutas para Cómics
Route::get('/comics', [MarvelController::class, 'comics'])->name('comics.index');
Route::get('/comics/{id}', [MarvelController::class, 'showComic'])->name('comics.show');

// Rutas para Series
Route::get('/series', [MarvelController::class, 'series'])->name('series.index');
Route::get('/series/{id}', [MarvelController::class, 'showSeries'])->name('series.show');

// Rutas para Historias
Route::get('/stories', [MarvelController::class, 'stories'])->name('stories.index');
Route::get('/stories/{id}', [MarvelController::class, 'showStory'])->name('stories.show');

// Rutas para Creadores
Route::get('/creators', [MarvelController::class, 'creators'])->name('creators.index');
Route::get('/creators/{id}', [MarvelController::class, 'showCreator'])->name('creators.show');

// Ruta para mostrar la página de favoritos
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index')->middleware('auth');

// Ruta para añadir un ítem a favoritos
Route::post('/favorites/add', [FavoriteController::class, 'add'])->name('favorites.add')->middleware('auth');

// Ruta para eliminar un ítem de favoritos
Route::delete('/favorites/remove/{id}', [FavoriteController::class, 'remove'])->name('favorites.remove')->middleware('auth');


Auth::routes();



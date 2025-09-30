<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Redirecionar dashboard para films
Route::get('/dashboard', function () {
    return redirect()->route('films.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rotas para filmes (página principal após login)
    Route::resource('films', FilmController::class);
    Route::patch('/films/{film}/toggle-watched', [FilmController::class, 'toggleWatched'])->name('films.toggle-watched');
});

require __DIR__.'/auth.php';

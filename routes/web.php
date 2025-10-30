<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

// Home
Route::get('/', [EventController::class, 'index']);

// Rotas protegidas (usuário logado)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store']);
    Route::get('/dashboard', [EventController::class, 'dashboard'])->name('dashboard');
});

// Detalhes de um evento (não precisa estar logado)
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

// Contato
Route::get('/contact', function () {
    return view('contact');
});

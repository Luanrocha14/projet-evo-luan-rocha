<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::get('/dashboard', [EventController::class, 'dashboard'])->name('dashboard');

    // Participar e sair de eventos
    Route::post('/events/join/{id}', [EventController::class, 'joinEvent'])->name('events.join');
    Route::delete('/events/leave/{id}', [EventController::class, 'leaveEvent'])->name('events.leave');
});

// Mostrar detalhes de evento sem precisar estar logado
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

Route::get('/contact', function () {
    return view('contact');
});

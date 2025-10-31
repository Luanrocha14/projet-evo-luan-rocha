<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, 'index']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::get('/dashboard', [EventController::class, 'dashboard'])->name('dashboard');
    Route::put('/events/update/{id}', [EventController::class, 'update'])->name('events.update.alt');
});

Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/events/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');


<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketMessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->controller(TicketController::class)
    ->group(function () {
    Route::get('/tickets', 'index')->name('tickets.index');
    Route::get('/tickets/create', 'create')->name('tickets.create');
    Route::post('/tickets', 'store')->name('tickets.store');
    Route::get('/tickets/{ticket}', 'show')->name('tickets.show');
    Route::get('/tickets/{ticket}/edit', 'edit')->name('tickets.edit');
    Route::put('/tickets/{ticket}', 'update')->name('tickets.update');
    Route::delete('/tickets/{ticket}', 'destroy')->name('tickets.destroy');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::post('/tickets/{ticket}/message', [TicketMessageController::class, 'store'])->name('tickets.message');
    Route::delete('/tickets/{ticketMessage}', [TicketMessageController::class, 'destroy'])->name('tickets.message.destroy');
});

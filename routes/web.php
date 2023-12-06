<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketResponseController;
use App\Http\Controllers\TicketsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', 'block.banned', 'approved'])->group(function () {
    Route::get('/tickets', [TicketsController::class, 'index'])->name('dashboard');
    Route::get('/tickets/create', [TicketsController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketsController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [TicketsController::class, 'show'])->name('tickets.show');
    Route::get('/tickets/{ticket}/edit', [TicketsController::class, 'edit'])->name('tickets.edit');
    Route::patch('/tickets/{ticket}', [TicketsController::class, 'update'])->name('tickets.update');
    Route::post('/tickets/{ticket}/response', [TicketResponseController::class, 'store'])->name('tickets.response.store');
    Route::get('/response/{ticketResponse}/edit', [TicketResponseController::class, 'edit'])->name('response.edit');
    Route::patch('/response/{ticketResponse}', [TicketResponseController::class, 'update'])->name('response.update');
});

Route::middleware(['auth', 'block.banned', 'approved'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/admin.php';
require __DIR__.'/auth.php';

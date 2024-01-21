<?php

use App\Http\Controllers\GroupsController;
use App\Http\Controllers\GroupTicketsController;
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
    Route::get('/tickets', [TicketsController::class, 'indexCreated'])->name('tickets.index.created');
    Route::get('/tickets/assigned', [TicketsController::class, 'indexAssigned'])->middleware(['teacher'])->name('tickets.index.assigned');
    Route::get('/tickets/create', [TicketsController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketsController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [TicketsController::class, 'show'])->name('tickets.show');
    Route::get('/tickets/{ticket}/edit', [TicketsController::class, 'edit'])->name('tickets.edit');
    Route::patch('/tickets/{ticket}', [TicketsController::class, 'updateBasicInfo'])->name('tickets.update');
    Route::patch('/tickets/{ticket}/advanced', [TicketsController::class, 'updateAdvancedInfo'])->name('tickets.update.advanced');
    Route::patch('/tickets/{ticket}/assign', [TicketsController::class, 'assignTicketToUser'])->name('tickets.update.assign');
    Route::delete('/tickets/{ticket}', [TicketsController::class, 'destroy'])->name('tickets.delete');
    Route::post('/tickets/{ticket}/response', [TicketResponseController::class, 'store'])->name('tickets.response.store');
    Route::get('/response/{ticketResponse}/edit', [TicketResponseController::class, 'edit'])->name('response.edit');
    Route::patch('/response/{ticketResponse}', [TicketResponseController::class, 'update'])->name('response.update');
    Route::post('/tickets/{ticket}/group', [GroupTicketsController::class, 'store'])->name('ticket.group.store');
});

Route::middleware(['auth', 'verified', 'block.banned', 'approved'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'block.banned', 'approved', 'teacher'])->group(function () {
    Route::get('/groups', [GroupsController::class, 'index'])->name('groups.index');
    Route::get('/groups/create', [GroupsController::class, 'create'])->name('groups.create');
    Route::post('/groups', [GroupsController::class, 'store'])->name('groups.store');
    Route::get('/groups/{group}', [GroupsController::class, 'show'])->name('groups.show');
    Route::get('/groups/{group}/edit', [GroupsController::class, 'edit'])->name('groups.edit');
    Route::patch('/groups/{group}', [GroupsController::class, 'update'])->name('groups.update');
    Route::delete('/groups/{group}', [GroupsController::class, 'destroy'])->name('groups.delete');
});

Route::middleware(['auth', 'verified', 'block.banned', 'approved', 'teacher'])->group(function () {
    Route::post('/groups/{group}/response', [GroupTicketsController::class, 'sendResponse'])->name('groups.send.response');
    Route::delete('/groups/{group}/close', [GroupTicketsController::class, 'closeTickets'])->name('groups.close.tickets');
    Route::delete('/groups/{group}/ticket/{ticket}/remove', [GroupTicketsController::class, 'destroy'])->name('groups.remove.ticket');
});


require __DIR__.'/admin.php';
require __DIR__.'/auth.php';

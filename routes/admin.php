<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminTicketsController;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.index');
    Route::get('/admin/tickets', [AdminTicketsController::class, 'index'])->name('admin.tickets.index');
    Route::get('/admin/tickets/{id}', [AdminTicketsController::class, 'show'])->name('admin.tickets.show');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [ManageUsersController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [ManageUsersController::class, 'create'])->name('admin.users.create');
    Route::get('/admin/users/{id}', [ManageUsersController::class, 'show'])->name('admin.users.show');
    Route::post('/admin/users', [ManageUsersController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [ManageUsersController::class, 'edit'])->name('admin.users.edit');
    Route::patch('/admin/users/{id}', [ManageUsersController::class, 'update'])->name('admin.users.update');
});

<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminTicketsController;
use App\Http\Controllers\Admin\ApproveUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Admin\UserBanController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.index');
    Route::get('/admin/tickets', [AdminTicketsController::class, 'index'])->name('admin.tickets.index');
    Route::get('/admin/tickets/{id}', [AdminTicketsController::class, 'show'])->name('admin.tickets.show');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [ManageUsersController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [ManageUsersController::class, 'create'])->name('admin.users.create');
    Route::get('/admin/users/{user}', [ManageUsersController::class, 'show'])->name('admin.users.show');
    Route::post('/admin/users', [ManageUsersController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [ManageUsersController::class, 'edit'])->name('admin.users.edit');
    Route::patch('/admin/users/{user}', [ManageUsersController::class, 'update'])->name('admin.users.update');
    Route::patch('/admin/users/{user}/ban', [UserBanController::class, 'ban'])->name('admin.users.ban');
    Route::patch('/admin/users/{user}/unban', [UserBanController::class, 'unban'])->name('admin.users.unban');
    Route::patch('/admin/users/{user}/approve', [ApproveUserController::class, 'update'])->name('admin.users.approve');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::patch('/admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/classrooms', [ClassroomController::class, 'index'])->name('admin.classrooms.index');
    Route::get('/admin/classrooms/create', [ClassroomController::class, 'create'])->name('admin.classrooms.create');
    Route::post('/admin/classrooms', [ClassroomController::class, 'store'])->name('admin.classrooms.store');
    Route::get('/admin/classrooms/{classroom}/edit', [ClassroomController::class, 'edit'])->name('admin.classrooms.edit');
    Route::patch('/admin/classrooms/{classroom}', [ClassroomController::class, 'update'])->name('admin.classrooms.update');
});

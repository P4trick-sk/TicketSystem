<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminTicketsController;
use App\Http\Controllers\Admin\ApproveUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryTypeController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\UpdateClassroomManagersController;
use App\Http\Controllers\Admin\UserBanController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {
    /*Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.index');*/
    Route::get('/admin', function () {
        return to_route('admin.tickets.index');
    })->name('admin.index');
    Route::get('/admin/tickets', [AdminTicketsController::class, 'index'])->name('admin.tickets.index');
    Route::get('/admin/tickets/closed', [AdminTicketsController::class, 'indexClosed'])->name('admin.tickets.index.closed');
    Route::get('/admin/tickets/{id}', [AdminTicketsController::class, 'show'])->name('admin.tickets.show');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [ManageUsersController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/deleted', [ManageUsersController::class, 'indexDeleted'])->name('admin.users.deleted.index');
    Route::get('/admin/users/create', [ManageUsersController::class, 'create'])->name('admin.users.create');
    Route::get('/admin/users/{user}', [ManageUsersController::class, 'show'])->name('admin.users.show');
    Route::get('/admin/users/deleted/{id}', [ManageUsersController::class, 'showDeleted'])->name('admin.users.deleted.show');
    Route::post('/admin/users', [ManageUsersController::class, 'store'])->name('admin.users.store');
    Route::delete('/admin/users/{user}', [ManageUsersController::class, 'destroy'])->name('admin.users.delete');
    Route::get('/admin/users/{user}/edit', [ManageUsersController::class, 'edit'])->name('admin.users.edit');
    Route::patch('/admin/users/{user}', [ManageUsersController::class, 'update'])->name('admin.users.update');
    Route::patch('/admin/users/{id}/undelete', [ManageUsersController::class, 'undelete'])->name('admin.users.undelete');
    Route::patch('/admin/users/{user}/ban', [UserBanController::class, 'ban'])->name('admin.users.ban');
    Route::patch('/admin/users/{user}/unban', [UserBanController::class, 'unban'])->name('admin.users.unban');
    Route::patch('/admin/users/{user}/approve', [ApproveUserController::class, 'update'])->name('admin.users.approve');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/category-types', [CategoryTypeController::class, 'index'])->name('admin.category.types.index');
    Route::get('/admin/category-types/create', [CategoryTypeController::class, 'create'])->name('admin.category.types.create');
    Route::post('/admin/category-types', [CategoryTypeController::class, 'store'])->name('admin.category.types.store');
    Route::delete('/admin/category-types/{categoryType}', [CategoryTypeController::class, 'destroy'])->name('admin.category.types.delete');
    Route::get('/admin/category-types/{categoryType}/edit', [CategoryTypeController::class, 'edit'])->name('admin.category.types.edit');
    Route::patch('/admin/category-types/{categoryType}', [CategoryTypeController::class, 'update'])->name('admin.category.types.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
    Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::patch('/admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/classrooms', [ClassroomController::class, 'index'])->name('admin.classrooms.index');
    Route::get('/admin/classrooms/create', [ClassroomController::class, 'create'])->name('admin.classrooms.create');
    Route::post('/admin/classrooms', [ClassroomController::class, 'store'])->name('admin.classrooms.store');
    Route::delete('/admin/classrooms/{classroom}', [ClassroomController::class, 'destroy'])->name('admin.classrooms.delete');
    Route::get('/admin/classrooms/{classroom}/edit', [ClassroomController::class, 'edit'])->name('admin.classrooms.edit');
    Route::patch('/admin/classrooms/{classroom}', [ClassroomController::class, 'update'])->name('admin.classrooms.update');
    Route::patch('/admin/classrooms/{classroom}/managers', UpdateClassroomManagersController::class)->name('admin.classrooms.update.managers');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/settings', [SiteSettingController::class, 'index'])->name('admin.settings.index');
    Route::patch('/admin/settings/school-info', [SiteSettingController::class, 'updateSchoolInfo'])->name('admin.settings.update.school-info');
    Route::patch('/admin/settings/google-oauth', [SiteSettingController::class, 'updateGoogleOauth'])->name('admin.settings.update.google-oauth');
    Route::patch('/admin/settings/enable-register', [SiteSettingController::class, 'updateEnableRegister'])->name('admin.settings.update.enable-register');
    Route::patch('/admin/settings/word-filter', [SiteSettingController::class, 'updateWordFilter'])->name('admin.settings.update.word-filter');
});

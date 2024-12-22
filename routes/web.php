<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BurgerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(AdminMiddleware::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::controller(CategoryController::class)->prefix('categories')->name('categories.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::patch('/{id}/edit', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    Route::controller(BurgerController::class)->prefix('burgers')->name('burgers.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/{slug}/edit', 'edit')->name('edit');
        Route::patch('/{slug}/edit', 'update')->name('update');
        Route::delete('/{slug}', 'destroy')->name('destroy');
        Route::get('/{slug}', 'show')->name('show');
    });
});

Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.showLogin');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::get('/{slug}', [BurgerController::class, 'showUser'])->name('show');

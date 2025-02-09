<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;

Route::controller(AuthController::class)->prefix('auth')->name('auth.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/logout', 'logout')->name('logout');
    Route::post('/login', 'login')->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::controller(DashboardController::class)->name('dashboard.')->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::controller(GroupController::class)->prefix('group')->name('group.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/new', 'new')->name('new');
        Route::get('/{id}', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        Route::put('/', 'update')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });
});

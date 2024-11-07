<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfilController;

Route::get('/', function () {
    return view('auth.auth-login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.dashboard', ['type_menu' => 'home']);
    })->name('home');

    Route::get('user/profil/{id}', [ProfilController::class, 'profil'])->name('user.profil');
    Route::put('user/updateProfile/{id}', [ProfilController::class, 'updateProfile'])->name('user.updateProfile');

    // Route akses umum untuk semua role
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');

    // Route khusus untuk role admin
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('user', UserController::class);

        Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
        Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');
        Route::post('/product/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });

    // Route tambahan khusus untuk role staff
    Route::middleware(['role:staff'])->group(function () {
        Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');
        Route::post('/product/edit', [ProductController::class, 'edit'])->name('product.edit');
    });
});

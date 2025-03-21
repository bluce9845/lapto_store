<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',
    [ProductController::class, 'dashboard']
    )->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/product/form', [ProductController::class, 'formAd'])->name('form.product');
    Route::post('/product/post', [ProductController::class, 'store'])->name('store.product');
    Route::get('/product/{id}/detail', [ProductController::class, 'detailProduct'])->name('detail.product');
    Route::post('/order/{id}/process', [TransactionController::class, 'transactionProcess'])->name('order.process');
    Route::get('/order/{id}/success', [TransactionController::class, 'success'])->name('order.success');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
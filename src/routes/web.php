<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Models\Category;

Route::get('/transactions',[TransactionController::class,'index'])->name('transaction.index');
Route::post('/transactions', [TransactionController::class, 'store'])->name('transaction.store');
Route::patch('/transactions/{transaction}', [TransactionController::class, 'update'])->name('transaction.update');
Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transaction.delete');

Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
Route::patch('/categories/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('category.delete');



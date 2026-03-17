<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;

Route::get('/',[TransactionController::class,('index')])->name('index');



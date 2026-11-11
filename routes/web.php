<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/customers');

// Customer list with filters (?gender=Male|Female, ?birthday=after2000) and pagination (?page=2)
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');

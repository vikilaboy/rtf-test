<?php

use App\Http\Controllers\v1\CustomerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('customers', [CustomerController::class, 'index'])->name('customers.list');
Route::get('customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
Route::post('customers', [CustomerController::class, 'store'])->name('customers.store');
Route::match(['put', 'patch'], 'customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

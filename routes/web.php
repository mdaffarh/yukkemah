<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/register', function () {
    return view('login.register');
})->middleware('guest');

Route::get('/login', function () {
    return view('login.login');
})->name('login')->middleware('guest');

Route::post('/register', [LoginController::class, 'register']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// dashboard
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');
Route::resource('/dashboard/equipments', EquipmentController::class)->middleware('auth');
Route::resource('/dashboard/brands', BrandController::class)->middleware('admin');
Route::resource('/dashboard/categories', CategoryController::class)->middleware('admin');
Route::resource('/dashboard/users', UserController::class)->middleware('admin');
Route::resource('/dashboard/rentals', RentalController::class)->middleware('admin');
Route::resource('/dashboard/payments', PaymentController::class)->middleware('admin');

Route::get('/dashboard/rentals/confirmation/{id}', [RentalController::class, 'showConfirmation'])->name('rental-confirmation')->middleware('admin');
Route::get('/dashboard/rentals/detail/{id}', [RentalController::class, 'showConfirmation'])->name('rental-detail')->middleware('admin');

Route::get('/dashboard/rentals/cancel/{id}', [RentalController::class, 'cancel'])->name('rental-cancel')->middleware('admin');
Route::get('/dashboard/rentals/confirm/{id}', [RentalController::class, 'confirm'])->name('rental-confirm')->middleware('admin');
Route::get('/dashboard/rentals/handover/{id}', [RentalController::class, 'handover'])->name('rental-handover')->middleware('admin');
Route::get('/dashboard/rentals/return/{id}', [RentalController::class, 'return'])->name('rental-return')->middleware('admin');

Route::get('/dashboard/rental-log', [RentalController::class, 'rentalLog'])->middleware('admin');

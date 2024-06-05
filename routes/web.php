<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EquipmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::resource('/dashboard/equipments', EquipmentController::class);
Route::resource('/dashboard/brands', BrandController::class);
Route::resource('/dashboard/categories', CategoryController::class);

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

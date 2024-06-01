<?php

use App\Http\Controllers\EquipmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::resource('/dashboard/equipments', EquipmentController::class);

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

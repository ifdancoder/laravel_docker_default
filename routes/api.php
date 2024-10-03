<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EquipmentTypeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(EquipmentController::class)->group(function(){
    Route::get('/equipment', 'index');
    Route::get('/equipment/{id}', 'show');
    Route::post('/equipment', 'store');
    Route::put('/equipment/{id}', 'update');
    Route::delete('/equipment/{id}', 'destroy');
});

Route::controller(EquipmentTypeController::class)->group(function(){
    Route::get('/equipment-type', 'index');
    Route::post('/equipment-type', 'store');
    Route::delete('/equipment-type/{id}', 'destroy');
});
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\GeofenceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/locations', [LocationController::class, 'store']);
Route::get('/locations/nearby', [LocationController::class, 'nearby']);
Route::get('/locations/in-geofence', [LocationController::class, 'checkInGeofence']);

Route::post('/geofences', [GeofenceController::class, 'store']);
Route::get('/geofences/{geofence}/locations', [GeofenceController::class, 'getLocationsInGeofence']);


Route::get('/hello', [TestController::class, 'test']);


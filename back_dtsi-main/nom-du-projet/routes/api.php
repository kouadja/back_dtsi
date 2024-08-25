<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\MaintenanceController;

Route::apiResource('maintenances', MaintenanceController::class); // avec patch
Route::apiResource('providers', ProviderController::class); 
Route::apiResource('sites', SiteController::class);

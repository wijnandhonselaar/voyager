<?php

use App\Http\Controllers\VesselController;
use App\Http\Controllers\VoyageController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'voyages'], function () {
    Route::post('/', [VoyageController::class, 'create']);
    Route::out('/{voyage-id}', [VoyageController::class, 'update']);
});

Route::group(['prefix' => 'vessels'], function () {
    Route::post('/{vessel-id}/vessel-opex', [VesselController::class, 'createOpex']);
    Route::get('/{vessel-id}/financial-report', [VesselController::class, 'generateFinancialReport']);
});

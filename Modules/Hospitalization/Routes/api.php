<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Hospitalization\Entities\Room;
use Modules\Hospitalization\Http\Controllers\Api\V1\BedController;
use Modules\Hospitalization\Http\Controllers\Api\V1\RoomController;
use Modules\Hospitalization\Http\Controllers\Api\V1\BedPatientController;

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

Route::group(['prefix' => 'api'], function () { //CL - Pour garder le même prefixe que les autres routes
    $apiVersion = 'v' . config('premier.api_version');
    Route::group(['prefix' => $apiVersion], function () {  //CL - Pour garder le même prefixe que les autres routes

        Route::apiResource('beds', BedController::class);
        Route::apiResource('rooms', RoomController::class);
        Route::apiResource('bed_patients', BedPatientController::class);

        //rooms
        Route::get('/room/{uuid}/free-beds', [RoomController::class, 'getFreeBeds']);
        Route::get('/count-hospitalized-patients', [BedController::class, 'countCurrentlyHospitalizedPatients']);

        Route::group(['middleware' => ['auth:api']], function () {
        });
    });
});

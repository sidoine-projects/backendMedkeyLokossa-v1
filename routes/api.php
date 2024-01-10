<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Modules\Acl\Http\Controllers\Api\V1\AuthController;
use Modules\Acl\Http\Controllers\Api\V1\UserController;


// $apiVersion = 'v' . config('premier.api_version');
// Route::group(['prefix' => $apiVersion], function () {  //CL - Pour garder le même prefixe que les autres routes
//     require_once("premier/passport.php");

//         Route::post('login', [AuthController::class, 'login']);
//         Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgot_password');
//         Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('auth.password_reset');

//         Route::get('email-confirmation/{uuid}', [AuthController::class, 'emailConfirmation'])->name('auth.email_confirmation');
   
// });
// Route::group(['prefix' => 'api'], function () { //CL - Pour garder le même prefixe que les autres routes
    $apiVersion = 'v' . config('premier.api_version');
    Route::group(['prefix' => $apiVersion], function () {  //CL - Pour garder le même prefixe que les autres routes
        Route::get('user_current', [AuthController::class, 'user'])->name('auth.user');
        // Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgot_password');
        // Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('auth.password_reset');
        Route::get('email-confirmation/{uuid}', [AuthController::class, 'emailConfirmation'])->name('auth.email_confirmation');
        Route::post('reset-password', [AuthController::class, 'reset']);
        Route::post('request-password', [AuthController::class, 'requestPassword']);
     
        // Route::apiResource('users', UserController::class); //create and edit sont exclus
        Route::group(['middleware' => ['auth:api']], function () {
            Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
            
            //D'ici vers le haut ne change pas
            //************************Begin : Module Annuaire**********************************
            //************************End : Module Annuaire**********************************
            //D'ici vers le bas ne change pas
        });
    });
// });

//Forcer le HTTPS
if (app()->environment() == "production") {
    URL::forceScheme('https');
}
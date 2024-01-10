<?php


use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Modules\Patient\Entities\Patiente;

use Modules\Movment\Http\Controllers\MovmentController;
use Modules\Movment\Http\Controllers\AntecedentController;
use Modules\Movment\Http\Controllers\AllergieController;
use Modules\Movment\Http\Controllers\LivestyleController;
use Modules\Movment\Http\Controllers\MeasurementController;
use Modules\Movment\Http\Controllers\ReportController;

/*header('Access-Control-Allow-Headers: Origin, Content-Type');
header('Content-Type': 'application/json');*/

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

$apiVersion = 'v' . config('premier.api_version');
Route::group(['prefix' => $apiVersion], function () {

 Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/movments/patients', function (Request $request) {
        return response()->json([
            'success' => true,
            'data' => Patiente::all(),
            'message' => 'Liste des patients.'
        ]);
    });

    Route::apiResource('movments', MovmentController::class);

    Route::get('get-all/movments', [MovmentController::class, 'getAll']);
    Route::get('consultation/movments', [MovmentController::class, 'getConsultationMovments']);


    Route::get('movments/services/{service_id}', [MovmentController::class, 'getMovmentsByService']);
    Route::get('movments/actes/{movment_id}', [MovmentController::class,'getMovmentActes']);
    Route::get('movments/products/{movment_id}', [MovmentController::class,'getMovmentProducts']);
    Route::get('movments/check-getout', [MovmentController::class,'checkGetout']);

    Route::post('movments/actes/store', [MovmentController::class,'storeActe']);
    Route::post('movments/products/store', [MovmentController::class,'storeProduct']);
    Route::post('movments/actes/delete', [MovmentController::class,'deleteActe']);


    Route::apiResource('measurements', MeasurementController::class);
    Route::post('measurements/delete', [MeasurementController::class,'destroy']);

    Route::apiResource('livestyles', LivestyleController::class);
    Route::post('livestyles/delete', [LivestyleController::class,'destroy']);

    Route::apiResource('allergies', AllergieController::class);
    Route::post('allergies/delete', [AllergieController::class,'destroy']);

    Route::apiResource('antecedents', AntecedentController::class);
    Route::post('antecedents/delete', [AntecedentController::class,'destroy']);

    Route::post('movments/updateOut', [MovmentController::class,'updateOut']);
    Route::get('movments/all', [MovmentController::class, 'getAll']);

    /*Recordes ***/
    Route::get('get-records', [MovmentController::class,'getRecord']);
    Route::post('switch-services', [MovmentController::class,'switchServices']);

    Route::post('movments/records/consultation', [MovmentController::class,'recordConsultation']);

    Route::get('report/patients/statics', [ReportController::class,'getPatientSats']);
    Route::get('report/services/statics', [ReportController::class,'getServicesSats']);

    Route::get('patients/medicals/records/{patient_uuid}', [MovmentController::class,'getPatientMedicalsRecords']);

});

});

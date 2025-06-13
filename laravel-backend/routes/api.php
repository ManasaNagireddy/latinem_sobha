<?php 
// routes/api.php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\DivisionController;
use App\Http\Controllers\Api\AcitivityController;
use App\Http\Controllers\Api\SubActivityController;
use App\Http\Controllers\Api\SubDivisionController;
use App\Http\Controllers\Api\TowerController;
use App\Http\Controllers\Api\CapaRequestController;
use App\Http\Controllers\Api\DashboardController;

//Route::resources
Route::apiResource('projects', ProjectController::class);
Route::apiResource('divisions', DivisionController::class);
Route::apiResource('activities', AcitivityController::class);
Route::apiResource('subactivities', SubActivityController::class);
Route::apiResource('subdivisions', SubDivisionController::class);
Route::apiResource('towers', TowerController::class);
Route::get('/caparequests', [CapaRequestController::class,'index']);
Route::post('/caparequestsdate',[CapaRequestController::class,'capaRequestDates']);
Route::get('/donutchart',[DashboardController::class,'DonutChart']);

/*Route::middleware('auth:sanctum')->group(function () {  

    // Protected user CRUD endpoints
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

//});
//Route::post('/login', [AuthController::class, 'login']);
*/
Route::post('/register', [AuthController::class, 'register']);

?>
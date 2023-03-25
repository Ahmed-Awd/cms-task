<?php

use App\Http\Controllers\API\AttributeController;
use App\Http\Controllers\API\EntityController;
use App\Http\Controllers\API\OperatorController;
use App\Http\Controllers\API\RecordController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::group(['middleware' => ['role:admin']], function () {
        Route::apiResource("operators", OperatorController::class);
        Route::apiResource("entities", EntityController::class);
        Route::post("entities/{type}/attribute/{entity}",[EntityController::class,'assignOrRemoveAttribute']);
        Route::apiResource("attributes", AttributeController::class);
    });

    Route::group(['middleware' => ['role:admin|operator']], function () {
        Route::apiResource("records", RecordController::class)->only("delete","show");
        Route::post("records/{entity}",[RecordController::class,'store']);
        Route::put("records/{entity}/{record}",[RecordController::class,'update']);
        Route::get("records/index/{entity}",[RecordController::class,'index']);
    });
});

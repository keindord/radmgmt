<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\NasController;
use App\Http\Controllers\API\RadacctController;
use App\Http\Controllers\API\RadcheckController;
use App\Http\Controllers\API\RadgroupcheckController;
use App\Http\Controllers\API\RadgroupreplyController;
use App\Http\Controllers\API\RadpostauthController;
use App\Http\Controllers\API\RadreplyController;
use App\Http\Controllers\API\RadusergroupController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('nas', NasController::class);
Route::apiResource('radacct', RadacctController::class);
Route::apiResource('radcheck', RadcheckController::class);
Route::apiResource('radgroupcheck', RadgroupcheckController::class);
Route::apiResource('radgroupreply', RadgroupreplyController::class);
Route::apiResource('radpostauth', RadpostauthController::class);
Route::apiResource('radreply', RadreplyController::class);
Route::apiResource('radusergroup', RadusergroupController::class);

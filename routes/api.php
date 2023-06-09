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
use App\Http\Controllers\API\NasreloadController;
use App\Http\Controllers\API\DataUsageByPeriodController;
use App\Http\Controllers\API\UserSessionController;
use App\Http\Controllers\API\UserDuplicateActiveSessionController;
use App\Http\Controllers\API\UserCredentialController;
use App\Http\Controllers\API\UserActiveCredentialController;
use App\Http\Controllers\API\UserInactiveCredentialController;
use App\Http\Controllers\AuthController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Operacion en Base de Datos

Route::middleware('auth:sanctum')->group( function () {
  Route::apiResource('nas', NasController::class);
  Route::apiResource('radacct', RadacctController::class);
  Route::apiResource('radcheck', RadcheckController::class);
  Route::apiResource('radgroupcheck', RadgroupcheckController::class);
  Route::apiResource('radgroupreply', RadgroupreplyController::class);
  Route::apiResource('radpostauth', RadpostauthController::class);
  Route::apiResource('radreply', RadreplyController::class);
  Route::apiResource('radusergroup', RadusergroupController::class);
  Route::apiResource('nasreload', NasreloadController::class);
  Route::apiResource('datausagebyperiod', DataUsageByPeriodController::class);
});


// Consultas Exclusivas a Base de Datos
  Route::apiResource('usersession', UserSessionController::class);
  Route::apiResource('userduplicateactivesession', UserDuplicateActiveSessionController::class);
  Route::apiResource('usercredential', UserCredentialController::class);
  Route::apiResource('useractivecredential', UserActiveCredentialController::class);
  Route::apiResource('userinactivecredential', UserInactiveCredentialController::class);

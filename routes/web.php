<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RadacctController;
use App\Http\Controllers\RadcheckController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/radacct', [RadacctController::class, 'index']);
// Route::get('/client', [RadcheckController::class, 'index']);

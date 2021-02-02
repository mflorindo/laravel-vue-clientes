<?php

use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteCollection;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;

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


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);

});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('clientes', ClienteController::class);
    Route::get('dashboard',[DashboardController::class,'index']);
    Route::post('cidades',[CidadeController::class,'index']);
});

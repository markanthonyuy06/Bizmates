<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\AuthController;
Use App\Http\Controllers\LocationsController;


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


//Public Routes


//Protected Routes
// Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::get('/locations/weather_list/',[LocationsController::class,'weather_list']);
    Route::get('/locations/list/',[LocationsController::class,'location_list']);
// });
    
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

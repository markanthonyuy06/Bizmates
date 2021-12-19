<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Carbon\Carbon;

Use App\Models\Locations;
Use App\Http\Controllers\LocationsController;
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


Auth::routes();

// Route::get('/', [App\Http\Controllers\AppController::class, 'index'])->name('home');
// Route::get('/home', [App\Http\Controllers\AppController::class, 'index'])->name('home');


// Route::get('/locations',[LocationsController::class,'index']);

// Route::get('/locations/search/{name}',[LocationsController::class,'search']);
// Route::post('/locations',[LocationsController::class,'store']);
// Route::put('/locations/{id}',[LocationsController::class,'update']);
// Route::delete('/locations/{id}',[LocationsController::class,'destroy']);



// Route::get('/', [App\Http\Controllers\AppController::class, 'index'])->name('home');
// Route::get('/home', [App\Http\Controllers\AppController::class, 'index'])->name('home');
Route::get('/locations/',[LocationsController::class,'weather']);
Route::get('/locations/weather_details/{id}',[LocationsController::class,'weather_details']);
Route::get('/{any?}', [App\Http\Controllers\AppController::class, 'index'])->where('any', '.*');
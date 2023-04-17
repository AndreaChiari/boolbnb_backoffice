<?php

use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ViewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Apartments API routes
Route::get('/apartments', [ApartmentController::class, 'index']);
Route::get('/apartments/{apartment}', [ApartmentController::class, 'show']);
Route::get('/views', [ViewController::class, 'getIp']);
Route::post('/views', [ViewController::class, 'checkIp']);

//Messages API routes
Route::post('/messages', [MessageController::class, 'store']);

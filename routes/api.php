<?php

use App\Http\Controllers\API\ClubController;
use App\Http\Controllers\API\StudentController;
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

Route::middleware('auth:api')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/getClubName', [ClubController::class, 'getClubName']);

    Route::post('/status', [StudentController::class, 'status']);
    Route::post('/enter', [StudentController::class, 'enter']);
    Route::post('/leave', [StudentController::class, 'leave']);
});

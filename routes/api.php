<?php

use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\StudentController;
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

Route::middleware('token:api')->group(function () {
    Route::get('/active', [RoomController::class, 'oucrc']);
});

Route::middleware('auth:api')->group(function () {
    // This routing will be deleted.
    Route::get('/getClubName', [RoomController::class, 'getRoomName']);
    Route::post('/getClubNameFromID', [RoomController::class, 'getRoomNameFromID']);
    // ↓ Will be changed to this routing.
    Route::get('/getRoomName', [RoomController::class, 'getRoomName']);
    Route::post('/getRoomNameFromID', [RoomController::class, 'getRoomNameFromID']);

    Route::post('/status', [StudentController::class, 'status']);
    Route::post('/enter', [StudentController::class, 'enter']);
    Route::post('/leave', [StudentController::class, 'leave']);
});

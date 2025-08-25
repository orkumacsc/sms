<?php

use App\Http\Controllers\api\ApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('classes/{id}/disciplines',[ApiController::class, 'getDisciplinesByClassId']);
Route::get('classes/{id}/disciplines-arms',[ApiController::class, 'getDisciplinesOrArmsByClassId']);
Route::get('disciplines/{id}/arms',[ApiController::class, 'getArmsByDisciplineId']);
Route::get('staff/{id}/subjects',[ApiController::class, 'getSubjectsByStaffId']);
Route::get('disciplines/{id}/subjects/arms',[ApiController::class, 'getArmsBySubjectId']);

<?php

use App\Models\Departments;
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

Route::get('/api/classes/{id}/disciplines', function ($id) {
    // Fetch the department by ID
    $department = Departments::find($id);
    if (!$department) {
        return response()->json(['error' => 'Department not found'], 404);
    }
    return response()->json([
        'disciplines' => $department->arms()->get()
    ]);
});


<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApotekController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/apotek', [ApotekController::class, 'index']);
Route::post('/apotek/store', [ApotekController::class, 'store']);
Route::get('/apotek/{id}', [ApotekController::class, 'show']);
Route::patch('/apotek/update/{id}', [ApotekController::class, 'update']);
Route::delete('/apotek/delete/{id}', [ApotekController::class, 'destroy']);
Route::get('/apotek/trash/all', [ApotekController::class, 'trash']);
Route::get('/apotek/trash/restore/{id}', [ApotekController::class, 'restore']);
Route::get('/apotek/trash/permanent/{id}', [ApotekController::class, 'permanentDelete']);

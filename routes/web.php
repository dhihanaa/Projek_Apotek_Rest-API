<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApotekController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ApotekController::class, 'createToken']);
// Route::get('/apotek', [ApotekController::class, 'index']);
// Route::post('/apotek/store', [ApotekController::class, 'store']);
// Route::get('/apotek/{id}', [ApotekController::class, 'show']);
// Route::patch('/apotek/update/{id}', [ApotekController::class, 'update']);
// Route::delete('/apotek/delete/{id}', [ApotekController::class, 'destroy']);
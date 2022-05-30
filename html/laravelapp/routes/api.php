<?php

use App\Http\Controllers\GoController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('me', [UserController::class, 'me']);
    Route::any('go', [GoController::class, 'index']);
    Route::any('go/test', [GoController::class, 'test']);
    Route::any('go/unittest', [GoController::class, 'unittest']);
});

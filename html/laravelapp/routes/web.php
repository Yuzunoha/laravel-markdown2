<?php

use App\Http\Controllers\MarkdownController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', fn () => redirect('/register'));
Route::get('markdown', [MarkdownController::class, 'index']);
Route::post('markdown/store', [MarkdownController::class, 'store']);
Route::get('markdown/setsample', [MarkdownController::class, 'setsample']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('codegym-token', [UserController::class, 'codegymToken']);
});

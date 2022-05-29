<?php

use App\Http\Controllers\MarkdownController;
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

Route::get('/', fn () => redirect('/dashboard'));
Route::get('markdown', [MarkdownController::class, 'index']);
Route::post('markdown/store', [MarkdownController::class, 'store']);
Route::get('markdown/setsample', [MarkdownController::class, 'setsample']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

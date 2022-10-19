<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UMA\PenyerahanAkunController;
use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('welcome');
});
//API route for login user
Route::get('/register', [AuthController::class, 'registerview']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'loginview']);
// Route::get('/login', [App\Http\Controllers\AuthController::class, 'loginview']);
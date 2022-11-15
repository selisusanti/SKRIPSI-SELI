<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UMA\PenyerahanAkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

//API route for login user
Route::get('', [AuthController::class, 'index']);
Route::get('register', [AuthController::class, 'registerview']);
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'loginview']);
Route::get('forgetPassword', [AuthController::class, 'forgetPasswordView']);
Route::get('reset-password/{token}', [AuthController::class, 'resetPasswordView']);
Route::post('reset-password', [AuthController::class, 'saveResetPassword']);
Route::post('sendEmail', [AuthController::class, 'sendEmail']);
Route::get('logout', [AuthController::class, 'logout']);


Route::get('contact', [ContactController::class, 'index']);
Route::post('comment', [ContactController::class, 'comment']);


Route::get('shop', [ShopController::class, 'index']);
Route::get('shop/{id}', [ShopController::class, 'detail']);
Route::post('shop', [ShopController::class, 'save']);
Route::post('updateShop', [ShopController::class, 'update']);
Route::post('shop/diskon', [ShopController::class, 'diskon']);


Route::get('cart', [CartController::class, 'index']);
Route::get('kupon', [CartController::class, 'kupon']);
Route::post('cart/update', [CartController::class, 'update']);
Route::post('cart/remove', [CartController::class, 'removeCart']);
Route::post('order', [CartController::class, 'order']);

Route::get('checkout', [CartController::class, 'checkout']);
Route::post('checkout', [CartController::class, 'simpanPesanan']);
Route::get('/profile', [UserController::class, 'profile']);

Route::get('ongkir/city', [CartController::class, 'getCity']);
Route::get('ongkir/cekongkirjne', [CartController::class, 'getOngkir']);




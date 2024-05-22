<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtmController;

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

Route::get('/', function () {
    return view('welcome');
});

// 口座開設用のルーティング
Route::post('/bankTrading/accountOpening', [AtmController::class, 'accountOpen']);
// トークン発行用のルーティング
Route::get('/createToken', [AtmController::class, 'createToken']);
// 残高照会用のルーティング
Route::get('/bankTrading/{account_id}', [AtmController::class, 'balanceReference']);
// 預入処理用のルーティング
Route::post('/bankTrading/depositMoney/{account_id}', [AtmController::class, 'deposit']);
// 引き出し処理のルーティング
Route::post('/bankTrading/withdrawal/{account_id}', [AtmController::class, 'withdrawal']);

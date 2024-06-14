<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\SettingBungaController;
use App\Http\Controllers\JenisTransaksiController;
use App\Http\Controllers\TabunganAnggotaController;

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

Route::prefix('api')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/user', [UserController::class, 'get_user']);

    Route::resource('anggota', AnggotaController::class);
    Route::resource('jenis-transaksi', JenisTransaksiController::class);
    Route::resource('tabungan', TabunganAnggotaController::class);

    Route::get('/saldo/(:id)', [TabunganAnggotaController::class, 'saldo/$1']);

    Route::get('/setting-bunga', [SettingBungaController::class, 'index']);
    Route::get('add-setting-bunga', [SettingBungaController::class, 'addSettingBunga']);
});
<?php

use App\Http\Controllers\LoginController;

// Zakat Route
use App\Http\Controllers\zakat\AdminController;
use App\Http\Controllers\zakat\DashboardController;
use App\Http\Controllers\zakat\InfaqController;
use App\Http\Controllers\zakat\FitrahController;
use App\Http\Controllers\zakat\MalController;
use App\Http\Controllers\zakat\MustahikController;
use App\Http\Controllers\zakat\TransaksiInfaqController;
use App\Http\Controllers\zakat\TransaksiZakatController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);

Route::prefix('zakat')->group( function () {

  Route::middleware('auth:sanctum')->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::get('fitrah/deleted', [FitrahController::class, 'deleted']);
    Route::get('fitrah/deleted/{keyword}', [FitrahController::class, 'searchDeleted']);
    Route::get('fitrah/restore/{id}', [FitrahController::class, 'restore']);
    Route::get('fitrah/{jenis}/{keyword}', [FitrahController::class, 'search']);
    Route::get('fitrah/{jenis}', [FitrahController::class, 'index']);
    Route::put('fitrah/{id}', [FitrahController::class, 'update']);
    Route::delete('fitrah/{id}', [FitrahController::class, 'softDelete']);
    Route::post('fitrah', [FitrahController::class, 'store']);

    Route::get('mal/deleted', [MalController::class, 'deleted']);
    Route::get('mal/deleted/{keyword}', [MalController::class, 'searchDeleted']);
    Route::get('mal/restore/{id}', [MalController::class, 'restore']);
    Route::get('mal/{jenis}', [MalController::class, 'index']);
    Route::delete('mal/{id}', [MalController::class, 'softDelete']);
    Route::post('mal', [MalController::class, 'store']);
    Route::get('mal/{jenis}/{keyword}', [MalController::class, 'search']);

    Route::get('infaq/deleted', [InfaqController::class, 'deleted']);
    Route::get('infaq', [InfaqController::class, 'index']);
    Route::get('infaq/restore/{id}', [InfaqController::class, 'restore']);
    Route::get('infaq/deleted/{keyword}', [InfaqController::class, 'searchDeleted']);
    Route::delete('infaq/{id}', [InfaqController::class, 'softDelete']);
    Route::put('infaq/{id}', [InfaqController::class, 'update']);
    Route::post('infaq', [InfaqController::class, 'store']);
    Route::get('infaq/{keyword}', [InfaqController::class, 'search']);
    
    Route::get('mustahik', [MustahikController::class, 'index']);
    Route::get('mustahik/deleted', [MustahikController::class, 'deletedData']);
    Route::post('mustahik', [MustahikController::class, 'store']);
    Route::get('mustahik/deleted/{keyword}', [MustahikController::class, 'searchDeleted']);
    Route::get('mustahik/searchmustahik/{keyword}', [MustahikController::class, 'searchMustahik']);
    Route::get('mustahik/{keyword}', [MustahikController::class, 'search']);
    Route::patch('mustahik/{id}', [MustahikController::class, 'update']);
    Route::delete('mustahik/{id}', [MustahikController::class, 'delete']);
    Route::get('mustahik/detail/{id}', [MustahikController::class, 'detail']);
    Route::get('mustahik/restore/{id}', [MustahikController::class, 'restore']);

    Route::get('transaksizakat', [TransaksiZakatController::class, 'index']);
    Route::patch('transaksizakat/{id}', [TransaksiZakatController::class, 'update']);
    Route::post('transaksizakat', [TransaksiZakatController::class, 'store']);
    Route::delete('transaksizakat/{id}', [TransaksiZakatController::class, 'delete']);
    Route::get('transaksizakat/{keyword}', [TransaksiZakatController::class, 'searchData']);

    Route::get('transaksiinfaq', [TransaksiInfaqController::class, 'index']);
    Route::post('transaksiinfaq', [TransaksiInfaqController::class, 'store']);
    Route::patch('transaksiinfaq/{id}', [TransaksiInfaqController::class, 'update']);
    Route::delete('transaksiinfaq/{id}', [TransaksiInfaqController::class, 'delete']);
    Route::post('transaksiinfaq/search', [TransaksiInfaqController::class, 'search']);

    Route::get('admins', [AdminController::class, 'index']);
    Route::post('admins', [AdminController::class, 'store']);
    Route::delete('admins/{id}', [AdminController::class, 'delete']);
    Route::put('admins/{id}', [AdminController::class, 'update']);
    
  });
  
});
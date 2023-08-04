<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Sarpras\AlatController;
use App\Http\Controllers\Sarpras\DashboardController;
use App\Http\Controllers\Sarpras\MahasiswaController;
use App\Http\Controllers\sarpras\OrganisasiMahasiswaController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login/process', 'process');
    Route::get('logout', 'logout');
});

Route::group(['middleware' => ['CheckLogin:1']], function () {
    Route::group(['prefix' => 'sarpras'], function () {
        Route::get('dashboard', [DashboardController::class, 'index']);

        Route::group(['prefix' => 'organisasi-mahasiswa'], function () {
            Route::get('/', [OrganisasiMahasiswaController::class, 'index']);
            Route::post('save', [OrganisasiMahasiswaController::class, 'store']);
            Route::get('detail/{id}', [OrganisasiMahasiswaController::class, 'show']);
            Route::get('edit/{id}', [OrganisasiMahasiswaController::class, 'edit']);
            Route::post('update/{id}', [OrganisasiMahasiswaController::class, 'update']);
            Route::get('delete/{id}', [OrganisasiMahasiswaController::class, 'delete']);
            Route::get('softdelete/{id}', [OrganisasiMahasiswaController::class, 'softDelete']);
            Route::get('trashed', [OrganisasiMahasiswaController::class, 'trashed']);
            Route::get('restore/{id}', [OrganisasiMahasiswaController::class, 'restore']);
        });

        Route::group(['prefix' => 'mahasiswa'], function () {
            Route::get('/', [MahasiswaController::class, 'index']);
            Route::get('detail/{id}', [MahasiswaController::class, 'show']);
        });

        Route::group(['prefix' => 'alat'], function () {
            Route::get('/', [AlatController::class, 'index']);
            Route::post('save', [AlatController::class, 'store']);
            Route::get('edit/{id}', [AlatController::class, 'edit']);
            Route::post('update/{id}', [AlatController::class, 'update']);
            Route::get('softdelete/{id}', [AlatController::class, 'softDelete']);
        });
    });
});

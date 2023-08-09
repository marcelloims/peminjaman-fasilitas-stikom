<?php

use App\Http\Controllers\Akademik\DashboardController as AkademikDashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Bem\DashboardController as BemDashboardController;
use App\Http\Controllers\Bem\MahasiswaController as BemMahasiswaController;
use App\Http\Controllers\Bem\OrganisasiMahasiswaController as BemOrganisasiMahasiswaController;
use App\Http\Controllers\Sarpras\AlatController;
use App\Http\Controllers\Sarpras\DashboardController;
use App\Http\Controllers\Sarpras\FasilitasController;
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

        Route::group(['prefix' => 'fasilitas'], function () {
            Route::get('/', [FasilitasController::class, 'index']);
            Route::post('save', [FasilitasController::class, 'store']);
            Route::post('fasilitas-save', [FasilitasController::class, 'store_tool']);
            Route::get('detail/{id}', [FasilitasController::class, 'show']);
            Route::get('edit/{id}', [FasilitasController::class, 'edit']);
            Route::get('fasilitas-edit/{id}', [FasilitasController::class, 'edit_tool']);
            Route::post('update/{id}', [FasilitasController::class, 'update']);
            Route::post('fasilitas-update/{id}', [FasilitasController::class, 'update_tool']);
            Route::get('softdelete/{id}', [FasilitasController::class, 'softDelete']);
        });
    });
});

Route::group(['middleware' => ['CheckLogin:2']], function () {
    Route::group(['prefix' => 'bem'], function () {
        Route::get('dashboard', [BemDashboardController::class, 'index']);

        Route::group(['prefix' => 'organisasi-mahasiswa'], function () {
            Route::get('/', [BemOrganisasiMahasiswaController::class, 'index']);
            Route::post('save', [BemOrganisasiMahasiswaController::class, 'store']);
            Route::get('detail/{id}', [BemOrganisasiMahasiswaController::class, 'show']);
            Route::get('edit/{id}', [BemOrganisasiMahasiswaController::class, 'edit']);
            Route::post('update/{id}', [BemOrganisasiMahasiswaController::class, 'update']);
            Route::get('delete/{id}', [BemOrganisasiMahasiswaController::class, 'delete']);
            Route::get('softdelete/{id}', [BemOrganisasiMahasiswaController::class, 'softDelete']);
            Route::get('trashed', [BemOrganisasiMahasiswaController::class, 'trashed']);
            Route::get('restore/{id}', [BemOrganisasiMahasiswaController::class, 'restore']);
        });

        Route::group(['prefix' => 'mahasiswa'], function () {
            Route::get('/', [BemMahasiswaController::class, 'index']);
            Route::post('save', [BemMahasiswaController::class, 'store']);
            Route::get('detail/{id}', [BemMahasiswaController::class, 'show']);
        });
    });
});

Route::group(['middleware' => ['CheckLogin:4']], function () {
    Route::group(['prefix' => 'akademik'], function () {
        Route::get('dashboard', [AkademikDashboardController::class, 'index']);
    });
});

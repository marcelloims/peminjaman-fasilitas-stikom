<?php

use App\Http\Controllers\Akademik\DashboardController as AkademikDashboardController;
use App\Http\Controllers\Akademik\FasilitasController as AkademikFasilitasController;
use App\Http\Controllers\Akademik\MahasiswaController as AkademikMahasiswaController;
use App\Http\Controllers\Akademik\OrganisasiMahasiswaController as AkademikOrganisasiMahasiswaController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Bem\DashboardController as BemDashboardController;
use App\Http\Controllers\Bem\MahasiswaController as BemMahasiswaController;
use App\Http\Controllers\Bem\OrganisasiMahasiswaController as BemOrganisasiMahasiswaController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;
use App\Http\Controllers\Mahasiswa\MahasiswaController as MahasiswaMahasiswaController;
use App\Http\Controllers\Mahasiswa\OrganisasiMahasiswaController as MahasiswaOrganisasiMahasiswaController;
use App\Http\Controllers\Mahasiswa\PengajuanAlatController;
use App\Http\Controllers\Mahasiswa\PersetujuanAlatController;
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
            Route::post('fasilitas-save', [FasilitasController::class, 'store_tool']);
            Route::get('detail/{id}', [FasilitasController::class, 'show']);
            Route::get('fasilitas-edit/{id}', [FasilitasController::class, 'edit_tool']);
            Route::post('fasilitas-update/{id}', [FasilitasController::class, 'update_tool']);
            Route::get('fasilitas-softdelete/{id}', [FasilitasController::class, 'softDelete']);
        });
    });
});

Route::group(['middleware' => ['CheckLogin:2']], function () {
    Route::group(['prefix' => 'bem'], function () {
        Route::get('dashboard', [BemDashboardController::class, 'index']);

        Route::group(['prefix' => 'organisasi-mahasiswa'], function () {
            Route::get('/', [BemOrganisasiMahasiswaController::class, 'index']);
        });

        Route::group(['prefix' => 'mahasiswa'], function () {
            Route::get('/', [BemMahasiswaController::class, 'index']);
            Route::post('save', [BemMahasiswaController::class, 'store']);
            Route::get('edit/{id}', [BemMahasiswaController::class, 'edit']);
            Route::post('update/{id}', [BemMahasiswaController::class, 'update']);
            Route::get('detail/{id}', [BemMahasiswaController::class, 'show']);
        });
    });
});

Route::group(['middleware' => ['CheckLogin:3']], function () {
    Route::group(['prefix' => 'mahasiswa'], function () {
        Route::get('dashboard', [MahasiswaDashboardController::class, 'index']);

        Route::group(['prefix' => 'organisasi-mahasiswa'], function () {
            Route::get('/', [MahasiswaOrganisasiMahasiswaController::class, 'index']);
        });

        Route::group(['prefix' => 'mahasiswa'], function () {
            Route::get('/', [MahasiswaMahasiswaController::class, 'index']);
            Route::get('detail/{id}', [MahasiswaMahasiswaController::class, 'show']);
        });

        Route::group(['prefix' => 'pengajuan'], function () {
            Route::group(['prefix' => 'alat'], function () {
                Route::get('/', [PengajuanAlatController::class, 'index']);
                Route::post('/addToCart/{id}', [PengajuanAlatController::class, 'addToCart']);
                Route::get('/detailCart', [PengajuanAlatController::class, 'detailCart']);
                Route::post('/subtract/{id}', [PengajuanAlatController::class, 'subtractCart']);
                Route::post('/addedCart/{id}', [PengajuanAlatController::class, 'addedCart']);
                Route::post('deletedCart/{id}', [PengajuanAlatController::class, 'deletedCart']);
                Route::post('/save', [PengajuanAlatController::class, 'store']);
                Route::get('/clearCart', [PengajuanAlatController::class, 'clearCart']);
            });
        });
        Route::group(['prefix' => 'persetujuan'], function () {
            Route::group(['prefix' => 'alat'], function () {
                Route::get('/', [PersetujuanAlatController::class, 'index']);
                Route::get('/detail/{id}', [PersetujuanAlatController::class, 'show']);
            });
        });
    });
});

Route::group(['middleware' => ['CheckLogin:4']], function () {
    Route::group(['prefix' => 'akademik_kemahasiswaan'], function () {
        Route::get('dashboard', [AkademikDashboardController::class, 'index']);

        Route::group(['prefix' => 'organisasi-mahasiswa'], function () {
            Route::get('/', [AkademikOrganisasiMahasiswaController::class, 'index']);
            Route::post('save', [AkademikOrganisasiMahasiswaController::class, 'store']);
            Route::get('edit/{id}', [AkademikOrganisasiMahasiswaController::class, 'edit']);
            Route::post('update/{id}', [AkademikOrganisasiMahasiswaController::class, 'update']);
            Route::get('softdelete/{id}', [AkademikOrganisasiMahasiswaController::class, 'softDelete']);
        });

        Route::group(['prefix' => 'mahasiswa'], function () {
            Route::get('/', [AkademikMahasiswaController::class, 'index']);
            Route::post('save', [AkademikMahasiswaController::class, 'store']);
            Route::get('detail/{id}', [AkademikMahasiswaController::class, 'show']);
        });

        Route::group(['prefix' => 'fasilitas'], function () {
            Route::get('/', [AkademikFasilitasController::class, 'index']);
            Route::post('save', [AkademikFasilitasController::class, 'store']);
            Route::post('fasilitas-save', [AkademikFasilitasController::class, 'store_tool']);
            Route::get('detail/{id}', [AkademikFasilitasController::class, 'show']);
            Route::get('edit/{id}', [AkademikFasilitasController::class, 'edit']);
            Route::get('fasilitas-edit/{id}', [AkademikFasilitasController::class, 'edit_tool']);
            Route::post('update/{id}', [AkademikFasilitasController::class, 'update']);
            Route::post('fasilitas-update/{id}', [AkademikFasilitasController::class, 'update_tool']);
            Route::get('softdelete/{id}', [AkademikFasilitasController::class, 'softDelete']);
        });
    });
});

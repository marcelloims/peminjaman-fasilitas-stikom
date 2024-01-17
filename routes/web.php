<?php

use App\Http\Controllers\Akademik\DashboardController as AkademikDashboardController;
use App\Http\Controllers\Akademik\FasilitasController as AkademikFasilitasController;
use App\Http\Controllers\Akademik\MahasiswaController as AkademikMahasiswaController;
use App\Http\Controllers\Akademik\OrganisasiMahasiswaController as AkademikOrganisasiMahasiswaController;
use App\Http\Controllers\Akademik\PersetujuanAlatController as AkademikPersetujuanAlatController;
use App\Http\Controllers\Akademik\PersetujuanAulaController as AkademikPersetujuanAulaController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Bem\DashboardController as BemDashboardController;
use App\Http\Controllers\Bem\MahasiswaController as BemMahasiswaController;
use App\Http\Controllers\Bem\OrganisasiMahasiswaController as BemOrganisasiMahasiswaController;
use App\Http\Controllers\Bem\PersetujuanAlatController as BemPersetujuanAlatController;
use App\Http\Controllers\Bem\PersetujuanAulaController as BemPersetujuanAulaController;
use App\Http\Controllers\Kemahasiswaan\DashboardController as KemahasiswaanDashboardController;
use App\Http\Controllers\Kemahasiswaan\FasilitasController as KemahasiswaanFasilitasController;
use App\Http\Controllers\Kemahasiswaan\MahasiswaController as KemahasiswaanMahasiswaController;
use App\Http\Controllers\Kemahasiswaan\OrganisasiMahasiswaController as KemahasiswaanOrganisasiMahasiswaController;
use App\Http\Controllers\Kemahasiswaan\PersetujuanAlatController as KemahasiswaanPersetujuanAlatController;
use App\Http\Controllers\Kemahasiswaan\PersetujuanAulaController as KemahasiswaanPersetujuanAulaController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;
use App\Http\Controllers\Mahasiswa\MahasiswaController as MahasiswaMahasiswaController;
use App\Http\Controllers\Mahasiswa\OrganisasiMahasiswaController as MahasiswaOrganisasiMahasiswaController;
use App\Http\Controllers\Mahasiswa\PengajuanAlatController;
use App\Http\Controllers\Mahasiswa\PengajuanAulaController;
use App\Http\Controllers\Mahasiswa\PengajuanKelasController;
use App\Http\Controllers\Mahasiswa\PersetujuanAlatController;
use App\Http\Controllers\Mahasiswa\PersetujuanAulaController;
use App\Http\Controllers\Sarpras\AlatController;
use App\Http\Controllers\Sarpras\DashboardController;
use App\Http\Controllers\Sarpras\FasilitasController;
use App\Http\Controllers\Sarpras\MahasiswaController;
use App\Http\Controllers\sarpras\OrganisasiMahasiswaController;
use App\Http\Controllers\Sarpras\PersetujuanAlatController as SarprasPersetujuanAlatController;
use App\Http\Controllers\Sarpras\PersetujuanAulaController as SarprasPersetujuanAulaController;
use App\Http\Controllers\Sarpras\ReportController;
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

Route::get('/', [AuthController::class, 'index']);

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login/process', 'process');
    Route::get('logout', 'logout');
});

Route::group(['middleware' => ['CheckLogin:1']], function () {
    Route::group(['prefix' => 'sarpras'], function () {
        Route::get('dashboard', [DashboardController::class, 'index']);
        Route::get('ukm', [DashboardController::class, 'ukm']);

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
            Route::post('save', [FasilitasController::class, 'store']);
            Route::post('fasilitas-save', [FasilitasController::class, 'store_tool']);
            Route::get('detail/{id}', [FasilitasController::class, 'show']);
            Route::get('fasilitas-edit/{id}', [FasilitasController::class, 'edit_tool']);
            Route::post('fasilitas-update/{id}', [FasilitasController::class, 'update_tool']);
            Route::get('fasilitas-softdelete/{id}', [FasilitasController::class, 'softDelete']);
        });

        Route::group(['prefix' => 'persetujuan'], function () {
            Route::group(['prefix' => 'alat'], function () {
                Route::get('/', [SarprasPersetujuanAlatController::class, 'index']);
                Route::get('/detail/{id}', [SarprasPersetujuanAlatController::class, 'show']);
                Route::get('/edit/{id}', [SarprasPersetujuanAlatController::class, 'edit']);
                Route::post('/update/{id}', [SarprasPersetujuanAlatController::class, 'retur']);
            });
            Route::group(['prefix' => 'aula'], function () {
                Route::get('/', [SarprasPersetujuanAulaController::class, 'index']);
                Route::get('/detail/{id}', [SarprasPersetujuanAulaController::class, 'show']);
                Route::get('/edit/{id}', [SarprasPersetujuanAulaController::class, 'edit']);
                Route::post('/update/{id}', [SarprasPersetujuanAulaController::class, 'retur']);
            });
        });

        Route::group(['prefix' => 'laporan'], function () {
            Route::group(['prefix' => 'fasilitas'], function () {
                Route::get('/', [ReportController::class, 'fasilitas']);
                Route::post('/search', [ReportController::class, 'data']);
                Route::post('/print', [ReportController::class, 'print']);
            });
        });
    });
});

Route::group(['middleware' => ['CheckLogin:2']], function () {
    Route::group(['prefix' => 'bem'], function () {
        Route::get('dashboard', [BemDashboardController::class, 'index']);
        Route::get('ukm', [BemDashboardController::class, 'ukm']);

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

        Route::group(['prefix' => 'persetujuan'], function () {
            Route::group(['prefix' => 'alat'], function () {
                Route::get('/', [BemPersetujuanAlatController::class, 'index']);
                Route::get('/detail/{id}', [BemPersetujuanAlatController::class, 'show']);
                Route::get('/approve/{id}', [BemPersetujuanAlatController::class, 'approve']);
                Route::get('/reject/{id}', [BemPersetujuanAlatController::class, 'reject']);
            });
            Route::group(['prefix' => 'aula'], function () {
                Route::get('/', [BemPersetujuanAulaController::class, 'index']);
                Route::get('/detail/{id}', [BemPersetujuanAulaController::class, 'show']);
                Route::get('/approve/{id}', [BemPersetujuanAulaController::class, 'approve']);
                Route::get('/reject/{id}', [BemPersetujuanAulaController::class, 'reject']);
            });
        });
    });
});

Route::group(['middleware' => ['CheckLogin:3']], function () {
    Route::group(['prefix' => 'mahasiswa'], function () {
        Route::get('dashboard', [MahasiswaDashboardController::class, 'index']);
        Route::get('ukm', [MahasiswaDashboardController::class, 'ukm']);

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
                Route::post('/search/date', [PengajuanAlatController::class, 'search_date']);
                Route::post('/addToCart/{id}', [PengajuanAlatController::class, 'addToCart']);
                Route::get('/detailCart', [PengajuanAlatController::class, 'detailCart']);
                Route::post('/subtract/{id}', [PengajuanAlatController::class, 'subtractCart']);
                Route::post('/addedCart/{id}', [PengajuanAlatController::class, 'addedCart']);
                Route::post('deletedCart/{id}', [PengajuanAlatController::class, 'deletedCart']);
                Route::post('/save', [PengajuanAlatController::class, 'store']);
                Route::get('/clearCart', [PengajuanAlatController::class, 'clearCart']);
            });

            Route::group(['prefix' => 'aula'], function () {
                Route::get('/', [PengajuanAulaController::class, 'index']);
                Route::post('/save', [PengajuanAulaController::class, 'store']);
                Route::get('/clearCart', [PengajuanAulaController::class, 'clearCart']);
            });

            Route::group(['prefix' => 'kelas'], function () {
                Route::get('/', [PengajuanKelasController::class, 'index']);
                Route::post('/save', [PengajuanKelasController::class, 'store']);
            });
        });

        Route::group(['prefix' => 'persetujuan'], function () {
            Route::group(['prefix' => 'alat'], function () {
                Route::get('/', [PersetujuanAlatController::class, 'index']);
                Route::get('/detail/{id}', [PersetujuanAlatController::class, 'show']);
            });

            Route::group(['prefix' => 'aula'], function () {
                Route::get('/', [PersetujuanAulaController::class, 'index']);
                Route::get('/detail/{id}', [PersetujuanAulaController::class, 'show']);
            });
        });
    });
});

Route::group(['middleware' => ['CheckLogin:4']], function () {
    Route::group(['prefix' => 'akademik_kemahasiswaan'], function () {
        Route::get('dashboard', [AkademikDashboardController::class, 'index']);
        Route::get('ukm', [AkademikDashboardController::class, 'ukm']);

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

        Route::group(['prefix' => 'persetujuan'], function () {
            Route::group(['prefix' => 'alat'], function () {
                Route::get('/', [AkademikPersetujuanAlatController::class, 'index']);
                Route::get('/detail/{id}', [AkademikPersetujuanAlatController::class, 'show']);
                Route::get('/approve/{id}', [AkademikPersetujuanAlatController::class, 'approve']);
                Route::get('/reject/{id}', [AkademikPersetujuanAlatController::class, 'reject']);
            });
            Route::group(['prefix' => 'aula'], function () {
                Route::get('/', [AkademikPersetujuanAulaController::class, 'index']);
                Route::get('/detail/{id}', [AkademikPersetujuanAulaController::class, 'show']);
                Route::get('/approve/{id}', [AkademikPersetujuanAulaController::class, 'approve']);
                Route::get('/reject/{id}', [AkademikPersetujuanAulaController::class, 'reject']);
            });
        });
    });
});

Route::group(['middleware' => ['CheckLogin:5']], function () {
    Route::group(['prefix' => 'kemahasiswaan'], function () {
        Route::get('dashboard', [KemahasiswaanDashboardController::class, 'index']);
        Route::get('ukm', [KemahasiswaanDashboardController::class, 'ukm']);

        Route::group(['prefix' => 'organisasi-mahasiswa'], function () {
            Route::get('/', [KemahasiswaanOrganisasiMahasiswaController::class, 'index']);
            Route::post('save', [KemahasiswaanOrganisasiMahasiswaController::class, 'store']);
            Route::get('edit/{id}', [KemahasiswaanOrganisasiMahasiswaController::class, 'edit']);
            Route::post('update/{id}', [KemahasiswaanOrganisasiMahasiswaController::class, 'update']);
            Route::get('softdelete/{id}', [KemahasiswaanOrganisasiMahasiswaController::class, 'softDelete']);
        });

        Route::group(['prefix' => 'mahasiswa'], function () {
            Route::get('/', [KemahasiswaanMahasiswaController::class, 'index']);
            Route::get('detail/{id}', [KemahasiswaanMahasiswaController::class, 'show']);
        });
        Route::group(['prefix' => 'fasilitas'], function () {
            Route::get('/', [KemahasiswaanFasilitasController::class, 'index']);
            Route::get('detail/{id}', [KemahasiswaanFasilitasController::class, 'show']);
        });

        Route::group(['prefix' => 'persetujuan'], function () {
            Route::group(['prefix' => 'alat'], function () {
                Route::get('/', [KemahasiswaanPersetujuanAlatController::class, 'index']);
                Route::get('/detail/{id}', [KemahasiswaanPersetujuanAlatController::class, 'show']);
                Route::get('/approve/{id}', [KemahasiswaanPersetujuanAlatController::class, 'approve']);
                Route::get('/reject/{id}', [KemahasiswaanPersetujuanAlatController::class, 'reject']);
            });
            Route::group(['prefix' => 'aula'], function () {
                Route::get('/', [KemahasiswaanPersetujuanAulaController::class, 'index']);
                Route::get('/detail/{id}', [KemahasiswaanPersetujuanAulaController::class, 'show']);
                Route::get('/approve/{id}', [KemahasiswaanPersetujuanAulaController::class, 'approve']);
                Route::get('/reject/{id}', [KemahasiswaanPersetujuanAulaController::class, 'reject']);
            });
        });
    });
});

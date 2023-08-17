<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Services\AlatService;
use App\Services\MahasiswaService;
use App\Services\PengajuanAlatService;
use Illuminate\Http\Request;

class PengajuanAlatController extends Controller
{
    private $pengajuanAulaAlatService;
    private $mahasiswaService;
    private $alatService;
    private $table;

    public function __construct(
        PengajuanAlatService $service,
        MahasiswaService $mahasiswa,
        AlatService $alat
    ) {
        date_default_timezone_set('Asia/Singapore');
        $this->pengajuanAulaAlatService = $service;
        $this->mahasiswaService = $mahasiswa;
        $this->alatService = $alat;
        $this->table = "submissions";
    }

    public function index()
    {
        $data['title']      = 'Pengajuan Peminjaman';
        $data['chairmans']  = $this->mahasiswaService->getChairman('users');
        $data['tools']      = $this->alatService->getToolOnly('tools');

        return view('mahasiswa_templates.pages.pengajuan.alat.index', $data);
    }

    public function store(Request $request)
    {
        $this->pengajuanAulaAlatService->store($this->table, $request);
    }
}

<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Services\AlatService;
use App\Services\MahasiswaService;
use App\Services\PengajuanAlatService;
use Illuminate\Http\Request;

class PengajuanAulaController extends Controller
{
    private $mahasiswaService;
    private $pengajuanService;
    private $table;

    public function __construct(
        PengajuanAlatService $service,
        MahasiswaService $mahasiswa,
        AlatService $alat
    ) {
        date_default_timezone_set('Asia/Singapore');
        $this->table = "submissions";
        $this->pengajuanService = $service;
        $this->mahasiswaService = $mahasiswa;
    }

    public function index()
    {
        $data['title']          = 'Pengajuan Peminjaman';
        $data['chairmans']      = $this->mahasiswaService->getChairman('users');

        return view('mahasiswa_templates.pages.pengajuan.aula.index', $data);
    }

    public function store(Request $request)
    {
        $this->pengajuanService->storeAula($this->table, $request);

        return redirect('mahasiswa/pengajuan/aula')->with('message', "Berhasil disimpan!");
    }
}

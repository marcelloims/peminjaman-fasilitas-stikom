<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Services\MahasiswaService;
use App\Services\PengajuanKelasService;
use Illuminate\Http\Request;

class PengajuanKelasController extends Controller
{
    private $mahasiswaService;
    private $pengajuanService;
    private $table;

    public function __construct(
        PengajuanKelasService $service,
        MahasiswaService $mahasiswa,
    ) {
        date_default_timezone_set('Asia/Singapore');
        $this->table = "submissions";
        $this->pengajuanService = $service;
        $this->mahasiswaService = $mahasiswa;
    }

    public function index()
    {
        $data['title']          = 'Pengajuan Peminjaman Kelas';
        $data['chairmans']      = $this->mahasiswaService->getChairman('users');
        $data['classes']        = Facility::where('code', "!=", "aula")->get();

        return view('mahasiswa_templates.pages.pengajuan.kelas.index', $data);
    }

    public function store(Request $request)
    {
        $this->pengajuanService->storeKelas($this->table, $request);

        return redirect('mahasiswa/pengajuan/kelas')->with('message', "Berhasil disimpan!");
    }
}

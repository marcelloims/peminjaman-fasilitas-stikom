<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\Tool;
use App\Services\AlatService;
use App\Services\MahasiswaService;
use App\Services\PengajuanAlatService;
use App\Services\PengajuanAulaService;
use Illuminate\Http\Request;

class PengajuanAulaController extends Controller
{
    private $mahasiswaService;
    private $pengajuanService;
    private $table;

    public function __construct(
        PengajuanAulaService $service,
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
        $data['title']          = 'Pengajuan Peminjaman Aula';
        $data['chairmans']      = $this->mahasiswaService->getChairman('users');
        $data['submissions']    = Submission::where('category', 2)->get();

        return view('mahasiswa_templates.pages.pengajuan.aula.index', $data);
    }

    public function store(Request $request)
    {
        $dateStart  = date('Y-m-d', strtotime($request->tanggal_kegiatan_mulai)) . " " . $request->jam_mulai . ":00";
        $dateEnd    = date('Y-m-d', strtotime($request->tanggal_kegiatan_selesai)) . " " . $request->jam_selesai . ":00";
        $dataSubmission = Submission::where('category', 2)
            ->orWhere('date_start', [$dateStart])
            ->orWhere('date_end', [$dateEnd])
            ->first();

        if (!empty($dateStart) && strtotime($dateStart) > strtotime($dateEnd)) {
            $error = "Maaf, Tanggal anda salah";
        } elseif (!empty($dateStart) && strtotime($dateStart) <= strtotime(date("Y-m-d H:m:s"))) {
            $error = "Maaf, Tanggal sudah lewat";
        }
        if (
            (!empty($dateStart) && strtotime($dateStart) < strtotime($dataSubmission->date_end)) &&
            (strtotime($dateEnd) < strtotime($dataSubmission->date_start) && strtotime($dateStart) <= strtotime(date("Y-m-d H:m:s")))
        ) {
            $error = "sukses";
        } else {
            $error = "Maaf, Tanggal ini sudah dipakai silahkan lihat terlebih dahulu Data Daftar Peminjaman Aula";
        }

        $data = "Tes";

        return redirect('mahasiswa/pengajuan/aula')->with([
            'message' => $data,
            'error'   => $error,
        ]);
    }
}

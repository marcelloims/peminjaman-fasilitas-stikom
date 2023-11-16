<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Services\MahasiswaService;
use App\Services\PengajuanAulaService;
use Illuminate\Http\Request;

class PengajuanAulaController extends Controller
{
    private $mahasiswaService;
    private $pengajuanService;
    private $table;

    public function __construct(
        PengajuanAulaService $service,
        MahasiswaService $mahasiswa
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
        $dataSubmission = Submission::where('category', 2)
            ->where('date_start', '>=', date('Y-m-d', strtotime($request->tanggal_kegiatan_mulai)) . " 08:00:00")
            ->where('date_end', '<=', date('Y-m-d', strtotime($request->tanggal_kegiatan_selesai)) . " 18:00:00")
            ->orWhere('date_start', '<', date('Y-m-d', strtotime($request->tanggal_kegiatan_mulai)) . " 08:00:00")
            ->where('date_end', '>', date('Y-m-d', strtotime($request->tanggal_kegiatan_selesai)) . " 18:00:00")
            ->first();

        // dd($dataSubmission);

        $error = "";
        $message = "";

        if ($dataSubmission == null) {
            $startRequest   = date('Y-m-d', strtotime($request->tanggal_kegiatan_mulai));
            $endRequest     = date('Y-m-d', strtotime($request->tanggal_kegiatan_selesai));
            $dateNow        = date("Y-m-d");
            if ($startRequest > $endRequest) {
                $error = "Tanggal Salah!";
                return redirect('mahasiswa/pengajuan/aula')->with('error', $error);
            } elseif ($startRequest <= $dateNow && $endRequest <= $dateNow) {
                $error = "Tanggal sudah lewat!";
                return redirect('mahasiswa/pengajuan/aula')->with('error', $error);
            } else {
                $message = $this->pengajuanService->storeAula($this->table, $request);
            }
        } else {

            $startRequest   = date('Y-m-d', strtotime($request->tanggal_kegiatan_mulai));
            $endRequest     = date('Y-m-d', strtotime($request->tanggal_kegiatan_selesai));
            $startExist     = substr($dataSubmission->date_start, 0, 10);
            $endExist       = substr($dataSubmission->date_end, 0, 10);
            $dateNow        = date("Y-m-d");

            // dd($startExist, $startRequest);

            if (empty($startRequest) || empty($endRequest)) {
                $error = "Tanggal Mulai atau Tanggal Selesai tidak boleh kosong!";
                return redirect('mahasiswa/pengajuan/aula')->with('error', $error);
            } elseif ($startRequest > $endRequest) {
                $error = "Tanggal Salah!";
                return redirect('mahasiswa/pengajuan/aula')->with('error', $error);
            } elseif ($startRequest <= $dateNow && $endRequest <= $dateNow) {
                $error = "Tanggal sudah lewat!";
                return redirect('mahasiswa/pengajuan/aula')->with('error', $error);
            } elseif (
                ($startRequest == $startExist || $endRequest == $endExist) ||
                ($startRequest < $startExist && $endRequest >= $startExist) ||
                ($startRequest >= $startExist && $startRequest == $endExist) ||
                ($startRequest >= $startExist && $endRequest <= $endExist) ||
                ($startRequest > $startExist && $endRequest < $endExist) ||
                ($startRequest > $startExist && $startRequest < $endExist)
            ) {
                $error = "Tanggal sudah dipakai kegiatan lain! Silahkan lihat daftar peminjaman di bawah";
                return redirect('mahasiswa/pengajuan/aula')->with('error', $error);
            } else {
                $message = $this->pengajuanService->storeAula($this->table, $request);
            }
        }



        return redirect('mahasiswa/pengajuan/aula')->with('message', $message);
    }
}

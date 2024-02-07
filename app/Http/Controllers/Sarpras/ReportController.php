<?php

namespace App\Http\Controllers\Sarpras;

use App\Http\Controllers\Controller;
use App\Models\ErrorTool;
use App\Models\Submission;
use App\Models\Tool;
use App\Services\AlatService;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct(AlatService $service)
    {
        date_default_timezone_set('Asia/Singapore');
    }

    public function fasilitas()
    {
        $data['title']  = "Laporan Kondisi Fasilitas";
        $data['data']   = Tool::with([
            'errorTools' => function ($query) {
                $query->select([
                    'tools_id', app('db')->raw('sum(qty) as qty')
                ])->groupBy('tools_id');
            }
        ])->get();
        // dd($data);
        return view('sarpras_templates/pages/report/fasilitas', $data);
    }

    public function printFasilitas()
    {
        $data['title']  = "Laporan Pengajuan";
        $data['data']   = Tool::with([
            'errorTools' => function ($query) {
                $query->select([
                    'tools_id', app('db')->raw('sum(qty) as qty')
                ])->groupBy('tools_id');
            }
        ])->get();
        return view('sarpras_templates/pages/report/print_fasilitas', $data);
    }

    public function peminjaman()
    {
        $data['title']  = "Laporan Peminjaman";
        return view('sarpras_templates/pages/report/peminjaman', $data);
    }

    public function filterPeminjaman(Request $request)
    {
        $data['title']  = "Laporan Peminjaman";
        $data['tahun']  = $request->tahun;

        $data['data']   = Submission::select(DB::raw('count(*) as total, SUBSTRING(date_start,6,2) as bulan'))
            ->where("date_start", "like", $request->tahun . "%")->groupBy('date_start')->get();
        // dd($data    );
        $data['month']  = [
            "01" => "Januari",
            "02" => "Februari",
            "03" => "Maret",
            "04" => "April",
            "05" => "Mei",
            "06" => "Juni",
            "07" => "Juli",
            "08" => "Agustus",
            "09" => "September",
            "10" => "Oktober",
            "11" => "November",
            "12" => "Desember"
        ];

        // dd($data);
        return view('sarpras_templates/pages/report/peminjaman_data', $data);
    }

    public function printPeminjaman(Request $request)
    {
        $data['title']  = "Laporan Peminjaman";
        $data['tahun']  = $request->tahun;

        $data['data']   = Submission::select(DB::raw('count(*) as total, SUBSTRING(date_start,6,2) as bulan'))
            ->where("date_start", "like", $request->tahun . "%")->groupBy('date_start')->get();

        $data['month']  = [
            "01" => "Januari",
            "02" => "Februari",
            "03" => "Maret",
            "04" => "April",
            "05" => "Mei",
            "06" => "Juni",
            "07" => "Juli",
            "08" => "Agustus",
            "09" => "September",
            "10" => "Oktober",
            "11" => "November",
            "12" => "Desember"
        ];

        return view('sarpras_templates/pages/report/print_peminjaman', $data);
    }
}

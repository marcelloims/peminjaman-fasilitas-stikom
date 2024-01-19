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
        $data['data']   = Tool::with('errorTools')->get();
        return view('sarpras_templates/pages/report/fasilitas', $data);
    }

    public function printFasilitas()
    {
        $data['title']  = "Laporan Pengajuan";
        $data['data']   =  Tool::with('errorTools')->get();
        return view('sarpras_templates/pages/report/print_fasilitas', $data);
    }

    public function peminjaman()
    {
        $data['title']  = "Laporan Peminjaman";
        return view('sarpras_templates/pages/report/peminjaman', $data);
    }
}

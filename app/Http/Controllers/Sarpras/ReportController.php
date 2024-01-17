<?php

namespace App\Http\Controllers\Sarpras;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\Tool;
use App\Services\AlatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct(AlatService $service)
    {
        date_default_timezone_set('Asia/Singapore');
    }

    public function fasilitas(Request $request)
    {
        $data['title'] = "Laporan Pengajuan";
        $data['data']   =  Tool::join('error_tools', 'error_tools.tools_id', '=', 'tools.id')
            ->select('error_tools.qty as error_qty', 'tools.name', 'tools.qty')
            ->get();

        // dd($data);
        return view('sarpras_templates/pages/report/fasilitas', $data);
    }
    public function data(Request $request)
    {
        $data['title']  = "Laporan Pengajuan";
        $data['data']   =  Tool::join('error_tools', 'error_tools.tools_id', '=', 'tools.id')
            ->join('returs', 'returs.tools_id', '=', 'tools.id')
            ->groupBy('tools.id')
            ->select('tools.name', 'SUM(error_tools.qty) as error_qty', 'tools.qty')
            ->get();
        dd($data);
        return view('sarpras_templates/pages/report/fasilitas_data', $data);
    }

    public function print(Request $request)
    {
        $data['title']  = "Laporan Pengajuan";
        $data['data']   =  Submission::join('student_organizations', 'submissions.student_organizations_id', "=", 'student_organizations.id')
            ->where('submissions.created_at', '>=', $request->dateStart)
            ->where('submissions.created_at', '<=', $request->dateEnd)
            ->select('submissions.code', 'submissions.status', 'submissions.created_at', 'student_organizations.name')
            ->get();
        $data['date']   = [
            'dateStart' => $request->dateStart,
            'dateEnd' => $request->dateEnd,
        ];
        // dd($data);
        return view('sarpras_templates/pages/report/print_pengajuan', $data);
    }
}

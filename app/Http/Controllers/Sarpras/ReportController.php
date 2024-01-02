<?php

namespace App\Http\Controllers\Sarpras;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Services\AlatService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(AlatService $service)
    {
        date_default_timezone_set('Asia/Singapore');
    }

    public function pengajuan(Request $request)
    {
        $data['title'] = "Laporan Pengajuan";
        return view('sarpras_templates/pages/report/pengajuan', $data);
    }
    public function data(Request $request)
    {
        $data['title']  = "Laporan Pengajuan";
        $data['data']   =  Submission::join('student_organizations', 'submissions.student_organizations_id', "=", 'student_organizations.id')
                            ->where('submissions.created_at', '>=', $request->dateStart)
                            ->where('submissions.created_at', '<=', $request->dateEnd)
                            ->select('submissions.code', 'submissions.status', 'submissions.created_at', 'student_organizations.name')
                            ->get();
        $data['start']   =  $request->dateStart;
        $data['end']     =  $request->dateEnd;
        // dd($data);
        return view('sarpras_templates/pages/report/pengajuan_data', $data);
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

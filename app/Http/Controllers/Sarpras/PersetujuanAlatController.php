<?php

namespace App\Http\Controllers\Sarpras;

use App\Http\Controllers\Controller;
use App\Models\ErrorTool;
use App\Models\Retur;
use App\Models\Submission;
use App\Models\Tool;
use App\Models\User;
use App\Services\PersetujuanAlatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PersetujuanAlatController extends controller
{
    private $persetujuanAlatService;
    private $table;

    private $days = [
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
        'Sat' => "Sabtu"
    ];
    // dd($days);
    private $month = [
        'Jan' => 'Januari',
        'Feb' => 'Februari',
        'Mar' => 'Maret',
        'Apr' => 'April',
        'May' => 'Mei',
        'Jun' => 'Juni',
        'Jul' => 'Juli',
        'Aug' => 'Agustus',
        'Sep' => 'September',
        'Oct' => 'Oktober',
        'Nov' => 'November',
        'Dec' => 'Desember'
    ];

    public function __construct(PersetujuanAlatService $service)
    {
        date_default_timezone_set('Asia/Singapore');
        $this->persetujuanAlatService = $service;
        $this->table = 'submissions';
    }

    public function index()
    {
        $data['title']          = 'Persetujuan Peminjaman Alat';
        $data['submissions']    = $this->persetujuanAlatService->joinDetailSubmissionsGetData($this->table);

        return view('sarpras_templates.pages.persetujuan.alat.index', $data);
    }

    public function show($id)
    {
        $data['title']                      = 'Persetujuan Peminjaman Alat';
        $data['detailSubmissions']          = $this->persetujuanAlatService->joinDetailSubmissions($this->table, $id);
        $data['tools']                      = $this->persetujuanAlatService->joinDetailSubmissionsAndTools($id);
        $data['chairman']                   = User::where('id', $data['detailSubmissions']->chairman)->first();
        $data['chairman_of_the_commitee']   = User::where('id', $data['detailSubmissions']->chairman_of_the_commitee)->first();
        $createdAt                          = explode("-", date('D-d-M-Y', strtotime($data['detailSubmissions']->created_at)));
        $startActivity                      = explode("-", date('D-d-M-Y', strtotime($data['detailSubmissions']->date_start)));
        $endActivity                        = explode("-", date('D-d-M-Y', strtotime($data['detailSubmissions']->date_end)));
        $data['bem']                        = User::where('role', 2)->first();
        $data['akademik']                   = User::where('role', 4)->first();
        $data['kemahasiswaan']              = User::where('role', 5)->first();

        $getMonthCreatedAt      = null;
        $getdayStartActivity    = null;
        $getMonthStartActivity  = null;
        $getdayEndActivity      = null;
        $getMonthEndActivity    = null;

        foreach ($this->month as $key => $value) {
            if ($key == $createdAt[2]) {
                $getMonthCreatedAt = $value;
            }
        }

        foreach ($this->days as $key => $value) {
            if ($key == $startActivity[0]) {
                $getdayStartActivity = $value;
            }
        }

        foreach ($this->month as $key => $value) {
            if ($key == $startActivity[2]) {
                $getMonthStartActivity = $value;
            }
        }

        foreach ($this->days as $key => $value) {
            if ($key == $endActivity[0]) {
                $getdayEndActivity = $value;
            }
        }

        foreach ($this->month as $key => $value) {
            if ($key == $endActivity[2]) {
                $getMonthEndActivity = $value;
            }
        }

        $data['dateCreatedAt']          = $createdAt[1] . " " . $getMonthCreatedAt . " " . $createdAt[3];

        $data['startDayActivity']       = $getdayStartActivity;
        $data['startDateActivity']      = $startActivity[1];
        $data['startMonthActivity']     = $getMonthStartActivity;
        $data['startYearActivity']      = $startActivity[3];

        $data['endDayActivity']       = $getdayEndActivity;
        $data['endDateActivity']      = $endActivity[1];
        $data['endMonthActivity']     = $getMonthEndActivity;
        $data['endYearActivity']      = $endActivity[3];

        return view('sarpras_templates.pages.persetujuan.alat.detailPersetujuan', $data);
    }

    public function edit($id)
    {
        $data['title']          = 'Pengembalian Alat';
        $data['submission']     = $this->persetujuanAlatService->getDataSubmission('submissions', $id);
        $data['submission_id']  = $id;
        $data['tools']          = $this->persetujuanAlatService->joinDetailSubmissionsAndTools($id);

        // dd($data);
        return view('sarpras_templates.pages.persetujuan.alat.pengembalianAlat', $data);
    }

    public function retur(Request $request, $id)
    {
        $request->validate(
            [
                'jumlah'    => 'required',
                'rusak'     => 'required',
            ],
            [
                'jumlah.required'   => 'Jumlah tidak boleh kosong',
                'rusak.required'    => 'Jumlah tidak boleh kosong'
            ]
        );

        $tool       = Tool::where('id', $request->tool_id)->first();
        $qtyRetur   = $tool->qty + $request->jumlah;

        Tool::where('id', $request->tool_id)->update(['qty' => $qtyRetur]);

        $dataRetur = [
            "qty"           => $request->jumlah,
            "status"        => "Kembali",
            "updated_by"    => Auth::user()->email,
            "updated_at"    => now()
        ];

        Retur::where('tools_id', $request->tool_id)->update($dataRetur);

        $dataError = [
            "qty"           => $request->rusak,
            "updated_by"    => Auth::user()->email,
            "updated_at"    => now()
        ];

        ErrorTool::where('tools_id', $request->tool_id)->update($dataError);

        return redirect('sarpras/persetujuan/alat/edit/' . $id)->with('message', 'Berhasil diperbaharui');;
    }
}

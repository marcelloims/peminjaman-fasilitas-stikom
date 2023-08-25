<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\DetailSubmissions;
use App\Models\Submission;
use App\Models\User;
use App\Services\PersetujuanAlatService;
use Illuminate\Http\Request;

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
        $this->persetujuanAlatService = $service;
        $this->table = 'submissions';
    }

    public function index()
    {
        $data['title']          = 'Persetujuan Peminjaman Alat';
        $data['submissions']    = $this->persetujuanAlatService->getData($this->table);

        return view('mahasiswa_templates.pages.persetujuan.alat.index', $data);
    }

    public function show($id)
    {
        $data['title']                      = 'Persetujuan Peminjaman Alat';
        $data['detailSubmissions']          = $this->persetujuanAlatService->joinDetailSubmissions($this->table, $id);
        $data['chairman']                   = User::where('id', $data['detailSubmissions']->chairman)->first();
        $data['chairman_of_the_commitee']   = User::where('id', $data['detailSubmissions']->chairman_of_the_commitee)->first();
        $createdAt                          = explode("-", date('D-d-M-Y', strtotime($data['detailSubmissions']->created_at)));
        $startActivity                      = explode("-", date('D-d-M-Y', strtotime($data['detailSubmissions']->date_start)));
        $endActivity                        = explode("-", date('D-d-M-Y', strtotime($data['detailSubmissions']->date_end)));
        $data['bem']                        = User::where('role', 2)->first();
        $data['akademik']                   = User::where('role', 4)->first();

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

        return view('mahasiswa_templates.pages.persetujuan.alat.detailPersetujuan', $data);
    }
}

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
        $data['title']                    = 'Persetujuan Peminjaman Alat';
        $data['detailSubmissions']        = $this->persetujuanAlatService->joinDetailSubmissions($this->table, $id);
        $data['chairman']                 = User::where('id', $data['detailSubmissions']->chairman)->first();
        $data['chairman_of_the_commitee'] = User::where('id', $data['detailSubmissions']->chairman_of_the_commitee)->first();
        $createdAt                        = explode("-", date('D-d-M-Y', strtotime($data['detailSubmissions']->created_at)));
        $startActivity                    = explode("-", date('D-d-M-Y', strtotime($data['detailSubmissions']->date_start)));
        $endActivity                      = explode("-", date('D-d-M-Y', strtotime($data['detailSubmissions']->date_end)));

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


        //created nomor surat
        // $referenceNumber = Submission::max('referenceNumber');
        // $letterMonth = date('m');

        // if ($letterMonth == '01') {
        //     $letterMonth = "I";
        // } elseif ($letterMonth == '02') {
        //     $letterMonth = "II";
        // } elseif ($letterMonth == '03') {
        //     $letterMonth = "III";
        // } elseif ($letterMonth == '04') {
        //     $letterMonth = "IV";
        // } elseif ($letterMonth == '05') {
        //     $letterMonth = "V";
        // } elseif ($letterMonth == '06') {
        //     $letterMonth = "VI";
        // } elseif ($letterMonth == '07') {
        //     $letterMonth = "VII";
        // } elseif ($letterMonth == '08') {
        //     $letterMonth = "VIII";
        // } elseif ($letterMonth == '09') {
        //     $letterMonth = "IX";
        // } elseif ($letterMonth == '10') {
        //     $letterMonth = "X";
        // } elseif ($letterMonth == '11') {
        //     $letterMonth = "XI";
        // } elseif ($letterMonth == '12') {
        //     $letterMonth = "XII";
        // }

        // $number =  substr($referenceNumber, 0, 3);
        // $data['referenceNumber']   = ((int)$number + 1 . '/' . $data['detailSubmissions']->name . '/BEM.ITBSTIKOM' . '/' . $letterMonth . '/' . date("Y"));
        // dd($data);
        return view('mahasiswa_templates.pages.persetujuan.alat.detailPersetujuan', $data);
    }
}

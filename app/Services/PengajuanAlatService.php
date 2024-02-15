<?php

namespace App\Services;

use App\Models\Submission;
use App\Models\User;
use App\Repositories\PengajuanAlatRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PengajuanAlatService
{
    private $pengajuanAlatRepository;

    public function __construct(PengajuanAlatRepository $repository)
    {
        $this->pengajuanAlatRepository = $repository;
    }

    public function getTotalCart()
    {
        return $this->pengajuanAlatRepository->getTotalCart();
    }

    public function addToCart($request, $id)
    {
        $request->validate(
            [
                'qty'   => 'required',
            ],
            [
                'qty.required' => 'Jumlah tidak boleh kosong'
            ]
        );

        return $this->pengajuanAlatRepository->addToCart($request, $id);
    }

    public function getTotalQuantity()
    {
        return $this->pengajuanAlatRepository->getTotalQuantity();
    }

    public function store($table, $request)
    {
        $request->validate(
            [
                'ketua_umum'                => 'required',
                'ketua_panitia'             => 'required',
                'nama_kegiatan'             => 'required',
                'tema'                      => 'required',
                'tanggal_kegiatan_mulai'    => 'required',
                'jam_mulai'                 => 'required',
                'tanggal_kegiatan_selesai'  => 'required',
                'jam_selesai'               => 'required',
                'ttd_1'                     => 'required',
                'ttd_2'                     => 'required',
            ],
            [
                'ketua_umum.required'                => 'Ketua Umum tidak boleh kosong!',
                'ketua_panitia.required'             => 'Ketua Panitia tidak boleh kosong!',
                'nama_kegiatan.required'             => 'Nama Kegiatan tidak boleh kosong!',
                'tema.required'                      => 'Tema tidak boleh kosong!',
                'tanggal_kegiatan_mulai.required'    => 'Tanggal Mulai Kegiatan tidak boleh kosong!',
                'jam_mulai.required'                 => 'Jam Mulai tidak boleh kosong!',
                'tanggal_kegiatan_selesai.required'  => 'Tanggal Selesai Kegiatan tidak boleh kosong!',
                'jam_selesai.required'               => 'Jam Selsai tidak boleh kosong!',
            ]
        );

        $submissionId   = Submission::max('id') + 1;
        $userUKM        = User::join('student_organizations', 'users.student_organizations_id', '=', 'student_organizations.id')
            ->where('users.id', Auth::user()->id)
            ->select('student_organizations.name')
            ->first();

        $dateNow = explode("-", date('M-Y'));
        $month = [
            'Jan' => 'I',
            'Feb' => 'II',
            'Mar' => 'II',
            'Apr' => 'IV',
            'May' => 'V',
            'Jun' => 'VI',
            'Jul' => 'VII',
            'Aug' => 'VIII',
            'Sep' => 'IX',
            'Oct' => 'X',
            'Nov' => 'XI',
            'Dec' => 'XII'
        ];

        $getMonthRoman = null;

        foreach ($month as $key => $value) {
            if ($key == $dateNow[0]) {
                $getMonthRoman = $value;
            }
        }

        $code = $submissionId . "/" . $userUKM->name . "/" . "BEM ITBSTIKOM Bali" . "/" . $getMonthRoman . "/" . $dateNow[1];

        $submission = [
            'code'                      => $code,
            'users_id'                  => Auth::user()->id,
            'student_organizations_id'  => Auth::user()->student_organizations_id,
            'chairman'                  => $request->ketua_umum,
            'ttd_1'                     => $request->ttd_1,
            'chairman_of_the_commitee'  => $request->ketua_panitia,
            'ttd_2'                     => $request->ttd_2,
            'name_of_activity'          => $request->nama_kegiatan,
            'theme'                     => $request->tema,
            'date_start'                => date('Y-m-d', strtotime($request->tanggal_kegiatan_mulai)) . " " . $request->jam_mulai,
            'date_end'                  => date('Y-m-d', strtotime($request->tanggal_kegiatan_selesai)) . " " . $request->jam_selesai,
            'category'                  => 1,
            'assign_2'                  => null,
            'assign_4'                  => null,
            'assign_5'                  => null,
            'status'                    => 'Tertunda',
            'created_by'                => Auth::user()->email,
            'updated_by'                => Auth::user()->email,
            'created_at'                => now(),
            'updated_at'                => now()
        ];

        if ($request->hasFile('ttd_1')) {
            $request->ttd_1->move('signature', $request->file('ttd_1')->getClientOriginalName());
            $submission['ttd_1'] = $request->file('ttd_1')->getClientOriginalName();
        }

        if ($request->hasFile('ttd_2')) {
            $request->ttd_2->move('signature', $request->file('ttd_2')->getClientOriginalName());
            $submission['ttd_2'] = $request->file('ttd_2')->getClientOriginalName();
        }

        return $this->pengajuanAlatRepository->store($table, $submission);
    }

    public function storeAula($table, $request)
    {

        // $request->validate(
        //     [
        //         'ketua_umum'                => 'required',
        //         'ketua_panitia'             => 'required',
        //         'nama_kegiatan'             => 'required',
        //         'tema'                      => 'required',
        //         'tanggal_kegiatan_mulai'    => 'required',
        //         'jam_mulai'                 => 'required',
        //         'tanggal_kegiatan_selesai'  => 'required',
        //         'jam_selesai'               => 'required'
        //     ],
        //     [
        //         'ketua_umum.required'                => 'Ketua Umum tidak boleh kosong!',
        //         'ketua_panitia.required'             => 'Ketua Panitia tidak boleh kosong!',
        //         'nama_kegiatan.required'             => 'Nama Kegiatan tidak boleh kosong!',
        //         'tema.required'                      => 'Tema tidak boleh kosong!',
        //         'tanggal_kegiatan_mulai.required'    => 'Tanggal Mulai Kegiatan tidak boleh kosong!',
        //         'jam_mulai.required'                 => 'Jam Mulai tidak boleh kosong!',
        //         'tanggal_kegiatan_selesai.required'  => 'Tanggal Selesai Kegiatan tidak boleh kosong!',
        //         'jam_selesai.required'               => 'Jam Selsai tidak boleh kosong!',
        //     ]
        // );

        // $submissionId   = Submission::max('id') + 1;
        // $userUKM        = User::join('student_organizations', 'users.student_organizations_id', '=', 'student_organizations.id')
        //     ->where('users.id', Auth::user()->id)
        //     ->select('student_organizations.name')
        //     ->first();

        // $dateNow = explode("-", date('M-Y'));
        // $month = [
        //     'Jan' => 'I',
        //     'Feb' => 'II',
        //     'Mar' => 'II',
        //     'Apr' => 'IV',
        //     'May' => 'V',
        //     'Jun' => 'VI',
        //     'Jul' => 'VII',
        //     'Aug' => 'VIII',
        //     'Sep' => 'IX',
        //     'Oct' => 'X',
        //     'Nov' => 'XI',
        //     'Dec' => 'XII'
        // ];

        // $getMonthRoman = null;

        // foreach ($month as $key => $value) {
        //     if ($key == $dateNow[0]) {
        //         $getMonthRoman = $value;
        //     }
        // }

        // $code = $submissionId . "/" . $userUKM->name . "/" . "BEM ITBSTIKOM Bali" . "/" . $getMonthRoman . "/" . $dateNow[1];

        // $submission = [
        //     'code'                      => $code,
        //     'users_id'                  => Auth::user()->id,
        //     'student_organizations_id'  => Auth::user()->student_organizations_id,
        //     'chairman'                  => $request->ketua_umum,
        //     'chairman_of_the_commitee'  => $request->ketua_panitia,
        //     'name_of_activity'          => $request->nama_kegiatan,
        //     'theme'                     => $request->tema,
        //     'date_start'                => date('Y-m-d', strtotime($request->tanggal_kegiatan_mulai)) . " " . $request->jam_mulai,
        //     'date_end'                  => date('Y-m-d', strtotime($request->tanggal_kegiatan_selesai)) . " " . $request->jam_selesai,
        //     'category'                  => 2,
        //     'assign_2'                  => null,
        //     'assign_4'                  => null,
        //     'assign_5'                  => null,
        //     'status'                    => 'Tertunda',
        //     'created_by'                => Auth::user()->email,
        //     'updated_by'                => Auth::user()->email,
        //     'created_at'                => now(),
        //     'updated_at'                => now()
        // ];

        // return $this->pengajuanAlatRepository->storeAula($table, $submission);
    }
}

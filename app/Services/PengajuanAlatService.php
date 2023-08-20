<?php

namespace App\Services;

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
                'jam_selesai'               => 'required'
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

        $submission = [
            'users_id'                  => Auth::user()->id,
            'student_organizations_id'  => Auth::user()->student_organizations_id,
            'chairman'                  => $request->ketua_umum,
            'chairman_of_the_commitee'  => $request->ketua_panitia,
            'academic_student_affairs'  => null,
            'coordinator_academic'      => null,
            'student_executive_board'   => null,
            'name_of_activity'          => $request->nama_kegiatan,
            'theme'                     => $request->tema,
            'date_start'                => date('Y-m-d', strtotime($request->tanggal_kegiatan_mulai)) . " " . $request->jam_mulai,
            'date_end'                  => date('Y-m-d', strtotime($request->tanggal_kegiatan_selesai)) . " " . $request->jam_selesai,
            'category'                  => 1,
            'created_by'                => Auth::user()->email,
            'updated_by'                => Auth::user()->email,
            'created_at'                => now(),
            'updated_at'                => now()
        ];

        // dd($submission);
        // $carts  = \Cart::getContent();
        // foreach ($carts as $cart) {
        //     $detailSubmission = [
        //         "submissions_id"    =>
        //         "tools_id"          => $cart->id,
        //         "qty"               => $cart->quantity,
        //         "created_by"        => Auth::user()->email,
        //         "updated_by"        => Auth::user()->email,
        //         "created_at"        => now(),
        //         "updated_at"        => now()
        //     ];
        // }



        return $this->pengajuanAlatRepository->store($table, $submission);
    }
}

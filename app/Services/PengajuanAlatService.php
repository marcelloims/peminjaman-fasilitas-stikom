<?php

namespace App\Services;

use App\Repositories\PengajuanAlatRepository;
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

        return $this->pengajuanAlatRepository->addToCart($request,$id);
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
                'kategori'                  => 'required',
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
                'kategori.required'                  => 'Kategori tidak boleh kosong!',
                'jam_selesai.required'               => 'Jam Selsai tidak boleh kosong!',
            ]
        );

        $dataSubmission = [
            'users_id'                  => Auth::user()->id,
            'student_organizations_id'  => Auth::user()->student_organizations_id,
            'detail_submissions_id'     => null,
            'chairman'                  => $request->ketua_umum,
            'chairman_of_the_commitee'  => $request->ketua_panitia,
            'academic_student_affairs'  => null,
            'coordinator_academic'      => null,
            'student_executive_board'   => null,
            'name_of_activity'          => $request->nama_kegiatan,
            'theme'                     => $request->tema,
            'date_start'                => $request->tanggal_kegiatan_mulai,
            'date_end'                  => $request->tanggal_kegiatan_selesai,
            'category'                  => $request->kategori,
            'created_by'                => Auth::user()->email,
            'updated_by'                => Auth::user()->email,
            'created_at'                => now(),
            'updated_at'                => now()
        ];
        dd($dataSubmission);
        return $this->pengajuanAlatRepository->store($dataSubmission);
    }
}

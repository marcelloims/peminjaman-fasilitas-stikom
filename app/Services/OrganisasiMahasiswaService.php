<?php

namespace App\Services;

use App\Repositories\OrganisasiMahasiswaRepository;
use Illuminate\Support\Facades\Auth;

class OrganisasiMahasiswaService
{
    private $organisasiMahasiswaRepository;

    public function __construct(OrganisasiMahasiswaRepository $repository)
    {
        $this->organisasiMahasiswaRepository = $repository;
    }

    public function getData($table, $id)
    {
        return $this->organisasiMahasiswaRepository->getData($table, $id);
    }

    public function store($table, $request)
    {
        $request->validate(
            [
                'nama'      => 'required',
                'status'    => 'required'
            ],
            [
                'nama.required'      => 'Nama tidak boleh kosong',
                'status.required'    => 'Status tidak boleh kosong',
            ]
        );

        $data = [
            'name'          => $request->nama,
            'status'        => $request->status,
            'created_by'    => Auth::user()->email,
            'updated_by'    => Auth::user()->email,
            'created_at'    => now(),
            'updated_at'    => now()
        ];

        return $this->organisasiMahasiswaRepository->store($table, $data);
    }

    public function update($table, $request, $id)
    {
        $request->validate(
            [
                'nama'      => 'required',
                'status'    => 'required'
            ],
            [
                'nama.required'      => 'Nama tidak boleh kosong',
                'status.required'    => 'Status tidak boleh kosong',
            ]
        );

        $data = [
            'name'          => $request->nama,
            'status'        => $request->status,
            "updated_by"    => Auth::user()->email,
            "updated_at"    => now()
        ];

        return $this->organisasiMahasiswaRepository->update($table, $id, $data);
    }

    public function delete($table, $id)
    {
        return $this->organisasiMahasiswaRepository->delete($table, $id);
    }

    public function softDelete($table, $id)
    {
        $data = [
            'deleted_by' => Auth::user()->email,
            'deleted_at' => now()
        ];

        return $this->organisasiMahasiswaRepository->softDelete($table, $id, $data);
    }

    public function getTrashed($table, $id)
    {
        return $this->organisasiMahasiswaRepository->getTrashed($table, $id);
    }

    public function restore($table, $id)
    {
        $data = [
            'deleted_by'    => null,
            'deleted_at'    => null
        ];

        return $this->organisasiMahasiswaRepository->restore($table, $id, $data);
    }
}

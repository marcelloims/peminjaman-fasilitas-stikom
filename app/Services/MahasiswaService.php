<?php

namespace App\Services;

use App\Repositories\MahasiswaRepository;
use Illuminate\Support\Facades\Auth;

class MahasiswaService
{
    private $mahasiswaRepository;

    public function __construct(MahasiswaRepository $repository)
    {
        $this->mahasiswaRepository = $repository;
    }

    public function getData($table, $id)
    {
        return $this->mahasiswaRepository->getData($table, $id);
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

        return $this->mahasiswaRepository->store($table, $data);
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

        return $this->mahasiswaRepository->update($table, $id, $data);
    }

    public function delete($table, $id)
    {
        return $this->mahasiswaRepository->delete($table, $id);
    }

    public function softDelete($table, $id)
    {
        $data = [
            'deleted_by' => Auth::user()->email,
            'deleted_at' => now()
        ];

        return $this->mahasiswaRepository->softDelete($table, $id, $data);
    }

    public function getTrashed($table, $id)
    {
        return $this->mahasiswaRepository->getTrashed($table, $id);
    }

    public function restore($table, $id)
    {
        $data = [
            'deleted_by'    => null,
            'deleted_at'    => null
        ];

        return $this->mahasiswaRepository->restore($table, $id, $data);
    }
}

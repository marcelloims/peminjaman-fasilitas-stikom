<?php

namespace App\Services;

use App\Repositories\AlatRepository;
use Illuminate\Support\Facades\Auth;

class AlatService
{
    private $alatRepository;

    public function __construct(AlatRepository $repository)
    {
        $this->alatRepository = $repository;
    }

    public function getData($table, $id)
    {
        return $this->alatRepository->getData($table, $id);
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

        return $this->alatRepository->store($table, $data);
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

        return $this->alatRepository->update($table, $id, $data);
    }

    public function delete($table, $id)
    {
        return $this->alatRepository->delete($table, $id);
    }

    public function softDelete($table, $id)
    {
        $data = [
            'deleted_by' => Auth::user()->email,
            'deleted_at' => now()
        ];

        return $this->alatRepository->softDelete($table, $id, $data);
    }

    public function getTrashed($table, $id)
    {
        return $this->alatRepository->getTrashed($table, $id);
    }

    public function restore($table, $id)
    {
        $data = [
            'deleted_by'    => null,
            'deleted_at'    => null
        ];

        return $this->alatRepository->restore($table, $id, $data);
    }
}

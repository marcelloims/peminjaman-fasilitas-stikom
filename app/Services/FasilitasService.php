<?php

namespace App\Services;

use App\Repositories\FasilitasRepository;
use Illuminate\Support\Facades\Auth;

class FasilitasService
{
    private $fasilitasRepository;

    public function __construct(FasilitasRepository $repository)
    {
        $this->fasilitasRepository = $repository;
    }

    public function getData($table, $id)
    {
        return $this->fasilitasRepository->getData($table, $id);
    }

    public function store($table, $request)
    {
        $request->validate(
            [
                'kode'    => 'required',
                'status'  => 'required',
            ],
            [
                'kode.required'     => 'Kode tidak boleh kosong',
                'status.required'   => 'Status tidak boleh kosong',
            ]
        );

        $data = [
            'code'          => $request->kode,
            'status'        => $request->status,
            'created_by'    => Auth::user()->email,
            'updated_by'    => Auth::user()->email,
            'created_at'    => now(),
            'updated_at'    => now()
        ];

        return $this->fasilitasRepository->store($table, $data);
    }

    public function update($table, $request, $id)
    {
        $request->validate(
            [
                'kode'    => 'required',
                'status'  => 'required',
            ],
            [
                'kode.required'     => 'Kode tidak boleh kosong',
                'status.required'   => 'Status tidak boleh kosong',
            ]
        );

        $data = [
            'code'          => $request->kode,
            'status'        => $request->status,
            'updated_by'    => Auth::user()->email,
            'updated_at'    => now()
        ];

        return $this->fasilitasRepository->update($table, $id, $data);
    }

    public function delete($table, $id)
    {
        return $this->fasilitasRepository->delete($table, $id);
    }

    public function softDelete($table, $id)
    {
        $data = [
            'deleted_by' => Auth::user()->email,
            'deleted_at' => now()
        ];

        return $this->fasilitasRepository->softDelete($table, $id, $data);
    }

    public function getTrashed($table, $id)
    {
        return $this->fasilitasRepository->getTrashed($table, $id);
    }

    public function restore($table, $id)
    {
        $data = [
            'deleted_by'    => null,
            'deleted_at'    => null
        ];

        return $this->fasilitasRepository->restore($table, $id, $data);
    }
}

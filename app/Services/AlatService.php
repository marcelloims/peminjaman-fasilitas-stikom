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

    public function getToolOnly($table)
    {
        return $this->alatRepository->getToolOnly($table);
    }

    public function getDataByRequest($table, $id)
    {
        return $this->alatRepository->getDataByRequest($table, $id);
    }

    public function store($table, $request)
    {
        $request->validate(
            [
                'nama'      => 'required',
                'kategori'  => 'required',
                'jenis'     => 'required',
                'jumlah'    => 'required|min:1',
                'gambar'    => 'required'
            ],
            [
                'nama.required'      => 'Nama tidak boleh kosong',
                'kategori.required'  => 'Kategori tidak boleh kosong',
                'jenis.required'     => 'Jenis tidak boleh kosong',
                'jumlah.required'    => 'Jumlah tidak boleh kosong',
                'gambar.required'    => 'Gambar tidak boleh kosong'
            ]
        );

        $data = [
            'facilities_id' => $request->fasilitas_id,
            'code'          => $request->kode,
            'name'          => $request->nama,
            'category'      => $request->kategori,
            'type'          => $request->jenis,
            'qty'           => $request->jumlah,
            'image'         => $request->gambar,
            'created_by'    => Auth::user()->email,
            'updated_by'    => Auth::user()->email,
            'created_at'    => now(),
            'updated_at'    => now()
        ];


        if ($request->hasFile('gambar')) {
            $request->gambar->move('logo_ukm', $request->file('gambar')->getClientOriginalName());
            $data['image'] = $request->file('gambar')->getClientOriginalName();
        }

        return $this->alatRepository->store($table, $data);
    }

    public function update($table, $request, $id)
    {
        $request->validate(
            [
                'nama'      => 'required',
                'jenis'     => 'required',
                'jumlah'    => 'required|min:1'
            ],
            [
                'nama.required'      => 'Nama tidak boleh kosong',
                'jenis.required'     => 'Jenis tidak boleh kosong',
                'jumlah.required'    => 'Jumlah tidak boleh kosong'
            ]
        );

        $data = [
            'facilities_id' => $request->fasilitas_id,
            'code'          => $request->kode,
            'name'          => $request->nama,
            'category'      => $request->kategori,
            'type'          => $request->jenis,
            'qty'           => $request->jumlah,
            'image'         => $request->gambar,
            'updated_by'    => Auth::user()->email,
            'updated_at'    => now()
        ];

        if ($request->hasFile('gambar')) {
            $request->gambar->move('logo_ukm', $request->file('gambar')->getClientOriginalName());
            $data['image'] = $request->file('gambar')->getClientOriginalName();
        } else {
            unset($data['image']);
        }

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

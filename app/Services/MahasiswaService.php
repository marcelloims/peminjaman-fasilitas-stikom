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

    public function getDataByCondition($table, $where)
    {
        return $this->mahasiswaRepository->getDataByCondition($table, $where);
    }

    public function getDataByConditionJoin($table, $where)
    {
        return $this->mahasiswaRepository->getDataByConditionJoin($table, $where);
    }

    public function store($table, $request)
    {
        $request->validate(
            [
                'nama'          => 'required',
                'telepon'       => 'required',
                'email'         => 'required|email',
                'organisasi'    => 'required',
                'ttd'           => 'required',
                'kategori'      => 'required',
                'status'        => 'required'
            ],
            [
                'nama.required'         => 'Nama tidak boleh kosong!',
                'telepon.required'      => 'Telepon tidak boleh kosong!',
                'email.required'        => 'Email tidak boleh kosong!',
                'organisasi.required'   => 'Organisasi tidak boleh kosong!',
                'ttd.required'          => 'Tandang Tangan tidak boleh kosong!',
                'kategori.required'     => 'Kategori tidak boleh kosong!',
                'status.required'       => 'Status tidak boleh kosong!'
            ]
        );

        $data = [
            'name'                      => $request->nama,
            'telephone'                 => $request->telepon,
            'email'                     => $request->email,
            'password'                  => bcrypt('password'),
            'student_organizations_id'  => $request->organisasi,
            'category'                  => $request->kategori,
            'status'                    => $request->status,
            'signature'                 => $request->ttd,
            'role'                      => 3,
            'created_by'                => Auth::user()->email,
            'updated_by'                => Auth::user()->email,
            'created_at'                => now(),
            'updated_at'                => now()
        ];

        if ($request->hasFile('ttd')) {
            $request->ttd->move('signature', $request->file('ttd')->getClientOriginalName());
            $data['signature'] = $request->file('ttd')->getClientOriginalName();
        }

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

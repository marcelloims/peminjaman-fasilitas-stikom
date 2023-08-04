<?php

namespace App\Http\Controllers\Sarpras;

use App\Http\Controllers\Controller;
use App\Services\MahasiswaService;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    private $mahasiswaSerivce;
    private $table;

    public function __construct(MahasiswaService $service)
    {
        date_default_timezone_set('Asia/Singapore');
        $this->mahasiswaSerivce = $service;
        $this->table = 'users';
    }

    public function index($id = null)
    {
        $data['title'] = 'Mahasiswa';
        $data['datas'] = $this->mahasiswaSerivce->getData($this->table, $id);

        return view('sarpras_templates.pages.mahasiswa.index', $data);
    }

    public function store(Request $request)
    {
        $this->mahasiswaSerivce->store($this->table, $request);

        return redirect('sarpras/organisasi-mahasiswa')->with('message', 'Berhasil disimpan');
    }

    public function show($id)
    {
        $data['title'] = 'Mahasiswa';
        $data['ukm'] = $this->mahasiswaSerivce->getData($this->table, $id);

        return view('sarpras_templates.pages.detail', $data);
    }

    public function edit($id)
    {
        $data['title']  = 'Mahasiswa';
        $data['ukm']    = $this->mahasiswaSerivce->getData($this->table, $id);
        $data['status'] = ['Aktif', 'Non-Aktif'];

        return view('sarpras_templates.pages.mahasiswa.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->mahasiswaSerivce->update($this->table, $request, $id);

        return redirect('sarpras/organisasi-mahasiswa')->with('message', 'Berhasil diperbaharui');
    }

    public function delete($id)
    {
        $this->mahasiswaSerivce->delete($this->table, $id);

        return redirect('sarpras/organisasi-mahasiswa')->with('message', 'Has been deleted permanent');
    }

    public function softDelete($id)
    {
        $this->mahasiswaSerivce->softDelete($this->table, $id);
        return redirect('sarpras/organisasi-mahasiswa')->with('message', 'Berhasil dihapus');
    }

    public function trashed($id = null)
    {
        $data['title'] = 'Mahasiswa';
        $data['Mahasiswas'] = $this->mahasiswaSerivce->getTrashed($this->table, $id);

        return view('sarpras/organisasi-mahasiswa', $data);
    }

    public function restore($id)
    {
        $this->mahasiswaSerivce->restore($this->table, $id);
        return redirect('sarpras/organisasi-mahasiswa/trashed')->with('message', 'Has been deleted');
    }
}

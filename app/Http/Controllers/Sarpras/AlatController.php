<?php

namespace App\Http\Controllers\Sarpras;

use App\Http\Controllers\Controller;
use App\Services\AlatService;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    private $alatService;
    private $table;

    public function __construct(AlatService $service)
    {
        date_default_timezone_set('Asia/Singapore');
        $this->alatService = $service;
        $this->table = 'tools';
    }

    public function index($id = null)
    {
        $data['title']  = 'Alat-alat';
        $data['datas']  = $this->alatService->getData($this->table, $id);
        $kode           = substr($data['datas']->max('code'), 5);
        $data['kode']   = (int)$kode + 1;

        return view('sarpras_templates.pages.alat.index', $data);
    }

    public function store(Request $request)
    {
        $this->alatService->store($this->table, $request);

        return redirect('sarpras/alat')->with('message', 'Berhasil disimpan');
    }

    public function edit($id)
    {
        $data['title']  = 'Alat-alat';
        $data['data']    = $this->alatService->getData($this->table, $id);

        return view('sarpras_templates.pages.alat.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->alatService->update($this->table, $request, $id);

        return redirect('sarpras/alat')->with('message', 'Berhasil diperbaharui');
    }

    public function delete($id)
    {
        $this->alatService->delete($this->table, $id);

        return redirect('sarpras/organisasi-mahasiswa')->with('message', 'Has been deleted permanent');
    }

    public function softDelete($id)
    {
        $this->alatService->softDelete($this->table, $id);
        return redirect('sarpras/alat')->with('message', 'Berhasil dihapus');
    }

    public function trashed($id = null)
    {
        $data['title'] = 'Alat-alat';
        $data['ukm'] = $this->alatService->getTrashed($this->table, $id);

        return view('sarpras/organisasi-mahasiswa', $data);
    }

    public function restore($id)
    {
        $this->alatService->restore($this->table, $id);
        return redirect('sarpras/organisasi-mahasiswa/trashed')->with('message', 'Has been deleted');
    }
}

<?php

namespace App\Http\Controllers\Sarpras;

use App\Http\Controllers\Controller;
use App\Services\AlatService;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    private $alatRepository;
    private $table;

    public function __construct(AlatService $service)
    {
        date_default_timezone_set('Asia/Singapore');
        $this->alatRepository = $service;
        $this->table = 'tools';
    }

    public function index($id = null)
    {
        $data['title'] = 'Organisasi Mahasiswa';
        $data['ukms'] = $this->alatRepository->getData($this->table, $id);

        return view('sarpras_templates.pages.oraganisasi_mahasiswa.index', $data);
    }

    public function store(Request $request)
    {
        $this->alatRepository->store($this->table, $request);

        return redirect('sarpras/organisasi-mahasiswa')->with('message', 'Berhasil disimpan');
    }

    public function show($id)
    {
        $data['title'] = 'Organisasi Mahasiswa';
        $data['ukm'] = $this->alatRepository->getData($this->table, $id);

        return view('sarpras_templates.pages.detail', $data);
    }

    public function edit($id)
    {
        $data['title']  = 'Organisasi Mahasiswa';
        $data['ukm']    = $this->alatRepository->getData($this->table, $id);
        $data['status'] = ['Aktif', 'Non-Aktif'];

        return view('sarpras_templates.pages.oraganisasi_mahasiswa.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->alatRepository->update($this->table, $request, $id);

        return redirect('sarpras/organisasi-mahasiswa')->with('message', 'Berhasil diperbaharui');
    }

    public function delete($id)
    {
        $this->alatRepository->delete($this->table, $id);

        return redirect('sarpras/organisasi-mahasiswa')->with('message', 'Has been deleted permanent');
    }

    public function softDelete($id)
    {
        $this->alatRepository->softDelete($this->table, $id);
        return redirect('sarpras/organisasi-mahasiswa')->with('message', 'Berhasil dihapus');
    }

    public function trashed($id = null)
    {
        $data['title'] = 'Organisasi Mahasiswa';
        $data['ukm'] = $this->alatRepository->getTrashed($this->table, $id);

        return view('sarpras/organisasi-mahasiswa', $data);
    }

    public function restore($id)
    {
        $this->alatRepository->restore($this->table, $id);
        return redirect('sarpras/organisasi-mahasiswa/trashed')->with('message', 'Has been deleted');
    }
}

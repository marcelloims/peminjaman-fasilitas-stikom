<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Services\OrganisasiMahasiswaService;
use Illuminate\Http\Request;

class OrganisasiMahasiswaController extends Controller
{
    private $organisasiMahasiswaSerivce;
    private $table;

    public function __construct(OrganisasiMahasiswaService $service)
    {
        date_default_timezone_set('Asia/Singapore');
        $this->organisasiMahasiswaSerivce = $service;
        $this->table = 'student_organizations';
    }

    public function index($id = null)
    {
        $data['title'] = 'Organisasi Mahasiswa';
        $data['ukms'] = $this->organisasiMahasiswaSerivce->getData($this->table, $id);

        return view('mahasiswa_templates.pages.oraganisasi_mahasiswa.index', $data);
    }

    public function store(Request $request)
    {
        $this->organisasiMahasiswaSerivce->store($this->table, $request);

        return redirect('mahasiswa/organisasi-mahasiswa')->with('message', 'Berhasil disimpan');
    }

    public function show($id)
    {
        $data['title'] = 'Organisasi Mahasiswa';
        $data['ukm'] = $this->organisasiMahasiswaSerivce->getData($this->table, $id);

        return view('mahasiswa_templates.pages.detail', $data);
    }

    public function edit($id)
    {
        $data['title']  = 'Organisasi Mahasiswa';
        $data['ukm']    = $this->organisasiMahasiswaSerivce->getData($this->table, $id);
        $data['status'] = ['Aktif', 'Non-Aktif'];

        return view('mahasiswa_templates.pages.oraganisasi_mahasiswa.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->organisasiMahasiswaSerivce->update($this->table, $request, $id);

        return redirect('mahasiswa/organisasi-mahasiswa')->with('message', 'Berhasil diperbaharui');
    }

    public function delete($id)
    {
        $this->organisasiMahasiswaSerivce->delete($this->table, $id);

        return redirect('mahasiswa/organisasi-mahasiswa')->with('message', 'Has been deleted permanent');
    }

    public function softDelete($id)
    {
        $this->organisasiMahasiswaSerivce->softDelete($this->table, $id);
        return redirect('mahasiswa/organisasi-mahasiswa')->with('message', 'Berhasil dihapus');
    }

    public function trashed($id = null)
    {
        $data['title'] = 'Organisasi Mahasiswa';
        $data['ukm'] = $this->organisasiMahasiswaSerivce->getTrashed($this->table, $id);

        return view('mahasiswa/organisasi-mahasiswa', $data);
    }

    public function restore($id)
    {
        $this->organisasiMahasiswaSerivce->restore($this->table, $id);
        return redirect('mahasiswa/organisasi-mahasiswa/trashed')->with('message', 'Has been deleted');
    }
}

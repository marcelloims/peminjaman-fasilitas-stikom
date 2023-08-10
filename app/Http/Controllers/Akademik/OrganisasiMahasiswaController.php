<?php

namespace App\Http\Controllers\Akademik;

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

        return view('akademik_kemahasiswaan_templates.pages.oraganisasi_mahasiswa.index', $data);
    }

    public function store(Request $request)
    {
        $this->organisasiMahasiswaSerivce->store($this->table, $request);

        return redirect('akademik_kemahasiswaan/organisasi-mahasiswa')->with('message', 'Berhasil disimpan');
    }

    public function edit($id)
    {
        $data['title']  = 'Organisasi Mahasiswa';
        $data['ukm']    = $this->organisasiMahasiswaSerivce->getData($this->table, $id);
        $data['status'] = ['Aktif', 'Non-Aktif'];

        return view('akademik_kemahasiswaan_templates.pages.oraganisasi_mahasiswa.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->organisasiMahasiswaSerivce->update($this->table, $request, $id);

        return redirect('akademik_kemahasiswaan/organisasi-mahasiswa')->with('message', 'Berhasil diperbaharui');
    }

    public function softDelete($id)
    {
        $this->organisasiMahasiswaSerivce->softDelete($this->table, $id);
        return redirect('akademik_kemahasiswaan/organisasi-mahasiswa')->with('message', 'Berhasil dihapus');
    }
}

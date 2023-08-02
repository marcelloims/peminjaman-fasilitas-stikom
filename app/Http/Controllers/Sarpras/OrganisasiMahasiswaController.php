<?php

namespace App\Http\Controllers\sarpras;

use App\Http\Controllers\Controller;
use App\Services\OrganisasiMahasiswaService;
use Illuminate\Http\Request;

class OrganisasiMahasiswaController extends Controller
{
    private $organisasiMahasiswaSerivce;
    private $table;

    public function __construct(OrganisasiMahasiswaService $service)
    {
        $this->organisasiMahasiswaSerivce = $service;
        $this->table = 'tb_organisasi_mahasiswa';
    }

    public function index($id = null)
    {
        $data['title'] = 'Organisasi Mahasiswa';

        return view('sarpras_templates.pages.organisasi_mahasiswa', $data);
    }
}

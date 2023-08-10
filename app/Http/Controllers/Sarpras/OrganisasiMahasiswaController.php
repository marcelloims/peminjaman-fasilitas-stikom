<?php

namespace App\Http\Controllers\Sarpras;

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

        return view('sarpras_templates.pages.oraganisasi_mahasiswa.index', $data);
    }
}

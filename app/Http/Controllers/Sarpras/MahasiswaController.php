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

    public function show($id)
    {
        $data['title'] = 'Mahasiswa';
        $data['data'] = $this->mahasiswaSerivce->getData($this->table, $id);

        return view('sarpras_templates.pages.mahasiswa.detail', $data);
    }
}

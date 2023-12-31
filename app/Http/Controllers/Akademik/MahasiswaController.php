<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\MahasiswaService;
use App\Services\OrganisasiMahasiswaService;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    private $mahasiswaSerivce;
    private $organisasiMahasiswa;
    private $table;

    public function __construct(
        MahasiswaService $service,
        OrganisasiMahasiswaService $ukm
    ) {
        date_default_timezone_set('Asia/Singapore');
        $this->mahasiswaSerivce = $service;
        $this->table = 'users';
    }

    public function index($id = null)
    {
        $data['title']  = 'Mahasiswa';
        $where = ['role' => 3];
        $data['datas']  = $this->mahasiswaSerivce->getDataByCondition($this->table, $where);
        $data['ukms']   = $this->mahasiswaSerivce->getData('student_organizations', $id);

        return view('akademik_kemahasiswaan_templates.pages.mahasiswa.index', $data);
    }

    public function store(Request $request)
    {
        $this->mahasiswaSerivce->store($this->table, $request);

        return redirect('akademik_kemahasiswaan/mahasiswa')->with('message', 'Berhasil disimpan');
    }

    public function show($id)
    {
        $data['title'] = 'Mahasiswa';
        $data['data'] =
            User::join('student_organizations', 'users.student_organizations_id', 'student_organizations.id')
            ->select('users.*', 'student_organizations.name as ukm_name')
            ->where('users.id', $id)
            ->first();

        return view('akademik_kemahasiswaan_templates.pages.mahasiswa.detail', $data);
    }
}

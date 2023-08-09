<?php

namespace App\Http\Controllers\Sarpras;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        $data['title'] = 'Mahasiswa';;
        $data['datas'] = User::where('role', 3)->get();

        return view('sarpras_templates.pages.mahasiswa.index', $data);
    }

    public function show($id)
    {
        $data['title'] = 'Mahasiswa';
        $data['data'] =
            User::join('student_organizations', 'users.student_organizations_id', 'student_organizations.id')
            ->select('users.*', 'student_organizations.name as ukm_name')
            ->where('users.id', $id)
            ->first();
        return view('sarpras_templates.pages.mahasiswa.detail', $data);
    }
}

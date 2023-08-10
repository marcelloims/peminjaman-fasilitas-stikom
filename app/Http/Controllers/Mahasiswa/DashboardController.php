<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $dashboardService;
    private $table;

    public function __construct(DashboardService $service)
    {
        $this->dashboardService = $service;
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        return view('mahasiswa_templates.pages.dashboard', $data);
    }
}

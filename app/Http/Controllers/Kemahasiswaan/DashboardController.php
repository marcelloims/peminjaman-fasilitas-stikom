<?php

namespace App\Http\Controllers\Kemahasiswaan;

use App\Http\Controllers\Controller;
use App\Models\StudentOrganization;
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
        $data['ukms']   = StudentOrganization::with('submissions')->get();
        return view('kemahasiswaan_templates.pages.dashboard', $data);
    }

    public function ukm()
    {
        $data = StudentOrganization::with('submissions')->get();

        $ukm = [];


        foreach ($data as $item) {
            $ukm[] = [
                'name'  => $item->name,
                'total' => $item->submissions->count()
            ];
        }

        echo json_encode($ukm);
    }
}

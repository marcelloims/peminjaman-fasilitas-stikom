<?php

namespace App\Services;

use App\Repositories\DashboardRepository;

class DashboardService
{
    private $dashboardRepository;

    public function __construct(DashboardRepository $repository)
    {
        $this->dashboardRepository = $repository;
    }
}

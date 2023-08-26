<?php

namespace App\Services;

use App\Repositories\PersetujuanAlatRepository;
use Illuminate\Support\Facades\Auth;

class PersetujuanAlatService
{
    private $persetujuanAlatRepository;

    public function __construct(PersetujuanAlatRepository $repository)
    {
        $this->persetujuanAlatRepository = $repository;
    }

    public function getData($table)
    {
        $id = ['users_id' => Auth::user()->id];
        return $this->persetujuanAlatRepository->getData($table, $id);
    }

    public function joinDetailSubmissions($table, $id)
    {
        return $this->persetujuanAlatRepository->joinDetailSubmissions($table, $id);
    }

    public function joinDetailSubmissionsGetData($table)
    {
        return $this->persetujuanAlatRepository->joinDetailSubmissionsGetData($table);
    }

    public function joinDetailSubmissionsAndTools($id)
    {
        return $this->persetujuanAlatRepository->joinDetailSubmissionsAndTools($id);
    }
}

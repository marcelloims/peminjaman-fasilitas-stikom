<?php

namespace App\Services;

use App\Repositories\PersetujuanAulaRepository;
use Illuminate\Support\Facades\Auth;

class PersetujuanAulaService
{
    private $persetujuanAulaRepository;

    public function __construct(PersetujuanAulaRepository $repository)
    {
        $this->persetujuanAulaRepository = $repository;
    }

    public function getDataSubmission($table, $id)
    {
        return $this->persetujuanAulaRepository->getDataSubmission($table, $id);
    }

    public function getData($table)
    {
        $id = ['users_id' => Auth::user()->id];
        return $this->persetujuanAulaRepository->getData($table, $id);
    }

    public function joinDetailSubmissions($table, $id)
    {
        return $this->persetujuanAulaRepository->joinDetailSubmissions($table, $id);
    }

    public function joinDetailSubmissionsGetData($table)
    {
        return $this->persetujuanAulaRepository->joinDetailSubmissionsGetData($table);
    }

    public function joinDetailSubmissionsAndTools($id)
    {
        return $this->persetujuanAulaRepository->joinDetailSubmissionsAndTools($id);
    }
}

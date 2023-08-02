<?php

namespace App\Services;

use App\Repositories\OrganisasiMahasiswaRepository;

class OrganisasiMahasiswaService
{
    private $organisasiMahasiswaRepository;

    public function __construct(OrganisasiMahasiswaRepository $repository)
    {
        $this->organisasiMahasiswaRepository = $repository;
    }
}

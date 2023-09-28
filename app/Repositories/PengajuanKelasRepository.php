<?php

namespace App\Repositories;

use App\Models\ErrorTool;
use App\Models\Retur;
use App\Models\Tool;
use App\Services\PengajuanKelasService;
use Illuminate\Support\Facades\Auth;

class PengajuanKelasRepository extends BaseRepository
{
    public function storeAula($table, $submission)
    {
        BaseRepository::create($table, $submission);

        $dataSubmission = BaseRepository::getData($table, $id = null)->max('id');

        $tools  = Tool::where('facilities_id', '!=', 1)->get();
        foreach ($tools as $tool) {
            $detailSubmission = [
                "submissions_id"    => $dataSubmission,
                "tools_id"          => $tool->id,
                "qty"               => $tool->qty,
                "created_by"        => Auth::user()->email,
                "updated_by"        => Auth::user()->email,
                "created_at"        => now(),
                "updated_at"        => now()
            ];

            $retur = [
                "submissions_id"    => $dataSubmission,
                "tools_id"          => $tool->id,
                "status"            => "Dipinjam",
                "created_by"        => Auth::user()->email,
                "updated_by"        => Auth::user()->email,
                "created_at"        => now(),
                "updated_at"        => now()
            ];

            $errorTools = [
                "submissions_id"    => $dataSubmission,
                "tools_id"          => $tool->id,
                "created_by"        => Auth::user()->email,
                "updated_by"        => Auth::user()->email,
                "created_at"        => now(),
                "updated_at"        => now()
            ];

            Retur::insert($retur);
            ErrorTool::insert($errorTools);

            BaseRepository::create('detail_submissions', $detailSubmission);
        }

        return;
    }
}

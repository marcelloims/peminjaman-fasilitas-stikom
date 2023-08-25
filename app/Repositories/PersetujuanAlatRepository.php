<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class PersetujuanAlatRepository extends BaseRepository
{
    public function getData($table, $id)
    {
        return BaseRepository::getWhereData($table, $id);
    }

    public function joinDetailSubmissions($table, $id)
    {
        return DB::table($table)
            ->join('detail_submissions', 'submissions.id', '=', 'detail_submissions.submissions_id')
            ->join('tools', 'detail_submissions.tools_id', '=', 'tools.id')
            ->join('student_organizations', 'submissions.student_organizations_id', '=', 'student_organizations.id')
            ->where('submissions.id', $id)
            ->select(
                'submissions.*',
                'detail_submissions.tools_id',
                'tools.name as toolsName',
                'student_organizations.logo as logoSubmissions',
                'student_organizations.name as name',
                'detail_submissions.qty'
            )
            ->first();
    }

    public function joinDetailSubmissionsAndTools($id)
    {
        return DB::table('submissions')
            ->join('detail_submissions', 'submissions.id', '=', 'detail_submissions.submissions_id')
            ->join('tools', 'detail_submissions.tools_id', '=', 'tools.id')
            ->where('submissions.id', $id)
            ->select(
                'tools.name',
                'detail_submissions.qty'
            )->get();
    }
}

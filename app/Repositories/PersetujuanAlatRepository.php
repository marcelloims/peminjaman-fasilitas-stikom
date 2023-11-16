<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class PersetujuanAlatRepository extends BaseRepository
{
    public function getData($table, $id)
    {
        return BaseRepository::getWhereData($table, $id);
    }

    public function getDataSubmission($table, $id)
    {
        return DB::table($table)->where('id', $id)->first();
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

    public function joinDetailSubmissionsGetData($table)
    {
        return DB::table($table)->where('category', 1)->get();
    }

    public function joinDetailSubmissionsAndTools($id)
    {
        return DB::table('submissions')
            ->join('detail_submissions', 'detail_submissions.submissions_id', '=', 'submissions.id')
            ->join('tools', 'detail_submissions.tools_id', '=', 'tools.id')
            ->join('returs', 'tools.id', '=', 'returs.tools_id')
            ->where('submissions.id', $id)
            ->where('returs.submissions_id', $id)
            ->select(
                'submissions.id as id',
                'detail_submissions.tools_id as tools_id',
                'detail_submissions.qty as qty',
                'tools.name as name',
                'returs.status as status'
            )
            ->get();
    }
}

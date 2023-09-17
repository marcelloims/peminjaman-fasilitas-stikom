<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class PersetujuanAulaRepository extends BaseRepository
{
    public function getData($table, $id)
    {
        return DB::table($table)->where($id)->where('category', 2)->get();
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
        return DB::table($table)->where('category', 2)->get();
    }

    public function joinDetailSubmissionsAndTools($id)
    {
        return DB::table('detail_submissions')
            ->join('tools', 'detail_submissions.tools_id', '=', 'tools.id')
            ->join('returs', 'returs.tools_id', '=', 'tools.id')
            ->where('detail_submissions.submissions_id', $id)
            ->select(
                'detail_submissions.submissions_id as id',
                'detail_submissions.tools_id as tools_id',
                'tools.name as name',
                'detail_submissions.qty as qty',
                'returs.status  as status'
            )
            ->get();
    }
}

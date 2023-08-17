<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class MahasiswaRepository extends BaseRepository
{
    public function getData($table, $id)
    {
        return BaseRepository::getData($table, $id);
    }

    public function getDataByCondition($table, $where)
    {
        return BaseRepository::getDataByCondition($table, $where);
    }

    public function getDataByConditionJoin($table, $where)
    {
        return BaseRepository::getDataByConditionJoin($table, $where);
    }

    public function getChairman($table, $where)
    {
        return DB::table($table)->where($where[0])->where($where[1])->orderBy('email', 'asc')->get();
    }

    public function store($table, $data)
    {
        return BaseRepository::create($table, $data);
    }

    public function update($table, $id, $data)
    {
        return BaseRepository::update($table, $id, $data);
    }

    public function delete($table, $id)
    {
        return BaseRepository::delete($table, $id);
    }

    public function softDelete($table, $id, $data)
    {
        return BaseRepository::softDelete($table, $id, $data);
    }

    public function getTrashed($table, $id)
    {
        return BaseRepository::getTrashed($table, $id);
    }

    public function restore($table, $id, $data)
    {
        return BaseRepository::restore($table, $id, $data);
    }
}

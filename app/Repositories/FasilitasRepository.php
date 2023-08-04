<?php

namespace App\Repositories;

class FasilitasRepository extends BaseRepository
{
    public function getData($table, $id)
    {
        return BaseRepository::getData($table, $id);
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

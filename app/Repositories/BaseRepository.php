<?php

namespace App\Repositories;

use App\Models\Corporate;
use App\Models\Menu;
use App\Models\Permission;
use App\Models\Property;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BaseRepository
{
    public function getData($table, $id)
    {
        if ($id) {
            return DB::table($table)->where('id', $id)->first();
        }
        return DB::table($table)->whereNull('deleted_at')->get();
    }

    public function getToolByRequest($table, $id)
    {
        return DB::table($table)->whereNull('deleted_at')->where('facilities_id', $id)->get();
    }

    public function create($table, $data)
    {
        return DB::table($table)->insert($data);
    }

    public function update($table, $id, $data)
    {
        return DB::table($table)
            ->where('id', $id)
            ->update($data);
    }

    public function softDelete($table, $id, $data)
    {
        $data = DB::table($table)->where('id', $id)->update($data);
    }

    public function delete($table, $id)
    {
        return DB::table($table)->delete($id);
    }

    // public function corporateHasManyProperty()
    // {
    //     return Corporate::with('property')->get();
    // }

    // public function propertyBelongsToCorporate($id)
    // {
    //     return Property::with('corporate')
    //         ->where('properties.id', $id)
    //         ->first();
    // }

    // public function propertyHasManyUser()
    // {
    //     return Property::with('user')->get();
    // }

    public function userBelongsToProperty($id)
    {
        return User::with('property')
            ->where('users.id', $id)
            ->first();
    }

    public function userBelongsToRole($id)
    {
        return User::with('role')
            ->where('users.id', $id)
            ->first();
    }

    // public function roleHasManyUser()
    // {
    //     return Role::with('user')->get();
    // }

    // public function roleHasManyPermission()
    // {
    //     return Permission::with('role')->get();
    // }

    // public function permissionBelongsToRole($id)
    // {
    //     return Permission::with('role')
    //         ->where('permission.id', $id)
    //         ->first();
    // }

    public function getTrashed($table, $id)
    {
        if ($id) {
            return DB::table($table)->where('id', $id)->first();
        }
        return DB::table($table)->whereNotNull('deleted_at')->get();
    }

    public function restore($table, $id, $data)
    {
        return DB::table($table)->where('id', $id)->update($data);
    }

    // public function getMenu()
    // {
    //     return Menu::with('submenu')
    //         ->get();
    // }
}

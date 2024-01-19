<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function errorTools()
    {
        return $this->hasMany(ErrorTool::class, 'tools_id', 'id');
    }
}

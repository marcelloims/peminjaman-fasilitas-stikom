<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorTool extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tools()
    {
        return $this->belongsTo(Tool::class, 'tools_id', 'id');
    }
}

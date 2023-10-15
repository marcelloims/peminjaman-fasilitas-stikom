<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function studentOrganizations()
    {
        return $this->belongsTo(studentOrganizations::class, 'student_organizations_id', 'id');
    }
}

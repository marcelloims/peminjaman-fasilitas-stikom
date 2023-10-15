<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentOrganization extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'student_organizations_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSubmissions extends Model
{
    use HasFactory;

    public function submission()
    {
        return $this->belongsTo(Submission::class, 'submissions_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentActivityUnit extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'student_activity_units_id', 'id');
    }
}

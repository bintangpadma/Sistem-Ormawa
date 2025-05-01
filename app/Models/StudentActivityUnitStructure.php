<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentActivityUnitStructure extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function student_activity_unit(): BelongsTo
    {
        return $this->belongsTo(StudentActivityUnit::class, 'student_activity_units_id', 'id');
    }
}

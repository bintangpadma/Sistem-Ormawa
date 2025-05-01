<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentActivityUnitDivision extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function student_activity_unit(): BelongsTo
    {
        return $this->belongsTo(StudentActivityUnit::class, 'student_activity_units_id', 'id');
    }

    public function student_activity_unit_division_tasks(): HasMany
    {
        return $this->hasMany(StudentActivityUnitDivisionTask::class, 'divisions_id', 'id');
    }
}

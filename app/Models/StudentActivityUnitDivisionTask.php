<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentActivityUnitDivisionTask extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function student_activity_unit_division(): BelongsTo
    {
        return $this->belongsTo(StudentActivityUnitDivision::class, 'divisions_id', 'id');
    }
}

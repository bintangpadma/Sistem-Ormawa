<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function student_activity_unit_visions(): HasMany
    {
        return $this->hasMany(StudentActivityUnitVision::class, 'student_activity_units_id', 'id');
    }

    public function student_activity_unit_missions(): HasMany
    {
        return $this->hasMany(StudentActivityUnitMission::class, 'student_activity_units_id', 'id');
    }

    public function student_activity_unit_programs(): HasMany
    {
        return $this->hasMany(StudentActivityUnitProgram::class, 'student_activity_units_id', 'id');
    }

    public function student_activity_unit_structures(): HasMany
    {
        return $this->hasMany(StudentActivityUnitStructure::class, 'student_activity_units_id', 'id');
    }

    public function student_activity_unit_achievements(): HasMany
    {
        return $this->hasMany(StudentActivityUnitAchievement::class, 'student_activities_id', 'id');
    }

    public function student_activity_unit_divisions(): HasMany
    {
        return $this->hasMany(StudentActivityUnitDivision::class, 'student_activity_units_id', 'id');
    }

    public function newses(): HasMany
    {
        return $this->hasMany(News::class, 'student_activity_units_id', 'id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'student_activity_units_id', 'id');
    }

    public function activity_reports(): HasMany
    {
        return $this->hasMany(ActivityReport::class, 'student_activity_units_id', 'id');
    }
}

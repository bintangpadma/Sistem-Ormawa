<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentOrganization extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'student_organizations_id', 'id');
    }

    public function student_organization_visions(): HasMany
    {
        return $this->hasMany(StudentOrganizationVision::class, 'student_organizations_id', 'id');
    }

    public function student_organization_missions(): HasMany
    {
        return $this->hasMany(StudentOrganizationMission::class, 'student_organizations_id', 'id');
    }

    public function student_organization_programs(): HasMany
    {
        return $this->hasMany(StudentOrganizationProgram::class, 'student_organizations_id', 'id');
    }

    public function student_organization_structures(): HasMany
    {
        return $this->hasMany(StudentOrganizationStructure::class, 'student_organizations_id', 'id');
    }

    public function student_organization_achievements(): HasMany
    {
        return $this->hasMany(StudentOrganizationAchievement::class, 'student_organizations_id', 'id');
    }

    public function newses(): HasMany
    {
        return $this->hasMany(News::class, 'student_organizations_id', 'id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'student_organizations_id', 'id');
    }

    public function activity_reports(): HasMany
    {
        return $this->hasMany(ActivityReport::class, 'student_organizations_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentOrganizationDivision extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function student_organization(): BelongsTo
    {
        return $this->belongsTo(StudentOrganization::class, 'student_organizations_id', 'id');
    }

    public function student_organization_division_tasks(): HasMany
    {
        return $this->hasMany(StudentOrganizationDivisionTask::class, 'divisions_id', 'id');
    }
}

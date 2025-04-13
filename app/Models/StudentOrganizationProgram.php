<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentOrganizationProgram extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function student_organization(): BelongsTo
    {
        return $this->belongsTo(StudentOrganization::class, 'student_organizations_id', 'id');
    }
}

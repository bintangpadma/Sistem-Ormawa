<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentOrganizationDivisionTask extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function student_organization_division(): BelongsTo
    {
        return $this->belongsTo(StudentOrganizationDivision::class, 'divisions_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function student_organization(): BelongsTo
    {
        return $this->belongsTo(StudentOrganization::class, 'student_organizations_id', 'id');
    }

    public function event_divisions(): HasMany
    {
        return $this->hasMany(EventDivision::class, 'events_id', 'id');
    }

    public function event_recruitments(): HasMany
    {
        return $this->hasMany(EventRecruitment::class, 'events_id', 'id');
    }

    public function event_track_records(): HasMany
    {
        return $this->hasMany(EventTrackRecord::class, 'events_id', 'id');
    }
}

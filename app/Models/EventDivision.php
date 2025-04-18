<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventDivision extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'events_id', 'id');
    }

    public function event_recruitments(): HasMany
    {
        return $this->hasMany(EventRecruitment::class, 'event_divisions_id', 'id');
    }
}

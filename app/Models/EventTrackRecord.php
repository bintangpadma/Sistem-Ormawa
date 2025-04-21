<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventTrackRecord extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'events_id', 'id');
    }

    public function event_track_record_tasks(): HasMany
    {
        return $this->hasMany(EventTrackRecordTask::class, 'event_track_records_id', 'id');
    }
}

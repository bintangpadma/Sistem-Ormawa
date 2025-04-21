<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventTrackRecordTask extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function event_track_record(): BelongsTo
    {
        return $this->belongsTo(EventTrackRecord::class, 'event_track_records_id', 'id');
    }
}

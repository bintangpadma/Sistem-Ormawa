<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function event_recruitment(): BelongsTo
    {
        return $this->belongsTo(EventRecruitment::class, 'event_recruitments_id', 'id');
    }
}

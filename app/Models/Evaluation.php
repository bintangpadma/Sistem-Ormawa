<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function event_reqruitment(): BelongsTo
    {
        return $this->belongsTo(EventReqruitment::class, 'event_reqruitments_id', 'id');
    }
}

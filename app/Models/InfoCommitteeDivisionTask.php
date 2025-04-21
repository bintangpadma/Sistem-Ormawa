<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfoCommitteeDivisionTask extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function info_committee_division(): BelongsTo
    {
        return $this->belongsTo(InfoCommitteeDivision::class, 'info_committee_divisions_id', 'id');
    }
}

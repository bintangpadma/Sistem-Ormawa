<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfoCommitteeDivision extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function info_committee(): BelongsTo
    {
        return $this->belongsTo(InfoCommittee::class, 'info_committees_id', 'id');
    }
}

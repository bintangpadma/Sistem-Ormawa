<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfoCommittee extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function info_committee_divisions(): HasMany
    {
        return $this->hasMany(InfoCommitteeDivision::class, 'info_committees_id', 'id');
    }
}

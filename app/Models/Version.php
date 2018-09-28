<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $fillable = [
        'issue',
        'branch',
        'customer_ids',
        'customer_alias',
        'reason',
        'appointed_at',
        'applyer_id',
        'applyer_alias',
        'applyed_at',
        'approver_id',
        'approver_alias',
        'approved_at',
        'publisher_id',
        'publisher_alias',
        'published_at',
        'progress',
        'status',
        'note',
    ];

    public function applyer()
    {
        return $this->belongsTo(User::class, 'applyer_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    public function publisher()
    {
        return $this->belongsTo(User::class, 'publisher_id');
    }
}

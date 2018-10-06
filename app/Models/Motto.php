<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Motto extends Model
{
    protected $fillable = [
        'user_email',
        'user_id',
        'user_alias',
        'star',
        'content',
        'status',
    ];

    protected $appends = [
        'status2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatus2Attribute()
    {
        if ($this->status) {
            return '已投稿';
        } else {
            return '未投稿';
        }
    }
}

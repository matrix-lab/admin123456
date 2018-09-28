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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

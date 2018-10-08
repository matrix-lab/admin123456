<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'alias',
        'note',
    ];

    public function getTaskCount()
    {
        return Task::where('status', '未完成')->where('team_id', $this->id)->count();
    }
}

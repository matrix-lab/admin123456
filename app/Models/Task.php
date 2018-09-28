<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'team_id',
        'team_alias',
        'product',
        'come_from',
        'category',
        'content',
        'type',
        'uier_id',
        'uier_alias',
        'uier_start_at',
        'uier_end_at',
        'phper_id',
        'phper_alias',
        'phper_start_at',
        'phper_end_at',
        'ioser_id',
        'ioser_alias',
        'ioser_start_at',
        'ioser_end_at',
        'androider_id',
        'androider_alias',
        'androider_start_at',
        'androider_end_at',
        'tester_id',
        'tester_alias',
        'tester_start_at',
        'tester_end_at',
        'devopser_id',
        'devopser_alias',
        'devopser_start_at',
        'devopser_end_at',
        'published_at',
        'progress',
        'status',
        'note',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function uier()
    {
        return $this->belongsTo(User::class, 'uier_id');
    }

    public function phper()
    {
        return $this->belongsTo(User::class, 'phper_id');
    }

    public function apper()
    {
        return $this->belongsTo(User::class, 'apper_id');
    }

    public function tester()
    {
        return $this->belongsTo(User::class, 'tester_id');
    }

    public function devopser()
    {
        return $this->belongsTo(User::class, 'devopser_id');
    }
}

<?php

namespace App;

use App\Models\Task;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'alias',
        'email',
        'password',
        'team_id',
        'team_alias',
        'mobile',
        'birthday',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'avatar',
    ];

    public function getAvatarAttribute()
    {
        return avatar($this->email);
    }

    public function getTaskCount()
    {
        $uier_count      = Task::where('status', '未完成')->where('uier_id', $this->id)->count();
        $phper_count     = Task::where('status', '未完成')->where('phper_id', $this->id)->count();
        $ioser_count     = Task::where('status', '未完成')->where('ioser_id', $this->id)->count();
        $androider_count = Task::where('status', '未完成')->where('androider_id', $this->id)->count();
        $tester_count    = Task::where('status', '未完成')->where('tester_id', $this->id)->count();
        $devopser_count  = Task::where('status', '未完成')->where('devopser_id', $this->id)->count();

        return $uier_count + $phper_count + $ioser_count + $androider_count + $tester_count + $devopser_count;
    }
}

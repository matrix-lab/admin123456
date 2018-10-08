<?php

namespace App;

use App\Models\Task;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

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
        $query           = Task::where('status', '未完成');
        $user_id         = Auth::user()->id;
        $uier_count      = $query->where('uier_id', $user_id)->count();
        $phper_count     = $query->where('phper_id', $user_id)->count();
        $ioser_count     = $query->where('ioser_id', $user_id)->count();
        $androider_count = $query->where('androider_id', $user_id)->count();
        $tester_count    = $query->where('tester_id', $user_id)->count();
        $devopser_count  = $query->where('devopser_id', $user_id)->count();

        return $uier_count + $phper_count + $ioser_count + $androider_count + $tester_count + $devopser_count;
    }
}

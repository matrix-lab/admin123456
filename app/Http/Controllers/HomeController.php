<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Motto;
use App\Models\Task;
use App\Models\Team;
use App\Models\Version;
use App\User;

class HomeController extends Controller
{
    public function index()
    {
        $mottos = Motto::where('status', 0)->limit(5)->orderBy('id', 'desc')->get();

        return view('welcome', ['mottos' => $mottos]);
    }

    public function team()
    {
        return view('team.index');
    }

    public function user()
    {
        $teams = [];
        Team::all()->map(function ($item) use (&$teams) {
            $teams[$item->id] = $item->name;
        });

        return view('user.index', ['teams' => $teams]);
    }

    public function customer()
    {
        return view('customer.index');
    }

    public function task()
    {
        return view('task.index');
    }

    public function version()
    {
        return view('version.index');
    }

    public function motto()
    {
        return view('motto.index');
    }

    public function me()
    {
        return view('me');
    }
}

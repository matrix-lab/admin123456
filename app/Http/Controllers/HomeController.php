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
        return view('welcome');
    }

    public function team()
    {
        $teams = Team::all();

        return view('team.index', ['teams' => $teams]);
    }

    public function user()
    {
        $users = User::all();
        $teams = [];
        Team::all()->map(function ($item) use (&$teams) {
            $teams[$item->id] = $item->name;
        });

        return view('user.index', ['users' => $users, 'teams' => json_encode($teams)]);
    }

    public function customer()
    {
        $customers = Customer::all();

        return view('customer.index', ['customers' => $customers]);
    }

    public function task()
    {
        $tasks = Task::all();
        $users = [];
        User::all()->map(function ($item) use (&$users) {
            $users[$item->id] = $item->name;
        });

        return view('task.index', ['tasks' => $tasks, 'users' => json_encode($users)]);
    }

    public function version()
    {
        $versions  = Version::all();
        $customers = [];
        Customer::all()->map(function ($item) use (&$customers) {
            $customers[$item->id] = $item->name;
        });

        return view('version.index', ['versions' => $versions, 'customers' => json_encode($customers)]);
    }

    public function motto()
    {
        $mottos = Motto::all();

        return view('motto.index', ['mottos' => $mottos]);
    }
}

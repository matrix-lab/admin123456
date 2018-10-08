<?php

namespace App\Http\Controllers\API;

use App\Models\Team;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::orderBy('id', 'DESC')->get()->map(function ($team) {
            $team->offsetSet('task_count', $team->getTaskCount());

            return $team;
        });

        return [
            'code'  => 0,
            'msg'   => '',
            'count' => Team::count('id'),
            'data'  => $teams,
        ];
    }

    public function store(Request $request)
    {
        return Team::create($request->all());
    }

    public function update(Request $request, Team $team)
    {
        $team->update($request->all());

        return $team;
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return $team;
    }
}

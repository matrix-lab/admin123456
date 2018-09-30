<?php

namespace App\Http\Controllers\API;

use App\Models\Team;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        return [
            'code'  => 0,
            'msg'   => '',
            'count' => 100,
            'data'  => Team::orderBy('id', 'DESC')->get(),
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

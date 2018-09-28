<?php

namespace App\Http\Controllers\API;

use App\Models\Team;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class TeamController extends Controller
{
    public function index()
    {
        return Team::all();
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

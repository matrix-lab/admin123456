<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        return User::create($request->all());
    }

    public function update(Request $request, User $user)
    {
        if ($request->get('password', null)) {
            $request->offsetSet('password', Hash::make($request->get('password')));
            $user->update($request->all());
        } else {
            $user->update($request->except('password'));
        }

        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();

        return $user;
    }
}

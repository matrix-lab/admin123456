<?php

namespace App\Http\Controllers\API;

use App\Mail\MottoShipped;
use App\Models\Motto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MottoController extends Controller
{
    public function store(Request $request)
    {
        $request->offsetSet('user_id', Auth::user()->id);
        $request->offsetSet('user_alias', Auth::user()->alias);
        $request->offsetSet('star', 1);
        $request->offsetSet('user_email', Auth::user()->email);

        return Motto::create($request->all());
    }

    public function update(Request $request, Motto $motto)
    {
        $request->offsetSet('user_alias', Auth::user()->alias);
        $request->offsetSet('star', ($motto->star + rand(1, 5)));
        $request->offsetSet('user_email', Auth::user()->email);

        $motto->update($request->all());

        return $motto;
    }

    public function destroy(Motto $motto)
    {
        $motto->delete();

        return $motto;
    }

    public function send(Motto $motto)
    {
        //Mail::to('leishengtao@1fangxin.cn')->send(new MottoShipped($motto));
        //Mail::to('sunshiping@1fangxin.cn')->send(new MottoShipped($motto));

        $motto->update([
            'status' => true,
        ]);

        return $motto;
    }
}

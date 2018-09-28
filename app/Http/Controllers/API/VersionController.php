<?php

namespace App\Http\Controllers\API;

use App\Models\Version;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VersionController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $request->offsetSet('applyer_id', Auth::user()->id);
        $request->offsetSet('applyer_alias', Auth::user()->name);
        $request->offsetSet('applyed_at', Carbon::now()->toDateTimeString());
        $request->offsetSet('progress', '待审核');
        $request->offsetSet('status', '未完成');

        return Version::create($request->all());
    }

    public function update(Request $request, Version $version)
    {
        $version->update($request->all());

        return $version;
    }

    public function approve(Request $request, Version $version)
    {
        $request->offsetSet('approver_id', Auth::user()->id);
        $request->offsetSet('approver_alias', Auth::user()->name);
        $request->offsetSet('approved_at', Carbon::now()->toDateTimeString());
        $request->offsetSet('progress', '待发布');

        $version->update($request->all());

        return $version;
    }

    public function finish(Request $request, Version $version)
    {
        $request->offsetSet('publisher_id', Auth::user()->id);
        $request->offsetSet('publisher_alias', Auth::user()->name);
        $request->offsetSet('published_at', Carbon::now()->toDateTimeString());
        $request->offsetSet('progress', '已发布');
        $request->offsetSet('status', '已完成');

        $version->update($request->all());

        return $version;
    }

    public function destroy(Version $version)
    {
        $version->delete();

        return $version;
    }
}

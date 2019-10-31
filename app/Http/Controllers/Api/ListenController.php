<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ListenCollection;
use App\Listen;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ListenController extends Controller
{
    public function index(Request $request)
    {
    	$listens = Listen::select()->orderBy('listened_at', 'DESC')->limit(50);

    	if ($request->has('from')) {
    		$from = new Carbon($request->from);
    		$listens->where('listened_at', '>', $from);
    	}

        return new ListenCollection($listens->get());
    }

}

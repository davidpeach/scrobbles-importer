<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ListenCollection;
use App\Listen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Log;

class ListenController extends Controller
{
    public function index(Request $request)
    {
    	// \Log::info($request->all());
    	$listens = Listen::select()->orderBy('listened_at', 'DESC')->limit(50);

    	if ($request->has('from')) {
    		$from = new Carbon($request->from);
    		$listens->where('listened_at', '>', $from);
    	}

    	// $listens = $listens->get();
    	$structuredListen = [];

    	foreach ($listens as $listen) {

    		list($year, $month) = explode(' ', $listen->listened_at->format('Y m'));

    		if (!array_key_exists($year, $structuredListen)) {
    			$structuredListen[$year] = [];
    		}

    		if (!array_key_exists($month, $structuredListen[$year])) {
    			$structuredListen[$year][$month] = [];
    		}

    		$structuredListen[$year][$month][] = $listen;
    	}


        // Log::info($listens->get());
    	// $listens->groupBy(function ($d) {
    	// 	// dd($d);
    	// 	return Carbon::parse($d->listened_at)->format('m');
    	// });

    	// dd($structuredListen);
    	// return collect($structuredListen);
    	// $listens = Listen::latest('listened_at')->limit(25)->get();
        return new ListenCollection($listens->get());
    }

}

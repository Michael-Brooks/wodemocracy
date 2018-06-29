<?php

namespace App\Http\Controllers;

use App\WOD;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tomorrowsWod = WOD::where('workout_date', Carbon::parse(Carbon::tomorrow())->format('Y-m-d'))->first();

    	$wods = WOD::whereHas('workouts', function ($query) {
    	    $query->where('won', 1);
        })->orderBy('created_at', 'desc')->paginate(10);

	    return view('welcome', [
	        'tomorrowsWod' => $tomorrowsWod,
	    	'wods'  => $wods
	    ]);
    }
}

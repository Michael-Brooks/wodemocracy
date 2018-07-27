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

	    return view('welcome', [
	        'tomorrowsWod' => $tomorrowsWod,
	    ]);
    }
}

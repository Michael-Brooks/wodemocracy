<?php

namespace App\Http\Controllers;

use App\WOD;
use App\Workout;

class WODController extends Controller
{
    //
	public function index($id)
	{
	    $wod = WOD::find($id);

		$workouts = Workout::withCount(['votes', 'votes as upvotes_count' => function ($query) {
			$query->where('upvote', 1);
		}, 'votes as downvotes_count' => function ($query) {
			$query->where('downvote', 1);
		}])
            ->where('w_o_d_id', $id)
            ->orderBy('upvotes_count', 'desc')
            ->get();

		return view('wod',[
			'wod'       => $wod,
			'workouts'  => $workouts
		]);
	}
}

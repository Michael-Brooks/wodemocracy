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
		    'id'        => $id,
			'wod'       => $wod,
			'workouts'  => $workouts
		]);
	}

	public function getWODs($id = null)
    {
        if($id === null)
        {
            $wods = WOD::whereHas('workouts', function ($query) {
                $query->where('won', 1);
            })->with('workouts')->orderBy('created_at', 'desc')->paginate(10);

            return response()->json($wods);
        }

        $wod = WOD::where('id', $id)->with(['workouts', 'workouts.votes', 'workouts.user'])->first();

        return response()->json($wod);
    }
}

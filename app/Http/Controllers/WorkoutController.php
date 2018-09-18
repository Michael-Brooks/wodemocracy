<?php

namespace App\Http\Controllers;

use App\Vote;
use App\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class WorkoutController extends Controller
{
    //
	public function create(Request $request, $id)
	{
	    $request->validate([
	        'title'     => 'required',
            'details'   => 'required',
        ]);

	    $user = Auth::user();

		$workout = new Workout();
		$workout->title = $request->input('title');
		$workout->details = $request->input('details');
		$workout->w_o_d_id = $id;
		$workout->user_id = $user->id;
		$workout->won = 0;
		if ($user->hasAnyRole(['approved-user', 'admin']))
		    $workout->status = 1;
		$workout->save();

		if ($user->hasRole('trial'))
            return Redirect::back()->with('success', 'Your workout has been submitted for approval.');

		return Redirect::back()->with('success', 'Your workout has been submitted.');
	}

	public function delete($id)
	{
		Workout::where('id', $id)->where('user_id', Auth::id())->delete();

		return Redirect::back();
	}

	public function submitVote(Request $request, $id) {
        $userId = $request->input('user');

        if(!$vote = Vote::where('workout_id', $id)->where('user_id', $userId)->first()) {
            $vote = new Vote();
        }

        $vote->upvote = $request->input('upvote');
        $vote->downvote = $request->input('downvote');
        $vote->workout_id = $id;
        $vote->user_id = $userId;
        $vote->save();

        $getVoteCount = Workout::withCount(['votes as upvotes_count' => function ($query) {
            $query->where('upvote', 1);
        }, 'votes as downvotes_count' => function ($query) {
            $query->where('downvote', 1);
        }])
            ->with('user')
            ->where('id', $id)->first();

        return response()->json($getVoteCount);
    }
}

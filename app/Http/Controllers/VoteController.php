<?php

namespace App\Http\Controllers;

use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class VoteController extends Controller
{
    //
	public function create(Request $request, $id)
	{
	    $userId = Auth::id();

        if(!$vote = Vote::where('workout_id', $id)->where('user_id', $userId)->first()) {
            $vote = new Vote();
        }

        $vote->upvote = $request->input('vote') === '1' ? 1 : 0;
        $vote->downvote = $request->input('vote') === '-1' ? 1 : 0;
        $vote->workout_id = $id;
        $vote->user_id = $userId;
        $vote->save();


        return Redirect::back();
	}
}

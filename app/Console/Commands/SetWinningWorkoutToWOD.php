<?php

namespace App\Console\Commands;

use App\WOD;
use App\Workout;
use Carbon\Carbon;

class SetWinningWorkoutToWOD
{
    public function set()
    {
        $wod = WOD::where('workout_date', Carbon::today())->first();
        $workouts = Workout::withCount(['votes', 'votes as upvotes_count' => function ($query) {
            $query->where('upvote', 1);
        }, 'votes as downvotes_count' => function ($query) {
            $query->where('downvote', 1);
        }])
            ->where('w_o_d_id', $wod->id)
            ->where('status', 1)
            ->get();

        $winnerId = null;
        $voteCount = null;

        foreach ($workouts as $workout) {
            $currentVoteCount = $workout->upvotes_count - $workout->downvotes_count;
            if ($voteCount === null || $currentVoteCount > $voteCount) {
                $voteCount = $currentVoteCount;
                $winnerId = $workout->id;
            }
        }

        $winner = Workout::find($winnerId);
        $winner->won = 1;
        $winner->save();
    }
}
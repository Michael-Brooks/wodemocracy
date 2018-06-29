<?php

namespace App\Console\Commands;

use App\WOD;
use Carbon\Carbon;

class CreateVotingThread
{
    public function create()
    {
        $wod = new WOD();
        $wod->workout_date = Carbon::tomorrow();
        $wod->save();
    }
}
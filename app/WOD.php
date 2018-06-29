<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WOD extends Model
{
    //

	public function votes()
	{
		return $this->hasMany('App\Vote');
	}

	public function workouts()
    {
        return $this->hasMany('App\Workout');
    }
}

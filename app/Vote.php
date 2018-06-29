<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    //

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function workout()
	{
		return $this->belongsTo('App\Workout');
	}
}

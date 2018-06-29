<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hootlex\Moderation\Moderatable;

class Workout extends Model
{
    use Moderatable;
    //

	public function votes()
	{
		return $this->hasMany('App\Vote');
	}

	public function user()
    {
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = true;
	
    /**
     * Get the players for the game.
    */
    public function players()
    {
        return $this->hasMany('App\Player');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = true;
	
	/**
     * Get the orders for the client.
    */
    public function orders()
    {
        return $this->hasMany('App\Game');
    }
}
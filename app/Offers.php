<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $table = 'offers';
	
	public function getRouteKeyName()
    {
    	return 'slug';
    }
}
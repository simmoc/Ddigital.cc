<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table = 'countries';
    	
	public function getRouteKeyName()
    {
    	return 'id_countries';
    }
}
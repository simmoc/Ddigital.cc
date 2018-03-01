<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    protected $table = 'licences';
    
    public function getRouteKeyName()
    {
    	return 'slug';
    }
}

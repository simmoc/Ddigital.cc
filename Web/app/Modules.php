<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    protected $table = 'modules';
    
    public static function getRecord($key)
    {
    	return Modules::where('slug','=',$key)->first();
    }
}
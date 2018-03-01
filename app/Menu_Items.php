<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu_Items extends Model
{
    protected $table = 'menu_items';
    
    public function getRouteKeyName()
    {
    	return 'slug';
    }
}

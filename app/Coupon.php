<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
	
	public function getRouteKeyName()
    {
    	return 'slug';
    }
}
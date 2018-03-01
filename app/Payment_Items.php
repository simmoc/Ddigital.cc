<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use \App;

class Payment_Items extends Model
{
	protected $table = 'payments_items';   

    public static function getRecordWithSlug($slug)
    {
        return Payment_Items::where('slug', '=', $slug)->first();
    }    
}

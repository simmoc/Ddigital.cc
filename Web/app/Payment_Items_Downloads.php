<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use \App;

class Payment_Items_Downloads extends Model
{
	protected $table = 'payments_items_downloads';   

    public static function getRecordWithSlug($slug)
    {
        return Payment_Items_Downloads::where('slug', '=', $slug)->first();
    }    
}
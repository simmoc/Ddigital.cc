<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Templates extends Model
{
    protected $table = 'templates';
    	
	public function getRouteKeyName()
    {
    	return 'slug';
    }	
	/**
	 * Returna Parent Categories
	 */
	 public static function getTemplates( $template_type = '' )
	 {
		 if ($template_type == '') {
			$records = Templates::select(['id','title','slug','type','template_type','subject','content','from_email','from_name'])
			->orderBy('updated_at', 'desc')
            ->get();
		 } else {
			$records = Templates::select(['id','title','slug','type','subject','content','from_email','from_name'])
			->where('template_type', '=', $template_type)
			->orderBy('updated_at', 'desc')
            ->get();
		 }		 
		return $records;
	 }	 
	 /**
	 * Returns the user record with the matching slug.
	 * If slug is empty, it will return the currently logged in user
	 * @param  string $slug [description]
	 * @return [type]       [description]
	 */
	public static function getRecordWithSlug($slug='')
	{
		$records = Templates::select(['id','title','slug','type','subject','content','from_email','from_name'])
            ->where('template_type', '=', $slug)
			->first();
		return $records;
	}
}

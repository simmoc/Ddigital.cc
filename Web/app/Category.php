<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    
    public function getRouteKeyName()
    {
    	return 'slug';
    }
	
	/**
	 * Returna Parent Categories
	 */
	 public static function getParentCategories()
	 {
		 $records = Category::select(['title','parent_id','sort_order','status','slug','id','updated_at'])
            ->where('parent_id', '=', '0')
			->orderBy('updated_at', 'desc')
            ->get();
		return $records;
	 }
	 
	 public static function getSubCategories($slug)
	 {
		 $parent_record = Category::getRecordWithSlug($slug);
		 
		 if ($parent_record != null) {
		 $parent_id = $parent_record->id;
		 $records = Category::select(['title','parent_id','sort_order','status','slug','id','updated_at'])
            ->where('parent_id', '=', $parent_id)
			->orderBy('updated_at', 'desc')
            ->get();
		return $records;
		 }
	 }
	 
	 /**
	 * Returns the user record with the matching slug.
	 * If slug is empty, it will return the currently logged in user
	 * @param  string $slug [description]
	 * @return [type]       [description]
	 */
	public static function getRecordWithSlug($slug='')
	{
		$records = Category::select(['title','parent_id','sort_order','status','slug','id','updated_at'])
            ->where('slug', '=', $slug)
			->first();
		return $records;
	}
}

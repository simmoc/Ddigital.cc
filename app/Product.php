<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    	
	public function getRouteKeyName()
    {
    	return 'slug';
    }
	
	public static function getProducts( $params = array() )
	{
		$records = array();

		if( ! isset($params['category']) && ! isset( $params['sub_category'] ) ) {
			$records = Product::select('products.id', 'products.name', 'products.slug','products.description','products.price_type','products.price','products.price_variations','products.download_files','products.image','products.meta_tag_title','products.meta_tag_description','products.meta_tag_keywords','products.user_created','products.categories','products.demo_link','products.download_limits','products.download_notes')
			->where('approved','=',1)
			->where('status', '=', 'Active');
			
			if( isset( $params['tag'] ) && $params['tag'] != '') {
				$records->where('products.meta_tag_keywords', 'like', '%'.$params['tag'] . '%');
				//$records->groupBy('pc.product_id');
			} 
			if( isset( $params['title'] ) && $params['title'] != '') {
				$records->where('products.name', 'like', '%'.$params['title'] . '%');
				//$records->groupBy('pc.product_id');
			}
			if( isset($params['free']) ) {
				$records->where('price', '=', 0);
			}
			if( isset($params['featured']) ) {
				$records->where('is_featured', '=', 'yes');
			}
			if( isset($params['user_created']) ) {
				$records->where('user_created', '=', $params['user_created']);
			}
			if( isset($params['popular']) ) {
				$records->orderBy('views_count', 'desc');
			}
			if( isset($params['orderby']) ) {
				$records->orderBy('user_created', 'desc');
			}
			//dd($params);
			//dd($records->toSql());
		}
		elseif( isset($params['category']) && isset( $params['sub_category'] ) ) {
			$cat_id = $params['sub_category'];
			if( ! is_int( $params['category'] ) && ! is_int( $params['sub_category'] ) ) {
				$cat = Category::where('slug', '=', $params['category'])->first();
				if( ! empty( $cat ) ) {
					$sub_cat = Category::where('parent_id', '=', $cat->id)->where('slug', '=', $params['sub_category'])->first();
					if( $sub_cat )
						$cat_id = $sub_cat->id;
					else
						$cat_id = 0;
				} else {
					$cat_id = 0;
				}
			}
			$records = Product::select('products.id', 'products.name', 'products.slug','products.description','products.price_type','products.price','products.price_variations','products.download_files','products.image','products.meta_tag_title','products.meta_tag_description','products.meta_tag_keywords','products.user_created','products.categories','products.demo_link','products.download_limits','products.download_notes','categories.id as category_id')
			->join('products_categories as pc', 'products.id', '=', 'pc.product_id')
			->join('categories', 'categories.id', '=', 'pc.category_id')
			->where('products.status', '=', 'Active')
			->where('approved','=',1)
			->where('categories.status', '=', 'Active');
		
			if( $cat_id == 0 && isset( $params['tag'] ) && $params['tag'] != '') {
				$records->where('products.meta_tag_keywords', 'like', '%'.$params['tag'] . '%');
				$records->groupBy('pc.product_id');
			}
			if( $cat_id == 0 && isset( $params['title'] ) && $params['title'] != '') {
				$records->where('products.name', 'like', '%'.$params['title'] . '%');
				$records->groupBy('pc.product_id');
			} 
			if( $cat_id != 0 )
			{
				$records->where('categories.id', '=', $cat_id);
			}
			if( isset($params['free']) ) {
				$records->where('price', '=', 0);
			}
			if( isset($params['featured']) ) {
				$records->where('is_featured', '=', 'yes');
			}
			if( isset($params['user_created']) ) {
				$records->where('user_created', '=', $params['user_created']);
			}
			if( isset($params['popular']) ) {
				$records->orderBy('views_count', 'desc');
			}
			if( isset($params['orderby']) ) {
				$records->orderBy('user_created', 'desc');
			}
			//dd($records->toSql());
		}
		elseif( isset($params['category']) ) {
			$cat_id = $params['category'];
			if( ! is_int( $params['category'] ) && ! is_array( $params['category'] )  ) {
				$cat = Category::where('slug', '=', $params['category'])->first();
				if( ! empty( $cat ) ) {
					$cat_id = $cat->id;
				} else {
					$cat_id = 0;
				}
			}
			$records = Product::select('products.id', 'products.name', 'products.slug','products.description','products.price_type','products.price','products.price_variations','products.download_files','products.image','products.meta_tag_title','products.meta_tag_description','products.meta_tag_keywords','products.user_created','products.categories','products.demo_link','products.download_limits','products.download_notes','categories.id as category_id')
			->join('products_categories as pc', 'products.id', '=', 'pc.product_id')
			->join('categories', 'categories.id', '=', 'pc.category_id')
			->where('products.status', '=', 'Active')
			->where('approved','=',1)
			->where('categories.status', '=', 'Active');
			
			if( $cat_id == 0 && isset( $params['tag'] ) && $params['tag'] != '') {
				$records->where('products.meta_tag_keywords', 'like', '%'.$params['tag'] . '%');
				$records->groupBy('pc.product_id');
			}
			if( $cat_id == 0 && isset( $params['title'] ) && $params['title'] != '') {
				$records->where('products.name', 'like', '%'.$params['title'] . '%');
				$records->groupBy('pc.product_id');
			} 
			if( $cat_id != 0 )
			{
				if( is_array( $params['category'] ) ) {
					$records->whereIn('categories.id', $cat_id);
				} else {
					$records->where('categories.id', '=', $cat_id);
				}
			}			{
				
			}
			if( isset($params['free']) ) {
				$records->where('price', '=', 0);
			}
			if( isset($params['featured']) ) {
				$records->where('is_featured', '=', 'yes');
			}
			if( isset($params['user_created']) ) {
				$records->where('user_created', '=', $params['user_created']);
			}
			if( isset($params['popular']) ) {
				$records->orderBy('views_count', 'desc');
			}
			if( isset($params['orderby']) ) {
				$records->orderBy('user_created', 'desc');
			}
		}
		elseif( isset($params['sub_category']) ) {
			
		}
		return $records;
	}
}
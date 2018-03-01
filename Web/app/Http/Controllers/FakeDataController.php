<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use DB;
use Illuminate\Support\Facades\Hash;
use Input;
use Exception;
use Auth;
use Image;
use \App;
use App\Payment;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use File;
use App\Payment_Items_Downloads;
use Zipper;
use Illuminate\Filesystem\Filesystem;
use Response;
use Htmldom;

class FakeDataController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }
	
	public function getPictureURL($gender)
	  {
		$person_data = "https://randomuser.me/api?gender=".$gender;

		$data =   json_decode(file_get_contents($person_data));
		// var_dump($data);
		
		return $data->results[0]->picture;
	  }

     function addFakeUser()
	  {
		//$target_image_path = base_path('uploads/users/');
		$target_image_path = UPLOAD_PATH_USERS;
		$count = 50;
		$limit = 50;
		$faker = \Faker\Factory::create();
		DB::beginTransaction();
			try{
			   for($cnt=0; $cnt< $limit; $cnt++) {
		  $username =  $faker->firstName . ' ' . $faker->lastName;
		  $current_gender = $faker->randomElements($array = array ('male','female'), $count = 1)[0];
		  
		  $name =  $faker->name($gender = $current_gender);
		  
		  
		  
			$user = new User();
			$user->name = $username;
			$user->first_name = $faker->firstName;
			$user->last_name = $faker->lastName;
			$user->slug     = $user->makeSlug($username);
			$user->email = $faker->unique()->email;
			$user->password = bcrypt('password');
			/**
			 2 - admin
			 3 - executive
			 4 - vendor
			 5 - user
			*/
			$user->role_id = $faker->randomElements($array = array ('5'), $count = 1)[0];
			// Let us give default permissions
			if( $user->role_id == 2 || $user->role_id == 3 ) {
				$user->user_modules_permissions   = '{"Products":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Users":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Users_Owners":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Users_Admins":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Users_Executives":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Users_Vendors":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Users_Customers":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Categories":{"Add":"on","View":"on","Import":"on"},"Email_Templates":{"Add":"on","Edit":"on","View":"on"},"Pages":{"Add":"on","Edit":"on","View":"on"},"Faq":{"Add":"on","Edit":"on","View":"on"},"Payments_Report":{"Add":"on","Edit":"on","View":"on","Export":"on"},"Menus":{"Add":"on","Edit":"on","View":"on"},"Languages":{"Add":"on","Edit":"on","View":"on","Change":"on"},"Messages":{"Add":"on","Edit":"on","View":"on"},"Change_Password":{"Edit":"on"},"Settings":{"View":"on"},"Menu_Items":{"Add":"on","Edit":"on","View":"on"},"Profile":{"Edit":"on","View":"on"}}';
			} elseif( $user->role_id == 4) {
			$user->user_modules_permissions   = '{"Products":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Coupons":{"View":"on"},"Change_Password":{"Edit":"on"},"Profile":{"Edit":"on","View":"on"}}';
			} elseif($user->role_id == 5) {
				$user->user_modules_permissions   = '{"Products":{"View":"on"},"Coupons":{"View":"on"},"Change_Password":{"Edit":"on"},"Profile":{"Edit":"on","View":"on"}}';
			}
			
			$user->phone = $faker->numerify('##########');
			$user->status = 'Active';
			$user->confirmed = '1';
			
			$user->billing_address1 = $faker->address;
			$user->billing_address2 = $faker->streetAddress;
			$user->billing_city = $faker->city;
			$user->billing_zip = $faker->postcode;
			
			$user->billing_state = $faker->state;
			$user->billing_country = $faker->country;
			$user->about_me = $faker->text(400);
			$user->save();

			$user->roles()->attach($user->role_id);

			$picture_url = $this->getPictureURL($current_gender);
			$filename = $user->id.'.png';
			copy($picture_url->large, $target_image_path.$filename);
			copy($picture_url->medium, $target_image_path.'thumbnail/'.$filename);			
			$user->image = $filename;
			$user->save();			
		  DB::commit();
		  //dd($picture_url);
		  echo $cnt.' '.$name.' <br>';
		  continue;
		   }
		   dd('its done');
		  }
		  catch(Exception $ex){
			 DB::rollBack();
			 dd($ex->getMessage());
			}
		 
	  }
	  
	  public function addFakeProduct( $page = 1 )
	  {
		$html = new \Htmldom('https://psdrepo.com/all/page/'.$page);
		//$html = $this->get_content ("https://psdrepo.com/all/");
		$products = $html->find('ul.resources li');
		foreach( $products as $product )
		{
			$title_text = $tag_text = $image = $description_link = $image_big = '';
			$title = $product->find('a.card-title', 0);
			if( $title )
			{
				$title_text = trim($title->plaintext);
				$description = $product->find('a.image-wrapper', 0);
				if( $description ) {
					$description_link = $description->href;
				}
			}
			$tag = $product->find('div.tag a', 0);
			if( $tag )
			{
				$tag_text = trim($tag->plaintext);
				
				if( $tag_text != '' )
				{
					try{
						$cat = new Category();
						$cat->title = $tag_text;
						$cat->slug = $cat->makeSlug( $tag_text );
						
						$cat->description = $tag_text;
						$cat->meta_tag_title = $tag_text;
						$cat->meta_tag_description = $tag_text;
						$cat->meta_tag_keywords = $tag_text;
						$cat->status = 'Active';
						$cat->save();
					} catch( Exception $ex ) {
						
					}
				}
			}
			
			if( $title_text != '' )
			{
			$record = new App\Product();
			$record->approved = 1;
			$record->name = $title_text;
			$record->slug = $record->makeSlug($title_text);
			
			if( $description_link != '' ) {
				$description = new \Htmldom( $description_link );
				if( $description ) {
					$image_big_html = $description->find('img.big-resource', 0);
					if( $image_big_html )
					{
						$image_big = $image_big_html->src;
					}
					$text = $description->find('div.resource-description p', 0);
					if( $text )
					{
						$record->description = $text->plaintext;
					}
					else
					{
						$record->description = $title_text;
					}
				} else {
					$record->description = $title_text;
				}
			} else {
				$record->description = $title_text;
			}
			$licences = array_pluck(App\Licence::where('status', '=', 'Active')->get(), 'title', 'id');
			$selected_licences = array();
			if( ! empty( $licences ) ) {
			$selected_licences = array_rand( $licences, 2 );
			$record->licences = json_encode( $selected_licences );
			}
			$record->licence_of_use		= $title_text;
			$record->technical_info		= $title_text;
			$record->product_belongsto  = $title_text;
			
			$price_types = array('default', 'variable');
			$record->price_type= $price_types[ array_rand( $price_types, 1 ) ];
			if( $record->price_type == 'default') {
				$record->price 	= rand(0, 500);
			} else {
				$price_variations_count = rand(2, 10);
				$price_variations = $price_variations_taken = array();
				$variation_names = array('Basic', 'Small', 'XL', 'XXL', 'XXXL', 'Whole', 'Extended', 'Advanced', 'Medium', 'Simple');
				for( $i = 1; $i <= $price_variations_count; $i++ ) {
					$item = array(
						'index' => $i,
						'name' => $variation_names[ array_rand( $variation_names, 1 ) ],
						'amount' => rand(1,500),
					);
					$default = round($price_variations_count/2);
					if( $i == $default )
					{
						$item['isdefault'] = 'on';
					}
					$price_variations[$i] = $item;					
				}
				
				$min_price = $max_price = $index = 0;
				if( ! empty( $price_variations ) ) {
					foreach( $price_variations as $key => $item ) {

						if( $index == 0)
							$min_price = $item['amount'];

						if( $item['amount'] < $min_price )
							$min_price = $item['amount'];
						if( $item['amount'] > $max_price )
							$max_price = $item['amount'];
						$index++;
					}
				}
				$record->price 	= $min_price;
				$record->price_variations 	  = json_encode( $price_variations );
				//echo count( $price_variations ).'##' . $title_text.'<br>';
			}
			$price_display_types = array('checkbox', 'radio', 'dropdown');
			$record->price_display_type  = $price_display_types[ array_rand( $price_display_types, 1 ) ];
			$record->status		          = 'Active';
			$record->meta_tag_title       = $title_text;
	        $record->meta_tag_description = $title_text;
            $record->meta_tag_keywords    = $title_text;
			$users = array_pluck(App\User::where('status', '=', 'Active')->whereIn('role_id', array(2,3,4))->get(), 'id', 'name');
			if( ! empty( $users ) )
			{
			$record->user_created         = $users[ array_rand( $users, 1 ) ];
			}
			else
			{
				$record->user_created = Auth::User()->id;
			}
			
			//$categories = App\Category::where('status', '=', 'Active');
			$categories = array_pluck(App\Category::where('status', '=', 'Active')->get(), 'title', 'id');
			$selected_cats = array();
			if( ! empty( $categories ) ) {
			$selected_cats = array_rand( $categories, 2 );
			$record->categories = json_encode( $selected_cats );
			}
			$record->download_limits = rand(5, 100);
			$record->download_notes = $title_text;
			//dd($record);
			$record->save();
			
			if( ! empty( $selected_cats ) ) {
				$data = array();
				foreach( $selected_cats as $key => $val ) {
					$data[] = array(
						'product_id' => $record->id,
						'category_id' => $val,
					);
				}
				App\Products_Categories::insert($data);
			}
			if( ! empty( $selected_licences ) ) {
				$data = array();
				foreach( $selected_licences as $key => $val ) {
					$data[] = array(
						'product_id' => $record->id,
						'lisence_id' => $val,
					);
				}
				App\Product_Lisence::insert($data);
			}
			
			$img = $product->find('img.resource', 0);
			if( $img )
			{
				$image = $img->src;
				$extesion = substr( strrchr( $image, "." ), 1);
				$destinationPath = UPLOAD_PATH_PRODUCTS;
				$destinationPathThumb = UPLOAD_PATH_PRODUCTS_THUMBNAIL;
				$fileName = $record->id . '.'.$extesion;
				//$this->downloadFile( $image,  $destinationPathThumb . $fileName);
				copy($image, $destinationPathThumb . $fileName);
				if( $image_big != '' )
				{
					copy($image_big, UPLOAD_PATH_PRODUCTS . $fileName);
				}
				else
				{
					$width = 1920;
					$height = 1080;
					Image::make( $destinationPathThumb . $fileName )->resize($width, $height)->save($destinationPath.$fileName);
				}
				
				$record->image = $fileName;
				$record->save();
			}
			
			$download_files_count = 10;
			if( $record->price_type == 'default' )
				$download_files_count = 1;
			$upload_files = array();
			for( $i = 1; $i <= $download_files_count; $i++ )
			{
				$upload_files[] = 'download_'.$i.'.zip';
			}
			$upload_types = array('file', 'url');
			$files = array();
			for( $i = 1; $i <= $download_files_count; $i++ ) {				
				$file = array(
						'index' => $i,
					);
				$type = $upload_types[ array_rand( $upload_types, 1 ) ];
				if( $type == 'file') {
					$file['name'] = $upload_files[ array_rand( $upload_files, 1 ) ];
					$file['file_name'] = $upload_files[ array_rand( $upload_files, 1 ) ];
				} else {
					$file['name'] = 'http://digitalvidhya.com/';
				}
				$file['type'] = $type;
				$file['option'] = 'All';
				$files[] = $file;
			}
			if( ! empty( $files ) ) {
				$record->download_files = json_encode( $files );
				$record->save();
			}
			echo $title_text;
			echo '<br>';
			}
						
		}
		die();
	  }
	  
	  function get_content($url)
		{
			$ch = curl_init();

			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_HEADER, 0);

			ob_start();

			curl_exec ($ch);
			curl_close ($ch);
			$string = ob_get_contents();

			ob_end_clean();
			
			return $string;     
		}
		
		private function downloadFile($url, $path)
		{
			$newfname = $path;
			
			$file = fopen ($url, 'rb');
			//dd($file);
			if ($file) {
				$newf = fopen ($newfname, 'wb');
				
				if ($newf) {
					while(!feof($file)) {
						fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
					}
				}
			}
			if ($file) {
				fclose($file);
			}
			if ($newf) {
				fclose($newf);
			}
		}

}


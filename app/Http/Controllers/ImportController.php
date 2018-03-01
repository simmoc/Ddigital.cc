<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use DB;
use Input;
use Exception;
use Auth;
use Excel;

class ImportController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }

     /**
    * Display a listing of the resource.
    *
    * @return Response
    */
     public function index( $model )
     {
		$data['layout']      	= getLayout();
		if( $model == 'category' ) {
			if( $this->isModuleEligible('Categories', array('Import')) != '' )
			{
				return redirect( $this->isModuleEligible('Categories', array('Import')) );
			}
			$data['main_active'] 	= 'categories';
			$data['sub_active']     = 'import';
			$data['prev_title']        	= getPhrase( 'categories' );
			$data['title']        	= getPhrase( 'import categories' );
		} else if( $model == 'product' ) {
			if( $this->isModuleEligible('Products', array('Import')) != '' )
			{
				return redirect( $this->isModuleEligible('Products', array('Import')) );
			}
			$data['main_active'] 	= 'products';
			$data['sub_active']     = 'import';
			$data['prev_title']     = getPhrase( 'products' );
			$data['title']        	= getPhrase( 'import products' );
		} else if( $model == 'user' ) {
			if( $this->isModuleEligible('Users', array('Import')) != '' )
			{
				return redirect( $this->isModuleEligible('Users', array('Import')) );
			}
			$data['main_active'] 	= 'users';
			$data['sub_active']     = 'import';
			$data['prev_title']        	= getPhrase( 'users' );
			$data['title']        	= getPhrase( 'import users' );
		} else {
			if( $this->isModuleEligible('Categories', array('Import')) != '' )
			{
				return redirect( $this->isModuleEligible('Categories', array('Import')) );
			}
			$data['main_active'] 	= $model;
			$data['sub_active']     = 'import';
			$data['prev_title']        	= getPhrase( 'categories' );
			$data['title']        	= getPhrase( 'import ' . $model );
		}
		
		$data['model'] = $model;
        return view('import.import_form', $data);
     }
	 
	 public function readExcel(Request $request, $model )
     {
	$columns = array(
	'excel'  => 'bail|required|mimes:.xls,.xlsx,',
	);         
	$this->validate($request,$columns);

	$success_list = [];
	$failed_list = [];

       try{
        if(Input::hasFile('excel')){
          $path = Input::file('excel')->getRealPath();
          $data = Excel::load($path, function($reader) {
          })->get();
        
		//dd($data);
		$new_model = ucfirst($model);
		$app_model = "App\\{$new_model}";
		$records = $fields = array();
		$isHavingDuplicate = 0;
          if(!empty($data) && $data->count()){
            
            foreach ($data as $key => $value) {

              foreach($value as $record)
              {
				$user_record = array();
				$failed_length = count($failed_list);
				if( $model == 'category' )
				{
					$user_record['id'] = $record->id;
					$user_record['title'] = $record->category;
					$user_record['slug'] = $app_model::makeSlug($user_record['title']);					
					$user_record['description'] = $record->description;					
					$user_record['meta_tag_title'] = $record->meta_tag_title;
					$user_record['meta_tag_description'] = $record->meta_tag_description;
					$user_record['meta_tag_keywords'] = $record->meta_tag_keywords;
					$user_record['parent_id'] = $record->parent_id;
					$user_record['record_updated_by'] = current_user_id();					
					if( $this->isRecordExists($app_model, 'id', $user_record['id'], '=') )
					{
						$isHavingDuplicate = 1;
						$temp = array();
						$temp['record'] = $user_record;
						$temp['type'] ='Record already exists with this id';
						$failed_list[$failed_length] = (object)$temp;
						continue;
					}
					if( $this->isRecordExists($app_model, 'title', $user_record['title'], '=') )
					{
						$isHavingDuplicate = 1;
						$temp = array();
						$temp['record'] = $user_record;
						$temp['type'] ='Record already exists with this name';
						$failed_list[$failed_length] = (object)$temp;
						continue;
					}
				}
				if( $model == 'product' )
				{
					$user_record['name'] = $record->name;
					$user_record['slug'] = App\Product::makeSlug($user_record['name']);
					$user_record['description'] = $record->description;
					$user_record['price_type'] = 'default'; // We are giving import option for default price type only
					$user_record['price'] = $record->price;
					$user_record['download_files'] = $record->download_files_url; // Only one URL we are taking for import to avoid confusion
					$user_record['demo_link'] = $record->demo_link;
					$user_record['download_limits'] = $record->download_limits;
					$user_record['download_notes'] = $record->download_notes;
					$user_record['meta_tag_title'] = $record->meta_tag_title;
					$user_record['meta_tag_description'] = $record->meta_tag_description;
					$user_record['meta_tag_keywords'] = $record->meta_tag_keywords;
					if( $record->categories != '') {					
						$user_record['categories'] = json_encode( explode( ',', $record->categories ) );
					}
					$user_record['user_created'] = current_user_id();
					if( $user_record['name'] == '' ) {
						$isHavingDuplicate = 1;
						$temp = array();
						$temp['record'] = $user_record;
						$temp['type'] ='Product name empty';
						$failed_list[$failed_length] = (object)$temp;
						continue;
					}
					if( $this->isRecordExists($app_model, 'slug', $user_record['slug'], '=') )
					{
						$isHavingDuplicate = 1;
						$temp = array();
						$temp['record'] = $user_record;
						$temp['type'] ='Record already exists with this name';
						$failed_list[$failed_length] = (object)$temp;
						continue;
					} else {
						$product = new App\Product();
						$product->name 	= $user_record['name'];
						$product->slug 	= $user_record['slug'];
						$product->description 	= $user_record['description'];
						$product->price_type	= $user_record['price_type'];
						$product->price  = $user_record['price'];
						$product->download_files  = $user_record['download_files'];					
						$product->demo_link  = $user_record['demo_link'];
						$product->download_limits  = $user_record['download_limits'];
						$product->download_notes  = $user_record['download_notes'];
						$product->meta_tag_title  = $user_record['meta_tag_title'];
						$product->meta_tag_description  = $user_record['meta_tag_description'];
						$product->meta_tag_keywords  = $user_record['meta_tag_keywords'];
						$product->categories  = isset( $user_record['categories'] ) ? $user_record['categories'] : null;
						$product->user_created  = $user_record['user_created'];						
						$product->save();
						
						if( ! empty( $product->categories ) ) {
							$data = array();
							foreach( (array) json_decode( $product->categories ) as $key => $val ) {
								$data[] = array(
									'product_id' => $product->id,
									'category_id' => $val,
								);
							}
							App\Products_Categories::insert($data);
						}						
					}
				}
				if( $model == 'user' )
				{
					if( $record->email != '') 
					{
						$user_record['name'] = $record->name;
						$user_record['slug'] = $app_model::makeSlug($user_record['name']);					
						$user_record['email'] = $record->email;					
						$user_record['password'] = $record->password;
						$user_record['phone'] = $record->phone;
						$user_record['billing_address1'] = $record->billing_address1;
						if( in_array($record->role_id, array(OWNER_ROLE_ID, ADMIN_ROLE_ID, EXECUTIVE_ROLE_ID, VENDOR_ROLE_ID, USER_ROLE_ID)) ) {
							$user_record['role_id'] = $record->role_id;
						} else {
							$user_record['role_id'] = USER_ROLE_ID;
						}
						
						$user_record['created_by'] = current_user_id();	
//dd($user_record);						
						if( $this->isRecordExists($app_model, 'email', $user_record['email'], '=') )
						{
							$isHavingDuplicate = 1;
							$temp = array();
							$temp['record'] = $user_record;
							$temp['type'] ='Record already exists with this name';
							$failed_list[$failed_length] = (object)$temp;
							continue;
						}
						else {
						// Let us save Record.
						$user = new App\User();
						$user->name 	= $user_record['name'];
						$user->slug 	= $user_record['slug'];
						$user->email 	= $user_record['email'];
						$user->password	= bcrypt( $user_record['password'] );
						$user->role_id  = $user_record['role_id'];
						$user->billing_address1  = $user_record['billing_address1'];
						$user->save();
						$user->roles()->attach($user->role_id);
						}
					}
				}
				$records[] = $user_record;				
              }            
            }
			
            if( $model == 'user' || $model == 'product' ) {
				$success_list = $records;
			} else {
				if( $app_model::insert($records) )           
				   $success_list = $records;
				  }
			  }
        }      
     
       $this->excel_data['failed'] = $failed_list;
       $this->excel_data['success'] = $success_list;

       flash('success','record_added_successfully', 'success');
       if( $model == 'category' ) {
		   $fields = array(
			'title' => getPhrase('title'), // DB field => User Display
			'parent_id' => getPhrase('parent_id'),
			'description' => getPhrase('description'),
			'meta_tag_title' => getPhrase('meta_tag_title'),
			'meta_tag_description' => getPhrase('meta_tag_description'),
			'meta_tag_keywords' => getPhrase('meta_tag_keywords'),
			'show_in_menu' => getPhrase('show_in_menu'),
		   );
	   } elseif( $model == 'product' ) {
		   $fields = array(
			'name' => getPhrase('name'), // DB field => User Display
			'description' => getPhrase('description'),
			'price' => getPhrase('price'),
			'download_files_url' => getPhrase('download_files_url'),
			'download_limits' => getPhrase('download_limits'),
			'demo_link' => getPhrase('demo_link'),
			'download_notes' => getPhrase('download_notes'),			
			'meta_tag_title' => getPhrase('meta_tag_title'),
			'meta_tag_description' => getPhrase('meta_tag_description'),
			'meta_tag_keywords' => getPhrase('meta_tag_keywords'),
			'categories' => getPhrase('categories'),
		   );
	   } elseif( $model == 'user' ) {
		   $fields = array(
			'name' => getPhrase('name'), // DB field => User Display
			'email' => getPhrase('email'),
			'password' => getPhrase('password'),
			'phone' => getPhrase('phone'),
			'billing_address1' => getPhrase('billing_address1'),
			'role_id' => getPhrase('role_id'),
		   );
	   }
	   
	   $this->downloadExcel( $fields );

     }
     catch( \Illuminate\Database\QueryException $e)
     {
       echo $e->getMessage();die();
	   if(getSetting('show_foreign_key_constraint','module'))
       {
			$message = $e->errorInfo;
			if( is_array($message) ) {
				$message = $e->getMessage();
			}
          flash('oops...!',$message, 'error');
       }
       else {
          flash('oops...!','improper_sheet_uploaded', 'error');
       }
     }

        // URL_USERS_IMPORT_REPORT
       $data['failed_list']   =   $failed_list;
       $data['success_list']  =    $success_list;
       $data['records']      = FALSE;
       $data['layout']      = getLayout();	   
	   if( $model == 'category' ) {
			$data['main_active'] 	= 'categories';
			$data['sub_active']     = 'import';
			$data['prev_title']        	= getPhrase( 'categories' );
			$data['title']        	= getPhrase( 'import categories' );
		} else if( $model == 'product' ) {
			$data['main_active'] 	= 'products';
			$data['sub_active']     = 'import';
			$data['prev_title']     = getPhrase( 'products' );
			$data['title']        	= getPhrase( 'import products' );
		} else if( $model == 'user' ) {
			$data['main_active'] 	= 'users';
			$data['sub_active']     = 'import';
			$data['prev_title']        	= getPhrase( 'users' );
			$data['title']        	= getPhrase( 'import users' );
		} else {
			$data['main_active'] 	= $model;
			$data['sub_active']     = 'import';
			$data['prev_title']        	= getPhrase( 'categories' );
			$data['title']        	= getPhrase( 'import ' . $model );
		}
      $data['model'] = $model;
	  
       return view('import.import-result', $data);
 
     }
	 
}

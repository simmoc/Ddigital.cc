<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Product;
use App\Payment_Items;
use App\Product_Lisence;
use App\User;
use App\Payment;
use App\Coupon;
use App\Licence;
use Yajra\Datatables\Datatables;
use DB;
use Illuminate\Support\Facades\Hash;
use Input;
use File;
use Exception;
use Charts;
use Auth;
use Image; 

class ProductsController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }

    /**
     * This method returns the products dashborad view
     * @return [type] [description]
     */
      public function productsDashboard()
      {
      	if( $this->isModuleEligible('Products') )
		{
			return redirect( $this->isModuleEligible('Products') );
		}
		$data['layout']      	= getLayout();
		$data['main_active'] 	= 'products';
		$data['sub_active']     = 'list';
        $data['title']        	= getPhrase('products_dashboard');
		
        return view('products.dashboard', $data);
      }
   
     /**
    * Display a listing of the resource.
    *
    * @return Response
    */
     public function index()
     {
		if( $this->isModuleEligible('Products') )
		{
			return redirect( $this->isModuleEligible('Products') );
		}
		$data['layout']      	= getLayout();
		if(checkRole(getUserGrade(2))){
		$data['main_active'] 	= 'products';
		 }
	    else{
		$data['main_active'] 	= 'login';
	     }
		$data['sub_active']     = 'list';
        $data['title']        	= getPhrase('products');
        $data['active_title'] 	= getPhrase('dashboard');

        return view('products.list', $data);
     }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    
    public function getDatatable($slug = '')
    {
		$records = array(); 
		$records = Product::select(['id','name','user_created','slug', 'price', 'image', 'status','approved','price_type']);
		if( current_user_role() == VENDOR_ROLE_ID ) {
			$records->where('user_created', '=', current_user_id());
		}
		
		return Datatables::of($records)
		->addColumn('action', function ($records) {
		 
		  
		   $link_data =  '<a href="'.URL_PRODUCT_DETAILS.$records->id.'" class="btn btn-primary"><i class="fa fa-info-circle" aria-hidden="true"></i></a> ';
		  $link_data .=  ' <a href="'.URL_PRODUCTS_EDIT.$records->slug.'" class="btn btn-warning"><i class="fa fa-edit"></i> </a> ';
          $user = getUserRecord();
          $user_modules_permissions = (array)json_decode( $user->user_modules_permissions );
          if(isset($user_modules_permissions['Products']->Delete) || $user->role_id==1){
		  $link_data .=  ' <a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');" class="btn btn-danger"><i class="fa fa-trash"></i> </a> ';
			}			 
			return $link_data;
			})
		->editColumn('status', function($records) {
			return ucfirst($records->status);
		})
		->editColumn('name',function($records){

			return '<a href="'.URL_PRODUCT_DETAILS.$records->id.'">'.ucfirst($records->name).'</a>';
		})
		->editColumn('user_created',function($records){

			$user_details  = User::where('id',$records->user_created)->first();
			return  $user_details->name;
		})
		->editColumn('approved', function($records) {
			
		   if($records->approved==1){
		   	return $rec = '<span class="label label-success">'.getPhrase('approved').'</span>';
		   }
		   else{
		   	if(Auth::user()->role_id == VENDOR_ROLE_ID){
               
               return $rec = '<span class="label label-danger">'.getPhrase('not_approved').'</span>';

		   	}
		   	$rec = '<button class="btn btn-info btn-sm" onclick="approveProduct('.$records->id.');">'.getPhrase('approve').'</button>';
           return $rec;

		   }	

		})

		->editColumn('price', function($records){

			 $price = '<p>'.currency($records->price).'</p>';

			    return   $price .= '<p>'.getPhrase('price_type:').' '.'<strong>'.getPhrase($records->price_type).'</strong></p>';

		})
		 ->editColumn('image', function($records){
		 $image = DEFAULT_PRODUCT_IMAGE_THUMBNAIL;
            if($records->image){
            $image = '<img src="'.UPLOAD_URL_PRODUCTS.$records->image.'" height="50" width="50" />';
               return $image;
             }
           
             return '<img height="50" width="50" class="image" src="'.$image.'" />';
        })
		->removeColumn('id')
		->removeColumn('slug')
		->removeColumn('price_type')
		->make();
    }
	
	

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function create()
    {
        if( $this->isModuleEligible('Products', array('Add')) )
		{
			return redirect($this->isModuleEligible('Products', array('Add')) );
		}
		$data['record']         = FALSE;
        $data['layout']         = getLayout();
        $data['main_active']    = 'products';
        $data['sub_active']     = 'add';
        $data['title']          = getPhrase('Add products');
		
		$categories = App\Category::where('status', '=', 'Active');
		$categories_array = array();
		if( $categories->count() > 0 ) {
			foreach( $categories->get() as $category ) {
				if( $category->parent_id == 0 ) {
					$categories_array[ $category->id ] = $category->title;
					$subcats = App\Category::where('status', '=', 'Active')->where('parent_id', '=', $category->id);
					if( $subcats->count() > 0 ) {
						$subcats_array = array();
						foreach( $subcats->get() as $subcat ) {
							$subcats_array[ $subcat->id ] = $category->title . '->' . $subcat->title;
						}
						$categories_array[ $category->title.' '.'Categories' ] = $subcats_array;
					}
				}
			}
		}		
		$data['categories'] = $categories_array;
		
        return view('products.add-edit', $data);
    }

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function edit(Product $slug)
    {
         if( $this->isModuleEligible('Products', array('Edit')) )
		{
			return redirect( $this->isModuleEligible('Products', array('Edit')) );
		}
        if($isValid = $this->isValidRecord($slug))
          return redirect($isValid);  
    	$data['record']      	= $slug;
        $data['layout']      	= getLayout();
        $data['main_active'] 	= 'products';
        $data['sub_active']     = 'add';
        $data['title']        	= 'Edit Product';
		
		$categories = App\Category::where('status', '=', 'Active');
		$categories_array = array();
		if( $categories->count() > 0 ) {
			foreach( $categories->get() as $category ) {
				if( $category->parent_id == 0 ) {
					$categories_array[ $category->id ] = $category->title;
					$subcats = App\Category::where('status', '=', 'Active')->where('parent_id', '=', $category->id);
					if( $subcats->count() > 0 ) {
						$subcats_array = array();
						foreach( $subcats->get() as $subcat ) {
							$subcats_array[ $subcat->id ] = $category->title . '->' . $subcat->title;
						}
						$categories_array[ $category->title ] = $subcats_array;
					}
				}
			}
		}		
		$data['categories'] = $categories_array;
		
        return view('products.add-edit', $data);
    }

    public function update(Request $request, $slug)
    {
        if( $this->isModuleEligible('Products', array('Edit')) )
		{
			return redirect( $this->isModuleEligible('Products', array('Edit')) );
		}
		$record = Product::where('slug', $slug)->get()->first();
		$rules = [
			'name'  => 'required|max:256|unique:products,name,'.$record->id,
			'status'  => 'required',
			'description'  => 'required',
			'price_type' => 'required',
			'price' => 'required_if:price_type,default',
		];		
		$this->validate($request, $rules);
		 $name = $request->name;
		
		$download_files = $record->download_files;
		
		DB::beginTransaction();
		try{
		/**
		 * Check if the title of the record is changed, 
		 * if changed update the slug value based on the new title
		 */
		if($name != $record->name)
		 $record->slug = $record->makeSlug($name);
		$record->name = $name;
		$record->description		= $request->description;
		
		$record->licences		= json_encode( $request->licences );
		$record->licence_of_use		= $request->licence_of_use;
		$record->technical_info		= $request->technical_info;
		$record->product_belongsto		= $request->product_belongsto;
		
		$record->price_type = $request->price_type;
		$record->price = $request->price;
		$record->price_display_type 	= $request->price_display_type;
		$record->price_variations = json_encode( $request->digi_variable_prices );		
		$record->status		= $request->status;
		$record->is_featured		= $request->is_featured;
		$record->meta_tag_title		= $request->meta_tag_title;
		$record->meta_tag_description		= $request->meta_tag_description;
		$record->meta_tag_keywords		= $request->meta_tag_keywords;		
		$record->categories		= json_encode( $request->categories );
		$record->demo_link = $request->demo_link;
		$record->download_limits = ($request->download_limits == '') ? 0 : $request->download_limits;
		$record->download_notes = $request->download_notes;		
		$record->save();
		
		if( ! empty( $request->categories ) ) {
			$data = array();
			foreach( $request->categories as $key => $val ) {
				$data[] = array(
					'product_id' => $record->id,
					'category_id' => $val,
				);
			}
			App\Products_Categories::where('product_id', '=', $record->id)
			->delete();
			App\Products_Categories::insert( $data );
		}

		if( ! empty( $request->licences ) ) {
			$data = array();
			foreach( $request->licences as $key => $val ) {
				$data[] = array(
					'product_id' => $record->id,
					'lisence_id' => $val,
				);
			}
			App\Product_Lisence::where('product_id', '=', $record->id)
			->delete();
			App\Product_Lisence::insert( $data );
		}
		flash('Success','Record updated successfully', 'success');
		
		if($request->image) {

			$destinationPath = UPLOAD_PATH_PRODUCTS;
			
			$destinationPathThumb = UPLOAD_PATH_PRODUCTS_THUMBNAIL;
			$fileName = $record->id.'.'.$request->image->guessClientExtension();
			$width = 45;
			$height = 45;
			
			$this->deleteFile($fileName, $destinationPath);
			$this->deleteFile($fileName, $destinationPathThumb);
			
			$request->image->move($destinationPath, $fileName);
			
			Image::make($destinationPath.$fileName)->resize($width, $height)->save($destinationPathThumb.$fileName);
			
			$record->image = $fileName;
			$record->save();
		}
		//dd($request->digi_download_files);
		if( ! empty( $request->digi_download_files ) ) {			
			
			
			$files = $existing_indexes = array();
			foreach( $request->digi_download_files as $index => $file ) {				
				
				$fileName = '';
				if( $file['type'] == 'file') {

					if( isset($file['file']) ) {
						$destinationPath = UPLOAD_PATH_PRODUCTS_DOWNLOADS;
						$fileName = $record->name . '_'.$index.'.' . $file['file']->guessClientExtension();
						
						$this->deleteFile($fileName, $destinationPath);
						
						$file['file']->move($destinationPath, $fileName);
					} else {
						if( $download_files ) { // Let us preserve the previous name
							//$download_files = json_decode( (string)$download_files );
							//echo '<pre>';print_r($download_files);
							$fileName = isset($download_files[ $index ]) ? $download_files[ $index ] : '';							
						}
					}				
				} else {
					$fileName = $file['file'];
					$record->product_url = $fileName;
				}
				
				$files[$index] = array(
					'index' => isset($file['index']) ? $file['index'] : $index,
					'name' => $file['name'],
					'type' => $file['type'],
					'file_name' => $fileName,
					'option' => (isset($file['condition']) && $file['condition'] != '') ? $file['condition'] : 'All',
				);
				
				$existing_indexes[] = $index;
			}

//dd($files);
			// Let us delete old files
			if( $record->download_files != '' ) {
				$download_files = (array) json_decode( $record->download_files );
				$download_files_array = array();
				if( ! empty( $download_files ) ) {
					foreach( $download_files as $key => $info ) {
						$info = (array) $info;						
						$download_files_array[] = isset($info['index']) ? $info['index'] : $key;
					}
					$can_delete = array_diff_assoc( $download_files_array, $existing_indexes);
					if( ! empty( $can_delete ) ) {
						foreach($can_delete as $item ) {
							$this->deleteFile($item, UPLOAD_PATH_PRODUCTS_DOWNLOADS);
						}
					}
				}
			}
			
			if( ! empty( $files ) ) {
				$record->download_files = json_encode( $files );
				$record->save();
			}
		}

		DB::commit();
		} catch( Exception $ex ) {
			DB::rollBack();
			flash('Oops',$ex->getMessage(), 'overlay');
		}
    	return redirect(URL_PRODUCTS);
    }


    /**
     * This method will receive the submitted application form and inserts to db
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    { 


		if( $this->isModuleEligible('Products', array('Add')) )
		{
			return redirect( $this->isModuleEligible('Products', array('Add')) );
		}
		$rules = [
			'name'  => 'required|max:256|unique:products,name',
			'status'  => 'required',
			'description'  => 'required',
			'price_type' => 'required',
			'price' => 'required_if:price_type,default',
		];		
		$this->validate($request, $rules);
		
         DB::beginTransaction();
    	try {
	        $message = 'record_added_successfully';
			$record = new Product();
	         $admin_permission = getSetting('admin_approval_for_products','site_settings');
            if($admin_permission=='no' || Auth::user()->role_id == ADMIN_ROLE_ID || Auth::user()->role_id == OWNER_ROLE_ID){
             $record->approved = 1; 
            }
            else{
            	$record->approved = 0; 
            }
	        $name                       = $request->name;
	        $record->name 	            = $name;
	        $record->slug 	            = $record->makeSlug($name);
	        $record->description 	    = $request->description;
			$record->licences		    = json_encode($request->licences);
			$record->licence_of_use		= $request->licence_of_use;
			$record->technical_info		= $request->technical_info;
			$record->product_belongsto  = $request->product_belongsto;
			
			$record->price_type 	    = $request->price_type;
			if( $request->price_type == 'default') {
				$record->price 	= $request->price;
			} 
			else {
				$price_variations       = $request->digi_variable_prices;
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
				 // Let us save minimum price, if it is variable product
			}
			$record->price_display_type   = $request->price_display_type;
			$record->price_variations 	  = json_encode( $request->digi_variable_prices );			
			$record->status		          = $request->status;
			$record->is_featured		  = $request->is_featured;
			$record->meta_tag_title       = $request->meta_tag_title;
	        $record->meta_tag_description = $request->meta_tag_description;
            $record->meta_tag_keywords    = $request->meta_tag_keywords;
			$record->user_created         = Auth::user()->id;
			$record->categories 	      = json_encode( $request->categories );
			$record->demo_link            = $request->demo_link;
			$record->download_limits      = ($request->download_limits == '') ? 0 : $request->download_limits;
			$record->download_notes       = $request->download_notes;
			$record->save();
			if( ! empty( $request->categories ) ) {
				$data = array();
				foreach( $request->categories as $key => $val ) {
					$data[] = array(
						'product_id' => $record->id,
						'category_id' => $val,
					);
				}
				App\Products_Categories::insert($data);
			}

			if( ! empty( $request->licences ) ) {
				$data = array();
				foreach( $request->licences as $key => $val ) {
					$data[] = array(
						'product_id' => $record->id,
						'lisence_id' => $val,
					);
				}
				Product_Lisence::insert($data);
			}

			
			
	       	  // $message   = getPhrase('record_added_successfully');
           //    $exception = 0;

            $owner_details    = User::where('role_id','=',1)->first();
            $user_details    = User::where('id','=',Auth::user()->id)->first();
	       	 $email_template = 'product_adding';
	       	 $contact_message = 1;
                 

		   try{
			   sendEmail($email_template, array('name'=>$user_details->name, 
		          'email' => $user_details->email,'from_email'=>$user_details->email,'product_name'=>$request->name,'price'=>$request->price,'to_email'=>$owner_details->email), $contact_message);
		   } catch( Exception $e ) {
			   $message .= $e->getMessage();
		   }
			flash('Success',$message,'success');
		      
			if( $request->image ) {

				$destinationPath = UPLOAD_PATH_PRODUCTS;
				$destinationPathThumb = UPLOAD_PATH_PRODUCTS_THUMBNAIL;
				$fileName = $record->name.'.'.$request->image->guessClientExtension();
				$width = 45;
				$height = 45;
				
				$this->deleteFile($fileName, $destinationPath);
				$this->deleteFile($fileName, $destinationPathThumb);
				
				$request->image->move($destinationPath, $fileName);
				
				Image::make($destinationPath.$fileName)->resize($width, $height)->save($destinationPathThumb.$fileName);
				
				$record->image = $fileName;
				$record->save();
			}
			
			if( ! empty( $request->digi_download_files ) ) {			
				$files = $existing_indexes = array();
				foreach( $request->digi_download_files as $index => $file ) {				
					$fileName = '';
					if( $file['type'] == 'file') {
						//$filename = $this->uploadFile( array('request' => $request, 'destinationPath' => UPLOAD_PATH_PRODUCTS_DOWNLOADS, 'request_field' => 'digi_download_files', 'db_field' => 'download_files', 'file_index' => $index, 'prefix' => 'download'));
						if( isset($file['file']) ) {
							$destinationPath = UPLOAD_PATH_PRODUCTS_DOWNLOADS;
							$fileName = $record->name . '_'.$index.'.' . $file['file']->guessClientExtension();
							
							$this->deleteFile($fileName, $destinationPath);
							
							$file['file']->move($destinationPath, $fileName);
						}
					} 
					else {
						$fileName = $file['file'];
						$record->product_url = $fileName;
					}
					$files[$index] = array(
						'index' => isset($file['index']) ? $file['index'] : $index,
						'name' => $file['name'],
						'type' => $file['type'],
						'file_name' => $fileName,
						'option' => (isset($file['condition']) && $file['condition'] != '') ? $file['condition'] : 'All',
					);
					$existing_indexes[] = $index;
				}				
				if( ! empty( $files ) ) {
					$record->download_files = json_encode( $files );
					$record->save();
				}
			}
			DB::commit();

   		}
   		catch(Exception $ex) {
			DB::rollBack();
			flash('Oops',$ex->getMessage(), 'overlay');
   		}
   		return redirect(URL_PRODUCTS);
    }

    /**
     * This method will display the application details to the 
     * types of users and gives the option to move the record status from 
     * one stage to other stage
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function show($slug)
    {
		if( $this->isModuleEligible('Products', array('View')) )
		{
			return redirect( $this->isModuleEligible('Products', array('View')) );
		}
		$record = Product::where('slug','=',$slug)->first();

        if($isValid = $this->isValidRecord($record))
         return redirect($isValid);
        		
        $data['record']         = $record;
        $data['layout']         = getLayout();
        $data['main_active'] 	= 'products';
        $data['sub_active']     = 'list';
        $data['title']          = getPhrase('View : ') . $record->name;
        
        return view('products.show-details', $data);
    }

   

    /**
     * This method validates the record is valid or not and returns 
     * the URL to redirect if not valid
     * @param  [type]  $record [description]
     * @return boolean         [description]
     */
    public function isValidRecord($record)
    {
      if ($record === null) {
            flash('Ooops...!', 'Page not found', 'error');
            return $this->getRedirectUrl();
        }
        return FALSE;
    }

    public function getReturnUrl()
    {
      return URL_PRODUCTS;
    }
	
		
	/**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean 
     */
    public function delete($slug)
    {

        if($this->isModuleEligible('Products', array('Delete')) )
		{
			return redirect($this->isModuleEligible('Products', array('Delete')));
		}
		

		try{
        if(!env('DEMO_MODE')) {
            $is_eligible_to_delete = TRUE;
            $record = Product::where('slug', $slug)->first();           
            if($is_eligible_to_delete) {
                $record->delete();
                $response['status'] = 1;
                $response['message'] = getPhrase('record_deleted_successfully');
            }
            else {
                $response['status'] = 0;
                $response['message'] = getPhrase('this_record_is_in_use_in_other_modules');    
            }
           }
           else{
             $response['status'] = 1;
            $response['message'] = getPhrase('record_deleted_successfully');
           }
        }
         catch(Exception $e){
            $response['status'] = 0;
           if(getSetting('show_foreign_key_constraint','module'))
            $response['message'] =  $e->getMessage();
           else
            $response['message'] =  getPhrase('this_record_is_in_use_in_other_modules');
          }
        return json_encode($response);
    }
	
	public function getRemote(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $records = Product::where('name', 'like', "%$term%")->limit(5)->get();

        $formatted_output = [];

        foreach ($records as $record) {
            $formatted_output[] = ['id' => $record->id, 'text' => $record->name];
        }
        return \Response::json($formatted_output);
    }
	/**
	 * This Method display the dashboard of a particular product
	 * @param  [int] $id  [description]
	 * @return [type]     [description]
	 */
    public function detailsViewDashboard($id)
    {
        if(!checkRole(getUserGrade(4))){
        	prepareBlockUserMessage();
        	return back();
        }
    	$data['layout']      	= getLayout();
    	$total_amount           = Payment_Items::join('payments','payments.id','=','payment_id')
		                          ->where('item_id','=',$id)
		                          ->select('payments_items.after_discount')->get();

        $data['total_amount']   = $total_amount;

        $data['product_details']  = Product::where('id',$id)->first();
        $sales = Payment_Items::join('payments','payments.id','=','payment_id')
		                          ->where('item_id','=',$id)
		                          ->orderBy('payments_items.updated_at','desc')->get();
        $chartSettings = new App\ChartSettings();
        $colors = (object) $chartSettings->getRandomColors(count($sales));
        $i=0;
        $labels = [];
        $dataset = [];
        $dataset_label = [];
        $bgcolor = [];
        $border_color = [];
        foreach($sales as $record) {
            $quiz_record = $record->item_name;
            $labels = ["January", "February", "March", "April", "May", "June", "July"];
            $dataset[] = $record->quantity;
            $dataset_label = $record->item_name.' ('.$record->quantity.'sales)';
            $bgcolor[] = $colors->bgcolor[$i];
            $border_color[] = $colors->border_color[$i++];

        }
        
        
        $chart_data['type'] = 'line'; 
        //horizontalBar, bar, polarArea, line, doughnut, pie
        $chart_data['title'] = getPhrase('product_sales_per_month');  

        $chart_data['data']   = (object) array(
            'labels'            => $labels,
            'dataset'           => $dataset,
            'dataset_label'     => getPhrase('sales'),
            'bgcolor'           => $bgcolor,
            'border_color'      => $border_color
            );
        
        $data['chart_data'] = (object)$chart_data;


		$data['main_active'] 	= 'products';
		$data['sub_active']     = 'all';
		$data['product_id']		= $id;
        $data['title']        	= getPhrase('product_details');
		
        return view('products.details.dashboard', $data);

    }
    /**
     * This Method returns the categories details of a particular product
     * @param  [type] $productid [description]
     * @return [type]            [description]
     */
    public function detailsCategories($productid)
    {   
    	if(!checkRole(getUserGrade(4))){
        	prepareBlockUserMessage();
        	return back();
        }
        
        $data['categories']       = App\Products_Categories::where('product_id',$productid)->get();
        $data['product_details']  = Product::where('id',$productid)->first();
        $data['layout']      	= getLayout();
		$data['main_active'] 	= 'products';
		$data['sub_active']     = 'all';
		$data['product_id']		= $productid;
        $data['title']        	= getPhrase('product_categories');
		
        return view('products.details.categories', $data);     
    }
     
      /**
     * This Method returns the sales details of a particular product
     * @param  [type] $productid [description]
     * @return [type]            [description]
     */
    public function detailsSales($productid)
    {   
    	if(!checkRole(getUserGrade(4))){
        	prepareBlockUserMessage();
        	return back();
        }
        

		$data['layout']      	= getLayout();
		$data['main_active'] 	= 'products';
		$data['sub_active']     = 'all';
		$data['product_id']		= $productid;
		$data['product_details']  = Product::where('id',$productid)->first();
        $data['title']        	= getPhrase('product_sales');
		
        return view('products.details.sales', $data);     
    } 
    /**
     * This Method returns sales list of a particular product
     * @param  [type] $productid [description]
     * @return [type]            [description]
     */
    public function getSalesDetailsList($productid)
    {
    	$records = array(); 
		
		$records = Payment::join('payments_items','payments_items.payment_id','=','payments.id')
                     ->select(['payments.id','payments_items.item_id','payments_items.total_cost','payments_items.item_slug','payments_items.coupon_id','payments_items.discount_amount','payments_items.after_discount','payments.payment_gateway','payments.updated_at','payments.customer_first_name','payments.customer_last_name','payments.customer_email'])
                     ->where('payments.payment_status','=','success')
                     ->where('payments_items.item_id','=',$productid)
                     ->orderby('payments.updated_at','desc');
    
    return Datatables::of($records)
  
    ->editColumn('item_id', function($records) {
      
      $product_name = Product::where('id','=',$records->item_id)->first()->name;
      return $product_name;

    })
    
    ->editColumn('coupon_id', function($records) {
      
      if($records->coupon_id!=null){
        
        $coupon_name = Coupon::where('id','=',$records->coupon_id)->first()->code;
        return $coupon_name;

      }
      else{
        return '-';
      }

    })

      ->editColumn('discount_amount', function($records) {
     
     if($records->discount_amount!=null){ 
     return currency($records->discount_amount);
     }
     else{
      return '-';
     }

    })

   ->editColumn('total_cost', function($records) {
      
     return currency($records->total_cost);

    })


    ->editColumn('item_slug', function($records) {
       
       $record = Product::where('id','=',$records->item_id)->first()->user_created;      
       
       $owner_name   = User::where('id','=',$record)->first()->name;

       return $owner_name; 


    })

    ->editColumn('customer_first_name', function($records) {

      return $records->customer_first_name.' '.$records->customer_last_name;
       
    })
    ->removeColumn('id')
    ->removeColumn('customer_last_name')
    ->make();
    }

    /**
      * This Method is used to change the product approve status
      * @param  Request $request [description]
      * @return [type]           [description]
      */
    public function approveProductByAdmin(Request $request)
    {
    	$record              = Product::where('id','=',$request->product_id)->first();
    	$user_details        = User::where('id','=',$record->user_created)->first();
    	$owner_details       = User::where('id','=',Auth::user()->id)->first();
    	$record->approved    = 1;
    	$record->approved_by = Auth::user()->id;
    	$record->save();
    	$email_template = 'product_approve';
    	$contact_message = 1;
    	
    	 sendEmail($email_template, array('name'=>'Product Approve', 
		         'product_name'=>$record->name,'to_email'=>$user_details->email,'from_email'=>$owner_details->email,'user_name'=>$user_details->name),$contact_message);
    	flash('success','This Product Is Approved Successfully','success');

    	return back();
    }

    /**
     * This Method is used to delete uploaded files of selected product
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deleteProductFile(Request $request)
    {
    	$path  = public_path()."public/uploads/products/downloads".'/'.$request->product_file;
    	File::delete($path);
    	 DB::table('products')->where('id','=',$request->product_id)->update(['download_files' =>NULL,'product_url'=>NULL]);
        flash('Success','Data cleared successfully','success');
        return back();
    }
}

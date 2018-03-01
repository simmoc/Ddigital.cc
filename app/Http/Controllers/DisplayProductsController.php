<?php

namespace App\Http\Controllers;

//use Request;
use Illuminate\Http\Request;
use Response;
use \App;
use App\Product;
use App\User;
use App\Offers;
use Yajra\Datatables\Datatables;
use DB;
use Illuminate\Support\Facades\Hash;
use Input;
use File;
use Exception;
use Auth;
use Cart;

class DisplayProductsController extends Controller
{
    public function __construct()
    {
         $this->middleware('web');
    }

     /**
    * Display a listing of the resource.
    *
    * @return Response
    */
     public function index( Request $request, $category = '', $sub_category = '' )
     {  
     	// dd($request);
     	
		$data['layout']      	= getLayout();
		$data['main_active'] 	= 'products';
		$urlparams = $request->all();
		if( isset($urlparams['category']) ) {
			$category = $urlparams['category'];
		}
		if( isset($urlparams['sub-category']) ) {
			$sub_category = $urlparams['sub-category'];
		}
		$data['selected_category']     = $category;
        $data['selected_sub_category'] = $sub_category;
		$data['title'] = getPhrase('products');
		$params = array();
		if( $request->ajax() ) 
		{			
			if( $request->param == 'latest' ) {
				$params['orderby'] = 'latest';
			}
			if( $request->param == 'free' ) {
				$params['free'] = 'free';
			}
			if( $request->param == 'popular' ) {
				$params['popular'] = 'popular';
			}
			if( $request->param == 'featured' ) {
				$params['featured'] = 'featured';
			}			
		}
		else
		{
			if( isset($urlparams['orderby']) ) {
				$params['orderby'] = 'latest';
			}
			if( isset($urlparams['free']) ) {
				$params['free'] = 'free';
			}
			if( isset($urlparams['popular']) ) {
				$params['popular'] = 'popular';
			}
			if( $request->param == 'featured' ) {
				$params['featured'] = 'featured';
			}
		}
		if( $category != '') {
			if( $sub_category != '' ) {
				$params = array('category' => $category, 'sub_category' => $sub_category);
			} else {
				$params = array('category' => $category);
			}
		}
		if( isset($urlparams['title']) ) {
			$params['title'] = $urlparams['title'];
		}
		if( isset($urlparams['tag']) ) {
			$params['tag'] = $urlparams['tag'];
		}
		$data['products'] = App\Product::getProducts( $params )->paginate( PRODUCTS_DISPLAY_SIZE );
		
		if ($request->ajax()) {
			
			return view('displayproducts.products', ['products' => $data['products']]);
		}

        return view('displayproducts.index-ajax', $data);
     }


     public function viewMoreProducts()
     {

     	$data['layout']      	= getLayout();
		$data['main_active'] 	= 'home';


     	
     }

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function showDetails( $slug )
    {
    	
		$record = Product::where('slug', '=', $slug)->first();

		if(null == $record) {
			prepareBlockUserMessage();
			return back()->withErrors('msg', getPhrase('No details found'));
		}
		$record->increment('views_count', 1);
    	$data['product']      	= $record;
    	$availablein_offer = Offers::where('product_id','=',$record->id)->first();
		if($availablein_offer!=null){
		 
		 $data['offer_price']   = $availablein_offer->offer_price;	

		}
        $data['main_active'] 	= 'products';
        $data['title']        	= ($record->meta_tag_title != '') ? $record->meta_tag_title : $record->name;
		
		$data['meta_description'] = $record->meta_tag_description;
		$data['meta_tag_keywords'] = $record->meta_tag_keywords;
        return view('displayproducts.show-details', $data);
    }

    public function addToCart(Request $request, $slug)
    {
        $record = Product::where('slug', $slug)->get()->first();
		
		$rules = [
			'id'  => 'required|exists:products,id',
			'name'  => 'required',
			'price'  => 'required',
		];		
		$this->validate($request, $rules);
		try{
			$duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
				return $cartItem->id === $request->id;
			});

			if (!$duplicates->isEmpty()) {
				return redirect('cart')->withSuccessMessage('Item is already in your cart!');
			}

			Cart::add($request->id, $request->name, 1, $request->price)->associate('App\Product');
			
			flash('Success','Item added successfully', 'success');
		} catch( Exception $ex ) {
			flash('Oops',$ex->getMessage(), 'overlay');
		}
    	return redirect(URL_PRODUCTS);
    }
	
	public function cart()
	{
		$data['main_active'] 	= 'products';
        $data['title']        	= 'Edit Product';
		return view('displayproducts.cart', $data);
	}


    /**
     * This method will receive the submitted application form and inserts to db
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
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
	        $record = new Product();
	        $name = $request->name;
	        $record->name 	= $name;
	        $record->slug 	= $record->makeSlug($name);
	        $record->description 	= $request->description;
			
			$record->price_type 	= $request->price_type;
			$record->price 	= $request->price;			
			$record->price_variations 	= json_encode( $request->digi_variable_prices );			
			$record->status		= $request->status;
			$record->meta_tag_title = $request->meta_tag_title;
	        $record->meta_tag_description	= $request->meta_tag_description;
            $record->meta_tag_keywords  = $request->meta_tag_keywords;
			$record->user_created = Auth::user()->id;
			$record->categories 	= json_encode( $request->categories );
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
				App\Products_Categories::insert( $data );
			}
			
	       	flash('Success','Record updated successfully', 'success');
	       	
			$this->uploadFile( array('request' => $request, 'model' => $record, 'destinationPath' => UPLOAD_PATH_PRODUCTS, 'destinationPathThumbs' => UPLOAD_PATH_PRODUCTS_THUMBNAIL, 'request_field' => 'image', 'db_field' => 'image')); // $params (request, model, destinationPath, destinationPathThumbs, request_field, db_field, thumbsize)
			
			if( ! empty( $request->digi_download_files ) ) {			
				$files = $existing_indexes = array();
				foreach( $request->digi_download_files as $index => $file ) {				
					
					if( $file['type'] == 'file') {
					$filename = $this->uploadFile( array('request' => $request, 'destinationPath' => UPLOAD_PATH_PRODUCTS_DOWNLOADS, 'request_field' => 'digi_download_files', 'db_field' => 'download_files', 'file_index' => $index, 'prefix' => 'download'));
					} else {
						$filename = $file['file'];
					}
					$files[] = array(
						'index' => isset($file['index']) ? $file['index'] : $index,
						'name' => $file['name'],
						'type' => $file['type'],
						'file_name' => $filename,
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
	
	public function showVendor( Request $request, $slug )
	{
		$record = User::where('slug', '=', $slug)->first();
		if($isValid = $this->isValidRecord($record))
         return redirect($isValid);
	 
		$data['user']      	    = $record;
        $data['main_active'] 	= 'products';
        $data['title']        	= 'show vendor';
		
		$params = array('user_created' => $record->id);
		$data['products'] = App\Product::getProducts( $params )->paginate( PRODUCTS_DISPLAY_SIZE );
		$data['selected_category']     = '';
        $data['selected_sub_category'] = '';
		if ($request->ajax()) {
			return view('displayproducts.products', ['products' => $data['products']]);
		}
        return view('displayproducts.show-vendor', $data);
	}

	public function viewAllOffers()
	{
		$data['title']  = getPhrase('all_offers');
		$data['main_active']    = 'Home';
        $data['sub_active']     = 'Home';
		$data['active_title']  = 'Home';
		return view('displayproducts.offers',$data);
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Coupon;
use App\User;
use Yajra\Datatables\Datatables;
use DB;
use Input;
use Exception;
use Auth;


class CouponsController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }
      /**
       * This Method shows the dashborad of the coupons module
       * @param string $value [description]
       */
      public function couponsDashboard()
      {  
        if( $this->isModuleEligible('Coupons') )
		{
			return redirect( $this->isModuleEligible('Coupons') );
		}
        $data['layout']       = getLayout();
        $data['main_active']    = 'coupons';
        $data['sub_active']     = 'all';
        $data['title']          = getPhrase('Coupons');

        return view('coupons.dashboard', $data);
      }


     /**
    * Display a listing of the resource.
    *
    * @return Response
    */
     public function index()
     {
		if( $this->isModuleEligible('Coupons') )
		{
			return redirect( $this->isModuleEligible('Coupons') );
		}
		$data['layout']      	= getLayout();
		$data['main_active'] 	= 'coupons';
		$data['sub_active']     = 'list';
        $data['title']        	= getPhrase('Coupons');
        return view('coupons.list', $data);
     }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    
    public function getDatatable($slug = '')
    {
		$records = array(); 
		$records = Coupon::select(['id','title','slug', 'code','type','value','start_date', 'end_date', 'status']);
		
		return Datatables::of($records)
		->addColumn('action', function ($records) {
		 
		  $link_data =  '<a href="'.URL_COUPONS_VIEW.$records->slug.'" class="btn btn-primary"><i class="fa fa-search"></i> </a> ';
		  $link_data .=  ' <a href="'.URL_COUPONS_EDIT.$records->slug.'" class="btn btn-warning"><i class="fa fa-edit"></i> </a> ';
		  $link_data .=  ' <a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');" class="btn btn-danger"><i class="fa fa-trash"></i> </a> ';
						 
			return $link_data;
			})
        
		->editColumn('status', function($records) {
              
              if($records->status==1){
                return ucfirst('active');
              }
              else{
                return ucfirst('inactive');
              }
    
			
		})
        ->editColumn('type', function($records) {
            return ucfirst($records->type);
        })
       
		->removeColumn('id')
		->removeColumn('slug')
		->make();
    }
	
	

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function create()
    {
        if( $this->isModuleEligible('Coupons', array('Add')) )
		{
			return redirect( $this->isModuleEligible('Coupons', array( 'Add' )) );
		}
		$data['record']         = FALSE;
        $data['layout']         = getLayout();
        $data['main_active']    = 'coupons';
        $data['sub_active']     = 'add';
        $data['title']          = getPhrase('add_coupon');
        $data['categories']     = array_pluck( App\Category::where('status', '=', 'Active')->get(), 'title', 'id');             
		$data['products']     = array_pluck( App\Product::where('status', '=', 'Active')->get(), 'name', 'id');				
        return view('coupons.add-edit', $data);
    }

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function edit(Coupon $slug)
    {
        if( $this->isModuleEligible('Coupons', array('Edit')) )
		{
			return redirect( $this->isModuleEligible('Coupons', array( 'Edit' )) );
		}
		if($isValid = $this->isValidRecord($slug))
          return redirect($isValid);  
    	$data['record']      	= $slug;

        $data['layout']      	= getLayout();
        $data['main_active'] 	= 'coupons';
        $data['sub_active']     = 'add';
        $data['title']        	= getPhrase('edit_coupon');
		$data['categories'] = array_pluck( App\Category::where('status', '=', 'Active')->get(), 'title', 'id');
        $data['products']     = array_pluck( App\Product::where('status', '=', 'Active')->get(), 'name', 'id'); 	
        return view('coupons.add-edit', $data);
    }

    public function update(Request $request, $slug)
    {
        if( $this->isModuleEligible('Coupons', array('Edit')) )
		{
			return redirect( $this->isModuleEligible('Coupons', array( 'Edit' )) );
		}
		$record = Coupon::where('slug', $slug)->get()->first();
		$rules = [
        'title'  => 'required|max:256|unique:coupons,title,'.$record->id,
		'code'  => 'required|max:20|unique:coupons,code,'.$record->id,
		'type'  => 'required',
		'value'  => 'required|numeric',
		'start_date'  => 'required|date',
		'end_date'  => 'required|date|different:start_date',
		'max_users' => 'numeric',
		'minimum_amount' => 'numeric',
		'status'  => 'required',
        ];
		if( $request->type == 'percent' ) {
			$rules['value'] = 'required|numeric|between:0,100';
		}
		//dd($rules);
		$this->validate($request, $rules);
		$name = $request->title;		 
		/**
		 * Check if the title of the record is changed, 
		 * if changed update the slug value based on the new title
		 */
		if($name != $record->title)
		$record->slug = $record->makeSlug($name);
		$record->title = $name;
		$record->description 	= $request->description;
		$record->code = $request->code;
		$record->type	= $request->type;
		$record->value  = $request->value;
         if($request->max_discount_amount){
                $record->max_discount_amount  = $request->max_discount_amount;
            }
		$record->start_date		= $request->start_date;
		$record->end_date		= $request->end_date;
		$record->minimum_amount		= ($request->minimum_amount != '') ? $request->minimum_amount : 0;
		$record->max_users		= ($request->max_users != '') ? $request->max_users : 0;
		$record->user_once_per_customer		= $request->user_once_per_customer;
		$record->categories		= json_encode( $request->categories );
		$record->exclude_products		= json_encode( $request->exclude_products );
		$record->status		= $request->status;		
		$record->save();
		flash('success','Record Updated Successfully', 'success');
    	return redirect(URL_COUPONS);
    }


    /**
     * This method will receive the submitted application form and inserts to db
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {    	
		if( $this->isModuleEligible('Coupons', array('Add')) )
		{
			return redirect( $this->isModuleEligible('Coupons', array( 'Add' )) );
		}
		$rules = [
        'title'  => 'required|max:256|unique:coupons,title',
		'code'  => 'required|max:20|unique:coupons,code',
		'type'  => 'required',
		'value'  => 'required|numeric',
		'start_date'  => 'required|date',
		'end_date'  => 'required|date|different:start_date',
		'max_users' => 'numeric',
		'minimum_amount' => 'numeric',
		'status'  => 'required',		
        ];
		if( $request->type == 'percent' ) {
			$rules['value'] = 'required|numeric|between:0,100';
		}
		$this->validate($request, $rules);
		
         DB::beginTransaction();
    	try {
	        $record = new Coupon();
	        $title = $request->title;
	        $record->title 	= $title;
	        $record->slug 	= $record->makeSlug($title);
	        $record->description 	= $request->description;
            $record->code = $request->code;
	        $record->type	= $request->type;
            $record->value  = $request->value;
            if($request->max_discount_amount){
                $record->max_discount_amount  = $request->max_discount_amount;
            }
            $record->start_date		= $request->start_date;	
			$record->end_date		= $request->end_date;
			$record->minimum_amount		= ($request->minimum_amount != '') ? $request->minimum_amount : 0;
			$record->max_users		= ($request->max_users != '') ? $request->max_users : 0;
			$record->user_once_per_customer		= $request->user_once_per_customer;
			$record->categories		= json_encode( $request->categories );
			$record->exclude_products		= json_encode( $request->exclude_products );
			$record->status		= $request->status;
			$record->user_created = Auth::user()->id;			
			$record->save();
	       	flash('Success','record_added_successfully', 'success');
	       	DB::commit();
   		}
   		catch(Exception $ex) {
   			  DB::rollBack();
   				flash('Oops',$ex->getMessage(), 'overlay');
   		}
   		return redirect(URL_COUPONS);
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
		if( $this->isModuleEligible('Coupons', array('View')) )
		{
			return redirect( $this->isModuleEligible('Coupons', array( 'View' )) );
		}
		$record = Coupon::where('slug','=',$slug)->first();

        if($isValid = $this->isValidRecord($record))
         return redirect($isValid);
        
        $data['record']         = $record;
        $data['layout']         = getLayout();
        $data['main_active'] 	= 'coupons';
        $data['sub_active']     = 'list';
        $data['title']          = getPhrase('View Template');
        
        return view('coupons.show-details', $data);
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
      return URL_COUPONS;
    }
	
		
	/**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean 
     */
    public function delete($slug)
    {
        if( $this->isModuleEligible('Coupons', array('Delete')) )
		{
			return redirect( $this->isModuleEligible('Coupons', array( 'Delete' )) );
		}
		try{
        if(!env('DEMO_MODE')) {
            $is_eligible_to_delete = TRUE;
            $record = Coupon::where('slug', $slug)->first();           
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
}

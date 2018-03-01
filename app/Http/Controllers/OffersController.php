<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Offers;
use Yajra\Datatables\Datatables;
use DB;
use Illuminate\Support\Facades\Hash;
use Input;
use File;
use Exception;
use Auth;
use Image; 

class OffersController extends Controller
{
  //   public function __construct()
  //   {
  //        $this->middleware('auth');
		// define('UPLOAD_PATH_OFFERS', "uploads/offers/");
		// define('UPLOAD_PATH_OFFERS_THUMBNAIL', 'uploads/offers/thumbnail/');
		// define('UPLOAD_URL_OFFERS', PREFIX . 'uploads/offers/');
		// define('UPLOAD_URL_OFFERS_THUMBNAIL', PREFIX . 'uploads/offers/thumbnail/');

  //   }
       
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
     public function index()
     {
		if( $this->isModuleEligible('Offers') != '' )
		{
			return redirect( $this->isModuleEligible('Offers') );
		}
		$data['layout']      	= getLayout();
		$data['main_active'] 	= 'offers';
		$data['sub_active']     = 'list';
        $data['title']        	= getPhrase('Offers');
        return view('offers.list', $data);
     }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    
    public function getDatatable($slug = '')
    {
		$records = array(); 
		DB::statement(DB::raw('set @rownum=0'));
		$records = Offers::select([ DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'id','title','start_date_time','end_date_time','slug', 'status']);
		
		return Datatables::of($records)
		->addColumn('action', function ($records) {
		 
		  $link_data =  '<a href="'.URL_OFFERS_VIEW.$records->slug.'" class="btn btn-primary"><i class="fa fa-info-circle" aria-hidden="true"></i>
 </a> ';
		  $link_data .=  ' <a href="'.URL_OFFERS_EDIT.$records->slug.'" class="btn btn-warning"><i class="fa fa-edit"></i> </a> ';
		  $link_data .=  ' <a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');" class="btn btn-danger"><i class="fa fa-trash"></i> </a> ';
						 
			return $link_data;
			})
		->editColumn('status', function($records) {
			return ucfirst($records->status);
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
        if( $this->isModuleEligible('Offers', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Offers', array('Add')) );
		}
		$data['record']         = FALSE;
        $data['layout']         = getLayout();
        $data['main_active']    = 'offers';
        $data['sub_active']     = 'add';
        $data['title']          = getPhrase('Add Offers');		
				
        return view('offers.add-edit', $data);
    }

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function edit(Offers $slug)
    {
        if( $this->isModuleEligible('Offers', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Offers', array('Edit')) );
		} 
        if($isValid = $this->isValidRecord($slug))
          return redirect($isValid);  
    	$data['record']      	= $slug;

        $data['layout']      	= getLayout();
        $data['main_active'] 	= 'offers';
        $data['sub_active']     = 'add';
        $data['title']        	= 'Edit Offers';       
        return view('offers.add-edit', $data);
    }

    public function update(Request $request, $slug)
    {
        if( $this->isModuleEligible('Offers', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Offers', array('Edit')) );
		}
		$record = Offers::where('slug', $slug)->get()->first();
		$this->validate($request, [
        'title'  => 'required|max:256|unique:offers,title,'.$record->id,
		'start_date_time'  => 'required',
		'end_date_time'  => 'required',
		'product_id'  => 'required',		
		'status'  => 'required',
        'description'  => 'required',
		'offer_price'  => 'required',
        ]);
		 $name = $request->title;
		 
		/**
		 * Check if the title of the record is changed, 
		 * if changed update the slug value based on the new title
		 */
		if($name != $record->title)
		 $record->slug = $record->makeSlug($name);
		$record->title = $name;
		$record->description 	= $request->description;
		$record->product_id = $request->product_id;
		$record->use_product_title	= $request->use_product_title;
		$record->use_product_description  = $request->use_product_description;
		$record->use_product_image  = $request->use_product_image;
		$record->start_date_time 	= $request->start_date_time;
        $record->end_date_time  = $request->end_date_time;
		$record->offer_price 	= $request->offer_price;
		$record->status		= $request->status;			
		$record->save();
		$this->processUpload($request, $record);
		flash('success','record_updated_successfully', 'success');
    	return redirect(URL_OFFERS);
    }
	
	public function processUpload(Request $request, Offers $record)
	{
	 if ($request->hasFile('image')) {
	  
		$old_image = $record->image;

		$destinationPath      = UPLOAD_PATH_OFFERS;
		$destinationPathThumb = UPLOAD_PATH_OFFERS_THUMBNAIL;

		$fileName = $record->id.'.'.$request->image->guessClientExtension();
		;
		$request->file('image')->move($destinationPath, $fileName);

		$record->image = $fileName;

		Image::make($destinationPath.$fileName)->fit(160)->save($destinationPath.$fileName);

		Image::make($destinationPath.$fileName)->fit(570)->save($destinationPathThumb.$fileName);
		$record->save();

		$this->deleteFile($old_image, UPLOAD_PATH_OFFERS);
		$this->deleteFile($old_image, UPLOAD_PATH_OFFERS_THUMBNAIL);
	}
	}


    /**
     * This method will receive the submitted application form and inserts to db
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
    	if( $this->isModuleEligible('Offers', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Offers', array('Add')) );
		}
		$this->validate($request, [
			'title'  => 'required|max:256|unique:offers,title',		
			'start_date_time'  => 'required',
			'end_date_time'  => 'required',
			'product_id'  => 'required',		
			'status'  => 'required',
            'description'  => 'required',
			'offer_price'  => 'required',
        ]);
		
         DB::beginTransaction();
    	try {
	        $record = new Offers();
	        $title = $request->title;
	        $record->title 	= $title;
	        $record->slug 	= $record->makeSlug($title);
	        $record->description 	= $request->description;			
            $record->product_id = $request->product_id;
	        $record->use_product_title	= $request->use_product_title;
            $record->use_product_description  = $request->use_product_description;
			$record->use_product_image  = $request->use_product_image;
			$record->start_date_time 	= $request->start_date_time;
            $record->end_date_time  = $request->end_date_time;
			$record->offer_price 	= $request->offer_price;
            $record->status		= $request->status;			
			$record->save();
			$this->processUpload($request, $record);
	       	flash('Success','Record updated successfully', 'success');
	       	  DB::commit();
   		}
   		catch(Exception $ex) {
   			  DB::rollBack();
   				flash('Oops',$ex->getMessage(), 'overlay');
   		}
   		return redirect(URL_OFFERS);
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
		if( $this->isModuleEligible('Offers', array('View')) != '' )
		{
			return redirect( $this->isModuleEligible('Offers', array('View')) );
		}
		$record = Offers::where('slug','=',$slug)->first();

        if($isValid = $this->isValidRecord($record))
         return redirect($isValid);
        
        $data['record']         = $record;
        $data['layout']         = getLayout();
        $data['main_active'] 	= 'offers';
        $data['sub_active']     = 'list';
        $data['title']          = getPhrase('View Offer');
        
        return view('offers.show-details', $data);
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
      return URL_OFFERS;
    }
	
		
	/**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean 
     */
    public function delete($slug)
    {
        if( $this->isModuleEligible('Offers', array('Delete')) != '' )
		{
			return redirect( $this->isModuleEligible('Offers', array('Delete')) );
		}
		try{
        if(!env('DEMO_MODE')) {
            $is_eligible_to_delete = TRUE;
            $record = Offers::where('slug', $slug)->first();           
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

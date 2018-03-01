<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Faq;
use App\User;
use Yajra\Datatables\Datatables;
use DB;
use Illuminate\Support\Facades\Hash;
use Input;
use Exception;
use Auth;

class FaqController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }
 


    public function dashborad()
    {
        if( $this->isModuleEligible('Faq') != '' )
		{
			return redirect( $this->isModuleEligible('Faq') );
		}

        $data['layout']         = getLayout();
        $data['main_active']    = 'faq';
        $data['sub_active']     = 'all';
        $data['title']          = 'FAQs'.' '.getPhrase('dashboard');

        return view('faq.dashboard', $data);
    }
     /**
    * Display a listing of the resource.
    *
    * @return Response
    */
     public function index()
     {
		if( $this->isModuleEligible('Faq') != '' )
		{
			return redirect( $this->isModuleEligible('Faq') );
		}
		$data['layout']      	= getLayout();
        $data['main_active'] 	= 'faq';
        $data['sub_active']     = 'list';
        $data['title']        	= 'FAQs';

        return view('faq.list', $data);
     }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    
    public function getDatatable()
    {
		 $records = Faq::select(['faqs.id', 'faqs.slug', 'faqs.title', 'faqs.description', 'faqs.status'])->get();

		 $table = Datatables::of($records);
		 $table->addColumn('action', function ($records) {
			 
			  $link_data = '';
			  //$link_data .=  '<a href="'.URL_FAQ_VIEW.$records->slug.'" class="btn btn-primary"><i class="fa fa-search"></i> </a> ';
			  $link_data .=  ' <a href="'.URL_FAQ_EDIT.$records->slug.'" class="btn btn-warning"><i class="fa fa-edit"></i> </a> ';
			  $link_data .=  ' <a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');" class="btn btn-danger"><i class="fa fa-trash"></i> </a> ';
							 
				return $link_data;
			});
		
		$table->editColumn('status', function($records) {
				return ucfirst($records->status);
			});
		$table->removeColumn('id')->removeColumn('slug')->removeColumn('description');
		
		 return $table->make();
    }
	
	

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function create()
    {
        if( $this->isModuleEligible('Faq', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Faq', array('Add')) );
		}
		$data['record']         = FALSE;
        $data['layout']         = getLayout();
        $data['main_active']    = 'faq';
        $data['sub_active']     = 'add';
        $data['title']          = 'Add FAQ';		
        return view('faq.add-edit', $data);
    }

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function edit(Faq $slug)
    {
        if( $this->isModuleEligible('Faq', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Faq', array('Edit')) );
		} 
        if($isValid = $this->isValidRecord($slug))
          return redirect($isValid);  
    	$data['record']      	= $slug;

        $data['layout']      	= getLayout();
        $data['main_active'] 	= 'faq';
        $data['sub_active']     = 'add';
        $data['title']        	= 'Edit FAQ';       
        return view('faq.add-edit', $data);
    }

    public function update(Request $request, $slug)
    {
        if( $this->isModuleEligible('Faq', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Faq', array('Edit')) );
		}
		$record = Faq::where('slug', $slug)->get()->first();
		$this->validate($request, [
       	 'title'          => 'bail|required|max:60|unique:faqs,title,'.$record->id,
		 'description' => 'required',
          ]);
		 $name = $request->title;
		 
		/**
		 * Check if the title of the record is changed, 
		 * if changed update the slug value based on the new title
		 */
		if($name != $record->title)
		 $record->slug = $record->makeSlug($name);
		$record->title = $name;
		$record->description			= $request->description;
		$record->status 			= $request->status;
		$record->icon 			= $request->icon;
		$record->save();
		
		flash('success','record_updated_successfully', 'success');
    	return redirect(URL_FAQ);
    }


    /**
     * This method will receive the submitted application form and inserts to db
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        // dd($request);
    	if( $this->isModuleEligible('Faq', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Faq', array('Add')) );
		}
		$rules = [
			'title'  => 'required',
			'description' => 'required',
		];
		$this->validate($request, $rules);
		
         DB::beginTransaction();
    	try {
	        $ta 			 = new Faq();
	        $title           = $request->title;
	        $ta->title 	     = $title;
	        $ta->slug 	     = $ta->makeSlug($title);
	        $ta->description = $request->description;
            $ta->status      = $request->status;
			$ta->icon    = $request->icon;
			$ta->save();
	       	flash('Success','Record updated successfully', 'overlay');
	       	  DB::commit();
   		}
   		catch(Exception $ex) {
   			  DB::rollBack();
   				flash('Oops',$ex->getMessage(), 'overlay');
   		}
   		return redirect(URL_FAQ);


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
        if( $this->isModuleEligible('Faq', array('View')) != '' )
		{
			return redirect( $this->isModuleEligible('Faq', array('View')) );
		}
		$record = Faq::where('slug','=',$slug)->first();

        if($isValid = $this->isValidRecord($record))
         return redirect($isValid);
        
        $data['record']         = $record;
        $data['layout']         = getLayout();
        $data['main_active'] 	= 'faq';
        $data['sub_active']     = 'list';
        $data['title']          = 'View Tour';
        
        return view('faq.show-details', $data);
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
      return URL_FAQ;
    }
	
		
	/**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean 
     */
    public function delete($slug)
    {
        if( $this->isModuleEligible('Faq', array('Delete')) != '' )
		{
			return redirect( $this->isModuleEligible('Faq', array('Delete')) );
		}
		$response = array();
		try{
        if(!env('DEMO_MODE')) {
			$record = Faq::where('slug', $slug)->first();            
			$record->delete();
           }
           else{
             $response['status'] = 1;
            $response['message'] = getPhrase('record_deleted_successfully');
           }
        }
         catch(Exception $e){
            $response['status'] = 0;
            $response['message'] =  $e->getMessage();
          }
        return json_encode($response);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Templates;
use App\User;
use Yajra\Datatables\Datatables;
use DB;
use Illuminate\Support\Facades\Hash;
use Input;
use File;
use Exception;
use Auth;
use Image; 

class TemplatesController extends Controller
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
     public function index($slug = '')
     {
		if( $this->isModuleEligible('Email_Templates') )
		{
			return redirect( $this->isModuleEligible('Email_Templates') );
		}
		$data['layout']      	= getLayout();
        if ($slug == '') {
			$data['main_active'] 	= 'templates';
			$data['sub_active']     = 'list';
		} else {
			if ($slug == 'email') {
				$data['main_active'] 	= 'templates';
				$data['sub_active']     = 'list_email';
			} elseif ($slug == 'sms') {
				$data['main_active'] 	= 'templates';
				$data['sub_active']     = 'list_sms';
			}
		}
        $data['title']        	= getPhrase('templates');
		$data['parent'] = $slug;
        return view('templates.list', $data);
     }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    
    public function getDatatable($slug = '')
    {
		$records = array();		
        if ($slug == '') {
			$records = Templates::getTemplates();
			return Datatables::of($records)
			->addColumn('action', function ($records) {
			 
			  
			  $link_data =  ' <a href="'.URL_TEMPLATES_EDIT.$records->slug.'" class="btn btn-warning"><i class="fa fa-edit"></i> </a> ';
			  $link_data .=  ' <a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');" class="btn btn-danger"><i class="fa fa-trash"></i> </a> ';
							 
				return $link_data;
				})			        
			->editColumn('type', function($records) {
				return ucfirst($records->type);
			})
			->editColumn('template_type', function($records) {
				return ucfirst($records->template_type);
			})
			->removeColumn('id')
			->removeColumn('slug')		
			->removeColumn('content')
			->make();
		} else {
			$records = Templates::getTemplates( $slug );
			return Datatables::of($records)
			->addColumn('action', function ($records) {
			 
			
			  $link_data =  ' <a href="'.URL_TEMPLATES_EDIT.$records->slug.'" class="btn btn-warning"><i class="fa fa-edit"></i> </a> ';
			  $link_data .=  ' <a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');" class="btn btn-danger"><i class="fa fa-trash"></i> </a> ';
							 
				return $link_data;
				})			        
			->editColumn('type', function($records) {
				return ucfirst($records->type);
			})
			->removeColumn('id')
			->removeColumn('slug')
			->removeColumn('content')
			->removeColumn('template_type')
			->make();
		}
    }
	
	

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function create()
    {
        if( $this->isModuleEligible('Email_Templates', array('Add')) )
		{
			return redirect( $this->isModuleEligible('Email_Templates', array('Add') ) );
		}
		$data['record']         = FALSE;
        $data['layout']         = getLayout();
        $data['main_active']    = 'templates';
        $data['sub_active']     = 'add';
        $data['title']          = getPhrase('Add Templates');		
				
        return view('templates.add-edit', $data);
    }

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function edit(Templates $slug)
    {
         if( $this->isModuleEligible('Email_Templates', array('Edit')) )
		{
			return redirect( $this->isModuleEligible('Email_Templates', array('Edit') ) );
		}
        if($isValid = $this->isValidRecord($slug))
          return redirect($isValid);  
    	$data['record']      	= $slug;

        $data['layout']      	= getLayout();
        $data['main_active'] 	= 'templates';
        $data['sub_active']     = 'add';
        $data['title']        	= 'Edit Templates';       
        return view('templates.add-edit', $data);
    }

    public function update(Request $request, $slug)
    {
        if( $this->isModuleEligible('Email_Templates', array('Edit')) )
		{
			return redirect( $this->isModuleEligible('Email_Templates', array('Edit') ) );
		}
		$record = Templates::where('slug', $slug)->get()->first();
		$this->validate($request, [
        'title'  => 'required|max:60|unique:templates,title,'.$record->id,
		'subject'  => 'required',
		'content'  => 'required',
		'from_email'  => 'required|email',
		'from_name'  => 'required',
        ]);
		 $name = $request->title;
		 
		/**
		 * Check if the title of the record is changed, 
		 * if changed update the slug value based on the new title
		 */
		if($name != $record->title)
		 $record->slug = $record->makeSlug($name);
		$record->title = $name;
		$record->type			= $request->type;
		$record->subject		= $request->subject;
		$record->content		= $request->content;
		$record->from_email		= $request->from_email;
		$record->from_name		= $request->from_name;
		$record->record_updated_by 		= Auth::user()->id;	
		$record->save();
		flash('success','record_updated_successfully', 'success');
    	return redirect(URL_TEMPLATES);
    }


    /**
     * This method will receive the submitted application form and inserts to db
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
    	if( $this->isModuleEligible('Email_Templates', array('Add')) )
		{
			return redirect( $this->isModuleEligible('Email_Templates', array('Add') ) );
		}
		$this->validate($request, [
        'title'  => 'required|max:60|unique:templates,title',
		'subject'  => 'required',
		'content'  => 'required',
		'from_email'  => 'required|email',
		'from_name'  => 'required',
        ]);
		
         DB::beginTransaction();
    	try {
	        $record = new Templates();
	        $title = $request->title;
	        $record->title 	= $title;
	        $record->slug 	= $record->makeSlug($title);
	        $record->type 	= $request->type;
            $record->subject = $request->subject;
	        $record->content	= $request->content;
            $record->from_email  = $request->from_email;
            $record->from_name		= $request->from_name;           
			$record->record_updated_by = Auth::user()->id;
			
			$record->save();
	       	flash('Success','Record updated successfully', 'success');
	       	  DB::commit();
   		}
   		catch(Exception $ex) {
   			  DB::rollBack();
   				flash('Oops',$ex->getMessage(), 'overlay');
   		}

   		return redirect(URL_TEMPLATES);


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
        if( $this->isModuleEligible('Email_Templates', array('View')) )
		{
			return redirect( $this->isModuleEligible('Email_Templates', array('View') ) );
		}
		$record = Templates::where('slug','=',$slug)->first();

        if($isValid = $this->isValidRecord($record))
         return redirect($isValid);
        
        $data['record']         = $record;
        $data['layout']         = getLayout();
        $data['main_active'] 	= 'templates';
        $data['sub_active']     = 'list';
        $data['title']          = getPhrase('View Template');
        
        return view('templates.show-details', $data);
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
      return URL_TEMPLATES;
    }
	
		
	/**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean 
     */
    public function delete($slug)
    {
        if( $this->isModuleEligible('Email_Templates', array('Delete')) )
		{
			return redirect( $this->isModuleEligible('Email_Templates', array('Delete') ) );
		}
		try{
        if(!env('DEMO_MODE')) {
            $is_eligible_to_delete = TRUE;
            $record = Templates::where('slug', $slug)->first();           
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

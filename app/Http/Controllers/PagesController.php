<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Pages;
use App\User;
use Yajra\Datatables\Datatables;
use DB;
use Illuminate\Support\Facades\Hash;
use Input;
use File;
use Exception;
use Auth;
use Image; 

class PagesController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }
       
  public function pagesDashboard()
  {
        if( $this->isModuleEligible('Pages') != '' )
		{
			return redirect( $this->isModuleEligible('Pages') );
		}
		$data['layout']         = getLayout();
        $data['main_active']    = 'pages';
        $data['sub_active']     = 'list';
        $data['title']          = getPhrase('Pages');
        return view('pages.dashboard', $data);
  }

     /**
    * Display a listing of the resource.
    *
    * @return Response
    */
     public function index()
     {
		if( $this->isModuleEligible('Pages') != '' )
		{
			return redirect( $this->isModuleEligible('Pages') );
		}
		$data['layout']      	= getLayout();
		$data['main_active'] 	= 'pages';
		$data['sub_active']     = 'list';
        $data['title']        	= getPhrase('Pages');
        return view('pages.list', $data);
     }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    
    public function getDatatable($slug = '')
    {
		$records = array(); 

		$records = Pages::select(['id','title','slug', 'status']);
		
		return Datatables::of($records)
		->addColumn('action', function ($records) {
		 
		  $link_data =  '<a href="'.URL_PAGES_VIEW.$records->slug.'" class="btn btn-primary"><i class="fa fa-search"></i> </a> ';
		  $link_data .=  ' <a href="'.URL_PAGES_EDIT.$records->slug.'" class="btn btn-warning"><i class="fa fa-edit"></i> </a> ';
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
        if( $this->isModuleEligible('Pages', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Pages', array('Add')) );
		}
		$data['record']         = FALSE;
        $data['layout']         = getLayout();
        $data['main_active']    = 'pages';
        $data['sub_active']     = 'add';
        $data['title']          = getPhrase('Add Pages');		
				
        return view('pages.add-edit', $data);
    }

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function edit(Pages $slug)
    {
         if( $this->isModuleEligible('Pages', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Pages', array('Edit')) );
		}
        if($isValid = $this->isValidRecord($slug))
          return redirect($isValid);  
    	$data['record']      	= $slug;

        $data['layout']      	= getLayout();
        $data['main_active'] 	= 'pages';
        $data['sub_active']     = 'add';
        $data['title']        	= 'Edit Pages';       
        return view('pages.add-edit', $data);
    }

    public function update(Request $request, $slug)
    {
        if( $this->isModuleEligible('Pages', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Pages', array('Edit')) );
		}
		$record = Pages::where('slug', $slug)->get()->first();
		$this->validate($request, [
        'title'  => 'required|max:256|unique:pages,title,'.$record->id,
		'status'  => 'required',
		'show_in_menu'  => 'required',
		'content'  => 'required',
        ]);
		 $name = $request->title;
		 //dd($request);
		/**
		 * Check if the title of the record is changed, 
		 * if changed update the slug value based on the new title
		 */
		if($name != $record->title)
		 $record->slug = $record->makeSlug($name);
		$record->title = $name;
		$record->content		= $request->content;
		$record->meta_tag_title		= $request->meta_tag_title;
		$record->meta_tag_description		= $request->meta_tag_description;
		$record->meta_tag_keywords		= $request->meta_tag_keywords;
		$record->status		= $request->status;
		$record->record_updated_by 		= Auth::user()->id;
		$record->show_in_menu		= $request->show_in_menu;
		$record->icon = $request->icon;
		$record->save();
		flash('success','record_updated_successfully', 'success');
    	return redirect(URL_PAGES);
    }


    /**
     * This method will receive the submitted application form and inserts to db
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
    	if( $this->isModuleEligible('Pages', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Pages', array('Add')) );
		}
		$this->validate($request, [
        'title'  => 'required|max:256|unique:pages,title',
		'status'  => 'required',
		'show_in_menu'  => 'required',
		'content'  => 'required',
        ]);
		
         DB::beginTransaction();
    	try {
	        $record = new Pages();
	        $title = $request->title;
	        $record->title 	= $title;
	        $record->slug 	= $record->makeSlug($title);
	        $record->content 	= $request->content;
            $record->meta_tag_title = $request->meta_tag_title;
	        $record->meta_tag_description	= $request->meta_tag_description;
            $record->meta_tag_keywords  = $request->meta_tag_keywords;
            $record->status		= $request->status;
			$record->record_updated_by = Auth::user()->id;
			$record->show_in_menu		= $request->show_in_menu;
			$record->icon = $request->icon;			
			$record->save();
	       	flash('Success','Record updated successfully', 'success');
	       	  DB::commit();
   		}
   		catch(Exception $ex) {
   			  DB::rollBack();
   				flash('Oops',$ex->getMessage(), 'overlay');
   		}
   		return redirect(URL_PAGES);
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
		if( $this->isModuleEligible('Pages', array('View')) != '' )
		{
			return redirect( $this->isModuleEligible('Pages', array('View')) );
		}
		$record = Pages::where('slug','=',$slug)->first();

        if($isValid = $this->isValidRecord($record))
         return redirect($isValid);
        
        $data['record']         = $record;
        $data['layout']         = getLayout();
        $data['main_active'] 	= 'pages';
        $data['sub_active']     = 'list';
        $data['title']          = getPhrase('View Template');
        
        return view('pages.show-details', $data);
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
      return URL_PAGES;
    }
	
		
	/**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean 
     */
    public function delete($slug)
    {
        if( $this->isModuleEligible('Pages', array('Delete')) != '' )
		{
			return redirect( $this->isModuleEligible('Pages', array('Delete')) );
		}
		try{
        if(!env('DEMO_MODE')) {
            $is_eligible_to_delete = TRUE;
            $record = Pages::where('slug', $slug)->first();           
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

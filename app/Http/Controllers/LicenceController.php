<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Licence;
use App\User;
use App\Product_Lisence;
use Yajra\Datatables\Datatables;
use DB;
use Illuminate\Support\Facades\Hash;
use Input;
use File;
use Exception;
use Auth;
use Image; 

class LicenceController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }
 


    public function dashborad()
    {
        if( $this->isModuleEligible('Licences') )
		{
			return redirect( $this->isModuleEligible('Licences') );
		}

        $data['layout']         = getLayout();
        $data['main_active']    = 'licences';
        $data['sub_active']     = 'all';
        $data['title']          = getPhrase('licences_dashboard');

        return view('licences.dashboard', $data);
    }
     /**
    * Display a listing of the resource.
    *
    * @return Response
    */
     public function index()
     {
		if( $this->isModuleEligible('Licences') )
		{
			return redirect( $this->isModuleEligible('Licences') );
		}
		$data['layout']      	= getLayout();
        $data['main_active'] 	= 'licences';
        $data['sub_active']     = 'list';
        $data['title']        	= getPhrase('licences');

        return view('licences.list', $data);
     }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    
    public function getDatatable()
    {
		 $records = Licence::select(['licences.id', 'licences.slug', 'licences.title', 'users.name', 'licences.price','licences.duration','licences.duration_type','licences.status'])->join('users', 'users.id', '=', 'licences.user_created')->get();

		 $table = Datatables::of($records);
		 $table->addColumn('action', function ($records) {
			 
			  $link_data =  '<a href="'.URL_LICENCES_VIEW.$records->slug.'" class="btn btn-primary"><i class="fa fa-search"></i> </a> ';
			  $link_data .=  ' <a href="'.URL_LICENCES_EDIT.$records->slug.'" class="btn btn-warning"><i class="fa fa-edit"></i> </a> ';
			  $link_data .=  ' <a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');" class="btn btn-danger"><i class="fa fa-trash"></i> </a> ';
							 
				return $link_data;
			});
		$table->editColumn('duration', function($records) {
				return $records->duration . ' ('.$records->duration_type.')';
			});
		$table->editColumn('status', function($records) {
				return ucfirst($records->status);
			});
		$table->removeColumn('id')->removeColumn('slug');
		if(!checkRole(getUserGrade(2))) {
			$table->removeColumn('name');
		}
		$table->removeColumn('duration_type');
		 return $table->make();
    }
	
	

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function create()
    {
        if( $this->isModuleEligible('Licences', array('Add')) )
		{
			return redirect( $this->isModuleEligible('Licences', array('Add')) );
		}
		$data['record']         = FALSE;
        $data['layout']         = getLayout();
        $data['main_active']    = 'licences';
        $data['sub_active']     = 'add';
        $data['title']          = getPhrase('add_licence');		
        return view('licences.add-edit', $data);
    }

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function edit(Licence $slug)
    {
         if( $this->isModuleEligible('Licences', array('Edit')) )
		{
			return redirect( $this->isModuleEligible('Licences', array('Edit')) );
		}
        if($isValid = $this->isValidRecord($slug))
          return redirect($isValid);  
    	$data['record']      	= $slug;

        $data['layout']      	= getLayout();
        $data['main_active'] 	= 'licences';
        $data['sub_active']     = 'add';
        $data['title']        	= getPhrase('edit_licence');       
        return view('licences.add-edit', $data);
    }

    public function update(Request $request, $slug)
    {
        if( $this->isModuleEligible('Licences', array('Edit')) )
		{
			return redirect( $this->isModuleEligible('Licences', array('Edit')) );
		}
		$record = Licence::where('slug', $slug)->get()->first();
		$this->validate($request, [
       	 'title'          => 'bail|required|max:60|unique:licences,title,'.$record->id,
		 'price' => 'required|numeric',
		 'duration'  => 'required',
		'duration_type'  => 'required',
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
		$record->price = $request->price;
		$record->duration			= $request->duration;
		$record->duration_type			= $request->duration_type;
		$record->status 			= $request->status;
		$record->save();
		
		flash('success','record_updated_successfully', 'success');
    	return redirect(URL_LICENCES);
    }


    /**
     * This method will receive the submitted application form and inserts to db
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
    	if( $this->isModuleEligible('Licences', array('Add')) )
		{
			return redirect( $this->isModuleEligible('Licences', array('Add')) );
		}
		$rules = [
			'title'  => 'required|max:60',
			'price' => 'required|numeric',
			'duration'  => 'required',
			'duration_type'  => 'required',
		];
		$this->validate($request, $rules);
		
         DB::beginTransaction();
		 
    	try {
	        $ta 			= new Licence();
	        $title          = $request->title;
	        $ta->title 	    = $title;
			$ta->price	    = $request->price;
			$ta->duration   = $request->duration;
			$ta->duration_type = $request->duration_type;
	        $ta->slug 	       = $ta->makeSlug($title);
	        $ta->description   = $request->description;
            $ta->status        = $request->status;
			$ta->user_created  = Auth::user()->id;
			$ta->save();
	       	flash('Success','Record updated successfully', 'overlay');
	       	  DB::commit();
   		}
   		catch(Exception $ex) {
   			  DB::rollBack();
   				flash('Oops',$ex->getMessage(), 'overlay');
   		}
   		return redirect(URL_LICENCES);


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
        if( $this->isModuleEligible('Licences', array('View')) )
		{
			return redirect( $this->isModuleEligible('Licences', array('View')) );
		}
		$record = Licence::where('slug','=',$slug)->first();

        if($isValid = $this->isValidRecord($record))
         return redirect($isValid);
        
        $data['record']         = $record;
        $data['layout']         = getLayout();
        $data['main_active'] 	= 'licences';
        $data['sub_active']     = 'list';
        $data['title']          = 'View Tour';
        
        return view('licences.show-details', $data);
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
      return URL_LICENCES;
    }
	
		
	/**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean 
     */
    public function delete($slug)
    {

        if( $this->isModuleEligible('Licences', array('Delete')) )
		{
			return redirect( $this->isModuleEligible('Licences', array('Delete')) );
		}

		$response = array();
		try{
        if(!env('DEMO_MODE')) {
			$record = Licence::where('slug', $slug)->first();
            $is_used = Product_Lisence::where('lisence_id','=',$record->id)->first();
            if(count($is_used)){

            $response['status'] = 0;
            $response['message'] =  getPhrase('this_record_is_in_use_in_other_modules');
            }
            else{            
			$record->delete();
            $response['status'] = 1;
            $response['message'] = getPhrase('record_deleted_successfully');
            }
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

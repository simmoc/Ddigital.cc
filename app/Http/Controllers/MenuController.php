<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Menu;

use Yajra\Datatables\Datatables;

use Illuminate\Support\Facades\Hash;
use File;
use Exception;
use Image; 
use DB;

class MenuController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }
 


    public function dashborad()
    {
		if( $this->isModuleEligible('Menus') != '' )
		{
			return redirect( $this->isModuleEligible('Menus') );
		}

        $data['layout']         = getLayout();
        $data['main_active']    = 'menu';
        $data['sub_active']     = 'all';
        $data['title']          = getPhrase('menu_dashboard');

        return view('menu.dashboard', $data);
    }
     /**
    * Display a listing of the resource.
    *
    * @return Response
    */
     public function index()
     {
		if( $this->isModuleEligible('Menus') != '' )
		{
			return redirect( $this->isModuleEligible('Menus') );
		}
		$data['layout']      	= getLayout();
        $data['main_active'] 	= 'menu';
        $data['sub_active']     = 'list';
        $data['title']        	= 'Menu';

        return view('menu.list', $data);
     }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    
    public function getDatatable()
    {
		 $records = Menu::select(['name', 'slug', 'id', 'status'])->get();

		 $table = Datatables::of($records);
		 $table->addColumn('action', function ($records) {
			 $link_data = '';
			  /*
			  $link_data .=  '<a href="'.URL_MENU_VIEW.$records->slug.'" class="btn btn-primary"><i class="fa fa-search"></i> </a> ';
			  */
			  $link_data .=  ' <a href="'.URL_MENU_ITEMS.$records->slug.'" class="btn btn-primary" title="'.getPhrase('Menu Items').'"><i class="fa fa-info-circle" aria-hidden="true"></i>
 </a> ';
			  $link_data .=  ' <a href="'.URL_MENU_EDIT.$records->slug.'" class="btn btn-warning"><i class="fa fa-edit"></i> </a> ';
			  $link_data .=  ' <a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');" class="btn btn-danger"><i class="fa fa-trash"></i> </a> ';
							 
				return $link_data;
			});
		$table->editColumn('id', function($record) {
				return App\Menu_Items::where('menu_id', '=', $record->id)->count();
			});
		$table->editColumn('status', function($records) {
				return ucfirst($records->status);
			});
		$table->removeColumn('slug');		
		$table->removeColumn('created_at');
		$table->removeColumn('updated_at');
		 return $table->make();
    }
	
	

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function create()
    {
        if( $this->isModuleEligible('Menus', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Menus', array('Add')) );
		}
		$data['record']         = FALSE;
        $data['layout']         = getLayout();
        $data['main_active']    = 'menu';
        $data['sub_active']     = 'add';
        $data['title']          = 'Add Menu';		
        return view('menu.add-edit', $data);
    }

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function edit(Menu $slug)
    {
         if( $this->isModuleEligible('Menus', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Menus', array('Edit')) );
		}
        if($isValid = $this->isValidRecord($slug))
          return redirect($isValid);  
    	$data['record']      	= $slug;
        $data['layout']      	= getLayout();
        $data['main_active'] 	= 'menu';
        $data['sub_active']     = 'add';
        $data['title']        	= 'Edit Menu';       
        return view('menu.add-edit', $data);
    }

    public function update(Request $request, $slug)
    {
        if( $this->isModuleEligible('Menus', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Menus', array('Edit')) );
		}
		$record = Menu::where('slug', $slug)->get()->first();
		$this->validate($request, [
       	 'name'  => 'required|max:60|unique:menus,name,'.$record->id,
          ]);
		 $name = $request->name;
		 
		/**
		 * Check if the title of the record is changed, 
		 * if changed update the slug value based on the new title
		 */
		if($name != $record->name)
		 $record->slug = $record->makeSlug($name);
		$record->name = $name;
		$record->description 	= $request->description;
        $record->status  = $request->status;
		$record->save();
		
		flash('success','record updated successfully', 'success');
    	return redirect(URL_MENU);
    }


    /**
     * This method will receive the submitted application form and inserts to db
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
    	if( $this->isModuleEligible('Menus', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Menus', array('Add')) );
		}
		$rules = [
			'name'  => 'required|max:60|unique:menus',
		];
		$this->validate($request, $rules);
		
         DB::beginTransaction();
		 
    	try {
	        $ta 			= new Menu();
	        $name = $request->name;
	        $ta->name 	= $name;
	        $ta->slug 	= $ta->makeSlug($name);
	        $ta->description 	= $request->description;
            $ta->status  = $request->status;
			$ta->save();
	       	flash('Success','Record updated successfully', 'overlay');
	       	  DB::commit();
   		}
   		catch(Exception $ex) {
   			  DB::rollBack();
   				flash('Oops',$ex->getMessage(), 'overlay');
   		}
   		return redirect(URL_MENU);


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
        if( $this->isModuleEligible('Menus', array('View')) != '' )
		{
			return redirect( $this->isModuleEligible('Menus', array('View')) );
		}
		$record = Menu::where('slug','=',$slug)->first();

        if($isValid = $this->isValidRecord($record))
         return redirect($isValid);
        
        $data['record']         = $record;
        $data['layout']         = getLayout();
        $data['main_active'] 	= 'menu';
        $data['sub_active']     = 'list';
        $data['title']          = 'View Tour';
        
        return view('menu.show-details', $data);
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
      return URL_MENU;
    }
	
		
	/**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean 
     */
    public function delete($slug)
    {
        if( $this->isModuleEligible('Menus', array('Delete')) != '' )
		{
			return redirect( $this->isModuleEligible('Menus', array('Delete')) );
		}
		$response = array();
		try{
        if(!env('DEMO_MODE')) {
			$record = Menu::where('slug', $slug)->first();            
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

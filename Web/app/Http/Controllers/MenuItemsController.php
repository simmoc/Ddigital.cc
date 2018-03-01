<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Menu_Items;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use File;
use Exception;
use Image; 
use DB;

class MenuItemsController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }
 


    public function dashborad()
    {
        if( $this->isModuleEligible('Menu_Items') != '' )
		{
			return redirect( $this->isModuleEligible('Menu_Items') );
		}

        $data['layout']         = getLayout();
        $data['main_active']    = 'menu';
        $data['sub_active']     = 'all';
        $data['title']          = getPhrase('menu_dashboard');

        return view('menu-items.dashboard', $data);
    }
     /**
    * Display a listing of the resource.
    *
    * @return Response
    */
     public function index( $menu_slug )
     {
		if( $this->isModuleEligible('Menu_Items') != '' )
		{
			return redirect( $this->isModuleEligible('Menu_Items') );
		}
		$data['layout']      	= getLayout();
        $data['main_active'] 	= 'menu';
        $data['sub_active']     = 'list';
        $data['title']        	= 'Menu-items';
		$data['menu_slug'] = $menu_slug;

        return view('menu-items.list', $data);
     }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    
    public function getDatatable( $menu_slug )
    {
		 $menu = App\Menu::where('slug', '=', $menu_slug)->first();
		 $records = Menu_Items::select(['title', 'url', 'menu_order', 'slug', 'id', 'status'])->where('menu_id', '=', $menu->id)->orderBy('menu_order', 'asc')->get();

		 $table = Datatables::of($records);
		 $table->addColumn('action', function ($records) {
			$link_data = '';		  
			$link_data .=  ' <a href="'.URL_MENU_ITEMS_EDIT.$records->slug.'" class="btn btn-warning"><i class="fa fa-edit"></i> </a> ';
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
		$table->removeColumn('id');		
		$table->removeColumn('created_at');
		$table->removeColumn('updated_at');
		 return $table->make();
    }
	
	

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function create( $menu_slug )
    {
        if( $this->isModuleEligible('Menu_Items', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Menu_Items', array('Add')) );
		}
		$menu = App\Menu::where('slug', '=', $menu_slug)->first();
		if( ! $menu ) {
			redirect( URL_MENU );
		}
		$data['record']         = FALSE;
        $data['layout']         = getLayout();
        $data['main_active']    = 'menu';
		$data['sub_active'] = 'add';
        $data['title']          = getPhrase('add_menu_item');
		$data['menu_id'] = $menu->id;
		$data['menu_slug'] = $menu_slug;
        return view('menu-items.add-edit', $data);
    }

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function edit( $slug )
    {

        if( $this->isModuleEligible('Menu_Items', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Menu_Items', array('Edit')) );
		}
		$elements = Menu_Items::select('title', 'menu_items.slug', 'url', 'target', 'menu_items.status', 'menu_items.description', 'menus.slug as menu_slug', 'menus.id as menu_id', 'menu_order', 'menu_active_title', 'page_id')
                            ->join('menus', 'menus.id', '=', 'menu_items.menu_id')
                            ->where('menu_items.slug', '=', $slug)
                            ->first();
        if($isValid = $this->isValidRecord($elements))
          return redirect($isValid);  
    	$data['record']      	= $elements;
        $data['layout']      	= getLayout();
        $data['main_active'] 	= 'menu-items';
        $data['sub_active']     = 'add';
        $data['title']          = 'Edit Menu';       
        $data['menu_item_slug'] = $slug;       
        return view('menu-items.add-edit', $data);
    }

    public function update(Request $request, $slug)
    {
		if( $this->isModuleEligible('Menu_Items', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Menu_Items', array('Edit')) );
		}
		$record = Menu_Items::where('slug', $slug)->get()->first();
		$this->validate($request, [
			'title'          => 'bail|required|max:60|unique:menu_items,title,'.$record->id,
			'url'  => 'required',
			'target'  => 'required',
			'menu_order' => 'required|numeric',
			'status'  => 'required_if:url,!= login',
          ]);
		 $title = $request->title;
		 
		/**
		 * Check if the title of the record is changed, 
		 * if changed update the slug value based on the new title
		 */
		if($title != $record->title)
		 $record->slug = $record->makeSlug($title);
		$record->title = $title;
		$record->menu_id = $request->menu_id;			
		$record->url = $request->url;
		$record->target = $request->target;
		$record->menu_order = $request->menu_order;
		$record->description			= $request->description;
		$record->menu_active_title = $request->menu_active_title;
		$record->status 			= $request->status;
		$record->page_id  = $request->page_id;
		$record->pages  = json_encode( $request->pages );
		$record->save();
		
		flash('success','record_updated_successfully', 'success');
    	return redirect(URL_MENU_ITEMS . $request->menu_slug);
    }


    /**
     * This method will receive the submitted application form and inserts to db
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
    	if( $this->isModuleEligible('Menu_Items', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Menu_Items', array('Add')) );
		}
		$rules = [
			'title'  => 'required|max:60|unique:menu_items,title',
			'url'  => 'required',
			'target'  => 'required',
			'menu_order' => 'required|numeric',
			'status'  => 'required',
		];
		$this->validate($request, $rules);
		
         DB::beginTransaction();
		 
    	try {
	        $ta 			= new Menu_Items();
	        $title = $request->title;
	        $ta->title 	= $title;
	        $ta->slug 	= $ta->makeSlug($title);
			$ta->menu_id = $request->menu_id;			
			$ta->url = $request->url;
			$ta->target = $request->target;
			$ta->menu_order = $request->menu_order;
	        $ta->description 	= $request->description;
			$ta->menu_active_title = $request->menu_active_title;
            $ta->status  = $request->status;
			$ta->page_id  = $request->page_id;
			$ta->pages  = json_encode( $request->pages );
			$ta->save();
	       	flash('Success','Record updated successfully', 'overlay');
	       	  DB::commit();
   		}
   		catch(Exception $ex) {
   			  DB::rollBack();
   				flash('Oops',$ex->getMessage(), 'overlay');
   		}
   		return redirect(URL_MENU_ITEMS . $request->menu_slug);


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
        if( $this->isModuleEligible('Menu_Items', array('View')) != '' )
		{
			return redirect( $this->isModuleEligible('Menu_Items', array('View')) );
		}
		$record = Menu::where('slug','=',$slug)->first();

        if($isValid = $this->isValidRecord($record))
         return redirect($isValid);
        
        $data['record']         = $record;
        $data['layout']         = getLayout();
        $data['main_active'] 	= 'menu';
        $data['sub_active']     = 'list';
        $data['title']          = 'View Tour';
        
        return view('menu-items.show-details', $data);
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
        if( $this->isModuleEligible('Menu_Items', array('Delete')) != '' )
		{
			return redirect( $this->isModuleEligible('Menu_Items', array('Delete')) );
		}
		$response = array();
		try{
        if(!env('DEMO_MODE')) {
			$record = Menu_Items::where('slug', $slug)->first();            
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

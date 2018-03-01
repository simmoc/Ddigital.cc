<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Category;
use App\User;
use Yajra\Datatables\Datatables;
use DB;
use Illuminate\Support\Facades\Hash;
use Input;
use File;
use Exception;
use Auth;
use Image; 

class CategoriesController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }
 



    public function categoriesDashborad()
    {
        if( $this->isModuleEligible('Categories' ) )
		{
			return redirect( $this->isModuleEligible('Categories') );
		}

        $data['layout']         = getLayout();
        $data['main_active']    = 'categories';
        $data['sub_active']     = 'all';
        $data['title']          = getPhrase('categories_dashboard');

        return view('categories.dashboard', $data);
    }
     /**
    * Display a listing of the resource.
    *
    * @return Response
    */
     public function index($slug = '')
     {
       	if( $this->isModuleEligible('Categories' ) )
		{
			return redirect( $this->isModuleEligible('Categories') );
		}
		
		if ($slug != '') {
			$parent_record = Category::getRecordWithSlug($slug);
			if ($parent_record === null) {
				prepareBlockUserMessage();
				return back();
			}
		}
		$data['layout']      	= getLayout();
        $data['main_active'] 	= 'categories';
        $data['sub_active']     = 'list';
        $data['title']        	= getPhrase('categories');
		$data['parent'] = $slug;

        return view('categories.list', $data);
     }

    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    
    public function getDatatable($slug = '')
    {
        $records = array();    
      
		if ($slug == '')
		 $records = Category::getParentCategories();
		else
		 $records = Category::getSubCategories($slug);

        if ($slug == '') {
			return Datatables::of($records)
			->addColumn('action', function ($records) {
			 
			  $link_data =  '<a href="'.URL_CATEGORIES_VIEW.$records->slug.'" class="btn btn-primary"><i class="fa fa-search"></i> </a> ';
			  $link_data .=  ' <a href="'.URL_CATEGORIES_EDIT.$records->slug.'" class="btn btn-warning"><i class="fa fa-edit"></i> </a> ';
			  $link_data .=  ' <a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');" class="btn btn-danger"><i class="fa fa-trash"></i> </a> ';
							 
				return $link_data;
				})
			  
			 ->editColumn('title', function($records) {
				return '<a href="'.URL_CATEGORIES.'/'.$records->slug.'">'.$records->title.'</a> ('.$records->id.')';
			})        
			->editColumn('status', function($records) {
				return ucfirst($records->status);
			})
			->editColumn('parent_id', function($records) {
					return Category::select(['id'])->where('parent_id', '=', $records->id)->count();
			})
			
			->removeColumn('id')
			->removeColumn('sort_order')
			->removeColumn('slug')
			->removeColumn('updated_at')
			->make();
		} else {
			return Datatables::of($records)
			->addColumn('action', function ($records) {
			 
			  $link_data =  '<a href="'.URL_CATEGORIES_VIEW.$records->slug.'" class="btn btn-primary"><i class="fa fa-search"></i> </a> ';
			  $link_data .=  ' <a href="'.URL_CATEGORIES_EDIT.$records->slug.'" class="btn btn-warning"><i class="fa fa-edit"></i> </a> ';
			  $link_data .=  ' <a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');" class="btn btn-danger"><i class="fa fa-trash"></i> </a> ';
							 
				return $link_data;
				})
			 
			->editColumn('title', function($records) {
				return $records->title.'('.$records->id.')';
			})        
			->editColumn('status', function($records) {
				return ucfirst($records->status);
			})
			
			
			->removeColumn('id')
			->removeColumn('sort_order')
			->removeColumn('slug')
			->removeColumn('updated_at')
			->removeColumn('parent_id')
			->make();
		}
    }
	
	

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function create()
    {
        if( $this->isModuleEligible('Categories', array('Add') ) )
		{
			return redirect( $this->isModuleEligible('Categories', array('Add')) );
		}
		$data['record']         = FALSE;
        $data['layout']         = getLayout();
        $data['main_active']    = 'categories';
        $data['sub_active']     = 'add';
        $data['title']          = getPhrase('add_category');		
		$list = Category::where('parent_id','=',0)->get();
    	
		$data['parent_categories']	    = array_pluck($list, 'title', 'id');
    	$data['parent_categories'][0]	= 'Parent';
		
        return view('categories.add-edit', $data);
    }

    /**
     * This method will load the create tour application page
     * @return [type] [description]
     */
    public function edit(Category $slug)
    {
         if( $this->isModuleEligible('Categories', array('Edit') ) )
		{
			return redirect( $this->isModuleEligible('Categories', array('Edit')) );
		}
        if($isValid = $this->isValidRecord($slug))
          return redirect($isValid);  
    	$data['record']      	= $slug;

        $data['layout']      	= getLayout();
        $data['main_active'] 	= 'categories';
        $data['sub_active']     = 'add';
        $data['title']        	= getPhrase('edit_category');
        $parent = Category::where('parent_id','=',0)->get();
        $data['parent_categories']    	= array('0'=>'Parent') + array_pluck($parent,'title','subject');
       
        return view('categories.add-edit', $data);
    }

    public function update(Request $request, $slug)
    {
        if( $this->isModuleEligible('Categories', array('Edit') ) )
		{
			return redirect( $this->isModuleEligible('Categories', array('Edit')) );
		}
		$record = Category::where('slug', $slug)->get()->first();
		$this->validate($request, [
       	 'title'          => 'bail|required|max:60|unique:categories,title,'.$record->id,
		 'sort_order' => 'integer',
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
		$record->meta_tag_title				= $request->meta_tag_title;
		$record->meta_tag_description		= $request->meta_tag_description;
		$record->meta_tag_keywords			= $request->meta_tag_keywords;
		$record->parent_id = $request->parent_id;
		$record->status 			= $request->status;
		$record->record_updated_by 		= Auth::user()->id;
		$record->icon 			= $request->icon;
		
		$record->save();
		flash('Success','record_updated_successfully', 'success');
    	return redirect(URL_CATEGORIES);
    }


    /**
     * This method will receive the submitted application form and inserts to db
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
    	if( $this->isModuleEligible('Categories', array('Add') ) )
		{
			return redirect( $this->isModuleEligible('Categories', array('Add')) );
		}
		$rules = [
			'title'  => 'required|max:60',
			'sort_order' => 'integer',
		];
		if( $request->parent_id == 0 ) {
			$rules['title'] = 'required|max:60|unique:categories,title';
		}
		$this->validate($request, $rules);
		
         DB::beginTransaction();
		 
    	try {
	        $ta 			= new Category();
	        $title = $request->title;
	        $ta->title 	= $title;
	        $ta->slug 	= $ta->makeSlug($title);
	        $ta->description 	= $request->description;
            $ta->meta_tag_title = $request->meta_tag_title;
	        $ta->meta_tag_description	= $request->meta_tag_description;
            $ta->meta_tag_keywords  = $request->meta_tag_keywords;            
            $ta->parent_id  = ($request->parent_id) ? $request->parent_id : 0;
            $ta->status  = $request->status;
			$ta->icon = $request->icon;			
			$ta->record_updated_by = Auth::user()->id;            
			$ta->save();

	       	flash('Success','record_updated_successfully', 'success');
	       	  DB::commit();
   		}
   		catch(Exception $ex) {
   			  DB::rollBack();
   				flash('Oops',$ex->getMessage(), 'overlay');
   		}

   		return redirect(URL_CATEGORIES);


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
        if( $this->isModuleEligible('Categories', array('View') ) )
		{
			return redirect( $this->isModuleEligible('Categories', array('View')) );
		}
		$record = Category::where('slug','=',$slug)->first();

        if($isValid = $this->isValidRecord($record))
         return redirect($isValid);
        
        $data['record']         = $record;
        $data['layout']         = getLayout();
        $data['main_active'] 	= 'categories';
        $data['sub_active']     = 'list';
        $data['title']          = 'View Tour';
        
        return view('categories.show-details', $data);
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
      return URL_CATEGORIES;
    }
	
	/**
     * This method will delete the file at specified path
     * @param  [type]  $record   [description]
     * @param  [type]  $path     [description]
     * @param  boolean $is_array [description]
     * @return [type]            [description]
     */
    public function deleteFile($record, $path, $is_array = FALSE)
    {
        $files = array();
        $files[] = $path.$record;
        File::delete($files);
    }
	
	/**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean 
     */
    public function delete($slug)
    {
        if( $this->isModuleEligible('Categories', array('Delete') ) )
		{
			return redirect( $this->isModuleEligible('Categories', array('Delete')) );
		}
		try{
        if(!env('DEMO_MODE')) {
            $is_eligible_to_delete = TRUE;
            $record = Category::where('slug', $slug)->first();
            if($record->parent_id==0) {
                // This category is a parent category, so check if any 
                // child courses available with this category id.
                // If available, do not delete this category record
                $count = Category::where('parent_id', '=', $record->id)->count();
				
                if($count>0)
                    $is_eligible_to_delete = FALSE;
            }
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

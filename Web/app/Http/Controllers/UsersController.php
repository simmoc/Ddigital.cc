<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\User;
use App\Payment;
use App\Payment_Items;
use App\Product;
use App\Coupon;
use App\Licence;
use App\Payment_Items_Downloads;
use Yajra\Datatables\Datatables;
use DB;
use Illuminate\Support\Facades\Hash;
use Excel;
use Input;
use File;
use Exception;
use Auth;
use Image;

class UsersController extends Controller
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
     public function index( $type = 'all' )
     {
        if( $type == 'all' && $this->isModuleEligible('Users') != '' )
		{
			return redirect( $this->isModuleEligible('Users') );
		}
		if( $type == 'owner' && $this->isModuleEligible('Users_Owners') != '' )
		{
			return redirect( $this->isModuleEligible('Users_Owners') );
		}
		if( $type == 'admin' && $this->isModuleEligible('Users_Admins') != '' )
		{
			return redirect( $this->isModuleEligible('Users_Admins') );
		}
		if( $type == 'executive' && $this->isModuleEligible('Users_Executives') != '' )
		{
			return redirect( $this->isModuleEligible('Users_Executives') );
		}
		if( $type == 'vendor' && $this->isModuleEligible('Users_Vendors') != '' )
		{
			return redirect( $this->isModuleEligible('Users_Vendors') );
		}
		if( $type == 'user' && $this->isModuleEligible('Users_Customers') != '' )
		{
			return redirect( $this->isModuleEligible('Users_Vendors') );
		}
 
      	$data['layout']      	= getLayout();
		$data['main_active'] 	= 'users';
        if( $type == 'all' ) {
			$data['sub_active']     = 'list';
		} else {
			$data['sub_active']     = $type . 'list';
		}
		if($type=='user'){
        $data['title']        	= getPhrase('customers');
         }
         else{
		$data['title']        	= getPhrase( $type . ' Users' );
	   }
		$data['type']        	= $type;

        return view('users.list', $data);
     }


    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    
    public function getDatatable($slug = '')
    {
        $records = array();      
		if( $slug == 'all' ) {
			$records = User::join('roles', 'users.role_id', '=', 'roles.id')
			->select(['users.name', 'email', 'roles.display_name','role_id',
			'image','slug', 'users.id', 'users.updated_at'])
			->orderBy('users.updated_at', 'desc')
			->get();
		} else {
			$role = getRoleData($slug);
			$records = User::join('roles', 'users.role_id', '=', 'roles.id')
			->select(['users.name', 'email', 'roles.display_name','role_id',
			'image','slug', 'users.id', 'users.updated_at'])
			->where('role_id', '=', $role)
			->orderBy('users.updated_at', 'desc')
			->get();
		}
        return Datatables::of($records)
        ->addColumn('action', function ($records) {
           
          $role = getRoleData($records->role_id);

          
         $link_data = '';
		if( $role == 'all' && isModuleEligible('Users', array('Edit')) ) {
		$link_data =  '<a href="'.URL_USERS_EDIT.$records->slug.'" class="btn btn-warning"><i class="fa fa-edit"></i></a> ';
		}
		if( $role == 'owner' && isModuleEligible('Users_Owners', array('Edit')) ) {
		$link_data =  '<a href="'.URL_USERS_EDIT.$records->slug.'" class="btn btn-warning"><i class="fa fa-edit"></i></a> ';
		}
		if( $role == 'admin' && isModuleEligible('Users_Admins', array('Edit')) ) {
		$link_data =  '<a href="'.URL_USERS_EDIT.$records->slug.'" class="btn btn-warning"><i class="fa fa-edit"></i></a> ';
		}
		if( $role == 'executive' && isModuleEligible('Users_Executives', array('Edit')) ) {
		$link_data =  '<a href="'.URL_USERS_EDIT.$records->slug.'" class="btn btn-warning"><i class="fa fa-edit"></i></a> ';
		}
		if( $role == 'vendor' && isModuleEligible('Users_Vendors', array('Edit')) ) {
		$link_data =  '<a href="'.URL_USERS_EDIT.$records->slug.'" class="btn btn-warning"><i class="fa fa-edit"></i></a> ';
		}
		if( $role == 'user' && isModuleEligible('Users_Customers', array('Edit')) ) {
		$link_data =  '<a href="'.URL_USERS_EDIT.$records->slug.'" class="btn btn-warning"><i class="fa fa-edit"></i></a> ';
		}

          if($role == 'vendor'){
			if( isModuleEligible('Users_Vendors', array('View')) ) {
             $link_data .=  '<a href="'.URL_USERS_VENDOR_DETAILS.$records->slug.'" class="btn btn-primary"><i class="fa fa-info-circle" aria-hidden="true"></i></a> ';
			}

          }

          elseif ($role == 'user') {
            if( isModuleEligible('Users_Customers', array('View')) ) {
            $link_data .=  '<a href="'.URL_USERS_CUSTOMER_DETAILS.$records->slug.'" class="btn btn-primary"><i class="fa fa-info-circle" aria-hidden="true"></i></a> ';
			}           
          }

          
          $temp='';

          //Show delete option to only the owner user
          if($records->id!=\Auth::user()->id)   {
			if( $role == 'all' && isModuleEligible('Users', array('Delete')) ) {
				$temp = '<a class="btn btn-danger" href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i></a>';
			}
			if( $role == 'owner' && isModuleEligible('Users_Owners', array('Delete')) ) {
				$temp = '<a class="btn btn-danger" href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i></a>';
			}
			if( $role == 'admin' && isModuleEligible('Users_Admins', array('Delete')) ) {
				$temp = '<a class="btn btn-danger" href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i></a>';
			}
			if( $role == 'executive' && isModuleEligible('Users_Executives', array('Delete')) ) {
				$temp = '<a class="btn btn-danger" href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i></a>';
			}
			if( $role == 'vendor' && isModuleEligible('Users_Vendors', array('Delete')) ) {
				$temp = '<a class="btn btn-danger" href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i></a>';
			}
			if( $role == 'user' && isModuleEligible('Users_Customers', array('Delete')) ) {
				$temp = '<a class="btn btn-danger" href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i></a>';
			}
           } 
              
          $temp .='</ul> </div>';
          $link_data .= $temp;
            return $link_data;
            })
         ->editColumn('name', function($records) {

           $role = getRoleData($records->role_id);
          if($role =='vendor')
            return '<a href="'.URL_USERS_VENDOR_DETAILS.$records->slug.'">'.ucfirst($records->name).'</a>';
          else if($role=='user')
          {
            
              return '<a href="'.URL_USERS_CUSTOMER_DETAILS.$records->slug.'">'.ucfirst($records->name).'</a>';
          }
            return ucfirst($records->name);
        })        
         ->editColumn('image', function($records){
          $image_path = DEFAULT_USERS_IMAGE_THUMBNAIL;
          if($records->image){
            return '<img src="'.getProfilePath($records->image).'"  height="45" width="45"/>';
          }
            return '<img height="45" width="45" class="image" src="'.$image_path.'" />';
         })
        
 
        
        ->removeColumn('role_id')
        ->removeColumn('id')
        ->removeColumn('slug')
        ->removeColumn('updated_at')
         
        ->make();
    }

    /**
     *This method will load the user creation page
     * @return [type] [description]
     */
    public function create( $type = '')
    {
        if( $type == '' && $this->isModuleEligible('Users', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Users', array('Add')) );
		}
		if( $type == 'owner' && $this->isModuleEligible('Users_Owners', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Owners', array('Add')) );
		}
		if( $type == 'admin' && $this->isModuleEligible('Users_Admins', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Admins', array('Add')) );
		}
		if( $type == 'executive' && $this->isModuleEligible('Users_Executives', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Executives', array('Add')) );
		}
		if( $type == 'vendor' && $this->isModuleEligible('Users_Vendors', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Vendors', array('Add')) );
		}
		if( $type == 'user' && $this->isModuleEligible('Users_Customers', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Vendors', array('Add')) );
		}

    	$data['record']      	= FALSE;
        $data['layout']      	= getLayout();
        $data['main_active'] 	= 'users';
        $data['sub_active']     = 'add';
        $data['title']        	= 'Add User';
        $data['roles']    		= App\Role::pluck('display_name', 'id');
		$data['user_type']      = $type;
        	
        return view('users.add-edit', $data);
    }

    /**
     * This meserthod will add the user to the table and attaches the 
     * permissions for that user
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    { 
        $this->validate($request, [
        'first_name'  => 'bail|required|max:20|',
        'email'	      => 'bail|required|email|unique:users,email',
        'password'    => 'bail|required|min:3',
        'role_id'     => 'bail|required|',
        'image'       => 'bail|mimes:png,jpg,jpeg|max:2048',
        ]);

        $type = getRoleData($request->role_id);
        

       if( $type == '' && $this->isModuleEligible('Users', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Users', array('Add')) );
		}
		if( $type == 'owner' && $this->isModuleEligible('Users_Owners', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Owners', array('Add')) );
		}
		if( $type == 'admin' && $this->isModuleEligible('Users_Admins', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Admins', array('Add')) );
		}
		if( $type == 'executive' && $this->isModuleEligible('Users_Executives', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Executives', array('Add')) );
		}
		if( $type == 'vendor' && $this->isModuleEligible('Users_Vendors', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Vendors', array('Add')) );
		}
		if( $type == 'user' && $this->isModuleEligible('Users_Customers', array('Add')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Vendors', array('Add')) );
		}
    	
         DB::beginTransaction();
    	$role_name = '';
		try {
	        $user 			= new User();
	        $name           = $request->first_name;
			if( $request->last_name != '' )
			 $name .= ' ' . $request->last_name;
	        $user->name 	= $name;
	        $user->slug 	= $user->makeSlug($name);
	        $user->email 	= $request->email;
	        $user->password	= bcrypt($request->password);
			$user->role_id  = $request->role_id;
			if($request->has('status')) {
				$user->status  = $request->status;
				if( $request->status == 'Active' ) {
					$user->confirmed  = 1;
				}
			}
	        
			$user->first_name = $request->first_name;
			 $user->last_name = $request->last_name;			 
             $user->billing_address1 = $request->billing_address1;
			 $user->billing_address2 = $request->billing_address2;
			 $user->billing_city = $request->billing_city;
			 $user->billing_zip = $request->billing_zip;
			 $user->billing_state = $request->billing_state;
			 $user->billing_country = $request->billing_country;
			 $user->about_me = $request->about_me;
			 $user->social_links = json_encode( $request->social_links );
			 if($request->role_id==2)
			 {
			 $user->user_modules_permissions = '{"Products":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Users":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Users_Admins":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Users_Executives":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Users_Vendors":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Users_Customers":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Categories":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Coupons":{"Add":"on","Edit":"on","View":"on"},"Licences":{"Add":"on","Edit":"on","View":"on"},"Email_Templates":{"Add":"on","Edit":"on","View":"on"},"Offers":{"Add":"on","Edit":"on","View":"on"},"Pages":{"Add":"on","Edit":"on","View":"on"},"Faq":{"Add":"on","Edit":"on","View":"on"},"Payments_Report":{"Add":"on","Edit":"on","View":"on","Export":"on"},"Menus":{"Add":"on","Edit":"on","View":"on"},"Site_Settings":{"Add":"on","Edit":"on","View":"on"},"Email_Settings":{"Add":"on","Edit":"on","View":"on"},"Cart_Settings":{"Add":"on","Edit":"on","View":"on"},"Seo_Settings":{"Add":"on","Edit":"on","View":"on"},"Payment_Gateways":{"Add":"on","Edit":"on","View":"on"},"Languages":{"Add":"on","Edit":"on","View":"on","Change":"on"},"Messages":{"Add":"on","Edit":"on","View":"on"},"Change_Password":{"Edit":"on"},"Settings":{"Add":"on","Edit":"on","View":"on"},"Menu_Items":{"Add":"on","Edit":"on","View":"on"},"Profile":{"Edit":"on","View":"on"}}';
			}
			elseif($request->role_id==3){

			$user->user_modules_permissions = '{"Products":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Users":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Users_Admins":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Users_Executives":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Users_Vendors":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Users_Customers":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Categories":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Coupons":{"View":"on"},"Licences":{"View":"on"},"Email_Templates":{"View":"on"},"Offers":{"View":"on"},"Pages":{"View":"on"},"Faq":{"Add":"on","Edit":"on","View":"on"},"Payments_Report":{"View":"on"},"Menus":{"View":"on"},"Site_Settings":{"View":"on"},"Email_Settings":{"View":"on"},"Cart_Settings":{"View":"on"},"Seo_Settings":{"View":"on"},"Payment_Gateways":{"View":"on"},"Languages":{"View":"on"},"Change_Password":{"Edit":"on"},"Settings":{"View":"on"},"Menu_Items":{"View":"on"},"Profile":{"Edit":"on","View":"on"}}';
			}

			elseif($request->role_id==4){
              
              $user->user_modules_permissions = '{"Products":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Coupons":{"View":"on"},"Change_Password":{"Edit":"on"},"Profile":{"Edit":"on","View":"on"}}';

			}

			else{
				 $user->user_modules_permissions = '{"Products":{"View":"on"},"Coupons":{"View":"on"},"Change_Password":{"Edit":"on"},"Profile":{"Edit":"on","View":"on"}}';
			}

			 
	        $user->save();

	       $user->roles()->attach($user->role_id);

            $role_name = getRoleData($user->role_id);

	       	flash('Success','Record Created Successfully', 'success');
	       	DB::commit();
			}
			
   		
   		catch(Exception $ex) {
   			  DB::rollBack();
   				flash('Oops',$ex->getMessage(), 'overlay');
   		}

   		if( $role_name == '' ) {
			return redirect(URL_USERS);
		} 
		else {
			return redirect(URL_USERS . $role_name);
		}


    }

    /**
     * This module will load the edit view page
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function edit($slug)
    {
       $user_record = User::where('slug','=',$slug)->first();
	   if( ! $user_record )
		{
			flash('Oops','user_not_found', 'overlay');
			return redirect(URL_USERS);
		}
		
	   
	   $type = getRoleData($user_record->role_id);
	   if( $type == '' && $this->isModuleEligible('Users', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Users', array('Edit')) );
		}
		if( $type == 'owner' && $this->isModuleEligible('Users_Owners', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Owners', array('Edit')) );
		}
		if( $type == 'admin' && $this->isModuleEligible('Users_Admins', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Admins', array('Edit')) );
		}
		if( $type == 'executive' && $this->isModuleEligible('Users_Executives', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Executives', array('Edit')) );
		}
		if( $type == 'vendor' && $this->isModuleEligible('Users_Vendors', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Vendors', array('Edit')) );
		}
		if( $type == 'user' && $this->isModuleEligible('Users_Customers', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Vendors', array('Edit')) );
		}
		
        
		//dd($user_record);
		
        
        $data['record']         = $user_record;
        $data['role_name']     =  App\Role::where('id','=',$user_record->role_id)->first()->name;
        $data['layout']         = getLayout();
        $data['main_active']    = 'users';
        $data['sub_active']     = 'add';
        $data['title']          = 'Edit User';
        $data['roles']          = \App\Role::pluck('display_name', 'id');
		$data['user_type'] = getRoleData( $user_record->role_id );
            
        return view('users.add-edit', $data);
    }

    /**
     * This method will update the submitted data
     * @param  Request $request [description]
     * @param  [type]  $slug    [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $slug)
    {
    	// dd($slug);
        $user = User::where('slug','=',$slug)->first();

		$role_id = $user->role_id;
		$type = getRoleData($role_id);
		if( $type == '' && $this->isModuleEligible('Users', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Users', array('Edit')) );
		}
		if( $type == 'owner' && $this->isModuleEligible('Users_Owners', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Owners', array('Edit')) );
		}
		if( $type == 'admin' && $this->isModuleEligible('Users_Admins', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Admins', array('Edit')) );
		}
		if( $type == 'executive' && $this->isModuleEligible('Users_Executives', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Executives', array('Edit')) );
		}
		if( $type == 'vendor' && $this->isModuleEligible('Users_Vendors', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Vendors', array('Edit')) );
		}
		if( $type == 'user' && $this->isModuleEligible('Users_Customers', array('Edit')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Vendors', array('Edit')) );
		}

		$role_name = '';
       
        $this->validate($request, [
			'first_name'  => 'bail|required|max:20|',
			'email'     => 'bail|required|unique:users,email,'.$user->id,
			'image'     => 'bail|mimes:png,jpg,jpeg|max:2048',
			'role_id'  => 'bail|required|'
        ]);

 
        
         DB::beginTransaction();
         $name           = $request->first_name;
		 if( $request->last_name != '' )
			 $name .= ' ' . $request->last_name;
		 
         if($user->name != $name)
            $user->slug = $user->makeSlug($name);

        if($request->password)
            $user->password  = bcrypt($request->password);


        try {
            
            $user->name     = $name;
            
			$user->email    = $request->email;
			$user->role_id  = $request->role_id;
			if($request->has('status')) {
				$user->status  = $request->status;
				if( $request->status == 'Active' ) {
					$user->confirmed  = 1;
				}
			}
			$user->role_id  = $request->role_id;
			 
			 $user->first_name = $request->first_name;
			 $user->last_name = $request->last_name;			 
             $user->billing_address1 = $request->billing_address1;
			 $user->billing_address2 = $request->billing_address2;
			 $user->billing_city = $request->billing_city;
			 $user->billing_zip = $request->billing_zip;
			 $user->billing_state = $request->billing_state;
			 $user->billing_country = $request->billing_country;
			 $user->about_me = $request->about_me;
			 $user->social_links = json_encode( $request->social_links );
			 $user->user_modules_permissions = json_encode( $request->user_modules_permissions );

            $user->save();


          if($role_id != $request->role_id)
          {
               DB::table('role_user')
              ->where('user_id', '=', $user->id)
              ->where('role_id', '=', $role_id)
              ->delete();
          
       
           $user->roles()->attach($user->role_id); 
          }
		  $role_name = getRoleData($user->role_id);
          $this->processUpload($request, $user);
           
            flash('Success','Record Updated Successfully', 'success');
              DB::commit();
        }
        catch(Exception $ex) {
              DB::rollBack();
                flash('Oops',$ex->getMessage(), 'overlay');
        }
		if( $role_name == '' ) {
			return redirect(URL_USERS);
		} else {
			return redirect(URL_USERS . $role_name);
		}
    }



     public function processUpload(Request $request, User $user)
     {
         if ($request->hasFile('image')) {
          
          $old_image = $user->image;

          $destinationPath      = UPLOAD_PATH_USERS;
          $destinationPathThumb = UPLOAD_PATH_USERS_THUMBNAIL;
          
          $fileName = $user->id.'.'.$request->image->guessClientExtension();
          ;
          $request->file('image')->move($destinationPath, $fileName);

          $user->image = $fileName;
         
          Image::make($destinationPath.$fileName)->fit(160)->save($destinationPath.$fileName);
         
          Image::make($destinationPath.$fileName)->fit(45)->save($destinationPathThumb.$fileName);
          $user->save();

            $this->deleteFile($old_image, UPLOAD_PATH_USERS);
            $this->deleteFile($old_image, UPLOAD_PATH_USERS_THUMBNAIL);
        }
     }

    /**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean 
     */
    public function delete($slug)
    {
         $record = User::where('slug', $slug)->first();
        $role = getRoleData($record->role_id);
		$type = $role;
		 if( $type == '' && $this->isModuleEligible('Users', array('Delete')) != '' )
		{
			return redirect( $this->isModuleEligible('Users', array('Delete')) );
		}
		if( $type == 'owner' && $this->isModuleEligible('Users_Owners', array('Delete')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Owners', array('Delete')) );
		}
		if( $type == 'admin' && $this->isModuleEligible('Users_Admins', array('Delete')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Admins', array('Delete')) );
		}
		if( $type == 'executive' && $this->isModuleEligible('Users_Executives', array('Delete')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Executives', array('Delete')) );
		}
		if( $type == 'vendor' && $this->isModuleEligible('Users_Vendors', array('Delete')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Vendors', array('Delete')) );
		}
		if( $type == 'user' && $this->isModuleEligible('Users_Customers', array('Delete')) != '' )
		{
			return redirect( $this->isModuleEligible('Users_Vendors', array('Delete')) );
		}
        
        
        /**
         * Check if user is having any pending records in library
         * If the user is staff, check if the user is allocated to any course-subject
         */
        DB::beginTransaction();
        try{

          $image = $record->image;
            $record->delete();

            $this->deleteFile($image, UPLOAD_PATH_USERS);
            $this->deleteFile($image, UPLOAD_PATH_USERS_THUMBNAIL);

             DB::commit();
            $response['status'] = 1;
            $response['message'] = getPhrase('record_deleted_successfully');
      
      
          }
          catch (Exception $e) {
             DB::rollBack();
              $response['status'] = 0;
              $response['message'] =  $e->getMessage();
           
         }
          return json_encode($response);
      
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
     * This method display the users dashboard in admin view
     * @return [type] [description]
     */
    public function adminDashBoard()
    {   
        if(!checkRole(getUserGrade(2)))
        {
          prepareBlockUserMessage();
          return back();
        }
        $data['layout']       = getLayout();
        $data['main_active']  = 'users';
        $data['sub_active']   = 'all';
        $data['title']   = getPhrase('users_dashboard');
          
        return view('users.users-dashboard', $data);


    }
     
    /**
     * This method display the vendor dashborad
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function vendorDetails($user_slug)
    {   
       if(!checkRole(getUserGrade(5))){

        prepareBlockUserMessage();
        return back();

       }
        $record = User::where('slug','=',$user_slug)->first();
        
        $total_uploads = Product::where('user_created',$record->id)->get();
        
        $vendor_uploads = $total_uploads->count();

        if(count($vendor_uploads)==0){
          $vendor_uploads = 0;
        }

        $purchase_items = Payment::where('user_id',$record->id)->get()->count();
        if(!count($purchase_items)){
          $purchase_items = 0;
        }

        $vendor_got_amount = Payment_Items::join('payments','payments.id','=','payments_items.payment_id')
                                          ->join('products','products.id','=','payments_items.item_id')
                                          ->where('products.user_created','=',$record->id)
                                          ->select('payments_items.final_amount')->get();
        if(checkRole(getUserGrade(2))){
        $data['layout']       = getLayout();
        }
        else{
        $data['layout']       = 'layouts.layout-site';
        }
        $data['main_active']  = 'users';
        $data['record']       = $record;
        $data['vendor_uploads']  = $vendor_uploads;
        $data['total_uploads']   = $total_uploads;
        $data['purchase_items']  = $purchase_items;
        $data['vendor_got_amount']  = $vendor_got_amount;
        $data['sub_active']   = 'vendorlist';
        $data['title']        = $record->name.' '.getPhrase('dashborad');

        return view('users.details.vendor-profile', $data);
         
    }

    /**
     * This method display the vendor upload products
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function vendorUploadProducts($user_slug)
    {
      
        $record = User::where('slug','=',$user_slug)->first();
        $data['layout']       = getLayout();
        $data['main_active']  = 'users';
        $data['record']       = $record;
        $data['sub_active']   = 'vendorlist';
        $data['title']        = $record->name.' '.getPhrase('uploads');

        return view('products.vendor.upload', $data);

    }
     /**
      * This menthod get the vendor upload details
      * @param  [type] $user_slug [description]
      * @return [type]            [description]
      */
    public function vendorUploadProductsList($user_slug)
    {
       
      $record = User::where('slug','=',$user_slug)->first();

      $records = array(); 
   
    $records = Product::select(['id','name','slug', 'price', 
                                 'image', 'status'])
                        ->where('user_created','=',$record->id);
    if( current_user_role() == VENDOR_ROLE_ID ) {
      $records->where('user_created', '=', current_user_id());
    }
    
    return Datatables::of($records)
   
    ->editColumn('status', function($records) {
      return ucfirst($records->status);
    })
    ->editColumn('name',function($records){

      return '<a href="'.URL_PRODUCT_DETAILS.$records->id.'">'.ucfirst($records->name).'</a>';
    })
    ->removeColumn('id')
    ->removeColumn('slug')
    ->make(); 

    }

    /**
     * This method display sales list of specifice vendor products
     * @param  [type] $user_slug [description]
     * @return [type]            [description]
     */
    public function vendorProductsSales($user_slug)
    {
      
       $record = User::where('slug','=',$user_slug)->first();
        $data['layout']       = getLayout();
        $data['main_active']  = 'users';
        $data['record']       = $record;
        $data['user_slug']    = $user_slug;
        $data['sub_active']   = 'vendorlist';
        $data['title']        = $record->name.' '.getPhrase('product_sales');

        return view('products.vendor.sales', $data);


    }

   /**
    * This Method get the sales list of specifice vendor products
    * @param  string $value [description]
    * @return [type]        [description]
    */
    public function vendorProductsSalesList($user_slug)
    {
       
     $record = User::where('slug','=',$user_slug)->first();

    $records = array(); 
   $records = Payment::join('payments_items','payments_items.payment_id','=','payments.id')
                       ->join('products','products.id','=','payments_items.item_id')
                      ->select(['payments.id','payments_items.item_id','payments_items.total_cost','payments_items.coupon_id','payments_items.discount_amount','payments_items.licence_id','payments_items.licence_fee','payments_items.final_amount','payments.payment_gateway','payments.updated_at','payments.customer_first_name','payments.customer_last_name','payments.customer_email'])
                     ->where('payments.payment_status','=','success')
                     ->where('products.user_created','=',$record->id)
                     ->orderby('payments.updated_at','desc');
    
    return Datatables::of($records)
  
    ->editColumn('item_id', function($records) {
      
      $product_name = Product::where('id','=',$records->item_id)->first()->name;
      return $product_name;

    })
    
    ->editColumn('coupon_id', function($records) {
      
      if($records->coupon_id!=null){
        
        $coupon_name = Coupon::where('id','=',$records->coupon_id)->first()->code;
        return $coupon_name;

      }
      else{
        return '-';
      }

    })

      ->editColumn('discount_amount', function($records) {
     
     if($records->discount_amount!=null){ 
     return currency($records->discount_amount);
     }
     else{
      return '-';
     }

    })

   

      ->editColumn('licence_id', function($records) {
      
      if($records->licence_id!=null){
        
        $licence_name = Licence::where('id','=',$records->licence_id)->first()->title;
        return $licence_name;

      }
      else{
        return getPhrase('regular');
      }

    })

      ->editColumn('licence_fee', function($records) {
     
     if($records->licence_fee!=null){ 
     return currency($records->licence_fee);
     }
     else{
      return '-';
     }

    })  
  

     ->editColumn('final_amount', function($records) {
      
     return currency($records->final_amount);

    })

     ->editColumn('total_cost', function($records) {
      
     return currency($records->total_cost);

    })

->editColumn('customer_first_name', function($records) {

      return $records->customer_first_name.' '.$records->customer_last_name;
       
    })
    ->removeColumn('id')
    ->removeColumn('customer_last_name')
    ->make(); 

    }
   

    /**
     * This method display sales list of specifice vendor purchases
     * @param  [type] $user_slug [description]
     * @return [type]            [description]
     */
    public function vendorPurchases($user_slug)
    {
      
       $record = User::where('slug','=',$user_slug)->first();
        $data['layout']       = getLayout();
        $data['main_active']  = 'users';
        $data['record']       = $record;
        $data['user_slug']    = $user_slug;
        $data['sub_active']   = 'vendorlist';
        $data['title']        = $record->name.' '.getPhrase('purchases');

        return view('products.vendor.purchases', $data);


    }

   /**
    * This Method get the sales list of specifice vendor purchases
    * @param  string $value [description]
    * @return [type]        [description]
    */
    public function vendorPurchasesLists($user_slug)
    {
       
     $record = User::where('slug','=',$user_slug)->first();

    $records = array(); 
   $records = Payment::join('users', 'users.id','=','payments.user_id')
     ->select(['users.name', 'paid_amount','payment_gateway','payments.updated_at','payment_status','other_details','payments.id','cart_total','licence_price','discount_amount'])
     ->where('payments.user_id','=',$record->id)
    ->orderby('updated_at', 'desc');
     return Datatables::of($records)
      
        ->editColumn('payment_status',function($records){

          $rec = '';
          if($records->payment_status==PAYMENT_STATUS_CANCELLED)
           $rec = '<span class="label label-danger">'.ucfirst($records->payment_status).'</span>';
          elseif($records->payment_status==PAYMENT_STATUS_PENDING) {
            $rec = '<span class="label label-info">'.ucfirst($records->payment_status).'</span>';
          }
          elseif($records->payment_status==PAYMENT_STATUS_SUCCESS)
            $rec = '<span class="label label-success">'.ucfirst($records->payment_status).'</span>';
          return $rec;
        })
       
        ->editColumn('name', function($records)
        {
          return ucfirst($records->name);
        })

        ->editColumn('paid_amount', function($records)
        {
          return currency($records->paid_amount);
        })
        ->editColumn('other_details',function($records){

           $rec = '<button class="btn btn-info btn-sm" onclick="viewProductDetails('.$records->id.');">'.getPhrase('view_details').'</button>';
           return $rec;

        })
         ->editColumn('payment_gateway', function($records)
        {
          $text =  ucfirst($records->payment_gateway);



         if($records->payment_status==PAYMENT_STATUS_SUCCESS) {
          $total_cost = $records->cart_total+$records->licence_price;
          $extra = '<ul class="list-unstyled payment-col clearfix"><li>Gateway Type : '.$text.'</li>';
          $extra .='<li><p>Cost : '.currency($total_cost).'</p><p>Discount : '.currency($records->discount_amount).'</p><p>Paid :'.currency($records->paid_amount).'</p></li></ul>';
          return $extra;
        }
          return $text;
        })
        
        ->removeColumn('id')
        ->removeColumn('cart_total')
        ->removeColumn('licence_price')
        ->removeColumn('discount_amount')
        ->removeColumn('action')
        ->make(); 

    }


     /**
     * This method display the customer dashborad
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function customersProfile($user_slug)
    {   
         if(!checkRole(getUserGrade(5))){

        prepareBlockUserMessage();
        return back();

       }

        $record = User::where('slug','=',$user_slug)->first();
        
        $purchase_items = Payment::where('user_id',$record->id)->get()->count();
        if(!count($purchase_items)){
          $purchase_items = 0;
        }
        
        $customer_downloads = Payment_Items_Downloads::join('payments','payments.id','=','payment_id')
                                ->where('payments.user_id','=',$record->id)
                                ->get()->count();

        if(!count($customer_downloads)){
          $customer_downloads = 0;
        }                        
       
        $total_amount = Payment::join('payments_items','payments_items.payment_id','=','payments.id')
                          ->where('payments.user_id','=',$record->id)
                          ->select('paid_amount')->get();


         if(checkRole(getUserGrade(2))){
        $data['layout']       = getLayout();
        }
        else{
        $data['layout']       = 'layouts.layout-site';
        }
        $data['main_active']  = 'users';
        $data['record']       = $record;
        $data['purchase_items']  = $purchase_items;
        $data['total_amount']    = $total_amount;
        $data['customer_downloads']  = $customer_downloads;
        $data['sub_active']   = 'userlist';
        $data['title']        = $record->name.' '.getPhrase('dashborad');

        return view('users.details.customer-profile', $data);
         
    }


    /**
     * This method display sales list of specifice customer purchases
     * @param  [type] $user_slug [description]
     * @return [type]            [description]
     */
    public function customersPurchases($user_slug)
    {
      
       $record = User::where('slug','=',$user_slug)->first();
        $data['layout']       = getLayout();
        $data['main_active']  = 'users';
        $data['record']       = $record;
        $data['user_slug']    = $user_slug;
        $data['sub_active']   = 'userlist';
        $data['title']        = $record->name.' '.getPhrase('purchases');

        return view('products.customers.purchases', $data);


    }

   /**
    * This Method get the sales list of specifice customer purchases
    * @param  string $value [description]
    * @return [type]        [description]
    */
    public function customersPurchasesList($user_slug)
    {
       
     $record = User::where('slug','=',$user_slug)->first();

    $records = array(); 
   $records = Payment::join('payments_items','payments_items.payment_id','=','payments.id')
                      ->join('products','products.id','=','payments_items.item_id')
                      ->where('payments.user_id','=',$record->id)
                      ->select(['products.name','products.price','discount_amount','paid_amount','payment_gateway','payments.id','payments_items.created_at','user_id'])
                      ->orderby('payments_items.updated_at','desc');
   
    return Datatables::of($records)
   
    ->editColumn('payment_status', function($records) {
      return ucfirst($records->status);
    })
    ->editColumn('user_id',function($records){

       $user_data = User::where('id','=',$records->user_id)->first();
       return $user_data->email;
    })

    ->editColumn('id',function($records){

       $payment_data = Payment::where('id','=',$records->id)->first();
       return $payment_data->payment_status;
    })

     ->editColumn('coupon_applied',function($records){
        
        if($records->coupon_applied==0){
          return 'No';
        }
        
        return 'Yes';
    })
    ->make(); 

    }

     /**
     * This method display sales list of specifice customer downloads
     * @param  [type] $user_slug [description]
     * @return [type]            [description]
     */
    public function customersDownloads($user_slug)
    {
      
       $record = User::where('slug','=',$user_slug)->first();
        $data['layout']       = getLayout();
        $data['main_active']  = 'users';
        $data['record']       = $record;
        $data['user_slug']    = $user_slug;
        $data['sub_active']   = 'userlist';
        $data['title']        = $record->name.' '.getPhrase('downloads');

        return view('products.customers.downloads', $data);


    }

   /**
    * This Method get the sales list of specifice customer downloads
    * @param  string $value [description]
    * @return [type]        [description]
    */
    public function customersDownloadsList($user_slug)
    {
       
     $record = User::where('slug','=',$user_slug)->first();

    $records = array(); 
    $records = Payment_Items_Downloads::join('payments','payments.id','=','payment_id')
                                       ->join('payments_items','payments_items.payment_id','=','payments.id')
                                       ->join('products','products.id','=','payments_items.item_id')
                                     ->where('payments.user_id','=',$record->id)
                                     ->select(['products.name','payments_items_downloads.created_at'])
                                     ->orderby('payments_items_downloads.updated_at','desc');
   
    return Datatables::of($records)
   
    ->make(); 

    }
}
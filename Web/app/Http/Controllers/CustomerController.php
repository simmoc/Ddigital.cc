<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use DB;
use Illuminate\Support\Facades\Hash;
use Input;
use Exception;
use Auth;
use Image;
use App\Payment;
use Illuminate\Http\Request;
use App\User;
use File;
use App\Payment_Items_Downloads;
use Zipper;
use Illuminate\Filesystem\Filesystem;
use Response;

class CustomerController extends Controller
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
     public function index( Request $request, $tab = 'dashboard' )
     { 
      	$data['layout']      	= getLayout();
		$data['main_active'] 	= 'login';
		$data['sub_active'] 	= 'dashboard';
		$data['active_title'] 	= getPhrase('dashboard');
		$data['tab'] 	        = $tab;
		$user_id                = current_user_id();
		$data['record']         = User::where('id',$user_id)->first();
		$data['purchases']       = Payment::join('users', 'users.id','=','payments.user_id')
									     ->select(['users.name', 'paid_amount','payment_gateway','payments.updated_at','payment_status','other_details','payments.id','cart_total','licence_price','discount_amount'])
									     ->where('payments.user_id','=',$user_id)
									     ->orderby('updated_at', 'desc')
		                                ->paginate(PRODUCTS_DISPLAY_SIZE);
		if ($request->ajax()) {
			return view('customer.purchases', ['purchases' => $data['purchases']]);
		}
        return view('customer.dashboard', $data);
     }

	 /**
     * This method will update the submitted data
     * @param  Request $request [description]
     * @param  [type]  $slug    [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $tab)
    { 
    	// dd($request);

	   $user = getUserRecord();
	   
		$rules = [
			'first_name' => 'required',
		];
		if($request->password != '' ) {
			$rules['password'] = 'min:6';
			$rules['confirm_password'] = 'required|min:6|same:password';
		}
		$this->validate($request, $rules);

 
         DB::beginTransaction();
         $name           = $request->first_name . ' ' . $request->last_name;
         if($user->name != $name)
            $user->slug = $user->makeSlug($name);

        if($request->password)
            $user->password  = bcrypt($request->password);


        try {
            
            $user->name     = $name;
            
            $user->billing_address1 = $request->billing_address1;
			$user->billing_address2 = $request->billing_address2;
			$user->billing_city = $request->billing_city;
			$user->billing_zip = $request->billing_zip;
			$user->billing_state = $request->billing_state;
			$user->billing_country = $request->billing_country;
			
			$user->save();

			$this->processUpload($request,$user);
           
            flash('Success','Record updated successfully', 'success');
              DB::commit();
        }
        catch(Exception $ex) {
              DB::rollBack();
			  // dd($ex->getMessage());
              flash('Oops',$ex->getMessage(), 'overlay');
        }
		return redirect(URL_USERS_DASHBOARD . '/' . $tab);
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
        // dd('boy');
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

 
	
	// public function download($slug )
	// { 

	// 	$check = Payment::select(['payments.*', 'payments_items.item_name', 'products.id as product_id', 'products.download_files'])
	// 	->join('payments_items', 'payments_items.payment_id', '=', 'payments.id')
	// 	->join('products', 'products.id', '=', 'payments_items.item_id')
	// 	->where('user_id', '=', current_user_id())
	// 	->where('payments.slug', '=', $slug)
	// 	->first();
	// 	if( $check && $check->download_files != null )
	// 	{
			
			
	// 		$files = json_decode( $check->download_files );

	// 		//$files = glob('uploads/products/*');
			
	// 		// $files_array = array();
	// 		foreach( $files as $file ) {
	// 			$files_array = "uploads/products/downloads"."/".$file->file_name;
	// 		}
	// 		return Response::download($files_array);
	// 		// $zipper = new \Chumper\Zipper\Zipper;
	// 		// $zipper->make('test.zip');			
	// 		// $zipper->add($files_array);			
	// 		// $zipper->remove('test.zip');
	// 		// $zipper->close();
	// 		//Zipper::make('test.zip')->add($files_array)->close();
	// 	}
	// 	else
	// 	{
	// 		flash('Ooops','Something Went Wrong.Please Contact Administrator', 'overlay');
	// 		return redirect( URL_USERS_DASHBOARD.'/purchases' );
	// 	}
	// }
}


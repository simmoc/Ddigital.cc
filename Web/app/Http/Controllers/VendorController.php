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
use App\Product;
use Illuminate\Http\Request;
use App\User;
use File;
use App\Payment_Items_Downloads;
use Zipper;

class VendorController extends Controller
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
     public function index(Request $request, $tab = 'dashboard' )
     { 
      	$data['layout']      	= getLayout();
		$data['main_active'] 	= 'login';
		$data['sub_active'] 	= 'dashboard';
		$data['active_title'] 	= getPhrase('dashboard');
		$data['tab'] 	        = $tab;
		$user_id                = current_user_id();
		$data['record']         = User::where('id',$user_id)->first();
		$total_uploads          = Product::where('user_created',$user_id )->get();
        $vendor_uploads         = $total_uploads->count();

        if(count($vendor_uploads)==0){
          $vendor_uploads = 0;
        }
        $data['vendor_uploads']  = $vendor_uploads;
        $data['total_uploads']   = $total_uploads;
		$data['purchases']       = Payment::join('users', 'users.id','=','payments.user_id')
									     ->select(['users.name', 'paid_amount','payment_gateway','payments.updated_at','payment_status','other_details','payments.id','cart_total','licence_price','discount_amount'])
									     ->where('payments.user_id','=',$user_id)
									     ->orderby('updated_at', 'desc')
		                                ->paginate(PRODUCTS_DISPLAY_SIZE);
		// dd($data['purchases']);                                
		if ($request->ajax()) {
			return view('productvendor.purchases', ['purchases' => $data['purchases']]);
		}
        return view('productvendor.dashboard', $data);
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
         $name           = $request->first_name.' '.$request->last_name;
         if($user->name != $name)
            $user->slug = $user->makeSlug($name);

        if($request->password)
            $user->password  = bcrypt($request->password);


        try {
            
            $user->name              = $name;
            $user->first_name        = $request->first_name;
            $user->last_name         = $request->last_name;
            $user->about_me 		 = $request->about_me;
			$user->social_links 	 = json_encode( $request->social_links );
            $user->billing_address1  = $request->billing_address1;
			$user->billing_address2  = $request->billing_address2;
			$user->billing_city      = $request->billing_city;
			$user->billing_zip       = $request->billing_zip;
			$user->billing_state     = $request->billing_state;
			$user->billing_country   = $request->billing_country;
			
			$user->save();
			$file_name = 'catimage';
            if($request->image) {

            $rules = array( $file_name => 'mimes:jpeg,jpg,png,gif|max:10000' );
            $this->validate($request, $rules);
          
			$destinationPath = UPLOAD_PATH_USERS;
			$destinationPathThumb = UPLOAD_PATH_USERS_THUMBNAIL;
			$fileName = $user->id.'.'.$request->image->guessClientExtension();
			$width = 45;
			$height = 45;
			
			$this->deleteFile($fileName, $destinationPath);
			$this->deleteFile($fileName, $destinationPathThumb);
			
			$request->image->move($destinationPath, $fileName);
			
			Image::make($destinationPath.$fileName)->resize($width, $height)->save($destinationPathThumb.$fileName);
			
			$user->image = $fileName;
			$user->save();
		}
           
            flash('Success','Record updated successfully', 'success');
              DB::commit();
        }
        catch(Exception $ex) {
              DB::rollBack();
              flash('Oops',$ex->getMessage(), 'overlay');
        }
		return redirect(URL_VENDOR_DASHBOARD.'/'.$tab);
    }
	
	// public function processUpload(Request $request, User $user)
 //     {
 //         if ($request->hasFile('image')) {
          
 //          $old_image = $user->image;

 //          $destinationPath      = UPLOAD_PATH_USERS;
 //          $destinationPathThumb = UPLOAD_PATH_USERS_THUMBNAIL;
          
 //          $fileName = $user->id.'.'.$request->image->guessClientExtension();
 //          ;
 //          $request->file('image')->move($destinationPath, $fileName);

 //          $user->image = $fileName;
         
 //          Image::make($destinationPath.$fileName)->fit(160)->save($destinationPath.$fileName);
         
 //          Image::make($destinationPath.$fileName)->fit(45)->save($destinationPathThumb.$fileName);
 //          $user->save();

 //            $this->deleteFile($old_image, UPLOAD_PATH_USERS);
 //            $this->deleteFile($old_image, UPLOAD_PATH_USERS_THUMBNAIL);
 //        }
 //     }
	 
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
	
	// public function download( Request $request, $slug )
	// {
	// 	$check = Payment::select(['payments.*', 'payments_items.item_name', 'products.id as product_id', 'products.download_files'])
	// 	->join('payments_items', 'payments_items.payment_id', '=', 'payments.id')
	// 	->join('products', 'products.id', '=', 'payments_items.item_id')
	// 	->where('user_id', '=', current_user_id())
	// 	->where('payments.slug', '=', $slug)
	// 	->first();
	// 	if( $check )
	// 	{
	// 		$download_record = new Payment_Items_Downloads();
	// 		//$download_record->slug = $download_record->makeSlug(date('YdmHis'));
	// 		$download_record->payment_id = $check->product_id;
	// 		$download_record->ip_address = $request->ip();
	// 		$download_record->browser_agent = $request->header('User-Agent');
	// 		//$download_record->save();
			
	// 		$files = json_decode( $check->download_files );
	// 		//$files = glob('uploads/products/*');
	// 		$files_array = array();
	// 		foreach( $files as $file ) {
	// 			$files_array[] = 'uploads/produts/' . $file->name;
	// 		}
	// 		print_r($files_array);die();
	// 		$zipper = new \Chumper\Zipper\Zipper;
	// 		$zipper->make('test.zip');
	// 		$zipper->add($files_array);
	// 		$zipper->remove('test.zip');
	// 		$zipper->close();
	// 	}
	// 	else
	// 	{
	// 		flash('Oops','something_went_wrong.please contact administrator', 'error');
	// 		return FALSE;
	// 	}
	// }
}
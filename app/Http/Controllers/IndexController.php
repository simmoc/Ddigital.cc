<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Pages;
use App\User;
use App\Faq;
use App\FreeBies;
use Response;
use Newsletter;
use Exception;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data['main_active']    = 'Home';
        $data['sub_active']     = 'Home';
        //$data['title']          = 'Dashboard';
		
		$urlparams = $request->all();
		$category = $sub_category = '';
		if( isset($urlparams['category']) ) {
			$category = $urlparams['category'];
		}
		if( isset($urlparams['sub-category']) ) {
			$sub_category = $urlparams['sub-category'];
		}
		$data['selected_category']     = $category;
        $data['selected_sub_category'] = $sub_category;
		$params = array();
		if( $request->ajax() ) 
		{			
			if( $request->param == 'latest' ) {
				$params['orderby'] = 'latest';
			}
			if( $request->param == 'free' ) {
				$params['free'] = 'free';
			}
			if( $request->param == 'popular' ) {
				$params['popular'] = 'popular';
			}
			if( $request->param == 'featured' ) {
				$params['featured'] = 'featured';
			}
		}
		$data['products'] = Product::getProducts( $params )->paginate( 3 );
		$data['category_products'] = Product::getProducts( $params )->paginate( PRODUCTS_DISPLAY_SIZE );
		if ($request->ajax()) {
			return view('displayproducts.products', ['products' => $data['products'], 'nopagelinks' => 1]);
		}
		
        return view('welcome', $data);
    }
   /**
    * This method send the email to owner when user(unregisterd)
    * send a message
    * @param  Request $request [description]
    * @return [type]           [description]
    */
    public function contactus(Request $request)
    { 

     $this->validate($request, [
    		'name' 		    => 'bail|required',
    		'phone_number' 	=> 'bail|required',
    		'email'		    => 'bail|required',
    		'user_message'  => 'bail|required',
    		]);	
       try{
       	$user_details    = User::where('role_id','=',1)->first();
         $email_template = 'contactus_message';
         $contact_message = 1;
       
       try{
        sendEmail($email_template, array('name'=>$request->name, 
          'phone_number' => $request->phone_number,'from_email'=>$request->email,'user_message'=>$request->user_message,'to_email'=>$user_details->email),$contact_message);
      }
      catch(Exception $e){
        flash('Success','please_update_site_email_settings','overlay');
      }

       flash('Success', 'Your Message Sent Successfully', 'success');
       
    }
    catch(Exception $ex){

      $message = $ex->getMessage();
      flash('Oops..!', $message, 'overlay');
    }
      return back();
    }
   /**
    * This method send a email to product owner when user
    * send a message about a particular product
    * @param  Request $request [description]
    * @return [type]           [description]
    */
    public function productOwnerContact(Request $request)
    {   
    	 $this->validate($request, [
    		'customername' 		    => 'bail|required',
    		'phone_number'      	=> 'bail|required',
    		'customeremail'		    => 'bail|required',
    		'customer_message'      => 'bail|required',
    		]);	
    	 
    	 try{
       $email_template = 'product_owner_contact';
       $contact_message = 1;

       try{
        sendEmail($email_template, array('name'=>$request->customername, 
          'phone_number' => $request->phone_number,'from_email'=>$request->customeremail,'user_message'=>$request->customer_message,'to_email'=>$request->owneremail), $contact_message);

        }

        catch(Exception $e){

           flash('success','please_update_site_email_settings','overlay');

        }

       flash('Success', 'Your Message Sent Successfully', 'success');
       
    }
    catch(Exception $ex){

      $message = $ex->getMessage();
      flash('Oops..!', $message, 'overlay');
    }
      return back();

    }
	/*
	public function getProducts(Request $request)
	{
		
	}
	*/
	public function searchProduct(Request $request)
	{
		if($request->category=='')
		return redirect( URL_DISPLAY_PRODUCTS );
		else
		return redirect( URL_DISPLAY_PRODUCTS .'/'. $request->category );
	}
	
	public function subscribe(Request $request)
	{
		$rules = [
			'email'  => 'bail|required',
		];
		$this->validate($request, $rules);
		Newsletter::subscribeOrUpdate($request->email);
		$response = '';
		if( Newsletter::lastActionSucceeded() )
		{
			$response = '<div class="alert alert-success">'.getPhrase('Thanks for your subscription') . '</div>';
		}
		else
		{
			$response = '<div class="alert alert-success">'.getPhrase( Newsletter::getLastError() ) . '</div>';
		}
		return $response;
	}
	
	public function page( Pages $slug )
	{		
		if( ! $slug )
		{
			flash('Oops','Page not found', 'error');
			return redirect( PREFIX );
		}
		
		$data['main_active']    = 'pages';
        $data['sub_active']     = 'pages';
        $data['title']          = 'Pages';
		$data['record'] = $slug;
		return view('page', $data);
		
	}
	
	public function faqs()
	{				
		$data['main_active']    = 'faq';
        $data['sub_active']     = 'faq';
        $data['title']          = 'FAQs';
		$data['faqs'] = Faq::where('status', '=', 'active')->get();
		return view('faqs', $data);
		
	}

	/**
     * This method is used to download the files of free products
     * @param  Request $request [description]
     * @return [type]           [description]
     */
	public function freeBiesDownload(Request $request)
	{
		$product_details = Product::where('slug','=',$request->product_slug)->first();
		// dd($product_details);
         
         if($isValid = $this->isValidRecord($product_details))
    		return redirect($isValid);

        $files = json_decode($product_details->download_files );

           if($files==null){
             flash('Ooops','No Files Available Related To This Product','overlay');
             return back();	
            }

            if($product_details->product_belongsto==0 || $product_details->product_url!=null){
         	flash('Hai '.$request->user_name,'Go To This Link'.' '.$product_details->product_url.' '.'To Download The Product','overlay');
            return back();
           }  

         foreach( $files as $file ) {

				if($file->file_name!=''){
                 
                 $record                 = new FreeBies();
                 $record->user_name      = $request->user_name; 
                 $record->user_email     = $request->email; 
                 $record->product_id     = $product_details->id; 
                 $record->download_count = 1;
                 $record->save();
                

                $files_array = "public/uploads/products/downloads"."/".$file->file_name;
			    return Response::download($files_array);
			    flash('Success','Product Is Successfully Downloded','success');
		       }

		       else{
		            flash('Ooops','No File IS Uploaded For This Product','overlay');
		            return back();
		          }
		  }   

	}

	 /**
     * This method will checks if the record is valid
     * @param  [type]  $record [description]
     * @return boolean         [description]
     */
    public function isValidRecord($record)
    {
    	if ($record === null) {

    		flash('Ooops...!', getPhrase("page_not_found"), 'error');
   			return $this->getRedirectUrl();
		}
    }
}

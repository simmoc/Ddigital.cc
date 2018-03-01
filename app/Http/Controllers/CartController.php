<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use \Cart as Cart;
use Validator;
use App\Product;
use App\Payment_Items;
use App\Payment_Items_Downloads;
use App\Settings;
use App\Payment;
use App\Paypal;
use App\User;
use App\Coupon;
use Auth;
use Input;
use Softon\Indipay\Facades\Indipay;
use Response;
use Carbon;
use Exception;


class CartController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['main_active'] 	= 'products';
		$payment_gateways_record = Settings::where('key', '=', 'payment_gateways')->first();
		$data['payment_gateways'] = ['0' => getPhrase('Please select')] + array_pluck( Settings::where('parent_id', '=', $payment_gateways_record->id)->where('status','=','active')->get(), 'title', 'key');
        $data['title']  = getPhrase('cart_details');
		return view('cart.cart', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
        'id'  => 'required|exists:products',
		'name'  => 'required',
		// 'price'  => 'required',
        ];
		$this->validate($request, $rules);	
		
		$duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
				//return $cartItem->id === $request->id;				
				if( $cartItem->id === $request->id ) {
					$previous_value = $request->session()->get('licence_price');
					$cart_options   = $cartItem->options;
					$licence_price  = 0;
					if(!empty( $cart_options))
					{
						foreach( $cart_options as $key => $option ) {
							if( $key == 'licence_price' ) {
								$licence_price = $option;
							}
						}
					}
					$request->session()->put('licence_price', $previous_value - $licence_price);
					Cart::remove($cartItem->rowId);					
				}
				
		});		
		
		/*
        if (!$duplicates->isEmpty()) {
            return redirect('cart')->withSuccessMessage('Item is already in your cart!');
        }
		*/
		$product_details = Product::where('id', '=', $request->id)->first();
		$licence_price = 0;
		if( $request->has('licence') ) {
			
			$licence = App\Licence::where('id', '=', $request->licence)->first();
			if( $licence ) {
				$licence_price = $licence->price;
			}
		}
		
		if( $product_details->price_type == 'variable' ) {
		            $request->session()->put('licence_id',$request->licence);
			
			$options = $request->price;	
			if($options==null){
				flash('Oops','please_select_the_product','overlay');
				return back();
			}			
			$price_variations = (array) json_decode( $product_details->price_variations );
			
			if( ! empty( $price_variations ) ) {
				$licence_id  = $request->licence;
				$index = 0;
				foreach( $price_variations as $key => $val ) {
					if( in_array( $val->index, $options ) ) {
						$price = $val->amount;
						Cart::add($request->id, $product_details->name . ' - ' . $val->name, 1, $price, ['option' => $val->name, 'licence_id'=>$licence_id,'licence_price' => $licence_price, 'product_id' => $request->id ])->associate('App\Product');
					}
				}
			}
		} 
		else {
			$licence_id  = $request->licence;
			if($request->has('offer_price')){
             
             $price = $request->offer_price;

			}else{
			$price       = $product_details->price;
		  }
			Cart::add($request->id, $product_details->name, 1, $price, ['licence_price' => $licence_price,'licence_id'=>$licence_id, 'product_id' => $request->id])->associate('App\Product');
		}
		if($request->session()->has('licence_price')) {
			$previous_value = $request->session()->get('licence_price');
			$request->session()->put('licence_price', $previous_value + $licence_price);
		} 
		else {
			$request->session()->put('licence_price', $licence_price);
		}
		if( $request->has('addtocart') ) {
			return redirect('product-details/' . $product_details->slug)->withSuccessMessage('Item was added to your cart!');
		} 
		else {
			return redirect('cart')->withSuccessMessage('Item was added to your cart!');
		}
    }
		
	public function paynow(Request $request)
    { 

		if( Cart::total() > 0 )
		{
			$rules = [
			'gateway'  => 'required',
			'email'  => 'required|email',
			'first_name'  => 'required|min:3',
			];
			$messages = [
				'gateway.required' => getPhrase('Please select payment gateway'),
				'email.required' => getPhrase('Please enter email address'),
				'email.email' => getPhrase('Please enter valid email address'),
				'first_name.required' => getPhrase('Please select payment gateway')
			];
			$this->validate($request, $rules, $messages);
		}

		$licence_amount  = session()->get('licence_price');

		if( Cart::total() == 0 && $licence_amount==0   ) // Free Product Process
		{ 

			$token = $this->preserveBeforeSave( $request );
			return redirect( URL_CART_PAYMENTSUCCESS );
		}
		else
		{
			$payment_gateway = $request->gateway;
			if($payment_gateway == 'paypal')
			{			
				$token = $this->preserveBeforeSave( $request );
				
				$paypal = new Paypal();
				$paypal->config['return'] 		    = URL_PAYPAL_PAYMENT_SUCCESS.'?token='.$token;
				$paypal->config['cancel_return'] 	= URL_PAYPAL_PAYMENT_CANCEL.'?token='.$token;
				$paypal->invoice = $token;
				
				$paypal->config['email']      = $request->email;
				$paypal->config['first_name'] = $request->first_name;
				$paypal->config['last_name']  = $request->last_name;
				
				foreach (Cart::content() as $item) {

				   $licence_price=0;
				   if(session()->has('licence_price')){
				   	$licence_price = session()->get('licence_price');
				   }

				   $discount_amount=0;
				   if(session()->has('discount_amount')){
				   	$discount_amount = session()->get('discount_amount');
				   }
                    
                  $paypal->add($item->name, ($item->subtotal+$item->tax-$discount_amount)+$licence_price ,$item->qty, $item->rowId); //ADD  item
				}				
					
				return redirect( $paypal->pay() ); //Proccess the payment
			}
			elseif($payment_gateway == 'payu')
			{
				$token = $this->preserveBeforeSave( $request );

				$config = config();
				$payumoney = $config['indipay']['payumoney'];

				$payumoney['successUrl'] = URL_PAYU_PAYMENT_SUCCESS.'?token='.$token;
				$payumoney['failureUrl'] = URL_PAYU_PAYMENT_CANCEL.'?token='.$token;
				
				$user = Auth::user();

				$licence_price=0;
				   if(session()->has('licence_price')){
				   	$licence_price = session()->get('licence_price');
				   }

				   $discount_amount=0;
				   if(session()->has('discount_amount')){
				   	$discount_amount = session()->get('discount_amount');
				   }

				  $cart_total =  floatval(preg_replace('/[^\d.]/', '', Cart::total()));
				  $final_total = ($cart_total- $discount_amount)+$licence_price;
				$parameters = [
					'key' => getSetting('payu_merchant_key','payu'),
					'tid'       => $token,
					'surl'      => URL_PAYU_PAYMENT_SUCCESS.'?token='.$token,
					'furl'      => URL_PAYU_PAYMENT_CANCEL.'?token='.$token,
					'firstname' => $user->first_name,
					'lastname' => $user->last_name,
					'email'     =>$user->email,
					'phone'     => ($user->phone)? $user->phone : '45612345678',
					'productinfo' => 'Products',
					'service_provider'  => 'payu_paisa',				
					'amount'    => $final_total,				
				];
				$parameters['curl'] = URL_PAYU_PAYMENT_CANCEL.'?token='.$token;
				$parameters['address1'] = $user->billing_address1;
				$parameters['address2'] = $user->billing_address2;
				$parameters['city'] = $user->billing_city;
				$parameters['state'] = $user->billing_state;
				$parameters['country'] = $user->billing_country;
				$parameters['zipcode'] = $user->billing_zip;
				$parameters['salt'] = getSetting('payu_salt','payu');
				$parameters['testMode'] = getSetting('payu_testmode','payu');
				
	//dd($parameters);
				return Indipay::gateway('PayUMoney')->purchase($parameters);
			}
			elseif($payment_gateway == 'offline-payment')
			{

				$token = $this->preserveBeforeSave($request);
				$data['layout']             = getLayout();
				$data['title'] 	            = getPhrase( 'offline_payment' );
				$data['main_active'] 	    = 'products';
				$data['token']              = $token;
				return view('cart.offline', $data);
			}
		}
	}
	
	/**
     * This method saves the submitted data from user and waits for the admin approval
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateOfflinePayment(Request $request)
    {
      
	  $record = Payment::where('slug', '=', $request->token)->first();

	  
	  if( $record ) {
		  $record->payment_details = $request->payment_details;
		  $record->paid_amount = 0;
		  $record->save();
		  
		Cart::destroy();
		$request->session()->forget('paymenttoken');
		if($request->session()->has('licence_id')){
			$request->session()->forget('licence_id');
		   }
		   if($request->session()->has('couponid')){
			$request->session()->forget('couponid');
		  }

		  if($request->session()->has('not_applicable_product_ids')){
			$request->session()->forget('not_applicable_product_ids');
		 }

		 if($request->session()->has('total_excluded_products')){
			$request->session()->forget('total_excluded_products');
		}
          

           if($request->session()->has('licence_price')){
			$request->session()->forget('licence_price');
		}

		if($request->session()->has('final_discount')){
			$request->session()->forget('final_discount');
		}

		if( $request->session()->has('discount_amount') ) {
				$request->session()->forget('discount_amount');
			}
		  if(Auth::check()) {
			if( checkRole(getUserGrade(6)) )
				return redirect(URL_USERS_DASHBOARD.'/purchases');
			elseif( checkRole(getUserGrade(8)) )
				return redirect(URL_VENDOR_DASHBOARD.'/purchases');
			elseif( checkRole(getUserGrade(3)) )
				return redirect( URL_DASHBOARD );
		  } else {
			  return redirect( URL_CART_PAYMENTSUCCESS )->withErrorMessage('your_payment_success. But admin need to accept your payment');
		  }
		  
	  } 
	  else {
		flash('Error','invalid_operation', 'error');
		return back();
	  }      
    }
	
	/**
     * This method saves the record before going to payment method
     * The exact record can be identified by using the slug 
     * By using slug we will fetch the record and update the payment status to completed
     * @param  [type] $item           [description]
     * @param  [type] $payment_method [description]
     * @return [type]                 [description]
     */
    public function preserveBeforeSave($request)
    {
        $user = getUserRecord();
		
		if ($request->session()->has('paymenttoken')) {

			$token = $request->session()->get('paymenttoken', '');
			$payment = Payment::where('slug', '=', $token)->first();

		} 
		else {

			$payment 			= new Payment();
			$request->session()->put('paymenttoken', getHashCode());

		}

		
		if( $user )
		$payment->user_id         = $user->id;
		$payment->payment_gateway = $request->gateway;
		if ($request->session()->has('paymenttoken')) {
			$payment->slug 		= $request->session()->get('paymenttoken', '');
		} 
		else {
			$payment->slug 		= getHashCode();
		}
		
		// $payment->transaction_id = '';
		// $payment->paid_by = '';
		$licence_price = 0;
		if( session()->has('licence_price') ) {
			$licence_price = session()->get('licence_price');
		}

		$coupon_id = 0;
			if( session()->has('couponid') ) {
			 $coupon_id = session()->get('couponid');
		  }
		
          
        $discount_amount = 0;
		if( session()->has('discount_amount') ) {
			$discount_amount = session()->get('discount_amount');
			
		}

		$licence_id=0;
		if(session()->has('licence_id')){
			$licence_id = session()->get('licence_id');
		}


		 $tax_field = getSetting('enable_taxes','cart_settings');
		if($tax_field=='yes'){
		$tax = Cart::instance('default')->tax();
	    }
		else{
		$tax = 0;
	    }
	    $cart_total = $parsed = floatval(preg_replace('/[^\d.]/', '', Cart::total()));
		$payment->cost 		= ($cart_total-$discount_amount)+$licence_price;//item-price+tax-discount_amount+support fee
		
		$payment->cart_total      = $cart_total; // Item Price only+tax
		$payment->item_price      = $cart_total - $tax;
		$payment->tax             = $tax;
		$payment->licence_price   = $licence_price;
		$payment->discount_amount = $discount_amount;		
		$payment->coupon_id       = $coupon_id;		
		// $payment->licence_id      = $licence_id;		
		$payment->paid_amount     = ($cart_total-$discount_amount)+$licence_price;
		$payment->payment_status  = PAYMENT_STATUS_PENDING;
		$other_details = array(
			'cost' => Cart::total() + $licence_price - $discount_amount, // Item Price + Tax + Licence - $discount_amount
			'cart_total' => $cart_total, // Item Price + Tax			
			'item_price' => $cart_total - $tax, // Item Price only
			'tax' => $tax,
			'licence_price' => $licence_price,
			'discount_amount' => $discount_amount,
		);
		$payment->other_details 	= json_encode($other_details);
	
		$payment->customer_email      = $request->email;
		$payment->customer_first_name = $request->first_name;
		$payment->customer_last_name  = $request->last_name;
		//dd(Cart::content());	
		$payment->save();

		

	
		// Let us save cart items
	$downloaded_file = [];
	foreach (Cart::content() as $item) {
			$tax_rate = getSetting('tax_rate','cart_settings');
            
            if(session()->has('couponid')){
              $couponid        = session()->get('couponid');
              $coupon_details  =  Coupon::where('id','=',$couponid)->first();
             }
            $payment_item = Payment_Items::where('payment_id', '=', $payment->id)->where('slug', '=', $item->rowId)->first();
			if( ! $payment_item ) {
				$payment_item 	= new Payment_Items();
			}
			
			if($item->model->price_type=='default'){
			$payment_item->payment_id  	 = $payment->id;
			$payment_item->slug        	 = $item->rowId;
			$payment_item->item_id     	 = $item->model->id;
			$payment_item->item_slug   	 = $item->model->slug;
			$payment_item->item_name   	 = $item->name;
			$payment_item->item_price  	 = $item->model->price;
			$individual_item_price       = $item->model->price;
            $tax_amount                  =  ($individual_item_price * $tax_rate)/100; //tax calcualtion per product
            $payment_item->tax           = $tax_amount;
            $payment_item->total_cost    = $individual_item_price+$tax_amount; //tax+item price
            }
            else{
            
			$downloaded_file[]             = $item->options['option'];
            $payment_item->payment_id  	 = $payment->id;
			$payment_item->slug        	 = $item->rowId;
			$payment_item->item_id     	 = $item->model->id;
			$payment_item->item_slug   	 = $item->model->slug;
			$payment_item->item_name   	 = $item->name;
			$payment_item->item_price  	 = $item->price;
			$individual_item_price       = $item->price;
            $tax_amount                  =  ($individual_item_price * $tax_rate)/100; //tax calcualtion per product
            $payment_item->tax           = $tax_amount;
            $payment_item->total_cost    = $individual_item_price+$tax_amount;
            }
             
             
             

             // discount calculations
            if(session()->has('not_applicable_product_ids')){
             $not_applicable_product_ids   = session()->get('not_applicable_product_ids');
            }
            //some products coupon applicable and some are not

            $total_excluded_products    = session()->get('total_excluded_products');
          	$total_cart_items           = count(Cart::content());
          	$fianal_applicable_products = $total_cart_items - $total_excluded_products; 
            
            if(isset($not_applicable_product_ids)){

               $total_amount = 0;
            	foreach ($not_applicable_product_ids as $key => $value) {
            		
            		$amount_data       = Product::where('id','=',$value)->first()->price;
            		$with_tax          = ($amount_data * $tax_rate)/100;
            		$total_amount      += $amount_data + $with_tax;

            		
            	}
           if(!empty($coupon_details) && !in_array($item->model->id , $not_applicable_product_ids)){

              	 if($coupon_details->type=='percent'){
              	 	$copon_max_amount   =  $coupon_details->max_discount_amount;
              	 	if($copon_max_amount!=0){
                       $final_discount   = session()->get('final_discount');//applicable products total discount
              	 	

              	 	//final discount < copuon max discount	
                     if($final_discount <= $copon_max_amount){

              	       		if($fianal_applicable_products==1){ 

                          $reduced_amount = (($individual_item_price+$tax_amount) * $coupon_details->value)/100;
                          $after_discount_amount  = ($individual_item_price+$tax_amount) -  $reduced_amount;

                         }
                         
                         else{

                          $all_amount_and_tax  = Cart::instance('default')->subtotal()+Cart::instance('default')->tax();

                          $cart_amount_and_tax    = $all_amount_and_tax  - $total_amount;
                         
                         $item_amount = $individual_item_price+$tax_amount;

                         $item_percentage = getPercentage($item_amount,$cart_amount_and_tax);
                          
                         $discount_amount_per_product = calculatePercentage($final_discount,$item_percentage);
                         
                         $reduced_amount = $discount_amount_per_product;
                         $after_discount_amount  = ($individual_item_price+$tax_amount) -  $reduced_amount;
                        
                         }
              	 	 }


              	 	 //final discount > copuon max discount
              	 	 else{
              	 	 	 if($fianal_applicable_products==1){ 

                          $reduced_amount = $copon_max_amount;
                          $after_discount_amount  = ($individual_item_price+$tax_amount) -  $reduced_amount;

                         }
                         
                         else{

                           $all_amount_and_tax  = Cart::instance('default')->subtotal()+Cart::instance('default')->tax();

                          $cart_amount_and_tax    = $all_amount_and_tax  - $total_amount;
                         
                         $item_amount = $individual_item_price+$tax_amount;

                         $item_percentage = getPercentage($item_amount,$cart_amount_and_tax);
                          
                         $discount_amount_per_product = calculatePercentage($copon_max_amount,$item_percentage);
                         
                         $reduced_amount = $discount_amount_per_product;
                         $after_discount_amount  = ($individual_item_price+$tax_amount) -  $reduced_amount;
                        
                       }

              	 	 }

              	  }

              	  else{
              	  	     $reduced_amount = (($individual_item_price+$tax_amount) * $coupon_details->value)/100;
                         $after_discount_amount  = ($individual_item_price+$tax_amount) -  $reduced_amount;
              	  }
                }
               
               //Type== value
               else{

               	$minus_amount = $coupon_details->value;

                        
                        //in total cart, cart contains only one coupon applicable product remaing are not  
                 if($fianal_applicable_products==1){ 
                    
                    //copuon amount > = total product price and tax
                 	if($minus_amount >= $individual_item_price+$tax_amount ){

                       $reduced_amount         = $individual_item_price+$tax_amount;
                       $after_discount_amount  = ($individual_item_price+$tax_amount) -  $reduced_amount;
                 	}
                  
                  else{

                  $reduced_amount         = $coupon_details->value;
                  $after_discount_amount  = ($individual_item_price+$tax_amount) -  $reduced_amount;
                   }

                 }
                 
                 else{

                 $all_amount_and_tax  = Cart::instance('default')->subtotal()+Cart::instance('default')->tax();

                 $cart_amount_and_tax    = $all_amount_and_tax  - $total_amount;
                 
                 $item_amount = $individual_item_price+$tax_amount;

                 $item_percentage = getPercentage($item_amount,$cart_amount_and_tax);
                  
                 $discount_amount_per_product = calculatePercentage($minus_amount,$item_percentage);
                 
                 $reduced_amount = $discount_amount_per_product;
                 $after_discount_amount  = ($individual_item_price+$tax_amount) -  $reduced_amount;
                
                 }

               }
               
            $payment_item->coupon_applied  = 1;
            $payment_item->coupon_id       = $coupon_details->id;
            $payment_item->discount_amount = $reduced_amount;
            $payment_item->after_discount  = $after_discount_amount;

              }

              //coupon is not apply
            else{
            $payment_item->after_discount  = $individual_item_price+$tax_amount;
            }	

      }
           
          
          //all are products are coupon applicable
          else{


          	if(!empty($coupon_details)){

              	 if($coupon_details->type=='percent'){
              	 	
              	 	$copon_max_amount   =  $coupon_details->max_discount_amount;
              	 	if($copon_max_amount!=0){
                       $final_discount   = session()->get('final_discount');//applicable products total discount
              	 		
                     if($final_discount <= $copon_max_amount){

              	       		if($fianal_applicable_products==1){ 

                          $reduced_amount = (($individual_item_price+$tax_amount) * $coupon_details->value)/100;
                          $after_discount_amount  = ($individual_item_price+$tax_amount) -  $reduced_amount;

                         }
                         
                         else{

                          $cart_amount_and_tax  = Cart::instance('default')->subtotal()+Cart::instance('default')->tax();
                         
                         $item_amount = $individual_item_price+$tax_amount;

                         $item_percentage = getPercentage($item_amount,$cart_amount_and_tax);
                          
                         $discount_amount_per_product = calculatePercentage($final_discount,$item_percentage);
                         
                         $reduced_amount = $discount_amount_per_product;
                         $after_discount_amount  = ($individual_item_price+$tax_amount) -  $reduced_amount;
                        
                         }
              	 	 }
              	 	 else{
              	 	 	 if($fianal_applicable_products==1){ 

                          $reduced_amount = $copon_max_amount;
                          $after_discount_amount  = ($individual_item_price+$tax_amount) -  $reduced_amount;

                         }
                         
                         else{

                          $cart_amount_and_tax  = Cart::instance('default')->subtotal()+Cart::instance('default')->tax();
                         
                         $item_amount = $individual_item_price+$tax_amount;

                         $item_percentage = getPercentage($item_amount,$cart_amount_and_tax);
                          
                         $discount_amount_per_product = calculatePercentage($copon_max_amount,$item_percentage);
                         
                         $reduced_amount = $discount_amount_per_product;
                         $after_discount_amount  = ($individual_item_price+$tax_amount) -  $reduced_amount;
                        
                       }

              	 	 }

              	  }

              	  else{
              	  	     $reduced_amount = (($individual_item_price+$tax_amount) * $coupon_details->value)/100;
                         $after_discount_amount  = ($individual_item_price+$tax_amount) -  $reduced_amount;
              	  }
                }

                //type == value
               
               else{

               	$minus_amount = $coupon_details->value;
                        //in total cart, cart contains only one coupon applicable product remaing are not  
                 if($fianal_applicable_products==1){ 

                 //copuon amount > = total product price and tax
                 	if($minus_amount >= $individual_item_price+$tax_amount ){

                       $reduced_amount         = $individual_item_price+$tax_amount;
                       $after_discount_amount  = ($individual_item_price+$tax_amount) -  $reduced_amount;
                 	}
                  
                  else{

                  $reduced_amount         = $coupon_details->value;
                  $after_discount_amount  = ($individual_item_price+$tax_amount) -  $reduced_amount;
                   }

                 }
                 
                 else{

                 $cart_amount_and_tax  = Cart::instance('default')->subtotal()+Cart::instance('default')->tax();

                 $item_amount = $individual_item_price+$tax_amount;

                 $item_percentage = getPercentage($item_amount,$cart_amount_and_tax);
                  
                 $discount_amount_per_product = calculatePercentage($minus_amount,$item_percentage);
                 
                 $reduced_amount = $discount_amount_per_product;
                 $after_discount_amount  = ($individual_item_price+$tax_amount) -  $reduced_amount;

                
                 }

               }
               
            $payment_item->coupon_applied  = 1;
            $payment_item->coupon_id       = $coupon_details->id;
            $payment_item->discount_amount = $reduced_amount;
            $payment_item->after_discount  = $after_discount_amount;

              }

              //coupon is not apply
            else{
            $payment_item->after_discount  = $individual_item_price+$tax_amount;
            }

          	

          }  

            
            
            if($item->options['licence_id']!=null && $item->options['licence_price']!=0){
            $payment_item->licence_applied = 1;
            $payment_item->licence_id      = $item->options['licence_id'];
			$payment_item->licence_fee     = $item->options['licence_price'];
			$payment_item->final_amount    = $payment_item->after_discount + $item->options['licence_price'];
		    }
		    //licence is not apply
		    else{
             
             $payment_item->final_amount    = $payment_item->after_discount;

		    }
			$payment_item->other_details   = $item->model;
			$payment_item->quantity        = $item->qty;
			$payment_item->save();
//echo $item->name.'##'.$payment_item->id.'##'.$payment->id.'##'.$item->model->slug.'<br>';
			$produc_details  =  Product::where('id','=',$item->model->id)->first();
			$product_owner_details  = User::where('id','=',$produc_details->user_created)->first();

			$email_template = 'all_payments';
    	    $contact_message = 1;
     //          try{
		   //     sendEmail($email_template, array('name'=>'Check Payment', 
		   //       'paid_amount'=>$payment->paid_amount,'to_email'=>$product_owner_details->email,'from_email'=>$user->email,'user_name'=>$user->name,'payment_gateway'=>$request->gateway),$contact_message);
		   // }
		   // catch(Exception $e){
              
     //          flash('Success','please_update_mail_settings','overlay');
		   // }
		}
       $data_files = json_encode($downloaded_file);
             session()->put('downloaded_file_name',$data_files);
	
       $email_template = 'all_payments';
       $contact_message = 1;
		$owner_details  = User::where('role_id','=',1)->first();
          
          try{
		  sendEmail($email_template, array('name'=>'Check Payment', 
		         'paid_amount'=>$payment->paid_amount,'to_email'=>$owner_details->email,'from_email'=>$user->email,'user_name'=>$user->name,'payment_gateway'=>$request->gateway),$contact_message);
		}
		catch(Exception $e){
           
           flash('Success','please_update_mail_settings','overlay');

		}

		return $payment->slug;
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Validation on max quantity
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,5'
        ]);

         if ($validator->fails()) {
            session()->flash('error_message', 'Quantity must be between 1 and 5.');
            return response()->json(['success' => false]);
         }

        Cart::update($id, $request->quantity);
        session()->flash('success_message', 'Quantity was updated successfully!');

        return response()->json(['success' => true]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $redirect = true)
    {
    	// dd($id);
		// echo sizeof(Cart::content());die();
		if (sizeof(Cart::content()) == 1)
		{
			Cart::destroy();
			session()->forget('licence_price');
			session()->forget('paymenttoken');
			if( session()->has('discount_amount') ) {
				session()->forget('discount_amount');
				session()->forget('discount_details');
			}
		}
		else
		{

		if( session()->has('licence_price') ) {
			$licence_price = session()->get('licence_price');
			$item_licence = 0;
			
			$item_licence =  (int)Cart::get($id)->options['licence_price'];
			
            if( $licence_price != 0 ) {
				session()->put('licence_price', $licence_price - $item_licence);
			}
		}
		Cart::remove($id);
		}

		if( $redirect ) {
			return redirect('cart')->withSuccessMessage('Item has been removed!');
		}
    }

    /**
     * Remove the resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function emptyCart()
    {
        Cart::destroy();
		
		session()->forget('paymenttoken');
		if($request->session()->has('licence_id')){
			$request->session()->forget('licence_id');
		   }
		   if($request->session()->has('couponid')){
			$request->session()->forget('couponid');
		  }

		  if($request->session()->has('not_applicable_product_ids')){
			$request->session()->forget('not_applicable_product_ids');
		 }

		 if($request->session()->has('total_excluded_products')){
			$request->session()->forget('total_excluded_products');
		}
          

           if($request->session()->has('licence_price')){
			$request->session()->forget('licence_price');
		}
		if($request->session()->has('final_discount')){
			$request->session()->forget('final_discount');
		}
		if( $request->session()->has('discount_amount') ) {
			$request->session()->forget('discount_amount');
			$request->session()->forget('discount_details');
		}
        return redirect('cart')->withSuccessMessage('Your cart has been cleared!');
    }

    /**
     * Switch item from shopping cart to wishlist.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToWishlist($id)
    {
        $item = Cart::get($id);

        Cart::remove($id);

        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });

        if (!$duplicates->isEmpty()) {
            return redirect('cart')->withSuccessMessage('Item is already in your Wishlist!');
        }

        Cart::instance('wishlist')->add($item->id, $item->name, 1, $item->price)
                                  ->associate('App\Product');

        return redirect('cart')->withSuccessMessage('Item has been moved to your Wishlist!');

    }
	
	public function paypal_success(Request $request)
    {
		 $response = $request->all();
         $params = explode('?token=',$_SERVER['REQUEST_URI']) ;
    
     if(!count($params))
      return FALSE;
    
    $slug = $params[1];
        
		$payment_record = Payment::where('slug', '=', $slug)->first();
		$user = getUserRecord();
    	if( $payment_record )
    	{
			$amount = $request->mc_gross;
			$payment_record->transaction_record = json_encode($response);
			if( $request->payment_status == 'Success' ) {
				$payment_record->payment_status = PAYMENT_STATUS_SUCCESS;
				$payment_record->paid_amount = $amount;
			}
			$payment_record->transaction_id = $request->txn_id;
			$payment_record->save();
			//PAYMENT RECORD UPDATED SUCCESSFULLY
			//PREPARE SUCCESS MESSAGE
			flash('success', 'your_subscription_was_successfull', 'overlay');
			$email_template = 'subscription_success';
			$paymentdetails = Payment::select(['payments.slug as payment_slug','payments.payment_gateway','payments.transaction_id','payments.cost','payments.cart_total', 'payments.item_price','payments.tax','payments.licence_price','payments.discount_amount','payments.paid_amount','payments.payment_status','pi.*'])->join('payments_items as pi', 'payments.id', '=', 'pi.payment_id')->where('payments.slug', '=', $slug);
			$products = '<table class="table">
									<thead>
										<tr>
											<th>'.getPhrase('Image').'</th>
											<th>'. getPhrase('Product Name').'</th>
											<th>'. getPhrase('Product Price').'</th>
										</tr>
									</thead>
									<tbody>';
			foreach( $paymentdetails->get() as $item ) {
				$products .= '<tr>
											<td class="table-image">
											';
											
											$product_image = DEFAULT_PRODUCT_IMAGE_THUMBNAIL;
											if( $item->item_image != '' && File::exists(UPLOAD_PATH_PRODUCTS_THUMBNAIL . $item->model->image ) ) {
												$product_image = UPLOAD_URL_PRODUCTS_THUMBNAIL . $item-item_image;
											}
				$products .= '
											<a href="'.URL_DISPLAY_PRODUCTS_DETAILS . $item->item_slug.'"><img src="'.$product_image.'" alt="product" class="img-responsive cart-image"></a></td>
											
											<td><a href="'.URL_DISPLAY_PRODUCTS_DETAILS . $item->item_slug .'">'. $item->item_name .'</a></td>
											
											<td class="colu2">'. currency( $item->cost ) .'</td>											

										</tr>';
			}
			$products .= '</tbody></table>';
			
			$name = $request->first_name;
			$email = $request->email;
			if( ! $name ) {
				$name = $response['first_name'] . ' ' . $response['last_name'];
			}
			if( ! $email ) {
				$email = $response['payer_email'];
			}
			try{
			sendEmail($email_template, array('username'=>$name, 
			'cost' => $amount,
			'to_email' => $email,
			'products' => $products,
			));
		 }
			catch(Exception $e){
           
           flash('Success','please_update_mail_settings','overlay');

		}

			// Let us clear the cart
			Cart::destroy();
			$request->session()->forget('paymenttoken');
			if($request->session()->has('licence_id')){
			$request->session()->forget('licence_id');
		   }
		   if($request->session()->has('couponid')){
			$request->session()->forget('couponid');
		  }

		  if($request->session()->has('not_applicable_product_ids')){
			$request->session()->forget('not_applicable_product_ids');
		 }

		 if($request->session()->has('total_excluded_products')){
			$request->session()->forget('total_excluded_products');
		}
          

           if($request->session()->has('licence_price')){
			$request->session()->forget('licence_price');
		}

		if($request->session()->has('final_discount')){
			$request->session()->forget('final_discount');
		}
			if( $request->session()->has('discount_amount') ) {
				$request->session()->forget('discount_amount');
				$request->session()->forget('discount_details');
			}
			if( $user ) {
				if( checkRole(getUserGrade(6)) )
					return redirect(URL_USERS_DASHBOARD.'/purchases')->withSuccessMessage('Thank you for your purchase!');
				elseif( checkRole(getUserGrade(8)) )
					return redirect(URL_VENDOR_DASHBOARD.'/purchases')->withSuccessMessage('Thank you for your purchase!');
				elseif( checkRole(getUserGrade(3)) )
					return redirect( URL_DASHBOARD )->withSuccessMessage('Thank you for your purchase!');
			} else {
				$request->session()->put('purchaseconfirm', $request);
				return redirect( URL_CART_PURCHASECONFIRM )->withSuccessMessage( getPhrase('Thank you for your purchase!') );
			}
			
    	}
    	else {
    	//PAYMENT RECORD IS NOT VALID
    	//PREPARE METHOD FOR FAILED CASE
    	  pageNotFound();
    	}
		//REDIRECT THE USER BY LOADING A VIEW
	
    	return redirect(URL_PAYPAL_CANCEL_RETURN);    	
    }
	
	public function paypal_cancel()
    {

    	if($this->paymentFailed())
    	{
    		//FAILED PAYMENT RECORD UPDATED SUCCESSFULLY
    		//PREPARE SUCCESS MESSAGE
    		  flash('Ooops...!', 'your_payment_was cancelled', 'overlay');
    	}
    	else {
    	//PAYMENT RECORD IS NOT VALID
    	//PREPARE METHOD FOR FAILED CASE
    	  pageNotFound();
    	}

    	//REDIRECT THE USER BY LOADING A VIEW
    	$user = Auth::user();
    	return redirect(URL_PAYPAL_CANCEL_RETURN);
    	 
    }
	
	
	public function show()
	{
		if( Auth::check() )
		{
			$data['main_active'] 	= 'products';
			$data['title']  = getPhrase('checkout');
			$payment_gateways_record = Settings::where('key', '=', 'payment_gateways')->first();
			
			$data['payment_gateways'] = Settings::where('parent_id', '=', $payment_gateways_record->id)->where('status','=','active')->get();
			
			return view('cart.checkout', $data);
		} 
		else {
			return redirect(URL_USERS_LOGIN)->withErrorMessage( 'Please login to proceed with check out' );
		}
	}
	
	public function purchaseConfirm()
	{
		if($request->session()->has('purchaseconfirm'))
		{
				$details = $request->session()->has('purchaseconfirm');
		}
		else
		{
			flash('error', 'wrong operation', 'overlay');
			redirect( URL_DISPLAY_PRODUCTS );
		}
	}
	
	public function payu_success(Request $request)
    {
       $response = $request->all();        
		$params = explode('?token=',$_SERVER['REQUEST_URI']) ;
    
     if(!count($params))
      return FALSE;
    
    $slug = $params[1];
		$payment_record = Payment::where('slug', '=', $slug)->first();
		$user = getUserRecord();
		if( $payment_record )
		{
			//PAYMENT RECORD UPDATED SUCCESSFULLY
			//PREPARE SUCCESS MESSAGE
			flash('success', 'your_subscription_was_successfull', 'overlay');
			$email_template = 'subscription_success';
			
			$paymentdetails = Payment::select(['payments.slug as payment_slug','payments.payment_gateway','payments.transaction_id','payments.discount_amount','payments.tax','payments.paid_amount','payments.payment_status','pi.*'])->join('payments_items as pi', 'payments.id', '=', 'pi.payment_id')->where('payments.slug', '=', $slug);
			$products = '<table class="table">
									<thead>
										<tr>
											<th>'.getPhrase('Image').'</th>
											<th>'. getPhrase('Product Name').'</th>
											<th>'. getPhrase('Product Price').'</th>
										</tr>
									</thead>
									<tbody>';
			foreach( $paymentdetails->get() as $item ) {
				$products .= '<tr>
											<td class="table-image">
											';
											
											$product_image = DEFAULT_PRODUCT_IMAGE_THUMBNAIL;
											if( $item->item_image != '' && File::exists(UPLOAD_PATH_PRODUCTS_THUMBNAIL . $item->model->image ) ) {
												$product_image = UPLOAD_URL_PRODUCTS_THUMBNAIL . $item-item_image;
											}
				$products .= '
											<a href="'.URL_DISPLAY_PRODUCTS_DETAILS . $item->item_slug.'"><img src="'.$product_image.'" alt="product" class="img-responsive cart-image"></a></td>
											
											<td><a href="'.URL_DISPLAY_PRODUCTS_DETAILS . $item->item_slug .'">'. $item->item_name .'</a></td>
											
											<td class="colu2">'. currency( $item->cost ) .'</td>											

										</tr>';
			}
			$products .= '</tbody></table>';
			
			$name = $request->first_name;
			$email = $request->email;
			if( ! $name ) {
				$name = $request->first_name . ' ' . $request->last_name;
			}
			if( ! $email ) {
				$email = $request->email;;
			}
			$amount = $request->mc_gross;
			try{
			sendEmail($email_template, array('username'=>$name, 
			'cost' => $amount,
			'to_email' => $email,
			'products' => $products,)
			);
		   }
			catch(Exception $e){
           
           flash('Success','please_update_mail_settings','overlay');

		   }

			// Let us clear the cart
			Cart::destroy();
			$request->session()->forget('paymenttoken');
			if($request->session()->has('licence_id')){
			$request->session()->forget('licence_id');
		   }
		   if($request->session()->has('couponid')){
			$request->session()->forget('couponid');
		  }

		  if($request->session()->has('not_applicable_product_ids')){
			$request->session()->forget('not_applicable_product_ids');
		 }

		 if($request->session()->has('total_excluded_products')){
			$request->session()->forget('total_excluded_products');
		}
          

           if($request->session()->has('licence_price')){
			$request->session()->forget('licence_price');
		}

		if($request->session()->has('final_discount')){
			$request->session()->forget('final_discount');
		}
			if( $request->session()->has('discount_amount') ) {
				$request->session()->forget('discount_amount');
				$request->session()->forget('discount_details');
			}
			if( $user ) {
				if( checkRole(getUserGrade(6)) )
					return redirect(URL_USERS_DASHBOARD.'/purchases')->withSuccessMessage('Thank you for your purchase!');
				elseif( checkRole(getUserGrade(8)) )
					return redirect(URL_VENDOR_DASHBOARD.'/purchases')->withSuccessMessage('Thank you for your purchase!');
				elseif( checkRole(getUserGrade(3)) )
					return redirect( URL_DASHBOARD )->withSuccessMessage('Thank you for your purchase!');
			} else {
				$request->session()->put('purchaseconfirm', $request);
				return redirect( URL_CART_PURCHASECONFIRM )->withSuccessMessage( getPhrase('Thank you for your purchase!') );
			}
		}
        else {
      //PAYMENT RECORD IS NOT VALID
      //PREPARE METHOD FOR FAILED CASE
        pageNotFound();
      }     
      if( $user ) {
		  return redirect('user/mydownloads')->withSuccessMessage('Thank you for your purchase!');
	  } else {
		return redirect( URL_DISPLAY_PRODUCTS );
	  }
    }

     public function payu_cancel(Request $request)
    {
      // dd($request);
      if($this->paymentFailed())
      {
        //FAILED PAYMENT RECORD UPDATED SUCCESSFULLY
        //PREPARE SUCCESS MESSAGE
          flash('Ooops...!', 'your_payment_was cancelled', 'overlay');
      }
      else {
      //PAYMENT RECORD IS NOT VALID
      //PREPARE METHOD FOR FAILED CASE
        pageNotFound();
      }

      //REDIRECT THE USER BY LOADING A VIEW
      $user = Auth::user();
      return redirect(URL_PAYPAL_CANCEL_RETURN);
       
    }
	
	/**
     * Common method to handle payment failed records
     * @return [type] [description]
     */
    protected function paymentFailed()
    {
    	$params = explode('?token=',$_SERVER['REQUEST_URI']) ;
     if(!count($params))
      return FALSE;
    
       $slug = $params[1];
      //dd(Input::get());
    	$payment_record = Payment::where('slug', '=', $slug)->first();
     
     	if(!$this->processPaymentRecord($payment_record))
     	{ 
    		return FALSE;
     	}
		$payment_record->payment_status = PAYMENT_STATUS_CANCELLED;
		$payment_record->paid_amount = 0;
    	$payment_record->save();
    	
    	return TRUE;
    	 
    }
	
	/**
     * This method Process the payment record by validating through 
     * the payment status and the age of the record and returns boolen value
     * @param  Payment $payment_record [description]
     * @return [type]                  [description]
     */
    protected  function processPaymentRecord(Payment $payment_record)
    {
    	if(!$this->isValidPaymentRecord($payment_record))
    	{
    		flash('Oops','invalid_record', 'error');
    		return FALSE;
    	}

    	if($this->isExpired($payment_record))
    	{
    		flash('Oops','time_out', 'error');
    		return FALSE;
    	}

    	return TRUE;
    }
	
	/**
     * This method validates the payment record before update the payment status
     * @param  [type]  $payment_record [description]
     * @return boolean                 [description]
     */
    protected function isValidPaymentRecord(Payment $payment_record)
    {
    	$valid = FALSE;
    	if($payment_record)
    	{
    		if($payment_record->payment_status == PAYMENT_STATUS_PENDING || $payment_record->payment_gateway=='offline')
    			$valid = TRUE;
    	}
    	return $valid;
    }

     /**
     * This method checks the age of the payment record
     * If the age is > than MAX TIME SPECIFIED (30 MINS), it will update the record to aborted state
     * @param  payment $payment_record [description]
     * @return boolean                 [description]
     */
    protected function isExpired(Payment $payment_record)
    {

      $is_expired = FALSE;
      $to_time = strtotime(Carbon\Carbon::now());
    $from_time = strtotime($payment_record->updated_at);
    $difference_time = round(abs($to_time - $from_time) / 60,2);

    if($difference_time > PAYMENT_RECORD_MAXTIME)
    {
      $payment_record->payment_status = PAYMENT_STATUS_CANCELLED;
      $payment_record->save();
      return $is_expired =  TRUE;
    }
    return $is_expired;
    }
	
	public function paymentsuccess(Request $request)
	{  
		$params = explode('?token=',$_SERVER['REQUEST_URI']) ;
        
        if(session()->has('paymenttoken')){
        	$slug = session()->get('paymenttoken');
        }
         
         else{
         $slug = $params[1];
      }

		if(count($params))
		{			
			$data['layout']             = getLayout();
             
             $payment_details  = Payment::where('slug','=',$slug)->first();

			 $data['main_active'] 	= 'products';
			 $data['token'] = $slug;
			

             $payment_details->payment_status = PAYMENT_STATUS_SUCCESS;
             $payment_details->save(); 
             $data['title'] 	= getPhrase( 'payment_status : success' );
			
			
			$data['paymentdetails'] = Payment::select(['payments.*'])->join('payments_items as pi', 'payments.id', '=', 'pi.payment_id')->where('payments.slug', '=', $slug)->first();
			if (sizeof(Cart::content()) > 0) {
				$data['cart_details'] = Cart::content();
			}
			// Let us clear the cart
			Cart::destroy();
			$request->session()->forget('paymenttoken');
			if($request->session()->has('licence_id')){
			$request->session()->forget('licence_id');
		   }
		   if($request->session()->has('couponid')){
			$request->session()->forget('couponid');
		  }

		  if($request->session()->has('not_applicable_product_ids')){
			$request->session()->forget('not_applicable_product_ids');
		 }

		 if($request->session()->has('total_excluded_products')){
			$request->session()->forget('total_excluded_products');
		}
          

           if($request->session()->has('licence_price')){
			$request->session()->forget('licence_price');
		}

		 if($request->session()->has('final_discount')){
			$request->session()->forget('final_discount');
		}

			if( $request->session()->has('discount_amount') ) {
				$request->session()->forget('discount_amount');
				$request->session()->forget('discount_details');
				
			}			
			return view('cart.paymentsuccess', $data);
		}
		else
		{
			flash('Oops','wrong_operation', 'error');
			return redirect( URL_DISPLAY_PRODUCTS );
		}
	}
	
	public function applycoupon(Request $request)
	{ 

        $response = array();
		$details = App\Coupon::where('code', '=', $request->coupon)->where('status', '=', 1);
		if($details->count() > 0){

			$coupon_details = $details->first();
            
			if($coupon_details->max_users>0){

				  $max_used = Payment::where('coupon_id','=',$coupon_details->id);

				    if($max_used->count() >= $coupon_details->max_users){
				    	$response['status'] = 0;
					    $response['message'] = getPhrase('sorry!!  Maximum User Limit Reached');
                     	return json_encode($response);
				    }

			       if($coupon_details->user_once_per_customer==1){
             
                     $user_id = Auth::user()->id;
                      $coupon_used = $max_used->where('user_id','=',$user_id)->get();
                                                  
                     if(count($coupon_used)>0){

                     	$response['status'] = 0;
					    $response['message'] = getPhrase('sorry!! This Coupon Is Used Only Once, You Already Used This Coupon');
                     	return json_encode($response);

                     }                             

			   }
	       }
	   }  		 
		
		
		if( $details->count() > 0 )
		 {
			$start_date = $details->first()->start_date;
			$end_date = $details->first()->end_date;
			$details->whereRaw('"'.date('Y-m-d H:i:s') . '" BETWEEN start_date and end_date');
			if( $details->count() > 0)
			{
				$coupon_details = $details->first();
				$product_categories = $cart_product_ids = array();
				foreach (Cart::content() as $item) {
					$cats = ($item->model->categories != '') ? (array) json_decode($item->model->categories) : array();
					$cart_product_ids[] = $item->model->id;
					if( ! empty( $cats ) ) {
						foreach( $cats as $cat ) {
							$product_categories[] = $cat;
						}
					}
				}
				$coupon_categories = ($coupon_details->categories) ? (array) json_decode($coupon_details->categories) : array();
				if( count( array_intersect( $coupon_categories, $product_categories ) ) ) {
					$exclude_products = ($coupon_details->exclude_products) ? (array) json_decode($coupon_details->exclude_products) : array();
					
					
						// Success
						$minimum_amount = $coupon_details->minimum_amount;
						if( $request->final_amount >= $minimum_amount) {
                             $not_add  = 0;
                       if( count( array_intersect( $exclude_products, $cart_product_ids ) ) ) {

                       	 $products = array_intersect( $exclude_products, $cart_product_ids );

                       	 $total_excluded_products   =  count($products);

                       	   if(count(Cart::content()) == $total_excluded_products){
                       	   	         $response['status']  = 0;
									 $response['message'] = getPhrase('sorry!! this coupon is not applicable for this products');

									 return json_encode($response);
                       	   }

                       	 $request->session()->put('not_applicable_product_ids',$products);
                       	 $request->session()->put('total_excluded_products',$total_excluded_products);
                           
                           foreach (Cart::content() as $item) {

	                           	foreach ($products as $key => $value) {

	                           		if(count(Cart::content())==1 && $item->model->id == $value){
					                 $response['status'] = 0;
									 $response['message'] = getPhrase('sorry!! this coupon is not applicable for this product');

									 return json_encode($response);

	                           		}
	                           		
	                           		if($item->model->id == $value){

	                           			$tax_rate   = getSetting('tax_rate','cart_settings');
	                           			$tax_amount =  ($item->model->price * $tax_rate)/100;
                                        $amount     = $item->model->price + $tax_amount;
	                           			$not_add    += $amount;
	                           		}
                                   
                                }
                           }

					   }

					        $type     = $coupon_details->type;
							$value    = $coupon_details->value;
							$discount = 0;
							if( $type == 'percent' ) {

							$discount = ($request->final_amount * $value) / 100; // We are calculating discount on actual produt price.
                            $not_add_discount  = ($not_add * $value) / 100;// excluded products discount
                            $final_discount    =  $discount- $not_add_discount;
                            $request->session()->put('final_discount', $final_discount);
                          
                            $copon_max_amount  = $coupon_details->max_discount_amount;
                            $applicable_discount  = $final_discount;
                          if($copon_max_amount!=0){
                            if($final_discount <= $copon_max_amount){
                               
                               $applicable_discount  = $final_discount;
                    
							}

							else{
								$applicable_discount  = $copon_max_amount;
							}

						  }	 
						}	
							else {
								$applicable_amount     = $request->final_amount - $not_add;
                                $discount              = $value;
                                $applicable_discount   = $value;

                                //coupon value is gretar than cart coupon applicable amount
                                  if($applicable_discount >= $applicable_amount){
                                  	$applicable_discount   = $applicable_amount;
                                   }
							}
							$request->session()->put('discount_amount', $applicable_discount);
							$request->session()->put('discount_details', $coupon_details);
                             
                            $coupon_id =  $coupon_details->id;
                            $request->session()->put('couponid', $coupon_id);
							
							$response['status'] = 1;
							$response['discount_amount']  = $applicable_discount;
                             
                             if($type == 'percent'){
                             $response['final_price']   = ($request->final_amount - $discount)+($request->support_fee + $not_add_discount );
                              }
                             else{
                            $response['final_price']   = ($applicable_amount - $applicable_discount)+($request->support_fee + $not_add);
                             }



							$code = $coupon_details->code;
							$details_msg = '<div class="coupon-apply">
			<p class="coupon-data"><span class="fa fa-check"></span>'. getPhrase('Coupon Code') . $code . ' ' . currency( $applicable_discount ) . getPhrase(' applied') .'</p>
			<p class="coupon-data1">'. currency( $applicable_discount ) . getPhrase(' reduced from the cart') .'</p>
			<p><a href="'. URL_CART_REMOVECOUPON .'"><span class="fa fa-times"></span></a></p>
		</div>';
							$response['message'] = '<div class="alert alert-success">' . getPhrase('Wah!! coupon applied successfully') . '</div>' . $details_msg;

						} 
						else {
							$response['status'] = 0;
							$response['message'] = getPhrase('sorry!! you need to purchase at least ') . currency( $minimum_amount ) . getPhrase( ' to apply this coupon' );
						}						
					
				} 
				else {
					// Coupon is not in categories
					$response['status'] = 0;
					$response['message'] = getPhrase('sorry!! this coupon is not applicable for this category of products');
				}
			} 
			else {
				$response['status'] = 0;
				$response['message'] = getPhrase('sorry!! coupon code has expired');
			}
		} 
	 else {
			$response['status'] = 0;
			$response['message'] = getPhrase('sorry!! coupon_not_found');
		}
		return json_encode($response);
	}


	
	public function removecoupon()
	{
		if( session()->has('discount_amount') ) {
			session()->forget('discount_amount');
			session()->forget('discount_details');
		}
		return redirect( URL_CHECKOUT )->withSuccessMessage( getPhrase( 'coupon_has_been_removed_from_the_cart' ) );
	}

    /**
     * This Method is used to download the product files after payment
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
	public function download($slug ,$item_price='')
	{ 
        $user_name = Auth::user()->name;
        $check = Payment::select(['payments.*', 'payments_items.item_name', 'products.id as product_id', 'products.download_files','products.download_limits','products.product_url','products.price_variations','products.price_type'])
							->join('payments_items', 'payments_items.payment_id', '=', 'payments.id')
							->join('products', 'products.id', '=', 'payments_items.item_id')
							->where('user_id', '=', current_user_id())
							->where('payments.slug', '=', $slug)
							->first();
		if( $check && $check->download_files!='')
		{  

			if($check->product_url!=null){
           	flash('Hai '.$user_name,'Go To This Link'.' '.$check->product_url.' '.'To Download The Product','overlay');
            return back();
           }
           
           $downloaded = Payment_Items_Downloads::where('payment_id','=',$check->id)->count();
            if($downloaded >= $check->download_limits){
            	flash('Ooops','You Already Reached Downlod Limit Of This Product','overlay');
            	return back();
            }

			$files = json_decode( $check->download_files );
            if($files==null){
             flash('Ooops','No Files Available Related To This Product','overlay');
             return back();	
            }
		   
		   if($check->price_type=='default'){

			foreach( $files as $file ) {
               // dd($file);   
                  if($file->type=='url'){
                  	flash('overlay','Go To This Link'.' '.$file->name.' '.'To Download The Product','overlay');
                  	return back();
                  }
                 else{
				if($file->file_name!=''){

					
                 $download_count = new Payment_Items_Downloads();
                 $download_count->payment_id = $check->id;
                 $download_count->save(); 
                  


                $files_array = "public/uploads/products/downloads"."/".$file->file_name;
			    return Response::download($files_array);
		       }

		       else{
		            flash('Ooops','No File IS Uploaded For This Product','overlay');
		            return back();
		          }
		    }
		  }
		}

		else{

           $prices = (array)json_decode( $check->price_variations );
           
           $item_index = '';

           foreach ($prices as $key => $value) {
           	  
                 if($value->amount == (int)$item_price){
                 	$item_index = $value->index;
                 }


           }
            $fileName = '';

           foreach ($files as $file) {
           	  
           	  if($file->index == $item_index){
                 
                 if($file->type=='url'){
                  	flash('overlay','Go To This Link'.' '.$file->name.' '.'To Download The Product','overlay');
                  	return back();
                  }

           	  	$fileName = $file->file_name;
           	   }

           }

           if($fileName!=''){

					
                 $download_count = new Payment_Items_Downloads();
                 $download_count->payment_id = $check->id;
                 $download_count->save(); 
                  
// dd($fileName);

                $files_array = "public/uploads/products/downloads"."/".$fileName;
                // dd($files_array);
			    return Response::download($files_array);
		       }

		       else{
		            flash('Ooops','No File IS Uploaded For This Product','overlay');
		            return back();
		          }

		 }
			
		}
		else
		{
			flash('Ooops','Something Went Wrong.Please Contact Administrator', 'overlay');
			return back();
		}
	}


	/**
   This Method return the products based on search term in the home page
   **/
	public function getProductsOnSearch(Request $request)
	{
		$text       = $request->search_text;
		$products   = Product::where('slug','like', $text.'%')->orderBy('created_at', 'desc')->get();
		return $products;
	}
}

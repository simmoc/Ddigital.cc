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
use App\FreeBies;
use App\Payment_Items_Downloads;
// use App\GeneralSettings;
use Yajra\Datatables\Datatables;
use DB;
use Illuminate\Support\Facades\Hash;
use Excel;
use Input;
use File;
use Exception;
use Auth;
use Image;

class PaymentsController extends Controller
{ 

    public $payment_records = [];
      public function __construct()
    {
       $this->middleware('auth');
    }


    public function paymentsDashboard()
    {
      
      $data['main_active']        = 'reports';
      $data['sub_active']         = 'all';
      $data['title']              = getPhrase('payments_dashboard');
      $data['layout']             = getLayout();
      return view('payments.dashboard', $data);  
    }



	 /**
     * This method redirects the user to view the onlinepayments reports dashboard
     * It contains an optional slug, if slug is null it will redirect the user to dashboard
     * If the slug is success/failed/cancelled/all it will show the appropriate result based on slug status from payments table
     * @param  string $slug [description]
     * @return [type]       [description]
     */
    public function onlinePaymentsReport()
    {

      if( $this->isModuleEligible('Payments_Report') != '' )
	{
		return redirect( $this->isModuleEligible('Payments_Report') );
	}


      $data['main_active']        = 'reports';
      $data['sub_active']         = 'online_reports';
      $data['title']              = getPhrase('online_payments');
      $data['payments']           = (object)$this->prepareSummaryRecord('online');
      // $data['payments_chart_data']= (object)$this->getPaymentStats($data['payments']);
      // $data['payments_monthly_data'] = (object)$this->getPaymentMonthlyStats();
      $data['payment_mode']        = 'online';
      $data['layout']              = getLayout();
      return view('payments.reports.payment-report', $data);  
    }


    /**
     * This method list the details of the records
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function listOnlinePaymentsReport($slug)
    {
      if( $this->isModuleEligible('Payments_Report') != '' )
	{
		return redirect( $this->isModuleEligible('Payments_Report') );
	}
      if(!in_array($slug, ['all','pending', 'success','cancelled']))
      {
        pageNotFound();
        return back();
      }

      $payment = new Payment();
       $this->updatePaymentTransactionRecords($payment->updateTransactionRecords('online'));

         $data['main_active']        = 'reports';
      $data['sub_active']            = 'online_reports';
        $data['payments_mode']      = getPhrase('online_payments');
        if($slug=='all'){
           $data['title']              = getPhrase('all_payments');
       
        }
        elseif($slug=='success'){
        $data['title']              = getPhrase('success_list');
          }
        elseif($slug=='pending'){
        $data['title']              = getPhrase('pending_list');
          }
       elseif($slug='cancelled'){
           $data['title']              = getPhrase('cancelled_list');
         }
        $data['layout']             = getLayout();
        $data['ajax_url']           = URL_ONLINE_PAYMENT_REPORT_DETAILS_AJAX.$slug;
        $data['payment_mode']       = 'online';
        return view('payments.reports.payments-report-list', $data);   
    }


     public function updatePaymentTransactionRecords($records)
    {

      foreach($records as $record)
      {
        $rec = Payment::where('id',$record->id)->first();
        $this->isExpired($rec);
      }
    }

     public function getOnlinePaymentReportsDatatable($slug)
    {

      if( $this->isModuleEligible('Payments_Report') != '' )
	{
		return redirect( $this->isModuleEligible('Payments_Report') );
	}
    
     $records = Payment::join('users', 'users.id','=','payments.user_id')
        ->select(['users.image', 'users.name',  'paid_amount','payment_gateway','payments.updated_at','payment_status','other_details','payments.id','cart_total','licence_price','discount_amount'])
     ->where('payment_gateway', '!=', 'offline-payment')
     ->orderby('updated_at', 'desc');
     if($slug!='all')
      $records->where('payment_status', '=', $slug);
      return Datatables::of($records)
      
        ->editColumn('payment_status',function($records){

          $rec = '';
          if($records->payment_status==PAYMENT_STATUS_CANCELLED)
           $rec = '<span class="label label-danger">'.ucfirst($records->payment_status).'</span>';
          elseif($records->payment_status==PAYMENT_STATUS_PENDING)
            $rec = '<span class="label label-info">'.ucfirst($records->payment_status).'</span>';
          elseif($records->payment_status==PAYMENT_STATUS_SUCCESS)
            $rec = '<span class="label label-success">'.ucfirst($records->payment_status).'</span>';
          return $rec;
        })
        ->editColumn('image', function($records) {
           return '<img src="'.getProfilePath($records->image).'"  /> '; 
        })
        ->editColumn('name', function($records)
        {
          return ucfirst($records->name);
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
          $extra .='<li><p>Cost : '.$total_cost.'</p><p>Aftr Dis. : '.$records->discount_amount.'</p><p>Paid :'.$records->paid_amount.'</p></li></ul>';
          return $extra;
        }
          return $text;
        })
        ->removeColumn('id')
        ->removeColumn('cart_total')
        ->removeColumn('licence_price')
        ->removeColumn('discount_amount')
        ->make();     
    }

     /**
     * This method redirects the user to view the onlinepayments reports dashboard
     * It contains an optional slug, if slug is null it will redirect the user to dashboard
     * If the slug is success/failed/cancelled/all it will show the appropriate result based on slug status from payments table
     * @param  string $slug [description]
     * @return [type]       [description]
     */
    public function offlinePaymentsReport()
    {
      if( $this->isModuleEligible('Payments_Report') != '' )
	{
		return redirect( $this->isModuleEligible('Payments_Report') );
	}

      $data['main_active']        = 'reports';
      $data['sub_active']         = 'offline_reports';
      $data['title']              = getPhrase('offline_payments');
      $data['payments']           = (object)$this->prepareSummaryRecord('offline');
      // $data['payments_chart_data'] = (object)$this->getPaymentStats($data['payments']);
      // $data['payments_monthly_data'] = (object)$this->getPaymentMonthlyStats('offline', '=');
      $data['payment_mode']       = 'offline';
      $data['layout']             = getLayout();
       return view('payments.reports.payment-report', $data);  
    }


     /**
     * This method list the details of the records
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function listOfflinePaymentsReport($slug)
    {
      if( $this->isModuleEligible('Payments_Report') != '' )
	{
		return redirect( $this->isModuleEligible('Payments_Report') );
	}


         $data['main_active']        = 'reports';
         $data['sub_active']         = 'offline_reports';
        $data['payments_mode']      = getPhrase('offline_payments');
         if($slug=='all'){
           $data['title']              = getPhrase('all_payments');
       
        }
        elseif($slug=='success'){
        $data['title']              = getPhrase('success_list');
          }
        elseif($slug=='pending'){
        $data['title']              = getPhrase('pending_list');
          }
       elseif($slug='cancelled'){
           $data['title']              = getPhrase('cancelled_list');
         }   
        $data['layout']             = getLayout();
        $data['ajax_url']           = URL_OFFLINE_PAYMENT_REPORT_DETAILS_AJAX.$slug;
        $data['payment_mode']       = 'offline';

        return view('payments.reports.payments-report-list', $data);   
    }

    /**
     * This method gets the list of records 
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function getOfflinePaymentReportsDatatable($slug)
    {
      if( $this->isModuleEligible('Payments_Report') != '' )
	{
		return redirect( $this->isModuleEligible('Payments_Report') );
	}
    
    $records = Payment::join('users', 'users.id','=','payments.user_id')
     ->select(['users.image', 'users.name', 'paid_amount','payment_gateway','payments.updated_at','payment_status','other_details','payments.id','cart_total','licence_price','discount_amount'])
     ->where('payment_gateway', '=', 'offline-payment')
     ->orderby('updated_at', 'desc');
     if($slug!='all')
      $records->where('payment_status', '=', $slug);
      return Datatables::of($records)
      
        ->editColumn('payment_status',function($records){

          $rec = '';
          if($records->payment_status==PAYMENT_STATUS_CANCELLED)
           $rec = '<span class="label label-danger">'.ucfirst($records->payment_status).'</span>';
          elseif($records->payment_status==PAYMENT_STATUS_PENDING) {
            $rec = '<span class="label label-info">'.ucfirst($records->payment_status).'</span>&nbsp;<button class="btn btn-primary btn-sm" onclick="viewDetails('.$records->id.');">'.getPhrase('view_details').'</button>';
          }
          elseif($records->payment_status==PAYMENT_STATUS_SUCCESS)
            $rec = '<span class="label label-success">'.ucfirst($records->payment_status).'</span>';
          return $rec;
        })
        ->editColumn('image', function($records){
           return '<img src="'.getProfilePath($records->image).'"  /> '; 
        })
        ->editColumn('name', function($records)
        {
          return ucfirst($records->name);
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
          $extra .='<li><p>Cost : '.$total_cost.'</p><p>Discount : '.$records->discount_amount.'</p><p>Paid :'.$records->paid_amount.'</p></li></ul>';
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
     * This method displays the form for export payments list with different combinations
     * @return [type] [description]
     */
    public function exportPayments()
    {
      if( $this->isModuleEligible('Payments_Report', array('Export')) != '' )
	{
		return redirect( $this->isModuleEligible('Payments_Report', array('Export')) );
	}
        $data['main_active']        = 'reports';
        $data['sub_active']         = 'export';
        $data['title']              = getPhrase('export_payments_report');
        $data['layout']             = getLayout();
        $data['record']             = FALSE;

        return view('payments.reports.payments-export', $data);        
    }

    public function doExportPayments(Request $request)
    { 

      
      if( $this->isModuleEligible('Payments_Report', array('Export')) != '' )
	{
		return redirect( $this->isModuleEligible('Payments_Report', array('Export')) );
	}
        $columns = array(
        'all_records'  => 'bail|required'
        );

       
        $this->validate($request,$columns);

        $payment_status = $request->payment_status;
        $payment_type = $request->payment_type;
        $record_type  = $request->all_records;
        $from_date = '';
        $to_date = '';
        
       
        $records = [];
        $query = '';
        
        if($payment_status=='all' && $payment_type=='all' && $record_type=='1')
        {

          $query =  Payment::join('payments_items','payments_items.payment_id','=','payments.id')
                              ->whereRaw("1 = 1");
        }
        else {
        
           

            $query =  Payment::join('payments_items','payments_items.payment_id','=','payments.id')
                              ->whereRaw("1 = 1");            
            
            if($payment_type!='all')
            {

              if($payment_type=='online') {
              $query->where('payment_gateway','!=','offline-payment');
            }
            else {
              $query->where('payment_gateway','=','offline-payment');
            }


            }

            if($payment_status!='all')
            {
              $query->where('payment_status', '=', $payment_status);
            }
 
          
        }
        $records = $query->get();
        $this->payment_records = $records;

     $this->downloadPaymentExcel();
       
    }

public function getPaymentRecords()
{
  return $this->payment_records;
}
    public function downloadPaymentExcel()
   {
  if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }
    Excel::create('payments_report', function($excel) {
      $excel->sheet('payments_records', function($sheet) {
      $sheet->row(1, array('sno','ItemID', 'Purchased Item Name','User ID','Payment Gateway', 'TransactionID','Paid UserID', 'Cost','Cart Total','Item Cost','Tax','licence_price', 'Discount Amount', 'Paid Amount', 'Payment status', 'created_datetime','updated_datetime'));
      $records = $this->getPaymentRecords();
      $cnt = 2;
      foreach ($records as $item) {
         $sheet->appendRow($cnt, array(($cnt-1), $item->item_id, $item->item_name, $item->user_id, $item->payment_gateway, $item->transaction_id, $item->paid_by, $item->cost,$item->cart_total,$item->item_price,$item->tax,$item->licence_price, $item->discount_amount, $item->paid_amount, $item->payment_status, $item->created_at, $item->updated_at));
        $cnt++;
      }
    });
 

    })->download('xlsx');
}


    public function getPaymentRecord(Request $request)
        {
         
        if(!checkRole(getUserGrade(2)))
            {
              prepareBlockUserMessage();
              return back();
            }
        $payment_record = Payment::where('id','=',$request->record_id)->first();

     $date_format = getSetting('date_format', 'site_settings');
		   $html = '<div class="row">
           <div class="col-md-8 col-md-offset-2">
               <p><strong>'.getPhrase('name').'</strong> : '.$payment_record->customer_first_name.' ' . $payment_record->customer_last_name . '</p>
               <p><strong>'.getPhrase('cost').'</strong> :  '.currency( $payment_record->cost ).'</p>';
			   if( $payment_record->licence_price != '0' ) {
			   $html .= '
			   <p><strong>'.getPhrase('licence_price').'</strong> :  '.currency( $payment_record->licence_price ).'</p>';
			   }
			   
			   if( $payment_record->tax != '0' ) {
			   $html .= '
			   <p><strong>'.getPhrase('tax').'</strong> :  '.currency( $payment_record->tax ).'</p>';
			   }
			   
			   if( $payment_record->discount_amount != '0' ) {
               $html .= '<p><strong>'.getPhrase('discount').'</strong> : '.currency( $payment_record->discount_amount ).'</p>';
			   }
               
               $html .= '<p><strong>'.getPhrase('notes').'</strong> :  '.$payment_record->payment_details.'</p>
               <p><strong>'.getPhrase('created_at').'</strong> : '.$payment_record->created_at.'</p>
               <p><strong>'.getPhrase('updated_at').'</strong> : '.$payment_record->updated_at.'</p>
               <p><strong>'.getPhrase('comments').'</strong> : <textarea class="form-control" name="admin_comment"></textarea></p>
               <input type="hidden" name="record_id" value="'.$payment_record->id.'">
               <input type="hidden" name="user_id" value="'.$payment_record->user_id.'">
           </div>
        </div>';
        return $html;

     
      }


       /**
        * This Method return html view of a payment product details
        * @param  Request $request [description]
        * @return [type]           [description]
        */
       public function getPaymentProductDetalis(Request $request)
        {
         
        $product_details = Payment_Items::join('payments','payments.id','=','payments_items.payment_id')
                                        ->where('payments_items.payment_id','=',$request->record_id)->get();
         
      $total = count($product_details);   
	   
	   $content='<div class="row">
	   <div class="col-md-8 col-md-offset-2">';
           $content .= '<p><strong>'.getPhrase('total_products').'</strong> : '. $total . '</p>';

       foreach($product_details as $data)
	   { 
			$content .= '<p>'.getPhrase('product_name').' '.':'.' '.'<strong>'. $data->item_name.'</strong>'. '</p>';
       
       $product = Product::where('id','=',$data->item_id)->first();
       $user_details  = User::where('id','=',$product->user_created)->first();    
      
      $content .= '<p>'.getPhrase('product_owner').' '.':'.' '.'<strong>'. $user_details->name.'</strong>'. '</p>';
      $content .= '<p>'.getPhrase('product_cost').' '.':'.' '.'<strong>'. currency($data->total_cost).'</strong>'. '</p>';
      $temp = '';
      if($data->coupon_applied==1){
      $temp = '<p>'.getPhrase('coupon_applied').' '.':'.' '.'<strong>'.getPhrase('yes').'</strong>'. '</p>';
       $coupon_name = Coupon::where('id','=',$data->coupon_id)->first()->title;
      $temp .= '<p>'.getPhrase('coupon_name').' '.':'.' '.'<strong>'. $coupon_name.'</strong>'. '</p>';
      $temp .= '<p>'.getPhrase('discount').' '.':'.' '.'<strong>'. currency($data->discount_amount).'</strong>'. '</p>';
      }
      
      $temp1 = '';
      if($data->licence_applied==1){
      $temp1 = '<p>'.getPhrase('licence_applied').' '.':'.' '.'<strong>'. getPhrase('yes').'</strong>'. '</p>';
       $licence_name = Licence::where('id','=',$data->licence_id)->first()->title;
      $temp1 .= '<p>'.getPhrase('licence_name').' '.':'.' '.'<strong>'. $licence_name.'</strong>'. '</p>';
      $temp1 .= '<p>'.getPhrase('licence_fee').' '.':'.' '.'<strong>'. currency($data->licence_fee).'</strong>'. '</p>';
      }
      else{
         $temp1 .= '<p>'.getPhrase('licence').' '.':'.' '.'<strong>'. getPhrase('regular').'</strong>'. '</p>'; 
      }
      $content .=$temp; 
      $content .=$temp1; 
      $content .= '<p>'.getPhrase('paid_amont').' '.':'.' '.'<strong>'. currency($data->final_amount).'</strong>'. '</p>';
      
      $temp2 = '';
      if($data->payment_status=='success'){
       $temp2  = '<p><a href="'.URL_CART_DOWNLOAD.$data->slug.'/'.$data->item_price.'"><span class="fa fa-download fa-2x"></span></a><strong>'.getPhrase('download').'</strong></p>';
       }

       else{
        $temp2  = '-';
       } 
      
      $content .= $temp2;
      $content .=' ------------------------------------------------';
          
       }
	   $content .= '</div></div>';
	   
	   
        return $content;

     
      }
 
    /**
     * This method prepares different variations of reports based on the type
     * This is a common method to prepare online, offline and overall reports
     * @param  string $type [description]
     * @return [type]       [description]
     */
    public function prepareSummaryRecord($type='overall')
    {

      $payments = [];
      if($type=='online') {
        $payments['all'] = $this->getRecordsCount('online');

        $payments['success'] = $this->getRecordsCount('online', 'success');
        $payments['cancelled'] = $this->getRecordsCount('online', 'cancelled');
        $payments['pending'] = $this->getRecordsCount('online', 'pending');
      }
      else if($type=='offline') {
        $payments['all'] = $this->getRecordsCount('offline');

        $payments['success'] = $this->getRecordsCount('offline', 'success');
        $payments['cancelled'] = $this->getRecordsCount('offline', 'cancelled');
        $payments['pending'] = $this->getRecordsCount('offline', 'pending');
      }

      return $payments;
    }

     /**
     * This is a helper method for fetching the data and preparing payment records count
     * @param  [type] $type   [description]
     * @param  string $status [description]
     * @return [type]         [description]
     */
    public function getRecordsCount($type, $status='')
    {
      $count = 0;
      if($type=='online') {
        if($status=='')
          $count = Payment::where('payment_gateway', '!=', 'offline-payment')->count();

        else
        {
          $count = Payment::where('payment_gateway', '!=', 'offline-payment')
                            ->where('payment_status', '=', $status)
                            ->count();
        }
      }      
      else if($type=='offline')
      {
         if($status=='')
          $count = Payment::where('payment_gateway', '=', 'offline-payment')->count();

        else
        {
          $count = Payment::where('payment_gateway', '=', 'offline-payment')
                            ->where('payment_status', '=', $status)
                            ->count();
        } 
      }


      return $count;
    }

    /**
     * This method is used to approve or reject the request
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function approveOfflinePayment(Request $request)
    {
       
      $payment_record = Payment::where('id','=',$request->record_id)->first();

      try{
      if($request->submit == 'approve')
      {
        $this->approvePayment($payment_record, $request);
      }
      else {
         
         $payment_record->payment_status = PAYMENT_STATUS_CANCELLED;

         if($request->admin_comment){
         $payment_record->admin_comments = $request->admin_comment;
          }
        
         $payment_record->save();

        $user = getUserRecord($payment_record->user_id);
        try{
        sendEmail('offline_subscription_failed', array('username'=>$user->name, 
          'to_email' => $user->email, 'admin_comment'=>$request->admin_comment));
        }
        catch(Exception $e){
            
            flash('Success','please_update_your_email_settings','overlay');
         }
       }
       

      flash('Success', 'Record Was Updated Successfully', 'success');
    }
    catch(Exception $ex){

      $message = $ex->getMessage();
      flash('Oops..!', $message, 'overlay');
    }
      return redirect(URL_OFFLINE_PAYMENT_REPORTS);
    }


    public function approvePayment(Payment $payment_record,Request $request)
    {
       $paid_amount = $payment_record->cost;
     
        $payment_record->admin_comments = $request->admin_comment;

        $payment_record->paid_amount = $paid_amount;

        $payment_record->payment_status = PAYMENT_STATUS_SUCCESS;
        
        $user = getUserRecord($payment_record->user_id);

        $email_template = 'offline_subscription_success';

       try{
          sendEmail($email_template, array('username'=>$user->name, 
          'to_email' => $user->email, 'admin_comment'=>$request->admin_comment));
        }
        catch(Exception $e){
            
            flash('Success','please_update_your_email_settings','overlay');
     }
        

         $payment_record->save();

        

        return TRUE;
    
    }


    /**
     * This Method is view the free bies product download details
     * @return [type] [description]
     */
    public function freeBiesReport()
    {

    
        $data['layout']       = getLayout();
        $data['main_active']  = 'reports';
        $data['sub_active']     = 'free_bies';
        $data['title']          = getPhrase('free_bies_download_list');
        $data['active_title']   = getPhrase('dashboard');

        return view('payments.reports.free-bies', $data);
      


    }
    /**
     * This Method get the data of free bies product download details
     * @return [type] [description]
     */
    public function freeBiesReportList()
    {
      $records  = array();
    DB::statement(DB::raw('set @rownum=0'));
     $records = FreeBies::select([DB::raw('@rownum  := @rownum  + 1 AS rownum'),'user_name','user_email','product_id','id'])->get();

     $table = Datatables::of($records);
     $table->editColumn('product_id', function($records) {
      $product_details  = Product::where('id','=',$records->product_id)->first();
      return  $product_details->name;  
      });

     $table->editColumn('id', function($records) {
      $product_details  = Product::where('id','=',$records->product_id)->first();
      $user_details  = User::where('id','=',$product_details->user_created)->first();
      return $user_details->name;  
      });
    
    
     return $table->make();

      
    }

   
    public function allPayments()
    {


      $data['main_active']        = 'reports';
      $data['sub_active']         = 'all';
      $data['title']              = getPhrase('all_payments');
      $data['layout']              = getLayout();
      return view('payments.all', $data);  
      
    }


    public function allPaymentsList()
    {
      
     $records = array(); 
    
    $records = Payment::join('payments_items','payments_items.payment_id','=','payments.id')
                     ->select(['payments.id','payments_items.item_id','payments_items.total_cost','payments_items.item_slug','payments_items.coupon_id','payments_items.discount_amount','payments_items.licence_id','payments_items.licence_fee','payments_items.final_amount','payments.payment_gateway','payments.updated_at','payments.customer_email'])
                     ->where('payments.payment_status','=','success')
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


    ->editColumn('item_slug', function($records) {
       
       $record = Product::where('id','=',$records->item_id)->first()->user_created;      
       
       $owner_name   = User::where('id','=',$record)->first()->name;

       return $owner_name; 


    })

   
    ->removeColumn('id')
    ->removeColumn('customer_last_name')
    ->make();

    }


}
?>
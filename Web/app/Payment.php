<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use \App;

class Payment extends Model
{
	protected $table = 'payments';
   

    public static function getRecordWithSlug($slug)
    {
        return Payment::where('slug', '=', $slug)->first();
    }

    public function updateTransactionRecords($records_type)
    {
        $records = \DB::table('payments')
        // ->where('created_at', '>=', \Carbon\Carbon::now()->subHour())
        ->where('updated_at', '>', 'DATE_SUB(NOW(),INTERVAL -1 HOUR)')
        ->where('payment_status', '=', PAYMENT_STATUS_PENDING);
        
        if($records_type=='online')
        {
            $records->where('payment_gateway','!=','offline');
        }
        else if($records_type=='offline')
        {
            $records->where('payment_gateway','=','offline');   
        }
        else {
            $records->where('user_id','=',$records_type);      
        }
        
        return $records->get();
    }

 
    /**
     * This method returns the overall success, pending and failed records as summary
     * @return [type] [description]
     */
    public function getSuccessFailedCount()
    {
        $data = [];
        $data['success_count']      = Payment::where('payment_status','=','success')->count();
        $data['cancelled_count']    = Payment::where('payment_status','=','cancelled')->count();
        $data['pending_count']      = Payment::where('payment_status','=','pending')->count();
        return $data;
    }

    /**
     * This method gets the overall reports of the payments group by monthly
     * @param  string $year           [description]
     * @param  string $gateway        [description]
     * @param  string $payment_status [description]
     * @return [type]                 [description]
     */
    public function getSuccessMonthlyData($year='', $gateway='',$symbol='=' ,$payment_status='success')
    {
        if($year=='')
            $year = date('Y');

        $query = 'select sum(paid_amount) as total, sum(cost) as cost, MONTHNAME(created_at) as month from payments  where YEAR(created_at) = '.$year.' and payment_status = "'.$payment_status.'" group by YEAR(created_at), MONTH(created_at)';
        if($gateway!='')
        {
            $query = 'select sum(paid_amount) as total, MONTHNAME(created_at) as month from payments  where YEAR(created_at) = '.$year.' and payment_status = "'.$payment_status.'" and payment_gateway '.$symbol.' "'.$gateway.'" group by YEAR(created_at), MONTH(created_at)';
        }

        $result = DB::select($query);
        // dd($result);
        return $result;
    }

    /**
     * This method gets the latest payment records based on the sent parameters
     * @param  string  $type  [description]
     * @param  integer $limit [description]
     * @return [type]         [description]
     */
    public static function latestPayments($type='online', $limit=5)
    {
        $payments = Payment::
                        join('users','users.id','=', 'payments.user_id');
                
                if($type=='online') {
                  $payments = $payments->where('payment_gateway','!=', 'offline');
                }
                else if($type=='offline') {
                  $payments = $payments->where('payment_gateway','=', 'offline');
                }


             $payments = $payments->orderBy('payments.created_at','desc')
                        ->limit($limit)
                        ->select(['users.name','payments.slug as payment_slug', 'users.slug as user_slug', 'item_name',
                            'plan_type', 'payment_gateway', 'cost', 'paid_amount', 'payment_status'])
                        ->get();
         return $payments;

    }

    
}

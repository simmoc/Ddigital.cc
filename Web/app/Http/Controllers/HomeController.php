<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use Charts;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$user = getUserRecord();		
		if( $user->confirmed == 0 )
		{
			flash('Ooops...!', 'Please confirm your account to login', 'error');
			return view('common.logout');
		}
		if( $user->role_id == USER_ROLE_ID ) {
			return redirect( URL_USERS_DASHBOARD );
		} elseif( $user->role_id == VENDOR_ROLE_ID ) {
			return redirect( URL_VENDOR_DASHBOARD );
		}
         
        $roles = App\Role::get()->pluck('id');

             $dataset = [];
             $labels = [];
             $bgcolor = [];
             $border_color = [];
             foreach($roles as $key => $value)
             {
                $color_number = rand(0,999);
                $labels[] = ucfirst(getRoleData($value));
                $dataset[] = App\User::where('role_id', '=', $value)->get()->count();
                $bgcolor[] = getColor('',$color_number);
                $border_color[] = getColor('background',$color_number);
             }

            
            $dataset_label[] = 'lbl';
           
            $chart_data['type'] = 'pie'; 
            //horizontalBar, bar, polarArea, line, doughnut, pie
            // $chart_data['title'] = getphrase('overall_users');  

            $chart_data['data']   = (object) array(
                    'labels'            => $labels,
                    'dataset'           => $dataset,
                    'dataset_label'     => $dataset_label,
                    'bgcolor'           => $bgcolor,
                    'border_color'      => $border_color
                    );
                
           $data['chart_data'][] = (object)$chart_data;
           $data['chart_heading']         = getPhrase('user_statistics');
            $data['ids'] = array('myChart0'); 

		$data['layout']          = getLayout();
		$data['main_active']    = 'dashboard';
		$data['sub_active']     = 'dashboard';
		$data['title']          = 'Dashboard';
        return view('admin.dashboard', $data);
    }
}

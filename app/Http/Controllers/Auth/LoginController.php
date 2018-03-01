<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use \Auth;
use App\User;
use \Cart as Cart;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;
	use AuthenticatesUsers {
		logout as performLogout;
	}

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);		
    }
	/*
	public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
	*/
	
	public function logout(Request $request)
	{
		$user = getUserRecord();		
		$this->performLogout($request);		
		if( $user->confirmed == 0 )
		{
			flash('Ooops...!', 'please_confirm_your_account_to_login', 'error');
		} else {
			flash('success', getPhrase('Hope you enjoyed the shopping with us. Visit again.'), 'success');
		}
		return redirect(URL_USERS_LOGIN);
	}
	
	public function confirm($confirmation_code)
	{
		$record = User::where('confirmation_code', $confirmation_code)->first();
		if($isValid = $this->isValidRecord($record))
		return redirect($isValid);

		$record->confirmed = 1;
		$record->confirmation_code = null;
		$record->status = 'Active';
		$record->save();
		flash('Success', getPhrase("You have successfully activated your account. Please login here."), 'success');
		return redirect(URL_USERS_LOGIN);
	}
	
	public function isValidRecord($record)
	{
	  if ($record === null) {
			flash('Ooops...!', getPhrase("code not valid"), 'error');
			return $this->getRedirectUrl();
		}
	}
	
	public function performLogin(Request $request)
	{		$login_status = FALSE;
		$rememberme = FALSE;
		if( $request->has('rememberme') )
			$rememberme = TRUE;
		if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'confirmed' => 1, 'status' => 'Active'], $rememberme)) {
			$login_status = TRUE;
		}
		if (Auth::attempt(['email' => $request->email, 'forgot_token' => $request->password, 'confirmed' => 1, 'status' => 'Active'], $rememberme)) {
			$login_status = TRUE;
		}
		if(!$login_status) 
        {
               $record = User::where('email', '=', $request->email)->first();
			   $message = getPhrase("We have not found email address entered");
			   if( $record )
			   {
				   if( $record->confirmed == 0 )
				   {
					   $message = getPhrase('Please check your email to activate your acount');
				   }
				   elseif($record->status == 'Suspended' )
				   {
					   $message = getPhrase('We are sorry!. Your account has beed suspended. Please contact administrator');
				   }
				   else
				   {
					   $message = getPhrase('Please check email address OR password either one is wrong');
				   }
			   }
			   
			   flash('Ooops...!', $message, 'error');
			   return redirect()->back();
        }
		
		if($login_status)
        {
			$user = getUserRecord();
			if( in_array($user->role_id, array( OWNER_ROLE_ID, ADMIN_ROLE_ID, EXECUTIVE_ROLE_ID )) )
			{
				return redirect($this->redirectTo);
			}
			elseif( $user->role_id == USER_ROLE_ID )
			{
				if (sizeof(Cart::content()) > 0) {
					return redirect( URL_CHECKOUT );
				} else {
					return redirect( URL_USERS_DASHBOARD );
				}
			}
			else
			{
				return redirect($this->redirectTo);
			}
			
		}
	}
	
	public function forgotpassword()
	{
		return view('auth.passwords.email');
	}
	
	public function forgotpasswordEmail( Request $request )
	{
		$details = User::where('email', '=', $request->email)->first();
		if( $details )
		{
			if( $details->status == 'Suspended' )
			{
				flash('Ooops...!', 'Admin has suspended your account. Please contact administrator', 'error');
			}
			else
			{
				$forgot_token = str_random(30);
				$details->forgot_token = $forgot_token;
				$random_password = str_random(10);
				//$details->password = bcrypt( str_random(30) );
				$details->save();
				$login_link = URL_USERS_LOGIN;
				$changepassword_link = URL_USERS_RESETPASSWORD . '/' . $forgot_token;
				$site_title = getSetting('site_title', 'site_settings');
				try{
					sendEmail('forgotpassword', array('user_name'=>$details->name, 'to_email' => $details->email, 'password' => $random_password, 'login_link' => $login_link, 'changepassword_link' =>  $changepassword_link, 'site_title' => $site_title));
					flash('Success...!', 'Reset Password Sent To Your Mail', 'success');
				}
				catch(Exception $ex)
				{
					flash('Ooops...!', 'There was an error : ' . $ex->getMessage(), 'error');
				}
			}			
			return redirect( URL_USERS_LOGIN );
		}
		else
		{
			flash('Ooops...!', 'We have not found your email address', 'error');
			return redirect( URL_USERS_FORGOTPASSWORD );
		}
	}
	
	public function resetpassword( $forgot_token )
	{
		$details = User::where('forgot_token', '=', $forgot_token)->first();
		if( $details )
		{
			$data['token'] = $forgot_token;
			$data['main_active'] 	= 'register';
			return view('auth.passwords.reset', $data);
		}
		else
		{
			flash('Ooops...!', 'link is not valid. please check your email for details', 'error');
			return redirect( URL_USERS_FORGOTPASSWORD );
		}
	}
	
	public function resetmypassword(Request $request)
	{
		$this->validate($request, [
        'password'  => 'required|min:6|confirmed',
		'password_confirmation'  => 'required|min:6',
        ]);
		$details = User::where('forgot_token', '=', $request->token)->first();
		if( $details )
		{
			$details->password = bcrypt($request->password);
			$details->forgot_token = null;
			$details->confirmed = 1;
			$details->confirmation_code = null;
			$details->status = 'Active';
			$details->save();
			flash('Congrulations...!', 'You have successfully reset your password. Please login here.', 'success');
			return redirect( URL_USERS_LOGIN);
		}
		else
		{
			flash('Ooops...!', 'link_is_not_valid. please_check_your_email_for_details', 'error');
			return redirect( URL_USERS_FORGOTPASSWORD );
		}
	}
}

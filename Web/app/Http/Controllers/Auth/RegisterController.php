<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:256',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
			'password_confirmation' => 'required|min:6',
        ]);
    }
	
	public function getRegister( $role = 'user' )
	{
		if( ! in_array( $role, array('user', 'vendor') ) ) {
			flash('Ooops...!', getPhrase("some thing wrong"), 'error');
			return redirect( URL_USERS_REGISTER );
		}
		$data['main_active'] 	= 'register';
		$data['role'] = $role;
		return view('auth.register', $data);
	}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
		$name = $data['first_name'] . ' ' . $data['last_name'];
		$user    = new User();
		$user->name     = $name;
        $user->first_name     = $data['first_name'];
        $user->last_name    = $data['last_name'];
		$user->email     = $data['email'];
        $user->password = bcrypt($data['password']);
        if( $data['role'] == 'vendor' ) {
			$user->role_id  = VENDOR_ROLE_ID;
		} else {
			$user->role_id  = USER_ROLE_ID;
		}
        $user->slug     = $user->makeSlug($user->name);
		$user->confirmation_code = str_random(30);
		$link = URL_USERS_CONFIRM.'/'.$user->confirmation_code;
		$user->save();
		$user->roles()->attach($user->role_id);
		try{
        sendEmail('registration', array('user_name'=>$user->email, 'username'=>$user->email, 'to_email' => $user->email, 'password'=>$data['password'], 'confirmation_link' => $link));
          }
         catch(Exception $ex)
        {
            
        }
		flash('Success','You Have Registered Successfully. Please Check Your Email Address To Activate Your Account', 'success');
		return $user;
    }
	
	/**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function register(Request $request)
    {
		$data = array(
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'email' => $request->email,
			'password' => $request->password,
			'role' => $request->role,			
		);
		$name = $data['first_name'] . ' ' . $data['last_name'];
		$user    = new User();
		$user->name     = $name;
        $user->first_name     = $data['first_name'];
        $user->last_name    = $data['last_name'];
		$user->email     = $data['email'];
        $user->password = bcrypt($data['password']);
        if( $data['role'] == 'vendor' ) {
			$user->role_id  = VENDOR_ROLE_ID;
			$user->user_modules_permissions   = '{"Products":{"Add":"on","Edit":"on","View":"on","Import":"on"},"Coupons":{"View":"on"},"Change_Password":{"Edit":"on"},"Profile":{"Edit":"on","View":"on"}}';
		} else {
			$user->role_id  = USER_ROLE_ID;
			$user->user_modules_permissions   = '{"Products":{"View":"on"},"Coupons":{"View":"on"},"Change_Password":{"Edit":"on"},"Profile":{"Edit":"on","View":"on"}}';
		}
        $user->slug     = $user->makeSlug($user->name);
		$user->confirmation_code = str_random(30);
		$link = URL_USERS_CONFIRM . '/' . $user->confirmation_code;
		$user->save();
		$user->roles()->attach($user->role_id);
		try{
        sendEmail('registration', array('user_name'=>$user->email, 'username'=>$user->email, 'to_email' => $user->email, 'password'=>$data['password'], 'confirmation_link' => $link));
          }
         catch(Exception $ex)
        {
            
        }
		flash('success','You Have Registered Successfully. Please Check Your Email Address To Activate Your Account', 'success');
		return redirect( URL_USERS_LOGIN );
    }
}

<?php

namespace Responsive\Http\Controllers\Auth;

use Responsive\User;
use Responsive\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
use Auth;
use URL;

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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

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
            'name' => 'required|regex:/^[\w-]*$/|unique:users|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
			'gender' => 'required|string|max:255',
			'usertype' => 'required|string|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
	 
	 
	
	 
	 
   /* protected function create(array $data)
    {
		
        return User::create([
            'name' => $data['name'],
			
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
			'gender' => $data['gender'],
			'phone' => $data['phoneno'],
			'photo' => '',
			'admin' => $data['usertype'],
        ]);
    }
	
	
	
	*/
	
	
	
	
	
	
	
	
	protected function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[\w-]*$/|unique:users|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
			'gender' => 'required|string|max:255',
			'usertype' => 'required|string|max:255',
			
			
			
        ]);

        $input = $request->all();
		 

        if ($validator->passes()) {

            $data = $request->all();
			
			$name = $data['name'];
			$email = $data['email'];
			$keyval = uniqid();
			$pass = bcrypt($data['password']);
			$phoneno = $data['phoneno'];
			$gender = $data['gender'];
			$usertype = $data['usertype'];
			
			
			$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$temp_id = uniqid();
			
			
			
			DB::insert('insert into users (name,email,password,confirm_key,gender,phone,admin) values (?, ?, ?, ?, ?, ?,?)', [$name,$email,$pass,$keyval,$gender,$phoneno,$usertype]);
			
			
				
			$admin_idd=1;
		
		$admin_email = DB::table('users')
                ->where('id', '=', $admin_idd)
                ->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$adminemail = $admin_email[0]->email;
		
		$adminname = $admin_email[0]->name;
		
		$datas = [
            'name' => $name, 'email' => $email, 'keyval' => $keyval, 'site_logo' => $site_logo,
			'site_name' => $site_name, 'url' => $url
        ];
		
		Mail::send('confirm_mail', $datas , function ($message) use ($adminemail,$adminname,$email)
        {
		
		
		
		
            $message->subject('Email Confirmation for Registration');
			
            $message->from($adminemail, $adminname);

            $message->to($email);

        }); 
		
		
			
			return redirect('login')->with('success', 'We sent you an activation code. Check your email and click on the link to verify.');
			
			

            

        }
		else
		{
        
		$failedRules = $validator->failed();
			 
			return back()->withErrors($validator);
        /*return redirect('login')->with('error', 'Username or email already exists. Please try again');*/
        }
	
	
	}
	
	
	
	
	
	protected function create(array $data)
    {
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		
		
		$name = $data['name'];
		$email = $data['email'];
		$keyval = uniqid();
		$pass = bcrypt($data['password']);
			$phoneno = $data['phoneno'];
			$gender = $data['gender'];
			$usertype = $data['usertype'];
		
		
		$temp_id = uniqid();
		
        return User::create([
            'name' => $data['name'],
			
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
						
			'photo' => '',
			
			'admin' => $data['usertype'],
			'confirm_key' => $keyval,
			'gender' => $data['gender'],
			'phone' => $data['phoneno'],
			'admin' => $data['usertype'],
			
			
        ]);
		
		
		$admin_idd=1;
		
		$admin_email = DB::table('users')
                ->where('id', '=', $admin_idd)
                ->get();
		
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$adminemail = $admin_email[0]->email;
		
		$adminname = $admin_email[0]->name;
		
		
		
		$datas = [
            'name' => $name, 'email' => $email, 'keyval' => $keyval, 'site_logo' => $site_logo,
			'site_name' => $site_name, 'url' => $url
        ];
		
		Mail::send('confirm_mail', $datas , function ($message) use ($adminemail,$adminname,$email)
        {
		
		
		
		
            $message->subject('Email Confirmation for Registration');
			
            $message->from($adminemail,$adminname);

            $message->to($email);

        }); 
		
		return redirect('login')->with('success', 'We sent you an activation code. Check your email and click on the link to verify.');
		
		
		
		
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

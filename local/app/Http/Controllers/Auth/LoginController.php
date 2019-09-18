<?php

namespace Responsive\Http\Controllers\Auth;

use Responsive\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Auth;
use Socialite;
use Responsive\User;
use Illuminate\Support\Facades\Validator;
use Input;
use Redirect;
use URL;

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

use AuthenticatesUsers;




public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect('dashboard');
    }
	
	
	
	
	public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $user->name,
			'admin' => 3,
            'email'    => $user->email,
			'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }	
	
	
	


protected function authenticated(Request $request, $user)
{
if(auth()->check() && auth()->user()->id == 1){
            
			return redirect('/admin');
        }
		else
		{
			return redirect('/dashboard');
		}

        
}



public function username()
{
    return 'username';
}




protected function login(Request $request)
{
	
	
	
	
	$url = URL::to("/");
	
	
	
	$validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'password' => 'required',
			
			
			
			
        ]);

        $input = $request->all();
		 
        
   if ($validator->passes()) 
   {
	
		   
		   $auth = false;
    
	
	
		$usernameInput = trim(Input::get('username'));
		$usernameColumn = filter_var($usernameInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

		if (Auth::attempt(array($usernameColumn => $usernameInput, 'password' => Input::get('password') ))) 
		{
			$auth = true; // Success
    
		   if (auth()->user()->confirmation == 0 && auth()->user()->admin!=1) 
		   {
            auth()->logout();
			
			$passing = base64_encode($usernameInput);
			
			return back()->with('resenderr', $passing);

            
           } 
		   else
           {
		       if(Auth::user()->admin == 1)
				{
					
					return redirect('/admin');
					
				}
			else if(Auth::user()->admin == 2)
				{	
					$useremail = Auth::user()->email;
					$shopcount = DB::table('shop')
					->where('seller_email', '=', $useremail)
					->count();
					if($shopcount != 0)
					{
					return redirect('/dashboard');
					}
					else
					{
					return redirect('/addshop');
					}
				}
                else
				{					
				return redirect('/index');
				}
					
				
		   }		
				
				
		}
		
		else
		{
			   
			   return back()->with('error', 'Invalid Login Details');
		}
		
		   
		
		}
		else
		{
			return back()->with('error', 'Invalid Login Details');
		}
		
		
		

        
}








protected function credentials(Request $request)
{
    $usernameInput = trim($request->{$this->username()});
    $usernameColumn = filter_var($usernameInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

    /*return [$usernameColumn => $usernameInput, 'password' => $request->password];*/
	
	 return [$usernameColumn => $usernameInput, 'password' => $request->password, 'confirmation' => 1]; 
}









 protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];
        // Load user from database
        $user = DB::table('users')
				->where('name', $request->{$this->username()})->first();
        
        if ($user && \Hash::check($request->password, $user->password) && $user->admin != 1) {
            $errors = [$this->username() => 'Your account is not active.'];
        }
        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        /*return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);*/
			return back()->with('error', 'Invalid login details');
    }



/**
 * Where to redirect users after login.
 *
 * @var string
 */
//protected $redirectTo = '/admin';

/**
 * Create a new controller instance.
 *
 * @return void
 */
public function __construct()
{
    $this->middleware('guest', ['except' => 'logout']);
}
}



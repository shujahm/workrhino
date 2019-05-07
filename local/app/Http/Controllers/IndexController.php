<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use URL;
use Mail;
use Auth;
use Crypt;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function all_services()
   {

     $user_count = DB::table('services')
			->orderBy('name','asc')
			->count();
     $data = array('user_count' => $user_count);
		
		
            return view('all-services')->with($data);

   }	 
	
    public function resend_email($username)
	{
		
		$name = base64_decode($username);
		
		$user_checked = DB::table('users')
						->where('name', '=', $name)
						->orWhere('email','=',$name)
						->count();
						
		if(!empty($user_checked))
		{
		$user_details = DB::table('users')
						->where('name', '=', $name)
						->orWhere('email','=',$name)
						->get();
		
		$email = $user_details[0]->email;
		$keyval = $user_details[0]->confirm_key;
		
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		
		
		
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
			return redirect('login');
		}			
		
		
		
		
		
	}



	
	 
	public function confirmation($it)
	{
		
		DB::update('update users set confirmation="1" where confirm_key="'.$it.'"');
		return view('confirmemail');
		
	}
	public function view_former()
	{
		return view('confirmemail');
	}	 
	 
	public function sangvish_reset($token)
	{
		
		$view_token = base64_decode($token);
		
		$pieces = explode("_", $view_token);
		$userid = $pieces[0];
        $userna = $pieces[1];
		
		$data = array('userid' => $userid); 
		
		return view('reset')->with($data);
		
	}	




     public function sangvish_resetdata(Request $request) 
	{ 
	 
	 $data = $request->all();
	 
	 $uid = $data['uid'];
	 $password = bcrypt($data['password']);
	 
	 DB::update('update users set password="'.$password.'" where id = ?', [$uid]);

     return redirect()->back()->with('success', 'Your password has been changed successfully.');

    }	 
	 
	 
	 
	 
	 
	public function sangvish_forgot()
	{
		
		return view('forgot');
		
	}		
	 
	public function sangvish_forgotdata(Request $request) 
	{ 
	 
	 $data = $request->all();
	 
	 $email = $data['email'];
	 
	 $check_user = DB::table('users')
	               ->where('email','=',$email)
				   ->count();
				   
		if(!empty($check_user))
		{
			
			$view_user = DB::table('users')
	                     ->where('email','=',$email)
				         ->get();
						 
						 $token_value = $view_user[0]->id.'_'.$view_user[0]->name;
						 
				$token_key = base64_encode($token_value);
                $name = $view_user[0]->name;
				
						 
					$setid=1;
				$setts = DB::table('settings')
				->where('id', '=', $setid)
				->get();
				
				$url = URL::to("/");
				
				$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
				
				$site_name = $setts[0]->site_name;
				
				
				$aid=1;
				$admindetails = DB::table('users')
				 ->where('id', '=', $aid)
				 ->first();
				
				$admin_email = $admindetails->email;
				
				
				$datas = [
					'name' => $name, 'email' => $email, 'token_key' => $token_key, 'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url
				];
				
				Mail::send('forgotemail', $datas , function ($message) use ($admin_email,$name,$email)
				{
					$message->subject('Reset Password Link');
					
					$message->from($admin_email, 'Admin');

					$message->to($email);

				}); 
			return redirect()->back()->with('success', 'We have e-mailed your password reset link!');		 
			
		}
		else
		{
			
			return redirect()->back()->with('error', "We can't find a user with that e-mail address.");
		}		
	 
	 
	 
	 
	 
	} 
	 
	 
    public function sangvish_index()
    {
       
	   
	   $services_cnt = DB::table('services')->limit(7)->count();
	   if(!empty($services_cnt))
	   {
		   
		$services = DB::table('services')->limit(7)->get();
	   }
	   else
	   {
		   $services = "";
	   }
	   
	   
	   
	   $carousel = DB::table('services')
	               ->where('status','=',1)
				   ->count();
		
		if(!empty($carousel))
		{
		$carousel_get = DB::table('services')->where('status','=',1)->orderBy('name','asc')->get();
		
		}
		else
		{
			$carousel_get = "";
			$carousel = 0;
			
		}
		
		
		
		
		
		
		
		$testimonials_cnt = DB::table('testimonials')->orderBy('id', 'desc')->count();
		if(!empty($testimonials_cnt))
		{
		$testimonials = DB::table('testimonials')->orderBy('id', 'desc')->get();
        }
		else
		{
			$testimonials = "";
		}
      
		
		
		
		$data = array('services_cnt' => $services_cnt, 'services' => $services, 'carousel_get' => $carousel_get, 'carousel' => $carousel, 'testimonials' => $testimonials, 'testimonials_cnt' => $testimonials_cnt);
		
		
            return view('index')->with($data);
			
    }
	
	
	
	
	
	
	public function sangvish_autoComplete(Request $request) {
        $query = $request->get('term','');
        
        $viewsubservice=DB::table('subservices')->where('subname','LIKE','%'.$query.'%')->orderBy('subname', 'asc')->get();
        
        $data=array();
        foreach ($viewsubservice as $viewsub) {
                $data[]=array('value'=>$viewsub->subname,'id'=>$viewsub->subid);
        }
        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }
	
	
	
	
	
	
}

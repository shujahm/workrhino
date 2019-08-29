<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Mail;
use Auth;
use Crypt;
use URL;

class PageController extends Controller
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
    public function sangvish_about_us()
    {
       
		$about_us_id = 1;
		$about_us = DB::table('pages')
		       ->where('page_id', '=', $about_us_id)
			   ->get();
	
		$data = array('about_us' => $about_us);
            return view('about-us')->with($data);
    }

    public function sangvish_become_a_rhino()
    {
       
		$become_a_rhino_id = 2;
		$become_a_rhino = DB::table('pages')
		       ->where('page_id', '=', $become_a_rhino_id)
			   ->get();
	
		$data = array('become_a_rhino' => $become_a_rhino);
            return view('become-a-rhino')->with($data);
    }

    public function sangvish_our_services()
    {
       
		$our_services_id = 3;
		$our_services = DB::table('pages')
		       ->where('page_id', '=', $our_services_id)
			   ->get();
	
		$data = array('our_services' => $our_services);
            return view('our-services')->with($data);
    }
	
    public function sangvish_our_locations()
    {
       
		$our_locations_id = 5;
		$our_locations = DB::table('pages')
		       ->where('page_id', '=', $our_locations_id)
			   ->get();
	
		$data = array('our_locations' => $our_locations);
            return view('our-locations')->with($data);
    }

    public function sangvish_terms_and_privacy()
    {
       
		$terms_and_privacy_id = 6;
		$terms_and_privacy = DB::table('pages')
		       ->where('page_id', '=', $terms_and_privacy_id)
			   ->get();
	
		$data = array('terms_and_privacy' => $terms_and_privacy);
            return view('terms-and-privacy')->with($data);
    }

    public function sangvish_privacy_policy()
    {
       
		$privacy_policy_id = 7;
		$privacy_policy = DB::table('pages')
		       ->where('page_id', '=', $privacy_policy_id)
			   ->get();
	
		$data = array('privacy_policy' => $privacy_policy);
            return view('privacy-policy')->with($data);
    }

	public function sangvish_404()
    {
		return view('404');
    }
		
	
	public function sangvish_contact()
    {
       
		$contact_id = 4;
		$contact = DB::table('pages')
		       ->where('page_id', '=', $contact_id)
			   ->get();
	
		$data = array('contact' => $contact);
            return view('contact')->with($data);
    }
	

	public function sangvish_topages()
    {
       
		$topages_id = 8;
		$topages = DB::table('pages')
		       ->where('page_id', '=', $topages_id)
			   ->get();
	
		$data = array('topages' => $topages);
            return view('how-to-pages')->with($data);
    }
	
	
	
	public function sangvish_mailsend(Request $request)
	{
		$data = $request->all();
		
		$name = $data['name'];
		$email = $data['email'];
		$phone_no = $data['phone_no'];
		$msg = $data['msg'];
		
		
		
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
            'name' => $name, 'email' => $email, 'phone_no' => $phone_no, 'msg' => $msg, 'site_logo' => $site_logo, 'site_name' => $site_name
        ];
		
		Mail::send('contactemail', $datas , function ($message) use ($admin_email,$name,$email)
        {
            $message->subject('New Enquiry Received');
			
            $message->from($admin_email, $name);

            $message->to($admin_email);

        }); 
		
		
		
		
		return redirect()->back()->with('message', 'Your message sent successfully');
		
	}
	
	
	
	
}

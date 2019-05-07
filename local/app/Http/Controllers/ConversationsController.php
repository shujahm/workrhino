<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Mail;
use Auth;
use Crypt;
use URL;

class ConversationsController extends Controller
{
    
    public function __construct()
    {
       $this->middleware('auth');
    }
	
	public function feature_submission($gid,$price,$days)
	{
	$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		$rand = rand(00000,99999);
	
	$data = array( 'gid' => $gid, 'price' => $price, 'days' => $days, 'site_setting' => $site_setting, 'rand' => $rand );
	return view('feature_bank_payment')->with($data);
	
	}
	
	
	
	public function conversations($giguser,$logid,$gigid,$checkvel)
	{
		$users = DB::table('users')
		         ->where('id', '=', $giguser)
		        
				 ->get();
				 
		$users_count = DB::table('users')
		         ->where('id', '=', $giguser)
		        
				 ->count();
				 
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);		 
				 
        
		
		$status = 1;
		
        $user_details = DB::table('users')
		         ->where('id', '=', $logid)
				 ->where('confirmation', '=', $status)
                 ->get();
		$user_details_cnt = DB::table('users')
		         ->where('id', '=', $logid)
				 ->where('confirmation', '=', $status)
                 ->count();	


        $view_msg =  DB::table('conversations')
		         ->where('gig_id', '=', $gigid)
				 ->whereIn('sender', [$logid,$giguser])
				
				 
				 ->orderBy('id','desc')
                 ->get();				 
				 
		$view_msg_cnt =  DB::table('conversations')
		         
				->where('gig_id', '=', $gigid)
				 ->whereIn('sender', [$logid,$giguser])
				 
				 ->orderBy('id','desc')
                 ->count();
		
		if(!empty($giguser)){ $gig_user = $giguser; } else { $gig_user =""; }
		if(!empty($logid)){ $log_id = $logid; } else { $log_id =""; }
		if(!empty($gigid)){ $gig_id = $gigid; } else { $gig_id =""; }
		
		/*if(!empty($checkvel))
		{
			$view_msg =  DB::table('conversations')
			             ->where('id', '=', $checkvel)
						 ->get();
						 if($view_msg[0]->read_write_status==1)
						 {
							 $checker = 0;
						 }
						 else
						 {
							 $checker ="";
						 }
			DB::update('update conversations set read_write_status="'.$checker.'" where id = ?', [$checkvel]);
		}*/
		
		return view('conversations', ['users' => $users, 'site_setting' => $site_setting, 'gig_user' => $gig_user,
		'log_id' => $log_id, 'gig_id' => $gig_id, 'user_details' => $user_details, 'user_details_cnt' => $user_details_cnt,
		'view_msg' => $view_msg, 'view_msg_cnt' => $view_msg_cnt, 'checkvel' => $checkvel]);
	}
	
	
	
	
	protected function feature_payment(Request $request)
    {
        $data = $request->all();
		$feature_price = $data['feature_price'];
		$feature_days = '+'.$data['feature_days'].' '.'days';
		$reference_id = $data['reference_id'];
	    $payment_date = $data['payment_date'];
		$info = $data['info'];
		$payment_type = $data['payment_type'];
		
		$start_date = date('Y-m-d');
		$end_date = date('Y-m-d', strtotime($feature_days));
		$feature_status = 2;
		$gid = $data['gid'];
		$user_id = Auth::user()->id;
		$username = $data['name'];
		
		$gig_details = DB::table('gigs')
		         ->where('gid', '=', $gid)
				 ->where('job_type','=',"")
				 ->where('user_id', '=', $user_id)
				 ->get();
				 
		$title = $gig_details[0]->subject;		 
		
		$chk_count =  DB::table('gigs')
		         ->where('gid', '=', $gid)
				 ->where('job_type','=',"")
				 ->where('user_id', '=', $user_id)
				 ->where('featured', '=', 0)
				 ->count();
		if($chk_count==1)
		{
		DB::update('update gigs set featured="'.$feature_status.'",payment_type="'.$payment_type.'",
		feature_price="'.$feature_price.'",	feature_start_date="'.$start_date.'", feature_end_date="'.$end_date.'",
		reference_id="'.$reference_id.'", payment_date="'.$payment_date.'", additional_info="'.$info.'"
		where user_id ="'.$user_id.'" and gid = ?', [$gid]);
		
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		
		
		
		Mail::send('feature_bank_email', ['gid' => $gid, 'reference_id' => $reference_id, 'username' => $username,
		'title' => $title, 'feature_price' => $feature_price, 'start_date' => $start_date, 'end_date' => $end_date,
		'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url], function ($message)
        {
            $message->subject('Feature Job Confirmation Received');
			
            $message->from(Input::get('admin_email'), 'Admin');

            $message->to(Input::get('admin_email'));

        }); 
		
		
		
		 
		 return back()->with('success', 'Thankyou! We received your information and will notify you once the order is created.');
		}
		else
		{
			return back()->with('error', 'That job already featured');
		}
		 
	}	 
	
	
	
	protected function savedata(Request $request)
    {
        
		
		
		 $data = $request->all();
		 
		 
		 
		 
		 $image = Input::file('photo');
		 if($image!="")
		 {
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $userphoto="/gigs/";
            $path = base_path('images'.$userphoto.$filename);
			$destinationPath=base_path('images'.$userphoto);
 
        
                /*Image::make($image->getRealPath())->resize(100, 100)->save($path);*/
				Input::file('photo')->move($destinationPath, $filename);
               /* $user->image = $filename;
                $user->save();*/
				$namef=$filename;
		 }
		 else
		 {
			 $namef="";
		 }
		 
		 
		 $msg = $data['msg'];
		 $gig_user_id = $data['gig_user_id'];
		 $log_user_id = $data['log_user_id'];
		 
		 if(!empty($data['gig_id']))
		 {
		 $gig_id = $data['gig_id'];
		 }
		 else
		 {
			 $gig_id = 0;
		 }
		 
		 $report = 0;
		 $date_submit = date("Y-m-d H:i:s");
		 $read_status = 1;
		 
		 
		 DB::insert('insert into conversations (gig_id,sender,receiver,message,read_write_status,date_submitted,file,report) values (?, ?, ?, ?, ?, ?, ?, ?)', [$gig_id,
		 $log_user_id,$gig_user_id,$msg,$read_status,$date_submit,$namef,$report]);
		
		
			return back()->with('success', 'Message has been saved');
		 
		 
		 
	}



     public function  view_inbox()
	 {
		 
		 
			  
			  $view_conv = DB::table('conversations')
		         ->where('receiver', '=', Auth::user()->id)
				 ->orderBy('id','desc')
                 ->get();

           $view_conv_cnt = DB::table('conversations')
		         ->where('receiver', '=', Auth::user()->id)
				 ->orderBy('id','desc')
                 ->count();
				 
				 
		$view_select = DB::table('conversations')
		         ->where('receiver', '=', Auth::user()->id)
				 ->groupBy('sender')
				 ->orderBy('id','desc')
                 ->get();

        $view_select_cnt = DB::table('conversations')
		         ->where('receiver', '=', Auth::user()->id)
				 ->groupBy('sender')
				 ->orderBy('id','desc')
                 ->count();   
         				 
         
		 $cls_cla = "btn-default";
		 $cls_cla1  ="btn-default";
		 $cls_cla0 = "btn-default";
		 $chk_id = "";
		 return view('inbox', ['view_conv' => $view_conv, 'view_conv_cnt' => $view_conv_cnt, 'cls_cla' => $cls_cla,
		 'cls_cla1' => $cls_cla1, 'cls_cla0' => $cls_cla0, 'chk_id' => $chk_id, 'view_select' => $view_select, 
		 'view_select_cnt' => $view_select_cnt]);
	 }



    public function  view_giger()
	 {

	 $gig = DB::table('gigs')
				->where('user_id', '=', Auth::user()->id)
				
				->where('job_type','=',"")
				->orderBy('gid','desc')
				->get();
				
	$gig_cnt = DB::table('gigs')
				->where('user_id', '=', Auth::user()->id)
				
				->where('job_type','=',"")
				->orderBy('gid','desc')
				->count();
				
	
    
	
				
				
				

    $siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);					
	
	return view('manage_services', ['gig' => $gig, 'gig_cnt' => $gig_cnt, 'site_setting' => $site_setting]);
	
	
	 }
	 
	 
	 
	 public function status_gig($id) 
	{
	
	   if($id==1)
		{
			
			$gig = DB::table('gigs')
				->where('user_id', '=', Auth::user()->id)
				->where('job_type','=',"")
				->where('status', '=', $id)
				->get();
				
	$gig_cnt = DB::table('gigs')
				->where('user_id', '=', Auth::user()->id)
				->where('job_type','=',"")
				->where('status', '=', $id)
				->count();
				 
			
		}
		else if($id==0)
		{
			
			$gig = DB::table('gigs')
				->where('user_id', '=', Auth::user()->id)
				->where('status', '=', $id)
				->where('job_type','=',"")
				->get();
				
	       $gig_cnt = DB::table('gigs')
				->where('user_id', '=', Auth::user()->id)
				->where('status', '=', $id)
				->where('job_type','=',"")
				->count();	
			
		}
		else
		{
			$gig = DB::table('gigs')
				->where('user_id', '=', Auth::user()->id)
				->where('job_type','=',"")
				->get();
				
	       $gig_cnt = DB::table('gigs')
				->where('user_id', '=', Auth::user()->id)
				->where('job_type','=',"")
				->count();	
				 
		}
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);	
		return view('manage_services', ['gig' => $gig, 'gig_cnt' => $gig_cnt, 'site_setting' => $site_setting]);
	
	
	
	
	}
	
	
	
	
	
	
	
	
	 public function order_giger($gig,$logid,$order) 
	{
	
	   if($order=='asc')
		{
			
			$gig = DB::table('gigs')
				->where('user_id', '=', Auth::user()->id)
				->where('job_type','=',"")
				->orderBy('gid',$order)
				
				->get();
				
	$gig_cnt = DB::table('gigs')
				->where('user_id', '=', Auth::user()->id)
				->where('job_type','=',"")
				->orderBy('gid',$order)
				->count();
				 
			
		}
		else if($order=='desc')
		{
			
			$gig = DB::table('gigs')
				->where('user_id', '=', Auth::user()->id)
				->where('job_type','=',"")
				->orderBy('gid',$order)
				->get();
				
	$gig_cnt = DB::table('gigs')
				->where('user_id', '=', Auth::user()->id)
				->where('job_type','=',"")
				->orderBy('gid',$order)
				->count();	
			
		}
		else
		{
			$gig = DB::table('gigs')
				->where('gid', '=', Auth::user()->id)
				->where('job_type','=',"")
				->get();
				
	$gig_cnt = DB::table('gigs')
				->where('gid', '=', Auth::user()->id)
				->where('job_type','=',"")
				->count();
				 
		}
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);	
		return view('manage_services', ['gig' => $gig, 'gig_cnt' => $gig_cnt, 'site_setting' => $site_setting]);
	
	
	
	
	}
	
	
	
	
	
	
	 
	 
	 
	 
	 
	 
	 
	 public function delete_giger($delete,$gid)
	 {
		 $gigg = DB::table('gigs')
				->where('gid', '=', $gid)
				
				->get();
				
				
		/*DB::delete('delete from gig_order where gid = ?',[$gid]);		
				
		 DB::delete('delete from gigs where gid = ?',[$gid]);*/
		 
		 
		 DB::update('update gigs set delete_status="deleted",status="0" where gid = ?', [$gid]);
		 
		 return back();
		 
	 }
	 
	 
	 
	 
	 
	 
	
	public function delete_msg($id,$status) 
	{
		
		DB::delete('delete from conversations where id = ?',[$id]);
		
		
		
			return back();
		
	}
	
	
	public function selected_msg($user,$logid,$senderid)
	{
		
		$view_select = DB::table('conversations')
		         ->where('receiver', '=', $logid)
				 ->groupBy('sender')
				 ->orderBy('id','desc')
                 ->get();

        $view_select_cnt = DB::table('conversations')
		         ->where('receiver', '=', $logid)
				 ->groupBy('sender')
				 ->orderBy('id','desc')
                 ->count(); 
				 
		$view_conv = DB::table('conversations')
		         ->where('sender', '=', $senderid)
		         ->where('receiver', '=', $logid)
				 
                 ->get();

           $view_conv_cnt = DB::table('conversations')
		         ->where('sender', '=', $senderid)
		         ->where('receiver', '=', $logid)
                 ->count();
			$chk_id ="";	 
			$cls_cla = "btn-default";
        $cls_cla1 = "btn-default";
		$cls_cla0 = "btn-default";			
		return view('inbox', ['view_conv' => $view_conv, 'view_conv_cnt' => $view_conv_cnt,
		'view_select' => $view_select, 'view_select_cnt' => $view_select_cnt, 'chk_id' => $chk_id, 'cls_cla' => $cls_cla,
		'cls_cla1' => $cls_cla1, 'cls_cla0' => $cls_cla0]);
		
	}
	
	
	
	
	
	
	
	
	public function status_msg($id) 
	{
		
		
		
		if($id==1)
		{
			
			$view_conv = DB::table('conversations')
		         ->where('receiver', '=', Auth::user()->id)
				 ->where('read_write_status', '=', $id) 
                 ->get();

           $view_conv_cnt = DB::table('conversations')
		         ->where('receiver', '=', Auth::user()->id)
				 ->where('read_write_status', '=', $id)
                 ->count();	
				 
			
		}
		else if($id==0)
		{
			
			$view_conv = DB::table('conversations')
		         ->where('receiver', '=', Auth::user()->id)
				 ->where('read_write_status', '=', $id) 
                 ->get();

           $view_conv_cnt = DB::table('conversations')
		         ->where('receiver', '=', Auth::user()->id)
				 ->where('read_write_status', '=', $id)
                 ->count();	
			
		}
		else
		{
			$view_conv = DB::table('conversations')
		         ->where('receiver', '=', Auth::user()->id)
				 
                 ->get();

           $view_conv_cnt = DB::table('conversations')
		         ->where('receiver', '=', Auth::user()->id)
				 
                 ->count();
				 
		}
		
		$view_select = DB::table('conversations')
		         ->where('receiver', '=', Auth::user()->id)
				 ->groupBy('sender')
				 ->orderBy('id','desc')
                 ->get();

        $view_select_cnt = DB::table('conversations')
		         ->where('receiver', '=', Auth::user()->id)
				 ->groupBy('sender')
				 ->orderBy('id','desc')
                 ->count();   
		
		$cls_cla1 = "btn-danger";
		$cls_cla0 = "btn-success";
		$cls_cla = "btn-default";
		$chk_id = $id;
		return view('inbox', ['view_conv' => $view_conv, 'view_conv_cnt' => $view_conv_cnt,
		'cls_cla' => $cls_cla, 'cls_cla1' => $cls_cla1, 'cls_cla0' => $cls_cla0,'chk_id' => $chk_id, 
		'view_select' => $view_select, 'view_select_cnt' => $view_select_cnt]);
		
	}
	
	
	
}

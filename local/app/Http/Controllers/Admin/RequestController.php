<?php

namespace Responsive\Http\Controllers\Admin;



use File;
use Image;
use Responsive\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Responsive\Http\Requests;
use Illuminate\Http\Request;
use Responsive\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Mail;
use Auth;
use Crypt;
use URL;

class RequestController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        $request = DB::table('gigs')
		           ->where('delete_status','=','')
				   ->where('job_type','=','request')
		            ->orderBy('gid','desc')
					->get();
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);

        return view('admin.request', ['request' => $request, 'site_setting' => $site_setting]);
    }
	
	
	
   public function gig_viewmore($id)
   {
	   
	   $siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);	
		$sql_request_count = DB::table('gigs')
		        
				
				->where('gid','=',$id)
                ->count();
				
		$gig = DB::table('gigs')
		        
				->where('gid','=',$id)
                ->get();

	   $data = array( 'gig' => $gig, 'sql_request_count' => $sql_request_count, 'site_setting' => $site_setting);
	   
	   return view('admin.view_request')->with($data);
	   
   }
   
   
   public function status($status,$sid,$id) 
	{
		
		
		$chker = DB::table('gigs')
			         ->where('sent_mail','=',1)
					 ->where('gid','=',$id)
					 ->count();
		if($sid==1)
		{
			if(empty($chker))
			{
				$chker_value = DB::table('gigs')
			         ->where('sent_mail','=',0)
					 ->where('gid','=',$id)
					 ->get();
				$user = DB::table('users')
					   ->where('id','=',$chker_value[0]->user_id)
					   ->get();		 
		
		
				$setid=1;
				$setts = DB::table('settings')
				->where('id', '=', $setid)
				->get();
				
				$url = URL::to("/");
				
				$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
				
				$site_name = $setts[0]->site_name;
				
				
				
				if($chker_value[0]->budget_type=="fixed"){ 
						   $bud_txt = "Fixed Price"; 
						     if($chker_value[0]->fixed_price=="custom_budget")
							 {
								$estim = $chker_value[0]->minimum_budget.' - '.$chker_value[0]->maximum_budget.' '.$setts[0]->site_currency;
							 }
							 else
							 {
								 $estim = $chker_value[0]->fixed_price;
							 }
						   } 
						   else if($chker_value[0]->budget_type=="hour"){ 
						   $bud_txt = "Hourly Price"; 
						   
						   if($chker_value[0]->hour_price=="custom_budget")
							 {
								$estim = $chker_value[0]->minimum_budget.' - '.$chker_value[0]->maximum_budget.' '.$setts[0]->site_currency;
							 }
							 else
							 {
								 $estim = $chker_value[0]->hour_price;
							 }
						   
						   
						   }
				
				
				
				
				$rid = $id;
				$username = $user[0]->name;
				$title = $chker_value[0]->subject;
				$budget = $estim;
				$delivery = $chker_value[0]->complete_days;
				$submit_date = $chker_value[0]->submit_date;
				$useremail = $user[0]->email;
				
				Mail::send('admin.request_approval_email', ['rid' => $rid, 'username' => $username,'title' => $title, 'budget' => $budget, 'delivery' => $delivery, 'submit_date' => $submit_date,
				'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url], function ($message) use ($useremail)
				{
					$message->subject('Your Request Approved Successfully');
					
					$message->from(Auth::user()->email, 'Admin');

					$message->to($useremail);

				}); 
				
				
				
			}
					 
		}
		DB::update('update gigs set status="'.$sid.'",sent_mail="1" where gid = ?', [$id]);
		
		return back();
		
	}
   
   
   
   
	
	public function destroy($id) {
		
		
		DB::update('update gigs set delete_status="deleted",status="0" where gid = ?', [$id]);
		
	  /*DB::delete('delete from request_offer where request_id = ?',[$id]);	
      DB::delete('delete from request where rid = ?',[$id]);*/
	   
      return back();
      
   }
	
}
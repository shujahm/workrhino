<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Mail;
use URL;
use Auth;
use Crypt;

class SuccessController extends Controller
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
    
	
	public function success_page($ref_id)
	{
		$datas = array('ref_id' => $ref_id);
     return view('feature-success')->with($datas);
	}
	
	
	public function sangvish_payu_fund_success($gid,$refid,$txnid)
	{
		
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		 $user_id = Auth::user()->id;
		$reference_id = $refid;


         $gig_details = DB::table('gigs')
		         ->where('gid', '=', $gid)
				 ->get();

         if($gig_details[0]->job_type=="request")
		{			
		DB::update('update gigs set request_status="2" where gid = ?', [$gid]);		 
        }				 
				
		$title = $gig_details[0]->subject;		
				
		$order_details = DB::table('gig_order')
		         ->where('status', '=', 'processing')
				 ->where('user_id', '=', $user_id)
				 ->where('reference_id', '=', $refid)
				 ->get();		
				
				 
		
		$order_count =  DB::table('gig_order')
		         ->where('status', '=', 'processing')
				 ->where('user_id', '=', $user_id)
				 ->where('reference_id', '=', $refid)
				 ->count();	

         				 
				
		if($order_count==1)
		{
			
			
			
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
			
		$commission_mode = $setts[0]->commission_mode;
		$commission_amt = $setts[0]->commission_amt;
		$affilitate_percentamt = 0;
		
		$processing = $setts[0]->processing_fee;

        $sumfee = $order_details[0]->price - $processing;   
				   
				   if($commission_mode=="percentage")
				   {
					   $commission_amount = ($commission_amt * $sumfee) / 100;
				   }
				   if($commission_mode=="fixed")
				   {
					    if($sumfee < $commission_amt)
						{
							$commission_amount = 0;
						}
						else
						{
							$commission_amount = $commission_amt;
						}
				   }
				   
				   
				   
		if(!empty($order_details[0]->coupon_code) && $order_details[0]->coupon_user=="vendor")
		{
			$vendor_yamount = $sumfee - $commission_amount;
			
			$vendor_amount = $vendor_yamount - $order_details[0]->coupon_commission;
			
		}			
		else
		{
			$vendor_amount = $sumfee - $commission_amount;
		}			
				   
		
        if(!empty($order_details[0]->coupon_code) && $order_details[0]->coupon_user=="admin")
		{		
		   
		   /*$admin_amountt = $order_details[0]->coupon_commission;*/
		    $admin_amountt = $commission_amount - $order_details[0]->coupon_commission;
		
		}
		else
		{
			$admin_amountt = $commission_amount;
		}
		
		
		$affiliate_id = Auth::user()->referred_by;
		
		if(!empty($affiliate_id))
		{
			
			
			$affiliate_amount = ($affilitate_percentamt * $sumfee) / 100;
			
			
			/*if($order_details[0]->coupon_user=="")
			{
				$admin_amount =   $admin_amountt - $affiliate_amount;
			}
			else
			{
			
			$admin_amount =  $admin_amountt;
			}*/
			
			/*$admin_amount =  $admin_amountt;*/
			
			$admin_amount =   $admin_amountt - $affiliate_amount;
			
			
		}
		else
		{
			$admin_amount = $admin_amountt;
			$affiliate_amount = 0;
		}
			
			
			
		DB::update('update gig_order set status="completed",payment_level="1",upcoming_payment="1",seller_price="'.$vendor_amount.'",admin_price="'.$admin_amount.'",affiliate_price="'.$affiliate_amount.'",affiliate_id="'.$affiliate_id.'" where user_id ="'.$user_id.'" and reference_id = ?', [$refid]);
		   
		   
		    $username = Auth::user()->name;
			
			$price_details = $order_details[0]->price;
			$payment_date = $order_details[0]->payment_date;
		$payment_type = $order_details[0]->payment_type;
		
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$admin_details =  DB::table('users')
		         ->where('id', '=', 1)
				 ->get();	
		
		$adminemail = $admin_details[0]->email;
		
		$uemail = Auth::user()->email;
		
		Mail::send('paypal_email', ['gid' => $gid, 'reference_id' => $reference_id, 'username' => $username,
		'title' => $title, 'price_details' => $price_details, 'payment_date' => $payment_date, 'payment_type' => $payment_type,
		'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url], function ($message) use ($adminemail)
        {
            $message->subject('Job Order Received');
			
            $message->from($adminemail, 'Admin');

            $message->to($adminemail);

        }); 
		
		
		
		Mail::send('paypal_email', ['gid' => $gid, 'reference_id' => $reference_id, 'username' => $username,
		'title' => $title, 'price_details' => $price_details, 'payment_date' => $payment_date, 'payment_type' => $payment_type,
		'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url], function ($message) use ($adminemail,$uemail)
        {
            $message->subject('Job Order Received');
			
            $message->from($adminemail, 'Admin');

            $message->to($uemail);

        });
		
		
		
		
		
		
		 
		 
		}
		


		$datas = array('gid' => $gid, 'refid' => $refid, 'txnid' => $txnid);
     return view('payu-fund-success')->with($datas);
		
	 
		
		
		
	}
	
	
	
	
	
	public function sangvish_payu_feature_success($gid,$refid,$txnid)
	{
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		 $user_id = Auth::user()->id;
		$feature_price = $setts[0]->featured_gig_price;
		
        $reference_id = $refid;
	    $payment_date = date('Y-m-d');
        $payment_type = 'payumoney';
        
		$feature_status = 1;
		
		
		$gig_details = DB::table('gigs')
		         ->where('gid', '=', $gid)
				 ->where('user_id', '=', $user_id)
				 ->get();		
				
		$title = $gig_details[0]->subject;		 
		
		$chk_count =  DB::table('gigs')
		         ->where('gid', '=', $gid)
				 ->where('user_id', '=', $user_id)
				 ->where('featured', '=', 0)
				 ->count();	
				 
				 
	   if($chk_count==1)
		{
		DB::update('update gigs set featured="'.$feature_status.'",payment_type="'.$payment_type.'",
		feature_price="'.$feature_price.'",	reference_id="'.$reference_id.'", payment_date="'.$payment_date.'"
		where user_id ="'.$user_id.'" and gid = ?', [$gid]);
		   
		   
		    $username = Auth::user()->name;
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$adminemail = Auth::user()->email;
		
		Mail::send('feature_paypal_email', ['gid' => $gid, 'reference_id' => $reference_id, 'username' => $username,
		'title' => $title, 'feature_price' => $feature_price, 
		'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url], function ($message) use ($adminemail)
        {
            $message->subject('Feature Job Received');
			
            $message->from($adminemail, 'Admin');

            $message->to($adminemail);

        }); 
		
		
		
		Mail::send('feature_paypal_email', ['gid' => $gid, 'reference_id' => $reference_id, 'username' => $username,
		'title' => $title, 'feature_price' => $feature_price, 
		'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url], function ($message) use ($adminemail)
        {
            $message->subject('Feature Job Received');
			
            $message->from($adminemail, 'Admin');

            $message->to(Auth::user()->email);

        });
		
		}
					 
				 
		$datas = array('gid' => $gid, 'refid' => $refid, 'txnid' => $txnid);
     return view('payu-feature-success')->with($datas);
		
		
	}
	
	
	
	
	
	public function sangvish_fsuccess($gid,$ref_id,$admin_email) {
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		 $user_id = Auth::user()->id;
		$feature_price = $setts[0]->featured_gig_price;
		$feature_days = '+'.$setts[0]->featured_days.' '.'days';
        $reference_id = $ref_id;
	    $payment_date = date('Y-m-d');
        $payment_type = 'paypal';
        $start_date = date('Y-m-d');
		$end_date = date('Y-m-d', strtotime($feature_days));
		$feature_status = 1;		
				
		$gig_details = DB::table('gigs')
		         ->where('gid', '=', $gid)
				 ->where('user_id', '=', $user_id)
				 ->get();		
				
		$title = $gig_details[0]->subject;		 
		
		$chk_count =  DB::table('gigs')
		         ->where('gid', '=', $gid)
				 ->where('user_id', '=', $user_id)
				 ->where('featured', '=', 0)
				 ->count();		
				
		if($chk_count==1)
		{
		DB::update('update gigs set featured="'.$feature_status.'",payment_type="'.$payment_type.'",
		feature_price="'.$feature_price.'",	feature_start_date="'.$start_date.'", feature_end_date="'.$end_date.'",
		reference_id="'.$reference_id.'", payment_date="'.$payment_date.'"
		where user_id ="'.$user_id.'" and gid = ?', [$gid]);
		   
		   
		    $username = Auth::user()->name;
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$adminemail = base64_decode($admin_email);
		
		Mail::send('feature_paypal_email', ['gid' => $gid, 'reference_id' => $reference_id, 'username' => $username,
		'title' => $title, 'feature_price' => $feature_price, 'start_date' => $start_date, 'end_date' => $end_date,
		'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url], function ($message) use ($adminemail)
        {
            $message->subject('Feature Job Received');
			
            $message->from($adminemail, 'Admin');

            $message->to($adminemail);

        }); 
		
		
		
		Mail::send('feature_paypal_email', ['gid' => $gid, 'reference_id' => $reference_id, 'username' => $username,
		'title' => $title, 'feature_price' => $feature_price, 'start_date' => $start_date, 'end_date' => $end_date,
		'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url], function ($message) use ($adminemail)
        {
            $message->subject('Feature Job Received');
			
            $message->from($adminemail, 'Admin');

            $message->to(Auth::user()->email);

        });
		
		
		return redirect('feature-success/'.$ref_id);
		 
		 
		}
		else
		{
			
		}


		return redirect('feature-success/'.$ref_id);
		
	 
	  
	  
   }
   
   
	
	
	
	
	
	
	public function sangvish_success($cid) {
		
		
		 $booking = DB::table('booking')
              
			   ->where('book_id', '=', $cid)
			   
                ->get();
				
			$bookingupdate = DB::table('booking')
						->where('book_id', '=', $cid)
						->update(['status' => 'paid']);
			

            $booking_well = DB::table('booking')
              
			   ->where('book_id', '=', $cid)
			   ->where('status', '=', 'paid')
                ->get();			
				
			$shopie = $booking_well[0]->shop_id;
			
			$vendor_amount = $booking_well[0]->total_amt - $booking_well[0]->admin_commission;
				
			$count_shop = DB::table('shop')
              
						->where('id', '=', $shopie)
			   
						->count();	
				
			if(!empty($count_shop))
			{
				$get_shop = DB::table('shop')
              
						->where('id', '=', $shopie)
			   
						->get();
				$vendor_id = $get_shop[0]->user_id;	

                
                $userwives = DB::table('users')
              
			               ->where('id', '=', $vendor_id)
			   
                           ->get();
				$wallet_amount = $userwives[0]->wallet;

                $fin_amount = 	$wallet_amount + $vendor_amount;
				
				
				/*$userupdate = DB::table('users')
						->where('id', '=', $vendor_id)
						->update(['wallet' => $fin_amount]);*/
				
			}				
				
		
		 
						
		 
		 
				
				
		$ser_id=$booking[0]->services_id;
			$sel=explode("," , $ser_id);
			$lev=count($sel);
			$ser_name="";
			$sum="";
			$price="";		
		for($i=0;$i<$lev;$i++)
			{
				$id=$sel[$i];	
                
				
				
				$fet1 = DB::table('subservices')
								 ->where('subid', '=', $id)
								 ->get();
				$ser_name.=$fet1[0]->subname.'<br>';
				$ser_name.=",";				 
				
				
				
				$ser_name=trim($ser_name,",");
				
			}
			
		$booking_time=$booking[0]->booking_time;
		if($booking_time>12)
		{
			$final_time=$booking_time-12;
			$final_time=$final_time."PM";
		}
		else
		{
			$final_time=$booking_time."AM";
		}		
			
         		
		$booking_id=$booking[0]->book_id;		
		$booking_date=$booking[0]->booking_date;
		$total_amt=$booking[0]->total_amt;
		$currency = $booking[0]->currency;
		
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
		$user_email = $booking[0]->user_email;
		
		$viewuser = DB::table('users')
		 ->where('email', '=', $user_email)
		 ->get();
		
		$shopid=$booking[0]->shop_id;
		
		$shopdetails = DB::table('shop')
		 ->where('id', '=', $shopid)
		 ->get();
		 
		 $seller_email = $shopdetails[0]->seller_email;
		
		$usernamer = $viewuser[0]->name;
		$userphone = $viewuser[0]->phone;
		
		
		$data = [
            'booking_id' => $booking_id, 'ser_name' => $ser_name, 'booking_date' => $booking_date, 'final_time' => $final_time, 'total_amt' => $total_amt,
			 'currency' => $currency, 'site_logo' => $site_logo, 'site_name' => $site_name, 'user_email' => $user_email, 'usernamer' => $usernamer, 'userphone' => $userphone
        ];
		
		
		
		
		 Mail::send('paymentuseremail', $data , function ($message) use ($admin_email,$user_email)
        {
            $message->subject('Payment Details');
			
            $message->from($admin_email, 'Admin');

            $message->to($user_email);

        }); 
		
		
		
		 Mail::send('paymentadminemail', $data , function ($message) use ($admin_email)
        {
            $message->subject('New Payment Received');
			
            $message->from($admin_email, 'Admin');

            $message->to($admin_email);

        }); 
		
		 Mail::send('paymentselleremail', $data , function ($message) use ($admin_email,$seller_email)
        {
            $message->subject('New Payment Received');
			
            $message->from($admin_email, 'Admin');

            $message->to($seller_email);

        }); 
		
		
		
		
		
		
	 
	  $data = array('cid' => $cid);
     return view('success')->with($data);
	  
   }
   
   
   
  public function sangvish_payu_success($cid,$txtid)
  {
	  
	  
		$booking = DB::table('booking')
              
			   ->where('book_id', '=', $cid)
			   
                ->get();
				
		
		 $bookingupdate = DB::table('booking')
						->where('book_id', '=', $cid)
						->update(['status' => 'paid', 'payu_token' => $txtid]);
						
		 
		 
		  $booking_well = DB::table('booking')
              
			   ->where('book_id', '=', $cid)
			   ->where('status', '=', 'paid')
                ->get();			
				
			$shopie = $booking_well[0]->shop_id;
			
			$vendor_amount = $booking_well[0]->total_amt - $booking_well[0]->admin_commission;
				
			$count_shop = DB::table('shop')
              
						->where('id', '=', $shopie)
			   
						->count();	
				
			if(!empty($count_shop))
			{
				$get_shop = DB::table('shop')
              
						->where('id', '=', $shopie)
			   
						->get();
				$vendor_id = $get_shop[0]->user_id;	

                
                $userwives = DB::table('users')
              
			               ->where('id', '=', $vendor_id)
			   
                           ->get();
				$wallet_amount = $userwives[0]->wallet;

                $fin_amount = 	$wallet_amount + $vendor_amount;
				
				
				/* $userupdate = DB::table('users')
						->where('id', '=', $vendor_id)
						->update(['wallet' => $fin_amount]); */
				
			}				
				
		
		 
		 
				
		$ser_id=$booking[0]->services_id;
			$sel=explode("," , $ser_id);
			$lev=count($sel);
			$ser_name="";
			$sum="";
			$price="";		
		for($i=0;$i<$lev;$i++)
			{
				$id=$sel[$i];	
                
				
				
				$fet1 = DB::table('subservices')
								 ->where('subid', '=', $id)
								 ->get();
				$ser_name.=$fet1[0]->subname.'<br>';
				$ser_name.=",";				 
				
				
				
				$ser_name=trim($ser_name,",");
				
			}
			
		$booking_time=$booking[0]->booking_time;
		if($booking_time>12)
		{
			$final_time=$booking_time-12;
			$final_time=$final_time."PM";
		}
		else
		{
			$final_time=$booking_time."AM";
		}		
			
         		
		$booking_id=$booking[0]->book_id;		
		$booking_date=$booking[0]->booking_date;
		$total_amt=$booking[0]->total_amt;
		$currency = $booking[0]->currency;
		
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
		$user_email = $booking[0]->user_email;
		
		$viewuser = DB::table('users')
		 ->where('email', '=', $user_email)
		 ->get();
		
		$shopid=$booking[0]->shop_id;
		
		$shopdetails = DB::table('shop')
		 ->where('id', '=', $shopid)
		 ->get();
		 
		 $seller_email = $shopdetails[0]->seller_email;
		
		$usernamer = $viewuser[0]->name;
		$userphone = $viewuser[0]->phone;
		
		
		$data = [
            'booking_id' => $booking_id, 'ser_name' => $ser_name, 'booking_date' => $booking_date, 'final_time' => $final_time, 'total_amt' => $total_amt,
			 'currency' => $currency, 'site_logo' => $site_logo, 'site_name' => $site_name, 'user_email' => $user_email, 'usernamer' => $usernamer, 'userphone' => $userphone
        ];
		
		
		
		
		Mail::send('paymentuseremail', $data , function ($message) use ($admin_email,$user_email)
        {
            $message->subject('Payment Details');
			
            $message->from($admin_email, 'Admin');

            $message->to($user_email);

        }); 
		
		
		
		Mail::send('paymentadminemail', $data , function ($message) use ($admin_email)
        {
            $message->subject('New Payment Received');
			
            $message->from($admin_email, 'Admin');

            $message->to($admin_email);

        }); 
		
		
		
		
		Mail::send('paymentselleremail', $data , function ($message) use ($admin_email,$seller_email)
        {
            $message->subject('New Payment Received');
			
            $message->from($admin_email, 'Admin');

            $message->to($seller_email);

        }); 
		
		
		
		
		
		
	 
	  
		
		$datas = array('cid' => $cid,'txtid' => $txtid);
     return view('payu_success')->with($datas);
		
	
  }	
	
	
	
	
	
	
	
}

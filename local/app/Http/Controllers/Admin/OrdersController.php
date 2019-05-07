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

class OrdersController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);	
		
		
        $orders = DB::table('gig_order')
		                ->orderBy('id','desc')
					   ->get();
					   
		$orders_count = DB::table('gig_order')
		                ->orderBy('id','desc')
					   ->count();			   
					   

        return view('admin.orders', ['orders' => $orders, 'orders_count' => $orders_count, 'site_setting' => $site_setting]);
    }
	
	
	public function viewsindex()
    {
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);	
		
		
        $orders = DB::table('gig_order')
		                ->where('payment_level','=',2)
						->where('awaiting','=',1)
		                ->orderBy('id','desc')
					   ->get();
					   
		$orders_count = DB::table('gig_order')
		                ->where('payment_level','=',2)
						->where('awaiting','=',1)
		                ->orderBy('id','desc')
					   ->count();			   
					   

        return view('admin.approve_payment', ['orders' => $orders, 'orders_count' => $orders_count, 'site_setting' => $site_setting]);
    }
	
	
	
	
	
	
	public function request_index()
    {
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);	
		
		
        $orders = DB::table('gig_order')
		                ->orderBy('id','desc')
					   ->get();
					   
		$orders_count = DB::table('gig_order')
		                ->orderBy('id','desc')
					   ->count();			   
					   

        return view('admin.request-orders', ['orders' => $orders, 'orders_count' => $orders_count, 'site_setting' => $site_setting]);
    }
	
	
	
	
	
	
	
	public function views_request()
    {
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);	
		
		
        $orders = DB::table('gig_order')
		                ->where('payment_level','=',2)
						->where('awaiting','=',1)
		                ->orderBy('id','desc')
					   ->get();
					   
		$orders_count = DB::table('gig_order')
		                 ->where('payment_level','=',2)
						->where('awaiting','=',1)
		                ->orderBy('id','desc')
					   ->count();			   
					   

        return view('admin.approve_payment_request', ['orders' => $orders, 'orders_count' => $orders_count, 'site_setting' => $site_setting]);
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function approval_status($status,$order_id,$gig_user_id) 
	{
		
		DB::update('update gig_order set payment_level="3" where status="completed" and awaiting="1" and id = ?', [$order_id]);
		
		$view_gier = DB::table('gig_order')
					 ->where('id','=',$order_id)
					 ->get();
		$view_gier_cnt = DB::table('gig_order')
					 ->where('id','=',$order_id)
					 ->count();
					 
					 
					 
					 
					 
					 
					 
		$user = DB::table('users')
		       ->where('id','=',$view_gier[0]->user_id)
			   ->get();	

				
		

        $setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		
		$commission_mode = $setts[0]->commission_mode;
		$commission_amt = $setts[0]->commission_amt;
		$processing = $setts[0]->processing_fee;


        $vendor_id = $view_gier[0]->gig_user_id;
		$vendor_amount = $view_gier[0]->seller_price;
		
		
        $admin_id = 1;
		$admin_amount = $view_gier[0]->admin_price;
		
		
        $affiliate_id = $view_gier[0]->affiliate_id;
		$affiliate_amount = $view_gier[0]->affiliate_price;
		
   		
        
		
		$checkin_vendor = DB::table('available_balance')
		           ->where('user_id','=',$vendor_id)
				   ->count();
		
	    if(!empty($checkin_vendor))
		{
			
        $checkin_vendor_get = DB::table('available_balance')
		           ->where('user_id','=',$vendor_id)
				   ->get();	
         
        $old_value = $checkin_vendor_get[0]->amount;
        
        
		
        $total= $old_value + $vendor_amount;		
		
		DB::update('update available_balance set amount="'.$total.'" where user_id = ?', [$vendor_id]);
		}
		else
		{
		
			$total= $vendor_amount;
			
			
			DB::insert('insert into available_balance (user_id,amount) values (?, ?)', 
		[$vendor_id,$total]);
			
			
			
		}
		
		
		
		/***************** BONUS ****************/
		
		
		
		$check_bonus = DB::table('gig_order')
						->where('gig_user_id','=',$vendor_id)
						->where('payment_level','=',3)
						->where('status','=',"completed")
						->where('awaiting','=',1)
						->count();
		if(!empty($check_bonus))
		{
			
			$get_bouns = DB::table('gig_order')
						->where('gig_user_id','=',$vendor_id)
						->where('payment_level','=',3)
						->where('status','=',"completed")
						->where('awaiting','=',1)
						->get();
			$bonsprice=0;
			foreach($get_bouns as $bouns)
			{
			
			$bonsprice += $bouns->price;
			}
			
			$count_perform = DB::table('performance_bonus')
							->where('status','=',1)
							->where('sale_price','<',$bonsprice)
							->take(1)
							->orderBy('sale_price','desc')
							->get();
							
							
			/*$count_perform = DB::select("select * from performance_bonus where status = '1' and sale_price < '$bonsprice' order by sale_price desc limit 1");*/
			
            $today_date = date("Y-m-d");			
							
			foreach($count_perform as $perform)
			{
				$percengae = $perform->sale_percentage;
				
				$newerprice = $perform->sale_price;
				
				if($perform->sale_price < $bonsprice)
				{
					
					/*$commission_amount = ($percengae * $bonsprice) / 100;*/
					
					$commission_amount = ($percengae * $newerprice) / 100;
					
					$check_level = DB::table('bonus_level')
							        ->where('sale_percentage','=',$percengae)
									->where('user_id','=',$vendor_id)
									->count();
					if(empty($check_level))
					{
					DB::insert('insert into bonus_level (user_id,sale_price_reached,sale_percentage,sales_date,percentage_price) values (?, ?, ?, ?, ?)', [$vendor_id,$bonsprice, $percengae,$today_date,$commission_amount]);
					
					
					
					
					
					$checkin = DB::table('available_balance')
		           ->where('user_id','=',$vendor_id)
				   ->count();
		
					if(!empty($checkin))
					{
						
					$checkin_get = DB::table('available_balance')
							   ->where('user_id','=',$vendor_id)
							   ->get();	
					 
					$old_value = $checkin_get[0]->amount;
					
					

					$total= $old_value + $commission_amount;		
					
					DB::update('update available_balance set amount="'.$total.'" where user_id = ?', [$vendor_id]);
					}
					else
					{
					
						$total= $commission_amount;
						
						DB::insert('insert into available_balance (user_id,amount) values (?, ?)', 
					[$vendor_id,$total]);
						
						
						
					}
					
					
					
					
					
					
					
					
					}
					
					
					
					
					
					
				}
			}				
				
            
			
			
		}
		
		
		
		
		
		/************************* BONUS ***************/
		
		
		
		
		
		
		
		$first_time_cnt = DB::table('gig_order')
					     ->where('payment_level','=',3)
						 ->where('status','=',"completed")
						 ->where('awaiting','=',1)
						 ->where('user_id','=',$view_gier[0]->user_id)
						 ->where('affiliate_id','=',$view_gier[0]->affiliate_id)
					     ->count();
		
		
		if($first_time_cnt==1 && $first_time_cnt!=0)
		{
		$checkin_affiliate = DB::table('available_balance')
		           ->where('user_id','=',$affiliate_id)
				   ->count();
		
	    if(!empty($checkin_affiliate))
		{
			
        $checkin_affiliate_get = DB::table('available_balance')
		           ->where('user_id','=',$affiliate_id)
				   ->get();	
         
        $old_value = $checkin_affiliate_get[0]->amount;
        
        

        $total= $old_value + $affiliate_amount;		
		
		DB::update('update available_balance set amount="'.$total.'" where user_id = ?', [$affiliate_id]);
		}
		else
		{
		
			$total= $affiliate_amount;
			
			DB::insert('insert into available_balance (user_id,amount) values (?, ?)', 
		[$affiliate_id,$total]);
			
			
			
		}
		
		}
		else
		{
		
			DB::update('update gig_order set admin_price="'.$affiliate_amount.'",affiliate_price="0" where id = ?', [$order_id]);
		}
		
		
		
		
		
		
		
		
		
		
		
		$view_welldone = DB::table('gig_order')
					 ->where('id','=',$order_id)
					 ->get();
		
		
		$vendorr_amt = $view_welldone[0]->seller_price;
		$adminr_amt = $view_welldone[0]->admin_price;
		$affiliater_amt = $view_welldone[0]->affiliate_price;
		
		$get_vendor = DB::table('users')
						->where('id','=',$vendor_id)
						->count();
		if(!empty($get_vendor))
		{
			$get_vendor_price = DB::table('users')
						->where('id','=',$vendor_id)
						->get();
			$old_vendor_price = $get_vendor_price[0]->wallet;			
			$vendor_total_amount = $old_vendor_price + $vendorr_amt;
		
		
		DB::update('update users set wallet="'.$vendor_total_amount.'" where id = ?', [$vendor_id]);			
		}
		else
		{
			$old_vendor_price = 0;
			$vendor_total_amount = $old_vendor_price + $vendorr_amt;
		
		
		DB::update('update users set wallet="'.$vendor_total_amount.'" where id = ?', [$vendor_id]);
			
			
			
		}
		
		
		
		
		$get_admin = DB::table('users')
						->where('id','=',$admin_id)
						->count();
		if(!empty($get_admin))
		{
			$get_admin_price = DB::table('users')
						->where('id','=',$admin_id)
						->get();
			$old_admin_price = $get_admin_price[0]->wallet;	
           $admin_total_amount = $old_admin_price + $adminr_amt;
		
		DB::update('update users set wallet="'.$admin_total_amount.'" where id = ?', [$admin_id]);			
						
		}
		else
		{
			$old_admin_price = 0;
			$admin_total_amount = $old_admin_price + $adminr_amt;
		
		DB::update('update users set wallet="'.$admin_total_amount.'" where id = ?', [$admin_id]);
		}
		
		
		
		
		$get_affiliate = DB::table('users')
						->where('id','=',$affiliate_id)
						->count();
		if(!empty($get_affiliate))
		{
			$get_affiliate_price = DB::table('users')
						->where('id','=',$affiliate_id)
						->get();
			$old_affiliate_price = $get_affiliate_price[0]->wallet;
			
			
        $affiliate_total_amount = $old_affiliate_price + $affiliater_amt;
		
		DB::update('update users set wallet="'.$affiliate_total_amount.'" where id = ?', [$affiliate_id]);


            $affilit = $get_affiliate_price[0]->affiliate_commission;

             $affiliate_well = $affilit + $affiliater_amt;

           DB::update('update users set affiliate_commission="'.$affiliate_well.'" where id = ?', [$affiliate_id]);			 
						
		}
		else
		{
			$old_affiliate_price = 0;
			$affiliate_total_amount = $old_affiliate_price + $affiliater_amt;
		
		DB::update('update users set wallet="'.$affiliate_total_amount.'" where id = ?', [$affiliate_id]);
		
		
		
		
		
		$affilit = 0;

             $affiliate_well = $affilit + $affiliater_amt;

           DB::update('update users set affiliate_commission="'.$affiliate_well.'" where id = ?', [$affiliate_id]);	
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$site_currency = $setts[0]->site_currency;
		
		$gid = $view_gier[0]->gid;
		$gig_details = DB::table('gigs')
		         ->where('gid', '=', $gid)
		         ->get();
				 
		$reference_id = $view_gier[0]->reference_id;
		if(!empty($user[0]->name))
		{
		$username = $user[0]->name;
		}
		else
		{
			$username = "";
		}
		
		
		$useremail = $user[0]->email;
		$title = $gig_details[0]->subject;
		
		$commission_mode = $setts[0]->commission_mode;
		$commission_amt = $setts[0]->commission_amt;
		
		/*$subfee = $view_gier[0]->price - $processing;
		if($commission_mode=="percentage")
				   {
					   $commission_amount = ($commission_amt * $subfee) / 100;
				   }
				   if($commission_mode=="fixed")
				   {
					    if($subfee < $commission_amt)
						{
							$commission_amount = 0;
						}
						else
						{
							$commission_amount = $commission_amt;
						}
				   }
				   
		$sum =$subfee - $commission_amount;
				   
				   	   
		
		
		
		$get_price = $sum;
		
		*/
		
		$get_price = $vendor_amount;
		
		
		$payment_date = $view_gier[0]->payment_date;
		$payment_type = $view_gier[0]->payment_type;
		
		$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->first();
		
		$admin_email = $admindetails->email;
		
		Mail::send('admin.payment_approval_email', ['gid' => $gid, 'reference_id' => $reference_id, 'username' => $username,
		'title' => $title, 'get_price' => $get_price, 'site_currency' => $site_currency, 'payment_date' => $payment_date, 'payment_type' => $payment_type,
		'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url], function ($message) use ($useremail,$admin_email)
        {
            $message->subject('Your Payment Approved Successfully');
			
            $message->from($admin_email, 'Admin');

            $message->to($useremail);

        }); 
		
		
		
		if(!empty($affiliate_id))
		{
			
			$get_affiliate_email = DB::table('users')
						->where('id','=',$affiliate_id)
						->get();
						
			$affiliate_to = $get_affiliate_email[0]->email;			
			
			Mail::send('admin.affiliate_payment_email', ['gid' => $gid, 'reference_id' => $reference_id,  
		'title' => $title, 'affiliate_amount' => $affiliate_amount, 'site_currency' => $site_currency, 'payment_date' => $payment_date, 'payment_type' => $payment_type,
		'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url], function ($message) use ($affiliate_to,$admin_email)
        {
            $message->subject('Your Affiliate Commission Credited Successfully');
			
            $message->from($admin_email, 'Admin');

            $message->to($affiliate_to);

        });
			
		}
		
		
		
		
			return back();
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function status($sid,$id) 
	{
		
		DB::update('update gig_order set status="completed", upcoming_payment="1",payment_level="1" where id = ?', [$sid]);
		
		$view_gier = DB::table('gig_order')
					 ->where('id','=',$sid)
					 ->get();
		$view_gier_cnt = DB::table('gig_order')
					 ->where('id','=',$sid)
					 ->count();
					 
		$user = DB::table('users')
		       ->where('id','=',$view_gier[0]->user_id)
			   ->get();		 
		
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$gid = $view_gier[0]->gid;
		$gig_details = DB::table('gigs')
		         ->where('gid', '=', $gid)
		         ->get();
		
        if($gig_details[0]->job_type=="request")
		{			
		DB::update('update gigs set request_status="2" where gid = ?', [$gid]);		 
        }
		
		
		$reference_id = $view_gier[0]->reference_id;
		$username = $user[0]->name;
		$useremail = $user[0]->email;
		$title = $gig_details[0]->subject;
		$get_price = $view_gier[0]->price;
		$payment_date = $view_gier[0]->payment_date;
		$payment_type = $view_gier[0]->payment_type;
		
		
		$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->first();
		
		$admin_email = $admindetails->email;
		
		Mail::send('admin.order_created_email', ['gid' => $gid, 'reference_id' => $reference_id, 'username' => $username,
		'title' => $title, 'get_price' => $get_price, 'payment_date' => $payment_date, 'payment_type' => $payment_type,
		'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url], function ($message) use ($useremail,$admin_email)
        {
            $message->subject('Job Order Created Successfully');
			
            $message->from($admin_email, 'Admin');

            $message->to($useremail);

        }); 
		
		
		
		
			return back();
		
	}
	
	
	public function destroy($id) {
		
		
      DB::delete('delete from gig_order where id = ?',[$id]);
	   
      return back();
      
   }
   
   
   
   
   
   
	
}
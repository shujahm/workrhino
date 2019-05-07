<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Mail;
use Auth;
use Crypt;
use URL;

class SalesController extends Controller
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
	 public function __construct()
    {
       $this->middleware('auth');
    }
	
	
	public function view_revenues()
	{
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		
		
		$user_id = Auth::user()->id;
		
		
		$gig_available = DB::table('gig_order')
		           
				   ->where('user_id','=',$user_id)
				  ->where('status','=','completed')
				   ->orderBy('id', 'desc')
				   ->get();
				   
		$gig_available_cnt = DB::table('gig_order')
		           
				   ->where('user_id','=',$user_id)
				  ->where('status','=','completed')
				  ->orderBy('id', 'desc')
				   ->count();
		
		
		$gig_active_cnt = DB::table('gig_order')
		           
				   ->where('user_id','=',$user_id)
				  ->where('payment_level','=',1)
				   ->count();


         $view_revenues = DB::table('revenues')
		           
				   ->where('user_id','=',$user_id)
				  ->where('revenues_status','=','completed')
				  ->where('revenues_type','=','buyer_balance')
				   ->orderBy('rwid', 'desc')
				   ->get();		   
		
		$view_revenues_cnt = DB::table('revenues')
		           
				   ->where('user_id','=',$user_id)
				  ->where('revenues_status','=','completed')
				  ->where('revenues_type','=','buyer_balance')
				   ->orderBy('rwid', 'desc')
				   ->count();				   
		
		$data = array('site_setting' => $site_setting, 'gig_active_cnt' => $gig_active_cnt, 'view_revenues' => $view_revenues, 'view_revenues_cnt' => $view_revenues_cnt, 'gig_available_cnt' => $gig_available_cnt, 
		'gig_available' => $gig_available );
            return view('revenues')->with($data);
	}
	
	
	 
    public function view_sales()
    {
       
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		
		$commission_mode = $site_setting[0]->commission_mode;
		$commission_amt = $site_setting[0]->commission_amt;
		
		$processing = $site_setting[0]->processing_fee;
		
		$user_id = Auth::user()->id;
		
		
		
		
		
		/*********** FIRST **********/
		
		
		$check = DB::table('gigs')
		           ->leftJoin('gig_order', 'gigs.gid', '=', 'gig_order.gid')
				   ->leftJoin('users', 'users.id', '=', 'gigs.giger_id')
				   ->where('users.id','=',$user_id)
				   ->where('gig_order.payment_level','=',1)
				   ->where('gig_order.amount_by','=',"")
				   ->where('gig_order.status','=','completed')
				   ->count();
		
		if(!empty($check))
		{
			$sum_available = DB::table('gigs')
		           ->leftJoin('gig_order', 'gigs.gid', '=', 'gig_order.gid')
				   ->leftJoin('users', 'users.id', '=', 'gigs.giger_id')
				   ->where('users.id','=',$user_id)
				   ->where('gig_order.payment_level','=',1)
				   ->where('gig_order.amount_by','=',"")
				   ->where('gig_order.status','=','completed')
				   ->get();
				   $sum=0;
				   foreach($sum_available as $sumvalue){

                   $sumfee = $sumvalue->price - $processing;   
				   
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
				   
				   $valuesum = $sumfee - $commission_amount;
				   
				   /*$sum +=$sumfee - $commission_amount; */
				   
				   
				   if(!empty($sumvalue->coupon_by))
				   {
					   if($sumvalue->coupon_user == "vendor")
					   {
				         $sum += $valuesum - $sumvalue->coupon_commission;
					   }
					   else if($sumvalue->coupon_user == "admin")
					   {
						   $sum += $valuesum;
					   }
					   
				   }
				   else
				   {
					   $sum += $valuesum;
				   }
				   
				   
				   }
				   
				   
				   
				   
					   $sumvalue_one = $sum;
				   
				   
		}
		else
		{
			$sumvalue_one = 0;
		}
		
		
		
		/*********** SECOND ************/
		
		
		$check_two = DB::table('gigs')
		           ->leftJoin('gig_order', 'gigs.gid', '=', 'gig_order.gid')
				   ->leftJoin('users', 'users.id', '=', 'gigs.giger_id')
				   ->where('users.id','=',$user_id)
				   ->where('gig_order.payment_level','=',2)
				   ->where('gig_order.awaiting','!=',1)
				   ->where('gig_order.amount_by','=',"")
				   ->where('gig_order.status','=','completed')
				   ->count();
		
		if(!empty($check_two))
		{
			$sum_available_two = DB::table('gigs')
		           ->leftJoin('gig_order', 'gigs.gid', '=', 'gig_order.gid')
				   ->leftJoin('users', 'users.id', '=', 'gigs.giger_id')
				   ->where('users.id','=',$user_id)
				   ->where('gig_order.payment_level','=',2)
				   ->where('gig_order.awaiting','!=',1)
				   ->where('gig_order.amount_by','=',"")
				   ->where('gig_order.status','=','completed')
				   ->get();
				   $sum=0;
				   foreach($sum_available_two as $sumvalue){ 
				   
				   $sumfee = $sumvalue->price - $processing;
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
				   
				   
				   
				   
				   
				   
				   $valuesum = $sumfee - $commission_amount;
				   
				   /*$sum +=$sumfee - $commission_amount; */
				   
				   
				   if(!empty($sumvalue->coupon_by))
				   {
					   if($sumvalue->coupon_user == "vendor")
					   {
				         $sum += $valuesum - $sumvalue->coupon_commission;
					   }
					   else if($sumvalue->coupon_user == "admin")
					   {
						   $sum += $valuesum;
					   }
					   
				   }
				   else
				   {
					   $sum += $valuesum;
				   }
				   
				   
				   
				   
				   
				   }
				   
				   
				   
				   
					   $sumvalue_two = $sum;
				   
				   
				   
				   
				   
				   
		}
		else
		{
			$sumvalue_two = 0;
		}
		
		
		/**************** THIRD *****************/
		
		
		
		
		$check_third = DB::table('gigs')
		           ->leftJoin('gig_order', 'gigs.gid', '=', 'gig_order.gid')
				   ->leftJoin('users', 'users.id', '=', 'gigs.giger_id')
				   ->where('users.id','=',$user_id)
				   ->where('gig_order.payment_level','=',2)
				    ->where('gig_order.awaiting','=',1)
				   ->where('gig_order.amount_by','=',"")
				   ->where('gig_order.status','=','completed')
				   ->count();
		
		if(!empty($check_third))
		{
			$sum_available_third = DB::table('gigs')
		           ->leftJoin('gig_order', 'gigs.gid', '=', 'gig_order.gid')
				   ->leftJoin('users', 'users.id', '=', 'gigs.giger_id')
				   ->where('users.id','=',$user_id)
				   ->where('gig_order.payment_level','=',2)
				   ->where('gig_order.awaiting','=',1)
				   ->where('gig_order.amount_by','=',"")
				   ->where('gig_order.status','=','completed')
				   ->get();
				   $sum=0;
				   foreach($sum_available_third as $sumvalue){ 
				   $sumfee = $sumvalue->price - $processing;
				   
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
				   
				    
				   
				   
				   
				   $valuesum = $sumfee - $commission_amount;
				   
				   /*$sum +=$sumfee - $commission_amount; */
				   
				   
				   if(!empty($sumvalue->coupon_by))
				   {
					   if($sumvalue->coupon_user == "vendor")
					   {
				         $sum += $valuesum - $sumvalue->coupon_commission;
					   }
					   else if($sumvalue->coupon_user == "admin")
					   {
						   $sum += $valuesum;
					   }
					   
				   }
				   else
				   {
					   $sum += $valuesum;
				   }
				   
				   				   
				   }
				   
				  
				   
				   $sumvalue_third = $sum;
				   
				   
				   
				   
				   
				   
		}
		else
		{
			$sumvalue_third = 0;
		}
		
		
		
		
		/*************** FOURTH **************/
		
		
		
		
		$check_four = DB::table('gigs')
		           ->leftJoin('gig_order', 'gigs.gid', '=', 'gig_order.gid')
				   ->leftJoin('users', 'users.id', '=', 'gigs.giger_id')
				   ->where('users.id','=',$user_id)
				   ->where('gig_order.payment_level','=',3)
				    ->where('gig_order.awaiting','=',1)
					->where('gig_order.withdraw','=',"")
				   ->where('gig_order.amount_by','=',"")
				   ->where('gig_order.status','=','completed')
				   ->count();
		
		if(!empty($check_four))
		{
			$sum_available_four = DB::table('gigs')
		           ->leftJoin('gig_order', 'gigs.gid', '=', 'gig_order.gid')
				   ->leftJoin('users', 'users.id', '=', 'gigs.giger_id')
				   ->where('users.id','=',$user_id)
				   ->where('gig_order.payment_level','=',3)
				   ->where('gig_order.awaiting','=',1)
				   ->where('gig_order.withdraw','=',"")
				   ->where('gig_order.amount_by','=',"")
				   ->where('gig_order.status','=','completed')
				   ->get();
				   $sum=0;
				   foreach($sum_available_four as $sumvalue){
                   $sumfee = $sumvalue->price - $processing;					   
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
				   
				   
				   
				   
				   
				   $valuesum = $sumfee - $commission_amount;
				   
				   /*$sum +=$sumfee - $commission_amount; */
				   
				   
				   if(!empty($sumvalue->coupon_by))
				   {
					   if($sumvalue->coupon_user == "vendor")
					   {
				         $sum += $valuesum - $sumvalue->coupon_commission;
					   }
					   else if($sumvalue->coupon_user == "admin")
					   {
						   $sum += $valuesum;
					   }
					   
				   }
				   else
				   {
					   $sum += $valuesum;
				   }
				   
				   
				   
				   
				   
				   
				   }
				   
				   
				   
				$sumvalue_four = $sum;
				   
				   
				   
				   
				   
				   
		}
		else
		{
			$sumvalue_four = 0;
		}
		
		
		$get_purchase_count = DB::table('gig_order')
                       ->where('user_id','=',$user_id)
					   ->where('payment_type','=','seller_balance')
					   ->where('status','=','completed')
					   ->orderBy('id','desc')
					   ->count();
					   
		$get_purchase_get = DB::table('gig_order')
                       ->where('user_id','=',$user_id)
					   ->where('payment_type','=','seller_balance')
					   ->where('status','=','completed')
					   ->orderBy('id','desc')
					   ->get();		
		
		
		$checkin = DB::table('available_balance')
		           ->where('user_id','=',$user_id)
				   ->count();
		$checkin_get = DB::table('available_balance')
		           ->where('user_id','=',$user_id)
				   ->get();		   
				   
		if(!empty($get_purchase_count))
		{
			$balance = $get_purchase_get[0]->price;
		}
        else
		{
			$balance = 0;
		}			
				   
				   
				   
		/*if(empty($checkin))
		{
			$value = $sumvalue_four - $balance;
			DB::insert('insert into available_balance (user_id,amount) values (?, ?)', [$user_id, $value]);
		}
		else
		{
			$value = $checkin_get[0]->amount - $balance;
			DB::update('update available_balance set amount="'.$value.'" where user_id = ?', [$user_id]);
		}*/	
		
		
		/*************** FIFTH **************/
		
		$check_five_count = DB::table('withdraw')
		              ->where('withdraw_status','=','completed')
		              ->where('user_id','=',$user_id)
					  ->count();
		if(!empty($check_five_count))
		{
		$check_five = DB::table('withdraw')
		              ->where('withdraw_status','=','completed')
		              ->where('user_id','=',$user_id)
					  ->get();
					  
					$price_value=0;
                    foreach($check_five as $five)
                    {
						$price_value +=$five->total_amount;
					}						
		}
		else
		{
			$price_value = 0;
		}
		
		
		
		$check_counter = DB::table('gigs')
		           ->leftJoin('gig_order', 'gigs.gid', '=', 'gig_order.gid')
				   ->leftJoin('users', 'users.id', '=', 'gigs.giger_id')
				   ->where('users.id','=',$user_id)
				   ->where('gig_order.payment_level','=',3)
				    ->where('gig_order.awaiting','=',1)
					->where('gig_order.withdraw','=',"")
				   ->where('gig_order.amount_by','=',"")
				   ->where('gig_order.status','=','completed')
				   ->count();
				   
				   
			   
				   
		$view_revenues_new = DB::table('revenues')
		           
				   ->where('user_id','=',$user_id)
				  ->where('revenues_status','=','completed')
				  ->where('revenues_type','=','seller_balance')
				   ->orderBy('rwid', 'desc')
				   ->get();		   
		
		$view_revenues_cnt_new = DB::table('revenues')
		           
				   ->where('user_id','=',$user_id)
				  ->where('revenues_status','=','completed')
				  ->where('revenues_type','=','seller_balance')
				   ->orderBy('rwid', 'desc')
				   ->count();		   
				   
		
		
		
		/****************** AGAIN **************/
		
		
		$check_again = DB::table('gigs')
		           ->leftJoin('gig_order', 'gigs.gid', '=', 'gig_order.gid')
				   ->leftJoin('users', 'users.id', '=', 'gigs.giger_id')
				   ->where('users.id','=',$user_id)
				   ->where('gig_order.payment_level','=',3)
				    ->where('gig_order.awaiting','=',1)
					
				   ->where('gig_order.amount_by','=',"")
				   ->where('gig_order.status','=','completed')
				   ->count();
		
		if(!empty($check_again))
		{
			$sum_available_four_again = DB::table('gigs')
		           ->leftJoin('gig_order', 'gigs.gid', '=', 'gig_order.gid')
				   ->leftJoin('users', 'users.id', '=', 'gigs.giger_id')
				   ->where('users.id','=',$user_id)
				   ->where('gig_order.payment_level','=',3)
				   ->where('gig_order.awaiting','=',1)
				   
				   ->where('gig_order.amount_by','=',"")
				   ->where('gig_order.status','=','completed')
				   ->get();
				   $sum=0;
				   foreach($sum_available_four_again as $sumvalue){
                   $sumfee = $sumvalue->price - $processing;
				   
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
				   
				   $sum +=$sumfee - $commission_amount; }
				   
				   $sumvalue_four_again = $sum;
				   
		}
		else
		{
			$sumvalue_four_again = 0;
		}
		
		
		$withor_count = DB::table('withdraw')
		                ->where('user_id','=',Auth::user()->id)
		                    
							->count();
		
	
		$data = array('site_setting' => $site_setting, 'check' => $check, 'sumvalue_one' => $sumvalue_one, 'check_two' => $check_two, 'sumvalue_two' => $sumvalue_two, 'check_third' => $check_third, 'sumvalue_third' => $sumvalue_third, 'check_four' => $check_four, 'check_again' => $check_again, 'sumvalue_four_again' => $sumvalue_four_again, 'sumvalue_four' => $sumvalue_four, 'check_counter' => $check_counter, 'check_five_count' => $check_five_count, 'price_value' => $price_value, 'view_revenues_new' => $view_revenues_new, 'view_revenues_cnt_new' => $view_revenues_cnt_new, 'user_id' => $user_id, 'get_purchase_get' => $get_purchase_get, 'get_purchase_count' => $get_purchase_count, 'checkin' => $checkin, 'checkin_get' => $checkin_get, 'withor_count' => $withor_count);
            return view('sales')->with($data);
    }
	
	
	
	
	public function type_withdraw($action,$type,$price)
	{
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		$user_id = Auth::user()->id;
		
		
		$commission_mode = $site_setting[0]->commission_mode;
		$commission_amt = $site_setting[0]->commission_amt;
		
		$processing = $site_setting[0]->processing_fee;
		
		$check_four = DB::table('gigs')
		           ->leftJoin('gig_order', 'gigs.gid', '=', 'gig_order.gid')
				   ->leftJoin('users', 'users.id', '=', 'gigs.giger_id')
				   ->where('users.id','=',$user_id)
				   ->where('gig_order.payment_level','=',3)
				    ->where('gig_order.awaiting','=',1)
					->where('gig_order.withdraw','=',"")
				   ->where('gig_order.amount_by','=',"")
				   ->where('gig_order.status','=','completed')
				   ->count();
		
		if(!empty($check_four))
		{
			$sum_available_four = DB::table('gigs')
		           ->leftJoin('gig_order', 'gigs.gid', '=', 'gig_order.gid')
				   ->leftJoin('users', 'users.id', '=', 'gigs.giger_id')
				   ->where('users.id','=',$user_id)
				   ->where('gig_order.payment_level','=',3)
				   ->where('gig_order.awaiting','=',1)
				   ->where('gig_order.withdraw','=',"")
				   ->where('gig_order.amount_by','=',"")
				   ->where('gig_order.status','=','completed')
				   ->get();
				   $sum=0;
				   foreach($sum_available_four as $sumvalue){
                   $sumfee = $sumvalue->price - $processing;					   
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
				   
				   $sum +=$sumfee - $commission_amount; }
				   
				   $sumvalue_four = $sum;
				   
		}
		else
		{
			$sumvalue_four = 0;
		}
		
		
		$checkin = DB::table('available_balance')
		           ->where('user_id','=',$user_id)
				   ->count();
		
		if(!empty($checkin))
		{
			$checkin_get = DB::table('available_balance')
					   ->where('user_id','=',Auth::user()->id)
					   ->get();
					   
			$ava_value = $checkin_get[0]->amount;		   
		}
		else
		{
			$ava_value = $sumvalue_four;
		}
		
		
		$check_counter = DB::table('gigs')
		           ->leftJoin('gig_order', 'gigs.gid', '=', 'gig_order.gid')
				   ->leftJoin('users', 'users.id', '=', 'gigs.giger_id')
				   ->where('users.id','=',$user_id)
				   ->where('gig_order.payment_level','=',3)
				    ->where('gig_order.awaiting','=',1)
					->where('gig_order.withdraw','=',"")
				   ->where('gig_order.amount_by','=',"")
				   ->where('gig_order.status','=','completed')
				   ->count();
		
		
           $limit = $site_setting[0]->enable_withdraw_limit;
		    if($limit > $ava_value)
			{		
		        /*$errr = "Error: Minimum Withdraw Amount is ".$limit." ".$site_setting[0]->site_currency;*/
				
				
				$errr = "Your balance is lower than minimum withdraw amount";
				return redirect()->back()->with('error', $errr);
			}
			else
			{
		
				$user_count = DB::table('users')
									->where('id','=',$user_id)
									->count();
				
				$user_paypal = DB::table('users')
									->where('id','=',$user_id)
									->get();
									
				$total_amount = base64_decode($price);	


				$url = URL::to("/");
				
				$site_logo=$url.'/local/images/settings/'.$site_setting[0]->site_logo;
				
				$site_name = $site_setting[0]->site_name;
				
				$currency = $site_setting[0]->site_currency;
				
				$user_email = $user_paypal[0]->email;
				$username = $user_paypal[0]->name;
				
				
				$month = date("F");
				$year  = date("Y");
				
				$vewndate = date("Y-m-d");
				
				$aid=1;
				$admindetails = DB::table('users')
				 ->where('id', '=', $aid)
				 ->first();
				
				$admin_email = $admindetails->email;
						
									
				if($type=="paypal")
				{
					$err_msg = "Error: Please set your Paypal e-mail address on the settings page";
				}
				if($type=="localbank")
				{
					$err_msg = "Error: Please set your bank details on the settings page";
				}

				 $bank_details = $user_paypal[0]->bank_details;		
				 $paypal_details = $user_paypal[0]->paypal_email;
				 
				 $token = uniqid();
				 
				 
				 
				$checkin = DB::table('available_balance')
						   ->where('user_id','=',$user_id)
						   ->count();
			
				
					if(!empty($checkin))
					{
					DB::update('update available_balance set amount="'.$total_amount.'" where user_id = ?', [$user_id]);
					}
					else
					{
						DB::insert('insert into available_balance (user_id,amount) values (?, ?)', [$user_id, $total_amount]);
					}
					
				 
		 
					 
							 
					if(!empty($user_count))
					{
						if($type=="paypal")
						{
						
							if(!empty($user_paypal[0]->paypal_email))
							{
								
								
								$available = DB::table('gig_order')
								   ->where('gig_user_id','=',$user_id)
								   ->where('payment_level','=',3)
								   ->where('awaiting','=',1)
								   ->where('amount_by','=',"")
								   ->where('status','=','completed')
								   ->get();
								   
							   foreach($available as $looper)
							   {
								   DB::update('update gig_order set withdraw="'.$type.'",withdraw_token="'.$token.'" where id = ?', [$looper->id]);
								   
								   
							   }
							   
							   $pending = "pending";
							  /* $withdraw_check = DB::table('withdraw')
								   ->where('total_amount','=',"'".$total_amount."'")
								   ->where('user_id','=',"'".$user_id."'")
								   ->where('withdraw_type','=',"'".$type."'")
								   ->where('withdraw_statuss','=',"'".$pending."'")
								   ->count();
								   
								   
								   $withdrawa = DB::select("select * from withdraw where total_amount = '$total_amount' and user_id = '$user_id' and withdraw_type = '$type' and withdraw_status = '$pending'");   
								   $withdraw_check = count($withdrawa);
								   */
								   
								$withdrawa = DB::select("select * from withdraw where total_amount = '$total_amount' and user_id = '$user_id' and withdraw_type = '$type' and withdraw_status = '$pending'");   
								   $withdraw_check = count($withdrawa);
								   
							   
							    if(empty($withdraw_check))
								   {
							   
							   DB::insert('insert into withdraw (user_id,withdraw_token,total_amount,withdraw_type,paypal_id,withdraw_date,withdraw_month,	withdraw_year,withdraw_status) values (?,?,?,?,?,?,?,?,?)', [$user_id,$token,$total_amount,$type,$paypal_details,$vewndate,$month,$year,'pending']);
							   
							   $get_less = DB::table('available_balance')
								           ->where('user_id','=',$user_id)
										   ->get();
							   
							   $less_amount = $get_less[0]->amount - $total_amount;
							   
							   $reduce = DB::update('update available_balance set amount="'.$less_amount.'" where user_id = ?', [$user_id]);
							   
							   
							   
							   $datas = [
						'username' => $username, 'token' => $token, 'total_amount' => $total_amount, 'type' => $type, 'paypal_details' => $paypal_details, 'bank_details' => $bank_details, 'currency' => $currency, 'site_logo' => $site_logo, 'site_name' => $site_name
					];
					
					
					
					
					Mail::send('admin.withdraw_request_mail', $datas , function ($message) use ($admin_email,$user_email,$username)
					{
						$message->subject('Withdrawal Request');
						
							
						 $message->from($admin_email,'Admin');

						$message->to($admin_email);
						

					});
				   
				
							   
							return redirect()->back()->with('success', 'Success: Your withdrawal request has been received.');
							
							} else { return redirect()->back()->with('error', "Already withdraw request has been sent."); } }
						else
						{
							return redirect()->back()->with('error', $err_msg);
						}
					}
					
			
			
			
			
			
			
			if($type=="localbank")
			{
				
				if(!empty($user_paypal[0]->bank_details))
				{
					
					
					$available = DB::table('gig_order')
					   ->where('gig_user_id','=',$user_id)
					   ->where('payment_level','=',3)
					   ->where('awaiting','=',1)
					   ->where('amount_by','=',"")
					   ->where('status','=','completed')
					   ->get();
					   
				   foreach($available as $looper)
				   {
					   DB::update('update gig_order set withdraw="'.$type.'",withdraw_token="'.$token.'" where id = ?', [$looper->id]);
					   
					   
				   }
				  DB::insert('insert into withdraw (user_id,withdraw_token,total_amount,withdraw_type,bank_details,withdraw_date,withdraw_month,	withdraw_year,withdraw_status) values (?,?,?,?,?,?,?,?,?)', [$user_id,$token,$total_amount,$type,$bank_details,$vewndate,$month,$year,'pending']); 
				  
				  
				  $datas = [
            'username' => $username, 'token' => $token, 'total_amount' => $total_amount, 'type' => $type, 'paypal_details' => $paypal_details, 'bank_details' => $bank_details, 'currency' => $currency, 'site_logo' => $site_logo, 'site_name' => $site_name
        ];
		
		
		
		
		Mail::send('admin.withdraw_request_mail', $datas , function ($message) use ($admin_email,$user_email,$username)
        {
            $message->subject('Withdrawal Request');
			
            	
			 $message->from($admin_email,'Admin');

            $message->to($admin_email);
			

        });
				  
					   
					return redirect()->back()->with('success', 'Success: Your withdrawal request has been received.');
					
				}
				else
				{
					return redirect()->back()->with('error', $err_msg);
				}
				
				
			}
			
			
		}
		else
		{
			return back();
		}
		
		
		return back();
			}
			
		
			
		
		
		
		
		
		
		
		
	}
	
	
	
	
	
	
	
	
	public function buyer_track($order_id)
	{
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		$user_id = Auth::user()->id;
		$gig_order_status = DB::table('gig_order')
		                    ->where('user_id','=',$user_id)
							->where('id','=',$order_id)
				            ->get();
		$gig_order_count = DB::table('gig_order')
		                    ->where('user_id','=',$user_id)
							->where('id','=',$order_id)
				            ->count();
							
				$gig_details = DB::table('gigs')
								->where('gid','=',$gig_order_status[0]->gid)
								->get();			
				$gig_details_cnt = DB::table('gigs')
								->where('gid','=',$gig_order_status[0]->gid)
								->count();			
				$giger_img = DB::table('gig_images')
				->where('token', '=', $gig_details[0]->token)
				->get();
				$giger_cnt = DB::table('gig_images')
				->where('token', '=', $gig_details[0]->token)
				->count();			
		
		$data = array('site_setting' => $site_setting, 'gig_order_count' => $gig_order_count, 
		'gig_order_status' => $gig_order_status, 'gig_details_cnt' => $gig_details_cnt, 'gig_details' => $gig_details,
		'giger_img' => $giger_img, 'giger_cnt' => $giger_cnt);
	    return view('buyer_track')->with($data);
	}
	
	
	
	
	
	
	
	
	public function seller_track($order_id)
	{
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		$user_id = Auth::user()->id;
		$gig_order_status = DB::table('gig_order')
		                    ->where('gig_user_id','=',$user_id)
							->where('id','=',$order_id)
				            ->get();
		$gig_order_count = DB::table('gig_order')
		                    ->where('gig_user_id','=',$user_id)
							->where('id','=',$order_id)
				            ->count();
							
				$gig_details = DB::table('gigs')
								->where('gid','=',$gig_order_status[0]->gid)
								->get();			
				$gig_details_cnt = DB::table('gigs')
								->where('gid','=',$gig_order_status[0]->gid)
								->count();			
				$giger_img = DB::table('gig_images')
				->where('token', '=', $gig_details[0]->token)
				->get();
				$giger_cnt = DB::table('gig_images')
				->where('token', '=', $gig_details[0]->token)
				->count();			
		
		$data = array('site_setting' => $site_setting, 'gig_order_count' => $gig_order_count, 
		'gig_order_status' => $gig_order_status, 'gig_details_cnt' => $gig_details_cnt, 'gig_details' => $gig_details,
		'giger_img' => $giger_img, 'giger_cnt' => $giger_cnt);
	    return view('seller_track')->with($data);
		
		
	}
	
	
	
	
	public function view_my_shopping()
    {
	$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		$user_id = Auth::user()->id;
		
		
		$gig_available = DB::table('gig_order')
		           
				   ->where('user_id','=',$user_id)
				  ->where('status','=','completed')
				   ->orderBy('id', 'desc')
				   ->get();
				   
		$gig_available_cnt = DB::table('gig_order')
		           
				   ->where('user_id','=',$user_id)
				  ->where('status','=','completed')
				  ->orderBy('id', 'desc')
				   ->count();
		
		
		$gig_active_cnt = DB::table('gig_order')
		           
				   ->where('user_id','=',$user_id)
				  ->where('payment_level','=',1)
				   ->count();	
		$gig_cancel_cnt = DB::table('gig_order')
		           
				   ->where('user_id','=',$user_id)
				  ->where('payment_level','=',4)
				   ->count();
				   
		$gig_completed_cnt = DB::table('gig_order')
		           
				   ->where('user_id','=',$user_id)
				  ->where('payment_level','=',2)
				   ->count();

        $gig_delivered_cnt = DB::table('gig_order')
		           
				   ->where('user_id','=',$user_id)
				  ->where('payment_level','=',3)
				  
				   ->count();
				   
				   
			$view_revenues = DB::table('revenues')
		           
				   ->where('user_id','=',$user_id)
				  ->where('revenues_status','=','completed')
				  ->where('revenues_type','=','buyer_balance')
				   ->orderBy('rwid', 'desc')
				   ->get();		   
		
		$view_revenues_cnt = DB::table('revenues')
		           
				   ->where('user_id','=',$user_id)
				  ->where('revenues_status','=','completed')
				  ->where('revenues_type','=','buyer_balance')
				   ->orderBy('rwid', 'desc')
				   ->count();	   
				   
				   
				   
				   
				   
		$data = array('site_setting' => $site_setting, 'gig_available_cnt' => $gig_available_cnt, 
		'gig_available' => $gig_available, 'gig_active_cnt' => $gig_active_cnt, 'gig_cancel_cnt' => $gig_cancel_cnt, 'gig_completed_cnt' => $gig_completed_cnt, 'gig_delivered_cnt' => $gig_delivered_cnt, 'view_revenues' => $view_revenues, 'view_revenues_cnt' => $view_revenues_cnt);
		return view('my_shopping')->with($data);
	}	
	
	
	
	
	
	
	
	
	
	
	public function view_my_client_shopping()
    {
	$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		$user_id = Auth::user()->id;
		
		
		$gig_available = DB::table('gig_order')
		           
				   ->where('user_id','=',$user_id)
				  ->where('status','=','completed')
				   ->orderBy('id', 'desc')
				   ->get();
				   
		$gig_available_cnt = DB::table('gig_order')
		           
				   ->where('user_id','=',$user_id)
				  ->where('status','=','completed')
				  ->orderBy('id', 'desc')
				   ->count();
		
		
		$gig_active_cnt = DB::table('gig_order')
		           
				   ->where('user_id','=',$user_id)
				  ->where('payment_level','=',1)
				   ->count();	
		$gig_cancel_cnt = DB::table('gig_order')
		           
				   ->where('user_id','=',$user_id)
				  ->where('payment_level','=',4)
				   ->count();
				   
		$gig_completed_cnt = DB::table('gig_order')
		           
				   ->where('user_id','=',$user_id)
				  ->where('payment_level','=',2)
				   ->count();

        $gig_delivered_cnt = DB::table('gig_order')
		           
				   ->where('user_id','=',$user_id)
				  ->where('payment_level','=',3)
				  
				   ->count();
				   
				   
			$view_revenues = DB::table('revenues')
		           
				   ->where('user_id','=',$user_id)
				  ->where('revenues_status','=','completed')
				  ->where('revenues_type','=','buyer_balance')
				   ->orderBy('rwid', 'desc')
				   ->get();		   
		
		$view_revenues_cnt = DB::table('revenues')
		           
				   ->where('user_id','=',$user_id)
				  ->where('revenues_status','=','completed')
				  ->where('revenues_type','=','buyer_balance')
				   ->orderBy('rwid', 'desc')
				   ->count();	   
				   
				   
				   
				   
				   
		$data = array('site_setting' => $site_setting, 'gig_available_cnt' => $gig_available_cnt, 
		'gig_available' => $gig_available, 'gig_active_cnt' => $gig_active_cnt, 'gig_cancel_cnt' => $gig_cancel_cnt, 'gig_completed_cnt' => $gig_completed_cnt, 'gig_delivered_cnt' => $gig_delivered_cnt, 'view_revenues' => $view_revenues, 'view_revenues_cnt' => $view_revenues_cnt);
		return view('my_client_request')->with($data);
	}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	 public function view_manage_sales()
    {
	$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		$user_id = Auth::user()->id;
		
		$gig_available = DB::table('gig_order')
		           
				   ->where('gig_user_id','=',$user_id)
				  ->where('status','=','completed')
				    ->orderBy('id', 'desc')
				   ->get();
				   
		$gig_available_cnt = DB::table('gig_order')
		           
				   ->where('gig_user_id','=',$user_id)
				  ->where('status','=','completed')
				   ->orderBy('id', 'desc')
				   ->count();


        
				   
		$gig_active_cnt = DB::table('gig_order')
		           
				   ->where('gig_user_id','=',$user_id)
				  ->where('payment_level','=',1)
				   ->count();	
				   
		$gig_cancel_cnt = DB::table('gig_order')
		           
				   ->where('gig_user_id','=',$user_id)
				  ->where('payment_level','=',4)
				   ->count();	

        $gig_completed_cnt = DB::table('gig_order')
		           
				   ->where('gig_user_id','=',$user_id)
				  ->where('payment_level','=',2)
				  
				   ->count();	

        $gig_delivered_cnt = DB::table('gig_order')
		           
				   ->where('gig_user_id','=',$user_id)
				  ->where('payment_level','=',3)
				  
				   ->count();
				   
		
		$data = array('site_setting' => $site_setting, 'gig_available_cnt' => $gig_available_cnt, 
		'gig_available' => $gig_available, 'gig_active_cnt' => $gig_active_cnt, 'gig_cancel_cnt' => $gig_cancel_cnt, 'gig_completed_cnt' => $gig_completed_cnt, 'gig_delivered_cnt' => $gig_delivered_cnt);
	return view('manage_sales')->with($data);
	
	}
	
	
	
	
	
	
	
	
	
	public function view_freelancer_manage_sales()
    {
	$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		$user_id = Auth::user()->id;
		
		$gig_available = DB::table('gig_order')
		           
				   ->where('gig_user_id','=',$user_id)
				  ->where('status','=','completed')
				    ->orderBy('id', 'desc')
				   ->get();
				   
		$gig_available_cnt = DB::table('gig_order')
		           
				   ->where('gig_user_id','=',$user_id)
				  ->where('status','=','completed')
				   ->orderBy('id', 'desc')
				   ->count();


        
				   
		$gig_active_cnt = DB::table('gig_order')
		           
				   ->where('gig_user_id','=',$user_id)
				  ->where('payment_level','=',1)
				   ->count();	
				   
		$gig_cancel_cnt = DB::table('gig_order')
		           
				   ->where('gig_user_id','=',$user_id)
				  ->where('payment_level','=',4)
				   ->count();	

        $gig_completed_cnt = DB::table('gig_order')
		           
				   ->where('gig_user_id','=',$user_id)
				  ->where('payment_level','=',2)
				  
				   ->count();	

        $gig_delivered_cnt = DB::table('gig_order')
		           
				   ->where('gig_user_id','=',$user_id)
				  ->where('payment_level','=',3)
				  
				   ->count();
				   
		
		$data = array('site_setting' => $site_setting, 'gig_available_cnt' => $gig_available_cnt, 
		'gig_available' => $gig_available, 'gig_active_cnt' => $gig_active_cnt, 'gig_cancel_cnt' => $gig_cancel_cnt, 'gig_completed_cnt' => $gig_completed_cnt, 'gig_delivered_cnt' => $gig_delivered_cnt);
	return view('my_freelancer_request')->with($data);
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function seller_cancel($chat_id,$order_id,$status)
	{
		
		DB::update('update chat_message set mutual_cancel="'.$status.'" where order_id="'.$order_id.'" and id = ?', [$chat_id]);
	
     if($status=="yes")
	 {		 
	DB::update('update gig_order set amount_by="buyer",payment_level="4" where id = ?', [$order_id]);	
	 }	
			return back();
		
	}	
	
	
	
	
	public function search_filter(Request $request)
	{
		$data = $request->all();
		
		$month = $data['month'];
		$year = $data['year'];
		
		if(empty($month))
		{
			$search_count = DB::table('withdraw')
		                    ->where('withdraw_month','!=','')
				            ->where('withdraw_year','=',$year)
				            ->count();
		}
		else
		{
			$search_count = DB::table('withdraw')
		                    ->where('withdraw_month','=',$month)
				            ->where('withdraw_year','=',$year)
				            ->count();
		}
		
		
		

        $rw = $search_count;
			 return redirect()->back()->withInput($request->input())->with('check', $rw);		
		
		
	}
	
	
	protected function track_completed(Request $request)
    {
	$data = $request->all();
	
	
	$ratingcomment = $data['ratingcomment'];
	$ratingvalue = $data['ratingvalue'];
	$star_rate = $data['star_rate'];
		 
		 $gid = $data['gid'];
		 $order_id = $data['order_id'];
		 $buyer_id = $data['buyer_id'];
		 $seller_id = $data['seller_id'];
		 
		 $final_status = DB::table('review')
		           
				   ->where('gid','=',$gid)
				   ->where('order_id','=',$order_id)
				   ->where('buyer_id','=',$buyer_id)
				   ->where('seller_id','=',$seller_id)
				   ->count();
		if(empty($final_status))
		{
			DB::insert('insert into review (gid,order_id,buyer_id,seller_id,rate,star_rate,comment) values (?, ?, ?, ?, ?, ?, ?)', [$gid,
		 $order_id,$buyer_id,$seller_id,$ratingvalue,$star_rate,$ratingcomment]);
				
		}			
	    DB::update('update chat_message set submission="" where order_id = ?', [$order_id]);	 
	    DB::update('update gig_order set amount_by="",payment_level="2" where id = ?', [$order_id]);
	    DB::update('update gigs set bid_status="1" where gid = ?', [$gid]);
	return back();
	
	}
	
	
	
	public function buyer_cancel($chat_id,$order_id,$status)
	{
		
		DB::update('update chat_message set mutual_cancel="'.$status.'" where order_id="'.$order_id.'" and id = ?', [$chat_id]);
	
     if($status=="yes")
	 {		 
	DB::update('update gig_order set amount_by="buyer",payment_level="4" where id = ?', [$order_id]);	
	 }	
			return back();
		
	}	
	
	
	
	protected function buyer_savedata(Request $request)
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
		 
		 $gid = $data['gid'];
		 $order_id = $data['order_id'];
		 $buyer_id = $data['buyer_id'];
		 $seller_id = $data['seller_id'];
		 $got_problem = $data['got_problem'];
		 if(!empty($data['reason']))
		 {
			 $reason = $data['reason'];
			 
			 if($data['reason']=="Reject_Order")
			 {
				 DB::update('update chat_message set submission="" where order_id = ?', [$order_id]);
			 }
			 
		 } else {$reason = ""; }
		 
		 $date_submit = date("Y-m-d H:i:s");
		 $msg_type = $data['msg_type'];
		 
		 
		 
		 DB::insert('insert into chat_message (gid,order_id,buyer_id,seller_id,message,msg_type,submit_date,file,got_problem,problem_reason
		 ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$gid,
		 $order_id,$buyer_id,$seller_id ,$msg,$msg_type,$date_submit,$namef,$got_problem,$reason]);
		
		
			return back()->with('success', 'Message has been saved');
		 
		 
		 
	}
	
	
	
	
	
	protected function seller_savedata(Request $request)
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
		 
		 $gid = $data['gid'];
		 $order_id = $data['order_id'];
		 $buyer_id = $data['buyer_id'];
		 $seller_id = $data['seller_id'];
		 $got_problem = $data['got_problem'];
		 $completed_work = $data['completed_work'];
		 if($completed_work=="yes")
		 {
			 $submission = "yes";
		 }
		 else
		 {
			 $submission = "no";
		 }
		 
		 if(!empty($data['reason']))
		 {
			 if($data['reason']=="Force_Cancellation")
			 {
				 $mutual_cancel="yes";
				 DB::update('update gig_order set amount_by="buyer",payment_level="4" where id = ?', [$order_id]);
			 }
			 else
			 {
				 $mutual_cancel="";
			 }
			 $reason = $data['reason'];
		 } else {$reason = ""; $mutual_cancel=""; }
		 
		 $date_submit = date("Y-m-d H:i:s");
		 $msg_type = $data['msg_type'];
		 
		 
		 
		 DB::insert('insert into chat_message (gid,order_id,buyer_id,seller_id,message,msg_type,submit_date,file,
		 got_problem,complete_work,submission,problem_reason,mutual_cancel) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$gid,
		 $order_id,$buyer_id,$seller_id ,$msg,$msg_type,$date_submit,$namef,$got_problem,$completed_work,$submission,$reason,$mutual_cancel]);
		
		
		
			return back()->with('success', 'Message has been saved');
		 
		 
		 
	}
	
	
	
	
	
	
	
	
	
	
	

	
	
	
}

<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Mail;
use Auth;

class BookinginfoController extends Controller
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
	
	
   
   public function sangvish_viewbook()
   {
	   $token =csrf_token();
	   $idmy = Auth::user()->id;
	   
	   
	   $setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$currency = $setts[0]->site_currency;
	   
	   $bookingget = DB::table('booking')
               
			   ->where('user_id', '=', $idmy)
			    ->where('status', '=', 'pending')
				->where('token', '=', $token)
			   ->orderBy('book_id','desc')
                ->get();
				
				$neshopp = $bookingget[0]->shop_id;
	   
	   $shopnewie = DB::table('shop')
		 ->where('id', '=', $neshopp)
		 ->get();
		 
		 $id = $shopnewie[0]->user_id;
		 
		
	   
	   $userdetails = DB::table('users')
		 ->where('id', '=', $id)
		 ->get();
	   
	    $booking = DB::table('booking')
               ->where('token', '=', $token)
			   ->where('status', '=', 'pending')
			   ->where('user_id', '=', $idmy)
			   ->orderBy('book_id','desc')
                ->get();
				
				
		$ser_id=$booking[0]->services_id;
			$sel=explode("," , $ser_id);
			$lev=count($sel);
			$ser_name="";
			$sum=0;
			$price="";
			$tax_price = 0;
		for($i=0;$i<$lev;$i++)
			{
				$id=$sel[$i];	
                
				
				
				$fet1 = DB::table('subservices')
								 ->where('subid', '=', $id)
								 ->get();
				$ser_name.=$fet1[0]->subname.'<br>';
				$ser_name.=",";				 
				
				
				
				$fet2 = DB::table('seller_services')
								 ->where('subservice_id', '=', $id)
								 ->where('shop_id', '=', $neshopp)
								 ->get();
				$price.=$fet2[0]->price;
				$price.=",";

                 $tax_price +=$fet2[0]->price;				
				
								
				
				
				$ser_name=trim($ser_name,",");
				$price=trim($price,",").' '.$currency."<br/>";	
				$sum+=$fet2[0]->price;
				
				
			}

		

          if($setts[0]->commission_from == "buyer")
		  {
		      if($setts[0]->commission_mode=="fixed")
				{
					$sum=$sum+$setts[0]->commission_amt;
					$admin_amt = $setts[0]->commission_amt;
				}
				else if($setts[0]->commission_mode=="percentage")
				{
					$sum1=($setts[0]->commission_amt * $sum) / 100;
					$sum=$sum+$sum1;
					$admin_amt = $sum1;
				}
				else
				{
					$sum+=$fet2[0]->price;
				} 
		  }
		  if($setts[0]->commission_from == "vendor")
		  {	
				if($setts[0]->commission_mode=="percentage")
				{
					$sum1=($setts[0]->commission_amt * $sum) / 100;
					$sum=$sum;
					$admin_amt = $sum1;
				}
				else
				{
					$sum+=$fet2[0]->price;
				}
		  }	  
				
				$commission_amt = $setts[0]->commission_amt;
				$commission_mode = $setts[0]->commission_mode;
				$commission_from = $setts[0]->commission_from;
				
				
				
				
		$shop = DB::table('shop')
               ->where('id', '=', $booking[0]->shop_id)
                ->get();


            $get_tax = ($tax_price * $shop[0]->tax_percent) / 100;
			
			$taxer = $shop[0]->tax_percent;
 				
				
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



		 $admin_idd=1;
		
		$admin_email = DB::table('users')
                ->where('id', '=', $admin_idd)
                ->get();
				
				$userid=Auth::user()->id;
				
		$user_email = DB::table('users')
		 ->where('id', '=', $userid)
		 ->orderBy('id','desc')
		 ->get();		
				
	   $useremail = $user_email[0]->email;
	   $usernamer = $user_email[0]->name;
	   $userphone = $user_email[0]->phone;
	   
	   $adminemail = $admin_email[0]->email;
	   
	   $shopid = $booking[0]->shop_id;
	   
	   $shoptbl = DB::table('shop')
		->where('id', '=', $shopid)
		->get();
	   $selleremail = $shoptbl[0]->seller_email;
	   
	   
	   
	   $data = array('booking' => $booking,'final_time' => $final_time, 'shop' => $shop, 'ser_name' => $ser_name, 'price' => $price,
	   'commission_amt' => $commission_amt, 'commission_mode' => $commission_mode, 'currency' => $currency, 'sum' => $sum, 'adminemail' => $adminemail,
	   'useremail' => $useremail, 'usernamer' => $usernamer, 'userphone' => $userphone, 'selleremail' => $selleremail, 'commission_from' => $commission_from,
	   'admin_amt' => $admin_amt, 'get_tax' => $get_tax, 'taxer' => $taxer, 'tax_price' => $tax_price);
		return view('booking_info')->with($data);
	   
	   
   }
   
   
	
	
	
	
	
	
	
}

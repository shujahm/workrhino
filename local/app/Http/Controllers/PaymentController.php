<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Mail;
use Auth;
use Crypt;
use URL;
use PaytmWallet;

class PaymentController extends Controller
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
	
	
	public function paymentCallback()
    {
        $transaction = PaytmWallet::with('receive');


        $response = $transaction->response();
        $cid = $transaction->getOrderId();


        if($transaction->isSuccessful()){
          
       return redirect('/success/'.$cid);

         
        }else if($transaction->isFailed()){
          
          return redirect('/cancel');
        }
    }    
	
	
	
	public function neworder(Request $request)
    {


        


        $input = $request->all();
        
        

       $url = URL::to("/");
       


        $payment = PaytmWallet::with('receive');
        $payment->prepare([
          'order' => $input['item_number'],
          'user' => Auth::user()->id,
          'mobile_number' => Auth::user()->phone,
          'email' => Auth::user()->email,
          'amount' => $input['amount'],
          'callback_url' => $url.'/payment_status'
        ]);
        return $payment->receive();
    }

	
	
	
	public function sangvish_wallet_transfer(Request $request)
	{
		$datta = $request->all();
		
		$cid = $datta['item_number'];
		
		$wallet_balance = $datta['wallet_balance'];
		$amount = $datta['amount'];
		
		$fin_amount = $wallet_balance - $amount;
		
		$myuserupdate = DB::table('users')
						->where('id', '=', Auth::user()->id)
						->update(['wallet' => $fin_amount]);
						
						
						
						
						
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
		
		
		
		
		
		
	 
	  $datas = array('cid' => $cid);
     return view('success')->with($datas);


		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function sangvish_showpage(Request $request) {
		 $datas = $request->all();
		 
		
		
		
		$prices = $datas['price'];
		
		$admin_commission = $datas['admin_amt'];
		$tax_amt = $datas['tax_amt'];
		$subtotal = $datas['service_amt'];
		
		$sum = $datas['price'];
		
		$admin_email = $datas['admin_email'];
		$user_email =$datas['user_email'];
		
		
			 
		 
		 $usernamer = $datas['usernamer'];
	$userphone = $datas['userphone'];
		
		$currency=$datas['currency'];
		
		 $seller_email =$datas['seller_email'];
		
		 $token =csrf_token();
		 $id = Auth::user()->id;
	   $userdetails = DB::table('users')
		 ->where('id', '=', $id)
		 ->get();
		
		$getbookid = DB::table('booking')
						->where([['user_email', '=', $userdetails[0]->email],['status', '=', 'pending'],['token', '=', $token]])
						->orderBy('book_id','desc')
						->limit(1)->offset(0)
						->get();
				$bookid = $getbookid[0]->book_id;
				
		$bookingupdate = DB::table('booking')
						->where([['user_email', '=', $userdetails[0]->email],['token', '=', $token],['book_id', '=', $bookid] ],['user_id', '=', $userdetails[0]->id])
						->update(['total_amt' => $sum, 'admin_commission' => $admin_commission, 'subtotal_amt' => $subtotal, 'tax_amt' => $tax_amt]);

        
$booking = DB::table('booking')
               ->where('token', '=', $token)
			   ->where('user_email', '=', $userdetails[0]->email)
			    ->where('status', '=', 'pending')
			   ->orderBy('book_id','desc')
                ->get();



		$ser_id=$booking[0]->services_id;
			$sel=explode("," , $ser_id);
			$lev=count($sel);
			$ser_name="";
			$sum=0;
			$price=0;		
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
								 ->get();
				$price.=$fet2[0]->price.'<br>';
				$price.=",";	
				
								
				
				
				$ser_name=trim($ser_name,",");
				$price=trim($price,",");	
				$sum+=$fet2[0]->price;
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
			
		/*  user email    */
		
		 
		 
				
		$booking_id=$booking[0]->book_id;		
		$booking_date=$booking[0]->booking_date;
		$total_amt=$booking[0]->total_amt;
		$currency = $booking[0]->currency;
		
		$payment_mode=$booking[0]->payment_mode;
		
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$paypal_id = $setts[0]->paypal_id;
		
		$paypal_url =$setts[0]->paypal_url;
		
		
		Mail::send('bookinguseremail', ['booking_id' => $booking_id, 'ser_name' => $ser_name, 'booking_date' => $booking_date, 'final_time' => $final_time, 'total_amt' => $total_amt,
			 'currency' => $currency, 'site_logo' => $site_logo, 'site_name' => $site_name], function ($message)
        {
            $message->subject('Booking Details');
			
            $message->from(Input::get('admin_email'), 'Admin');

            $message->to(Input::get('user_email'));

        }); 
		
		
		

       
	   
	   
	   
	   Mail::send('bookingadminemail', ['booking_id' => $booking_id, 'ser_name' => $ser_name, 'booking_date' => $booking_date, 'final_time' => $final_time, 'total_amt' => $total_amt,
			 'currency' => $currency, 'site_logo' => $site_logo, 'site_name' => $site_name, 'user_email' => $user_email, 'usernamer' => $usernamer, 'userphone' => $userphone], function ($message)
        {
            $message->subject('New Order Received');
			
            $message->from(Input::get('admin_email'), 'Admin');

            $message->to(Input::get('admin_email'));

        }); 
		
		
	
	
	
	Mail::send('bookingadminemail', ['booking_id' => $booking_id, 'ser_name' => $ser_name, 'booking_date' => $booking_date, 'final_time' => $final_time, 'total_amt' => $total_amt,
			 'currency' => $currency, 'site_logo' => $site_logo, 'site_name' => $site_name,  'user_email' => $user_email, 'usernamer' => $usernamer, 'userphone' => $userphone], function ($message)
        {
            $message->subject('New Order Received');
			
            $message->from(Input::get('admin_email'), 'Admin');

            $message->to(Input::get('seller_email'));

        }); 
		
		
	
	
	
		
		
		$service_name=str_replace("<br>",",",$datas['service_name']);
		$service_names = rtrim($service_name,",");
		$booking_date=$datas['booking_date'];
	 
	  $data = array('prices' => $prices, 'currency' => $currency, 'service_names' => $service_names, 'booking_date' => $booking_date, 'paypal_id' => $paypal_id,
	  'paypal_url' => $paypal_url, 'booking_id' => $booking_id, 'payment_mode' => $payment_mode);
      return view('payment')->with($data);
   }
   
   
   
   protected function savedata(Request $request)
    {
        
		
		
		 $data = $request->all();
		 
		 
		
		 
	}
	
	
	
	
	
	
	
	
	
	
}

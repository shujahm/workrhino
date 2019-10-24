<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Mail;
use Auth;
use URL;
use Crypt;

class MyorderController extends Controller
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
	
	
	
	public function sangvish_service_status($service,$id,$status_id)
	{
		$vendor_id = Auth::user()->id;
		
		$book_id = base64_decode($id);
		
		DB::update('update booking set service_complete="'.$status_id.'" where book_id = ?', [$book_id]);
		
		$book_detail=DB::table('booking')
		->where('book_id', '=' , $book_id)
		->get();

		$user_detail=DB::table('users')
		->where('id' , '=' , $book_detail[0]->user_id)
		->get();

		$seller_detail=DB::table('shop')
		->where('id' , '=' , $book_detail[0]->shop_id)
		->get();

		$aid=1;
		$admindetails = DB::table('users')
		->where('id' , '=' , $aid)
		->first();
		$admin_email = $admindetails->email;

		$servdetails = DB::table('subservices')
		->where('subid' , '=' , $book_detail[0]->services_id)
		->get();		

		$setid = 1;
		$setts = DB::table('settings')
		->where('id' , '=' , $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;

		
		if($status_id == 1)
		{
			Mail::send('bookconfirmuseremail', ['booking_id' => $book_detail[0]->book_id, 'ser_name' => $servdetails[0]->subname, 'booking_days_dates' => $book_detail[0]->booking_days_dates, 'total_amt' => $book_detail[0]->total_amt,
				 'currency' => $setts[0]->site_currency, 'site_logo' => $site_logo, 'site_name' => $setts[0]->site_name, 'shop_name' => $seller_detail[0]->shop_name, 'seller_email' => $seller_detail[0]->seller_email, 'shop_phone_no' => $seller_detail[0]->shop_phone_no, 'admin_email' => $admin_email] , function ($message)  use ($admindetails,$user_detail) 
        			{
            			$message->subject('Booking Confirmation');
			
            			$message->from($admindetails->email,'Admin');

            			$message->to($user_detail[0]->email);

					});
			
			Mail::send('bookconfirmadminemail', ['booking_id' => $book_detail[0]->book_id, 'ser_name' => $servdetails[0]->subname, 'booking_days_dates' => $book_detail[0]->booking_days_dates, 'total_amt' => $book_detail[0]->total_amt,
			'currency' => $setts[0]->site_currency, 'site_logo' => $site_logo, 'site_name' => $setts[0]->site_name, 'shop_name' => $seller_detail[0]->shop_name, 'seller_email' => $seller_detail[0]->seller_email, 'shop_phone_no' => $seller_detail[0]->shop_phone_no, 'name' => $user_detail[0]->name, 'email' => $user_detail[0]->email, 'phone' => $user_detail[0]->phone, 'admin_email' => $admin_email] , function ($message)  use ($admindetails,$user_detail) 
				{
					$message->subject('Booking Confirmation');
		
					$message->from($admindetails->email,'Admin');

					$message->to($admindetails->email);

				});		

		}


		if($status_id == 2)
		{
			Mail::send('jobcompleteuseremail', ['booking_id' => $book_detail[0]->book_id, 'shop_name' => $seller_detail[0]->shop_name, 'ser_name' => $servdetails[0]->subname, 'booking_days_dates' => $book_detail[0]->booking_days_dates, 'total_amt' => $book_detail[0]->total_amt,
				 'currency' => $setts[0]->site_currency, 'site_logo' => $site_logo, 'site_name' => $setts[0]->site_name] , function ($message)  use ($admindetails,$user_detail) 
        			{
            			$message->subject('Job Completed');
			
            			$message->from($admindetails->email,'Admin');

            			$message->to($user_detail[0]->email);

					});
					

			Mail::send('jobcompleteadminemail', ['booking_id' => $book_detail[0]->book_id, 'shop_name' => $seller_detail[0]->shop_name, 'ser_name' => $servdetails[0]->subname, 'booking_days_dates' => $book_detail[0]->booking_days_dates, 'total_amt' => $book_detail[0]->total_amt,
			'currency' => $setts[0]->site_currency, 'site_logo' => $site_logo, 'site_name' => $setts[0]->site_name] , function ($message)  use ($admindetails,$user_detail) 
				{
					$message->subject('Job Completed');
		
					$message->from($admindetails->email,'Admin');

					$message->to($admindetails->email);

				});
		}
		return back();
		
		
		
	}

	public function sangvish_payment_status($service,$id,$status)
	{
		$vendor_id = Auth::user()->id;
		
		$book_id = base64_decode($id);
		
		DB::update('update booking set status="'.$status.'", service_complete="3" where book_id = ?', [$book_id]);
		


		
		$book_detail=DB::table('booking')
		->where('book_id', '=' , $book_id)
		->get();

		$user_detail=DB::table('users')
		->where('id' , '=' , $book_detail[0]->user_id)
		->get();

		$seller_detail=DB::table('shop')
		->where('id' , '=' , $book_detail[0]->shop_id)
		->get();

		$aid=1;
		$admindetails = DB::table('users')
		->where('id' , '=' , $aid)
		->first();
		$admin_email = $admindetails->email;

		$servdetails = DB::table('subservices')
		->where('subid' , '=' , $book_detail[0]->services_id)
		->get();		

		$setid = 1;
		$setts = DB::table('settings')
		->where('id' , '=' , $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;


		Mail::send('bookpaymentreceivuseremail', ['booking_id' => $book_detail[0]->book_id, 'ser_name' => $servdetails[0]->subname, 'booking_days_dates' => $book_detail[0]->booking_days_dates, 'total_amt' => $book_detail[0]->total_amt,
				 'currency' => $setts[0]->site_currency, 'site_logo' => $site_logo, 'site_name' => $setts[0]->site_name, 'shop_name' => $seller_detail[0]->shop_name, 'seller_email' => $seller_detail[0]->seller_email, 'shop_phone_no' => $seller_detail[0]->shop_phone_no, 'admin_email' => $admin_email] , function ($message)  use ($admindetails,$user_detail) 
        			{
            			$message->subject('Payment Received');
			
            			$message->from($admindetails->email,'Admin');

            			$message->to($user_detail[0]->email);

					});
			
			Mail::send('bookpaymentreceivadminemail', ['booking_id' => $book_detail[0]->book_id, 'ser_name' => $servdetails[0]->subname, 'booking_days_dates' => $book_detail[0]->booking_days_dates, 'total_amt' => $book_detail[0]->total_amt,
			'currency' => $setts[0]->site_currency, 'site_logo' => $site_logo, 'site_name' => $setts[0]->site_name, 'shop_name' => $seller_detail[0]->shop_name, 'seller_email' => $seller_detail[0]->seller_email, 'shop_phone_no' => $seller_detail[0]->shop_phone_no, 'name' => $user_detail[0]->name, 'email' => $user_detail[0]->email, 'phone' => $user_detail[0]->phone, 'admin_email' => $admin_email] , function ($message)  use ($admindetails,$user_detail) 
				{
					$message->subject('Payment Received');
		
					$message->from($admindetails->email,'Admin');

					$message->to($admindetails->email);

				});		

		

		return back();
		
		
		
	}
	
	
	public function sangvish_reject($reject,$id)
	{
		
		$vendor_id = Auth::user()->id;
		
		$book_id = base64_decode($id);
		
		$view_list = DB::table('booking')
					 ->where('book_id', '=', $book_id)
					 ->get();
		
		//$refund_amt = $view_list[0]->subtotal_amt + $view_list[0]->tax_amt;
		//$credit_amt = $view_list[0]->total_amt;
		
		$check_vendor = DB::table('users')
					   ->where('id', '=', $vendor_id)
					   ->get();
		
        //$vendor_final_amount = $check_vendor[0]->wallet - $refund_amt;

        //DB::update('update users set wallet="'.$vendor_final_amount.'" where id = ?', [$vendor_id]);		
		
		
		
		$customer_id = $view_list[0]->user_id;
		
		$check_customer = DB::table('users')
					      ->where('id', '=', $customer_id)
					      ->get();
		
        //$customer_final_amount = $check_customer[0]->wallet + $credit_amt;
        
        //DB::update('update users set wallet="'.$customer_final_amount.'" where id = ?', [$customer_id]);		
		
		
		
		//DB::update('update booking set status="refund",reject="cancelled by vendor" where book_id = ?', [$book_id]);
		DB::update('update booking set status="cancelled",reject="cancelled by vendor" where book_id = ?', [$book_id]);
		
		$book_detail=DB::table('booking')
		->where('book_id', '=' , $book_id)
		->get();

		$user_detail=DB::table('users')
		->where('id' , '=' , $book_detail[0]->user_id)
		->get();

		$seller_detail=DB::table('shop')
		->where('id' , '=' , $book_detail[0]->shop_id)
		->get();

		$aid=1;
		$admindetails = DB::table('users')
		->where('id' , '=' , $aid)
		->first();
		$admin_email = $admindetails->email;

		$servdetails = DB::table('subservices')
		->where('subid' , '=' , $book_detail[0]->services_id)
		->get();		

		$setid = 1;
		$setts = DB::table('settings')
		->where('id' , '=' , $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		


		Mail::send('bookrejectuseremail', ['booking_id' => $book_detail[0]->book_id, 'ser_name' => $servdetails[0]->subname, 'booking_days_dates' => $book_detail[0]->booking_days_dates, 'total_amt' => $book_detail[0]->total_amt,
		'currency' => $setts[0]->site_currency, 'site_logo' => $site_logo, 'site_name' => $setts[0]->site_name, 'shop_name' => $seller_detail[0]->shop_name, 'seller_email' => $seller_detail[0]->seller_email, 'shop_phone_no' => $seller_detail[0]->shop_phone_no, 'admin_email' => $admin_email] , function ($message)  use ($admindetails,$user_detail) 
		   {
			   $message->subject('Booking Confirmation');
   
			   $message->from($admindetails->email,'Admin');

			   $message->to($user_detail[0]->email);

		   });
   
		Mail::send('bookrejectadminemail', ['booking_id' => $book_detail[0]->book_id, 'ser_name' => $servdetails[0]->subname, 'booking_days_dates' => $book_detail[0]->booking_days_dates, 'total_amt' => $book_detail[0]->total_amt,
		'currency' => $setts[0]->site_currency, 'site_logo' => $site_logo, 'site_name' => $setts[0]->site_name, 'shop_name' => $seller_detail[0]->shop_name, 'seller_email' => $seller_detail[0]->seller_email, 'shop_phone_no' => $seller_detail[0]->shop_phone_no, 'name' => $user_detail[0]->name, 'email' => $user_detail[0]->email, 'phone' => $user_detail[0]->phone, 'admin_email' => $admin_email] , function ($message)  use ($admindetails,$user_detail) 
			{
				$message->subject('Booking Confirmation');

				$message->from($admindetails->email,'Admin');

				$message->to($admindetails->email);

			});

		
		
		return back();
		
		
	}
	
	
	
	
	
	
	public function sangvish_showpage() {
		
		 $email = Auth::user()->email;
		 
		 
		 $set_id=1;
		$setting = DB::table('settings')->where('id', $set_id)->get();
		
		
        $booking = DB::table('booking')
		           ->leftJoin('shop', 'shop.id', '=', 'booking.shop_id')
				   ->where('shop.status', '=', 'approved')
				   
				   ->where('shop.seller_email', '=', $email)
				->where('total_amt', '!=' , 0)
				   ->whereIn('booking.status', ['paid','refund','pending','cancelled'])
				   ->orderBy('booking.book_id', 'desc')
				 ->get();
				
				 
				$count = DB::table('booking')
		           ->leftJoin('shop', 'shop.id', '=', 'booking.shop_id')
				   ->where('shop.status', '=', 'approved')
				   ->where('shop.seller_email', '=', $email)
				->where('total_amt', '!=' , 0)
				   ->whereIn('booking.status', ['paid','refund','pending','cancelled'])
				   ->orderBy('booking.book_id', 'desc')
				 ->count(); 
				 
		
		$data=array('booking' => $booking, 'setting' => $setting, 'email' => $email, 'count' => $count);
		 
		 
		
		
		
		
		
	 
	  
      return view('myorder')->with($data);
   }
   
   
   
  public function sangvish_destroy($id) {
		
		
	  
      DB::delete('delete from booking where book_id = ?',[$id]);
	   
      return back();
      
   }
	
	
	
	
	
	
	
	
	
	
}

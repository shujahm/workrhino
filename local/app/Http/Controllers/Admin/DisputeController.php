<?php

namespace Responsive\Http\Controllers\Admin;



use File;
use Image;
use Responsive\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mail;
use Auth;
use URL;

use Responsive\Http\Requests;
use Illuminate\Http\Request;
use Responsive\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class DisputeController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        $dispute = DB::table('dispute')->orderBy('dispute_id','desc')->count();
		
		$set_id=1;
		$setting = DB::table('settings')->where('id', $set_id)->get();	

        return view('admin.dispute', ['dispute' => $dispute, 'setting' => $setting]);
    }
	
	
	
	
	
	public function refund_vendor($customer_id,$vendor_id,$booking_id,$amount)
	{
	
	DB::update('update booking set service_complete="2" where book_id="'.$booking_id.'" and user_id = ?', [$customer_id]);
	
	
	$userwives = DB::table('users')
              
			               ->where('id', '=', $vendor_id)
			   
                           ->get();
	$vendor_email = $userwives[0]->email;
	
	$wallet_amount = $userwives[0]->wallet;

        $fin_amount = 	$wallet_amount + $amount;
	
	$userupdate = DB::table('users')
						->where('id', '=', $vendor_id)
						->update(['wallet' => $fin_amount]);
	
	
	
	$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$currency = $setts[0]->site_currency;
		
	   
	  
	   
	   $aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->first();
		
		$admin_email = $admindetails->email;


        $datas = [
             'booking_id' => $booking_id, 'amount' => $amount, 'currency' => $currency, 'site_logo' => $site_logo, 'site_name' => $site_name
        ];
		
		
		
		
		Mail::send('admin.release_mail', $datas , function ($message) use ($admin_email,$vendor_email)
        {
            $message->subject('Payment received');
			
            $message->from($admin_email, 'Admin');

            $message->to($vendor_email);

        }); 
		
		
		DB::update('update dispute set status="payment released to vendor" where booking_id="'.$booking_id.'" and vendor_id = ?', [$vendor_id]);
		
	
	  return back();
		
		
		
		
	
	
	
	
	
	
	}
	
	
	
	
	
	
	
	
	public function refund_customer($customer_id,$vendor_id,$booking_id)
	{
		
		
		DB::update('update booking set status="refund",reject="cancelled by admin",service_complete="2" where book_id="'.$booking_id.'" and user_id = ?', [$customer_id]);
		
		
		$userwives = DB::table('users')
              
			               ->where('id', '=', $customer_id)
			   
                           ->get();
		
        $customer_email = $userwives[0]->email;
         $view_list = DB::table('booking')
					 ->where('book_id', '=', $booking_id)
					 ->get();
		
		$amount	= $view_list[0]->total_amt;			   
		$wallet_amount = $userwives[0]->wallet;

        $fin_amount = 	$wallet_amount + $amount;	

        $userupdate = DB::table('users')
						->where('id', '=', $customer_id)
						->update(['wallet' => $fin_amount]);
						
						
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$currency = $setts[0]->site_currency;
		
	   
	  
	   
	   $aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->first();
		
		$admin_email = $admindetails->email;


        $datas = [
             'booking_id' => $booking_id, 'amount' => $amount, 'currency' => $currency, 'site_logo' => $site_logo, 'site_name' => $site_name
        ];
		
		
		
		
		Mail::send('admin.refund_mail', $datas , function ($message) use ($admin_email,$customer_email)
        {
            $message->subject('Your payment refunded');
			
            $message->from($admin_email, 'Admin');

            $message->to($customer_email);

        }); 
		
		
		DB::update('update dispute set status="payment refunded to customer" where booking_id="'.$booking_id.'" and customer_id = ?', [$customer_id]);
		
	
	  return back();


		
						
		
		
		
	}
	
	
	
	
	
}
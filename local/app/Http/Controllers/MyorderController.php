<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Mail;
use Auth;

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
		
		
		
		return back();
		
		
		
	}
	
	
	public function sangvish_reject($reject,$id)
	{
		
		$vendor_id = Auth::user()->id;
		
		$book_id = base64_decode($id);
		
		$view_list = DB::table('booking')
					 ->where('book_id', '=', $book_id)
					 ->get();
		
		$refund_amt = $view_list[0]->subtotal_amt + $view_list[0]->tax_amt;
		$credit_amt = $view_list[0]->total_amt;
		
		$check_vendor = DB::table('users')
					   ->where('id', '=', $vendor_id)
					   ->get();
		
        $vendor_final_amount = $check_vendor[0]->wallet - $refund_amt;

        DB::update('update users set wallet="'.$vendor_final_amount.'" where id = ?', [$vendor_id]);		
		
		
		
		$customer_id = $view_list[0]->user_id;
		
		$check_customer = DB::table('users')
					      ->where('id', '=', $customer_id)
					      ->get();
		
        $customer_final_amount = $check_customer[0]->wallet + $credit_amt;
        
        DB::update('update users set wallet="'.$customer_final_amount.'" where id = ?', [$customer_id]);		
		
		
		
		DB::update('update booking set status="refund",reject="cancelled by vendor" where book_id = ?', [$book_id]);
		
		
		
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
				   ->whereIn('booking.status', ['paid','refund'])
				   ->orderBy('booking.book_id', 'desc')
				 ->get();
				
				 
				$count = DB::table('booking')
		           ->leftJoin('shop', 'shop.id', '=', 'booking.shop_id')
				   ->where('shop.status', '=', 'approved')
				   ->where('shop.seller_email', '=', $email)
				   ->whereIn('booking.status', ['paid','refund'])
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

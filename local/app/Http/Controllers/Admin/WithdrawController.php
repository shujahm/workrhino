<?php

namespace Responsive\Http\Controllers\Admin;



use File;
use Image;
use Responsive\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Auth;
use Mail;

use Responsive\Http\Requests;
use Illuminate\Http\Request;
use Responsive\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use URL;

class WithdrawController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
		
		$set_id=1;
		$setting = DB::table('settings')->where('id', $set_id)->get();
		
		
        $withdraw = DB::table('withdraw')
		           
		           ->leftJoin('users', 'users.id', '=', 'withdraw.user_id')
				   ->where('withdraw.withdraw_status','=', 'pending')
				    ->orderBy('withdraw.wid','desc')
				 ->get();
		
		$data=array('withdraw' => $withdraw, 'setting' => $setting);

        return view('admin.pending_withdraw')->with($data);
    }
	
	
	
	public function doneindex()
    {
		
		$set_id=1;
		$setting = DB::table('settings')->where('id', $set_id)->get();
		
		
        $withdraw = DB::table('withdraw')
		           
		           ->leftJoin('users', 'users.id', '=', 'withdraw.user_id')
				   ->where('withdraw.withdraw_status','=', 'completed')
				    ->orderBy('withdraw.wid','desc')
				   
				 ->get();
		
		$data=array('withdraw' => $withdraw, 'setting' => $setting);

        return view('admin.completed_withdraw')->with($data);
    }
	
	
	
	
	
	
	public function update($id) {
		
		$viewdraw = DB::table('withdraw')
	             ->where('wid','=',$id)
				 ->get();
				 
				 
		
		DB::update('update withdraw set withdraw_status="completed" where wid = ?', [$id]);
	  
	  		 
		
		
		$viewusers = DB::table('users')
	             ->where('id','=',$viewdraw[0]->user_id)
				 ->get();
				 
		$seller_email = $viewusers[0]->email;
		$username = $viewusers[0]->name;
		
		
		$w_withdraw_amt = $viewdraw[0]->withdraw_amt;
	   $w_withdraw_mode = $viewdraw[0]->withdraw_mode; 
	   $w_paypal_id = $viewdraw[0]->paypal_id; 
	   $w_bank_acc_no = $viewdraw[0]->bank_acc_no;
	   $w_bank_info = $viewdraw[0]->bank_info;
	   $w_ifsc_code = $viewdraw[0]->ifsc_code;
	   
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
            'w_withdraw_amt' => $w_withdraw_amt, 'w_withdraw_mode' => $w_withdraw_mode, 'w_paypal_id' => $w_paypal_id, 'w_bank_acc_no' => $w_bank_acc_no,
			'w_bank_info' => $w_bank_info, 'w_ifsc_code' => $w_ifsc_code, 'username' => $username, 'currency' => $currency, 'site_logo' => $site_logo, 'site_name' => $site_name
        ];
		
		
		
		
		Mail::send('withdrawemail', $datas , function ($message) use ($admin_email,$seller_email,$username)
        {
            $message->subject('Withdrawal Request Approved');
			
            $message->from($admin_email, 'Admin');

            $message->to($seller_email);

        }); 
		
		
		
	  
      
	   
      
	  return redirect()->back()->with('message', 'Updated Successfully');
      
   }
   
   
   
   
   
   
   
	
}
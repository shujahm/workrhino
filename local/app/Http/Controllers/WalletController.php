<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Mail;
use Auth;
use Crypt;
use URL;

class WalletController extends Controller
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
	
	
	public function sangvish_showpage() {
		
		 $email = Auth::user()->email;
		 
		 
		 $loger_id = Auth::user()->id;
		 
		 
		 $gettin = DB::table('users')
		          
				   ->where('id', '=', $loger_id)
				   ->get();
				   
				   
		$wallet_up_amount = $gettin[0]->wallet;	   
		 
		 
		 $set_id=1;
		$setting = DB::table('settings')->where('id', $set_id)->get();
		
		
					 
			$check_count = $wallet_up_amount;		 
					 
				 
		   $with_count = DB::table('withdraw')
					->where('user_id', '=', Auth::user()->id)
					 ->count(); 	
				
				
				
				
				
				
		
				   
				   
				   
		$data=array('setting' => $setting, 'with_count' => $with_count,'check_count' => $check_count,'wallet_up_amount' => $wallet_up_amount);
		 
	    
		
		
		
		
		
		 
		 return view('wallet')->with($data);
		 
		 
		
		
		
		
		
	 
	  
      
   }
   
   
   
  public function sangvish_savedata(Request $request)
   {
	   $data = $request->all();
	   
	   
	  $shop_balance =  $data['shop_balance'];
	  $total_bal = $data['shop_balance'];
	   
	   $withdraw_amt = $data['withdraw_amt'];
	   $withdraw_mode = $data['withdraw_mode'];
	   
	   if(!empty($data['paypal_id']))
	   {
	   $paypal_id = $data['paypal_id'];
	   }
	   else
	   {
		   $paypal_id="";
	   }
	   
	   
	   if(!empty($data['stripe_id']))
	   {
	   $stripe_id = $data['stripe_id'];
	   }
	   else
	   {
		   $stripe_id="";
	   }
	   
	   if(!empty($data['payumoney']))
	   {
		   $payumoney = $data['payumoney'];
	   }
	   else
	   {
		   $payumoney ="";
	   }
	   
	   
	   
	   
	   if(!empty($data['bank_acc_no']))
	   {
	   $bank_acc_no = $data['bank_acc_no'];
	   }
	   else
	   {
		   $bank_acc_no ="";
	   }
	   
	   if(!empty($data['bank_name']))
	   {
		   
	   $bank_name = $data['bank_name'];
	   }
	   else
	   {
		   $bank_name ="";
	   }
	   if(!empty($data['ifsc_code']))
	   {
	   $ifsc_code = $data['ifsc_code'];
	   }
	   else
	   {
		   $ifsc_code="";
	   }
	   
	   $min_with_amt = $data['min_with_amt'];
	   
	   $with_status = 'pending';
	   
	   
	   $unid = Auth::user()->id;
	   
	   $wallet_balnce = Auth::user()->wallet;
	   
	   $setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$currency = $setts[0]->site_currency;
		
		$user_email = Auth::user()->email;
		$username = Auth::user()->name;
		
		$vendor_id = Auth::user()->id;
		
		$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->first();
		
		$admin_email = $admindetails->email;
	   
	   
	   if($min_with_amt<=$withdraw_amt && $wallet_balnce>=$withdraw_amt)
		{
			DB::insert('insert into withdraw (shop_balance,withdraw_amt,total_balance,withdraw_mode,paypal_id,stripe_id,payumoney,bank_acc_no,bank_info,ifsc_code,user_id,withdraw_status
			) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$shop_balance,$withdraw_amt,$total_bal,$withdraw_mode,$paypal_id,$stripe_id,$payumoney,$bank_acc_no,$bank_name,$ifsc_code,$unid,$with_status]);
			
			
			
			$withdraw = DB::table('withdraw')
					        ->where('user_id', '=', $unid)
							->orderBy('wid','desc')
							->limit(1)->offset(0)
							->first();
							
	   $w_withdraw_amt = $withdraw->withdraw_amt;
	   $w_withdraw_mode = $withdraw->withdraw_mode; 
	   $w_paypal_id = $withdraw->paypal_id; 
	   $w_stripe_id = $withdraw->stripe_id;
	   $w_payumoney = $withdraw->payumoney;
	   $w_bank_acc_no = $withdraw->bank_acc_no;
	   $w_bank_info = $withdraw->bank_info;
	   $w_ifsc_code = $withdraw->ifsc_code;
	   
	   
	   $vendor_final_amt = $shop_balance - $withdraw_amt;
			
			
		DB::update('update users set wallet="'.$vendor_final_amt.'" where id = ?', [$vendor_id]);
			
	   
	   
			
			
		$datas = [
            'w_withdraw_amt' => $w_withdraw_amt, 'w_withdraw_mode' => $w_withdraw_mode, 'w_paypal_id' => $w_paypal_id, 'w_stripe_id' => $w_stripe_id, 'w_payumoney' => $w_payumoney, 'w_bank_acc_no' => $w_bank_acc_no,
			'w_bank_info' => $w_bank_info, 'w_ifsc_code' => $w_ifsc_code, 'username' => $username, 'currency' => $currency, 'site_logo' => $site_logo, 'site_name' => $site_name
        ];
		
		
		
		
		Mail::send('withdrawemail', $datas , function ($message) use ($admin_email,$user_email,$username)
        {
            $message->subject('Withdrawal Request');
			
            /*$message->from($user_email, $username);

            $message->to($admin_email);*/
			
			 $message->from($admin_email,'Admin');

            $message->to($admin_email);
			

        }); 
		
			
			
			
			
			
			return redirect()->back()->with('message', 'Updated Successfully');
			
			
			
		}
		else
		{
			return redirect()->back()->with('message', 'Please Check Minimum Withdraw Amount and Shop Balance');
		}
	   
	   
	   
	   
	   
   }   
	
	
	
	
	
	
	
	
	
	
}

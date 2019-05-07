<?php

namespace Responsive\Http\Controllers\Admin;


use Responsive\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Responsive\Http\Requests;
use Illuminate\Http\Request;
use Responsive\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use File;
use Image;


class SettingsController extends Controller
{
    
   

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    
	
	public function showform() {
      $settings = DB::select('select * from settings where id = ?',[1]);
	  $currency=array("USD","CZK","DKK","HKD","HUF","ILS","JPY","MXN","NZD","NOK","PHP","PLN","SGD","SEK","CHF","THB","AUD","CAD","EUR","GBP","AFN","DZD",
							"AOA","XCD","ARS","AMD","AWG","SHP","AZN","BSD","BHD","BDT","INR");
		
		$withdraw=array("paypal","bank","stripe","payumoney");
		$paymentopt=array("paypal","stripe","payumoney","paytm");
		
		$socialopt=array("GPlus","Facebook","Twitter");
		
	  $data=array('settings'=>$settings, 'currency' => $currency, 'withdraw' => $withdraw, 'paymentopt' => $paymentopt, 'socialopt' => $socialopt);
      return view('admin.settings')->with($data);
   }
	
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
	 
	  protected $fillable = ['name', 'email','password','phone'];
	 
    protected function editsettings(Request $request)
    {
       
		
		
		
		
         
		 $data = $request->all();
			
         
		$site_name=$data['site_name'];
		
		
		
		
		$currency=$data['currency'];
		
		
		
		 $rules = array(
               
		'site_logo' => 'max:1024|mimes:jpg,jpeg,png',
		'site_favicon' => 'max:1024|mimes:jpg,jpeg,png',
		'site_banner' => 'max:1024|mimes:jpg,jpeg,png'
		
		
        );
		
		$messages = array(
            
           
			
        );
		
		$validator = Validator::make(Input::all(), $rules, $messages);
		
		
		
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			 
			return back()->withErrors($validator);
		}
		else
		{ 
		
		$currentlogo=$data['currentlogo'];
		
		
		$image = Input::file('site_logo');
        if($image!="")
		{	
            $settingphoto="/settings/";
			$delpath = base_path('images'.$settingphoto.$currentlogo);
			File::delete($delpath);	
			$filename  = time() . '.' . $image->getClientOriginalExtension();
            
            $path = base_path('images'.$settingphoto.$filename);
			$destinationPath=base_path('images'.$settingphoto);
      
                /*Image::make($image->getRealPath())->resize(200, 200)->save($path);*/
				
				Input::file('site_logo')->move($destinationPath, $filename);
				$savefname=$filename;
		}
        else
		{
			$savefname=$currentlogo;
		}	




		$currentfav = $data['currentfav'];
		
		
		
		$images = Input::file('site_favicon');
        if($images!="")
		{	
            $settingphotos="/settings/";
			$delpaths = base_path('images'.$settingphotos.$currentfav);
			File::delete($delpaths);	
			$filenames  = time() . '.' . $images->getClientOriginalExtension();
            
            $paths = base_path('images'.$settingphotos.$filenames);
			$destinationPaths=base_path('images'.$settingphotos);
      
                Image::make($images->getRealPath())->resize(24, 24)->save($paths);
				
				/* Input::file('site_logo')->move($destinationPath, $filename);*/
				$savefav=$filenames;
		}
        else
		{
			$savefav=$currentfav;
		}
		
		
		
		$currentban = $data['currentban'];
		
		
		$banimages = Input::file('site_banner');
        if($banimages!="")
		{	
            $settingbanphotos="/settings/";
			$delpathes = base_path('images'.$settingbanphotos.$currentban);
			File::delete($delpathes);	
			$banfilenames  = time() . '.' . $banimages->getClientOriginalExtension();
            
            $banpaths = base_path('images'.$settingbanphotos.$banfilenames);
			$destinationbanPaths=base_path('images'.$settingbanphotos);
      
                Image::make($banimages->getRealPath())->resize(1920, 500)->save($banpaths);
				
				/* Input::file('site_logo')->move($destinationPath, $filename);*/
				$savefavs=$banfilenames;
		}
        else
		{
			$savefavs=$currentban;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		$site_desc=$data['site_desc'];
		$site_keyword=$data['site_keyword'];
		
		
		if($data['site_desc']!="")
		{
			$desctxt=$site_desc;
		}
		else
		{
			$desctxt=$data['save_desc'];
		}
		
		
		if($data['site_keyword']!="")
		{
			$keytxt=$site_keyword;
		}
		else
		{
			$keytxt=$data['save_key'];
		}
		
		
		
		
		$commission_from=$data['commission_from'];
		
		if($commission_from == "vendor")
		{
			 $commission_mode=$data['commission_mode_vendor'];
		}
		else if($commission_from == "buyer")
		{
			$commission_mode=$data['commission_mode_buyer'];
		}
		
		
		$commission_amt=$data['commission_amt'];
		
		$paypal_id = $data['paypal_id'];
		$paypal_url = $data['paypal_url'];
		
		
		if(!empty($data['withdraw_opt']))
		{
		$withdraw_opt="";
		foreach($data['withdraw_opt'] as $with)
		{
			$withdraw_opt .=$with.",";
		}
		$withdraw = rtrim($withdraw_opt,",");
		}
		else
		{
			$withdraw = "";
		}
		
		
		
		if(!empty($data['payment_opt']))
		{
		$payment_opt="";
		foreach($data['payment_opt'] as $paymentopt)
		{
			$payment_opt .=$paymentopt.",";
		}
		$payopt = rtrim($payment_opt,",");
		}
		else
		{
			$payopt = "";
		}
		
		
		
		
		if(!empty($data['social_opt']))
		{
		$social_opt="";
		foreach($data['social_opt'] as $socialopt)
		{
			$social_opt .=$socialopt.",";
		}
		$sociopt = rtrim($social_opt,",");
		}
		else
		{
			$sociopt = "";
		}
		
		
		
		$withdraw_amt=$data['withdraw_amt'];
		
		
		$fb = $data['site_facebook'];
		
		if($data['site_facebook']!="")
		{
			$facebook = $fb;
		}
		else
		{
			$facebook = $data['save_facebook'];
		}
		
		$twi = $data['site_twitter'];
		
		if($data['site_twitter']!="")
		{
			$twitter = $twi;
		}
		else
		{
			$twitter = $data['save_twitter'];
		}
		
		
		
		
		$gpl = $data['site_gplus'];
		
		if($data['site_gplus']!="")
		{
			$gplus = $gpl;
		}
		else
		{
			$gplus = $data['save_gplus'];
		}
		
		
		
		$pin = $data['site_pinterest'];
		
		if($data['site_pinterest']!="")
		{
			$pinterest = $pin;
		}
		else
		{
			$pinterest = $data['save_pinterest'];
		}
		
		
		
		
		$ins = $data['site_instagram'];
		
		if($data['site_instagram']!="")
		{
			$instagram = $ins;
		}
		else
		{
			$instagram = $data['save_instagram'];
		}
		
		
		$copys = $data['site_copyright'];
		
		if($data['site_copyright']!="")
		{
			$copyrights = $copys;
		}
		else
		{
			$copyrights = $data['save_copyright'];
		}
		
		
		
		if(!empty($data['message_per_page']))
		{
			$message_per_page = $data['message_per_page'];
		}
		else
		{
			$message_per_page = "";
		}
		
		
		if(!empty($data['site_ads_space']))
		{
			$site_ads_space = htmlentities($data['site_ads_space']);
		}
		else
		{
			  $site_ads_space = "";
		}
		
		
		
		
		$stripe_mode = $data['stripe_mode'];
		$test_publish_key = $data['test_publish_key'];
		$test_secret_key = $data['test_secret_key'];
		$live_publish_key = $data['live_publish_key'];
		$live_secret_key = $data['live_secret_key'];
		
		if(!empty($data['approve_requests'])){ $approve_requests = $data['approve_requests']; } else { $approve_requests = ""; }
		
		
		if(!empty($data['min_skills'])) { $min_skills = $data['min_skills']; } else { $min_skills = ""; }  

if(!empty($data['max_skills'])) { $max_skills = $data['max_skills']; } else { $max_skills = ""; } 

         if(!empty($data['featured_gig_price'])){ $featured_gig_price = $data['featured_gig_price']; } else { $featured_gig_price = ""; }
if(!empty($data['featured_days'])){ $featured_days = $data['featured_days']; } else { $featured_days = ""; }
if(!empty($data['processing_fee'])){ $processing_fee = $data['processing_fee']; } else { $processing_fee = ""; }
		
		$payu_mode = $data['payu_mode'];
		$merchant_key = $data['merchant_key'];
		$salt_id = $data['salt_id'];
		
		DB::update('update settings set site_name="'.$site_name.'",site_desc="'.$desctxt.'",site_keyword="'.$keytxt.'",
		site_facebook="'.$facebook.'",site_twitter="'.$twitter.'",site_gplus="'.$gplus.'",site_pinterest="'.$pinterest.'",site_instagram="'.$instagram.'",site_currency="'.$currency.'",
		site_logo="'.$savefname.'",site_favicon="'.$savefav.'",site_banner="'.$savefavs.'",site_copyright="'.$copyrights.'",
		commission_mode="'.$commission_mode.'",commission_from="'.$commission_from.'",commission_amt="'.$commission_amt.'", paypal_id="'.$paypal_id.'",
		paypal_url="'.$paypal_url.'",stripe_mode="'.$stripe_mode.'",test_publish_key="'.$test_publish_key.'",test_secret_key="'.$test_secret_key.'",
		live_publish_key="'.$live_publish_key.'",live_secret_key="'.$live_secret_key.'",payu_mode="'.$payu_mode.'",merchant_key="'.$merchant_key.'",salt_id="'.$salt_id.'",message_per_page="'.$message_per_page.'",
		withdraw_amt="'.$withdraw_amt.'",withdraw_option="'.$withdraw.'",payment_option="'.$payopt.'",social_login_option="'.$sociopt.'",approve_requests="'.$approve_requests.'",min_skills="'.$min_skills.'",max_skills="'.$max_skills.'",featured_gig_price="'.$featured_gig_price.'",featured_days="'.$featured_days.'",processing_fee="'.$processing_fee.'",site_ads_space="'.$site_ads_space.'" where id = ?', [1]);
		
			return back()->with('success', 'Settings has been updated');
        
		
		}
		
		
    }
}

<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Auth;
use File;
use Image;
use Mail;
use Illuminate\Support\Facades\Validator;
use URL;
use Redirect;
use Responsive\Http\Requests;
use Illuminate\Http\Response;


class GigsController extends Controller
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
	 
	
    
	
	 public function getajax($id)
    {
        $cities = DB::table("subcategory")
                    ->where("category","=",$id)
                    ->pluck("subname","subid");
        return json_encode($cities);
    }
	
	
	
	
	

    public function delete_img($id) {
		
		
		
		$loop = DB::table('gig_images')->where('id','=',$id)->get();
		
		$orginalfile=$loop[0]->image;
		$userphoto="/gigs/";
        $path = base_path('images'.$userphoto.$orginalfile);
	    File::delete($path);
	    DB::delete('delete from gig_images where id = ?',[$id]);
		
	   
      return back();
      
   }



    public function my_custom_orders()
	{
		$logged = Auth::user()->id;
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		
		$custom_gigs_count = DB::table('gigs')
						->where('job_type', '=', 'custom')
						->where('delete_status','=','')
						->where('status','=',1)
						->where('user_id', '=', $logged)
						->orderBy('gid','desc')
						->count();
		
		
		$custom_gigs = DB::table('gigs')
						->where('job_type', '=', 'custom')
						->where('delete_status','=','')
						->where('status','=',1)
						->where('user_id', '=', $logged)
						->orderBy('gid','desc')
						->get();
		
		$data = array( 'custom_gigs' => $custom_gigs, 'custom_gigs_count' => $custom_gigs_count, 'site_setting' => $site_setting);
		return view('my_custom_orders')->with($data);
		
	}

	
	 
	public function create_custom_job()
    {
       
	  
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		
		$logged = Auth::user()->id;
		$userlog = DB::table('users')
                ->where('id', '=', $logged)
                ->get();
		
		$data = array( 'site_setting' => $site_setting, 'userlog' => $userlog );
            return view('create-custom-service')->with($data);
	   
	   

    }	
	 
	 
	 
	 
    public function sangvish_viewjob()
    {
       
		
		$countries = array(
	'Afghanistan',
	'Albania',
	'Algeria',
	'American Samoa',
	'Andorra',
	'Angola',
	'Anguilla',
	'Antarctica',
	'Antigua and Barbuda',
	'Argentina',
	'Armenia',
	'Aruba',
	'Australia',
	'Austria',
	'Azerbaijan',
	'Bahamas',
	'Bahrain',
	'Bangladesh',
	'Barbados',
	'Belarus',
	'Belgium',
	'Belize',
	'Benin',
	'Bermuda',
	'Bhutan',
	'Bolivia',
	'Bosnia and Herzegowina',
	'Botswana',
	'Bouvet Island',
	'Brazil',
	'British Indian Ocean Territory',
	'Brunei Darussalam',
	'Bulgaria',
	'Burkina Faso',
	'Burundi',
	'Cambodia',
	'Cameroon',
	'Canada',
	'Cape Verde',
	'Cayman Islands',
	'Central African Republic',
	'Chad',
	'Chile',
	'China',
	'Christmas Island',
	'Cocos (Keeling) Islands',
	'Colombia',
	'Comoros',
	'Congo',
	'Congo, the Democratic Republic of the',
	'Cook Islands',
	'Costa Rica',
	'Cote d\'Ivoire',
	'Croatia (Hrvatska)',
	'Cuba',
	'Cyprus',
	'Czech Republic',
	'Denmark',
	'Djibouti',
	'Dominica',
	'Dominican Republic',
	'East Timor',
	'Ecuador',
	'Egypt',
	'El Salvador',
	'Equatorial Guinea',
	'Eritrea',
	'Estonia',
	'Ethiopia',
	'Falkland Islands (Malvinas)',
	'Faroe Islands',
	'Fiji',
	'Finland',
	'France',
	'France Metropolitan',
	'French Guiana',
	'French Polynesia',
	'French Southern Territories',
	'Gabon',
	'Gambia',
	'Georgia',
	'Germany',
	'Ghana',
	'Gibraltar',
	'Greece',
	'Greenland',
	'Grenada',
	'Guadeloupe',
	'Guam',
	'Guatemala',
	'Guinea',
	'Guinea-Bissau',
	'Guyana',
	'Haiti',
	'Heard and Mc Donald Islands',
	'Holy See (Vatican City State)',
	'Honduras',
	'Hong Kong',
	'Hungary',
	'Iceland',
	'India',
	'Indonesia',
	'Iran (Islamic Republic of)',
	'Iraq',
	'Ireland',
	'Israel',
	'Italy',
	'Jamaica',
	'Japan',
	'Jordan',
	'Kazakhstan',
	'Kenya',
	'Kiribati',
	'Korea, Democratic People\'s Republic of',
	'Korea, Republic of',
	'Kuwait',
	'Kyrgyzstan',
	'Lao, People\'s Democratic Republic',
	'Latvia',
	'Lebanon',
	'Lesotho',
	'Liberia',
	'Libyan Arab Jamahiriya',
	'Liechtenstein',
	'Lithuania',
	'Luxembourg',
	'Macau',
	'Macedonia, The Former Yugoslav Republic of',
	'Madagascar',
	'Malawi',
	'Malaysia',
	'Maldives',
	'Mali',
	'Malta',
	'Marshall Islands',
	'Martinique',
	'Mauritania',
	'Mauritius',
	'Mayotte',
	'Mexico',
	'Micronesia, Federated States of',
	'Moldova, Republic of',
	'Monaco',
	'Mongolia',
	'Montserrat',
	'Morocco',
	'Mozambique',
	'Myanmar',
	'Namibia',
	'Nauru',
	'Nepal',
	'Netherlands',
	'Netherlands Antilles',
	'New Caledonia',
	'New Zealand',
	'Nicaragua',
	'Niger',
	'Nigeria',
	'Niue',
	'Norfolk Island',
	'Northern Mariana Islands',
	'Norway',
	'Oman',
	'Pakistan',
	'Palau',
	'Panama',
	'Papua New Guinea',
	'Paraguay',
	'Peru',
	'Philippines',
	'Pitcairn',
	'Poland',
	'Portugal',
	'Puerto Rico',
	'Qatar',
	'Reunion',
	'Romania',
	'Russian Federation',
	'Rwanda',
	'Saint Kitts and Nevis',
	'Saint Lucia',
	'Saint Vincent and the Grenadines',
	'Samoa',
	'San Marino',
	'Sao Tome and Principe',
	'Saudi Arabia',
	'Senegal',
	'Seychelles',
	'Sierra Leone',
	'Singapore',
	'Slovakia (Slovak Republic)',
	'Slovenia',
	'Solomon Islands',
	'Somalia',
	'South Africa',
	'South Georgia and the South Sandwich Islands',
	'Spain',
	'Sri Lanka',
	'St. Helena',
	'St. Pierre and Miquelon',
	'Sudan',
	'Suriname',
	'Svalbard and Jan Mayen Islands',
	'Swaziland',
	'Sweden',
	'Switzerland',
	'Syrian Arab Republic',
	'Taiwan, Province of China',
	'Tajikistan',
	'Tanzania, United Republic of',
	'Thailand',
	'Togo',
	'Tokelau',
	'Tonga',
	'Trinidad and Tobago',
	'Tunisia',
	'Turkey',
	'Turkmenistan',
	'Turks and Caicos Islands',
	'Tuvalu',
	'Uganda',
	'Ukraine',
	'United Arab Emirates',
	'United Kingdom',
	'United States',
	'United States Minor Outlying Islands',
	'Uruguay',
	'Uzbekistan',
	'Vanuatu',
	'Venezuela',
	'Vietnam',
	'Virgin Islands (British)',
	'Virgin Islands (U.S.)',
	'Wallis and Futuna Islands',
	'Western Sahara',
	'Yemen',
	'Yugoslavia',
	'Zambia',
	'Zimbabwe'
);

		
		
		
	
	    $sellermail = Auth::user()->email;
    	 				
		
		
		$admin_idd=1;
		
		$admin_email_id = DB::table('users')
                ->where('id', '=', $admin_idd)
                ->get();
		
		
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		
		
		
		
		
		
		$viewcati = 	DB::table('category')
		->orderBy('name', 'asc')
		->get();	
$viewcati_cnt = 	DB::table('category')
		->orderBy('name', 'asc')
		->count();

       
		$logged = Auth::user()->id;
		$userlog = DB::table('users')
                ->where('id', '=', $logged)
                ->get();

      
		
		$data = array( 'viewcati' => $viewcati, 'viewcati_cnt' => $viewcati_cnt, 'admin_email_id' => $admin_email_id, 'site_setting' => $site_setting, 'userlog' => $userlog, 'countries' => $countries);
            return view('new-service')->with($data);
    }
	
	
	
	
	
	
	
	
	
	
	public function edit_job($gid)
    {
       
		
		$countries = array(
	'Afghanistan',
	'Albania',
	'Algeria',
	'American Samoa',
	'Andorra',
	'Angola',
	'Anguilla',
	'Antarctica',
	'Antigua and Barbuda',
	'Argentina',
	'Armenia',
	'Aruba',
	'Australia',
	'Austria',
	'Azerbaijan',
	'Bahamas',
	'Bahrain',
	'Bangladesh',
	'Barbados',
	'Belarus',
	'Belgium',
	'Belize',
	'Benin',
	'Bermuda',
	'Bhutan',
	'Bolivia',
	'Bosnia and Herzegowina',
	'Botswana',
	'Bouvet Island',
	'Brazil',
	'British Indian Ocean Territory',
	'Brunei Darussalam',
	'Bulgaria',
	'Burkina Faso',
	'Burundi',
	'Cambodia',
	'Cameroon',
	'Canada',
	'Cape Verde',
	'Cayman Islands',
	'Central African Republic',
	'Chad',
	'Chile',
	'China',
	'Christmas Island',
	'Cocos (Keeling) Islands',
	'Colombia',
	'Comoros',
	'Congo',
	'Congo, the Democratic Republic of the',
	'Cook Islands',
	'Costa Rica',
	'Cote d\'Ivoire',
	'Croatia (Hrvatska)',
	'Cuba',
	'Cyprus',
	'Czech Republic',
	'Denmark',
	'Djibouti',
	'Dominica',
	'Dominican Republic',
	'East Timor',
	'Ecuador',
	'Egypt',
	'El Salvador',
	'Equatorial Guinea',
	'Eritrea',
	'Estonia',
	'Ethiopia',
	'Falkland Islands (Malvinas)',
	'Faroe Islands',
	'Fiji',
	'Finland',
	'France',
	'France Metropolitan',
	'French Guiana',
	'French Polynesia',
	'French Southern Territories',
	'Gabon',
	'Gambia',
	'Georgia',
	'Germany',
	'Ghana',
	'Gibraltar',
	'Greece',
	'Greenland',
	'Grenada',
	'Guadeloupe',
	'Guam',
	'Guatemala',
	'Guinea',
	'Guinea-Bissau',
	'Guyana',
	'Haiti',
	'Heard and Mc Donald Islands',
	'Holy See (Vatican City State)',
	'Honduras',
	'Hong Kong',
	'Hungary',
	'Iceland',
	'India',
	'Indonesia',
	'Iran (Islamic Republic of)',
	'Iraq',
	'Ireland',
	'Israel',
	'Italy',
	'Jamaica',
	'Japan',
	'Jordan',
	'Kazakhstan',
	'Kenya',
	'Kiribati',
	'Korea, Democratic People\'s Republic of',
	'Korea, Republic of',
	'Kuwait',
	'Kyrgyzstan',
	'Lao, People\'s Democratic Republic',
	'Latvia',
	'Lebanon',
	'Lesotho',
	'Liberia',
	'Libyan Arab Jamahiriya',
	'Liechtenstein',
	'Lithuania',
	'Luxembourg',
	'Macau',
	'Macedonia, The Former Yugoslav Republic of',
	'Madagascar',
	'Malawi',
	'Malaysia',
	'Maldives',
	'Mali',
	'Malta',
	'Marshall Islands',
	'Martinique',
	'Mauritania',
	'Mauritius',
	'Mayotte',
	'Mexico',
	'Micronesia, Federated States of',
	'Moldova, Republic of',
	'Monaco',
	'Mongolia',
	'Montserrat',
	'Morocco',
	'Mozambique',
	'Myanmar',
	'Namibia',
	'Nauru',
	'Nepal',
	'Netherlands',
	'Netherlands Antilles',
	'New Caledonia',
	'New Zealand',
	'Nicaragua',
	'Niger',
	'Nigeria',
	'Niue',
	'Norfolk Island',
	'Northern Mariana Islands',
	'Norway',
	'Oman',
	'Pakistan',
	'Palau',
	'Panama',
	'Papua New Guinea',
	'Paraguay',
	'Peru',
	'Philippines',
	'Pitcairn',
	'Poland',
	'Portugal',
	'Puerto Rico',
	'Qatar',
	'Reunion',
	'Romania',
	'Russian Federation',
	'Rwanda',
	'Saint Kitts and Nevis',
	'Saint Lucia',
	'Saint Vincent and the Grenadines',
	'Samoa',
	'San Marino',
	'Sao Tome and Principe',
	'Saudi Arabia',
	'Senegal',
	'Seychelles',
	'Sierra Leone',
	'Singapore',
	'Slovakia (Slovak Republic)',
	'Slovenia',
	'Solomon Islands',
	'Somalia',
	'South Africa',
	'South Georgia and the South Sandwich Islands',
	'Spain',
	'Sri Lanka',
	'St. Helena',
	'St. Pierre and Miquelon',
	'Sudan',
	'Suriname',
	'Svalbard and Jan Mayen Islands',
	'Swaziland',
	'Sweden',
	'Switzerland',
	'Syrian Arab Republic',
	'Taiwan, Province of China',
	'Tajikistan',
	'Tanzania, United Republic of',
	'Thailand',
	'Togo',
	'Tokelau',
	'Tonga',
	'Trinidad and Tobago',
	'Tunisia',
	'Turkey',
	'Turkmenistan',
	'Turks and Caicos Islands',
	'Tuvalu',
	'Uganda',
	'Ukraine',
	'United Arab Emirates',
	'United Kingdom',
	'United States',
	'United States Minor Outlying Islands',
	'Uruguay',
	'Uzbekistan',
	'Vanuatu',
	'Venezuela',
	'Vietnam',
	'Virgin Islands (British)',
	'Virgin Islands (U.S.)',
	'Wallis and Futuna Islands',
	'Western Sahara',
	'Yemen',
	'Yugoslavia',
	'Zambia',
	'Zimbabwe'
);

		
		
		
	
	    $sellermail = Auth::user()->email;
    	 				
		
		
		$admin_idd=1;
		
		$admin_email_id = DB::table('users')
                ->where('id', '=', $admin_idd)
                ->get();
		
		
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		
		
		
		
		
		
		$viewcati = 	DB::table('category')
		->orderBy('name', 'asc')
		->get();	
$viewcati_cnt = 	DB::table('category')
		->orderBy('name', 'asc')
		->count();

       
		$logged = Auth::user()->id;
		$userlog = DB::table('users')
                ->where('id', '=', $logged)
                ->get();
				
		$view_job = DB::table('gigs')
                ->where('gid', '=', $gid)
                ->get();		
        
		$view_job_count = DB::table('gigs')
                ->where('gid', '=', $gid)
                ->count();
      
		
		$data = array( 'viewcati' => $viewcati, 'viewcati_cnt' => $viewcati_cnt, 'admin_email_id' => $admin_email_id, 'site_setting' => $site_setting,
		'userlog' => $userlog, 'countries' => $countries, 'view_job' => $view_job, 'view_job_count' => $view_job_count);
            return view('new-service')->with($data);
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
public function resend_confirmation($it)
{	

     $user_details = DB::table('users')
                ->where('id', '=', $it)
                ->get();
				
	$name = $user_details[0]->name;
		$email = $user_details[0]->email;
		$keyval = $user_details[0]->confirm_key;			
				

    $setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$admin_email = $setts[0]->site_email;
		
		$admin_name = $setts[0]->site_email_name;
		
      $datas = [
            'name' => $name, 'email' => $email, 'keyval' => $keyval, 'site_logo' => $site_logo,
			'site_name' => $site_name, 'url' => $url
        ];
		
		Mail::send('confirm_mail', $datas , function ($message) use ($admin_email,$admin_name,$email)
        {
		
		
		
		
            $message->subject('Email Confirmation for Registration');
			
            $message->from($admin_email, $admin_name);

            $message->to($email);

        }); 
		
    return redirect()->back()->with('message', 'Email confirmation has been sent');


}

public function feature($id)
{
	
	
	$gig = DB::table('gigs')
				->where('gid', '=', $id)
				
				->get();
				
	$gig_cnt = DB::table('gigs')
				->where('gid', '=', $id)
				->count();
				
	$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);						
				
	$data = array('gig' => $gig, 'gig_cnt' => $gig_cnt, 'site_setting' => $site_setting);
	
	return view('feature')->with($data);
}


public function feature_view()
{
	
	return view('feature');
}








public function confirmation($it)
{
	
	DB::update('update users set confirmation="1" where confirm_key="'.$it.'"');
	return view('confirmemail');
	
}

public function view_former()
{
	return view('confirmemail');
}	




 public function sangvish_addshop()
    {
       
		
		
		
		
		

      $time = array("12:00 AM"=>"0", "01:00 AM"=>"1", "02:00 AM"=>"2", "03:00 AM"=>"3", "04:00 AM"=>"4", "05:00 AM"=>"5", "06:00 AM"=>"6", "07:00 AM"=>"7", "08:00 AM"=>"8",
	 "09:00 AM"=>"9", "10:00 AM"=>"10", "11:00 AM"=>"11", "12:00 PM"=>"12", "01:00 PM"=>"13", "02:00 PM"=>"14", "03:00 PM"=>"15", "04:00 PM"=>"16", "05:00 PM"=>"17", "06:00 PM"=>"18",
	 "07:00 PM"=>"19", "08:00 PM"=>"20", "09:00 PM"=>"21", "10:00 PM"=>"22", "11:00 PM"=>"23");
	 
	 $days=array("1 Day" => "1", "2 Days" => "2", "3 Days" => "3", "4 Days" => "4", "5 Days" => "5", "6 Days" => "6", "7 Days" => "7", "8 Days" => "8", "9 Days" => "9",
			"10 Days" => "10", "11 Days" => "11", "12 Days" => "12", "13 Days" => "13", "14 Days" => "14", "15 Days" => "15", "16 Days" => "16", "17 Days" => "17", "18 Days" => "18",
			"19 Days" => "19", "20 Days" => "20", "21 Days" => "21", "22 Days" => "22", "23 Days" => "23", "24 Days" => "24", "25 Days" => "25", "26 Days" => "26", "27 Days" => "27",
			"28 Days" => "28", "29 Days" => "29", "30 Days" => "30");
		
		
	$daytxt=array("Sunday" => "0", "Monday" => "1", "Tuesday" => "2", "Wednesday" => "3", "Thursday" => "4", "Friday" => "5", "Saturday" => "6");

	    $sellermail = Auth::user()->email;
    	 

   
          				
		
		
		$admin_idd=1;
		
		$admin_email_id = DB::table('users')
                ->where('id', '=', $admin_idd)
                ->get();
		
		
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		
		
		
		
		
		$data = array('time' => $time, 'days' =>  $days, 'daytxt' => $daytxt, 'admin_email_id' => $admin_email_id,
		'site_setting' => $site_setting);
            return view('addshop')->with($data);
    }
	










	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function sangvish_editshop(Request $request)
    {
       
		
		
		
		
		$testimonials = DB::table('testimonials')->orderBy('id', 'desc')->get();

      $time = array("12:00 AM"=>"0", "01:00 AM"=>"1", "02:00 AM"=>"2", "03:00 AM"=>"3", "04:00 AM"=>"4", "05:00 AM"=>"5", "06:00 AM"=>"6", "07:00 AM"=>"7", "08:00 AM"=>"8",
	 "09:00 AM"=>"9", "10:00 AM"=>"10", "11:00 AM"=>"11", "12:00 PM"=>"12", "01:00 PM"=>"13", "02:00 PM"=>"14", "03:00 PM"=>"15", "04:00 PM"=>"16", "05:00 PM"=>"17", "06:00 PM"=>"18",
	 "07:00 PM"=>"19", "08:00 PM"=>"20", "09:00 PM"=>"21", "10:00 PM"=>"22", "11:00 PM"=>"23");
	 
	 $days=array("1 Day" => "1", "2 Days" => "2", "3 Days" => "3", "4 Days" => "4", "5 Days" => "5", "6 Days" => "6", "7 Days" => "7", "8 Days" => "8", "9 Days" => "9",
			"10 Days" => "10", "11 Days" => "11", "12 Days" => "12", "13 Days" => "13", "14 Days" => "14", "15 Days" => "15", "16 Days" => "16", "17 Days" => "17", "18 Days" => "18",
			"19 Days" => "19", "20 Days" => "20", "21 Days" => "21", "22 Days" => "22", "23 Days" => "23", "24 Days" => "24", "25 Days" => "25", "26 Days" => "26", "27 Days" => "27",
			"28 Days" => "28", "29 Days" => "29", "30 Days" => "30");
		
		
	$daytxt=array("Sunday" => "0", "Monday" => "1", "Tuesday" => "2", "Wednesday" => "3", "Thursday" => "4", "Friday" => "5", "Saturday" => "6");

	    $sellermail = Auth::user()->email;
    	 $shopcount = DB::table('shop')
		 ->where('seller_email', '=', $sellermail)
		 ->count();

   
          $shop = DB::table('shop')
                ->where('seller_email', '=', $sellermail)
                ->get();				
		
		
		
		if($shop[0]->start_time > 12)
					{
						$start=$shop[0]->start_time - 12;
						$stime=$start."PM";
					}
					else
					{
						$stime=$shop[0]->start_time."AM";
					}
					if($shop[0]->end_time>12)
					{
						$end=$shop[0]->end_time-12;
						$etime=$end."PM";
					}
					else
					{
						$etime=$shop[0]->end_time."AM";
					}
		
		$sel=explode(",",$shop[0]->shop_date);
		$lev=count($sel);
		
		
		$requestid = $request->id;
		
		$editshop = DB::select('select * from shop where id = ?',[$requestid]);
		
		
		
		
		
		
		$data = array('time' => $time, 'days' =>  $days, 'daytxt' => $daytxt, 'shopcount' => $shopcount, 'shop' => $shop, 'stime' => $stime,
		'etime' => $etime, 'lev' => $lev, 'sel' => $sel, 'requestid' => $requestid, 'editshop' => $editshop);
            return view('editshop')->with($data);
    }
	
	
	
	
	
	
	
	
	public function customorder_view($id)
	{
		$siteid=1;
	$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
	
	$logged = Auth::user()->id;
		$userlog = DB::table('users')
                ->where('id', '=', $logged)
                ->get();
				
		$gig_details = DB::table('gigs')
		 ->where('gid', '=', $id)
		 
		 ->get();
		 	$gig_counter = DB::table('gigs')
		 ->where('gid', '=', $id)
		 ->where('delete_status','=','')
		 ->where('status','=',1)
		 ->count();	
				
	
      $data = array('site_setting' => $site_setting, 'id' => $id, 'userlog' => $userlog, 'gig_details' => $gig_details, 'gig_counter' => $gig_counter);	
		return view('customorder')->with($data);
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function custom_order($id)
	{
		
	$logid = Auth::user()->id;	
	
	$siteid=1;
	$site_setting=DB::select('select * from settings where id = ?',[$siteid]);	
	
	
	$gig_details = DB::table('gigs')
		 ->where('gid', '=', $id)
		 ->where('user_id', '=', $logid)
		 ->get();
		 
		 
	$gig_counter = DB::table('gigs')
		 ->where('gid', '=', $id)
		 ->where('user_id', '=', $logid)
		 ->where('delete_status','=','')
		 ->where('status','=',1)
		 ->count();		 
		 
		 
	$user_details = DB::table('users')
		 ->where('admin', '!=', 1)
		 ->where('id', '!=', $logid)
		 ->get();	 
		 
	$data = array('gig_details' => $gig_details, 'site_setting' => $site_setting, 'id' => $id, 'user_details' => $user_details, 'gig_counter' => $gig_counter);
	return view('custom_order')->with($data);	
		
		
	}
	
	
	
	
	
	protected function custom_order_data(Request $request)
	{
		$data = $request->all();
		$order_url = $data['order_url'];
		$selected_users = $data['selected_users'];
		
		$user_details = DB::table('users')
		            	 ->where('id', '=', $selected_users)
		                 ->get();
         
		  $logged_id = Auth::user()->id;
		 
         $get_name = $user_details[0]->name;
 		 $get_email = $user_details[0]->email;


        $user_view = DB::table('users')
		            	 ->where('id', '=', $logged_id)
		                 ->get();

        $sender_name = $user_view[0]->name;						 
		
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
		 
		Mail::send('custom_order_mail', ['order_url' => $order_url, 'get_email' => $get_email,'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url, 'sender_name' => $sender_name], function ($message) use ($get_email,$admin_email)
        {
            $message->subject('Custom Order Received');
			
            $message->from($admin_email, 'Admin');

            $message->to($get_email);

        }); 
		
		return back()->with('success', 'Your custom order has been sent.');
		
		
	}
	
	
	
	
	
	protected function custom_savedata(Request $request)
	{
		
		$data = $request->all();
		$subject=$data['subject'];
		$price=$data['price'];
		$description =$data['description'];
		$complete_days = $data['complete_days'];
		$status = 1;
		$logid = Auth::user()->id;
		$key = uniqid();
		$job_type = "custom";
		
		
		$ban_word_count = DB::table('banned')
		      ->where('type','=','word')
			   ->count();
			   
	    if(!empty($ban_word_count))
		{			
			   
		 $ban_word = DB::table('banned')
		      ->where('type','=','word')
			   ->get();
		
        $txt = "";		
		foreach($ban_word as $banword)
		{
			$txt .= $banword->content.' '; 
			
        }	
        $text = rtrim($txt," ");		
			   
		}
		
		
		if ((strpos($text, $description) !== false) || (strpos($text, $subject) !== false))
		{
			return redirect()->back()->with("error", "Please don't entered banned words");
		}
         else
	   {
		 
		
		
		
		
		
		
		DB::insert('insert into gigs (token,user_id,giger_id,subject,price,description,complete_days,job_type,status) values (?, ?,?, ?, ?,?, ?, ?, ?)', [$key,$logid,$logid,$subject,$price,$description,$complete_days,$job_type,$status]);
		
		$view_gigs=DB::select('select * from gigs where token = ?',[$key]);	
		return redirect('custom_order/'.$view_gigs[0]->gid);
	     
	   }
		 
	
	
	
	}
	
	
	
	
	
	
	
	
	protected function savedata(Request $request)
    {
        
		
		
		 $data = $request->all();
		
		
		
		
         
		 if(empty($data['edit_gid']))
		{
		 
		 $rules = array(
               
		
		
		'image' => 'required',
		'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
		
		
        );
		
		}
		else
		{
			$rules = array();
			
		}
		
		$messages = array(
            
            'subject' => 'The :attribute field is already exists',
            'price' => 'The :attribute field must only be numbers'
			
			
        );
		
	
		 $validator = Validator::make(Input::all(), $rules, $messages);
		 
		


		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			 
			/* return back()->withErrors($validator);*/
			return Redirect::back()->withInput($request->input())
                    ->withErrors($validator);
		}
		else
		{ 
		
	     
		 
		 
			

		  
		
	
		

			
		$subject=$data['subject'];
		$price=$data['price'];
		
		
		/*$split = explode("_", $data['category']);*/
		
		$category = $data['category'];
		$category_type = 'cat';
		
		if(!empty($data['subcategory']))
		{
		
		$subcategory = $data['subcategory'];
		}
		else
		{
			$subcategory = 0;
		}
		
		
		$description =$data['description'];
		$instruction = $data['instruction'];
		$tags = $data['tags'];
		$complete_days = $data['complete_days'];
		
		
		if(!empty($data['video_url']))
		{
		$video_url = $data['video_url'];
		}
		else
		{
			$video_url = "";
		}
		
		
		if(!empty($data['maximum_qty']))
		{
			$maximum_qty = $data['maximum_qty'];
		}
		else
		{
			$maximum_qty = "";
		}
		
		if(!empty($data['extra_text1']))
		{
			$extra_text1 = $data['extra_text1'];
		}
		else
		{
			$extra_text1 = "";
		}
		
		if(!empty($data['extra_text2']))
		{
			$extra_text2 = $data['extra_text2'];
		}
		else
		{
			$extra_text2 = "";
		}
		
		if(!empty($data['extra_text3']))
		{
			$extra_text3 = $data['extra_text3'];
		}
		else
		{
			$extra_text3 = "";
		}
		
		
		
		if(!empty($data['extra_price1']))
		{
			$extra_price1 = $data['extra_price1'];
		}
		else
		{
			$extra_price1 = "";
		}
		
		
		if(!empty($data['extra_price2']))
		{
			$extra_price2 = $data['extra_price2'];
		}
		else
		{
			$extra_price2 = "";
		}
		
		
		if(!empty($data['extra_price3']))
		{
			$extra_price3 = $data['extra_price3'];
		}
		else
		{
			$extra_price3 = "";
		}
		
		
		if(!empty($data['local_ship_price']))
		{
			$local_ship_price = $data['local_ship_price'];
		}
		else
		{
			$local_ship_price ="";
		}
		
		if(!empty($data['local_ship_place']))
		{
			$local_ship_place = $data['local_ship_place'];
		}
		else
		{
			$local_ship_place = "";
		}
		
		if(!empty($data['world_ship_price']))
		{
			$world_ship_price = $data['world_ship_price'];
		}
		else
		{
			$world_ship_price = "";
		}
		
		
		if(!empty($data['quantity']))
		{
			$gig_type = $data['quantity']; 
		}
		else if(!empty($data['extra']))
		{
			$gig_type = $data['extra'];
		}
		else if(!empty($data['shipping']))
		{
			$gig_type = $data['shipping'];
		}
		else
		{
			$gig_type = "";
		}
		
		
		
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);		
		
		if($site_setting[0]->approve_gigs=="yes")
		{
			$status = 0;
		}
         else

		 {
			 $status = 1;
		 }			 
		
		$logid = Auth::user()->id;
		
		$site_logo=$data['site_logo'];
		
		$site_name=$data['site_name'];
		
		$admin_email = $site_setting[0]->site_email;
		
		$admin_name = $site_setting[0]->site_email_name;
		
		$user_email = Auth::user()->email;
		
		
		
		$submit_date = date("Y-m-d");
		
		
		
		
		
		
		$ban_word_count = DB::table('banned')
		      ->where('type','=','word')
			   ->count();
			   
	    if(!empty($ban_word_count))
		{			
			   
		 $ban_word = DB::table('banned')
		      ->where('type','=','word')
			   ->get();
		
        $txt = "";		
		foreach($ban_word as $banword)
		{
			$txt .= $banword->content.' '; 
			
        }	
        $text = rtrim($txt," ");		
			   
		}
		
		
		if ((strpos($text, $description) !== false) || (strpos($text, $instruction) !== false) || (strpos($text, $subject) !== false))
		{
			return redirect()->back()->withInput($request->input())->with("error", "Please don't entered banned words");
		}
         else
	   {
		   
		
         $tag_array = explode(",", $tags);
         $result = count($tag_array);
		 
		 $miner = $site_setting[0]->min_tags;
		 $maxer = $site_setting[0]->max_tags;
		 
		 if($site_setting[0]->min_tags <= $result && $site_setting[0]->max_tags >= $result)
		 {
        		
		
		if(empty($data['edit_gid']))
		{
		$key = uniqid();
		DB::insert('insert into gigs (token,user_id,	giger_id,subject,price,category,category_type,subcategory,description,instruction,submit_date,tags,complete_days,
		video_url,gig_type,maximum_qty,extra_text1,extra_price1,extra_text2,extra_price2,extra_text3,extra_price3,local_ship_price,
		local_ship_place,world_ship_price,status) values (?, ?, ?, ?,?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$key,$logid,$logid,$subject,$price,
		$category,$category_type,$subcategory,$description,$instruction,$submit_date,$tags,$complete_days,$video_url,$gig_type,$maximum_qty,$extra_text1,$extra_price1,$extra_text2,$extra_price2,
		$extra_text3,$extra_price3,$local_ship_price,$local_ship_place,$world_ship_price,$status]);
		
		}
		else
		{
			
			$key = $data['key_token'];
			DB::update('update gigs set subject="'.$subject.'",price="'.$price.'",category="'.$category.'",category_type="'.$category_type.'",subcategory="'.$subcategory.'",description="'.$description.'",instruction="'.$instruction.'",submit_date="'.$submit_date.'",tags="'.$tags.'",complete_days="'.$complete_days.'",video_url="'.$video_url.'",gig_type="'.$gig_type.'", maximum_qty="'.$maximum_qty.'",extra_text1="'.$extra_text1.'",extra_price1="'.$extra_price1.'",extra_text2="'.$extra_text2.'",extra_price2="'.$extra_price2.'",extra_text3="'.$extra_text3.'",extra_price3="'.$extra_price3.'",local_ship_price="'.$local_ship_price.'",local_ship_place="'.$local_ship_place.'",world_ship_price="'.$world_ship_price.'" where gid = ?', [$data['edit_gid']]);
			
		}
		
		
		
		$picture = '';
			if ($request->hasFile('image')) {
				$files = $request->file('image');
				foreach($files as $file){
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					$picture = date('His').$filename;
					$destinationPath = base_path('images/gigs/');
					$file->move($destinationPath, $picture);
					
					DB::insert('insert into gig_images (token,image) values (?, ?)', [$key,$picture]);
					
				}
			}
			
		 }
         else
		 {
			 $rw = 'Minimum '.$miner.' tags and Maximum '.$maxer.' tags only allowed';
			 return redirect()->back()->withInput($request->input())->with('error', $rw);
		 }			 
			
			
			
		}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
       			
		
		$view_gigs=DB::select('select * from gigs where token = ?',[$key]);	
		
		
		
		if ((strpos($text, $description) !== false) || (strpos($text, $instruction) !== false) || (strpos($text, $subject) !== false))
		{
		}
		else
		{
			
			
		
		if(empty($data['edit_gid']))
		{
		
		if($site_setting[0]->approve_gigs=="yes")
		{

       Mail::send('jobuseremail', [ 'subject' => $subject, 'price' => $price, 'category' => $category, 'description' => $description,
	   'instruction' => $instruction, 'tags' => $tags, 'complete_days' => $complete_days, 'site_logo' => $site_logo,
	   'site_name' => $site_name ], function ($message)
        {
            $message->subject('Job Created Successfully');
			
           	
			
			$message->from(Input::get('site_email'), Input::get('site_email_name'));

            $message->to(Auth::user()->email);
			
			

        });
		
		
		
		
		
		Mail::send('jobuseremail', [ 'subject' => $subject, 'price' => $price, 'category' => $category, 'description' => $description,
	   'instruction' => $instruction, 'tags' => $tags, 'complete_days' => $complete_days, 'site_logo' => $site_logo,
	   'site_name' => $site_name ], function ($message)
        {
            $message->subject('Job Created Successfully');
			
           	
			
			$message->from(Input::get('site_email'), Input::get('site_email_name'));

            $message->to(Input::get('site_email'));
			
			

        });
		
		
		   if(Input::get('featured')==1)
		   {
			   
			   return redirect('feature/'.$view_gigs[0]->gid);
		   }
		   else
		   {
			  return redirect()->back()->withInput($request->input())->with('success', 'Your job has been submitted and will be displayed once approved.'); 
		   }
		
		
		
		
		
		
		}
		
		else
		{
			
			
			if(Input::get('featured')==1)
		   {
			   
			   return redirect('feature/'.$view_gigs[0]->gid);
		   }
		   else
		   {
			
			return redirect('service/'.$view_gigs[0]->gid);
			
		   }	
			
		}
		
		
		
		
		
		
		
		}
		
		else
		{
			
			
			
			if(Input::get('featured')==1)
		   {
			   
			   return redirect('feature/'.$data['edit_gid']);
		   }
		   else
		   {
			
			return redirect('service/'.$data['edit_gid']);
			
		   }
		}
		
		
		
		
		
		}
		
		
		
      
		
			
			
        
		
		
		
		
      }
	
	
	}
	
	
	
}

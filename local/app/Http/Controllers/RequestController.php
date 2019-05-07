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

class RequestController extends Controller
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
	
	
	
	public function feature_payment($buyer,$id,$gid)
	{
		
		$siteid=1;
	$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		$userlog = DB::table('users')
                   ->where('id', '=', $id)
                   ->get();
		$balance = $userlog[0]->wallet - $site_setting[0]->featured_gig_price;
		$ref_id = rand(11111,99999);
		DB::update('update users set wallet="'.$balance.'" where id = ?', [$id]);
		DB::update('update gigs set featured="1",reference_id="'.$ref_id.'" where gid = ?', [$gid]);
		
		$data = array('ref_id' => $ref_id);
		return view('feature-success')->with($data);
	}
	
	
	
	public function getajax($id)
    {
        $cities = DB::table("subcategory")
                    ->where("category","=",$id)
                    ->pluck("subname","subid");
        return json_encode($cities);
    }
	
	
	
	public function custom_pay($id)
	{
		
		$siteid=1;
	$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
	
	$logged = Auth::user()->id;
		$userlog = DB::table('users')
                ->where('id', '=', $logged)
                ->get();
				
		$gig_details = DB::table('gigs')
		 ->where('gid', '=', $id)
		 ->where('delete_status','=','')
		 ->where('status','=',1)
		 ->where('request_status','=',1)
		 ->where('job_type','=','request')
		 ->get();
		 
		 	$gig_counter = DB::table('gigs')
		 ->where('gid', '=', $id)
		 ->where('delete_status','=','')
		 ->where('status','=',1)
		 ->where('request_status','=',1)
		 ->where('job_type','=','request')
		 ->count();	
		 
		 
		 
		 $req_proposal_count = DB::table('request_proposal')
						->where('gid', '=', $id)
						->where('req_user_id','=',$logged)
						->where('award','=',1)
						->count();
						
		$req_proposal_get = DB::table('request_proposal')
						->where('gid', '=', $id)
						->where('req_user_id','=',$logged)
						->where('award','=',1)
						->get();		
	
      $data = array('site_setting' => $site_setting, 'id' => $id, 'userlog' => $userlog, 'gig_details' => $gig_details, 'gig_counter' => $gig_counter, 'req_proposal_count' => $req_proposal_count, 'req_proposal_get' => $req_proposal_get);	
		return view('pay_request')->with($data);
		
		
		
	}
	
	
	
	
	
	public function view_offers($id)
	{
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		$sql_request = DB::table('request')
		        ->where('status','=',1)
				->where('rid','=',$id)
                ->get();
				
		$sql_request_count = DB::table('request')
		        ->where('status','=',1)
				->where('rid','=',$id)
                ->count();
         
		 
		 $request_count = DB::table('request_offer')
		        
				->where('request_id','=',$id)
                ->count();
        $request = DB::table('request_offer')
		        
				->where('request_id','=',$id)
                ->get();
 				
		$data = array( 'sql_request' => $sql_request, 'sql_request_count' => $sql_request_count, 'site_setting' => $site_setting, 'request_count' => $request_count, 'request' => $request);		
		return view('view_offers')->with($data);
	}
	
	
	
	
	
	public function my_applied_request()
	{
		
		$logged = Auth::user()->id;
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);	
		$data = array( 'site_setting' => $site_setting);		
		return view('my_applied_request')->with($data);
		
	}
	
	
	public function my_request()
	{
		$logged = Auth::user()->id;
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);	
		$sql_request = DB::table('gigs')
		        ->where('status','=',1)
				->where('user_id','=',$logged)
                ->where('job_type','=','request')
				->orderBy('gid','desc')
				
                ->get();
		$data = array( 'sql_request' => $sql_request, 'site_setting' => $site_setting);		
		return view('my_request')->with($data);
	}	

     

    public function my_request_delete($delete,$id)
	{
		
		DB::update('update gigs set delete_status="deleted",status="0" where gid = ?', [$id]);
		/*DB::delete('delete from request where rid = ?',[$id]);*/
		return back();
	}		
	 
	 
	 protected function submit_offer(Request $request)
	 {
		 $data = $request->all();
		 $select_job = $data['select_job'];
		 $messages = $data['messages'];
		 $request_user_id = $data['request_user_id'];
		 $request_id = $data['request_id'];
		 $logged_user_id = $data['logged_user_id'];
		 
		 DB::insert('insert into request_offer (request_id,request_user_id,logged_user_id,gid,messages) values (?, ?, ?, ?, ?)', [$request_id,$request_user_id,$logged_user_id,$select_job,$messages]);
		 
		 return redirect()->back()->with('success', 'Your offer has been sent successfully');
	 }
	 
	 
	 public function seoUrl($string) {

    $string = trim($string); // Trim String

    $string = strtolower($string); //Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )

    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);  //Strip any unwanted characters

    $string = preg_replace("/[\s-]+/", " ", $string); // Clean multiple dashes or whitespaces

    $string = preg_replace("/[\s_]/", "-", $string); //Convert whitespaces and underscore to dash

    return $string;

     }
	 
	 protected function savedata(Request $request)
    {
        
		
		
		 $data = $request->all();
		 $request_name = $data['request_name'];
		 $describe_service = $data['describe_service'];
		 $split = explode("_", $data['category']);
		
		$category = $data['category'];
		$category_type = "cat";
		
		if(!empty($data['subcategory']))
		{
		$subcategory = $data['subcategory'];
		}
		else
		{
			$subcategory = 0;
		}
		if(!empty($data['request_skills']))
		{
		$request_skills = $data['request_skills'];
		
		$skiller = "";
		foreach($request_skills as $skll)
		{
			$skiller .=$skll.',';
		}
		$trsk = rtrim($skiller,',');
		}
		else
		{
			$trsk = "";
		}
		
		$budget_type = $data['budget_type'];
		
		
		if($data['fixed_price']!="custom_budget")
		{
		
			if(!empty($data['fixed_price']))
			{
				$fixed_price = $data['fixed_price'];
				$fixedprice = str_replace(" ","",$fixed_price);
				
				$pieces = explode("-", $fixedprice);
				$fixed_min = $pieces[0]; 
				$fixed_max = $pieces[1];
			}
			else
			{
				$fixed_min = 0;
				$fixed_max = 0;
			}
		}
		else
		{
			$fixed_min = 0;
			$fixed_max = 0;
			$fixed_price = 'custom_budget';
		}

        if($data['hour_price']!="custom_budget")
		{		
		
			if(!empty($data['hour_price']))
			{
				$hour_price = $data['hour_price'];
				$hourprice = str_replace(" ","",$hour_price);
			 $piecing = explode("-", $hourprice);
				$hour_min = $piecing[0]; 
				$hour_max = $piecing[1];
			}
			else
			{
				$hour_min = 0;
				$hour_max = 0;
			}
		}
		else
		{
			$hour_min = 0;
			$hour_max = 0;
			$hour_price = 'custom_budget';
		}

		 
		 
		
		
		
		
		
		
		if(!empty($data['minimum_budget']))
		{
		
		$minimum_budget = $data['minimum_budget'];
		}
		else
		{
		$minimum_budget = "";	
		}
		
		if(!empty($data['maximum_budget']))
		{
		$maximum_budget = $data['maximum_budget'];
		}
		else
		{
			$maximum_budget = "";
		}
		
		if(!empty($data['preferred_location']))
		{
			$preferred_location = $data['preferred_location'];
		}
		else
		{
			$preferred_location = "";
		}
		
		$requester = "request";
		
		
		if(!empty($data['delivery']))
		{
		$delivery = $data['delivery'];
		}
		else
		{
			$delivery = "";
		}
		 
		 $request_file = Input::file('request_file');
		 
		 
		 $siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);		
		
		if($site_setting[0]->approve_requests=="yes")
		{
			$status = 0;
		}
         else

		 {
			 $status = 1;
		 }
		 
		 
		 
         $logged = Auth::user()->id;
         
		 $today = date('Y-m-d');
		 
		 
		 
		 
		 
		 
		
		
		
		 
		 
		 $uniqid = uniqid(); 
		 
		 
		 
		 
		 
		 
		 $rules = array(
		
		/*'image' => 'required',*/
		'image.*' => 'mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:2048',
		'photo' => 'max:1024|mimes:jpg,jpeg,png'
		
		
		);
		
		
		$messages = array(
            
            
			
        );

		$validator = Validator::make(Input::all(), $rules, $messages);
		
		
		 
		 
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			/*return back()->withErrors($validator);*/
			return Redirect::back()->withInput($request->input())
                    ->withErrors($validator);
		}
		else
		{  
		 
		 
		 if($data['minimum_budget'] > $data['maximum_budget'])
		 {
			 return redirect()->back()->withInput($request->input())->with("error", "Please check minimum and maximum budget values");
		 }
		 else
		 {
		 
		 
		 
		 $tag_array = explode(",", $trsk);
         $result = count($tag_array);
		 
		 $miner = $site_setting[0]->min_skills;
		 $maxer = $site_setting[0]->max_skills;
		 
			 
		 
		 if($site_setting[0]->min_skills <= $result && $site_setting[0]->max_skills >= $result)
			 {
		 
		 
		 
		 
		 $banner = Input::file('photo');
		 
		 if($banner!="")
		{	
            $userphoto="/request/";
				
			$filename  = time() . '.' . $banner->getClientOriginalExtension();
            
            $path = base_path('images'.$userphoto);
      
                
				Input::file('photo')->move($path, $filename);
				$savebanner=$filename;
		}
        else
		{
			$savebanner="";
		}
		 
		 
		 
		    if(empty($data['edit_id']))
		 {
         DB::insert('insert into gigs (
		 token,user_id,subject,request_slug,featured_image,
		 description,category,category_type,subcategory,
		 complete_days,submit_date,status,
		 request_skills,budget_type,fixed_price,
		 hour_price,minimum_budget,maximum_budget,
		 fixed_minimum,fixed_maximum,hour_minimum,hour_maximum,job_type,preferred_location) values (?, ?,?, ?,  ?,?, ?, ?,  ?, ?, ?, ?,  ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?)', [
		 $uniqid,$logged,$request_name,
		 $this->seoUrl($request_name),$savebanner,$describe_service,$category,
		 $category_type,$subcategory,$delivery,$today,$status,
		 $trsk,$budget_type,$fixed_price,
		 $hour_price,$minimum_budget,$maximum_budget,$fixed_min,$fixed_max,$hour_min,$hour_max,$requester,$preferred_location]);
		 }
		 else
		 {
			 DB::update('update request set describe_service="'.$describe_service.'",category="'.$category.'",category_type="'.$category_type.'",subcategory="'.$subcategory.'",budget="'.$budget.'",delivery="'.$delivery.'",submit_date="'.$today.'",status="'.$status.'" where request_user_id ="'.$logged.'" and rid="'.$data['edit_id'].'"');
		 }
		 
		 
		 
		 
		   $picture = '';
			if ($request->hasFile('image')) {
				$files = $request->file('image');
				foreach($files as $file){
					/*$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					$picture = date('His').$filename;
					$destinationPath = base_path('images/request/');
					$file->move($destinationPath, $picture);*/
					
					
					
            $destinationPath = base_path('images/request/'); 
            
            $extension = $file->getClientOriginalExtension(); 
            
            $fileName = rand(11111, 99999) . '.' . $extension; 
            
            $file->move($destinationPath, $fileName);
					
					
					DB::insert('insert into request_file (token_key,file_name) values (?, ?)', [$uniqid,$fileName]);
					
				}
			}
			
			
			
			}
		 else
		 {
			 $rw = 'Minimum '.$miner.' skills and Maximum '.$maxer.' skills only allowed';
			 return redirect()->back()->withInput($request->input())->with('error', $rw);
		 }
			
			
			
			
		 
		  }
		  
		  
		  
		 
		  
		  
		  
		  
		  
		 
		}
		 
		 
		 
		 
		 
		 
		 
		 if($site_setting[0]->approve_requests=="yes")
		{
		 
		 return redirect()->back()->with('success', 'Your job has been submitted and will be displayed once approved.');
		}
		else

		 {
			return redirect()->back()->with('success', 'Your job has been submitted successfully');
		 }
		 
		 
		 
		 
	   
		 
		 
		
	}
	 
	 
	 
     
	 
		
	 
	 
    public function sangvish_view_request()
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
         
		 
		$skills_count = DB::table('skills')
                ->where('delete_status', '=', '')
                ->count(); 
        
		$skills_get = DB::table('skills')
                      ->where('delete_status', '=', '')
					  ->orderBy('skill','ASC')
                      ->get();
		
		
		$data = array( 'viewcati' => $viewcati, 'viewcati_cnt' => $viewcati_cnt, 'site_setting' => $site_setting,
		'countries' => $countries, 'skills_count' => $skills_count, 'skills_get' => $skills_get);
            return view('new-request')->with($data);
    }
	
	
	
	
	public function send_offer($id)
    {
		$edit = DB::table('request')
                ->where('rid', '=', $id)
				->where('status', '=', 1)
                ->get();
      $edit_count = DB::table('request')
                ->where('rid', '=', $id)
				->where('status', '=', 1)
                ->count();
		
       $logged = Auth::user()->id;
		
		$job = 	DB::table('gigs')
                ->where('user_id', '=', $logged)
				->where('status', '=', 1)
                ->get();	
		$job_count = 	DB::table('gigs')
                ->where('user_id', '=', $logged)
				->where('status', '=', 1)
                ->count();		
				
		$data = array( 'edit' => $edit, 'edit_count' => $edit_count, 'job' => $job, 'job_count' => $job_count, 'id' => $id, 'logged' => $logged);
            return view('send_offer')->with($data);		
		
       
	}
	
	
	
	 public function request_edit($id)
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
        $edit = DB::table('request')
                ->where('rid', '=', $id)
				->where('status', '=', 1)
                ->get();
      $edit_count = DB::table('request')
                ->where('rid', '=', $id)
				->where('status', '=', 1)
                ->count();
		
		$data = array( 'viewcati' => $viewcati, 'viewcati_cnt' => $viewcati_cnt, 'site_setting' => $site_setting,
		'countries' => $countries, 'edit' => $edit, 'edit_count' => $edit_count);
            return view('new-request')->with($data);
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
}

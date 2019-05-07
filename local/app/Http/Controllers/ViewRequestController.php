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

class ViewRequestController extends Controller
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
	 
	 public function type_request($status,$type)
	 {
		 
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);	
		$sql_request = DB::table('gigs')
		        ->where('status','=',1)
				->where('budget_type','=',$type)
				->where('job_type','=','request')
				->orderBy('gid','desc')
                ->get();
		$viewcati = 	DB::table('category')
		->orderBy('name', 'asc')
		->get();	
		$viewcati_cnt = 	DB::table('category')
		->orderBy('name', 'asc')
		->count();
		
		$cid = 0;
		
		$skills_count = DB::table('skills')
                ->where('delete_status', '=', '')
                ->count(); 
        
		$skills_get = DB::table('skills')
                      ->where('delete_status', '=', '')
					  ->orderBy('skill','ASC')
                      ->get();
		
		
		$data = array( 'sql_request' => $sql_request, 'site_setting' => $site_setting, 'viewcati' => $viewcati, 'viewcati_cnt' => $viewcati_cnt, 'cid' => $cid, 'skills_count' => $skills_count, 'skills_get' => $skills_get);		
		return view('buyer_request')->with($data);
		 
	 }
	 
	 public function view_request($cid)
	 {
		 $split = explode("_", $cid);
		
		$catid = $split[0];
		$type = $split[1];
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);	
		$sql_request = DB::table('gigs')
		        ->where('status','=',1)
				->where('category','=',$catid)
				->where('category_type','=',$type)
				->where('job_type','=','request')
                ->orderBy('gid','desc')
                ->get();
		$viewcati = 	DB::table('category')
		->orderBy('name', 'asc')
		->get();	
		$viewcati_cnt = 	DB::table('category')
		->orderBy('name', 'asc')
		->count();


        $skills_count = DB::table('skills')
                ->where('delete_status', '=', '')
                ->count(); 
        
		$skills_get = DB::table('skills')
                      ->where('delete_status', '=', '')
					  ->orderBy('skill','ASC')
                      ->get();

          $return = 0;					  
				
		$data = array( 'sql_request' => $sql_request, 'site_setting' => $site_setting, 'viewcati' => $viewcati, 'viewcati_cnt' => $viewcati_cnt, 'cid' => $cid, 'skills_count' => $skills_count, 'skills_get' => $skills_get, 'return' => $return);		
		return view('buyer_request')->with($data);
		
	 }
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	public function view_all_request()
	{
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);	
		$sql_request = DB::table('gigs')
		        ->where('status','=',1)
				->where('job_type','=','request')
                ->orderBy('gid','desc')
                ->get();
				
		$viewcati = 	DB::table('category')
		->orderBy('name', 'asc')
		->get();	
		$viewcati_cnt = 	DB::table('category')
		->orderBy('name', 'asc')
		->count();		
		$cid ="";	

        $skills_count = DB::table('skills')
                ->where('delete_status', '=', '')
                ->count(); 
        
		$skills_get = DB::table('skills')
                      ->where('delete_status', '=', '')
					  ->orderBy('skill','ASC')
                      ->get();
        $return = 0;
		
		$data = array( 'sql_request' => $sql_request, 'site_setting' => $site_setting, 'viewcati' => $viewcati, 'viewcati_cnt' => $viewcati_cnt, 'cid' => $cid, 'skills_count' => $skills_count, 'skills_get' => $skills_get, 'return' => $return);		
		return view('buyer_request')->with($data);
	}		
	
	
	
	protected function submit_data(Request $request)
	{
		$data = $request->all();
		
		$price_range = $data['price_range'];
		$welcome = explode(" ", $price_range);
				$fixed_miyum = $welcome[0]; 
				$fixed_mayum = $welcome[2];
				
				
		if(!empty($data['preferred_location']))
		{			
		$preferred_location = $data['preferred_location'];		
        }
        else
		{
			$preferred_location = "";
		}			
		
		if(!empty($data['request_skills']))
		{
			
			$request_skills = $data['request_skills'];
		
		$value_skill = "";
		foreach($request_skills as $skill)
		{
			$value_skill .= $skill.',';
		}
		$data_skill = rtrim($value_skill,',');
			
			$skiller = $data_skill;
		}
		else
		{ 
	      $skiller = "";
		}
		
		
		
		if(!empty($fixed_miyum))
		{
		$fixed_minimum = $fixed_miyum;
		}
		else 
		{
			$fixed_minimum = "";
		}
		
		if(!empty($fixed_mayum))
		{
		$fixed_maximum = $fixed_mayum;
		}
		else
		{
		
        $fixed_maximum = "";
		}

		if(!empty($data['hour_minimum']))
		{
		$hour_minimum = $data['hour_minimum'];
		}
		else
		{
			$hour_minimum = "";
		}
		
		
		if(!empty($data['hour_maximum"']))
		{
			
		$hour_maximum = $data['hour_maximum"'];
		}
		else
		{
			$hour_maximum = "";
		}
		
		
		
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
       
	   
	    if(!empty($data['featured']))
		{
			
			$sql_request = DB::table('gigs')
		        
		        
		        ->where('request_skills','!=','')
				->where('status','=',1)
				->where('delete_status','=','')
				->where('job_type','=','request')
				->where('featured','=',1)
				->orderBy('gid','desc')
				->get();
				
			$return = 1;	
				
			
			
		}

        if(!empty($data['request_skills']))
		{
		
		$sql_request = DB::table('gigs')
		        
		        
		        ->where('request_skills','!=','')
				->where('status','=',1)
				->where('delete_status','=','')
				->where('job_type','=','request')
				->where('preferred_location','LIKE','%'.$data['preferred_location'].'%')
				->orderBy('gid','desc')
				->get();
				
				$return = 2;
		} 
		
		
		if(!empty($data['preferred_location']))
		{
			$sql_request = DB::table('gigs')
		        
		        
		        
				->where('status','=',1)
				
				->where('delete_status','=','')
				->where('job_type','=','request')
				->where('preferred_location','LIKE','%'.$data['preferred_location'].'%')
				
				->orderBy('gid','desc')
				->get();
				
				$return = 3;
		}
		
		/*if(!empty($fixed_miyum))
		{
		
		$sql_request = DB::table('gigs')
		        
		        
		        
				->where('status','=',1)
				->where('delete_status','=','')
				->where('job_type','=','request')
				->where('fixed_minimum','>=',$fixed_minimum)
				->orderBy('gid','desc')
				->get();
		} 
		
		if(!empty($fixed_mayum))
		{
			
			$sql_request = DB::table('gigs')
		        
		        
		        
				->where('status','=',1)
				->where('delete_status','=','')
				->where('job_type','=','request')
				->where('fixed_maximum','<=',$fixed_maximum)
				->orderBy('gid','desc')
				->get();
			
		}*/
		
		
		
        if(!empty($price_range))
		{
			$sql_request = DB::table('gigs')
		        
		        
		        
				->where('status','=',1)
				->where('delete_status','=','')
				->where('job_type','=','request')
				->where('fixed_minimum','>',$fixed_minimum)
				->where('fixed_maximum','<',$fixed_maximum)
				
				->where('preferred_location','LIKE','%'.$data['preferred_location'].'%')
				->orderBy('gid','desc')
				->get();
				
				$return = 4;
		}
		
		
		
		if(!empty($price_range) && !empty($data['featured']))
		{
			$sql_request = DB::table('gigs')
		        
		        
		        
				->where('status','=',1)
				->where('delete_status','=','')
				->where('job_type','=','request')
				->where('fixed_minimum','>',$fixed_minimum)
				->where('fixed_maximum','<',$fixed_maximum)
				->where('featured','=',1)
				->where('preferred_location','LIKE','%'.$data['preferred_location'].'%')
				->orderBy('gid','desc')
				->get();
				
				$return = 44;
		}
		
		
		
		
		if(!empty($data['request_skills']) && !empty($price_range))
		{
		
		$sql_request = DB::table('gigs')
		        
		        
		        ->where('request_skills','!=','')
				->where('status','=',1)
				->where('delete_status','=','')
				->where('job_type','=','request')
				->where('fixed_minimum','>',$fixed_minimum)
				->where('fixed_maximum','<',$fixed_maximum)
				->orderBy('gid','desc')
				->get();
				
				$return = 5;
		} 
		
		
		
		if(!empty($data['request_skills']) && !empty($price_range) && !empty($data['featured']))
		{
		
		$sql_request = DB::table('gigs')
		        
		        
		        ->where('request_skills','!=','')
				->where('status','=',1)
				->where('delete_status','=','')
				->where('job_type','=','request')
				->where('fixed_minimum','>',$fixed_minimum)
				->where('fixed_maximum','<',$fixed_maximum)
				->where('featured','=',1)
				->orderBy('gid','desc')
				->get();
				
				$return = 55;
		} 
		
		
		
		
		if(!empty($data['request_skills']) && !empty($price_range) && !empty($data['preferred_location']))
		{
		 
		  $sql_request = DB::table('gigs')
		        
		        
		        ->where('request_skills','!=','')
				->where('status','=',1)
				->where('delete_status','=','')
				->where('job_type','=','request')
				->where('fixed_minimum','>',$fixed_minimum)
				->where('fixed_maximum','<',$fixed_maximum)
				->where('preferred_location','like','%'.$data['preferred_location'].'%')
				->orderBy('gid','desc')
				->get();
				
				$return = 6;

		}
		
		
		if(!empty($data['request_skills']) && !empty($price_range) && !empty($data['preferred_location']) && !empty($data['featured']))
		{
		 
		  $sql_request = DB::table('gigs')
		        
		        
		        ->where('request_skills','!=','')
				->where('status','=',1)
				->where('delete_status','=','')
				->where('job_type','=','request')
				->where('fixed_minimum','>',$fixed_minimum)
				->where('fixed_maximum','<',$fixed_maximum)
				->where('featured','=',1)
				->where('preferred_location','like','%'.$data['preferred_location'].'%')
				->orderBy('gid','desc')
				->get();
				
				$return = 66;

		}
		
		
		
		
		if(!empty($price_range) && !empty($data['preferred_location']))
			{
				$sql_request = DB::table('gigs')
		        
		        
		        
				->where('status','=',1)
				->where('delete_status','=','')
				->where('job_type','=','request')
				->where('fixed_minimum','>',$fixed_minimum)
				->where('fixed_maximum','<',$fixed_maximum)
				->where('preferred_location','like','%'.$data['preferred_location'].'%')
				->orderBy('gid','desc')
				->get();
				
				$return = 7;
			}
			
			
			
			if(!empty($price_range) && !empty($data['preferred_location']) && !empty($data['featured']))
			{
				$sql_request = DB::table('gigs')
		        
		        
		        
				->where('status','=',1)
				->where('delete_status','=','')
				->where('job_type','=','request')
				->where('fixed_minimum','>',$fixed_minimum)
				->where('fixed_maximum','<',$fixed_maximum)
				->where('featured','=',1)
				->where('preferred_location','like','%'.$data['preferred_location'].'%')
				->orderBy('gid','desc')
				->get();
				
				$return = 77;
			}
			
			
			
			
			if(!empty($data['request_skills']) && !empty($data['preferred_location']))
			{
			   $sql_request = DB::table('gigs')
		        
		        
		        ->where('request_skills','!=','')
				->where('status','=',1)
				->where('delete_status','=','')
				->where('job_type','=','request')
				
				->where('preferred_location','like','%'.$data['preferred_location'].'%')
				->orderBy('gid','desc')
				->get();
				
				$return = 8;
			}
			
			
			if(!empty($data['request_skills']) && !empty($data['preferred_location']) && !empty($data['featured']))
			{
			   $sql_request = DB::table('gigs')
		        
		        
		        ->where('request_skills','!=','')
				->where('status','=',1)
				->where('delete_status','=','')
				->where('job_type','=','request')
				->where('featured','=',1)
				->where('preferred_location','like','%'.$data['preferred_location'].'%')
				->orderBy('gid','desc')
				->get();
				
				$return = 88;
			}
			
		/*
		if(!empty($data['request_skills']) && !empty($data['hour_minimum']) && !empty($data['hour_maximum']))
		{
		
		$sql_request = DB::table('gigs')
		        
		        
		        ->where('request_skills','!=','')
				->where('status','=',1)
				->where('delete_status','=','')
				->where('job_type','=','request')
				->where('hour_minimum','>=',$hour_minimum)
				->where('hour_maximum','<=',$hour_maximum)
				->orderBy('gid','desc')
				->get();
		} 
		
		if(!empty($fixed_miyum) && !empty($fixed_mayum) && !empty($data['hour_minimum']) && !empty($data['hour_maximum']))
		{
			
			$sql_request = DB::table('gigs')
		        
		        
		        
				->where('status','=',1)
				->where('delete_status','=','')
				->where('job_type','=','request')
				->where('fixed_minimum','>=',$fixed_minimum)
				->where('fixed_maximum','<=',$fixed_maximum)
				->where('hour_minimum','>=',$hour_minimum)
				->where('hour_maximum','<=',$hour_maximum)
				->orderBy('gid','desc')
				->get();
		}
		
		
		
		if(!empty($data['request_skills']) && !empty($fixed_miyum) && !empty($fixed_mayum) && !empty($data['hour_minimum']) && !empty($data['hour_maximum']))
		{
			
			$sql_request = DB::table('gigs')
		        
		        
		        ->where('request_skills','!=','')
				->where('status','=',1)
				->where('delete_status','=','')
				->where('job_type','=','request')
				->where('fixed_minimum','>=',$fixed_minimum)
				->where('fixed_maximum','<=',$fixed_maximum)
				->where('hour_minimum','>=',$hour_minimum)
				->where('hour_maximum','<=',$hour_maximum)
				->orderBy('gid','desc')
				->get();
		}*/
		if(empty($data['request_skills']) && empty($price_range) && empty($data['preferred_location']))
		{
			$sql_request = DB::table('gigs')
		        
		        
		        ->where('request_skills','!=','')
				->where('status','=',1)
				->where('job_type','=','request')
				->where('delete_status','=','')
				
				->orderBy('gid','desc')
				->get();
				
			$return = 9; 
		}
		

          
      		
                
				
		$viewcati = 	DB::table('category')
		->orderBy('name', 'asc')
		->get();	
		$viewcati_cnt = 	DB::table('category')
		->orderBy('name', 'asc')
		->count();		
		$cid ="";	

        $skills_count = DB::table('skills')
                ->where('delete_status', '=', '')
                ->count(); 
        
		$skills_get = DB::table('skills')
                      ->where('delete_status', '=', '')
					  ->orderBy('skill','ASC')
                      ->get();
					  
					 if(!empty($data['featured']))
					 {						 
					$featured = $data['featured']; 
					 } else { $featured = 0; }					
		
		$data = array( 'sql_request' => $sql_request, 'site_setting' => $site_setting, 'viewcati' => $viewcati, 'viewcati_cnt' => $viewcati_cnt, 'cid' => $cid, 'skills_count' => $skills_count, 'skills_get' => $skills_get, 'data_skill' => $skiller, 'fixed_minimum' => $fixed_minimum, 'fixed_maximum' => $fixed_maximum, 'return' => $return, 'featured' => $featured);		
		return view('buyer_request')->with($data);
		
		
	}
	 
	 
    
	
	

	
}

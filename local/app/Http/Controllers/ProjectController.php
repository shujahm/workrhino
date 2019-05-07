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

class ProjectController extends Controller
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
	 
	 
	public function award_view($user_id,$req_id,$prop_id)
	{
		
		DB::update('update gigs set request_status="1",giger_id="'.$user_id.'" where gid = ?', [$req_id]);
		
		DB::update('update request_proposal set award="1" where prp_id = ?', [$prop_id]);
		return redirect()->back()->with('success', 'Great! Freelancers has been awarded successfully!');
		
	}
	
	
	
	public function single_view($id,$slug)
	{
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);	
		$sql_request_count = DB::table('gigs')
		        ->where('status','=',1)
				->where('delete_status','=','')
				->where('gid','=',$id)
                ->count();
				
		$sql_request = DB::table('gigs')
		        ->where('status','=',1)
				->where('delete_status','=','')
				->where('gid','=',$id)
                ->get();

         $min_price_count = DB::table('request_proposal')
		                     ->where('gid','=',$id)
				             ->orderBy('bid_price','asc')
							 ->count();
		if(!empty($min_price_count))
		{			
		$min_price = DB::table('request_proposal')
		                     ->where('gid','=',$id)
				             ->orderBy('bid_price','asc')
							 ->get();
		$price_min = $min_price[0]->bid_price;					 
		}
		else
		{
			$price_min = 0;
		}
		
		
		$max_price_count = DB::table('request_proposal')
		                     ->where('gid','=',$id)
				             ->orderBy('bid_price','desc')
							 ->count();
		if(!empty($max_price_count))
		{			
		$max_price = DB::table('request_proposal')
		                     ->where('gid','=',$id)
				             ->orderBy('bid_price','desc')
							 ->get();
		$price_max = $max_price[0]->bid_price;					 
		}
		else
		{
		$price_max = 0;	
		}
		
        	
        $total_bids = DB::table('request_proposal')
		                     ->where('gid','=',$id)
				             ->count();

		$get_bids = DB::table('request_proposal')
		                     ->where('gid','=',$id)
				             ->get();	
         				
				
		$data = array( 'sql_request' => $sql_request, 'sql_request_count' => $sql_request_count, 'site_setting' => $site_setting, 'min_price_count' => $min_price_count, 'price_min' => $price_min, 'max_price_count' => $max_price_count, 'price_max' => $price_max, 'total_bids' => $total_bids, 'get_bids' => $get_bids);		
		return view('project')->with($data);
	}	

     

    
	
	 protected function savedata(Request $request)
    {
      
	  $data = $request->all();
	  
	  $bid_price = $data['bid_price'];
	  $bid_email = $data['bid_email'];
	  $proposal = $data['proposal'];
	  $prop_user_id = $data['prop_user_id'];
	  $req_user_id = $data['req_user_id'];
	  $req_id = $data['gid'];
	  
	  $proposal_estimate = $data['proposal_estimate'];
	  
	  $today = date("Y-m-d");
	  
	  
	  $check_proposal = DB::table('request_proposal')
		               ->where('gid','=',$req_id)
				       ->where('prop_user_id','=',$prop_user_id)
				       ->count();
	  
	  if(!empty($check_proposal))
	  {
		 DB::update('update request_proposal set bid_price="'.$bid_price.'",bid_email="'.$bid_email.'",desc_proposal="'.$proposal.'",bid_date="'.$today.'",proposal_estimate="'.$proposal_estimate.'" where gid ="'.$req_id.'" and prop_user_id="'.$prop_user_id.'"');
	  }
	  else
	  {	  
	  DB::insert('insert into request_proposal (gid,req_user_id,prop_user_id,bid_price,bid_email,desc_proposal,bid_date,proposal_estimate) values (?,?,?,?,?,?,?,?)', [$req_id,$req_user_id,$prop_user_id,$bid_price,$bid_email,$proposal,$today,$proposal_estimate]);
	  
	  }
	  
	  
	  return redirect()->back()->with('success', 'Great! Your bid has been placed successfully! Good job!');
	  
	  
	  
	}  
	
	
	
	
	
	
	

	
}

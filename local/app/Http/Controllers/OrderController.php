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

class OrderController extends Controller
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
	
	
	public function coupon_data(Request $request)
	{
		$data = $request->all();
		$total_price = $data['total_price'];
		$gig_id = $data['gig_id'];
		$gig_type = $data['gigtype'];
		$ex_text = $data['extext'];
		$gig_name = $data['gig_name'];
		$sumvalue_four = $data['sumvalue_four'];
		$coupon_code = $data['coupon_code'];
		$login_id = Auth::user()->id;
		$tdate = date("Y-m-d");
		
		$settings = DB::table('settings')
			           ->where('id','=', 1)
					   ->get();
					   
					   
		$gig_display =  DB::table('gigs')
			           ->where('gid','=', $gig_id)
					   ->get();			   
		
		$data_coupon = DB::select("select * from coupons where coupon_name = '$coupon_code' and coupon_status = '1' and delete_status=''");
		
		$wellcount = count($data_coupon);
		
		if(!empty($wellcount))
		{
		
		
		if($data_coupon[0]->user_id==1)
		{
			
        
			
			$check_getter = DB::select("select * from gigs left join coupons on gigs.user_id != coupons.user_id where coupons.coupon_name = '$coupon_code' and coupons.coupon_status = '1' and coupons.delete_status='' and gigs.gid='$gig_id'");
			
			$get_coupon = count($check_getter);
			
		}
        else
		{
			
			$check_getts = DB::select("select * from gigs left join coupons on gigs.user_id = coupons.user_id where coupons.coupon_name = '$coupon_code' and coupons.coupon_status = '1' and coupons.delete_status='' and gigs.gid='$gig_id'");
			
			$get_coupon = count($check_getts);
			
		}			
			
			
			
			
			
			
		}			   
		
					   
									   
					   
				   
					   
		
					   
					   
		
					   
					   

        	

					   
		
		if(!empty($get_coupon))
		{
			
			
					   
			$first = DB::select("select * from coupons where coupon_name = '$coupon_code' and coupon_status = '1' and delete_status='' and first_time_purchase='yes'");		   
					   
			$first_purchase = count($first);		   
					   
					   
				   
					   
			$start = DB::select("select * from coupons where coupon_name = '$coupon_code' and coupon_status = '1' and delete_status='' and start_date!='' and end_date!=''");		   
					   
			$start_end_dates = count($start);	


				
					   
			
							  
				$checki = DB::select("select * from coupons where coupon_name = '$coupon_code' and coupon_status = '1' and delete_status='' and category_type!=''");		   
					   
			$check_category = count($checki);


				
							  
							  
							  
							  
							  
				$large = DB::select("select * from coupons where coupon_name = '$coupon_code' and coupon_status = '1' and delete_status='' and maximum_amount!=''");		   
					   
			$large_amount = count($large);			  
			
			
			 if(!empty($first_purchase) && empty($start_end_dates) && empty($check_category) && empty($large_amount))
			{
			
				 	   
						   
						 
			}
			
			
			
			if(empty($first_purchase) && !empty($start_end_dates) && empty($check_category) && empty($large_amount))
			{
			
				 	   
						   
						 
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
            if(empty($first_purchase) && empty($start_end_dates) && !empty($check_category) && empty($large_amount))
			{ 			
				
				
				if($data_coupon[0]->category_type=="cat")
					{
					
					
					$catett = $gig_display[0]->category;
						

                     $check_gett_count = DB::select("select * from coupons where coupon_name = '$coupon_code' and user_id != '$login_id' and category_type='cat' and category_id = '$catett' and delete_status=''");
							   
							   
							   
							   
							   
							   
						$new_count = count($check_gett_count);	   
							   
							   
							if(empty($new_count))
							{								
							   
							   $coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0;
							   
							   
							}  
                            else
							 {
								 
								 
								 
								$check_get = DB::select("select * from coupons where coupon_name = '$coupon_code' and user_id != '$login_id' and category_type='cat' and category_id = '$catett' and delete_status=''");
								 
								 
							   $coupon_amount = $check_get[0]->coupon_amount;
							   $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
								 $error = ""; 
								
								 
							 }								
							   
							   
					}
					if($data_coupon[0]->category_type=="subcat")
					{
					
												   
					$catetter = $gig_display[0]->subcategory;
					$subcat_txt = "subcat";
					$check_get_counnt = DB::select("select * from coupons where coupon_name = '$coupon_code' and user_id != '$login_id' and category_type='$subcat_txt' and category_id = '$catetter' and delete_status=''");		   
							   
							$new_count = count($check_get_counnt);	
							
							if(empty($new_count))
							{								
							   
							   $coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0; 
							   
							   
							   
							  
							   
							}  
                            else
							 {
								
							   $check_get = DB::select("select * from coupons where coupon_name = '$coupon_code' and user_id != '$login_id' and category_type='$subcat_txt' and category_id = '$catetter' and delete_status=''");
							   
							   $coupon_amount = $check_get[0]->coupon_amount;
							   $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
								 $error = "";
							    
							 }				   
							   
							   
							   
					}
					if($data_coupon[0]->category_type=="all")
					{
					
									   
									   
					$check_get_count = DB::select("select * from coupons where coupons.coupon_name = '$coupon_code' and coupons.user_id != '$login_id' and delete_status=''");				   
						   
						 $new_count = count($check_get_count);
						 if(empty($new_count))
						 {
							 
							 
							 $coupon_amount = "";
							 $coupon_type = "";
							 $error = "Coupon code not valid"; 
							 $coupon_id = 0; 
							 
							 
							 
							   						  
						 } 
                         else
						 {
							
							$check_get = DB::select("select * from coupons where coupons.coupon_name = '$coupon_code' and coupons.user_id != '$login_id' and delete_status=''");
						   
                          $coupon_amount =  $check_get[0]->coupon_amount;
						  $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
                          $error = ""; 
					      
							 
							 
							 
						 }							 
						   
					
				    }
				
				
				
				$return = 1;
				
			}
			
			
			
			
			
			
			
			
			
			
			
			
			if(empty($first_purchase) && empty($start_end_dates) && empty($check_category) && !empty($large_amount))
			{	
				
				
				
			}
			
			
			
			if(!empty($first_purchase) && !empty($start_end_dates) && empty($check_category) && empty($large_amount))
			{
			
			
			

            }
			
			
			
			
			
			
			
			
			
			
			
			
			if(empty($first_purchase) && !empty($start_end_dates) && !empty($check_category) && empty($large_amount))
			{
			
			$tdate = date("Y-m-d");
			
			    if($data_coupon[0]->category_type=="cat")
					{
					
					
					$catett = $gig_display[0]->category;
						

                     $check_gett_count = DB::select("select * from coupons where coupon_name = '$coupon_code' and user_id != '$login_id' and category_type='cat' and category_id = '$catett' and start_date <= '$tdate' and end_date >= '$tdate' and delete_status=''");
							   
							   
							   
							   
							   
							   
						$new_count = count($check_gett_count);	   
							   
							   
							if(empty($new_count))
							{								
							   
							   $coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0;
							   
							   
							}  
                            else
							 {
								 
								 
								 
								$check_get = DB::select("select * from coupons where coupon_name = '$coupon_code' and user_id != '$login_id' and category_type='cat' and category_id = '$catett' and start_date <= '$tdate' and end_date >= '$tdate' and delete_status=''");
								 
								 
							   $coupon_amount = $check_get[0]->coupon_amount;
							   $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
								 $error = ""; 
								
								 
							 }								
							   
							   
					}
					if($data_coupon[0]->category_type=="subcat")
					{
					
												   
					$catetter = $gig_display[0]->subcategory;
					$subcat_txt = "subcat";
					$check_get_counnt = DB::select("select * from coupons where coupon_name = '$coupon_code' and user_id != '$login_id' and category_type='$subcat_txt' and category_id = '$catetter' and start_date <= '$tdate' and end_date >= '$tdate' and delete_status=''");		   
							   
							$new_count = count($check_get_counnt);	
							
							if(empty($new_count))
							{								
							   
							   
								 
								 $coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0; 
								 
								 
							  
							   
							}  
                            else
							 {
								$check_get = DB::select("select * from coupons where coupon_name = '$coupon_code' and user_id != '$login_id' and category_type='$subcat_txt' and category_id = '$catetter' and start_date <= '$tdate' and end_date >= '$tdate' and delete_status=''");
							   
							   $coupon_amount = $check_get[0]->coupon_amount;
							   $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
								 $error = "";
							   
							    
							 }				   
							   
							   
							   
					}
					if($data_coupon[0]->category_type=="all")
					{
					
									   
									   
					$check_get_count = DB::select("select * from coupons where coupons.coupon_name = '$coupon_code' and coupons.user_id != '$login_id' and start_date <= '$tdate' and end_date >= '$tdate' and delete_status=''");				   
						   
						 $new_count = count($check_get_count);
						 if(empty($new_count))
						 {
							 
							 $coupon_amount = "";
							 $coupon_type = "";
							 $error = "Coupon code not valid"; 
							 $coupon_id = 0;
							   						  
						 } 
                         else
						 {
							 
							 
							 
							 
							 
					      $check_get = DB::select("select * from coupons where coupons.coupon_name = '$coupon_code' and coupons.user_id != '$login_id' and start_date <= '$tdate' and end_date >= '$tdate' and delete_status=''");
						   
                          $coupon_amount =  $check_get[0]->coupon_amount;
						  $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
                          $error = "";
							 
							 
							 
						 }							 
						   
					
				    }
				
			
			
			
			
			$return = 2;

            }
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			if(empty($first_purchase) && empty($start_end_dates) && !empty($check_category) && !empty($large_amount))
			{
			    $total_prices = $data_coupon[0]->maximum_amount;
			     
				 if($data_coupon[0]->category_type=="cat")
					{
					
					
					$catett = $gig_display[0]->category;
						

                     $check_gett_count = DB::select("select * from coupons where coupon_name = '$coupon_code' and user_id != '$login_id' and category_type='cat' and category_id = '$catett' and maximum_amount <= $total_price and delete_status=''");
							   
							   
							   
							   
							   
							   
						$new_count = count($check_gett_count);	   
							   
							   
							if(empty($new_count))
							{								
							   
							   $coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0; 
							   
							   
							}  
                            else
							 {
								 
								
								 
								$check_get = DB::select("select * from coupons where coupon_name = '$coupon_code' and user_id != '$login_id' and category_type='cat' and category_id = '$catett' and maximum_amount <= $total_price and delete_status=''");
								 
								 
							   $coupon_amount = $check_get[0]->coupon_amount;
							   $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
								 $error = ""; 
								
								 
							 }								
							   
							   
					}
					if($data_coupon[0]->category_type=="subcat")
					{
					
												   
					$catetter = $gig_display[0]->subcategory;
					$subcat_txt = "subcat";
					$check_get_counnt = DB::select("select * from coupons where coupon_name = '$coupon_code' and user_id != '$login_id' and category_type='$subcat_txt' and category_id = '$catetter' and maximum_amount <= $total_price and delete_status=''");		   
							   
							$new_count = count($check_get_counnt);	
							
							if(empty($new_count))
							{								
							   
							  $coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0;
							  
							   
							}  
                            else
							 {
							 $check_get = DB::select("select * from coupons where coupon_name = '$coupon_code' and user_id != '$login_id' and category_type='$subcat_txt' and category_id = '$catetter' and maximum_amount <= $total_price and delete_status=''");
							   
							   $coupon_amount = $check_get[0]->coupon_amount;
							   $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
								 $error = ""; 	 
								 
								 
								 
							   
							   
							 }				   
							   
							   
							   
					}
					if($data_coupon[0]->category_type=="all")
					{
					
									   
									   
					$check_get_count = DB::select("select * from coupons where coupons.coupon_name = '$coupon_code' and coupons.user_id != '$login_id' and maximum_amount <= $total_price and coupons.delete_status=''");				   
						   
						 $new_count = count($check_get_count);
						 if(empty($new_count))
						 {
							$coupon_amount = "";
							 $coupon_type = "";
							 $error = "Coupon code not valid";
							 $coupon_id = 0; 
							
							   						  
						 } 
                         else
						 {
							
                          

                           							
							 $check_get = DB::select("select * from coupons where coupons.coupon_name = '$coupon_code' and coupons.user_id != '$login_id' and maximum_amount <= $total_price and coupons.delete_status=''");
						   
                          $coupon_amount =  $check_get[0]->coupon_amount;
						  $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
                          $error = ""; 
					      
							 
							 
							 
						 }							 
						   
					
				    }
				
				
				 
				 
				 
				 
			$return = 3;

            }
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			if(!empty($first_purchase) && empty($start_end_dates) && empty($check_category) && !empty($large_amount))
			{
			
			
			

            }
			
			
			
			
			
			
			
			
			/* SARAVANAN */
			if(!empty($first_purchase) && empty($start_end_dates) && !empty($check_category) && empty($large_amount))
			{
			
			   
				$yes_txt = "yes";
				$cat_ty = "cat";
				$subcat_ty = "subcat";
				if($data_coupon[0]->category_type=="cat")
					{
					
					
					$catett = $gig_display[0]->category;
						

                     
							   
					$check_gett_count  = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id = '$login_id' and coupons.category_id = '$catett' and coupons.category_type='$cat_ty' and coupons.delete_status=''");		   
							   
							   
							   
							   
						$new_count = count($check_gett_count);	   
							   
							   
							if(empty($new_count))
							{								
							   
							   
							   
							   
							   $coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0;
							   
							   
							   
							   
							   
							}  
                            else
							 {
								 
								 $v_count = DB::select("select * from gig_order where user_id = '$login_id'");

								 $try = count($v_count);
								
								if($try==0)
								{
								 $check_get = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id != '$login_id' and coupons.category_id = '$catett' and coupons.category_type='$cat_ty' and coupons.delete_status=''");
								 
								 
							   $coupon_amount = $check_get[0]->coupon_amount;
							   $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
								 $error = "";
								}
								else
								{
									$coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0;
								}
								 
								 
								 
								 
								
								 
							 }								
							   
							   
					}
					if($data_coupon[0]->category_type=="subcat")
					{
					
												   
					$catetter = $gig_display[0]->subcategory;
					$subcat_txt = "subcat";
						
                    
					$check_get_counnt  = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id = '$login_id' and coupons.category_id = '$catetter' and coupons.category_type='$subcat_txt' and coupons.delete_status=''");

					
							   
							$new_count = count($check_get_counnt);	
							
							if(empty($new_count))
							{								
							   
							   
								$coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0; 
								 
								 
							  
							   
							}  
                            else
							 {
								
                                  $v_count = DB::select("select * from gig_order where user_id = '$login_id'");

								 $try = count($v_count);
								
								if($try==0)
								{  
                                  $check_get = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id != '$login_id' and coupons.category_id = '$catetter' and coupons.category_type='$subcat_txt' and coupons.delete_status=''");
							   
							   $coupon_amount = $check_get[0]->coupon_amount;
							   $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
								 $error = "";
								}
								else
								{
									$coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0;
								}

								
							   
							    
							 }				   
							   
							   
							   
					}
					if($data_coupon[0]->category_type=="all")
					{
					
									   
									   
					$check_get_count = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id = '$login_id' and coupons.delete_status=''");				   
						   
						 $new_count = count($check_get_count);
						 if(empty($new_count))
						 {
							 
							 
							$coupon_amount = "";
							 $coupon_type = "";
							 $error = "Coupon code not valid";
							 $coupon_id = 0;  
							 
							 
							   						  
						 } 
                         else
						 {
							 $v_count = DB::select("select * from gig_order where user_id = '$login_id'");

								 $try = count($v_count);
								
								if($try==0)
								{
							$check_get = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id != '$login_id' and coupons.delete_status=''");
						   
							  $coupon_amount =  $check_get[0]->coupon_amount;
							  $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
							  $error = ""; 
								}
								else
								{
									$coupon_amount = "";
							 $coupon_type = "";
							 $error = "Coupon code not valid";
							 $coupon_id = 0; 
								}
							 
							 
							 
							
					      
							 
							 
							 
						 }							 
						   
					
				    }
				
				
				
				
			$return = 4;

            }
			
			
			
			
			
			
			
			
			
			
			
			
			
			if(!empty($first_purchase) && !empty($start_end_dates) && !empty($check_category) && empty($large_amount))
			{
			
			
			    $yes_txt = "yes";
				$cat_ty = "cat";
				$subcat_ty = "subcat";
				$tdate = date("Y-m-d");
				if($data_coupon[0]->category_type=="cat")
					{
					
					
					$catett = $gig_display[0]->category;
						

                     
							   
					$check_gett_count  = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id = '$login_id' and coupons.category_id = '$catett' and coupons.category_type='$cat_ty' and coupons.start_date <= '$tdate' and coupons.end_date >= '$tdate' and coupons.delete_status=''");		   
							   
							   
							   
							   
						$new_count = count($check_gett_count);	   
							   
							   
							if(empty($new_count))
							{								
							   
							   
								 
								$coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0; 
								 
								 
								 
							   
							   
							}  
                            else
							 {
								 
								 $v_count = DB::select("select * from gig_order where user_id = '$login_id'");

								 $try = count($v_count);
								
								if($try==0)
								{
								 
								 $check_get = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id != '$login_id' and coupons.category_id = '$catett' and coupons.category_type='$cat_ty' and coupons.start_date <= '$tdate' and coupons.end_date >= '$tdate' and coupons.delete_status=''");
								 
								 
							   $coupon_amount = $check_get[0]->coupon_amount;
							   $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
								 $error = "";
								 
								}
								else
								{
									$coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0;
									
								}
								 
								 
								 
								 
								
								 
							 }								
							   
							   
					}
					if($data_coupon[0]->category_type=="subcat")
					{
					
												   
					$catetter = $gig_display[0]->subcategory;
					$subcat_txt = "subcat";
						
                    
					$check_get_counnt  = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id = '$login_id' and coupons.category_id = '$catetter' and coupons.category_type='$subcat_txt' and coupons.start_date <= '$tdate' and coupons.end_date >= '$tdate' and coupons.delete_status=''");

					
							   
							$new_count = count($check_get_counnt);	
							
							if(empty($new_count))
							{								
							   
							   
								 $coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0;
								 
								 
								 
								
							   
							}  
                            else
							 {
								 
								$v_count = DB::select("select * from gig_order where user_id = '$login_id'");

								 $try = count($v_count);
								
								if($try==0)
								{ 
								 
							    $check_get = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id != '$login_id' and coupons.category_id = '$catetter' and coupons.category_type='$subcat_txt' and coupons.start_date <= '$tdate' and coupons.end_date >= '$tdate' and coupons.delete_status=''");
							   
							   $coupon_amount = $check_get[0]->coupon_amount;
							   $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
								 $error = "";

								}
								else
								{
									$coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0;
									
								}

								 
							  
							   
							 }				   
							   
							   
							   
					}
					if($data_coupon[0]->category_type=="all")
					{
					
									   
									   
					$check_get_count = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id = '$login_id' and coupons.start_date <= '$tdate' and coupons.end_date >= '$tdate' and coupons.delete_status=''");				   
						   
						 $new_count = count($check_get_count);
						 if(empty($new_count))
						 {
							 
							 
							$coupon_amount = "";
							 $coupon_type = "";
							 $error = "Coupon code not valid";
							 $coupon_id = 0; 
							 
							 
							   						  
						 } 
                         else
						 {
							 
							$v_count = DB::select("select * from gig_order where user_id = '$login_id'");

								 $try = count($v_count);
								
								if($try==0)
								{  
					      
							

$check_get = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id != '$login_id' and coupons.start_date <= '$tdate' and coupons.end_date >= '$tdate' and coupons.delete_status=''");
						   
                          $coupon_amount =  $check_get[0]->coupon_amount;
						  $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
                          $error = "";
								}
								else
								{
									$coupon_amount = "";
							 $coupon_type = "";
							 $error = "Coupon code not valid";
							 $coupon_id = 0;
								}





						  
							 
							 
						 }							 
						   
					
				    }
				
				
			
			
			
			
			$return = 5;

            }
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			if(empty($first_purchase) && !empty($start_end_dates) && !empty($check_category) && !empty($large_amount))
			{
			
			
			
			
			$tdate = date("Y-m-d");
			
			    if($data_coupon[0]->category_type=="cat")
					{
					
					
					$catett = $gig_display[0]->category;
						

                     $check_gett_count = DB::select("select * from coupons where coupon_name = '$coupon_code' and user_id != '$login_id' and category_type='cat' and category_id = '$catett' and start_date <= '$tdate' and end_date >= '$tdate' and maximum_amount <= $total_price and delete_status=''");
							   
							   
							   
							   
							   
							   
						$new_count = count($check_gett_count);	   
							   
							   
							if(empty($new_count))
							{								
							   
							   $coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0;
							   
							   
							}  
                            else
							 {
								 
								 
								 
								 
								$check_get = DB::select("select * from coupons where coupon_name = '$coupon_code' and user_id != '$login_id' and category_type='cat' and category_id = '$catett' and start_date <= '$tdate' and end_date >= '$tdate' and maximum_amount <= $total_price and delete_status=''");
								 
								 
							   $coupon_amount = $check_get[0]->coupon_amount;
							   $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
								 $error = "";
								 
							 }								
							   
							   
					}
					if($data_coupon[0]->category_type=="subcat")
					{
					
												   
					$catetter = $gig_display[0]->subcategory;
					$subcat_txt = "subcat";
					$check_get_counnt = DB::select("select * from coupons where coupon_name = '$coupon_code' and user_id != '$login_id' and category_type='$subcat_txt' and category_id = '$catetter' and start_date <= '$tdate' and end_date >= '$tdate' and maximum_amount <= $total_price and delete_status=''");		   
							   
							$new_count = count($check_get_counnt);	
							
							if(empty($new_count))
							{								
							   
							   $coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0;
							  
							   
							}  
                            else
							 {
								 
							   
							   $check_get = DB::select("select * from coupons where coupon_name = '$coupon_code' and user_id != '$login_id' and category_type='$subcat_txt' and category_id = '$catetter' and start_date <= '$tdate' and end_date >= '$tdate' and maximum_amount <= $total_price and delete_status=''");
							   
							   $coupon_amount = $check_get[0]->coupon_amount;
							   $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
								 $error = ""; 
							 }				   
							   
							   
							   
					}
					if($data_coupon[0]->category_type=="all")
					{
					
									   
									   
					$check_get_count = DB::select("select * from coupons where coupons.coupon_name = '$coupon_code' and coupons.user_id != '$login_id' and start_date <= '$tdate' and end_date >= '$tdate' and maximum_amount <= $total_price and coupons.delete_status=''");				   
						   
						 $new_count = count($check_get_count);
						 if(empty($new_count))
						 {
							 
							 $coupon_amount = "";
							 $coupon_type = "";
							 $error = "Coupon code not valid";
							 $coupon_id = 0;
							   						  
						 } 
                         else
						 {
							 
							 
					      $check_get = DB::select("select * from coupons where coupons.coupon_name = '$coupon_code' and coupons.user_id != '$login_id' and start_date <= '$tdate' and end_date >= '$tdate' and maximum_amount <= $total_price and delete_status=''");
						   
                          $coupon_amount =  $check_get[0]->coupon_amount;
						  $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
                          $error = "";
							 
							 
							 
						 }							 
						   
					
				    }
				
			
			
			
			
			
			
			$return = 6;

            }
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			if(!empty($first_purchase) && empty($start_end_dates) && !empty($check_category) && !empty($large_amount))
			{
			
			
			$yes_txt = "yes";
				$cat_ty = "cat";
				$subcat_ty = "subcat";
				if($data_coupon[0]->category_type=="cat")
					{
					
					
					$catett = $gig_display[0]->category;
						

                     
							   
					$check_gett_count  = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id = '$login_id' and coupons.category_id = '$catett' and coupons.category_type='$cat_ty' and coupons.maximum_amount <= $total_price and coupons.delete_status=''");		   
							   
							   
							   
							   
						$new_count = count($check_gett_count);	   
							   
							   
							if(empty($new_count))
							{								
							   
							   
							   $coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0;
							   
							   
							   
							   
							   
							}  
                            else
							 {
								 
								 $v_count = DB::select("select * from gig_order where user_id = '$login_id'");

								 $try = count($v_count);
								
								if($try==0)
								{
								 
								 $check_get = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id != '$login_id' and coupons.category_id = '$catett' and coupons.category_type='$cat_ty' and coupons.maximum_amount <= $total_price and coupons.delete_status=''");
								 
								 
							   $coupon_amount = $check_get[0]->coupon_amount;
							   $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
								 $error = "";
								}
                                else
								{
									
									$coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0;
									
								}									
								 
								 
								 
								
								 
							 }								
							   
							   
					}
					if($data_coupon[0]->category_type=="subcat")
					{
					
												   
					$catetter = $gig_display[0]->subcategory;
					$subcat_txt = "subcat";
						
                    
					$check_get_counnt  = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id = '$login_id' and coupons.category_id = '$catetter' and coupons.category_type='$subcat_txt' and coupons.maximum_amount <= $total_price and coupons.delete_status=''");

					
							   
							$new_count = count($check_get_counnt);	
							
							if(empty($new_count))
							{								
							   
							   
								  $coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0;
								 
								   
							  
							   
							}  
                            else
							 {
								 
								 
							$v_count = DB::select("select * from gig_order where user_id = '$login_id'");

								 $try = count($v_count);
								
								if($try==0)
								{	 
								 
							$check_get = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id != '$login_id' and coupons.category_id = '$catetter' and coupons.category_type='$subcat_txt' and coupons.maximum_amount <= $total_price and coupons.delete_status=''");
							   
							   $coupon_amount = $check_get[0]->coupon_amount;
							   $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
								 $error = "";	 
								}
                                else
								{
									
									$coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0;
								}									
								 
								 
							  
							  
							 }				   
							   
							   
							   
					}
					if($data_coupon[0]->category_type=="all")
					{
					
									   
									   
					$check_get_count = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id = '$login_id' and coupons.maximum_amount <= $total_price and coupons.delete_status=''");				   
						   
						 $new_count = count($check_get_count);
						 if(empty($new_count))
						 {
							 
							 
							 $coupon_amount = "";
							 $coupon_type = "";
							 $error = "Coupon code not valid";
							 $coupon_id = 0;
							 
							 
							   						  
						 } 
                         else
						 {
							 
							 
						  $v_count = DB::select("select * from gig_order where user_id = '$login_id'");

								 $try = count($v_count);
								
								if($try==0)
								{	 
							 
					      $check_get = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id != '$login_id' and coupons.maximum_amount <= $total_price and coupons.delete_status=''");
						   
                          $coupon_amount =  $check_get[0]->coupon_amount;
						  $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
                          $error = "";
								}
								else
								{
									$coupon_amount = "";
							 $coupon_type = "";
							 $error = "Coupon code not valid";
							 $coupon_id = 0;
							 
									
								}
							 
							 
							 
						 }							 
						   
					
				    }
				
				
			
			
			
			
			
			
             $return = 7;
            }
			
			
			
			
			
			
			
			
			
			
			
			
			
			if(!empty($first_purchase) && !empty($start_end_dates) && empty($check_category) && !empty($large_amount))
			{
			
			

            }
			
			
			
			
			
			
			
			
			
			
			
			
			
			if(!empty($first_purchase) && !empty($start_end_dates) && !empty($check_category) && !empty($large_amount))
			{
			     
			    
				
				$yes_txt = "yes";
				$cat_ty = "cat";
				$subcat_ty = "subcat";
				$tdate = date("Y-m-d");
				if($data_coupon[0]->category_type=="cat")
					{
					
					
					$catett = $gig_display[0]->category;
						

                     
							   
					$check_gett_count  = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id != '$login_id' and coupons.category_id = '$catett' and coupons.category_type='$cat_ty' and coupons.start_date <= '$tdate' and coupons.end_date >= '$tdate' and coupons.maximum_amount <= $total_price and coupons.delete_status=''");		   
							   
							   
							   
							   
						$new_count = count($check_gett_count);	   
							   
							   
							if(empty($new_count))
							{								
							   
							   
								 
								 
								 
								 
								 $coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0; 
								 
								 
							   
							   
							}  
                            else
							 {
								 
								 
								$v_count = DB::select("select * from gig_order where user_id = '$login_id'");

								 $try = count($v_count);
								
								if($try==0)
								{ 
								 
								$check_get = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id != '$login_id' and coupons.category_id = '$catett' and coupons.category_type='$cat_ty' and coupons.start_date <= '$tdate' and coupons.end_date >= '$tdate' and coupons.maximum_amount <= $total_price and coupons.delete_status=''");
								 
								 
							   $coupon_amount = $check_get[0]->coupon_amount;
							   $coupon_type = $check_get[0]->coupon_mode;
							   $coupon_id=$check_get[0]->cuid;
								 $error = "";
								}
								else
								{
									
									$coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0;
									
								}
								 
								
								 
							 }								
							   
							   
					}
					if($data_coupon[0]->category_type=="subcat")
					{
					
												   
					$catetter = $gig_display[0]->subcategory;
					$subcat_txt = "subcat";
						
                    
					$check_get_counnt  = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id != '$login_id' and coupons.category_id = '$catetter' and coupons.category_type='$subcat_txt' and coupons.start_date <= '$tdate' and coupons.end_date >= '$tdate' and coupons.maximum_amount <= $total_price and coupons.delete_status=''");

					
							   
							$new_count = count($check_get_counnt);	
							
							if(empty($new_count))
							{								
							   
							  
								 
								 
								 
								 
								 $coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0;
								 
								 
							  
							   
							}  
                            else
							 {
								 
								 
								$v_count = DB::select("select * from gig_order where user_id = '$login_id'");

								 $try = count($v_count);
								
								if($try==0)
								{ 
								 
							    $check_get = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id != '$login_id' and coupons.category_id = '$catetter' and coupons.category_type='$subcat_txt' and coupons.start_date <= '$tdate' and coupons.end_date >= '$tdate' and coupons.maximum_amount <= $total_price and coupons.delete_status=''");
							   
							   $coupon_amount = $check_get[0]->coupon_amount;
							   $coupon_type = $check_get[0]->coupon_mode;$coupon_id=$check_get[0]->cuid;
								 $error = ""; 
								 
								}
								else
								{
									$coupon_amount = "";
							   $coupon_type = "";
								 $error = "Coupon code not valid";
								 $coupon_id = 0;
								 
								}
								
								 
								 
								 
								 
								 
							   
							 }				   
							   
							   
							   
					}
					if($data_coupon[0]->category_type=="all")
					{
					
									   
									   
					$check_get_count = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id != '$login_id' and coupons.start_date <= '$tdate' and coupons.end_date >= '$tdate' and coupons.maximum_amount <= $total_price and coupons.delete_status=''");				   
						   
						 $new_count = count($check_get_count);
						 if($new_count==0)
						 {
							 
							 $coupon_amount = "";
							 $coupon_type = "";
							 $error = "Coupon code not valid";
							 $coupon_id = 0;
							 
							 
							 
							 
							   						  
						 } 
                         else
						 {
							 $v_count = DB::select("select * from gig_order where user_id = '$login_id'");

                             $try = count($v_count);
							
							if($try==0)
							{								
								  $check_get = DB::select("select * from gig_order left join coupons on gig_order.user_id != coupons.coupon_name where coupons.user_id != '$login_id' and coupons.coupon_name = '$coupon_code' and gig_order.user_id != '$login_id' and coupons.start_date <= '$tdate' and coupons.end_date >= '$tdate' and coupons.maximum_amount <= $total_price and coupons.delete_status=''");
								   
								  $coupon_amount =  $check_get[0]->coupon_amount;
								  $coupon_type = $check_get[0]->coupon_mode;
								  $coupon_id=$check_get[0]->cuid;
								  $error = "";
							}
							else
							{
								$coupon_amount = "";
								$coupon_type = "";
								$error = "Coupon code not valid";
								$coupon_id = 0;
							}
							 
							 
						 }							 
						   
					
				    }
				
				
			
						   
			$return = 8;

            }
			if(empty($first_purchase) && empty($start_end_dates) && empty($check_category) && empty($large_amount))
			
			{
		
			 $error = "Coupon code not valid";
			 $coupon_amount = "";
			 $coupon_type = "";
			 $return = 0;
			 $coupon_id = 0;

			}
						 
		




         







          /*$check_get = DB::table('coupons')
						   ->leftJoin('gig_order', 'gig_order.user_id', '=', $login_id)
						   ->where('coupons.start_date', '<=', $tdate)
                           ->where('coupons.end_date', '>=', $tdate)
						   ->get();*/





		
		}
		
		else
		{
			
			
			$error = "Coupon code not valid";
			$coupon_amount = "";
			$return = 0;
			$coupon_type = "";
			$coupon_id = 0;
			
		}
		
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		
		$datas = array( 'total_price' => $total_price, 'gig_id' => $gig_id, 'gig_type' => $gig_type, 'ex_text' => $ex_text, 'gig_name' => $gig_name, 'site_setting' => $site_setting, 'sumvalue_four' => $sumvalue_four, 'error' => $error, 'coupon_amount' => $coupon_amount, 'return' => $return, 'coupon_type' => $coupon_type, 'coupon_code' => $coupon_code, 'coupon_id' => $coupon_id);
		
		return view('order')->with($datas);
		
		
		
	
		
	}
	
	 
	
	public function own_submission($price,$gid,$type,$ex_text,$balance_type,$balance)
	{
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		$rand = rand(00000,99999);
		$user_id = Auth::user()->id;
		
		
		$gig_details = DB::table('gigs')
		         ->where('gid', '=', $gid)
				 ->get();

         if($gig_details[0]->job_type=="request")
		{			
		DB::update('update gigs set request_status="2" where gid = ?', [$gid]);		 
        }
		
		
		$payment_type = $balance_type;
		
		$get_price = $price + $site_setting[0]->processing_fee;
		
		$gig_details = DB::table('gigs')
		         ->where('gid', '=', $gid)
				 
				 ->get();
		$reference_id = $rand;		 
				 
		$title = $gig_details[0]->subject;
		$gig_user_id = $gig_details[0]->user_id;


        $token = csrf_token();
				 
		$check_order = DB::table('gig_order')
		        ->where('user_id', '=', $user_id) 
				->where('reference_id', '=', $rand)
				->count();

        $status = "completed";	
        $submit_date = date("Y-m-d");
        $token = uniqid();		
			$payment_level = 1;
            $upcoming_payment = 1;	
       
	   
	   $checkin = DB::table('available_balance')
		           ->where('user_id','=',Auth::user()->id)
				   ->count();
	
        if($balance_type == "seller_balance")
		{
			if(!empty($checkin))
			{
			DB::update('update available_balance set amount="'.$balance.'" where user_id = ?', [$user_id]);
			}
			else
			{
				DB::insert('insert into available_balance (user_id,amount) values (?, ?)', [$user_id, $balance]);
			}
			
		}



			
		if(empty($check_order))
		{
			
		DB::insert('insert into gig_order (gid,gig_user_id,user_id,reference_id,token,price,type,ex_text,payment_type,payment_level,upcoming_payment	,payment_date,status) values 
(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$gid,$gig_user_id,$user_id,$reference_id,$token,$get_price,$type,$ex_text,$payment_type,$payment_level,$upcoming_payment,$submit_date,$status]);


	DB::insert('insert into revenues (user_id,revenues_token,total_amount,revenues_type,revenues_status) values (?,?,?,?,?)', [$user_id,$token,$get_price,$payment_type,'completed']);
			
		
		return redirect('own_payment');
		
		}
		else
		{
			return back()->with('error', 'That job already Ordered');
		}
		

	
	
	}
	
	
	
	public function  own_page()
	{
		
		return view('own_payment');
	}
	
	
	public function bank_submission($price,$gid,$type,$ex_text)
	{
	$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		$rand = rand(00000,99999);
	
	$data = array( 'gid' => $gid, 'price' => $price, 'site_setting' => $site_setting, 'rand' => $rand, 'type' => $type,
	'ex_text' => $ex_text);
	return view('bank_payment')->with($data);
	
	}
	
	
	
	
	protected function bank_payment(Request $request)
    {
        $data = $request->all();
		
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		$price = $data['price'];
		
		$reference_id = $data['reference_id'];
	    $payment_date = $data['payment_date'];
		$submit_date = date("Y-m-d");
		$info = $data['info'];
		$payment_type = $data['payment_type'];
		
		$get_price = $price + $site_setting[0]->processing_fee;
		
		
		$type = $data['type'];
		$ex_text = $data['ex_text'];
		
		
		$gid = $data['gid'];
		$user_id = Auth::user()->id;
		$username = $data['name'];
		
		$gig_details = DB::table('gigs')
		         ->where('gid', '=', $gid)
				 
				 ->get();
				 
				 
				 
				 
		$title = $gig_details[0]->subject;
		$gig_user_id = $gig_details[0]->user_id;
		
		
		$req_proposal_count = DB::table('request_proposal')
						->where('gid', '=', $gid)
						->where('req_user_id','=',$user_id)
						->where('award','=',1)
						->count();
		
		if(!empty($req_proposal_count))
		{
		$req_proposal_get = DB::table('request_proposal')
						->where('gid', '=', $gid)
						->where('req_user_id','=',$user_id)
						->where('award','=',1)
						->get();
			$bidder = $req_proposal_get[0]->prop_user_id;
           
         			
        }
		else
		{
			$bidder = $gig_user_id;
		}
		
		
		$token = csrf_token();
				 
		$check_order = DB::table('gig_order')
		        ->where('user_id', '=', $user_id) 
				->where('reference_id', '=', $reference_id)
				->count();

        $status = "processing";				
				 
		if(empty($check_order))
		{
			
		DB::insert('insert into gig_order (gid,gig_user_id,user_id,reference_id,token,price,type,ex_text,payment_type,additional_info,payment_date,status) values 
(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$gid,$bidder,$user_id,$reference_id,$token,$get_price,$type,$ex_text,$payment_type,$info,$submit_date,$status]);	
			
		
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		
		
		
		Mail::send('bank_email', ['gid' => $gid, 'reference_id' => $reference_id, 'username' => $username,
		'title' => $title, 'get_price' => $get_price, 'payment_date' => $payment_date, 'payment_type' => $payment_type,
		'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url], function ($message)
        {
            $message->subject('Job Confirmation Received');
			
            $message->from(Input::get('admin_email'), 'Admin');

            $message->to(Input::get('admin_email'));

        }); 
		
		
		
		 
		 return back()->with('success', 'Thankyou! We received your information and will notify you once the order is created.');
		}
		else
		{
			return back()->with('error', 'That job already Ordered');
		}
		
		 
	}	 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function success_page($ref_id)
	{
		$datas = array('ref_id' => $ref_id);
     return view('paypal_success')->with($datas);
	}
	
	
	
	
	public function payment_payumoney_process($price,$gid,$type,$ex_text,$coupon)
	{
		$userid = Auth::user()->id;
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		
		$gig = DB::table('gigs')
				->where('gid', '=', $gid)
				
				->get();
		$gig_name = $gig[0]->subject;
		
		$gig_user_id = $gig[0]->user_id;
		
		
		
		
		$req_proposal_count = DB::table('request_proposal')
						->where('gid', '=', $gid)
						->where('req_user_id','=',$userid)
						->where('award','=',1)
						->count();
		
		if(!empty($req_proposal_count))
		{
		$req_proposal_get = DB::table('request_proposal')
						->where('gid', '=', $gid)
						->where('req_user_id','=',$userid)
						->where('award','=',1)
						->get();
			$bidder = $req_proposal_get[0]->prop_user_id;
           
         			
        }
		else
		{
			$bidder = $gig_user_id;
		}
		
		
		
		
		
		
		
		
		$total_price = $price;
		
		$get_price = $price + $site_setting[0]->processing_fee;
		
		$process_fee = $site_setting[0]->processing_fee;
		
		if(!empty($site_setting[0]->paypal_url))
	{
	$paypal_url = $site_setting[0]->paypal_url;
	}
	else { $paypal_url = ""; }
	if(!empty($site_setting[0]->paypal_id))
	{
	$paypal_id = $site_setting[0]->paypal_id;
	}
	else { $paypal_id = ""; }	
	$rand = rand(00000,99999);
	$token = csrf_token();
	
	
	if(!empty($coupon))
	 {		 
     $view_coupon = DB::table('coupons')
						->where('cuid', '=', $coupon)
						->get();
						
						
			     if($view_coupon[0]->coupon_mode=="percentage")
					   {
						   $commission_amount = ($view_coupon[0]->coupon_amount * $total_price) / 100;
					   }
					   else if($view_coupon[0]->coupon_mode=="fixed")
					   {
							
								$commission_amount = $view_coupon[0]->coupon_amount;
							
					   }
					   else
					   {
						   $commission_amount = 0;
					   }			
						
		$coupon_name = $view_coupon[0]->coupon_name;
        $coupon_by = $view_coupon[0]->user_id;
		if($coupon_by==1)
		{
			$coupon_user = "admin";
		}
		else 	
		{	
        $coupon_user = "vendor";		
        }        
		
	 }
	 else
	 {
		 $coupon_name = "";
		 $commission_amount = 0;
		 $coupon_by = 0;
		 $coupon_user = "";
		 
	 }
		 
	
	
	
	
	
	       $check_order = DB::table('gig_order')
		        ->where('user_id', '=', $userid) 
				->where('reference_id', '=', $rand)
				->count();
				
			$payment_type = "payumoney";
			$payment_date = date("Y-m-d");
			$status = "processing";
				
				
		   if(empty($check_order))
           {
DB::insert('insert into gig_order (gid,gig_user_id,user_id,reference_id,token,coupon_id,coupon_code,coupon_by,coupon_user,coupon_commission,price,processing_fee,type,ex_text,payment_type,payment_date,status) values 
(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$gid,$bidder,$userid,$rand,$token,$coupon,$coupon_name,$coupon_by,$coupon_user,$commission_amount,$get_price,$process_fee,$type,$ex_text,$payment_type,$payment_date,$status]);
           }
           else
           {
DB::update('update gig_order set gid ="'.$gid.'",gig_user_id="'.$bidder.'",reference_id="'.$rand.'",coupon_id="'.$coupon.'",coupon_code="'.$coupon_name.'",coupon_by="'.$coupon_by.'",coupon_user="'.$coupon_user.'",processing_fee="'.$process_fee.'",coupon_commission="'.$commission_amount.'",price="'.$get_price.'",type="'.$type.'",
ex_text="'.$ex_text.'",payment_date="'.$payment_date.'" where user_id="'.$userid.'" and token="'.$token.'"');		   
		   }			   
	            /*$geter = DB::table('gig_order')
		        ->where('user_id', '=', $userid) 
				->where('token', '=', $token)
				->where('gid', '=', $gid)
				->get();*/
				
				$random = $rand;
		
	
   
	$admin_setting=DB::select('select * from users where id = 1'); 
    $aid=base64_encode($admin_setting[0]->email);
	
		$data = array('total_price' => $total_price, 'gid' => $gid, 'site_setting' => $site_setting, 'gig_name' => $gig_name,
		'paypal_url' => $paypal_url, 'paypal_id' => $paypal_id, 'random' => $random, 'aid' => $aid, 'coupon' => $coupon);
		return view('payumoney_payment')->with($data);
	}
	
	
	
	
	
	public function payment_stripe_process($price,$gid,$type,$ex_text,$coupon)
	{
		$userid = Auth::user()->id;
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		
		$gig = DB::table('gigs')
				->where('gid', '=', $gid)
				
				->get();
		$gig_name = $gig[0]->subject;
		
		$gig_user_id = $gig[0]->user_id;
		
		
		
		
		$req_proposal_count = DB::table('request_proposal')
						->where('gid', '=', $gid)
						->where('req_user_id','=',$userid)
						->where('award','=',1)
						->count();
		
		if(!empty($req_proposal_count))
		{
		$req_proposal_get = DB::table('request_proposal')
						->where('gid', '=', $gid)
						->where('req_user_id','=',$userid)
						->where('award','=',1)
						->get();
			$bidder = $req_proposal_get[0]->prop_user_id;
           
         			
        }
		else
		{
			$bidder = $gig_user_id;
		}
		
		
		
		
		
		
		
		
		$total_price = $price;
		
		$get_price = $price + $site_setting[0]->processing_fee;
		
		$process_fee = $site_setting[0]->processing_fee;
		
		if(!empty($site_setting[0]->paypal_url))
	{
	$paypal_url = $site_setting[0]->paypal_url;
	}
	else { $paypal_url = ""; }
	if(!empty($site_setting[0]->paypal_id))
	{
	$paypal_id = $site_setting[0]->paypal_id;
	}
	else { $paypal_id = ""; }	
	$rand = rand(00000,99999);
	$token = csrf_token();
	
	
	if(!empty($coupon))
	 {		 
     $view_coupon = DB::table('coupons')
						->where('cuid', '=', $coupon)
						->get();
						
						
			     if($view_coupon[0]->coupon_mode=="percentage")
					   {
						   $commission_amount = ($view_coupon[0]->coupon_amount * $total_price) / 100;
					   }
					   else if($view_coupon[0]->coupon_mode=="fixed")
					   {
							
								$commission_amount = $view_coupon[0]->coupon_amount;
							
					   }
					   else
					   {
						   $commission_amount = 0;
					   }			
						
		$coupon_name = $view_coupon[0]->coupon_name;
        $coupon_by = $view_coupon[0]->user_id;
		if($coupon_by==1)
		{
			$coupon_user = "admin";
		}
		else 	
		{	
        $coupon_user = "vendor";		
        }        
		
	 }
	 else
	 {
		 $coupon_name = "";
		 $commission_amount = 0;
		 $coupon_by = 0;
		 $coupon_user = "";
		 
	 }
		 
	
	
	
	
	
	       $check_order = DB::table('gig_order')
		        ->where('user_id', '=', $userid) 
				->where('reference_id', '=', $rand)
				->count();
				
			$payment_type = "stripe";
			$payment_date = date("Y-m-d");
			$status = "processing";
				
				
		   if(empty($check_order))
           {
DB::insert('insert into gig_order (gid,gig_user_id,user_id,reference_id,token,coupon_id,coupon_code,coupon_by,coupon_user,coupon_commission,price,processing_fee,type,ex_text,payment_type,payment_date,status) values 
(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$gid,$bidder,$userid,$rand,$token,$coupon,$coupon_name,$coupon_by,$coupon_user,$commission_amount,$get_price,$process_fee,$type,$ex_text,$payment_type,$payment_date,$status]);
           }
           else
           {
DB::update('update gig_order set gid ="'.$gid.'",gig_user_id="'.$bidder.'",reference_id="'.$rand.'",coupon_id="'.$coupon.'",coupon_code="'.$coupon_name.'",coupon_by="'.$coupon_by.'",coupon_user="'.$coupon_user.'",processing_fee="'.$process_fee.'",coupon_commission="'.$commission_amount.'",price="'.$get_price.'",type="'.$type.'",
ex_text="'.$ex_text.'",payment_date="'.$payment_date.'" where user_id="'.$userid.'" and token="'.$token.'"');		   
		   }			   
	            /*$geter = DB::table('gig_order')
		        ->where('user_id', '=', $userid) 
				->where('token', '=', $token)
				->where('gid', '=', $gid)
				->get();*/
				
				$random = $rand;
		
	
   
	$admin_setting=DB::select('select * from users where id = 1'); 
    $aid=base64_encode($admin_setting[0]->email);
	
		$data = array('total_price' => $total_price, 'gid' => $gid, 'site_setting' => $site_setting, 'gig_name' => $gig_name,
		'paypal_url' => $paypal_url, 'paypal_id' => $paypal_id, 'random' => $random, 'aid' => $aid, 'coupon' => $coupon);
		return view('stripe_payment')->with($data);
	}
	
	
	
	
	
	 
	 
	public function payment_process($price,$gid,$type,$ex_text,$coupon)
	{
		$userid = Auth::user()->id;
		$siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);
		
		$gig = DB::table('gigs')
				->where('gid', '=', $gid)
				
				->get();
		$gig_name = $gig[0]->subject;
		
		$gig_user_id = $gig[0]->user_id;
		
		
		
		
		$req_proposal_count = DB::table('request_proposal')
						->where('gid', '=', $gid)
						->where('req_user_id','=',$userid)
						->where('award','=',1)
						->count();
		
		if(!empty($req_proposal_count))
		{
		$req_proposal_get = DB::table('request_proposal')
						->where('gid', '=', $gid)
						->where('req_user_id','=',$userid)
						->where('award','=',1)
						->get();
			$bidder = $req_proposal_get[0]->prop_user_id;
           
         			
        }
		else
		{
			$bidder = $gig_user_id;
		}
		
		
		
		
		
		
		
		
		$total_price = $price;
		
		$get_price = $price + $site_setting[0]->processing_fee;
		
		$process_fee = $site_setting[0]->processing_fee;
		
		if(!empty($site_setting[0]->paypal_url))
	{
	$paypal_url = $site_setting[0]->paypal_url;
	}
	else { $paypal_url = ""; }
	if(!empty($site_setting[0]->paypal_id))
	{
	$paypal_id = $site_setting[0]->paypal_id;
	}
	else { $paypal_id = ""; }	
	$rand = rand(00000,99999);
	$token = csrf_token();
	
	
	if(!empty($coupon))
	 {		 
     $view_coupon = DB::table('coupons')
						->where('cuid', '=', $coupon)
						->get();
						
						
			     if($view_coupon[0]->coupon_mode=="percentage")
					   {
						   $commission_amount = ($view_coupon[0]->coupon_amount * $total_price) / 100;
					   }
					   else if($view_coupon[0]->coupon_mode=="fixed")
					   {
							
								$commission_amount = $view_coupon[0]->coupon_amount;
							
					   }
					   else
					   {
						   $commission_amount = 0;
					   }			
						
		$coupon_name = $view_coupon[0]->coupon_name;
        $coupon_by = $view_coupon[0]->user_id;
		if($coupon_by==1)
		{
			$coupon_user = "admin";
		}
		else 	
		{	
        $coupon_user = "vendor";		
        }        
		
	 }
	 else
	 {
		 $coupon_name = "";
		 $commission_amount = 0;
		 $coupon_by = 0;
		 $coupon_user = "";
		 
	 }
		 
	
	
	
	
	
	       $check_order = DB::table('gig_order')
		        ->where('user_id', '=', $userid) 
				->where('reference_id', '=', $rand)
				->count();
				
			$payment_type = "paypal";
			$payment_date = date("Y-m-d");
			$status = "processing";
				
				
		   if(empty($check_order))
           {
DB::insert('insert into gig_order (gid,gig_user_id,user_id,reference_id,token,coupon_id,coupon_code,coupon_by,coupon_user,coupon_commission,price,processing_fee,type,ex_text,payment_type,payment_date,status) values 
(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$gid,$bidder,$userid,$rand,$token,$coupon,$coupon_name,$coupon_by,$coupon_user,$commission_amount,$get_price,$process_fee,$type,$ex_text,$payment_type,$payment_date,$status]);
           }
           else
           {
DB::update('update gig_order set gid ="'.$gid.'",gig_user_id="'.$bidder.'",reference_id="'.$rand.'",coupon_id="'.$coupon.'",coupon_code="'.$coupon_name.'",coupon_by="'.$coupon_by.'",coupon_user="'.$coupon_user.'",processing_fee="'.$process_fee.'",coupon_commission="'.$commission_amount.'",price="'.$get_price.'",type="'.$type.'",
ex_text="'.$ex_text.'",payment_date="'.$payment_date.'" where user_id="'.$userid.'" and token="'.$token.'"');		   
		   }			   
	            /*$geter = DB::table('gig_order')
		        ->where('user_id', '=', $userid) 
				->where('token', '=', $token)
				->where('gid', '=', $gid)
				->get();*/
				
				$random = $rand;
		
	
   
	$admin_setting=DB::select('select * from users where id = 1'); 
    $aid=base64_encode($admin_setting[0]->email);
	
		$data = array('total_price' => $total_price, 'gid' => $gid, 'site_setting' => $site_setting, 'gig_name' => $gig_name,
		'paypal_url' => $paypal_url, 'paypal_id' => $paypal_id, 'random' => $random, 'aid' => $aid, 'coupon' => $coupon);
		return view('job_payment')->with($data);
	}
	
	
	
	
	
	
	
	
	public function own_success($price,$gid,$request) 
	{


     
        $siteid=1;
		$setts=DB::select('select * from settings where id = ?',[$siteid]);
		$rand = rand(00000,99999);
		$user_id = Auth::user()->id;
	
		
		


         $gig_details = DB::table('gigs')
		         ->where('gid', '=', $gid)
				 ->get();

         if($gig_details[0]->job_type=="request")
		{			
		DB::update('update gigs set request_status="2" where gid = ?', [$gid]);		 
        }				 
				
		$title = $gig_details[0]->subject;

        $payment_type = 'buyer_balance';
		
		$get_price = $price + $setts[0]->processing_fee;
		
		
		$reference_id = $rand;		 
				 
		$title = $gig_details[0]->subject;
		$gig_user_id = $gig_details[0]->user_id;


        $token = csrf_token();
		
		
		$req_proposal_count = DB::table('request_proposal')
						->where('gid', '=', $gid)
						->where('req_user_id','=',$user_id)
						->where('award','=',1)
						->count();
		
		if(!empty($req_proposal_count))
		{
		$req_proposal_get = DB::table('request_proposal')
						->where('gid', '=', $gid)
						->where('req_user_id','=',$user_id)
						->where('award','=',1)
						->get();
			$bidder = $req_proposal_get[0]->prop_user_id;
           
         			
        }
		else
		{
			$bidder = $gig_user_id;
		}
		
		


        $check_order = DB::table('gig_order')
		        ->where('user_id', '=', $user_id) 
				->where('reference_id', '=', $rand)
				->count();

        $status = "processing";	
        $submit_date = date("Y-m-d");
        $token = uniqid();		
			$payment_level = 1;
            $upcoming_payment = 1;
			
			$payment_type = 'buyer_balance';
			
			$type = 0;
			$ex_text = 0;
			$processing = $setts[0]->processing_fee;
			
			if(empty($check_order))
		{
			
		DB::insert('insert into gig_order (gid,gig_user_id,user_id,reference_id,token,price,	processing_fee,type,ex_text,payment_type,payment_level,upcoming_payment,payment_date,status) values 
(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$gid,$bidder,$user_id,$reference_id,$token,$get_price,$processing,$type,$ex_text,$payment_type,$payment_level,$upcoming_payment,$submit_date,$status]);


		
		}


		
				
		$order_details = DB::table('gig_order')
		         ->where('status', '=', 'processing')
				 ->where('user_id', '=', $user_id)
				 ->where('reference_id', '=', $rand)
				 ->get();		
				
				 
		
		$order_count =  DB::table('gig_order')
		         ->where('status', '=', 'processing')
				 ->where('user_id', '=', $user_id)
				 ->where('reference_id', '=', $rand)
				 ->count();	

         				 
				
		if($order_count==1)
		{
			
			
			
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
			
		$commission_mode = $setts[0]->commission_mode;
		$commission_amt = $setts[0]->commission_amt;
		$affilitate_percentamt = 0;
		
		$processing = $setts[0]->processing_fee;

        $sumfee = $order_details[0]->price - $processing;   
				   
				   if($commission_mode=="percentage")
				   {
					   $commission_amount = ($commission_amt * $sumfee) / 100;
				   }
				   if($commission_mode=="fixed")
				   {
					    if($sumfee < $commission_amt)
						{
							$commission_amount = 0;
						}
						else
						{
							$commission_amount = $commission_amt;
						}
				   }
				   
				   
				   
		if(!empty($order_details[0]->coupon_code) && $order_details[0]->coupon_user=="vendor")
		{
			$vendor_yamount = $sumfee - $commission_amount;
			
			$vendor_amount = $vendor_yamount - $order_details[0]->coupon_commission;
			
		}			
		else
		{
			$vendor_amount = $sumfee - $commission_amount;
		}			
				   
		
        if(!empty($order_details[0]->coupon_code) && $order_details[0]->coupon_user=="admin")
		{		
		   
		   /*$admin_amountt = $order_details[0]->coupon_commission;*/
		    $admin_amountt = $commission_amount - $order_details[0]->coupon_commission;
		
		}
		else
		{
			$admin_amountt = $commission_amount;
		}
		
		
		$affiliate_id = Auth::user()->referred_by;
		
		if(!empty($affiliate_id))
		{
			
			
			$affiliate_amount = ($affilitate_percentamt * $sumfee) / 100;
			
			
			/*if($order_details[0]->coupon_user=="")
			{
				$admin_amount =   $admin_amountt - $affiliate_amount;
			}
			else
			{
			
			$admin_amount =  $admin_amountt;
			}*/
			
			/*$admin_amount =  $admin_amountt;*/
			
			$admin_amount =   $admin_amountt - $affiliate_amount;
			
			
		}
		else
		{
			$admin_amount = $admin_amountt;
			$affiliate_amount = 0;
		}
			
			
			
		DB::update('update gig_order set status="completed",payment_level="1",upcoming_payment="1",seller_price="'.$vendor_amount.'",admin_price="'.$admin_amount.'",affiliate_price="'.$affiliate_amount.'",affiliate_id="'.$affiliate_id.'" where user_id ="'.$user_id.'" and reference_id = ?', [$rand]);
		   
		   $old_balance = Auth::user()->wallet;
		   
		   $value = $old_balance - $get_price;
		   
		   DB::update('update users set wallet="'.$value.'" where id = ?', [$user_id]);
		   
		   
		    $username = Auth::user()->name;
			
			$order_details_well = DB::table('gig_order')
		         ->where('status', '=', 'completed')
				 ->where('user_id', '=', $user_id)
				 ->where('reference_id', '=', $rand)
				 ->get();
			
			$price_details = $order_details_well[0]->price;
			$payment_date = $order_details_well[0]->payment_date;
		$payment_type = $order_details_well[0]->payment_type;
		
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		
		$user_detal = DB::table('users')
		->where('id', '=', 1)
		->get();
		
		$track = $order_details_well[0]->id;
		
		$adminemail = $user_detal[0]->email;
		
		Mail::send('paypal_email', ['gid' => $gid, 'reference_id' => $reference_id, 'username' => $username,
		'title' => $title, 'price_details' => $price_details, 'payment_date' => $payment_date, 'payment_type' => $payment_type,
		'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url], function ($message) use ($adminemail)
        {
            $message->subject('Job Order Received');
			
            $message->from($adminemail, 'Admin');

            $message->to($adminemail);

        }); 
		
		
		
		Mail::send('paypal_email', ['gid' => $gid, 'reference_id' => $reference_id, 'username' => $username,
		'title' => $title, 'price_details' => $price_details, 'payment_date' => $payment_date, 'payment_type' => $payment_type,
		'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url], function ($message) use ($adminemail)
        {
            $message->subject('Job Order Received');
			
            $message->from($adminemail, 'Admin');

            $message->to(Auth::user()->email);

        });
		
		
		return redirect('own_payment/'.$track);
		
		
		/*
		 
		$dataa = array('track ' => $track);
     return view('own_payment')->with($dataa);*/
		}
		else
		{
			
		}


		/*$dataa = array('track ' => $track);
     return view('own_payment')->with($dataa);*/
		return redirect('own_payment/'.$track);
	 
	  
	  
   }

	
	
	
	
	public function own_track($track_id)
	{
		$dataa = array('track_id' => $track_id);
		return view('own_payment')->with($dataa);
		
	}
	
	
	
	
	
	
	







public function sangvish_success($gid,$ref_id,$admin_email) {
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		 $user_id = Auth::user()->id;
		$reference_id = $ref_id;


         $gig_details = DB::table('gigs')
		         ->where('gid', '=', $gid)
				 ->get();

         if($gig_details[0]->job_type=="request")
		{			
		DB::update('update gigs set request_status="2" where gid = ?', [$gid]);		 
        }				 
				
		$title = $gig_details[0]->subject;		
				
		$order_details = DB::table('gig_order')
		         ->where('status', '=', 'processing')
				 ->where('user_id', '=', $user_id)
				 ->where('reference_id', '=', $ref_id)
				 ->get();		
				
				 
		
		$order_count =  DB::table('gig_order')
		         ->where('status', '=', 'processing')
				 ->where('user_id', '=', $user_id)
				 ->where('reference_id', '=', $ref_id)
				 ->count();	

         				 
				
		if($order_count==1)
		{
			
			
			
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
			
		$commission_mode = $setts[0]->commission_mode;
		$commission_amt = $setts[0]->commission_amt;
		$affilitate_percentamt = 0;
		
		$processing = $setts[0]->processing_fee;

        $sumfee = $order_details[0]->price - $processing;   
				   
				   if($commission_mode=="percentage")
				   {
					   $commission_amount = ($commission_amt * $sumfee) / 100;
				   }
				   if($commission_mode=="fixed")
				   {
					    if($sumfee < $commission_amt)
						{
							$commission_amount = 0;
						}
						else
						{
							$commission_amount = $commission_amt;
						}
				   }
				   
				   
				   
		if(!empty($order_details[0]->coupon_code) && $order_details[0]->coupon_user=="vendor")
		{
			$vendor_yamount = $sumfee - $commission_amount;
			
			$vendor_amount = $vendor_yamount - $order_details[0]->coupon_commission;
			
		}			
		else
		{
			$vendor_amount = $sumfee - $commission_amount;
		}			
				   
		
        if(!empty($order_details[0]->coupon_code) && $order_details[0]->coupon_user=="admin")
		{		
		   
		   /*$admin_amountt = $order_details[0]->coupon_commission;*/
		    $admin_amountt = $commission_amount - $order_details[0]->coupon_commission;
		
		}
		else
		{
			$admin_amountt = $commission_amount;
		}
		
		
		$affiliate_id = Auth::user()->referred_by;
		
		if(!empty($affiliate_id))
		{
			
			
			$affiliate_amount = ($affilitate_percentamt * $sumfee) / 100;
			
			
			/*if($order_details[0]->coupon_user=="")
			{
				$admin_amount =   $admin_amountt - $affiliate_amount;
			}
			else
			{
			
			$admin_amount =  $admin_amountt;
			}*/
			
			/*$admin_amount =  $admin_amountt;*/
			
			$admin_amount =   $admin_amountt - $affiliate_amount;
			
			
		}
		else
		{
			$admin_amount = $admin_amountt;
			$affiliate_amount = 0;
		}
			
			
			
		DB::update('update gig_order set status="completed",payment_level="1",upcoming_payment="1",seller_price="'.$vendor_amount.'",admin_price="'.$admin_amount.'",affiliate_price="'.$affiliate_amount.'",affiliate_id="'.$affiliate_id.'" where user_id ="'.$user_id.'" and reference_id = ?', [$ref_id]);
		   
		   
		    $username = Auth::user()->name;
			
			$price_details = $order_details[0]->price;
			$payment_date = $order_details[0]->payment_date;
		$payment_type = $order_details[0]->payment_type;
		
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$adminemail = base64_decode($admin_email);
		
		Mail::send('paypal_email', ['gid' => $gid, 'reference_id' => $reference_id, 'username' => $username,
		'title' => $title, 'price_details' => $price_details, 'payment_date' => $payment_date, 'payment_type' => $payment_type,
		'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url], function ($message) use ($adminemail)
        {
            $message->subject('Job Order Received');
			
            $message->from($adminemail, 'Admin');

            $message->to($adminemail);

        }); 
		
		
		
		Mail::send('paypal_email', ['gid' => $gid, 'reference_id' => $reference_id, 'username' => $username,
		'title' => $title, 'price_details' => $price_details, 'payment_date' => $payment_date, 'payment_type' => $payment_type,
		'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url], function ($message) use ($adminemail)
        {
            $message->subject('Job Order Received');
			
            $message->from($adminemail, 'Admin');

            $message->to(Auth::user()->email);

        });
		
		
		/*return redirect('paypal_success/'.$ref_id);*/
		
		
		$data = array('ref_id' => $ref_id);
     return view('paypal_success')->with($data);
		 
		 
		}
		else
		{
			
		}


		$data = array('ref_id' => $ref_id);
     return view('paypal_success')->with($data);
		
	 
	  
	  
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


	public function order_view()
	{
		
		
		
		return view('order');
	}


     protected function savedata(Request $request)
    {
        
		
		
		 $data = $request->all();
		 
		 $price = $data['price'];
		 $gig_type = $data['gig_type'];
		 
		 $gig_id = $data['gig_id'];
		 
		 $gig_viewer = DB::table('gigs')
				->where('gid', '=', $gig_id)
				
				->get();
		 
		 $gig_name = $data['gig_name'];
		 
		 if($gig_type=="quantity")
		 {
			 $total_price = $price * $data['quantity'];
			 $ex_text = $data['quantity'];
		 }
		 else if($gig_type=="shipping")
		 {
			 $total_price = $price + $data['ship_price'];
			 $ex_text = $data['ship_price'];
		 }
		 else if($gig_type=="extra")
		 {
			 if(!empty($data['extra_price1']))
			 {
				 $extra_price1 = $data['extra_price1'];
				 $one = $gig_viewer[0]->extra_text1;
			 }
			 else
			 {
				 $extra_price1 = "";
				 $one = "";
			 }
			 if(!empty($data['extra_price2']))
			 {
				 $extra_price2 = $data['extra_price2'];
				 $two = $gig_viewer[0]->extra_text2;
				 
			 }
			 else
			 {
				 $extra_price2 = "";
				 $two = "";
			 }
			 if(!empty($data['extra_price3']))
			 {
				 $extra_price3 = $data['extra_price3'];
				 $three = $gig_viewer[0]->extra_text3;
			 }
			 else
			 {
				 $extra_price3 = "";
				 $three = "";
			 }
			 
			 $total_price = $price + $extra_price1 + $extra_price2 + $extra_price3;
			 $ex_text = $one."_".$two."_".$three;
		 }
		 else
		 {
			 $total_price = $price;
			 $ex_text = "";
		 }
		 
		 
		 
		 
		 
		 
		 $siteid=1;
		$site_setting=DB::select('select * from settings where id = ?',[$siteid]);


       $commission_mode = $site_setting[0]->commission_mode;
		$commission_amt = $site_setting[0]->commission_amt;
        $processing = $site_setting[0]->processing_fee;

		$user_id = Auth::user()->id;
		
		
		$gig_available = DB::table('gig_order')
		           
				   ->where('user_id','=',$user_id)
				  ->where('status','=','completed')
				   ->orderBy('id', 'desc')
				   ->get();
				   
		$gig_available_cnt = DB::table('gig_order')
		           
				   ->where('user_id','=',$user_id)
				  ->where('status','=','completed')
				  ->orderBy('id', 'desc')
				   ->count();
				   
				   
		$view_revenues = DB::table('revenues')
		           
				   ->where('user_id','=',$user_id)
				  ->where('revenues_status','=','completed')
				  ->where('revenues_type','=','buyer_balance')
				   ->orderBy('rwid', 'desc')
				   ->get();		   
		
		$view_revenues_cnt = DB::table('revenues')
		           
				   ->where('user_id','=',$user_id)
				  ->where('revenues_status','=','completed')
				  ->where('revenues_type','=','buyer_balance')
				   ->orderBy('rwid', 'desc')
				   ->count();
				   
				   
			 $view_revenues_new = DB::table('revenues')
		           
				   ->where('user_id','=',$user_id)
				  ->where('revenues_status','=','completed')
				  ->where('revenues_type','=','seller_balance')
				   ->orderBy('rwid', 'desc')
				   ->get();		   
		
		$view_revenues_cnt_new = DB::table('revenues')
		           
				   ->where('user_id','=',$user_id)
				  ->where('revenues_status','=','completed')
				  ->where('revenues_type','=','seller_balance')
				   ->orderBy('rwid', 'desc')
				   ->count();



			
				   
				   
				   
				   
		$check_four = DB::table('gigs')
		           ->leftJoin('gig_order', 'gigs.gid', '=', 'gig_order.gid')
				   ->leftJoin('users', 'users.id', '=', 'gigs.user_id')
				   ->where('users.id','=',$user_id)
				   ->where('gig_order.payment_level','=',3)
				    ->where('gig_order.awaiting','=',1)
				   ->where('gig_order.amount_by','=',"")
				   ->where('gig_order.status','=','completed')
				   ->count();
		
		if(!empty($check_four))
		{
			$sum_available_four = DB::table('gigs')
		           ->leftJoin('gig_order', 'gigs.gid', '=', 'gig_order.gid')
				   ->leftJoin('users', 'users.id', '=', 'gigs.user_id')
				   ->where('users.id','=',$user_id)
				   ->where('gig_order.payment_level','=',3)
				   ->where('gig_order.awaiting','=',1)
				   ->where('gig_order.amount_by','=',"")
				   ->where('gig_order.status','=','completed')
				   ->get();
				   $sum=0;
				   foreach($sum_available_four as $sumvalue){ 
				   $sumfee = $sumvalue->price - $processing;  
				   if($commission_mode=="percentage")
				   {
					   $commission_amount = ($commission_amt * $sumfee) / 100;
				   }
				   if($commission_mode=="fixed")
				   {
					    if($sumfee < $commission_amt)
						{
							$commission_amount = 0;
						}
						else
						{
							$commission_amount = $commission_amt;
						}
				   }
				   
				   $sum +=$sumfee - $commission_amount; }
				   
				   $sumvalue_four = $sum;
				   
		}
		else
		{
			$sumvalue_four = 0;
		}		   
				   
				   
				   
				   
				   
				   


		
		 
		 $data = array('total_price' => $total_price, 'site_setting' => $site_setting,
		 'gig_id' => $gig_id, 'gig_name' => $gig_name, 'gig_type' => $gig_type, 'ex_text' => $ex_text, 'gig_available_cnt' => $gig_available_cnt, 'gig_available' => $gig_available, 'view_revenues' => $view_revenues, 'view_revenues_cnt' => $view_revenues_cnt, 'check_four' => $check_four, 'sumvalue_four' => $sumvalue_four, 'view_revenues_new' => $view_revenues_new, 'view_revenues_cnt_new' => $view_revenues_cnt_new);
		 return view('order')->with($data);
		 
	}
	
	
	
	
}

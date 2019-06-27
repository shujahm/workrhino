<?php
	use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");


?>
<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	




</head>
<body>

    

    <!-- fixed navigation bar -->
    @include('header')

    <!-- slider -->
    

	
	
	
	
	
	
	<div class="height30 clearfix"></div>
	
	
	
	
	
	<div class="video">
	
	
	<?php 
	if($gig_order_status[0]->payment_level==1){ $status_txt = "Progress"; $class_cls = "#FF4200"; }
	if($gig_order_status[0]->payment_level==2){ $status_txt = "Completed"; $class_cls = "#109C10"; }
	if($gig_order_status[0]->payment_level==3){ $status_txt = "Deliverd"; $class_cls = "#109C10"; }
	if($gig_order_status[0]->payment_level==4){ $status_txt = "Cancelled"; $class_cls = "#FF0000"; }
	?>
	
	<div class="clearfix"></div>
	<div class="headerbg">
	 <div class="col-md-12" align="center"><h1>Track Job</h1></div>
	 </div>
	<div class="container">
	
	<div class="height30 clearfix"></div>
	
	
	
	
	
	<div class="col-md-12 ashborder sv_seller_track">
	
	
	
	
	<?php if(!empty($gig_details_cnt)){?>
	<div class="text-left">
	 
	 <div class="col-md-3">
	 <?php
	 $gigger = DB::table('users')
			   ->where('id','=',$gig_order_status[0]->gig_user_id)
								->get();			
				$gigger_cnt = DB::table('users')
								->where('id','=',$gig_order_status[0]->gig_user_id)
								->count();
	 
	 if($gig_details[0]->job_type=="custom"){ $temp_url = $url.'/custom_order/'.$gig_details[0]->gid; }
		else { $temp_url = $url.'/request/'.$gig_details[0]->gid.'/'.$gig_details[0]->request_slug; }
	 ?>
	 
	 <a href="<?php echo $temp_url;?>">
	<?php 
	if(!empty($giger_cnt)){
	if(!empty($giger_img[0]->image)){?>
	<img src="<?php echo $url;?>/local/images/gigs/<?php echo $giger_img[0]->image;?>" alt="" class="img-responsive small_thumb">
	<?php } else { ?>
	<img src="<?php echo $url;?>/local/images/noimage.jpg" alt="" class="img-responsive small_thumb">
    <?php } } else { ?><img src="<?php echo $url;?>/local/images/noimage.jpg" alt="" class="img-responsive small_thumb"><?php }?></a>
	
	<span class="font15">Chat with <?php echo $gigger[0]->name;?></span>
	 </div>
	  <div class="col-md-9">
	 <?php 
	 
	if(!empty($gigger_cnt)){?>
	
	<h3>I will 
	<?php echo $gig_details[0]->subject;?>
	for <?php echo $site_setting[0]->site_currency;?><?php echo $gig_order_status[0]->price;?></h3>
	<div class="font21">Status : <span style="color:<?php echo $class_cls;?>"><?php echo $status_txt;?></span></div>
	<?php } ?>
	
	
	
	
	
	 
	 </div>
	 
	
	 
	 
	 </div>
	 
	 <div class="height20 clearfix"></div>
	 
	  <div class="col-md-12 text-center whitebox">
	 <?php 
	 
	 $newDate = date("l F d Y", strtotime($gig_order_status[0]->payment_date));
	 ?>
	Ordered by <?php echo $gigger[0]->name;?> on <?php echo $newDate;?>
	</div>
	
	
	
	<?php
		$complete_days = '+'.$gig_details[0]->complete_days.' '.'days';		   
	    $start_date = $gig_order_status[0]->payment_date;
		$end_date = date($start_date, strtotime($complete_days));
		
		
		$date = $start_date;
$date = strtotime($date);
$new_date = strtotime($complete_days , $date);
$end_last = date('M d, Y', $new_date);
		?>
		
		<div class="height30 clearfix"></div>
		
		<div class="gallerybox_new">
			<div class="blue_heading text-center">
			<div class="pader">New order created</div>
			</div>
			
			<div class="para_pads text-center">
			<p class="para"><i style="color:#00668C" class="fa fa-fighter-jet fa-3x"></i></p>
			<p class="para">You need to deliver your work before your deadline to get paid.</p>
			<p class="para">Deadline: <strong><?php echo $end_last;?></strong></p>
			
			</div>
		
		
		</div>
	
	
	
	
	
	
	 <div class="height30 clearfix"></div>
	 
	 
	 <div class="gallerybox_new">
			<div class="pay_heading text-center">
			<div class="pader">Order Requirements Submitted</div>
			</div>
			
			<div class="para_pads text-center">
			<p class="para"><i style="color:#51DD86" class="fa fa-check-square-o fa-2x"></i></p>
			<?php if($gig_order_status[0]->payment_type=="localbank"){?>
			<p class="para bold">
			The buyer responded to your instructions.
			</p>
			<p class="para"><?php echo $gig_order_status[0]->additional_info;?></p>
			<?php } ?>
			
			<?php if($gig_order_status[0]->type=="extra"){?>
			
			<p class="para bold">This order purchased the following extras:</p>
			<p class="para"><?php echo $gig_order_status[0]->ex_text;?></p>
			<?php } ?>
			
			
			<?php if($gig_order_status[0]->type=="quantity"){?>
			
			<p class="para bold">This order purchased the following:</p>
			<p class="para"><?php echo $gig_order_status[0]->ex_text;?> Quantity</p>
			<?php } ?>
			
			<?php if($gig_order_status[0]->type=="shipping"){?>
			
			<p class="para bold">This order purchased the following:</p>
			<p class="para">Shipping Rate : <?php echo $site_setting[0]->site_currency;?> <?php echo $gig_order_status[0]->ex_text;?></p>
			<?php } ?>
			
			</div>
		
		
		
		</div>
	 
	 
	 
	 
	
		
		<div class="height30 clearfix"></div>
		<?php
		
		$check_order = DB::table('chat_message')
		           
				   ->where('gid','=',$gig_order_status[0]->gid)
				   ->where('order_id','=',$gig_order_status[0]->id)
				   ->where('buyer_id','=',$gig_order_status[0]->user_id)
				   ->where('seller_id','=',$gig_order_status[0]->gig_user_id)
				  
				   ->count();	
		
    if(!empty($check_order)){		
		$check_order_view = DB::table('chat_message')
		           
				   ->where('gid','=',$gig_order_status[0]->gid)
				   ->where('order_id','=',$gig_order_status[0]->id)
				   ->where('buyer_id','=',$gig_order_status[0]->user_id)
				   ->where('seller_id','=',$gig_order_status[0]->gig_user_id)
				  
				   ->get();	
foreach($check_order_view as $view){
             if($view->msg_type=="buyer_msg")
             {
				 $display_id = $view->buyer_id;
			 }
			 else if($view->msg_type=="seller_msg")
             {
				 $display_id = $view->seller_id;
			 }

			 
		$userr = DB::table('users')
				->where('id', '=', $display_id)
				->get();
				$userr_cnt = DB::table('users')
				->where('id', '=', $display_id)
				->count();
		?>
		<div class="gallerybox_new">
		<?php if(!empty($view->got_problem)){?>
		
		<?php if($view->problem_reason=="Mutual_Cancellation" && $view->msg_type=="seller_msg"){?>
		<div class="yell_heading text-center">
			<div class="pader">YOU SUGGESTED A MUTUAL CANCELLATION. </div>
			</div>
		<?php } ?>
		
		<?php if($view->problem_reason=="Mutual_Cancellation" && $view->msg_type=="buyer_msg"){?>
		<div class="yell_heading text-center">
			<div class="pader">Buyer suggested a mutual cancellation </div>
			</div>
		<?php } ?>
		
		<?php } ?>
		
<?php 
$useid = $userr[0]->id;
			$check_shop = DB::table('shop')
							->where('user_id', '=', $useid)
							->count();
if($userr[0]->admin==2)
		{
			if(!empty($check_shop))
			{
			$pather = $url."/rhino/".$userr[0]->name;
			$class="";
			}
			else
			{
				$pather="#";
				$class="hideclass";
			}
		}
        else
		{
			$pather = $url."/user/".$userr[0]->id.'/'.$userr[0]->name;
			$class="";
		}



if(!empty($view->got_problem)){ if($view->complete_work=="yes"){ $green_bg="#F4FDF2"; } else { $green_bg=""; } } ?>
<?php if(!empty($view->got_problem)){ if($view->got_problem=="yes" && 	$view->problem_reason=="Reject_Order"){
	$red_bg="#FDF2F2"; } else { $red_bg=""; } } ?>
			<div class="" style="background:<?php echo $green_bg.$red_bg;?>;">
			<div class="height10"></div>
			<div class="col-md-2 text-center">
			<a href="<?php echo $pather;?>" class="<?php echo $class;?>">
	<?php 
	
	if(!empty($userr[0]->photo)){?>
				 <img src="<?php echo $url;?>/local/images/userphoto/<?php echo $userr[0]->photo;?>" width="70" class="round">
				 <?php } else { ?>
				 <img src="<?php echo $url;?>/local/images/nophoto.jpg" alt="" width="70" class="round">
				 <?php }  ?>
				 </a>
				 
				 
				 <div class="font17"><a href="<?php echo $pather;?>" class="<?php echo $class;?>"><?php echo $userr[0]->name;?></a></div>
				 <div class="height10"></div>
	</div>
	
	
	
	<div class="col-md-7">
	
	<div class="font18">
	<?php if(!empty($view->got_problem)){?>
	<?php if($view->complete_work=="yes"){?>
	<div class="font25 bold">Order delivered, thank you!</div>
	<?php } ?>
	<?php } ?>
	
	<?php if(!empty($view->got_problem)){?>
	<?php if($view->got_problem=="yes" && 	$view->problem_reason=="Reject_Order"){?>
	<div class="font25 bold">Order Rejected. Please Revise and Deliver Again.</div>
	<div class="font17">Sorry, but your work was rejected by the buyer</div>
	<?php } ?>
	<?php } ?>
	
	<div class="height20"></div>
	
	<?php if(!empty($view->got_problem)){?>
		
	<?php if($view->problem_reason=="Mutual_Cancellation"){?>Reason : <?php }} ?>
	<?php echo $view->message;?>
	
	<?php if($view->mutual_cancel=="no" && $view->msg_type=="seller_msg"){?><div class="ybg font15"> 	
The buyer has withdrawn the mutual cancellation proposal.</div><?php } ?>


<?php if($view->mutual_cancel=="no" && $view->msg_type=="buyer_msg"){?><div class="ybg font15"> 	
You withdrawn the mutual cancellation suggestion.</div><?php } ?>
	</div>
	<div class="font18"><a href="<?php echo $url;?>/local/images/gigs/<?php echo $view->file;?>" download><?php echo $view->file;?></a></div>
	<?php if(!empty($view->got_problem)){?>
		
	<?php if($view->problem_reason=="Mutual_Cancellation" && $view->mutual_cancel=="" && $view->msg_type=="seller_msg"){?>
	
	<div class="red">Abort cancellation and continue with this order.</div>
	<div class="height10"></div>
	<div class="font14">This order will be cancelled automatically in two days unless it is rejected or aborted.</div>
	<div class="height10"></div>
	
	
	<?php } ?>
	
	
	<?php if($view->problem_reason=="Mutual_Cancellation" && $view->mutual_cancel=="" && $view->msg_type=="buyer_msg"){?>
	
	<div class="height20"></div>
	<div class="font14">This order will be cancelled automatically in two days unless it is rejected or aborted.</div>
	<div class="height10"></div>
	<div class="font16">
	<a href="<?php echo $url;?>/seller_track/<?php echo $view->id;?>/<?php echo $gig_order_status[0]->id;?>/no" class="red">
	Reject Cancellation</a> <a href="<?php echo $url;?>/seller_track/<?php echo $view->id;?>/<?php echo $gig_order_status[0]->id;?>/yes" class="green">Accept Cancellation</a></div>
	<div class="height20"></div>
	<?php }} ?>
	</div>
	
	<div class="col-md-3">
	<div class="height30"></div>
	<div class="font14"><?php echo $view->submit_date;?></div>
	</div>
	
	
		<div class="height10"></div>
		</div>
		</div>
		<div class="height20 clearfix"></div>
	<?php } } ?>
		
		
		<div class="height30 clearfix"></div>
		
		
		
		
		
		
		
		
		
		
		
		<?php
		$checker_status = DB::table('chat_message')
		           
				   ->where('gid','=',$gig_order_status[0]->gid)
				   ->where('order_id','=',$gig_order_status[0]->id)
				   ->where('buyer_id','=',$gig_order_status[0]->user_id)
				   ->where('seller_id','=',$gig_order_status[0]->gig_user_id)
				   ->where('got_problem', '=', 'yes')
				   ->where('mutual_cancel', '=', 'yes')
				   ->count();
				   
				   
				   
				   $finals_status = DB::table('review')
		           
				   ->where('gid','=',$gig_order_status[0]->gid)
				   ->where('order_id','=',$gig_order_status[0]->id)
				   ->where('buyer_id','=',$gig_order_status[0]->user_id)
				   ->where('seller_id','=',$gig_order_status[0]->gig_user_id)
				   ->count();
				   
				   
				   if(!empty($checker_status))
				   {
				   ?>
				   
				   
				  <div class="gallerybox_new">
			<div class="reder_heading text-center">
			<div class="pader">The order was cancelled </div>
			</div>
			
			<div class="para_pads text-center">
			<p class="para"><i style="color:#FB3737" class="fa fa-times fa-3x"></i></p>
			<p class="para">The order was cancelled by mutual agreement. Funds were returned to the Buyer.</p>
			
			
			</div>
		
		
		</div>
		
				   <?php } else if(empty($checker_status)){
					   
					   
					   if(empty($finals_status)){
					   
					   ?>
				   
				   
				   
				   
				   
				   
				   
				   
		
		<div>
	<div class="btn btn-primary sv_send_message">Send a Message</div> 
	
	<div class="conversation_bg">
	<form action="{{ route('seller_track') }}" method="post" id="formID" enctype="multipart/form-data">
	{{ csrf_field() }}
	
	
	<input type="hidden" name="gid" value="<?php echo $gig_order_status[0]->gid;?>">
	<input type="hidden" name="order_id" value="<?php echo $gig_order_status[0]->id;?>">
	<input type="hidden" name="buyer_id" value="<?php echo $gig_order_status[0]->user_id;?>">
	<input type="hidden" name="seller_id" value="<?php echo $gig_order_status[0]->gig_user_id;?>">
	
	
	<input type="hidden" name="msg_type" value="seller_msg">
	
	<div class='form-group card required'>
                 <p class="para"> <strong>Message</strong></p>
                <textarea autocomplete='off' name="msg" class='form-control validate[required] c_convert'></textarea>
              </div>
	<div class='form-group card required'>
                  <p class="para"><strong>Add a file attachment</strong></p>
                <input type="file" name="photo" class="form-control" />
				<p>Accepted File Formats: jpeg, jpg, gif, png, tif, bmp, avi, mpeg, mpg, mov, rm, 3gp, flv, 
				mp4, zip, rar, mp3, wav, wma and ogg</p>
              </div>
			  
	<div class='form-group card required' id="complete_wrk">
                 <p class="para"> <strong>Completed Work?</strong></p>
                <select name="completed_work" id="completed_work" class="form-control">
				<option value="no">No</option>
				<option value="yes">Yes</option>
				</select>
              </div>
			  
			  
			  
	<div class='form-group card required' id="gotted_prb">
                 <p class="para"> <strong>Got Problem?</strong></p>
                <select name="got_problem" id="got_problem" class="form-control">
				<option value="no">No</option>
				<option value="yes">Yes</option>
				</select>
              </div>
  
  <div class='form-group problemcard required' id="problemcard" style="display:none;">
                  
			  <div class="boxes"> 
                       <div class="box rejection first" style="border-radius: 5px;"> 
            <p class="para"><input type="radio" class="radio_button" name="reason" id="reject_order" value="Mutual_Cancellation">
			<strong>You and Buyer Agree to Cancel</strong></p> 
                            <p>Both sides agree to drop the order. Payment is returned to the buyer's balance.</p> 
                        </div> 
<div class="box mutual-cancel mid mutual_toggler mutual_toggler_buyer " style="border-radius: 5px;"> 
<p class="para"><input type="radio" class="radio_button" id="reject_mutual" name="reason" value="Force_Cancellation"> 
<strong>Force Cancel Order</strong></p> 
                            <p>Close the order, refund the buyer (has a negative effect on your rating).</p> 
                            </div> 
<div class="box notice last support_toggler" style="border-radius: 5px;"> 
<p class="para"><input type="radio" class="radio_button" id="get_help" name="reason" value="Get_Help"> 
<strong>Out of Ideas?</strong></p> 
<p>Tips and solutions for common order problems.</p> 
                        </div> 
                    </div>
					
	</div>
	
	
	
	
	
	<div class="support-message" id="support-message" style="display:none;">
            	<div style="clear:both !important"></div> 
                <h4 class="faq">Some frequently asked questions to help you</h4> 
                <div style="clear:both !important"></div>
                <ul class="faq" style="padding: 10px;"> 
                    <ul class="qa"> 
                        <li style="font-weight:bold">Buyer did not submit required information for me to start working</li> 
                        <li class="a">Buyer did not submit required information for me to start working</li> 
                        <br>
                        <li style="font-weight:bold">Buyer is not responding to my messages</li> 
                        <li class="a">Some buyers take their time until they reply: Time difference, local holidays and personal constraints are common reasons for lack of response. If 3 days (or more) have passed and you still did not get a response, you can issue a Mutual Cancellation Request.</li> 
                        <br>
                        <li style="font-weight:bold">How do I complete the order and get paid?</li> 
                        <li class="a">You have to submit your work using the Deliver Completed Work tab. Your buyer will then have 3 days to respond, after which the order will be marked as complete.</li>
                    </ul> 
                </ul> 
            </div>
	
	
	
	
	
	
	
	
	

	
	
	<div class='form-group card required'>
	<input type="submit" name="csubmit" value="Submit" class="btn btn-success">
    </div>	
	
	</form>
	
	</div>
	
	
	</div>
				   
		
		
		
		
				  
		<?php } else { ?>
					   
					   
					   <div class="gallerybox_new">
			<div class="green_header text-center">
			<div class="pader">Order Completed! </div>
			</div>
			
			<div class="para_pads text-center">
			<p class="para"><i style="color:#0ABA44" class="fa fa-check-square-o fa-4x"></i></p>
			<p class="para">This order is complete. <a href="<?php echo $url;?>/chat/<?php echo $gig_order_status[0]->user_id;?>">You can continue talking with the buyer in the conversation page.</a></p>
			
			
			</div>
		
		
		</div>
		
		
					   <?php } ?>
					   
		
		
		
				   <?php } ?>
		
		
		
		
	<?php } ?>
	 
	
	</div>
	
	
	
	
	
	</div>
	
	</div>
	
	
	
	
	<div class="height50 clearfix"></div>
	
	
	
	

      <div class="clearfix"></div>
	   <div class="clearfix"></div>

	
	

      @include('footer')
</body>
</html>
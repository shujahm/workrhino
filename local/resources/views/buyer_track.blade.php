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
    

	<div class="video">
	
	
	<?php 
	if($gig_order_status[0]->payment_level==1){ $status_txt = "Progress"; $class_cls = "#FF4200"; }
	if($gig_order_status[0]->payment_level==2){ $status_txt = "Completed"; $class_cls = "#109C10"; }
	if($gig_order_status[0]->payment_level==3){ $status_txt = "Deliverd"; $class_cls = "#109C10"; }
	if($gig_order_status[0]->payment_level==4){ $status_txt = "Cancelled"; $class_cls = "#FF0000"; }
	?>

	<div class="headerbg">
	 <div class="col-md-12" align="center"><h1>Track Job</h1></div>
	 </div>
	<div class="container">
	
	<div class="height30 clearfix"></div>
	
	<div class="col-md-12 ashborder sv_buyer_track">
	
	
	
	
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
	 
	 if($gig_details[0]->job_type=="custom"){ 
	 
	 
	 if(Auth::user()->id!=$gig_details[0]->user_id){
		
		
		$temp_url = $url.'/customorder/'.$gig_details[0]->gid;
        }
		else
		{
			$temp_url = "javascript:void(0);";
		}

	 
	 
	 }
		else { $temp_url = $url.'/request/'.$gig_details[0]->gid.'/'.$gig_details[0]->request_slug; }
	 ?>
	 
	 <a href="<?php echo $temp_url;?>">
	<?php 
	
	if(!empty($giger_cnt)){
		
	if(!empty($giger_img[0]->image)){?>
	<img src="<?php echo $url;?>/local/images/gigs/<?php echo $giger_img[0]->image;?>" alt="" class="img-responsive small_thumb">
	<?php } else { ?>
	<img src="<?php echo $url;?>/local/images/noimage.jpg" alt="" class="img-responsive small_thumb">
    <?php } } else { ?><img src="<?php echo $url;?>/local/images/noimage.jpg" alt="" class="img-responsive small_thumb"><?php } ?></a>
	
	<span class="font15">Chat with <?php echo $gigger[0]->name;?></span>
	 </div>
	  <div class="col-md-9">
	 <?php 
	 
	if(!empty($gigger_cnt)){?>
	
	<h3><?php echo $gigger[0]->name;?> will 
	<?php echo $gig_details[0]->subject;?>
	for <?php echo $site_setting[0]->site_currency;?><?php echo $gig_order_status[0]->price;?></h3><br/>
	<div class="font21">Status : <span style="color:<?php echo $class_cls;?>"><?php echo $status_txt;?></span></div>
	<?php } ?>
	
	
	
	
	
	 
	 </div>
	 
	
	 
	 
	 </div>
	 
	 <div class="height20 clearfix"></div>
	 
	  <div class="col-md-12 text-center whitebox">
	 <?php 
	 
	 $newDate = date("l F d Y", strtotime($gig_order_status[0]->payment_date));
	 ?>
	Ordered from <?php echo $gigger[0]->name;?> on <?php echo $newDate;?>
	</div>
	 <div class="height30 clearfix"></div>
	 
	 
	 
	 
	 <div class="gallerybox_new">
			<div class="pay_heading text-center">
			<div class="pader">PAYMENT ACCEPTED</div>
			</div>
			
			<div class="para_pads text-center">
			<p class="para"><i style="color:#51DD86" class="fa fa-check-square-o fa-2x"></i></p>
			<p class="para">Your payment for this order was successfully collected by us. Seller will be paid when the order is complete.</p>
			</div>
		
		
		
		</div>
		
		
		<div class="height30 clearfix"></div>
		
		<div class="gallerybox_new">
			<div class="yell_heading text-center">
			<div class="pader">THE SELLER WILL ONLY GET STARTED AFTER YOU SUBMIT THIS INFORMATION</div>
			</div>
			
			<div class="para_pads text-center">
			
			<?php if($gig_order_status[0]->payment_type=="localbank"){?>
			<p class="para bold">
			<?php echo $gigger[0]->name;?> requires the following information in order to get started
			</p>
			<p class="para"><?php echo $gig_order_status[0]->additional_info;?></p>
			<?php } ?>
			
			<?php if($gig_order_status[0]->type=="extra"){?>
			
			<p class="para bold">You also purchased the following extras:</p>
			<p class="para"><?php echo $gig_order_status[0]->ex_text;?></p>
			<?php } ?>
			
			
			<?php if($gig_order_status[0]->type=="quantity"){?>
			
			<p class="para bold">You also purchased the following:</p>
			<p class="para"><?php echo $gig_order_status[0]->ex_text;?> Quantity</p>
			<?php } ?>
			
			<?php if($gig_order_status[0]->type=="shipping"){?>
			
			<p class="para bold">You also purchased the following:</p>
			<p class="para">Shipping Rate : <?php echo $site_setting[0]->site_currency;?> <?php echo $gig_order_status[0]->ex_text;?></p>
			<?php } ?>
			
			</div>
		
		
		
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
			<div class="pader">YOUR ORDER WAS SENT TO THE SELLER</div>
			</div>
			
			<div class="para_pads text-center">
			<p class="para"><i style="color:#00668C" class="fa fa-fighter-jet fa-3x"></i></p>
			<p class="para">Thank You. Your order was sent to the Seller</p>
			<p class="para">Expected delivery: <strong><?php echo $end_last;?></strong></p>
			
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
			<div class="pader">Seller suggested a mutual cancellation </div>
			</div>
		<?php } ?>
		
		<?php if($view->problem_reason=="Mutual_Cancellation" && $view->msg_type=="buyer_msg"){?>
		<div class="yell_heading text-center">
			<div class="pader">YOU SUGGESTED A MUTUAL CANCELLATION. </div>
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
				 <div class="font17">
				 <a href="<?php echo $pather;?>" class="<?php echo $class;?>">
				 <?php echo $userr[0]->name;?>
				 </a>
				 </div>
				 <div class="height10"></div>
	</div>
	
	<div class="col-md-7">
	
	<div class="font18">
	<?php if(!empty($view->got_problem)){?>
	<?php if($view->complete_work=="yes"){?>
	<div class="font25 bold">Your order is ready!</div>
	<?php } ?>
	<?php } ?>
	
	
	<?php if(!empty($view->got_problem)){?>
	<?php if($view->got_problem=="yes" && 	$view->problem_reason=="Reject_Order"){?>
	<div class="font25 bold">You rejected the the seller's work</div>
	<?php } ?>
	<?php } ?>
	
	
	<div class="height20"></div>
	
	<?php if(!empty($view->got_problem)){?>
		
	<?php if($view->problem_reason=="Mutual_Cancellation"){?>Reason : <?php }} ?>
	
	<?php echo $view->message;?>
	
	
	</div>
	<?php if($view->mutual_cancel=="no" && $view->msg_type=="seller_msg"){?><div class="ybg font15"> 	
You withdrawn the mutual cancellation suggestion.</div><?php } ?>


<?php if($view->mutual_cancel=="no" && $view->msg_type=="buyer_msg"){?><div class="ybg font15"> 	
The seller has withdrawn the mutual cancellation proposal.</div><?php } ?>

	
	<div class="font18"><a href="<?php echo $url;?>/local/images/gigs/<?php echo $view->file;?>" download><?php echo $view->file;?></a></div>
	
	
	
	
	
	<?php if(!empty($view->got_problem)){?>
		
	<?php if($view->problem_reason=="Mutual_Cancellation" && $view->mutual_cancel=="" && $view->msg_type=="buyer_msg"){?>
	
	<div class="red">Abort cancellation and continue with this order.</div>
	<div class="height10"></div>
	<div class="font14">This order will be cancelled automatically in two days unless it is rejected or aborted.</div>
	<div class="height10"></div>
	
	
	<?php } ?>
	
	
	<?php if($view->problem_reason=="Mutual_Cancellation" && $view->mutual_cancel=="" && $view->msg_type=="seller_msg"){?>
	
	<div class="height20"></div>
	<div class="font14">This order will be cancelled automatically in two days unless it is rejected or aborted.</div>
	<div class="height10"></div>
	<div class="font16">
	<a href="<?php echo $url;?>/buyer_track/<?php echo $view->id;?>/<?php echo $gig_order_status[0]->id;?>/no" class="red">
	Reject Cancellation</a> <a href="<?php echo $url;?>/buyer_track/<?php echo $view->id;?>/<?php echo $gig_order_status[0]->id;?>/yes" class="green">Accept Cancellation</a></div>
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
	<?php
	
		$final_status = DB::table('chat_message')
		           
				   ->where('gid','=',$gig_order_status[0]->gid)
				   ->where('order_id','=',$gig_order_status[0]->id)
				   ->where('buyer_id','=',$gig_order_status[0]->user_id)
				   ->where('seller_id','=',$gig_order_status[0]->gig_user_id)
				   ->where('got_problem', '=', 'no')
				   ->where('complete_work', '=', 'yes')
				   ->where('submission', '=', 'yes')
				   ->count();
				   if(!empty($final_status)){
				   ?>
	<div class="height30 clearfix"></div>
	<form action="{{ route('track_complete') }}" method="post" id="formID22" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="gallerybox_new">
			<div class="height20"></div>
			
			<input type="hidden" name="gid" value="<?php echo $gig_order_status[0]->gid;?>">
	<input type="hidden" name="order_id" value="<?php echo $gig_order_status[0]->id;?>">
	<input type="hidden" name="buyer_id" value="<?php echo $gig_order_status[0]->user_id;?>">
	<input type="hidden" name="seller_id" value="<?php echo $gig_order_status[0]->gig_user_id;?>">
	
			<div class="text-center">
			<div class="font30 bold text-center">Please rate & review your experience</div>
			</div>
			
			<div class="row para_pads text-center">
			
			<div class="font18 col-md-6" style="margin-top:20px;">
			<span><input type="radio" value="1" name="star_rate"> 
			<i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star-o" aria-hidden="true"></i>
			<i class="fa fa-star-o" aria-hidden="true"></i>
			<i class="fa fa-star-o" aria-hidden="true"></i>
			<i class="fa fa-star-o" aria-hidden="true"></i>
			</span><br/>
			<span><input type="radio" value="2" name="star_rate"> 
			<i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star-o" aria-hidden="true"></i>
			<i class="fa fa-star-o" aria-hidden="true"></i>
			<i class="fa fa-star-o" aria-hidden="true"></i>
			</span><br/>
			<span><input type="radio" value="3" name="star_rate" checked> 
			<i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star-o" aria-hidden="true"></i>
			<i class="fa fa-star-o" aria-hidden="true"></i>
			</span>
			<br/>
			<span><input type="radio" value="4" name="star_rate"> 
			<i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star-o" aria-hidden="true"></i>
			</span>
			<br/>
			<span><input type="radio" value="5" name="star_rate"> 
			<i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star" aria-hidden="true"></i>
			</span>
			</div>
			
			
			<div class="col-md-6">
			 <div>
			 <input checked="checked" class="good-review-button" id="rating_value_1" name="ratingvalue" value="1" type="radio"><i style="color:#0ABA44" class="fa fa-thumbs-up fa-2x"></i>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <input class="bad-review-button" id="rating_value_0" name="ratingvalue" value="0" type="radio"><i style="color:#F99F2A" class="fa fa-thumbs-down fa-2x"></i> 
             </div>                             
			<div>
			<textarea cols="35" id="rating_new" class="rating_new" maxlength="300" name="ratingcomment" rows="5" 
			 
			placeholder="Please add your feedback. This will be shown to the wide public so other users can benefit from your experience." required></textarea>
			
			
			</div>
			
			</div>
			
			<div class="">
			<input type="submit" name="feed_submit" value="Submit" class="btn btn-success btn-lg">
			</div>
			<div class="clearfix"></div>
			</div>
		
		<div class="height20"></div>
		</div>
		
		</form>
		
				   <?php } ?>
		
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
			<p class="para">The order was cancelled by mutual agreement. Funds were returned to you.</p>
			
			
			</div>
		
		
		</div>
		
				   <?php } else if(empty($checker_status)){
					   
					   
					   if(empty($finals_status)){
					   
					   ?>
		
		
		
		
		
		<div>
	<div class="btn btn-primary sv_send_message">Send a Message</div> 
	
	<div class="conversation_bg">
	<form action="{{ route('buyer_track') }}" method="post" id="formID" enctype="multipart/form-data">
	{{ csrf_field() }}
	
	
	<input type="hidden" name="gid" value="<?php echo $gig_order_status[0]->gid;?>">
	<input type="hidden" name="order_id" value="<?php echo $gig_order_status[0]->id;?>">
	<input type="hidden" name="buyer_id" value="<?php echo $gig_order_status[0]->user_id;?>">
	<input type="hidden" name="seller_id" value="<?php echo $gig_order_status[0]->gig_user_id;?>">
	<input type="hidden" name="msg_type" value="buyer_msg">
	
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
			  
	
			  
	<div class='form-group card required'>
                 <p class="para"> <strong>Got Problem?</strong></p>
                <select name="got_problem" id="got_problem" class="form-control">
				<option value="no">No</option>
				<option value="yes">Yes</option>
				</select>
              </div>
  
  <div class='form-group problemcard required' id="problemcard" style="display:none;">
<?php
$new_checker = DB::table('chat_message')
		           
				   ->where('gid','=',$gig_order_status[0]->gid)
				   ->where('order_id','=',$gig_order_status[0]->id)
				   ->where('buyer_id','=',$gig_order_status[0]->user_id)
				   ->where('seller_id','=',$gig_order_status[0]->gig_user_id)
				   ->where('got_problem', '=', 'no')
				   ->where('complete_work', '=', 'yes')
				   ->count();
				   
if(!empty($new_checker)){ $disable_txt = ""; } else { $disable_txt = "disabled"; }
?>                  
			  <div class="boxes"> 
                       <div class="box rejection first disabled" style="border-radius: 5px;"> 
<p class="para"><input type="radio" class="radio_button" name="reason" id="reject_order" value="Reject_Order" <?php echo $disable_txt;?>>
			<strong>Reject Delivered Work</strong></p> 
                            <p>The seller will have to redeliver the work. Available only after order delivery.</p> 
                        </div> 
<div class="box mutual-cancel mid mutual_toggler mutual_toggler_buyer " style="border-radius: 5px;"> 
<p class="para"><input type="radio" class="radio_button" id="reject_mutual" name="reason" value="Mutual_Cancellation"> 
<strong>You and the Seller Agree to Cancel</strong></p> 
                            <p>Your order is about to be late. You will be able to cancel it in this and that time.</p> 
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
                        <li style="font-weight:bold">Seller does not respond to my messages</li> 
                        <li class="a">Some sellers take more time then others to respond: Time difference, local holidays and personal constraints are typical reasons for lack of response. If you feel the seller is taking too long you can initiate a Mutual Cancellation Request.</li> 
                        <br>
                        <li style="font-weight:bold">Delivered work was not as advertised by the seller</li> 
                        <li class="a">You have three days to reject the submitted work. If you choose to reject, make sure you specify your issues with that order clearly. To reject the seller's work simply choose Reject the Work.</li> 
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
			<p class="para">This order is complete. You can <a href="<?php echo $url;?>/chat/<?php echo $gig_order_status[0]->gig_user_id;?>">continue talking with the seller in the conversation page.</a></p>
			
			
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
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

    
	<div class="clearfix sv_mob_clearfix"></div>
	
	
	
	
	
	<div class="video projectpage">
	<div class="clearfix sv_mob_clearfix"></div>
	<div class="headerbg">
	 <div class="col-md-12" align="center"><h1>Job Details</h1></div>
	 </div>
	
	
	
	
	
	<div class="container">

	 <div class="height50"></div>
	 <div class="row">
	 
	 <div class="col-md-12">
	
	@if(Session::has('success'))

	    <div class="alert alert-success">

	      {{ Session::get('success') }}

	    </div>

	@endif


	
	
 	@if(Session::has('error'))

	    <div class="alert alert-danger">

	      {{ Session::get('error') }}

	    </div>

	@endif
	
	
	@if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
	
	</div>
	 
	 
	 
	 <?php if(!empty($sql_request_count)){?>
	 
	 <?php
						   
						   
						   $files = $sql_request[0]->token;
						   
						   
						   $count_file = DB::table('request_file')
									->where('token_key', '=', $files)
									->count();
									if(!empty($count_file))
									{
									$view_file = DB::table('request_file')
									             ->where('token_key', '=', $files)
									             ->get();
										$pathfile = "";
                                        $secondfile = "";										
										foreach($view_file as $files)
										{
											$pathfile .=$files->file_name."<br/>";
											$secondfile .="<a href=".$url."/local/images/request/".$files->file_name." download>".$files->file_name."</a><br/>";
										}
									
									}
									else
									{
										$pathfile = "";
										$secondfile = "";
									}
						   
						   
						   
						   
						   $tag = $sql_request[0]->request_skills;
								$viewtag = explode(',', $tag);
								$par = "";
								foreach($viewtag as $tags)
								{
									$count_cnt = DB::table('skills')
									->where('id', '=', $tags)
									->count();
									if(!empty($count_cnt))
									{
									$view_key = DB::table('skills')
									->where('id', '=', $tags)
									->get();
							        
									$par .=$view_key[0]->skill.', ';
									}
									else
									{
										$par .= "";
									}
									
								}
                             $topar = rtrim($par,', ');								
						   
						   
						   
						   
						   
						   
						   if(!empty($sql_request[0]->category_type))
						  {
						  if($sql_request[0]->category_type=="subcat")
						  { 
						  
						  $category = DB::table('subcategory')
									->where('subid', '=', $sql_request[0]->category)
									->get();
							$category_cnt = DB::table('subcategory')
									->where('subid', '=', $sql_request[0]->category)
									->count();	
									if(!empty($category_cnt))
									{
									$catname = $category[0]->subname;
									}
									else
									{
										$catname="";
									}
									
						  }
						  if($sql_request[0]->category_type=="cat")
						  { 
						  
						  $category = DB::table('category')
									->where('id', '=', $sql_request[0]->category)
									->get();
							$category_cnt = DB::table('category')
									->where('id', '=', $sql_request[0]->category)
									->count();		
									if(!empty($category_cnt))
									{
									$catname = $category[0]->name;
									}
									else
									{
										$catname ="";
									}
						  }
						  }
						  else
						  {
							  $catname ="";
						  }
						  
						  
						  
						  
						  if(!empty($sql_request[0]->subcategory))
				{
					$view_category = DB::table('subcategory')
										->where('subid', '=', $sql_request[0]->subcategory)
										->get();
					$namesub = $view_category[0]->subname;					
				}
				else
				{
					$namesub = "";
				}
						
						 
						   ?>
						   
						   
						   <?php if($sql_request[0]->budget_type=="fixed")
						   { 
						     $bud_txt = "Fixed Price"; 
						     if($sql_request[0]->fixed_price=="custom_budget")
							 {
								$estim = 'Custom Budget ('.$sql_request[0]->minimum_budget.' - '.$sql_request[0]->maximum_budget.' '.$site_setting[0]->site_currency.')';
							 }
							 else
							 {
								 $estim = $sql_request[0]->fixed_price;
							 }
						   } 
						   else if($sql_request[0]->budget_type=="hour"){ 
						   $bud_txt = "Hourly Price"; 
						   
						   if($sql_request[0]->hour_price=="custom_budget")
							 {
								$estim = $sql_request[0]->minimum_budget.' - '.$sql_request[0]->maximum_budget;
							 }
							 else
							 {
								 $estim = $sql_request[0]->hour_price;
							 }
						   
						   
						   } 
						   
						   if($sql_request[0]->complete_days==1)
						   {
							   $day_txt = "Day";
						   }
						   else if($sql_request[0]->complete_days > 1)
						   {
							   $day_txt = "Days";
						   }
						   else
						   {
							   $day_txt = "";
						   }
						   
						   
						   
						   
						   if($sql_request[0]->request_status==0)
						   {
							   $r_status = "Waiting for freelancer";
							   $r_clr = "#FA4153";
						   }
						   else if($sql_request[0]->request_status!=0 && $sql_request[0]->bid_status!=1)
						   {
							   $r_status = "In Progress";
							   $r_clr = "#F77D0E";
						   }
						   else if($sql_request[0]->bid_status==1)
						   {
							   $r_status = "Completed";
							   $r_clr = "#5DC26A";
						   }
						   ?>
						   
						   
						   
						   
	<div class="col-md-12">
		
	  <div class="row">
	 
    <div class="col-md-8 sv_request_form ashborder">
	<?php if($sql_request[0]->featured==1){?><div class="new_ribbon"><span>Featured</span></div><?php } ?>
	
      <div class="sv_my_req"><h2 class="fleft"><?php echo $sql_request[0]->subject;?> </h2> </div>
	  <span class="clearfix"></span>
	  
	  
	  
	  <span class="clearfix"></span>
	  
	  
	  
	  <?php 
         $newDate = date("w F d Y", strtotime($sql_request[0]->submit_date)); ?>
		<p class="uppercase fleft font15">CREATED<span class="sv_created_date"> <?php echo $newDate;?></span>, IN <?php echo $catname;?><?php if(!empty($namesub)){?>,<?php echo $namesub;?><?php } ?></p>
	  <span class="clearfix"></span>
	  <div class="inline-share">
    <span class="share"></span>
	</div>
	
	
	
	
	  <h3 class="fleft violet_text"><span class="fontsize21">Budget: </span> <?php echo $estim;?></h3>
	  
	  
	  <span class="height20 clearfix"></span>
	
	<div>
	  <?php if(!empty($sql_request[0]->featured_image)){?>
	  <img src="<?php echo $url;?>/local/images/request/<?php echo $sql_request[0]->featured_image;?>" class="img-responsive">
	  <?php } ?>
	  
	  </div>
	  
	  <span class="height20 clearfix"></span>
	  
	  <p class="clearfix height20"></p>
	  <p class="col-sm-12 sv_project"><?php echo nl2br($sql_request[0]->description);?></p>
	  <p class="clearfix height10"></p>
      <p class="sv_project col-md-3"><strong>Skills:</strong></p><p class="col-md-9"> <?php echo $topar;?></p>
      <div style="clear:both;"></div>	 
	 
	  <p class="sv_project col-md-3"><strong>Category:</strong></p><p class="col-md-9"> <?php echo $catname;?><?php if(!empty($namesub)){?>,<?php echo $namesub;?><?php } ?></p>
	 <div style="clear:both;"></div>
	  <?php if(!empty($sql_request[0]->preferred_location)){?>
	
	  <p class="col-sm-3 sv_project"><strong>Preferred Location:</strong> </p><p class="col-sm-9"> <?php echo $sql_request[0]->preferred_location;?></p>
	  <?php } ?>
 <div style="clear:both;"></div>
	  <p class="col-sm-3 sv_project"><strong>File Attachment:</strong> </p><p class="col-sm-9"> 
	  <?php if (Auth::guest()) {?>
	 <a href="javascript:void();" onclick="alert('login user only');"><?php echo $pathfile;?></a>
	  <?php } else { ?>
	<?php echo $secondfile;?>
	  <?php } ?>
	  
	  
	  </p>
	  
	  <div style="clear:both;"></div>
	  <p class="col-sm-3 sv_project"><strong>Estimate Delivery:</strong></p><p class="col-sm-9"> <?php if(!empty($sql_request[0]->complete_days)){?> <?php echo $sql_request[0]->complete_days;?> <?php echo $day_txt;?> <?php } ?></p>
	 <div style="clear:both;"></div>
	 
	  <p class="col-sm-3 sv_project"><strong>Status:</strong></p><p class="col-sm-9">  <span style="color:<?php echo $r_clr;?>;"><?php echo $r_status;?></span></p>
	  	<div class="height20 clearfix"></div>
	  
	  <?php if (Auth::guest()) {?>
	  <p class="ash_border"></p>
	  
	  
	  <h3>Offer to work on this job now! Bid Now</h3>
	  
	  <div class="row">
        <div class="col-md-4">
		    <label>Your bid for this job</label>
            <input type="number" placeholder="Price" class="form-control testBox">
         </div>
        <div class="col-md-4">
		<label>Your email address</label>
            <input type="email" placeholder="Email" class="form-control testBox">
        </div>
        <div class="col-md-4">
		<label></label>
            <a href="javascript:void(0);" class="btn btn-success btn-block bid_btn" onclick="alert('login user only');">Submit</a>
        </div>
	</div>
	
	<div class="height40"></div>
	  <?php } else {
		  
		  
		  
		  if(Auth::user()->id!=$sql_request[0]->user_id)
	  {
		  
	  $award_check = DB::table('request_proposal')
		               ->where('gid','=',$sql_request[0]->gid)
				       ->where('award','=',1)
				       ->count();	  
		  
	  $check_proposal = DB::table('request_proposal')
		               ->where('gid','=',$sql_request[0]->gid)
				       ->where('prop_user_id','=',Auth::user()->id)
				       ->count();
		if(!empty($check_proposal))
		{
			$view_proposal = DB::table('request_proposal')
		                     ->where('gid','=',$sql_request[0]->gid)
				             ->where('prop_user_id','=',Auth::user()->id)
							 ->get();
			$pprice = $view_proposal[0]->bid_price;
            $pproposal = $view_proposal[0]->desc_proposal;
            $btn_txt = "Update";
            $pestimate = $view_proposal[0]->proposal_estimate;			
		}
        else
		{
			$pprice = "";
			$pproposal = "";
			$btn_txt = "Submit";
			$pestimate = "";
			
		}			
		
      if(!empty($award_check))
	  {		  
	  ?>
	  
	 
	  
	  
	  <?php /* ?><h3>Great your selected on this job.</h3><?php */?>
	  
	  
	  
	  
	  <?php } 
	  
	  
	  if(empty($award_check)) { ?>
	  
	  <p class="ash_border"></p>
	  
	  
	  <h3>Offer to work on this job now! Bid Now</h3>
	  <a name="goto"></a>
	  <form class="form-horizontal" role="form" method="POST" action="{{ route('project') }}" id="formID" enctype="multipart/form-data">
       {{ csrf_field() }}
	  <div class="row">
        <div class="col-md-6">
		    <label>Your bid for this job (<?php echo $site_setting[0]->site_currency;?>)</label>
            <input type="number" name="bid_price" placeholder="Price" class="form-control validate[required] testBox" value="<?php echo $pprice;?>">
         </div>
        <div class="col-md-6">
		<label>Your email address</label>
            <input type="email" name="bid_email" placeholder="Email" class="form-control validate[required] testBox readonly" value="<?php echo Auth::user()->email;?>" readonly>
        </div>
		<div class="clearfix height10"></div>
		
		<div class="col-md-12">
		<label>Describe your proposal</label>
            <textarea name="proposal" placeholder="What makes you the best candidate for this project?" class="form-control validate[required] testBox"><?php echo $pproposal;?></textarea>
        </div>
		
		
		<div class="col-md-12">
		<label>Estimated time to complete</label>
            <input type="number" name="proposal_estimate" placeholder="" value="<?php echo $pestimate;?>" class="form-control validate[required] testBox">
			<span>(days)</span>
        </div>
		
		
		<input type="hidden" name="prop_user_id" value="<?php echo Auth::user()->id;?>">
		
		<input type="hidden" name="req_user_id" value="<?php echo $sql_request[0]->user_id;?>">
		
		<input type="hidden" name="gid" value="<?php echo $sql_request[0]->gid;?>">
		
        <div class="col-md-4">
		<label></label>
		<?php if(Auth::user()->confirmation==0){?>
		<a href="javascript:void(0);" onclick="alert('Your e-mail address must be confirmed before you can buy the request');" class="btn btn-success btn-block bid_btn"><?php echo $btn_txt;?></a>
		<?php } else { ?>
		
		
            <input type="submit" class="btn btn-success btn-block bid_btn" value="<?php echo $btn_txt;?>">
        <?php } ?>
		
		</div>
	</div>
	</form>
	<div class="height40"></div>
	  
	  
	  
	  <?php }  } 
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  

      /*if(Auth::user()->id==$sql_request[0]->user_id)
	  {*/
		  
		  if(!empty($total_bids))
		  {
		 ?>
		 <p class="ash_border"></p>
		 <h3><?php echo $total_bids;?> freelancers are bidding for this job</h3>
        <a name="gotonew"></a>
		<div class="height10"></div>
		<div class="pagenavigation">
		
		<?php
        foreach($get_bids as $bid)
		{		
		$user_id = $bid->prop_user_id; 
		
		$userr = DB::table('users')
				->where('id', '=', $user_id)
				->get();
				$userr_cnt = DB::table('users')
				->where('id', '=', $user_id)
				->count();
				
				
		$now = time(); // or your date as well
		$your_date = strtotime($bid->bid_date);
		$datediff = $now - $your_date;

		$fin_date = round($datediff / (60 * 60 * 24));
        if(empty($fin_date))
		{
			$txt_days= "Today";
		}
		else if($fin_date==1)
		{
			$txt_days= "Day";
		}
        else
        {
			$txt_days= "Days";
		}

        if($bid->proposal_estimate==0 or $bid->proposal_estimate==1)
		{
			$txtt_days = "Day";
		}
        else
		{
			$txtt_days = "Days";
		}			
		?>
		<div>
		
		<div class="row">
		
		
		<div class="col-md-2">
		<?php if(!empty($userr_cnt)){
			
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
		
		
		?>
		<a href="<?php echo $pather;?>" class="<?php echo $class;?>">
	<?php 
	
	if(!empty($userr[0]->photo)){?>
				 <img src="<?php echo $url;?>/local/images/userphoto/<?php echo $userr[0]->photo;?>" width="90" class="round">
				 <?php } else { ?>
				 <img src="<?php echo $url;?>/local/images/nophoto.jpg" alt="" width="90" class="round">
				 <?php }  ?>
				 </a>
		<?php } ?>
		</div>
		
		<div class="col-md-7">
		<div class="font22"><a href="<?php echo $pather;?>" class="<?php echo $class;?>"><?php echo $userr[0]->name;?></a></div>
		<p class="black ccount more" data-ccount="200"><?php echo nl2br($bid->desc_proposal);?></p>
		
		</div>
		
		
		<div class="col-md-3 text-center" style="margin-top:10px;">
		<div class="font16 black bold"><?php echo $bid->bid_price.' '.$site_setting[0]->site_currency;?></div>
		<p class="black"><?php if(!empty($fin_date)){ echo $fin_date; }?> <?php echo $txt_days;?></p>
		<p class="black"><strong>Estimate</strong> : <?php if(!empty($bid->proposal_estimate)) {?><?php echo $bid->proposal_estimate;?> <?php echo $txtt_days;?> <?php } ?></p>
		<?php if($bid->award==1){?>
		<span class="btn award_apply">Awarded</span>
		<?php } 
		
		if(Auth::user()->id==$sql_request[0]->user_id)
	    {
		if($bid->award==0){

         if($sql_request[0]->request_status==1 or $sql_request[0]->request_status==2 ){ } else if($sql_request[0]->request_status==0){
		?>
		<a href="<?php echo $url;?>/request/<?php echo $userr[0]->id;?>/<?php echo $sql_request[0]->gid;?>/<?php echo $bid->prp_id;?>" class="btn award_apply" onclick="return confirm('Are you sure you want do this?');">Award</a>
		<?php } } } ?>
		</div>
		
		
		</div>
		
		<div class="height10"></div>
		
		<p class="ash_border"></p>
		
		
		</div>
		
	     <?php
		}
		?>
		</div>
		<div class="pagee"></div>
		 
		<?php  }
		  ?>
		  <div class="height30"></div>
		  <?php
		 
	  /*} */
	  
	  ?>
	  
	  
	  
	  
	  
	  <?php } ?>
	  
	  
    </div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<div class="col-md-4">
	
	<div class="sv_seller_sidebar"> 
	<?php if (Auth::guest()) {?>
	<a href="javascript:void(0);" class="btn bit_apply btn-large" onclick="alert('Login user only');">Apply for Job</a>
	
	<?php } else { ?>
	
    <?php if(Auth::user()->id!=$sql_request[0]->user_id){ 
	
	
	$award_check_cnt = DB::table('request_proposal')
		               ->where('gid','=',$sql_request[0]->gid)
				       ->where('award','=',1)
				       ->count();
	if(!empty($award_check_cnt))
	{
	$award_check = DB::table('request_proposal')
		               ->where('gid','=',$sql_request[0]->gid)
				       ->where('award','=',1)
				       ->get();
	
	if($award_check[0]->prop_user_id==Auth::user()->id){
	?> 
	
	<a href="<?php echo $url;?>/request/<?php echo $sql_request[0]->gid;?>/<?php echo $sql_request[0]->request_slug;?>" class="btn bit_apply btn-large">Awarded to you</a>
	
	<?php } else if($award_check[0]->prop_user_id!=Auth::user()->id) { ?>
	
	<a href="<?php echo $url;?>/request/<?php echo $sql_request[0]->gid;?>/<?php echo $sql_request[0]->request_slug;?>#goto" class="btn bit_apply btn-large">Awarded to other</a>
	
	
	<?php } ?>
	
	<?php } else { ?>
	
	<a href="<?php echo $url;?>/request/<?php echo $sql_request[0]->gid;?>/<?php echo $sql_request[0]->request_slug;?>#goto" class="btn bit_apply btn-large">Apply for job</a>
	<?php } ?>
	
	
	
	<?php } ?>
	
	
	<?php if(Auth::user()->id==$sql_request[0]->user_id){ 
	
	$award_check_cnt = DB::table('request_proposal')
		               ->where('gid','=',$sql_request[0]->gid)
				       ->where('award','=',1)
				       ->count();
	if(!empty($award_check_cnt)){
	?> 
	
	<a href="<?php echo $url;?>/request/<?php echo $sql_request[0]->gid;?>/<?php echo $sql_request[0]->request_slug;?>#gotonew" class="btn award_apply btn-large">Awarded</a>
	<?php } else {?>
	
	<a href="<?php echo $url;?>/request/<?php echo $sql_request[0]->gid;?>/<?php echo $sql_request[0]->request_slug;?>#gotonew" class="btn award_apply btn-large">Award</a>
	
	<?php } ?>
	
	
	
	<?php } ?>
	
	
	<?php } ?>
	
	
	
	
	<?php if(!empty($min_price_count) && !empty($max_price_count)){?>
	<div class="clearfix height30"></div>
	
	<div class="row">
	
	<div class="col-md-6 text-center">
	<strong class="font24"><?php echo $price_min;?> <?php echo $site_setting[0]->site_currency;?></strong><br/>
	<span class="font18">Min Bid Price</span>
	
	</div>
	
	
	<div class="col-md-6 text-center">
	<strong class="font24"><?php echo $price_max;?> <?php echo $site_setting[0]->site_currency;?></strong><br/>
	<span class="font18">Max Bid Price</span>
	</div>
	
	
	</div>
	
	<div class="clearfix ash_border height20"></div>
	
	<div class="row">
	<div class="col-md-12 text-center">
	<strong class="font24"><?php echo $total_bids;?></strong><br/>
	<span class="font18">Total Bids</span>
	</div>
	
	</div>
	<div class="clearfix ash_border height20"></div>
	
	<?php } ?>
	
	
	</div>
	
	
	
	</div>
	
</div><!-- /.row -->
	
		
	</div>
	
	
	   <?php } ?>
	
	
	
	
	
	
	</div>
	
	</div>
	
	
	
	
	
	
	
	
	
	
	</div>
	
	
	

      <div class="height100 clearfix"></div>
	   <div class="clearfix"></div>

	

      @include('footer')
</body>
</html>
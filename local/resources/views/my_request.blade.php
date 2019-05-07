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

	<div class="headerbg">
	 <div class="col-md-12" align="center"><h1>My Posted Job</h1></div>
	 </div>
	<div class="container">
	<div class="height50"></div>
	 
	
	
	
	
	
	<div class="col-md-12 ashborder">
	
	<div class="table-responsive">
	
	  <table id="mytable" class="table table-striped table-bordered table-hover">
                   
                   <thead>
                   <tr>
                   
                   <th> DATE</th>
                    <th>JOB NAME</th>
                     
                     <th>DELIVERY</th>
                      
                       <th>ESTIMATED</th>
					   <th>ACTION</th>
					   
					   <th>FEATURE JOB?</th>
					   
					   <th>MESSAGE TO FREELANCER</th>
					   
					   <th>FUND STATUS</th>
					   </tr>
                   </thead>
            <tbody class="pagenavigation">
			
			
			<?php foreach($sql_request as $request){
				
				$userlog = DB::table('users')
                ->where('id', '=', $request->user_id)
                ->get();
				
				
				$offer_count = DB::table('request_proposal')
                ->where('gid', '=', $request->gid)
                ->count();
				
				
				$req_proposal_count = DB::table('request_proposal')
						->where('gid', '=', $request->gid)
						->where('req_user_id','=',Auth::user()->id)
						->where('award','=',1)
						->count();
				
				if(!empty($req_proposal_count))
				{
				$req_proposal_count = DB::table('request_proposal')
						->where('gid', '=', $request->gid)
						->where('req_user_id','=',Auth::user()->id)
						->where('award','=',1)
						->get();
				$bidding_price = $req_proposal_count[0]->bid_price;	
                  $bider_user = $req_proposal_count[0]->prop_user_id;				
				}
				else
				{
					$bidding_price = 0;
					$bider_user = "";
				}
				?>
				
				<?php if($request->budget_type=="fixed"){ 
						   $bud_txt = "Fixed Price"; 
						     if($request->fixed_price=="custom_budget")
							 {
								$estim = 'Custom Budget ('.$request->minimum_budget.' - '.$request->maximum_budget.' '.$site_setting[0]->site_currency.')';
							 }
							 else
							 {
								 $estim = $request->fixed_price;
							 }
						   } 
						   else if($request->budget_type=="hour"){ 
						   $bud_txt = "Hourly Price"; 
						   
						   if($request->hour_price=="custom_budget")
							 {
								$estim = $request->minimum_budget.' - '.$request->maximum_budget;
							 }
							 else
							 {
								 $estim = $request->hour_price;
							 }
						   
						   
						   } ?>
				
			<tr>
			<td><?php echo $request->submit_date;?></td>
			
			<td><a href="<?php echo $url;?>/request/<?php echo $request->gid;?>/<?php echo $request->request_slug;?>"><?php echo $request->subject;?></a></td>
			
			<td><?php echo $request->complete_days;?> days</td>
	        <td><?php echo $estim;?></td>
			<td>
			
			<a <?php if(!empty($offer_count)){?>href="<?php echo $url;?>/request/<?php echo $request->gid;?>/<?php echo $request->request_slug;?>"<?php } else{?>href="javascript:void(0);"<?php } ?> class="btn btn-success">
			<?php echo $offer_count;?> Bids
			</a>
			
			<?php if($request->request_status==0){?>
			<a href="<?php echo $url;?>/my_request/delete/<?php echo $request->gid;?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
			<?php } ?>
			
			
			
			</td>
			
			
			<td>
			
			<?php if($request->featured==2 && $request->status==1){?>
	<span class="btn btn-warning" style="cursor:default; border-radius:none;">FEATURED - progress</a>
	<?php } else if($request->featured==1 && $request->status==1){ ?>
	<span class="btn btn-success" style="cursor:default; border-radius:none;">FEATURED</a>
	<?php } else if($request->featured==0 && $request->status==1){?>
	
	<a href="<?php echo $url;?>/feature/<?php echo $request->gid;?>" class="btn btn-primary">Make it feature</a></td>
    <?php } else { ?>
	<?php } ?>
			</td>
			
			
			
			
			<td>
			<?php if($request->request_status!=0){?>
			<a href="<?php echo $url;?>/chat/<?php echo $bider_user;?>" class="btn btn-success">
			Message
			</a>
			<?php } else if($request->request_status==0){ ?>
			Not Available
			<?php } ?>
			</td>
			
			
			
			<td>
			<?php if(!empty($request->request_status)){?>
			<?php if($request->request_status==1){?>
			<a href="<?php echo $url;?>/pay_request/<?php echo $request->gid;?>" class="btn btn-success">
			Fund Now
			</a>
			<?php } ?>
			
			<?php if($request->request_status==2){
				
				$fin_amt = $bidding_price;
				?>
			
			<span >funded <?php echo $fin_amt;?> <?php echo $site_setting[0]->site_currency;?> </span>
			
			<?php } ?>
			<?php } else { ?>
			Not Available
			<?php } ?>
			</td>
			
			</tr>
			<?php } ?>
			</tbody>
			
		</table>
    </div>		
	<div class="pagee"></div>
	
	</div>
	
	<?php /* ?><div class="col-md-3">
	@include('side_menu')
	
	</div><?php */?>
	
	
	
	
	</div>
	</div>
	
	
	<div class="height100"></div>

      <div class="clearfix"></div>
	   <div class="clearfix"></div>
    
	
	

      @include('footer')
</body>
</html>
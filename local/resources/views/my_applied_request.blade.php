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
	 <div class="col-md-12" align="center"><h1>My Applied Job</h1></div>
	 </div>
	<div class="height50"></div>
	 
	
	
	
	<div class="col-md-12 ashborder">
	
	<div class="table-responsive">
	
	  <table id="mytable" class="table table-striped table-bordered table-hover">
                   
                   <thead>
                   <tr>
                   
                   <th> BIDDING DATE</th>
                    <th>JOB NAME</th>
                     
                     <th>BIDDING AMOUNT</th>
                      
                       <th>ESTIMATED TIME TO COMPLETE</th>
					   
					   <th>MESSAGE TO CLIENT</th>
					   
					   <th>AWARD STATUS</th>
					   
					   <th>CLIENT FUND STATUS</th>
					   
					   </tr>
                   </thead>
            <tbody class="pagenavigation">
			
			
			<?php 
			
			$logged = Auth::user()->id;
			
			$sql_request = DB::table('request_proposal')
		        
				->where('prop_user_id','=',$logged)
                ->get();
				
		    $sql_request_count = DB::table('request_proposal')
		        
				->where('prop_user_id','=',$logged)
                
                ->count();
				
				if(!empty($sql_request_count))
				{
			
			foreach($sql_request as $request){
				
				
				$sql_request = DB::table('gigs')
		        ->where('status','=',1)
				->where('gid','=',$request->gid)
                ->orderBy('gid','desc')
                ->get();
				
				$sql_request_count = DB::table('gigs')
		        ->where('status','=',1)
				->where('gid','=',$request->gid)
                ->orderBy('gid','desc')
                ->count();
				
				if(!empty($sql_request_count))
				{
				
				
				
				
				
				
				?>
				
				<?php if($sql_request[0]->budget_type=="fixed"){ 
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
						   
						   
						   if($request->proposal_estimate==0 or $request->proposal_estimate==1)
						   {
							   $tday = "day";
						   }
						   else
						   {
							    $tday = "days";
						   }
						   
						   
						   
						   ?>
				
			<tr>
			<td align="center"><?php echo $sql_request[0]->submit_date;?></td>
			
			<td align="center"><a href="<?php echo $url;?>/request/<?php echo $sql_request[0]->gid;?>/<?php echo $sql_request[0]->request_slug;?>"><?php echo $sql_request[0]->subject;?></a></td>
			
			<?php /* ?><td><?php echo $sql_request[0]->complete_days;?> days</td><?php */?>
			
			<td align="center"><?php echo $request->bid_price;?> <?php echo $site_setting[0]->site_currency;?></td>
	        <td align="center"><?php if(!empty($request->proposal_estimate)){?> <?php echo $request->proposal_estimate;?> <?php echo $tday;?><?php } else { ?> - <?php } ?><?php //echo $estim;?></td>
			
			<td align="center">
			<?php if($request->award==1){
				
				
				
				?>
			<a href="<?php echo $url;?>/chat/<?php echo $sql_request[0]->user_id;?>" class="btn btn-success">
			Message
			</a> 
			<?php } else { ?>
			Not Available
			<?php } ?>
			</td>
			
			
			
			
			<td align="center">
			<?php 
				
				
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
				
				if($award_check[0]->prop_user_id==Auth::user()->id)
			   {
			?>	   
			<span>Job awarded to you</span>
			   <?php } else if($award_check[0]->prop_user_id!=Auth::user()->id) { ?>	
			<span>Awarded to other</span>
			   <?php } ?>
			
			<?php } else { ?>
			<span>Not yet awarded</span>
			<?php } ?>
			</td>
			
			
			<td align="center">
			<?php 
			if($request->award==1){
			
			if($sql_request[0]->request_status==2){
				
				$fin_amt = $request->bid_price;
				?>
			
			<span style="color:#5CB85C; font-weight:bold;">funded <?php echo $fin_amt;?> <?php echo $site_setting[0]->site_currency;?> </span>
			
			<?php } } else { ?>
			Not Available
			<?php } ?>
			</td>
			
			
			<?php /* ?>
			<td>
			
			
			
			
			<a href="<?php echo $url;?>/my_request/delete/<?php echo $sql_request[0]->rid;?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
			</td><?php */?>
			</tr>
				<?php } } }  ?>
			</tbody>
			
		</table>
    </div>		
	<div class="pagee"></div>
	
	</div>

	
	</div>
	
	
	<div class="height100"></div>

      <div class="clearfix"></div>
	
	

      @include('footer')
</body>
</html>
<?php
	use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");
$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();

?>
<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	


<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAu93cD3ifRoxBSljZFjV3zvLk7ZCiGcrU"></script>


 
 <script>
	$( function() {
		$( "#slider-range" ).slider({
			range: true,
			min: 0,
			max: 10000,
			values: [ 100, 3000 ],
			slide: function( event, ui ) {
				$( "#amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ]+ " (<?php echo $setts[0]->site_currency;?>)" );
			}
		});
		$( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) +
			" - " + $( "#slider-range" ).slider( "values", 1 )+ " (<?php echo $setts[0]->site_currency;?>)" );
	} );
	</script>

</head>
<body>

    

    <!-- fixed navigation bar -->
    @include('header')

    <!-- slider -->

	<div class="video">

	<div class="headerbg">
	 <div class="col-md-12" align="center"><h1>All Jobs</h1></div>
	 </div>
	<div class="container">
	<div class="clearfix height50"></div>
	 <div class="col-md-12">
	  
	  <form role="form" method="POST" action="{{ route('buyer_request') }}" id="formID" enctype="multipart/form-data">
      {{ csrf_field() }}
	  
	  
	  
	  
	  
	  <div class="sv_seller_sidebar row sv_buyer_req">

	  
	  <div class="col-md-3">
	  
     <h3 class="sv_title">Category</h3>	  
	  <select name="everyone" class="pads10" onChange="window.document.location.href=this.options[this.selectedIndex].value;">	

			  <option value="">Category</option>
			  <option value="<?php echo $url;?>/buyer_request">All</option>
			  <?php foreach($viewcati as $viewas){?>
			  <option value="<?php echo $url;?>/buyer_request/<?php echo $viewas->id;?>_cat" <?php if($cid==$viewas->id.'_cat'){?> selected="selected" <?php } ?>><?php echo $viewas->name;?>
			  <?php $viewsub = DB::table('subcategory')
                               ->where('category','=',$viewas->id)
                               ->get();
                    foreach($viewsub as $sub){?>
                     <option value="<?php echo $url;?>/buyer_request/<?php echo $sub->subid;?>_subcat" <?php if($cid==$sub->subid.'_subcat'){?> selected="selected" <?php } ?>>  &nbsp;&nbsp;-<?php echo $sub->subname;?></option>
                    <?php } ?>					
			  
			  
			  
			  </option>
			  
			  <?php } ?>
			  
			  </select>
	  
	  </div>
	  
	  
	  
	  
    
	
	  
	<?php /* ?><h3 class="sv_title">Project Type</h3>
	
	<div class="menufont sv_right_sidebar">
	
	
	<select name="project_type" class="pads10" onChange="window.document.location.href=this.options[this.selectedIndex].value;">
	<option value=""></option>
     <option value="<?php echo $url;?>/buyer_request/status/fixed">Fixed Projects</option>	
	<option value="<?php echo $url;?>/buyer_request/status/hour">Hourly Projects</option>	
	</select>
	
	</div>
	
	<hr><?php */?>
	
	<div class="col-md-3">
	<h3 class="sv_title">Skills</h3>	
	
	<select class="multipleSelect" name="request_skills[]" multiple>
	 <?php if(!empty($skills_count)){?>
	 <?php foreach($skills_get as $skill){?>
                <option value="<?php echo $skill->id;?>"><?php echo $skill->skill;?></option>
	 <?php } ?>			
     <?php } ?>
	 </select>
	 
	 <script>

                $('.multipleSelect').fastselect();

            </script>
			
		
<?php /* ?>
    <hr>
	
	<h3 class="sv_title">Price range</h3>	

    <label>Min</label><input type="text" name="fixed_minimum"><label>Max</label><input type="text" name="fixed_maximum">	
	 
	<hr>
   
		<?php */?>
		
		</div>
		
		<div class="col-md-3">
	
	<h3 class="sv_title">Price range</h3>	
<input type="text" id="amount" name="price_range" readonly >
	  
    <div id="slider-range"></div>
	 
	</div>
	
	<div class="col-md-3">
		
		
		<h3 class="sv_title">Preferred location</h3>	
     <input type="text" class="form-control" id="autocomplete" name="preferred_location" style="">
     
  
  
  

    <script>
      var input = document.getElementById('autocomplete');
      var autocomplete = new google.maps.places.Autocomplete(input,{types: ['(cities)']});
      google.maps.event.addListener(autocomplete, 'place_changed', function(){
         var place = autocomplete.getPlace();
      })
	  
    </script>
	  
	</div>
		
		
	<div style="clear:both;"></div>
	
	
	<div class="col-md-3">
	<div></div>
	<h3 class="sv_title">Featured </h3>
	<input type="checkbox" class="" name="featured" value="1" <?php if(!empty($featured)){?> checked <?php } ?> style="width:20px; height:20px;">
	
	
	</div>
	<?php //echo $return;?>
	<div class="col-md-3">
	<div class="height20"></div>
	<input type="submit" name="filter" value="FILTER" class="btn btn-info font16" >
	
	</div>
	
	
	<div class="col-md-3">
	
	</div>
	
	
	
	<div class="col-md-3">
	
	</div>
	
	
	
	
	</div>
	
	
	
	
	</form>
	
	
	</div>
	
	
	<div class="clearfix height50"></div>
	<div class="clearfix height30"></div>
	
	<div class="col-md-12 paddingoff ashborder">
	
	
	<div class="table-responsive col-md-12">
	
	  <table id="mytable" class="table table-striped table-bordered table-hover">
                   
                   <thead>
                   <tr>
                   
                   <th>IMAGE</th>
                    <th>REQUEST</th>
                     <th>BIDS</th>
                     <th>DELIVERY</th>
                      
                       <th>BUDGET</th>
					   <th> REQUEST OWNER</th>
					   <th>BID NOW</th>
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
				
				if($offer_count==1 or $offer_count==0){ $bid_txt = "Bid"; } else if($offer_count > 1) { $bid_txt = "Bids"; } else { $bid_txt = "Bid";}
				
				
				if($request->budget_type=="fixed")
						   { 
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
						   
						   
						   } 
				
				?>
			<tr>
			
			<td class="new_job">
			
			<?php if($request->featured_image!=""){?>
			<img src="<?php echo $url;?>/local/images/request/<?php echo $request->featured_image;?>" border="0" />
			<?php } else { ?>
			<img src="<?php echo $url;?>/local/images/noimage.jpg" border="0" />
			<?php } ?>
			<?php if($request->featured==1){?><div class="feature_job"><span class="featured">Featured</span></div><?php } ?>
			</td>
			
			
			
			
			
			<td><a href="<?php echo $url;?>/request/<?php echo $request->gid;?>/<?php echo $request->request_slug;?>"><?php echo $request->subject;?> </a> </td>
			<td><span class="btn btn-info"><?php echo $offer_count;?> <?php echo $bid_txt;?></span></td>
			<td><?php echo $request->complete_days;?> days</td>
	        <td><?php echo $site_setting[0]->site_currency;?> <?php echo $estim;?></td>
			<td><?php echo $userlog[0]->name;?></td>
			<td>
			<?php if (Auth::guest()) {?>
			<a href="javascript:void(0);" class="btn btn-success" onclick="alert('Login user only');">Send an offer</a>
			<?php } else { 
			
			if(Auth::user()->id == $request->user_id)
			{
			?>
			<a href="<?php echo $url;?>/request/<?php echo $request->gid;?>/<?php echo $request->request_slug;?>" class="btn btn-success">View Project</a>
			<?php } else { 
			
			
			$award_check_cnt = DB::table('request_proposal')
		               ->where('gid','=',$request->gid)
				       ->where('award','=',1)
				       ->count();
			if(!empty($award_check_cnt))
			{
			$award_check = DB::table('request_proposal')
							   ->where('gid','=',$request->gid)
							   ->where('award','=',1)
							   ->get();
			
			if($award_check[0]->prop_user_id==Auth::user()->id)
			{
			
			
			
			?>
			<a href="<?php echo $url;?>/request/<?php echo $request->gid;?>/<?php echo $request->request_slug;?>" class="btn btn-info">Awarded to you</a>
			
			<?php } else if($award_check[0]->prop_user_id!=Auth::user()->id) {?>
			
			<a href="<?php echo $url;?>/request/<?php echo $request->gid;?>/<?php echo $request->request_slug;?>" class="btn btn-danger">Awarded to other</a>
			
			<?php } ?>
			
			
			
			<?php } else { if(Auth::user()->confirmation==0){?>
            <a href="javascript:void(0);" onclick="alert('Your e-mail address must be confirmed before you can buy the request');" class="btn btn-success">Bid Now</a>
			<?php } else { ?>

          <a href="<?php echo $url;?>/request/<?php echo $request->gid;?>/<?php echo $request->request_slug;?>" class="btn btn-success">Bid Now</a>
           
            <?php } } ?>
			<?php } ?>
			<?php } ?>
			</td>
			</tr>
			<?php } ?>
			</tbody>
			
		</table>
    </div>		
	<div class="pagee"></div>
	
	</div>
	
	
	
	
	
	
	
	</div>
	</div>
	
	
	
<div class="height100"></div>
      <div class="clearfix"></div>
	   <div class="clearfix"></div>
    
	
	

      @include('footer')
</body>
</html>
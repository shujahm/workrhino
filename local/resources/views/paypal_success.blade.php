<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	




</head>
<body>

    

    <!-- fixed navigation bar -->
    @include('header')

    <!-- slider -->
    

	
    
	
	
	
	
	
	
	
	<div class="clearfix sv_mob_clearfix"></div>
	
	
	
	
	
	<div class="video">
	<div class="clearfix sv_mob_clearfix"></div>
	<div class="headerbg">
	 <div class="col-md-12" align="center"><h1>PAYMENT SUCCESS</h1></div>
	 </div>
	<div class="container">
	
	 <div class="height30"></div>
	 <div class="row">
	<?php
	if(!empty($ref_id) && !empty($_REQUEST['tx']))
	{
	DB::table('gig_order')
						->where('reference_id', '=', $ref_id)
						->update(['paypal_token' => $_REQUEST['tx']]);
	}
	?>
	
	<div class="container text-center">
	<h2>Your payment has been successful.</h2>
    <?php /* ?><?php if(empty($stripe_token)){?><h2>Your Payment ID - <?php echo $cid; ?>.</h2><?php } ?>
	<?php if(!empty($stripe_token)){?><h2>Your Payment ID - <?php echo $stripe_token;?> </h2><?php } ?><?php */?>
	<?php if(!empty($_REQUEST['tx'])){?><h2>Your Payment ID - <?php echo $_REQUEST['tx']; ?>.</h2><?php } ?>
	</div>
	
	
	
	
	</div>
	
	</div>
	</div>
	
	
	

      <div class="clearfix"></div>
	   <div class="clearfix"></div>

      @include('footer')
</body>
</html>
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
	
	
	
	
	
	<div class="video">
	<div class="clearfix sv_mob_clearfix"></div>
	<div class="headerbg">
	 <div class="col-md-12" align="center"><h1>Stripe Payment</h1></div>
	 </div>
	<div class="container">
	
	 <div class="height30"></div>
	 <div class="row">
	
	
	
	<div class="col-md-12">
	
	<?php if(!empty($total_price)){
	 
	
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
						
						
           			
	 }			
		?>
	
	
	
	
	<h4 class="payil">Job Title: <?php echo $gig_name;?><br/><br/>
	
Price: <?php echo $site_setting[0]->site_currency;?> <?php echo $total_price;?> <br/><br/>
	
Processing Fee: <?php echo $site_setting[0]->site_currency;?> <?php echo $site_setting[0]->processing_fee;?> <br/><br/>
Total: <?php echo $site_setting[0]->site_currency;?> <?php echo $site_setting[0]->processing_fee+$total_price;?>
<?php 

$new_amount = $site_setting[0]->processing_fee+$total_price;

 ?>
</h4>
	<?php
	$arrays =  explode(',', $site_setting[0]->payment_option);
	if(in_array('payumoney',$arrays))
	{ 
     $fprice = $new_amount * 100;
    
		
	?>
	
	<form action="{{ route('stripe-fund') }}" method="POST">
	{{ csrf_field() }}
	<input type="hidden" name="gid" value="<?php echo $gid;?>">
	<input type="hidden" name="cid" value="<?php echo $random;?>">
	<input type="hidden" name="amount" value="<?php echo $fprice; ?>">
	<input type="hidden" name="currency_code" value="<?php echo $site_setting[0]->site_currency; ?>">
	<input type="hidden" name="item_name" value="<?php echo $gig_name;?>">
		<script src="https://checkout.stripe.com/checkout.js" 
		class="stripe-button" 
		<?php if($site_setting[0]->stripe_mode=="test") { ?>
		data-key="<?php echo $site_setting[0]->test_publish_key; ?>" <?php } ?>
		<?php if($site_setting[0]->stripe_mode=="live") {  ?>
		data-key="<?php echo $site_setting[0]->live_publish_key; ?>" 
		<?php }?> 
		data-image="<?php echo $url.'/local/images/settings/'.$site_setting[0]->site_logo;?>" 
		data-name="<?php echo $gig_name;?>" 
		data-description="<?php echo $site_setting[0]->site_name;?>"
		data-amount="<?php echo $fprice; ?>"
		data-currency="<?php echo $site_setting[0]->site_currency; ?>"
		/>
		</script>
	</form>
		
	<?php } ?>
	
	
	
	<?php } ?>
	
	</div>
	
	
	
	
	</div>
	
	</div>
	</div>
	
	
	

      <div class="height100 clearfix"></div>
	   <div class="clearfix"></div>
	
		

      @include('footer')
</body>
</html>
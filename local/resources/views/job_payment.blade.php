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
	 <div class="col-md-12" align="center"><h1>Paypal Payment</h1></div>
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
	if(in_array('paypal',$arrays))
	{ 

    
		
	?>
	
	<form action="<?php echo $paypal_url; ?>" method="post">

        
        <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
        
        
        <input type="hidden" name="cmd" value="_xclick">
        
        <!-- Specify details about the item that buyers will purchase. -->
        <input type="hidden" name="item_name" value="<?php echo $gig_name;?>">
        <input type="hidden" name="item_number" value="<?php echo $random;?>">
        <input type="hidden" name="amount" value="<?php echo $new_amount; ?>">
        <input type="hidden" name="currency_code" value="<?php echo $site_setting[0]->site_currency; ?>">
        
        <!-- Specify URLs -->
        <input type='hidden' name='cancel_return' value='<?php echo $url;?>/cancel'>
		<input type='hidden' name='return' value='<?php echo $url;?>/paypal_success/<?php echo $gid;?>/<?php echo $random;?>/<?php echo $aid;?>'><br/>
		<input type="submit" name="submit" value="PAY NOW" class="btn btn-success">
     
    
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
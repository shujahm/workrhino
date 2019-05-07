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
	 <div class="col-md-12" align="center"><h1>PayuMoney Payment</h1></div>
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
     
    
	if($site_setting[0]->payu_mode=='live'){ $action = 'https://secure.payu.in/_payment'; } 
		if($site_setting[0]->payu_mode=='test'){ $action = 'https://test.payu.in/_payment'; }
		$merchant = $site_setting[0]->merchant_key;
		$salt = $site_setting[0]->salt_id;
		$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		$email = Auth::user()->email;
        $name = Auth::user()->name;
		$phone = Auth::user()->phone;
$hash_string = $merchant."|".$txnid."|".$new_amount."|".$gig_name."|".$name."|".$email."|||||||||||".$salt;
$hash = strtolower(hash('sha512', $hash_string));
		$success_url = $url.'/payu-fund-success/'.$gid.'/'.$random.'/'.$txnid;
		$fail_url = $url.'/payu_failed/'.$random;
		
	?>
	
	<form action="<?php echo $action; ?>" method="post" name="payuForm" id="payuForm">
	{{ csrf_field() }}
	<input type="hidden" name="cid" value="<?php echo $random;?>">
    <input type="hidden" name="key" value="<?php echo $merchant ?>" />
    <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
    <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
    <input name="amount" type="hidden" value="<?php echo $new_amount; ?>" />
    <input type="hidden" name="firstname" id="firstname" value="<?php echo $name; ?>" />
    <input type="hidden" name="email" id="email" value="<?php echo $email; ?>" />
    <input type="hidden" name="phone" value="<?php echo $phone; ?>" />
    <input type="hidden" name="productinfo" value="<?php echo $gig_name; ?>">
    <input type="hidden" name="surl" value="<?php echo $success_url; ?>" />
    <input type="hidden" name="furl" value="<?php echo  $fail_url;?>"/>
    <input type="hidden" name="service_provider" value=""/>
    <input type="submit" name="submit" value="Pay using PayuMoney" class="btn btn-primary">
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
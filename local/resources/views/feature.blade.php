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
	 <div class="col-md-12" align="center"><h1>Feature Job</h1></div>
	 </div>
	
	<div class="container">
	
	 <div class="row">
	 <?php if(!empty($gig_cnt)){
	 
			  $giger_img = DB::table('gig_images')
				->where('token', '=', $gig[0]->token)
				->get();
				$giger_cnt = DB::table('gig_images')
				->where('token', '=', $gig[0]->token)
				->count();
			
      if($gig[0]->job_type=="request")
	  {
		   $urwel = $url.'/project/'.$gig[0]->gid.'/'.$gig[0]->request_slug;
		   $vtxt = "When you feature a request it will be shown before other requests on the website.";
		   $htxt = "Feature Request";
	  }
	  else
	  {
		  $urwel = $url.'/service/'.$gig[0]->gid;
		  $vtxt = "When you feature a Service it will be shown before other Services on the website.";
		  $htxt = "Feature Service";
	  }
       		
		?>
	 
	
	<div class="col-md-12 ashborder svorder">
	
	
	<a href="<?php echo $urwel;?>">
	<?php 
	if(!empty($giger_cnt)){
	if(!empty($giger_img[0]->image)){?>
	<img src="<?php echo $url;?>/local/images/gigs/<?php echo $giger_img[0]->image;?>" alt="" class="img-responsive">
	<?php } else { ?>
	<img src="<?php echo $url;?>/local/images/noimage.jpg" alt="" class="img-responsive">
    <?php } }?></a>
	<div class="height20"></div>
	<h3><a href="<?php echo $urwel;?>"><?php echo $gig[0]->subject;?></a></h3>
	
	
	<h4 class="payil"><?php echo $vtxt;?><br/><br/>
Price: <?php echo $site_setting[0]->site_currency;?> <?php echo $site_setting[0]->featured_gig_price;?><br/><br/>
<?php /* ?> Duration: <?php echo $site_setting[0]->featured_days;?> days <?php */?>
</h4>
	<?php
	$rand = rand(00000,99999);
	$arrays =  explode(',', $site_setting[0]->payment_option);
	if(in_array('paypal',$arrays)){ 

    if(!empty($site_setting[0]->paypal_url))
	{
	$paypal_url = $site_setting[0]->paypal_url;
	}
	else { $paypal_url = ""; }
	if(!empty($site_setting[0]->paypal_id))
	{
	$paypal_id = $site_setting[0]->paypal_id;
	}
	else { $paypal_id = ""; }	
	
	
	
	$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->first();
		
		$admin_email = $admindetails->email;
	
	$aid=base64_encode($admin_email);
		
	?>
	
	<div class="row">
	<div class="col-md-3 col-xs-3 text-center">
	<div><img class="payment_img" src="<?php echo $url;?>/img/paypal.png" border="0" /></div>
	<div class="height20"></div>
	<form action="<?php echo $paypal_url; ?>" method="post">

        
        <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
        
        
        <input type="hidden" name="cmd" value="_xclick">
        
        <!-- Specify details about the item that buyers will purchase. -->
        <input type="hidden" name="item_name" value="<?php echo $gig[0]->subject;?>">
        <input type="hidden" name="item_number" value="<?php echo $rand;?>">
        <input type="hidden" name="amount" value="<?php echo $site_setting[0]->featured_gig_price; ?>">
        <input type="hidden" name="currency_code" value="<?php echo $site_setting[0]->site_currency; ?>">
        
        <!-- Specify URLs -->
        <input type='hidden' name='cancel_return' value='<?php echo $url;?>/cancel'>
		<input type='hidden' name='return' value='<?php echo $url;?>/success/<?php echo $gig[0]->gid;?>/<?php echo $rand;?>/<?php echo $aid;?>'>
		<input type="submit" name="submit" value="Pay using PAYPAL" class="btn sv_paypal">
     
    
    </form>
	
	
	
	<?php } ?>
    </div>
	
	
	
    
	<?php 	
	
	if(in_array('stripe',$arrays)){ ?>
	<div class="col-md-3 col-xs-3 text-center">
    <div><img class="payment_img" src="<?php echo $url;?>/img/stripe.png" border="0" /></div>
	<div class="height20"></div>
	
	<?php
	$fprice = $site_setting[0]->featured_gig_price * 100;
	?>
	<form action="{{ route('stripe-featured') }}" method="POST">
	{{ csrf_field() }}
	<input type="hidden" name="gid" value="<?php echo $gig[0]->gid;?>">
	<input type="hidden" name="cid" value="<?php echo $rand;?>">
	<input type="hidden" name="amount" value="<?php echo $fprice; ?>">
	<input type="hidden" name="currency_code" value="<?php echo $site_setting[0]->site_currency; ?>">
	<input type="hidden" name="item_name" value="<?php echo $gig[0]->subject;?>">
		<script src="https://checkout.stripe.com/checkout.js" 
		class="stripe-button" 
		<?php if($site_setting[0]->stripe_mode=="test") { ?>
		data-key="<?php echo $site_setting[0]->test_publish_key; ?>" <?php } ?>
		<?php if($site_setting[0]->stripe_mode=="live") {  ?>
		data-key="<?php echo $site_setting[0]->live_publish_key; ?>" 
		<?php }?> 
		data-image="<?php echo $url.'/local/images/settings/'.$site_setting[0]->site_logo;?>" 
		data-name="<?php echo $gig[0]->subject;?>" 
		data-description="<?php echo $site_setting[0]->site_name;?>"
		data-amount="<?php echo $fprice; ?>"
		data-currency="<?php echo $site_setting[0]->site_currency; ?>"
		/>
		</script>
	</form>
	
	</div>
	<?php
	}
	?>
	
	
	
	
	<?php
	if(in_array('payumoney',$arrays)){
	?>
	<div class="col-md-3 col-xs-3 text-center">
	<div><img class="payment_img" src="<?php echo $url;?>/img/payumoney.png" border="0" /></div>
	<div class="height20"></div>
	<?php
	if($site_setting[0]->payu_mode=='live'){ $action = 'https://secure.payu.in/_payment'; } 
		if($site_setting[0]->payu_mode=='test'){ $action = 'https://test.payu.in/_payment'; }
		$merchant = $site_setting[0]->merchant_key;
		$salt = $site_setting[0]->salt_id;
		$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		$email = Auth::user()->email;
        $name = Auth::user()->name;
		$phone = Auth::user()->phone;
$hash_string = $merchant."|".$txnid."|".$site_setting[0]->featured_gig_price."|".$gig[0]->subject."|".$name."|".$email."|||||||||||".$salt;
$hash = strtolower(hash('sha512', $hash_string));
		$success_url = $url.'/payu-feature-success/'.$gig[0]->gid.'/'.$rand.'/'.$txnid;
		$fail_url = $url.'/payu_failed/'.$rand;
	?>
	<form action="<?php echo $action; ?>" method="post" name="payuForm" id="payuForm">
	{{ csrf_field() }}
	<input type="hidden" name="cid" value="<?php echo $rand;?>">
    <input type="hidden" name="key" value="<?php echo $merchant ?>" />
    <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
    <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
    <input name="amount" type="hidden" value="<?php echo $site_setting[0]->featured_gig_price; ?>" />
    <input type="hidden" name="firstname" id="firstname" value="<?php echo $name; ?>" />
    <input type="hidden" name="email" id="email" value="<?php echo $email; ?>" />
    <input type="hidden" name="phone" value="<?php echo $phone; ?>" />
    <input type="hidden" name="productinfo" value="<?php echo $gig[0]->subject; ?>">
    <input type="hidden" name="surl" value="<?php echo $success_url; ?>" />
    <input type="hidden" name="furl" value="<?php echo  $fail_url;?>"/>
    <input type="hidden" name="service_provider" value=""/>
    <input type="submit" name="submit" value="Pay using PayuMoney" class="btn sv_payu">
</form>
</div>
    <?php 
	
	
	}
	?>
	
	
	
	<div class="col-md-3 col-xs-3 text-center">
    <div><img class="payment_img" src="<?php echo $url;?>/img/mywallet.png" border="0" /></div>
	<div class="height20"></div>
	<?php
	if(Auth::user()->wallet > $site_setting[0]->featured_gig_price ){?>
	<a href="<?php echo $url;?>/feature/buyer/<?php echo Auth::user()->id;?>/<?php echo $gig[0]->gid;?>" class="btn btn-primary">Pay using available balance</a>
	<?php } ?>
	<?php /* ?><?php } if(in_array('localbank',$arrays)){?>
	<div class="fleft right10">
	<a href="<?php echo $url;?>/feature_bank_payment/<?php echo $gig[0]->gid;?>/<?php echo $site_setting[0]->featured_gig_price;?>/<?php echo $site_setting[0]->featured_days;?>" class="btn btn-primary">Local Bank Payment</a>
	</div>
	<?php } ?><?php */?>
	
	
	
	</div>
	
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
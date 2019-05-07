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
    

	<div class="clearfix sv_mob_clearfix"></div>
	
	
	@if(Session::has('success'))
<div class="col-md-12">
	    <div class="alert alert-success">

	      {{ Session::get('success') }}

	    </div>
</div>
	@endif
	
	
	
	@if(Session::has('error'))
<div class="col-md-12">
	    <div class="alert alert-danger">

	      {{ Session::get('error') }}

	    </div>
</div>
	@endif
	
	
	<?php if(!empty($error)){?>
	<div class="col-md-12">
	    <div class="alert alert-danger">

	      <?php echo $error;?>

	    </div>
</div>
	<?php } ?>
	
	
	<?php
	
	if(!empty($coupon_amount))
	{
		if($coupon_type=="percentage")
					   {
						   $commission_amount = ($coupon_amount * $total_price) / 100;
					   }
					   else if($coupon_type=="fixed")
					   {
							
								$commission_amount = $coupon_amount;
							
					   }
					   else
					   {
						   $commission_amount = 0;
					   }
	
	}
		
	 ?>
	
	
	<div class="video">
	<div class="clearfix"></div>
	<div class="headerbg">
	 <div class="col-md-12" align="center"><h1>Payment Details</h1></div>
	 </div>
	<div class="container">
	
	 <div class="height30"></div>
	 <div class="row">
	<div class="col-md-12">
	
	</div>
	
	
	<div class="col-md-12 ashborder svorder">
	
	<?php if(!empty($total_price)){
	 
			  
				
		?>
	
	<form class="form-horizontal" role="form" method="POST" action="{{ route('coupon_order') }}" id="formID" enctype="multipart/form-data">
    {{ csrf_field() }}
	
	
	<h4 class="payil">Job Title: <?php echo $gig_name;?><br/><br/>
	
Price: <?php echo $site_setting[0]->site_currency;?> <?php echo $total_price;?> <br/><br/>

Processing Fee: <?php echo $site_setting[0]->site_currency;?> <?php echo $site_setting[0]->processing_fee;?> <br/><br/>

	
Total: <?php echo $site_setting[0]->site_currency;?> <?php echo $site_setting[0]->processing_fee+$total_price;?><br/><br/>

<?php 
$tt_value = $site_setting[0]->processing_fee+$total_price;

$couponid = 0;
$price_value = $total_price;  ?>


</h4>


	<?php
	if(!empty($gig_type))
    {
		$gigtype = $gig_type;
	}		
	else
	{
		$gigtype = 0;
	}
	if(!empty($ex_text))
    {
		$extext = $ex_text;
	}		
	else
	{
		$extext = 0;
	}
	?>
	
	<div class="row">
	<?php
	$arrays =  explode(',', $site_setting[0]->payment_option);
	if(in_array('paypal',$arrays))
	{ 
	
	?>
	
	<input type="hidden" name="total_price" value="<?php echo $total_price;?>">
	<input type="hidden" name="gig_id" value="<?php echo $gig_id;?>">
	<input type="hidden" name="gigtype" value="<?php echo $gigtype;?>">
	<input type="hidden" name="extext" value="<?php echo $extext;?>">
	<input type="hidden" name="gig_name" value="<?php echo $gig_name;?>">
	
	
	
	<div class="col-md-3 col-xs-3 text-center">
	<div><img class="payment_img" src="<?php echo $url;?>/img/paypal.png" border="0" /></div>
	<div class="height20"></div>
	<a href="<?php echo $url;?>/job_payment/<?php echo $total_price;?>/<?php echo $gig_id;?>/<?php echo $gigtype;?>/<?php echo $extext;?>/<?php echo $couponid;?>" class="btn sv_paypal">
	Pay using PayPal</a>
	</div>
	
	<?php } if(in_array('localbank',$arrays)){?>
	
	
	<a href="<?php echo $url;?>/bank_payment/<?php echo $total_price;?>/<?php echo $gig_id;?>/<?php echo $gigtype;?>/<?php echo $extext;?>" class="font17">Local Bank Payment</a>
	<?php } ?>
	
	
	
	
	
	<?php if(Auth::user()->wallet > $tt_value ){?>
	<div class="col-md-3 col-xs-3 text-center">
	<div><img class="payment_img" src="<?php echo $url;?>/img/mywallet.png" border="0" /></div>
	<div class="height20"></div>
	<a href="<?php echo $url;?>/own_amount/<?php echo $total_price;?>/<?php echo $gig_id;?>/request" class="btn btn-primary">Pay using available balance</a>
	</div>
	<?php } ?>
	
	
	
	
	<?php if(in_array('stripe',$arrays)){ ?>
	
	<div class="col-md-3 col-xs-3 text-center">
	<div><img class="payment_img" src="<?php echo $url;?>/img/stripe.png" border="0" /></div>
	<div class="height20"></div>
	<a href="<?php echo $url;?>/stripe_payment/<?php echo $total_price;?>/<?php echo $gig_id;?>/<?php echo $gigtype;?>/<?php echo $extext;?>/<?php echo $couponid;?>" class="btn stripe-button-el">Pay using stripe</a>
	</div>
	
	<?php } ?>
	
	
	
	
	<?php if(in_array('payumoney',$arrays)){ ?>
	<div class="col-md-3 col-xs-3 text-center">
	<div><img class="payment_img" src="<?php echo $url;?>/img/payumoney.png" border="0" /></div>
	<div class="height20"></div>
	<a href="<?php echo $url;?>/payumoney_payment/<?php echo $total_price;?>/<?php echo $gig_id;?>/<?php echo $gigtype;?>/<?php echo $extext;?>/<?php echo $couponid;?>" class="btn sv_payu">Pay using payumoney</a>
	</div>
	<?php } ?>
	
	</div>
	</form>
	
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
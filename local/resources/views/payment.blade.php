<?php
/*if (Auth::check())
{
	
}
else
{
	//redirect()->route('login');
	
	echo Redirect::to('login');
}*/

?>   
<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	




</head>
<body>
<?php $url = URL::to("/");
$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
?>
    

    <!-- fixed navigation bar -->
    @include('header')

    <!-- slider -->
    

	
    
	
	<?php $bookingDateArr = explode("," , $booking_days_dates) ?>	
	
	
	
	
	
	<div class="clearfix sv_mob_clearfix"></div>
	
	
	
	
	
	<div class="video">
	<div class="clearfix sv_mob_clearfix"></div>
	<div class="headerbg">
	 <div class="col-md-12" align="center" style="display:none"><h1>PAYMENT CONFIRMATION</h1></div>
	<div class="col-md-12" align="center"><h1>THANK YOU FOR BOOKING</h1></div>
	<div class="col-md-12" align="center"><h4>WE WILL INFORM YOU WITHIN 24 HOURS</h4></div>
	 </div>
	
	<div class="container">
	 
	 <div class="height30"></div>
	 <div class="row">
	
	
	<?php //echo $sum;?>
	
	<?php //echo $admin_email;?>
	
	<?php //echo $user_email;?>
	
	
	<div class="container text-center">
	<div class="min-space"></div>
	<label>Services Name </label> - <?php echo $service_names; ?><br>
     <label>Booking Dates</label>:  @foreach($bookingDateArr as $val){{$val}},, @endforeach  <br>
    <label>Price</label> - <?php echo $prices; ?> <?php echo $currency; ?>
	
	
	<?php 
	if($payment_mode=="paytm"){?>
	<form class="form-horizontal" role="form" method="POST" action="{{ route('payment_new') }}" id="formID" enctype="multipart/form-data">
   {{ csrf_field() }}
   <input type="hidden" name="item_name" value="<?php echo $service_names; ?>">
        <input type="hidden" name="item_number" value="<?php echo $booking_id;?>">
        <input type="hidden" name="amount" value="<?php echo $prices; ?>">
        <input type="hidden" name="currency_code" value="<?php echo $currency; ?>">
	
        <input type="submit" name="submit" value="Pay Now" class="paynow radiusoff">
     
    
    </form>
	
	<?php } ?>
	
	
	
	
	
	<?php if($payment_mode=="wallet"){
		
	$current_user = DB::table('users')->where('id','=',Auth::user()->id)->get();
		
		$wallet_balance = $current_user[0]->wallet;

       if($wallet_balance < $prices)
	   {		   
		?>
		<br/><br/>
	   <a href="javascript:void(0);" onclick="alert('Insufficient your wallet balance amount - <?php echo $wallet_balance.' '.$currency;?>. please try to other payment mode');" class="paynow radiusoff" style="color:#fff; text-decoration:none;">Pay Now</a>
	
	   <?php } else { ?>
	<form class="form-horizontal" role="form" method="POST" action="{{ route('payment') }}" id="formID" enctype="multipart/form-data">
   {{ csrf_field() }}
   <input type="hidden" name="item_name" value="<?php echo $service_names; ?>">
        <input type="hidden" name="item_number" value="<?php echo $booking_id;?>">
        <input type="hidden" name="amount" value="<?php echo $prices; ?>">
        <input type="hidden" name="currency_code" value="<?php echo $currency; ?>">
		
		<input type="hidden" name="wallet_balance" value="<?php echo $wallet_balance; ?>">
		
		
        <input type="submit" name="submit" value="Pay Now" class="paynow radiusoff">
     
    
    </form>
	
	   <?php } ?>
	<?php } ?>
	
	<?php if($payment_mode=="paypal"){?>
    <form action="<?php echo $paypal_url; ?>" method="post">

        <!-- Identify your business so that you can collect the payments. -->
        <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
        
        <!-- Specify a Buy Now button. -->
        <input type="hidden" name="cmd" value="_xclick">
        
        <!-- Specify details about the item that buyers will purchase. -->
        <input type="hidden" name="item_name" value="<?php echo $service_names; ?>">
        <input type="hidden" name="item_number" value="<?php echo $booking_id;?>">
        <input type="hidden" name="amount" value="<?php echo $prices; ?>">
        <input type="hidden" name="currency_code" value="<?php echo $currency; ?>">
        
        <!-- Specify URLs -->
        <input type='hidden' name='cancel_return' value='<?php echo $url;?>/cancel'>
		<input type='hidden' name='return' value='<?php echo $url;?>/success/<?php echo $booking_id;?>'>
		<input type="submit" name="submit" value="Pay Now" class="paynow radiusoff">
     
    
    </form>
    <?php } if($payment_mode=="stripe"){
		$fprice = $prices * 100;
		?>
	<form action="{{ route('stripe-success') }}" method="POST">
	{{ csrf_field() }}
	
	<input type="hidden" name="cid" value="<?php echo $booking_id;?>">
	<input type="hidden" name="amount" value="<?php echo $fprice; ?>">
	<input type="hidden" name="currency_code" value="<?php echo $currency; ?>">
	<input type="hidden" name="item_name" value="<?php echo $service_names; ?>">
		<script src="https://checkout.stripe.com/checkout.js" 
		class="stripe-button" 
		<?php if($setts[0]->stripe_mode=="test") { ?>
		data-key="<?php echo $setts[0]->test_publish_key; ?>" <?php } ?>
		<?php if($setts[0]->stripe_mode=="live") {  ?>
		data-key="<?php echo $setts[0]->live_publish_key; ?>" 
		<?php }?> 
		data-image="<?php echo $url.'/local/images/settings/'.$setts[0]->site_logo;?>" 
		data-name="<?php echo $service_names; ?>" 
		data-description="<?php echo $setts[0]->site_name;?>"
		data-amount="<?php echo $fprice; ?>"
		data-currency="<?php echo $currency; ?>"
		/>
		</script>
	</form>
	<?php } ?>
	
	<?php  if($payment_mode=="payumoney"){
		if($setts[0]->payu_mode=='live'){ $action = 'https://secure.payu.in/_payment'; } 
		if($setts[0]->payu_mode=='test'){ $action = 'https://test.payu.in/_payment'; }
		$merchant = $setts[0]->merchant_key;
		$salt = $setts[0]->salt_id;
		$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		$email = Auth::user()->email;
        $name = Auth::user()->name;
		$phone = Auth::user()->phone;
$hash_string = $merchant."|".$txnid."|".$prices."|".$service_names."|".$name."|".$email."|||||||||||".$salt;
$hash = strtolower(hash('sha512', $hash_string));
		$success_url = $url.'/payu_success/'.$booking_id.'/'.$txnid;
		$fail_url = $url.'/payu_failed/'.$booking_id;
		?>
	
	<form action="<?php echo $action; ?>" method="post" name="payuForm" id="payuForm">
	{{ csrf_field() }}
	<input type="hidden" name="cid" value="<?php echo $booking_id;?>">
    <input type="hidden" name="key" value="<?php echo $merchant ?>" />
    <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
    <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
    <input name="amount" type="hidden" value="<?php echo $prices; ?>" />
    <input type="hidden" name="firstname" id="firstname" value="<?php echo $name; ?>" />
    <input type="hidden" name="email" id="email" value="<?php echo $email; ?>" />
    <input type="hidden" name="phone" value="<?php echo $phone; ?>" />
    <input type="hidden" name="productinfo" value="<?php echo $service_names; ?>">
    <input type="hidden" name="surl" value="<?php echo $success_url; ?>" />
    <input type="hidden" name="furl" value="<?php echo  $fail_url?>"/>
    <input type="hidden" name="service_provider" value=""/>
    <input type="submit" name="submit" value="Pay Now" class="paynow radiusoff">
</form>
	
	<?php } ?>
	</div>
	
	
	
	
	
	
	</div>
	
	</div>
	</div>
	
	
	

      <div class="clearfix"></div>
	   <div class="clearfix"></div>

      @include('footer')
</body>
</html>
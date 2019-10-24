<!DOCTYPE html>
<html lang="en">

<head>


   @include('style')
	




</head>
<body style="background:#000000">

    

    <!-- fixed navigation bar -->
    @include('header')

    <!-- slider -->
    
	<?php $bookArr = explode("," , $booking[0]->booking_days_dates); $bookTotalAmt = $booking[0]->total_amt; ?>
	
	
	<div class="headerbg">
	 <div class="col-md-12" align="center" style="margin-top:100px"><h1>Booking Details</h1></div><br>
	 </div>
	
	<div class="container" style="background:black">
	<div class="clearfix" style="height:60px"></div>
	
	
	

	<div class="col-md-6">
		<h4><?php echo $shop[0]->shop_name;?></h4>
		
				
			<p><i class="fa fa-calendar-o" aria-hidden="true"></i> Booking Dates (Day-Month-Year) :</br> @foreach($bookArr as $val) 
			</br>{{$val}}
			@endforeach 
			</p>

			<p style="display:none"> <i class="fa fa-clock-o" aria-hidden="true"></i>  Booking Time - <?php echo $final_time; ?></p>
		
	</div>
	
	
	<div class="col-md-6 service_style">
	
	 <table class="table table-bordered" id="dataTables-example" style="background:black">
            <thead>
                <tr>
                    <th>Selected Services</th>
					<th>Price (1 day)</th>
					 <th>Trust Fee</th>
					 <th>Services Tax</th>
					<th>Selected Days</th>
                </tr>
            </thead>
			<tbody>			
			<tr>
			
				<td><?php echo $ser_name;?></td>
				<td><?php echo $price; ?></td>
				<?php if($commission_mode=="percentage"){ $symbol = "%"; } else if($commission_mode == "fixed") { $symbol = ' '.$currency; }?>
				<td> 
				<?php echo $commission_amt.$symbol; ?> 
				</td>
				
				<td><?php echo $taxer.'%'; ?></td>
				<td><?php echo $selectedDays ?></td>
<?php //echo $tax_price;?>
<?php //echo $get_tax;


$total_sum = $sum + $get_tax; 

?>
			</tr>
			<td class="total-charge" colspan="1">TOTAL CHARGES</td><td class="total-charge"><?php echo $total_sum;?>&nbsp;<?php echo $currency;?></td><td></td><td></td><td class="total-charge"><?php echo $total_sum * $selectedDays;?>&nbsp;<?php echo $currency;?>
			</tbody>
															
            </table>
			
	</div>
	
	</div>
	<?php /*$enc = Crypt::encryptString($sum);
	$decrypted = Crypt::decryptString($enc);
	
	$admin_enc = Crypt::encryptString($admin_email);*/
	// echo $enc;
	?>
	<form class="" name="admin_s" id="formID" method="post" enctype="multipart/form-data" action="{{ route('booking_info') }}">
	{!! csrf_field() !!}
	<div class="container" style="background:black">
<div class="col-md-8"></div>

<div class="col-md-4">
<input type="hidden" name="price" value="<?php echo $total_sum * $selectedDays;?>">

<input type="hidden" name="admin_amt" value="<?php echo $admin_amt * $selectedDays;?>">

<input type="hidden" name="tax_amt" value="<?php echo $get_tax * $selectedDays;?>">

<input type="hidden" name="service_amt" value="<?php echo $tax_price * $selectedDays;?>">

<input type="hidden" name="currency" value="<?php echo $currency;?>">

<input type="hidden" name="bookTotalAmt" value="<?php echo $bookTotalAmt;?>">



<input type="hidden" name="admin_email" value="<?php echo $adminemail;?>">

<input type="hidden" name="user_email" value="<?php echo $useremail;?>">

<input type="hidden" name="usernamer" value="<?php echo $usernamer;?>">

<input type="hidden" name="userphone" value="<?php echo $userphone;?>">


<input type="hidden" name="seller_email" value="<?php echo $selleremail;?>">

<input type="hidden" name="shop_name" value="<?php echo $shopname;?>">

<input type="hidden" name="shop_phone_no" value="<?php echo $shopphoneno;?>">

<input type="hidden" name="service_name" value="<?php echo $ser_name;?>">

<input type="hidden" name="booking_date" value="<?php echo $booking[0]->booking_date;?>">

<input type="hidden" name="booking_days_dates" value="<?php echo $booking[0]->booking_days_dates;?>">



<button type="submit" value="PROCEED TO CHECKOUT" class="booknow right">PROCEED TO CHECKOUT</button>


</div>
</div>
	</form>
	
	

      <div class="clearfix"></div>
	   <div class="clearfix"></div>

      @include('footer')
</body>
</html>
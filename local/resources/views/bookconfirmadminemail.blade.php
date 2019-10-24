<!DOCTYPE html>
<html lang="en">
<head>

    <title>Booking Confirmed</title>

  
	




</head>
<body>

   

    
    

	
    
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<div class="container">
	 <h1><?php echo $site_name;?> - Booking has been confirmed</h1>
<p> Selected Rhino will be at the mentioned address</p>
	 
	 
	
	 
	 
	 <div class="clearfix"></div>
	 
	 <div class="row profile shop">
		<div class="col-md-6">
	 
	 
	
	<div id="outer" style="width: 100%;margin: 0 auto;background-color:#cccccc; padding:10px;">  
	
	
	<div id="inner" style="width: 80%;margin: 0 auto;background-color: #fff;font-family: Open Sans,Arial,sans-serif;font-size: 13px;
	font-weight: normal;line-height: 1.4em;color: #444;margin-top: 10px; padding:10px;">
			<?php if(!empty($site_logo)){?>
			<div align="center"><img src="<?php echo $site_logo;?>" border="0" alt="logo" /></div>
			<?php } else { ?>
			<div align="center"><h2><?php echo $site_name;?></h2></div>
			<?php } ?>
			
			<h3> Booking Details</h3>
			<p> Booking Id - <?php echo $booking_id;?></p>
			<p> Services Name - <?php echo $ser_name;?></p> 	
			<p> Booking Dates - <?php echo $booking_days_dates;?></p> 
			<p> Total Amount - <?php echo $total_amt.' '.$currency;?></p> 


			<h3> User Details</h3>
	<p> Name - <?php echo $name;?></p>
	<p> Email - <?php echo $email;?></p>
	<p> Phone - <?php echo $phone;?></p>

			<h3> Selected Rhino Details</h3>
	<p> Name - <?php echo $shop_name;?></p>
	<p> Email - <?php echo $seller_email;?></p>
	<p> Phone - <?php echo $shop_phone_no;?></p>	
					
			
	
	
	
	
	</div>
	</div>
	 
	 
	 
	
	 
	 
	
	
	
	
	 
	 
	 
	 
	 
	 <div class="height30"></div>
	 <div class="row">
	
	
	
	
	
	</div>
	
	</div>
	

      
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Withdrawal Request</title>

  
	




</head>
<body>

   

    
    

	
    
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<div class="container">
	 <h1><?php echo $site_name;?> - Withdrawal Request</h1>
	 
	 
	
	 
	 
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
			
			<h3> Withdrawal Request</h3>
			<p> Username - <?php echo $username;?></p> 
			<p> Withdraw Amount - <?php echo $w_withdraw_amt;?></p>
			<p> Withdraw Mode - <?php echo $w_withdraw_mode;?></p> 	
			<?php if(!empty($w_paypal_id)){?><p> Paypal Id - <?php echo $w_paypal_id;?></p> <?php } ?>
            <?php if(!empty($w_stripe_id)){?><p> Stripe Email Id - <?php echo $w_stripe_id;?></p> <?php } ?>
			<?php if(!empty($w_payumoney)){?><p> Payumoney Email Id - <?php echo $w_payumoney;?></p> <?php } ?>					
			<?php if(!empty($w_bank_acc_no)){?>
			<p> Bank Account No - <?php echo $w_bank_acc_no;?></p> 
			<p> Bank Details - <?php echo $w_bank_info;?></p> 				
			<p> IFSC Code - <?php echo $w_ifsc_code;?></p>
            <?php } ?>			
	        	
	        
	
	
	</div>
	</div>
	 
	 
	 
	
	 
	 
	
	
	
	
	 
	 
	 
	 
	 
	 <div class="height30"></div>
	 <div class="row">
	
	
	
	
	
	</div>
	
	</div>
	

      
</body>
</html>
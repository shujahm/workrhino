<!DOCTYPE html>
<html lang="en">
  <head>
   
   @include('admin.title')
    
    @include('admin.style')
    <?php

$logid = Auth::user()->id;

$user_checkker = DB::select('select * from users where id = ?',[$logid]);

$hidden = explode(',',$user_checkker[0]->show_menu);

$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
   ?> 
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            @include('admin.sitename');

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            @include('admin.welcomeuser')
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            @include('admin.menu')
			
			
			
			
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
       @include('admin.top')
		
		<?php $url = URL::to("/"); ?>
		
		
        <!-- /top navigation -->
<?php  if (in_array(6, $hidden)){?>
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
         
		 
		 
		 
		 
		 
		 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel padding15">
                  <div class="x_title">
                    <h2>Service Orders</h2>
                    <ul class="nav navbar-right panel_toolbox">
                     
                       <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
					
                  </div>
				  
                  <div class="x_content">
                   
					
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sno</th>
						  
                         
                          <th>Service Title</th>
						  <th>Username</th>
						  
						  <th>Reference Id</th>
						  <th>Price</th>
						  
						  <th>Processing Fee</th>
						  
						  <th>Vendor Amount</th>
						  
						  <th>Admin Commission</th>
						  
						  <th>Affiliate Commission</th>
						  
						  
						  
						  <th>Coupon code & Discount </th>
						  
						  <th>Txn Id</th>
						  <th>Payment Type</th>
						  
						  
						  
						  <th >Date</th>
						  <th>Payment Status</th>
						  <th>Action</th>
						  <th>Bank Info</th>
						  
						  
						  <th>Service Status</th>
						  
						  <th>Payment Approval?</th>
						  
                          
						  
						  
                          
                        </tr>
                      </thead>
                      <tbody>
					  
    
						<?php if(!empty($orders_count)){?>
						<?php 
						$i=1;
						foreach($orders as $order){
						$users = DB::table('users')
		         ->where('id', '=', $order->user_id)
		        
				 ->get();	
							
					$user_cnt = DB::table('users')
		         ->where('id', '=', $order->user_id)
		        
				 ->count();	

                   $gig_details = DB::table('gigs')
		         ->where('gid', '=', $order->gid)
				
				 ->get();


                       
				 


                 if($gig_details[0]->job_type!="request")
				 {				 
							?>
                        <tr>
						 <td><?php echo $i;?></td>
						 
                          
                          
						  <td><?php echo $gig_details[0]->subject;?></td>
						  
						  <td><?php if(!empty($user_cnt)){ echo $users[0]->name; }?></td>
						  
						  
						 <td><?php echo $order->reference_id;?></td>
						  
						  
						  
						  <td>
						  
						  <?php echo $site_setting[0]->site_currency.' '.$order->price;?>
						  </td>
						  
						  
						  <td>
						  
						  <?php echo $site_setting[0]->site_currency.' '.$order->processing_fee;?>
						  </td>
						  
						  
						  <?php
						  
						  $get_user = DB::table('users')
										->where('id', '=', $order->affiliate_id)
										
										 ->count();
										 
						  if(!empty($get_user))
						  {
							  $get_user_details = DB::table('users')
										          ->where('id', '=', $order->affiliate_id)
										
										          ->get();
												  
					          $usernames = " - ( ". $get_user_details[0]->name." )";							  
												  
						  }
                          else
						  {
							  $usernames = "";
						  }							  
						  ?>
						  
						  
						  <td><?php echo $site_setting[0]->site_currency;?> <?php echo $order->seller_price;?></td>
						   
						   <td><?php echo $site_setting[0]->site_currency;?> <?php echo $order->admin_price;?></td>
						   
						   <td><?php if(!empty($order->affiliate_price)){?><?php echo $site_setting[0]->site_currency;?> <?php echo $order->affiliate_price;?> <?php echo $usernames;?><?php } ?> </td>
						  
						  
						  
						  <td><?php if(!empty($order->coupon_commission)){?><?php echo $site_setting[0]->site_currency;?> <?php echo $order->coupon_commission;?> (<?php echo $order->coupon_code;?>)<?php } ?></td>
						  
						  
						  <td><?php echo $order->paypal_token;?></td>
						  
						   <td><?php echo $order->payment_type;?></td>
						   
						   
						  
						  <td><?php echo $order->payment_date;?></td>
						  
						  <?php if($order->status=="processing"){ $clr = "#FF6307"; } 
						  else if($order->status=="completed") { $clr = "#64A207"; }
                          ?>						  
						  
						  
						  <td style="color:<?php echo $clr;?>;"><?php echo $order->status;?></td>
						  
						  
						  
						  <td>
						  
						  
						  <?php if(config('global.demosite')=="yes"){
							  if($order->upcoming_payment==0){
							  ?>
						  <span class="disabletxt"> ( <?php echo config('global.demotxt');?> )</span>
						  
						  
							  <?php } } else {
								  
								  if($order->upcoming_payment==0){
									  if($order->status=="processing")
									  {
									  
								  ?>
						  <a href="<?php echo $url;?>/admin/orders/<?php echo $order->id;?>/1" style="color:blue;">THEN CLICK HERE AND THE ORDER WILL BE CREATED </a><br/>
						  OR<br/>
						  <a href="<?php echo $url;?>/admin/orders/<?php echo $order->id;?>" style="color:blue;" onclick="return confirm('Are you sure you want to delete this?')">CLICK HERE TO DELETE</a>
									  <?php } } else {?>
                                 <div style="background:green; color:#fff; width:120px; padding:5px; text-align:center">ORDER CREATED</div>

                                 
								 <?php  } } ?>
						  </td>
						  
						  
						  <td><?php echo $order->additional_info;?></td>
						  
						  
						  
						  <?php
						  if($order->payment_level==1 or $order->payment_level==0)
						  {
							  $status_paymentt = "processing";
							  $clrs = "#FF6307";
							  
						  }
						  if($order->payment_level==2)
						  {
							  $status_paymentt = "Completed";
							  
							  $clrs = "#2AB100";
							  
						  }
						  if($order->payment_level==3)
						  {
							  $status_paymentt = "Delivered";
							  $clrs = "#2AB100";
							 
						  }
						  if($order->payment_level==4)
						  {
							 $status_paymentt = "Cancelled";
							  $clrs = "#FA1E0C";
							  
						  }
						  if($order->payment_level==5)
						  {
							 $status_paymentt = "Closed";
							  $clrs = "#2AB100";
							  
						  }
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  if($order->payment_level==1 or $order->payment_level==0)
						  {
							  
							  $approval_status = "Awaiting for service completion";
						  }
						  if($order->payment_level==2)
						  {
							  
							  $approval_status = "Awaiting for maximum withdraw time (".$setts[0]->day_before_withdraw." days)";
						  }
						  if($order->payment_level==2 && $order->awaiting==1)
						  {
							  
							  $approval_status = "
							  <a href=".$url."/admin/orders/status/".$order->id."/".$order->gig_user_id." class='btn btn-success' title='It will credit the payment to seller account'>Approve Payment</a>";
							  
						  }
						  if($order->payment_level==3 && $order->awaiting==1)
						  {
							
							  $approval_status = "Approved Payment";
						  }
						  
						  if($order->payment_level==4)
						  {
							 $approval_status = "Job Cancelled";
							  
						  }
						  
						  
						  if($order->payment_level==5)
						  {
							
							  $approval_status = "Payment sent to seller";
						  }
						  
						  
						  
						  
						  
						  
						  
						  
						  ?>
						  
						  <td style="color:<?php echo $clrs;?>;"><?php echo $status_paymentt;?></td>
						  
						  
						  
						  
						  
						  
						  
						  <td>
						  
						  
						  
						  <?php /*?><?php if($order->payment_level==2 && $order->awaiting==1){?>
							<a href="<?php echo $url;?>/admin/orders/status/<?php echo $order->id;?>/<?php echo $order->gig_user_id;?>" class="btn btn-success">Mark as 'Yes'</a>
                          <?php } else {?><?php } ?>
        			      <?php */?>
                           
                          <?php echo $approval_status;?>						   
                          						  
						  
						  </td>
						  
						  
						  
						  
						  
						  
                        </tr>
				 <?php } ?>
						<?php $i++; } ?>
                        <?php } ?>
						
						
                       
                      </tbody>
                    </table>
					
					
                  </div>
                
              </div>
			  
			  
			  
		 
		  
		  
		  
        </div>
        <!-- /page content -->

      
      </div>
    </div>
<?php } else { ?>
	  
	  
	 @include('admin.permission')
	  
		<?php } ?>
	  
	  
	  
	 
	 @include('admin.footer')
    
	
  </body>
</html>

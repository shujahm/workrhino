<!DOCTYPE html>
<html lang="en">
  <head>
   
   @include('admin.title')
    
    @include('admin.style')
    
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
		
		<?php $url = URL::to("/"); 
		
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		?>
		
		
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
         
		 
		 
		 
		 
		 
		 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel padding15">
                  <div class="x_title">
                    <h2>Job Orders</h2>
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
						  
                         
                          <th>Job Title</th>
						  <th>Username</th>
						  
						  <th>Reference Id</th>
						  <th>Price</th>
						  <th>Txn Id</th>
						  <th>Payment Type</th>
						  
						  <th >Date</th>
						  <th>Payment Status</th>
						  <th>Action</th>
						  <th>Bank Info</th>
						  
						  
						  <th>Job Status</th>
						  
						  <!--<th>Payment Approval?</th>-->
						  
                          
						  
						  
                          
                        </tr>
                      </thead>
                      <tbody>
					      
    
						<?php if(!empty($orders_count)){?>
						<?php 
						$i=1;
						foreach($orders as $order){
							
							
					$user_cnt = DB::table('users')
		         ->where('id', '=', $order->user_id)
		        
				 ->count();	
				 
				 if(!empty($user_cnt))
				 {
					 $users = DB::table('users')
		         ->where('id', '=', $order->user_id)
		        
				 ->get();
				 }
				 
				  $gig_cc = DB::table('gigs')
		         ->where('gid', '=', $order->gid)
				
				 ->count();
                 if(!empty($gig_cc))
				 {
                   $gig_details = DB::table('gigs')
		         ->where('gid', '=', $order->gid)
				
				 ->get();	

                   if($gig_details[0]->job_type=="request")
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
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						  
						 
						  
						  
						  
						  
						  
						  
						  ?>
						  
						  <td style="color:<?php echo $clrs;?>;"><?php echo $status_paymentt;?></td>
						  
						  
						  
						  
						  
						  
						  
						 
						  
						  
						  
						  
						  
						  
                        </tr>
				 <?php } } ?>
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

	  
	  
	  
	 
	 @include('admin.footer')
    
	
  </body>
</html>

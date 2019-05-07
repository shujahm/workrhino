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
		
		<?php $url = URL::to("/"); ?>
		
		
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
         
		 
		 
		 
		 
		 
		 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Dispute</h2>
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
						  
                          <th>Booking Id</th>
                          
                          <th>Booking Date</th>
						  
						  <th>Customer Name</th>
						  
						  <th>Vendor Name</th>
						  
						  <th>Payment</th>
						  
						  <th>Subject</th>
						  
						  <th>Message</th>
						  
						  <th>Status</th>
						  
						  <th>Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
					  <?php 
					  if(!empty($dispute))
					  {
						  
					$disputte = DB::table('dispute')->orderBy('dispute_id','desc')->get();	  
					  $i=1;
					  foreach ($disputte as $disputes) { ?>
    
						
                        <tr>
						 <td><?php echo $i;?></td>
						
                          <td><?php echo $disputes->booking_id;?></td>
                          
						  <td><?php echo $disputes->booking_date;?></td>
						  
						  <td><?php echo $disputes->customer_name;?> ( ID : <?php echo $disputes->customer_id;?> )</td>
						  
						  <td><?php echo $disputes->vendor_name;?> ( ID : <?php echo $disputes->vendor_id;?> )</td>
						  
						  <td><?php echo $disputes->payment;?> <?php echo $setting[0]->site_currency;?></td>
						  
						  <td><?php echo $disputes->subject;?></td>
						  
						  <td><?php echo $disputes->message;?></td>
						  <?php if(empty($disputes->status)){ $crl = "#FF9005"; $stat = "Awaiting for admin action"; } else { $crl = "#0E980E"; $stat = $disputes->status; }?>
						  
						  <td style="color:<?php echo $crl;?>;"><?php echo $stat;?></td>
						  
						  
						  <td>
						  <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-success btndisable">Refund to customer</a> <a href="#" class="btn btn-success btndisable">Release to vendor</a> <a href="#" class="btn btn-primary btndisable">Message to vendor</a> <a href="#" class="btn btn-primary btndisable">Message to customer</a> <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { if(empty($disputes->status)){?>
				  <a href="<?php echo $url;?>/admin/dispute/<?php echo $disputes->customer_id;?>/<?php echo $disputes->vendor_id;?>/<?php echo $disputes->booking_id;?>" class="btn btn-success">Refund to customer</a> <a href="<?php echo $url;?>/admin/dispute/<?php echo $disputes->customer_id;?>/<?php echo $disputes->vendor_id;?>/<?php echo $disputes->booking_id;?>/<?php echo $disputes->payment;?>" class="btn btn-success">Release to vendor</a><?php } ?> <a href="<?php echo $url;?>/send-message/1/<?php echo $disputes->vendor_id;?>" class="btn btn-primary" target="blank">Message to vendor</a> <a href="<?php echo $url;?>/send-message/1/<?php echo $disputes->customer_id;?>" class="btn btn-primary" target="_blank">Message to customer</a>
				  <?php } ?>
						  </td>
                        </tr>
					  <?php $i++;} } ?>
                       
                      </tbody>
                    </table>
					
					
                  </div>
                </div>
              </div>
			  
			  
			  
		 
		  
		  
		  
        </div>
        <!-- /page content -->

      @include('admin.footer')
      </div>
    </div>

    
	
  </body>
</html>

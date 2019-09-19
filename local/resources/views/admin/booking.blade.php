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
                    <h2>Booking History</h2>
                    <ul class="nav navbar-right panel_toolbox">
                     
                       <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
					
                  </div>
				  <div style="height:20px;"></div>
				  <div align="right">
				  <label style="display:inline-block; font-weight:bold;">Payment Status : </label>
				  <div id="colvis" style="display:inline-block;"></div>
				  </div>
				 
                  <div class="x_content">
                   
					
                    <table id="datatable-responsivee" class="table table-striped table-bordered dt-responsive nowrap bookingtable" cellspacing="0" width="100%">
					
					
					
					
					
					
                      <thead>
                        <tr>
                          <th>Sno</th>
						  <th>Order Id</th>
						  
						  <th>Shop Name</th>
                          <th>Service Name</th>
                          <th>Booking Date</th>
						  
						  <th>Booking Time</th>
						  <th>User Phone No</th>
						  <th>Username</th>
                          <th>Email</th>
						  
						  <th>Address</th>
						  <th>City</th>
						  <th>Pincode</th>
						  
						  <th>Booking Note</th>
						  
						  <th>Vendor Amount</th>
						  <th>Admin Amount</th>
						  <th>Payment Mode</th>
						  
						  <th>Txn Id</th>
						   <th>Payment Status</th>
						   
						   <th>Cancel Status</th>
						   
						   <th>Service Status</th>
						   
						   <th>Dispute Status</th>
						  
						  <?php /* ?><th>Action</th><?php */?>
                          
                        </tr>
                      </thead>
					  
					  
					  
					  
                      <tbody>
					  <?php 
					  $sno=0;
					  foreach ($booking as $viewbook) {
						  
						  
						  
						  $sno++;
					$booking_time=$viewbook->booking_time;
							if($booking_time>12)
							{
								$final_time=$booking_time-12;
								$final_time=$final_time."PM";
							}
							else
							{
								$final_time=$booking_time."AM";
							}


					$ser_id=$viewbook->services_id;
			$sel=explode("," , $ser_id);
			$lev=count($sel);
			$ser_name="";
			$sum="";
			$price="";		
		for($i=0;$i<$lev;$i++)
			{
				$id=$sel[$i];	
                
				
				$fet1_cnt = DB::table('subservices')
								 ->where('subid', '=', $id)
								 ->count();
				
				if(!empty($fet1_cnt))
				{
				$fet1 = DB::table('subservices')
								 ->where('subid', '=', $id)
								 ->get();
				$ser_name.=$fet1[0]->subname.'<br>';
				$ser_name.=",";				 
				
				
				
				$ser_name=trim($ser_name,",");
				}
				else
				{
					$ser_name = "";
				}
				
			}		
			
			$bookid= $viewbook->book_id;
			$newbook = DB::table('booking')
								 ->where('book_id', '=', $bookid)
								 ->get();

					  ?>
    
						
                        <tr>
						 <td><?php echo $sno; ?></td>
						 <td><?php echo $viewbook->book_id;?></td>
						 
						 <?php if($viewbook->payment_mode=="paypal"){ $txt_id = $viewbook->paypal_token; }
						 else if($viewbook->payment_mode=="stripe"){ $txt_id = $viewbook->stripe_token; }
						 else if($viewbook->payment_mode=="payumoney"){ $txt_id = $viewbook->payu_token; }
						 else { $txt_id = ""; }
						 
						 
						 ?>
						 
						 
                          <td><?php echo $viewbook->shop_name;?></td>
                          
						  <td><?php echo $ser_name;?></td>
						  
						   <td><?php echo $viewbook->booking_date;?></td>
						   
						   
						   
						   
						   <td><?php echo $final_time;?></td>
						   
						   <td><?php echo $viewbook->phone;?></td>
						   
						   <td><?php echo $viewbook->name;?></td>
						   
						   <td><?php echo $viewbook->user_email;?></td>
						   
						   
						   <td><?php echo $viewbook->booking_address;?></td>
						   
						   <td><?php echo $viewbook->booking_city;?></td>
						   
						   <td><?php echo $viewbook->booking_pincode;?></td>
						   
						   <td><?php echo $viewbook->booking_note;?></td>
						   
						   
						   <td><?php echo $viewbook->total_amt - $viewbook->admin_commission.' '.$setting[0]->site_currency;?></td>
						   
						   <td><?php echo $viewbook->admin_commission.' '.$setting[0]->site_currency;?></td>
						   
						   <td><?php echo $viewbook->payment_mode;?></td>
						   
						   <td>
						 <?php echo $txt_id;?>
						 </td>
						   
						   <?php if($newbook[0]->status=="pending"){ $color="#FB6704"; } else if($newbook[0]->status=="paid")  { $color="#0DE50D"; } else if($newbook[0]->status=="refund")  { $color="#3928D9"; } else{ $color="#3928D9"; }?> 
						   <td style="color:<?php echo $color;?>;"><?php echo $newbook[0]->status;?></td>
						  
						  
						  
						  <td><?php echo $newbook[0]->reject;?></td>
						  
						  <td>
						  <?php if(empty($newbook[0]->reject)){?>
						 <?php if($newbook[0]->service_complete==0){?>Awaiting completion<?php } ?> <?php if($newbook[0]->service_complete==1){?>Completed<?php } ?> <?php if($newbook[0]->service_complete==2){?>Released the payment<?php } } ?>
						  </td>
						  
						  
						  
						  <?php 
				$dispwives = DB::table('dispute')
              
			               ->where('booking_id', '=', $newbook[0]->book_id)
			               
                           ->count();
				if(!empty($dispwives))
				{
					$disp_view = DB::table('dispute')
              
			               ->where('booking_id', '=', $newbook[0]->book_id)
			               
                           ->get();
					if($disp_view[0]->status=="")
					{ 
				      $viewstatus = "Awaiting for admin action";
					}
                    else
					{
						$viewstatus = $disp_view[0]->status;
					}						
					
				}
				else
				{
					$viewstatus = "";
				}
				?>
						  
						  <td>
						  <?php echo $viewstatus;?>
						  </td>
						  
						  <?php /* ?><td>
					<?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="btn btn-danger btndisable">Delete</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>	  
						 <a href="<?php echo $url;?>/admin/booking/{{ $viewbook->book_id }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">Delete</a>
				  <?php } ?>
						  
						  </td><?php */?>
                        </tr>
                        <?php } ?>
                       
                      </tbody>
                    </table>
					
					
                  </div>
                </div>
              </div>
			  
			  
			  
		 
		  
		  
		  
        </div>
        <!-- /page content -->

      @include('admin.footer')
	  
	  <script type="text/javascript">
	  
	  
	  var lastCat = 'the category';
      var table = $('#datatable-responsivee').DataTable({
    
    initComplete: function () {
        this.api().columns('15').every( function () {
            var column = this;
            var select = $('<select><option value="">All Status</option></select>')
                .appendTo( "#colvis" )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );
                    column.search( val ? '^'+val+'$' : '', true, false ).draw();
                } );
 
            column.data().unique().sort().each( function ( d, j ) {
                if(lastCat === d) {
                    select.append( '<option SELECTED value="'+d+'">'+d+'</option>' )
                } else {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                }
            } );
           
        } );
    }
});
	   
	  
	  
	  
</script>
      </div>
    </div>

    
	
  </body>
</html>

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
		
		
		
		<div class="col-md-3 widget1">
        		<div class="r3_counter_box">
                    <i class="fa fa-users icon-rounded"></i>
                    <div class="stats">
                      <h5><strong><?php if(!empty($total_user)){?><?php echo $total_user;?><?php } else {?>0<?php } ?></strong></h5>
                      <span>Total Users</span>
                    </div>
                </div>
        	</div>
			
			<div class="col-md-3 widget1">
        		<div class="r3_counter_box">
                    <i class=" fa fa-users icon-rounded icon1"></i>
                    <div class="stats">
                      <h5><strong><?php if(!empty($total_seller)){?><?php echo $total_seller;?><?php } else { ?>0<?php } ?></strong></h5>
                      <span>Total Registered Rhinos</span>
                    </div>
                </div>
        	</div>
			
			<div class="col-md-3 widget1">
        		<div class="r3_counter_box">
                    <i class="fa fa-users icon-rounded icon2"></i>
                    <div class="stats">
                      <h5><strong><?php if(!empty($total_customer)){?><?php echo $total_customer;?><?php } else { ?>0<?php } ?></strong></h5>
                      <span>Total Customers</span>
                    </div>
                </div>
        	</div>
			
			<div class="col-md-3 widget1">
        		<div class="r3_counter_box">
                    <i class="fa fa-book icon-rounded icon3"></i>
                    <div class="stats">
                      <h5><strong><?php if(!empty($total_booking)){?><?php echo $total_booking;?><?php } else {?>0<?php } ?></strong></h5>
                      <span>Total Booking</span>
                    </div>
                </div>
        	</div>
		
		
		<div class="col-md-3 widget1">
        		<div class="r3_counter_box">
                    <i class="fa fa-book icon-rounded icon4"></i>
                    <div class="stats">
                      <h5><strong><?php if(!empty($today_booking)){?><?php echo $today_booking;?><?php } else {?>0<?php } ?></strong></h5>
                      <span>Today Booking</span>
                    </div>
                </div>
        	</div>
			
				<div class="col-md-3 widget1">
        		<div class="r3_counter_box">
                    <i class="fa fa-shopping-cart icon-rounded icon5"></i>
                    <div class="stats">
                      <h5><strong><?php if(!empty($total_shop)){?><?php echo $total_shop;?><?php } else { ?>0<?php } ?></strong></h5>
                      <span> Total Approved Rhinos</span>
                    </div>
                </div>
        	</div>
		
		
		
		
          
          <!-- /top tiles -->

		  <div style="clear:both;"></div>
		  <div class="row whitebg">
         <h3 class="report_title">Last 7 Days Booking Report</h3>
		 
		 
		 
		 <script type="text/javascript">
	window.onload = function () {
			var dps = [
		<?php echo $javas;?>
		];
		
		var chart = new CanvasJS.Chart("chartContainer",
		{
			
			 
			title:{
				//text: "Last 7 Days Order Report",
				fontSize:20,
				titleFontFamily: "Open Sans, sans-serif"
			},
			
                        animationEnabled: true,
			axisX:{

				gridColor: "#FF99CC",
				tickColor: "#FF99CC"
				//valueFormatString: "DD/MMM"

			},                        
                        toolTip:{
                          shared:true
                        },
			theme: "theme1",
			axisY: {
				gridColor: "#FF99CC",
				tickColor: "#FF99CC"
			},
			legend:{
				verticalAlign: "center",
				horizontalAlign: "right"
			},
			data: [
			{        
				type: "area",
				showInLegend: true,
				lineThickness: 2,
				name: "Orders",
				markerType: "square",
				color: "#FF99CC",
				dataPoints: dps
			}			
			],
			axisX: {
        title: "Last 7 days",
       
	   
	   gridDashType: "dot",
			gridThickness: 1,
			
		
        gridColor: "#ccc"
	   
      },
			axisY: {
        title: "No of Booking",
        
		gridDashType: "dot",
			gridThickness: 1,
			
		
        gridColor: "#ccc"
		
		
      },
          legend:{
            cursor:"pointer",
            itemclick:function(e){
              if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
              	e.dataSeries.visible = false;
              }
              else{
                e.dataSeries.visible = true;
              }
              chart.render();
            }
          }
		});

chart.render();
}
</script>



	<div id="chartContainer" style="height: 300px; width: 100%;">
	</div>
		  
	</div>	  
		  
		  
		  
		  
		  <br/><br/>
		  
		  
		  
          <div class="row sv_dashboard">


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 padding_off">
                <div class="x_title icon1">
                  <h2>Recent Booking</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                 
                  <div class="widget_summary">
                   
				   
				   <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th>
                        <p>Name</p>
                      </th>
                      <th>
                        
                          <p>Booking Date</p>
                       </th>
					   <th>
                       
                          <p>Amount</p>
                       
                      </th>
					  
					  <th>
                       
                          <p>Status</p>
                       
                      </th>
                    </tr>
					
					<?php foreach($booking as $book){?>
					<tr height="20"></tr>
                    <tr>
                      <td>
                       <?php echo $book->name;?>
                      </td>
                      <td>
                       <?php echo $book->booking_date;?>
                      </td>
					  
					  <td>
                       <?php echo $book->total_amt.' '.$setting[0]->site_currency;?>
                      </td>
					  
					  <td>
                       <?php echo $book->status;?>
                      </td>
                    </tr>
					<?php } ?>
                  </table>
                </div>
				
                  </div>

                  
                  
                  
                 

                </div>
              </div>
            </div>

            
			
			
			<div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 padding_off">
                <div class="x_title icon2">
                  <h2>Latest Users</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                 
                  <div class="widget_summary">
                   
				   
				   <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
					<th>
                       
                          <p>Photo</p>
                       
                      </th>
					
                      <th>
                        <p>Name</p>
                      </th>
                      <th>
                        
                          <p>Phone</p>
                       </th>
					   <th>
                       
                          <p>User Type</p>
                       
                      </th>
					  
					  
                    </tr>
					
					<?php foreach($users as $user){
						$sta=$user->admin; if($sta==1){ $viewst="Admin"; } else if($sta==2) { $viewst="Seller"; } else if($sta==0) { $viewst="Customer"; }
						?>
					<tr height="10"></tr>
                    <tr>
                      <?php 
					   $userphoto="/userphoto/";
						$path ='/local/images'.$userphoto.$user->photo;
						if($user->photo!=""){
						?>
						 <td><img src="<?php echo $url.$path;?>" class="thumb" width="40"></td>
						 <?php } else { ?>
						  <td><img src="<?php echo $url.'/local/images/nophoto.jpg';?>" class="thumb" width="40"></td>
						 <?php } ?>
                      <td>
                       <?php echo $user->name;?>
                      </td>
					  
					  <td>
                      <?php echo $user->phone;?>
                      </td>
					  
					  <td>
                       <?php echo $viewst;?>
                      </td>
                    </tr>
					<?php } ?>
                  </table>
                </div>
				
                  </div>

                  
                  
                  
                 

                </div>
              </div>
            </div>

			
			

           
		   
		   
		   
		   
		   <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 padding_off">
                <div class="x_title icon3">
                  <h2>Top Testimonials</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                 
                  <div class="widget_summary">
                   
				   
				   <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
					<th style="width:25%">
                       
                          <p>Photo</p>
                       
                      </th>
					
                      <th style="width:25%">
                        <p>Name</p>
                      </th>
                      <th>
                        
                          <p>Description</p>
                       </th>
					   
					  
					  
                    </tr>
					
					<?php foreach($testimonials as $testimonial){
						?>
					<tr height="20"></tr>
                    <tr>
                      <?php 
					   $testimonialphoto="/testimonialphoto/";
						$path ='/local/images'.$testimonialphoto.$testimonial->image;
						if($testimonial->image!=""){
						?>
						 <td><img src="<?php echo $url.$path;?>" class="thumb" width="40"></td>
						 <?php } else { ?>
						  <td><img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="thumb" width="40"></td>
						 <?php } ?>
                      <td>
                       <?php echo $testimonial->name;?>
                      </td>
					  
					  <td>
                      <?php echo substr($testimonial->description,0,40);?>
                      </td>
					  
					  
                    </tr>
					<?php } ?>
                  </table>
                </div>
				
                  </div>

                  
                  
                  
                 

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

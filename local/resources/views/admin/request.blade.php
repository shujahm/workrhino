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
                <div class="x_panel padding15">
                  <div class="x_title">
                    <h2>Jobs</h2>
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
						  
                          <th>Job Name</th>
						  
						  <th>Username</th>
						  
						  <th>Category</th>
						  
						  <!--<th>Budget Type</th>-->
						  
						  <th>Estimated</th>
						  
						  <th>Skills</th>
						  
						  <th>Delivery(Days)</th>
						  
						  <th>View More</th>
                          
						  <th>Status</th>
						  
                          <th>Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
					  <?php 
					  $i=1;
					  foreach ($request as $gig) {
						  
						  $uber = DB::table('users')->where('id', '=', $gig->user_id)->get();

                     if(!empty($gig->category_type))
						  {
						  if($gig->category_type=="subcat")
						  { 
						  
						  $category = DB::table('subcategory')
									->where('subid', '=', $gig->category)
									->get();
							$category_cnt = DB::table('subcategory')
									->where('subid', '=', $gig->category)
									->count();	
									if(!empty($category_cnt))
									{
									$catname = $category[0]->subname;
									}
									else
									{
										$catname="";
									}
									
						  }
						  if($gig->category_type=="cat")
						  { 
						  
						  $category = DB::table('category')
									->where('id', '=', $gig->category)
									->get();
							$category_cnt = DB::table('category')
									->where('id', '=', $gig->category)
									->count();		
									if(!empty($category_cnt))
									{
									$catname = $category[0]->name;
									}
									else
									{
										$catname ="";
									}
						  }
						  }
						  else
						  {
							  $catname ="";
						  }
						  
						   if(!empty($gig->subcategory))
				{
					$view_category = DB::table('subcategory')
										->where('subid', '=', $gig->subcategory)
										->get();
					$namesub = $view_category[0]->subname;					
				}
				else
				{
					$namesub = "";
				}
						  
					  ?>
    
						
                        <tr>
						 <td><?php echo $i;?></td>
						
                          <td><?php echo $gig->subject;?></td>
						  
						  <td><?php echo $uber[0]->name;?></td>
						  
                           <td><?php echo $catname;?><?php if(!empty($namesub)){?>, <?php echo $namesub;?><?php } ?></td>
						   
						   <?php if($gig->budget_type=="fixed"){ 
						   $bud_txt = "Fixed Price"; 
						     if($gig->fixed_price=="custom_budget")
							 {
								$estim = $gig->minimum_budget.' - '.$gig->maximum_budget.' '.$site_setting[0]->site_currency;
							 }
							 else
							 {
								 $estim = $gig->fixed_price;
							 }
						   } 
						   else if($gig->budget_type=="hour"){ 
						   $bud_txt = "Hourly Price"; 
						   
						   if($gig->hour_price=="custom_budget")
							 {
								$estim = $gig->minimum_budget.' - '.$gig->maximum_budget.' '.$site_setting[0]->site_currency;
							 }
							 else
							 {
								 $estim = $gig->hour_price;
							 }
						   
						   
						   } ?>
						   
						   <?php /* ?><td><?php echo $bud_txt;?></td><?php */ ?>
						   
						   <td><?php echo $estim;?>
						   
						   <?php
						   $tag = $gig->request_skills;
								$viewtag = explode(',', $tag);
								$par = "";
								foreach($viewtag as $tags)
								{
									$count_cnt = DB::table('skills')
									->where('id', '=', $tags)
									->count();
									if(!empty($count_cnt))
									{
									$view_key = DB::table('skills')
									->where('id', '=', $tags)
									->get();
							        
									$par .=$view_key[0]->skill.',';
									}
									else
									{
										$par .= "";
									}
									
								}
                             $topar = rtrim($par,',');								
						   ?>
						   
						   <td><?php echo $topar;?></td>
						  
						  <td><?php echo $gig->complete_days;?></td>
						  
						  
						  <?php if($gig->status==1){ $status_txt = "Activate"; $clrs="green"; $btn_class = "btn btn-success"; $sid = 0; } 
						  else { $status_txt = "Deactivate"; $btn_class = "btn btn-danger"; $sid = 1; $clrs="red"; } ?>
						  
						  
						  <td>
						 <a href="<?php echo $url;?>/admin/view_request/{{ $gig->gid }}" class="btn btn-success">View More</a>
						 </td>
						  
						  <td style="color:<?php echo $clrs;?>; font-weight:bold;">
						  
						  
						  
						  
						  <?php echo $status_txt;?>
				         
				  
				         </td>
						 
						 
						 
						 
						  
						  <td>
						  
						  
						  <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-success btndisable">Activate</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
						  <?php } else {?> <a href="<?php echo $url;?>/admin/request/status/1/{{ $gig->gid }}" class="btn btn-success">Activate</a> 
						  <?php } ?>
						  
						  
						  <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-success btndisable">Deactivate</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
						  <?php } else {?> <a href="<?php echo $url;?>/admin/request/status/0/{{ $gig->gid }}" class="btn btn-success">Deactivate</a>
						  <?php } ?>
						  
						  
						  
						  
						  <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="btn btn-danger btndisable">Delete</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/request/{{ $gig->gid }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">Delete</a> 
						  
				  <?php } ?>
						  </td>
                        </tr>
                        <?php $i++;} ?>
                       
                      </tbody>
                    </table>
					
					
                  </div>
                </div>
              </div>
			  
			  
			  
		 
		  
		  
		  
        </div>
        <!-- /page content -->

      
      </div>
    </div>

	  
	  
	 
	 @include('admin.footer')
    
	
  </body>
</html>

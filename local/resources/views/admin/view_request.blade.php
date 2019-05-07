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
		
		
		
		
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
         
		 
		 
		 <?php $url = URL::to("/"); ?>
					  
		 
		 
		 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                  
 	@if(Session::has('success'))

	    <div class="alert alert-success">

	      {{ Session::get('success') }}

	    </div>

	@endif


	
	
 	@if(Session::has('error'))

	    <div class="alert alert-danger">

	      {{ Session::get('error') }}

	    </div>

	@endif
                    
                    
                      
					  
					  
					  
					 
					  <?php if(!empty($sql_request_count)){?>
					  
					  <span class="section">Job Details - <?php echo $gig[0]->subject;?></span>
					  
					  

                      <div class="form-group clear">
					     <div class="col-md-8">
					  
							<label class="control-label col-md-3 black" for="name">Title
							</label>
							<div class="col-md-2 black">:</div>
							
							<div class="col-md-7">
							  <?php echo $gig[0]->subject;?>
						   </div>
					   </div>
					   
					   
                      </div>
					  <?php
					   
					   if(!empty($gig[0]->category_type))
						  {
						  if($gig[0]->category_type=="subcat")
						  { 
						  
						  $category = DB::table('subcategory')
									->where('subid', '=', $gig[0]->category)
									->get();
							$category_cnt = DB::table('subcategory')
									->where('subid', '=', $gig[0]->category)
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
						  if($gig[0]->category_type=="cat")
						  { 
						  
						  $category = DB::table('category')
									->where('id', '=', $gig[0]->category)
									->get();
							$category_cnt = DB::table('category')
									->where('id', '=', $gig[0]->category)
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
						
						if(!empty($gig[0]->subcategory))
				{
					$view_category = DB::table('subcategory')
										->where('subid', '=', $gig[0]->subcategory)
										->get();
					$namesub = $view_category[0]->subname;					
				}
				else
				{
					$namesub = "";
				}
						  
						
						
						if($gig[0]->budget_type=="fixed")
						   { 
						     $bud_txt = "Fixed Price"; 
						     if($gig[0]->fixed_price=="custom_budget")
							 {
								$estim = 'Custom Budget ('.$gig[0]->minimum_budget.' - '.$gig[0]->maximum_budget.' '.$site_setting[0]->site_currency.')';
							 }
							 else
							 {
								 $estim = $gig[0]->fixed_price;
							 }
						   } 
						   else if($gig[0]->budget_type=="hour"){ 
						   $bud_txt = "Hourly Price"; 
						   
						   if($gig[0]->hour_price=="custom_budget")
							 {
								$estim = $gig[0]->minimum_budget.' - '.$gig[0]->maximum_budget;
							 }
							 else
							 {
								 $estim = $gig[0]->hour_price;
							 }
						   
						   
						   }





$files = $gig[0]->token;
						   
						   
						   $count_file = DB::table('request_file')
									->where('token_key', '=', $files)
									->count();
									if(!empty($count_file))
									{
									$view_file = DB::table('request_file')
									             ->where('token_key', '=', $files)
									             ->get();
										$pathfile = "";
                                        $secondfile = "";										
										foreach($view_file as $files)
										{
											$pathfile .=$files->file_name."<br/>";
											$secondfile .="<a href=".$url."/local/images/request/".$files->file_name." download>".$files->file_name."</a><br/>";
										}
									
									}
									else
									{
										$pathfile = "";
										$secondfile = "";
									}	





 $tag = $gig[0]->request_skills;
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
							        
									$par .=$view_key[0]->skill.', ';
									}
									else
									{
										$par .= "";
									}
									
								}
                             $topar = rtrim($par,', ');								
						   
						   
						   if($gig[0]->complete_days==1)
						   {
							   $day_txt = "Day";
						   }
						   else if($gig[0]->complete_days > 1)
						   {
							   $day_txt = "Days";
						   }
						   else
						   {
							   $day_txt = "";
						   }									
						?>
                      
					  
					  
					  <div class="form-group clear">
					     <div class="col-md-8">
					  
							<label class="control-label col-md-3 black" for="name">Budget
							</label>
							<div class="col-md-2 black">:</div>
							
							<div class="col-md-7">
							  <?php echo $estim;?>
						   </div>
					   </div>
					   
					   
                      </div>
					  
					  
					   
                      <div class="form-group clear">
					     <div class="col-md-8">
					  
							<label class="control-label col-md-3 black" for="name">Estimate Delivery
							</label>
							<div class="col-md-2 black">:</div>
							
							<div class="col-md-7">
							  <?php if(!empty($gig[0]->complete_days)){?> <?php echo $gig[0]->complete_days;?> <?php echo $day_txt;?> <?php } ?>
						   </div>
					   </div>
					   
					   
                      </div>

					  
					  <div class="form-group clear">
					     <div class="col-md-8">
					  
							<label class="control-label col-md-3 black" for="name">Category
							</label>
							<div class="col-md-2 black">:</div>
							
							<div class="col-md-7">
							  <?php echo $catname;?><?php if(!empty($namesub)){?>, <?php echo $namesub;?><?php } ?>
						   </div>
					   </div>
					   
					   
                      </div>
                     
					 
					 
					 <div class="form-group clear">
					     <div class="col-md-8">
					  
							<label class="control-label col-md-3 black" for="name">Description
							</label>
							<div class="col-md-2 black">:</div>
							
							<div class="col-md-7">
							  <?php echo $gig[0]->description;?>
						   </div>
					   </div>
					   
					   
                      </div>
					  
					  
					  
					  
					  
					  
					  <div class="form-group clear">
					     <div class="col-md-8">
					  
							<label class="control-label col-md-3 black" for="name">Submitted Date
							</label>
							<div class="col-md-2 black">:</div>
							
							<div class="col-md-7">
							  <?php echo $gig[0]->submit_date;?>
						   </div>
					   </div>
					   
					   
                      </div>
					  
					  
					  
					  <div class="form-group clear">
					     <div class="col-md-8">
					  
							<label class="control-label col-md-3 black" for="name">Skills
							</label>
							<div class="col-md-2 black">:</div>
							
							<div class="col-md-7">
							  <?php echo $topar;?>
						   </div>
					   </div>
					   
					   
                      </div>
					  
					  
					  
					  
					  
					  <div class="form-group clear">
					     <div class="col-md-8">
					  
							<label class="control-label col-md-3 black" for="name">Preferred location
							</label>
							<div class="col-md-2 black">:</div>
							
							<div class="col-md-7">
							  <?php echo $gig[0]->preferred_location;?>
						   </div>
					   </div>
					   
					   
                      </div>
					  
					  
					  
					  
					  
					 
					  
					  
					  <div class="form-group clear">
					     <div class="col-md-8">
					  
							<label class="control-label col-md-3 black" for="name">File Attachment
							</label>
							<div class="col-md-2 black">:</div>
							
							<div class="col-md-7">
							  <?php echo $secondfile;?>
						   </div>
					   </div>
					   
					   
                      </div>
					  
					  
					  
					  
					  
					  
					  <br/>
					  
					  
					  
					   <div class="clear" style="padding-top:30px !important;">
					   <a href="<?php echo $url;?>/admin/request" 
					   class="btn btn-success">Back to jobs</a> 
						  
					   
					   </div>
					  
					  <?php } ?>
                      
                      
                    
                  </div>
                </div>
              </div>
			  
		
		
		
		
		
		
		
		
		
		
		
		
		
		
        <!-- /page content -->

      
      </div>
    </div>

	  
	  
	  
	 
	 @include('admin.footer')
    
	
  </body>
</html>

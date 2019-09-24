<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	




</head>
<body>

    <?php 
	
	$url = URL::to("/"); ?>

    <!-- fixed navigation bar -->
    @include('header')

    <!-- slider -->
    

	
    
	
	
	
	
	
	
	
	<div class="clearfix sv_mob_clearfix"></div>
	
	
	
	
	
	<div class="video">
	<div class="clearfix sv_mob_clearfix"></div>
	<div class="container">
	 <h1>Rhino Registration</h1>
	 
	 
	
	 
	 
	 <div class="clearfix"></div>
	 
	 
	 
	 
	 
	 
	 
	 
	 <?php if($shopcount==0 && ($admin_type==1 || $admin_type==2) ){?>
	 
	 
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
	
	<?php $url = URL::to("/"); ?>
	 <form class="form-horizontal" role="form" method="POST" action="{{ route('addshop') }}" id="formID" enctype="multipart/form-data">
                        {{ csrf_field() }}
	 
	 
	 <input type="hidden" name="editid" value="">
	 
	 
    <div class="row profile shop">
		<div class="col-md-6">
		
		<div class="form-group">
                            <label for="name" class="col-md-12">Name <span class="require">*</span></label>

                     <div class="col-md-12">
                     <input id="shop_name" type="text" class="form-control validate[required] text-input" name="shop_name" value="" autofocus>

                                
                            </div>
        </div>
		
		
		<input type="hidden" name="admin_email_id" value="<?php echo $admin_email_id[0]->email;?>">
		
		
		
		
		
		<div class="form-group">
                            <label for="name" class="col-md-12">Phone No <span class="require">*</span></label>

                            <div class="col-md-12">
                                <input id="shop_phone_no" type="text" class="form-control validate[required] text-input" name="shop_phone_no" value="">

                                
                            </div>
        </div>

		
		<div class="webheight"></div>
		
		
		
		<!--<div class="form-group">
                            <label for="name" class="col-md-12">Shop Start Time <span class="require">*</span></label>

                            <div class="col-md-12">
                               
								<select id="shop_start_time" name="shop_start_time" class="form-control validate[required]">
								<option value="">None</option>
								<?php foreach($time as $timekey => $timevalue) {?>
								<option value="<?php echo $timevalue;?>"><?php echo $timekey;?></option>
								<?php } ?>

							</select>

                                
                     </div>
        </div>-->
		
		<input type="hidden" name="shop_start_time" value="9">
		
		
		<div class="form-group">
                            <label for="name" class="col-md-12">Cover Photo</label>
                            <div class="col-md-12 littlebit"><span class="require">[Please select an image 1400px / 300px]</span></div>
                            <div class="col-md-12">
                                 <input type="file" id="shop_cover_photo" name="shop_cover_photo" class="form-control validate[required]">
                                @if ($errors->has('shop_cover_photo'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('shop_cover_photo') }}</strong>
                                    </span>
                                @endif
                                
                            </div>
							
							
							
        </div>
		
		
		
		
		
		<!--<div class="form-group">
                            <label for="name" class="col-md-12">Advance Booking upto <span class="require">*</span></label>

                            <div class="col-md-12">
                               <select id="shop_booking_upto" name="shop_booking_upto" class="form-control validate[required] text-input">
								<option value="">None</option>
								<?php foreach($days as $daykey => $dayvalue) {?>
								<option value="<?php echo $dayvalue;?>"><?php echo $daykey;?></option>
								<?php } ?>

							</select>

                                
                            </div>
        </div>-->


        <input type="hidden" name="shop_booking_upto" value="30">

        
		
		
		
		
		<div class="form-group">
                            <label for="name" class="col-md-12">Allowed Bookings Per 8 Hours <span class="require">*</span></label>

                            <div class="col-md-12">
                                <input id="shop_booking_hour" type="number" class="form-control validate[required] text-input" name="shop_booking_hour" value="" placeholder="amount in rupees">

                                
                            </div>
        </div>
		
		
		
		
		<!--<div class="form-group">
                            <label for="name" class="col-md-12">Tax (%) <span class="require">*</span></label>

                            <div class="col-md-12">
                                <input id="tax_percent" type="number" class="form-control validate[required] text-input" name="tax_percent" value="">

                                
                            </div>
        </div>-->


        <input type="hidden" name="tax_percent" value="16">



		<div class="form-group">
                            <label for="name" class="col-md-12">CNIC <span class="require">*</span></label>

                     <div class="col-md-12">
                     <input id="cnic" type="text" class="form-control validate[required, custom[cnicValidate]] text-input" name="cnic" value="" autofocus placeholder="enter a valid cnic number with dashes">

                                
                            </div>
        </div>



        <div class="form-group">
            <label for="name" class="col-md-12">Gender <span class="require">*</span></label>

            <div class="col-md-12">
                <select id="gender" name="gender" class="form-control validate[required]">
                    <option value="">None</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                
            </div>
        </div>



        <div class="form-group">
            <label for="name" class="col-md-12">Date of registration <span class="require">*</span></label>
            <script type="text/javascript">

                $(function() {
              
               $('#date_of_registration').datepicker({
              
              changeMonth: true,
              changeYear: true,
              minDate: 0,
            dateFormat: 'yy/mm/dd',


              });
     
              $("#datepicker").datepicker( "option", "maxDate", );
              });   
              
               </script>
            <div class="col-md-12">
            <input id="date_of_registration" type="text" class="form-control validate[required, custom[date]] text-input" name="date_of_registration" value="" autofocus placeholder="yy-mm-dd">

                
            </div>
        </div>


        <div class="form-group">
            <label for="name" class="col-md-12">Are you a Rhino or Contractor<span class="require"> *</span></label>

            <div class="col-md-12">
                <select id="shop_type_id" name="shop_type_id" class="form-control validate[required]">
                    <option value="">None</option>
                    <option value="1">Rhino</option>
                    <option value="2">Contractor</option>
                </select>
                
            </div>
        </div>




        <div class="form-group">
            <label for="name" class="col-md-12">Number of Rhinos in team</label>

            <div class="col-md-12">
                <input id="number_of_rhinos_in_team" type="text" class="form-control text-input" name="number_of_rhinos_in_team" value="" autofocus placeholder="this field only for contractor otherwise leave it empty">

                
            </div>
        </div>



        <div class="form-group">
                            <label for="name" class="col-md-12">Your Profession <span class="require">*</span></label>

                            <div class="col-md-12">
                               <select id="profession" name="profession" class="form-control validate[required] text-input">
								<option value="">None</option>
								<?php foreach($professions as $profession) {?>
                                    <option value="<?php echo $profession->subid;?>"><?php echo $profession->subname;?></option>
                                    <?php } ?>
    
                                </select>
    
                                    
                                </div>
            </div>



        
		
			
		</div>




		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		<div class="col-md-6 moves20">
            
			   
			   
			   <div class="form-group">
                            <label for="name" class="col-md-12">Address <span class="require">*</span></label>

                            <div class="col-md-12">
                                <input id="txtPlaces" type="text" class="form-control validate[required] text-input" name="shop_address" value="">

                                
                            </div>
              </div>
			   
                   
              
			  
			  
			  
			  <div class="form-group">
                            <label for="name" class="col-md-12">Description <span class="require">*</span></label>

                            <div class="col-md-12">
                                <textarea id="shop_desc" class="form-control validate[required] text-input" name="shop_desc"></textarea>

                                
                            </div>
              </div>
                        
				

                <!--<div class="form-group">
                            <label for="name" class="col-md-12">Shop End Time <span class="require">*</span></label>

                            <div class="col-md-12">
                                
								<select id="shop_end_time" name="shop_end_time" class="form-control validate[required]">
								<option value="">None</option>
								<?php foreach($time as $timekey => $timevalue) {?>
								<option value="<?php echo $timevalue;?>" ><?php echo $timekey;?></option>
								<?php } ?>

							</select>

                                
                     </div>
               </div>-->				
                        
               
               <input type="hidden" name="shop_end_time" value="9">
						
						
						
						
						<div class="form-group">
                            <label for="name" class="col-md-12">Profile Photo</label>
                               <div class="col-md-12 littlebit"><span class="require">[Please select an image 150px / 150px]</span></div>
                            <div class="col-md-12">
                                 <input type="file" id="shop_profile_photo" name="shop_profile_photo" class="form-control validate[required]">
                                 @if ($errors->has('shop_profile_photo'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('shop_profile_photo') }}</strong>
                                    </span>
                                @endif   
                                
                            </div>
							
							
							
							
							
							
                      </div>
						
                     
					  
					  
					  <div class="form-group">
                            <label for="name" class="col-md-12">Working Days <span class="require">*</span></label>

                            <div class="col-md-12">
							<?php foreach($daytxt as $daytxtkey => $daytxtvalue){?>
							
                                 <input type="checkbox" id="shop_working_days" name="shop_working_days[]" class="validate[required]" value="<?php echo $daytxtvalue;?>" checked onclick="return false"> <?php echo $daytxtkey;?><br/>
							<?php } ?>
                                
                            </div>
                      </div>
						
					  
					  
					  
                        <?php if(!empty($site_setting[0]->site_logo)){
							 
							?>
						
						<input type="hidden" name="site_logo" value="<?php echo $url.'/local/images/settings/'.$site_setting[0]->site_logo;?>">
					
						<?php } else { ?>
						
						<input type="hidden" name="site_logo" value="">
						
						<?php } ?>
						
						
						<input type="hidden" name="site_name" value="<?php echo $site_setting[0]->site_name;?>">
                     
                    
               
				
				<div class="form-group">
                            <label for="name" class="col-md-12">Registration document</label>
                               <div class="col-md-12 littlebit"><span class="require">[Please upload pdf or image only]</span></div>
                            <div class="col-md-12">
							
							
							<input type="file" name="the-pdf" id="the-pdf" class="form-control validate[required]">
                                 
                                 @if ($errors->has('the-pdf'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('the-pdf') }}</strong>
                                    </span>
                                @endif 
                                
                            </div>
							
							
							
							
							
							
                </div>
			   
			   
                <div class="form-group">
                    <label for="name" class="col-md-12">Associated with contractor <span class="require">*</span></label>
        
                    <div class="col-md-12">
                        <select id="associated_with_contractor" name="associated_with_contractor" class="form-control validate[required]">
                            <option value="">None</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                            <option value="Self">Self</option>
                        </select>
                        
                    </div>
                </div>




                <div class="form-group">
                    <label for="name" class="col-md-12">If you are associated with contractor then provide the Name of firm</label>

                    <div class="col-md-12">
                        <input id="name_of_firm" type="text" class="form-control text-input" name="name_of_firm" value="" autofocus placeholder="enter a contractor's firm name">

                        
                    </div>
                </div>



                <div class="form-group">
                    <label for="name" class="col-md-12">Name of owner or Contractor</label>

                    <div class="col-md-12">
                        <input id="name_of_owner_or_contractor" type="text" class="form-control text-input" name="name_of_owner_or_contractor" value="" autofocus placeholder="this field only for contractor otherwise leave it empty">

                        
                    </div>
                </div>



                



                

                      
			   
			   
           
        </div>
        
		
		
	
		
	</div>
	
    <div class="row">
	<div class="col-md-12">
		                       
							   <a href="<?php echo $url;?>/addshop" class="btn btn-primary">
                                   Reset
                                </a>
								
								<?php if(config('global.demosite')=="yes"){?><button type="button" class="btn btn-success radiusoff btndisable">Add</button> 
								<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
								
                                <button type="submit" class="btn btn-success radiusoff">
                                    Register
                                </button>
								
								<?php } ?>
                           
		</div>
	</div>
	
	

     </form>
     <script src="<?php echo $url;?>/js/myJavaScript.js" type="text/javascript" charset="utf-8"></script>
	 
	 
	 <?php }else{ ?>
	 	
	 <center style="color:red; font-size:20px">You cannot add Rhino</center>
<?php } ?>
	 
	 
	 
	 
	 <div class="height30"></div>
	 <div class="row">
	
	
	
	
	
	</div>
	
	</div>
	</div>
	
	
	

      <div class="clearfix"></div>
	   <div class="clearfix"></div>

      @include('footer')
</body>
</html>
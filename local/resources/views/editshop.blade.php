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
    
	<div class="video">

	<div class="container">
	 <h1>Shop</h1>
	 
	 <?php if($requestid!=""){?>
	 
	 
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
	<div class="edit-shop">
	 <form class="form-horizontal" role="form" method="POST" action="{{ route('editshop') }}" id="formID" enctype="multipart/form-data">
                        {{ csrf_field() }}
	 
	 
	 <input type="hidden" name="editid" value="<?php echo $requestid;?>">
	 	 
    <div class="row profile shop">
		<div class="col-md-6">
		
		<div class="form-group">
            <label for="name" class="col-md-12">Shop Name <span class="require">*</span></label>

            <div class="col-md-12">
                <input id="shop_name" type="text" class="form-control input-lg validate[required] text-input" name="shop_name" value="<?php echo $editshop[0]->shop_name;?>" autofocus>                                
            </div>
        </div>
		
		<div class="form-group">
            <label for="name" class="col-md-12">Shop Phone No <span class="require">*</span></label>

            <div class="col-md-12">
                <input id="shop_phone_no" type="text" class="form-control input-lg validate[required] text-input" name="shop_phone_no" value="<?php echo $editshop[0]->shop_phone_no;?>">                
            </div>
        </div>
		
		<div class="webheight"></div>

		<div class="form-group">
            <label for="name" class="col-md-12">Shop Start Time <span class="require">*</span></label>

            <div class="col-md-12">
               
				<select id="shop_start_time" name="shop_start_time" class="form-control input-lg validate[required]">
				<option value="">None</option>
				<?php foreach($time as $timekey => $timevalue) {?>
				<option value="<?php echo $timevalue;?>" <?php if($editshop[0]->start_time==$timevalue){?> selected="selected" <?php } ?>><?php echo $timekey;?></option>
				<?php } ?>

			</select>
                                
            </div>
        </div>
				
		<div class="form-group">
                            <label for="name" class="col-md-12">Shop Cover Photo</label>
                            <div class="col-md-12 littlebit"><span class="require">[Please select an image 1400px / 300px]</span></div>
                            <div class="col-md-12">
								<div class="upload-btn-wrapper">
								 <button class="btn">Upload Cover Photo</button>
                                 <input type="file" id="shop_cover_photo" name="shop_cover_photo" class="form-control input-lg">
								</div>
                                @if ($errors->has('shop_cover_photo'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('shop_cover_photo') }}</strong>
                                    </span>
                                @endif                                
								
                            </div>
							<?php 
					   $shopphoto="/shop/";
						$paths ='/local/images'.$shopphoto.$editshop[0]->cover_photo;
						if($editshop[0]->cover_photo!=""){
						?>
					 <br/>
					  <div class="col-md-12">
					  <div class="image-cover">
					  <img src="<?php echo $url.$paths;?>" class="thumb" width="150">
					  </div>
					  </div>
					 
						<?php } else { ?>
					  <br/>
					  <div class="col-md-12">
					  <div class="image-cover">
					  <img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="thumb" width="150">
					  </div>
					  </div>
					 
						<?php } ?>						
        </div>
		
		<input type="hidden" name="current_cover" value="<?php echo $editshop[0]->cover_photo;?>">

		<div class="form-group">
                            <label for="name" class="col-md-12">Advance Booking upto <span class="require">*</span></label>

                            <div class="col-md-12">
                               <select id="shop_booking_upto" name="shop_booking_upto" class="form-control input-lg validate[required] text-input">
								<option value="">None</option>
								<?php foreach($days as $daykey => $dayvalue) {?>
								<option value="<?php echo $dayvalue;?>" <?php if($editshop[0]->booking_opening_days==$dayvalue){?> selected="selected" <?php } ?>><?php echo $daykey;?></option>
								<?php } ?>

							</select>

                            </div>
        </div>

		<div class="form-group">
                            <label for="name" class="col-md-12">Allowed Bookings Per Hour <span class="require">*</span></label>

                            <div class="col-md-12">
                                <input id="shop_booking_hour" type="number" class="form-control input-lg validate[required] text-input" name="shop_booking_hour" value="<?php echo $editshop[0]->booking_per_hour;?>">
                                
                            </div>
        </div>
		
		<div class="form-group">
                            <label for="name" class="col-md-12">Tax (%) <span class="require">*</span></label>

                            <div class="col-md-12">
                                <input id="tax_percent" type="number" class="form-control input-lg validate[required] text-input" name="tax_percent" value="<?php echo $editshop[0]->tax_percent;?>"> 
                            </div>
        </div>

		</div>

		<div class="col-md-6 moves20">

			   <div class="form-group">
                            <label for="name" class="col-md-12">Shop Address <span class="require">*</span></label>

                            <div class="col-md-12">
                                <input id="txtPlaces" type="text" class="form-control input-lg validate[required] text-input" name="shop_address" value="<?php echo $editshop[0]->address;?>">
                            </div>
              </div>

			  <div class="form-group">
                            <label for="name" class="col-md-12">Shop Description <span class="require">*</span></label>

                            <div class="col-md-12">
                                <textarea id="shop_desc" rows="3" class="form-control input-lg validate[required] text-input" name="shop_desc"><?php echo $editshop[0]->description;?></textarea>
                            </div>
              </div>

                <div class="form-group">
                            <label for="name" class="col-md-12">Shop End Time <span class="require">*</span></label>

                            <div class="col-md-12">                                
								<select id="shop_end_time" name="shop_end_time" class="form-control input-lg validate[required]">
								<option value="">None</option>
								<?php foreach($time as $timekey => $timevalue) {?>
								<option value="<?php echo $timevalue;?>" <?php if($editshop[0]->end_time==$timevalue){?> selected="selected" <?php } ?>><?php echo $timekey;?></option>
								<?php } ?>

							</select>  
                     </div>
               </div>				

						<div class="form-group">
                            <label for="name" class="col-md-12">Shop Profile Photo</label>
                               <div class="col-md-12 littlebit"><span class="require">[Please select an image 150px / 150px]</span></div>
                            <div class="col-md-12">
								<div class="upload-btn-wrapper">
								 <button class="btn">Upload Photo</button>
                                 <input type="file" id="shop_profile_photo" name="shop_profile_photo" class="form-control input-lg">
                                 @if ($errors->has('shop_profile_photo'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('shop_profile_photo') }}</strong>
                                    </span>
                                @endif                                
								</div>
                            </div>
							
							<?php 
					   $shopprofile="/shop/";
						$path ='/local/images'.$shopprofile.$editshop[0]->profile_photo;
						if($editshop[0]->profile_photo!=""){
						?>
					 <br/>
					  <div class="col-md-12">
					  <div class="image-cover">
					  <img src="<?php echo $url.$path;?>" class="thumb" width="150">
					  </div>
					  </div>
					 
						<?php } else { ?>
					  <br/>
					  <div class="col-md-12">
					  <div class="image-cover">
					  <img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="thumb" width="150">
					  </div>
					  </div>
					 
						<?php } ?>

                      </div>
						
                      <input type="hidden" name="current_photo" value="<?php echo $editshop[0]->profile_photo;?>">
					  
					  
					  <div class="form-group">
                            <label for="name" class="col-md-12">Shop Working Days <span class="require">*</span></label>

                            <div class="col-md-12">
							<?php foreach($daytxt as $daytxtkey => $daytxtvalue){?>
								<label class="container"><?php echo $daytxtkey;?>
                                 <input type="checkbox" id="shop_working_days" name="shop_working_days[]" class="validate[required]" <?php if(in_array($daytxtvalue, $sel)) { ?> checked="checked" <?php } ?> value="<?php echo $daytxtvalue;?>"> <br/>
								 <span class="checkmark"></span>
								</label>
							<?php } ?>
                                
                            </div>
                      </div>

                        <input type="hidden" name="site_logo" value="">
						
						<input type="hidden" name="site_name" value="">
                    
                   <input type="hidden" name="status" value="<?php echo $editshop[0]->status;?>">
				<div class="form-group">
                            <label for="name" class="col-md-12">Shop registration document</label>
                               <div class="col-md-12 littlebit"><span class="require">[Please upload pdf or image only]</span></div>
                            <div class="col-md-12">
								<div class="upload-btn-wrapper">
								 <button class="btn">Upload Photo</button>
                                 <input type="file" id="the-pdf" name="the-pdf" class="form-control input-lg <?php if(empty($editshop[0]->shop_document)){?>validate[required]<?php } ?>">

                                 @if ($errors->has('the-pdf'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('the-pdf') }}</strong>
                                    </span>
                                @endif 
								</div>
                            </div>
							<?php if(!empty($editshop[0]->shop_document)){?>
							<div class="col-md-12"><a href="<?php echo $url;?>/local/images/shop/<?php echo $editshop[0]->shop_document;?>" target="_blank"><?php echo $editshop[0]->shop_document;?></a></div>
							<?php } ?>
				
                      </div>
			   
			   <input type="hidden" name="current_document" value="<?php echo $editshop[0]->shop_document;?>">

		</div>

	</div>
	</div>
	<div class="height30"></div>
    <div class="row">
	<div class="col-md-12">
		                       
		<a href="<?php echo $url;?>/shop" class="btn btn-primary radiusoff">
            Reset
         </a>
		
		<?php if(config('global.demosite')=="yes"){?><button type="button" class="btn btn-success radiusoff btndisable">Update</button> 
		<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
		
         <button type="submit" class="btn btn-success radiusoff">
             Update
         </button>
								<?php } ?>
		</div>
	</div>

	 </form>

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
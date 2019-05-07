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
                <?php $url = URL::to("/"); ?>    
                   <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.settings') }}" enctype="multipart/form-data" novalidate>
                     {{ csrf_field() }}  
                      <span class="section">Settings</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Site Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_name" class="form-control col-md-7 col-xs-12"  name="site_name" value="<?php echo $settings[0]->site_name; ?>" required="required" type="text">
                        
					   </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Site Description
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
						   <textarea id="site_desc" class="form-control col-md-7 col-xs-12" name="site_desc"><?php echo $settings[0]->site_desc; ?></textarea>
                        </div>
                      </div>
					  
					  <input type="hidden" name="save_desc" value="<?php echo $settings[0]->site_desc; ?>">
                      
                      
                      <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Site Keyword</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_keyword" type="text" name="site_keyword" value="<?php echo $settings[0]->site_keyword; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
					  
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Google ads space
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
						   <textarea id="site_ads_space" class="form-control col-md-7 col-xs-12" name="site_ads_space"><?php echo $settings[0]->site_ads_space; ?></textarea>
                        </div>
                      </div>
					  
					  
					  
					  <input type="hidden" name="save_key" value="<?php echo $settings[0]->site_keyword; ?>">
					  
					  
					  <input type="hidden" name="save_facebook" value="<?php echo $settings[0]->site_facebook; ?>">
					  <input type="hidden" name="save_twitter" value="<?php echo $settings[0]->site_twitter; ?>">
					  <input type="hidden" name="save_gplus" value="<?php echo $settings[0]->site_gplus; ?>">
					  <input type="hidden" name="save_pinterest" value="<?php echo $settings[0]->site_pinterest; ?>">
					  <input type="hidden" name="save_instagram" value="<?php echo $settings[0]->site_instagram; ?>">
					  
					  <input type="hidden" name="save_copyright" value="<?php echo $settings[0]->site_copyright; ?>">
					  
					  <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Facebook Link</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_facebook" type="text" name="site_facebook" value="<?php echo $settings[0]->site_facebook; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
					  
					  
					  
					  <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Twitter Link</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_twitter" type="text" name="site_twitter" value="<?php echo $settings[0]->site_twitter; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
					  
					  
					  <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">GPlus Link</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_gplus" type="text" name="site_gplus" value="<?php echo $settings[0]->site_gplus; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
					  
					  
					  
					   <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Pinterest Link</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_pinterest" type="text" name="site_pinterest" value="<?php echo $settings[0]->site_pinterest; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
					  
					  
					  
					  
					  <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Instagram Link</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_instagram" type="text" name="site_instagram" value="<?php echo $settings[0]->site_instagram; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
					  
		<div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Footer Copyright</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_copyright" type="text" name="site_copyright" value="<?php echo $settings[0]->site_copyright; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>			  
					  
                      
                      
					   <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currency">Currency <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<select name="currency" required="required" class="form-control col-md-7 col-xs-12">
						<option value=""></option>
						<?php foreach($currency as $newcurrency){?>
							   <option value="<?php echo $newcurrency;?>" <?php if($settings[0]->site_currency==$newcurrency){?> selected="selected" <?php } ?>><?php echo $newcurrency;?></option>
						<?php } ?>
						</select>
                          
                        </div>
                      </div>
					 
					  
					  
					  
					<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Logo
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="site_logo" name="site_logo" class="form-control col-md-7 col-xs-12">
						  
						   @if ($errors->has('site_logo'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('site_logo') }}</strong>
                                    </span>
                                @endif
						  
                        </div>
                      </div>
					   
					  <?php 
					   $settingphoto="/settings/";
						$path ='/local/images'.$settingphoto.$settings[0]->site_logo;
						if($settings[0]->site_logo!=""){
						?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.$path;?>" class="thumb" width="100">
					  </div>
					  </div>
						<?php } else { ?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="logo" width="100">
					  </div>
					  </div>
						<?php } ?>
						
						
						
						
						<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Favicon
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="site_favicon" name="site_favicon" class="form-control col-md-7 col-xs-12">
						   @if ($errors->has('site_favicon'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('site_favicon') }}</strong>
                                    </span>
                                @endif
						  
                        </div>
                      </div>
					  
					  
					  <?php 
					   $settingphotos="/settings/";
						$paths ='/local/images'.$settingphotos.$settings[0]->site_favicon;
						if($settings[0]->site_favicon!=""){
						?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.$paths;?>" class="thumb" width="24" style="border:1px solid #CCCCCC;">
					  </div>
					  </div>
						<?php } else { ?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="logo" width="24" style="border:1px solid #CCCCCC;">
					  </div>
					  </div>
						<?php } ?>
						
						
						
						
						
						
						<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Home Page Banner
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="site_banner" name="site_banner" class="form-control col-md-7 col-xs-12">
						   @if ($errors->has('site_banner'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('site_banner') }}</strong>
                                    </span>
                                @endif
						  
                        </div>
                      </div>
					  
					  
					   <?php 
					   $bannerphotos="/settings/";
						$pathes ='/local/images'.$bannerphotos.$settings[0]->site_banner;
						if($settings[0]->site_banner!=""){
						?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.$pathes;?>" class="thumb" width="200" style="border:1px solid #CCCCCC;">
					  </div>
					  </div>
						<?php } else { ?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="logo" width="100" style="border:1px solid #CCCCCC;">
					  </div>
					  </div>
						<?php } ?>
						
						
						
						<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="commission mode">Commission From <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						
						<select name="commission_from" id="commission_from" class="form-control" required="required">
						<option value="">Select</option>
									<option value="vendor" <?php { if($settings[0]->commission_from=="vendor") echo "selected='selected'"; }?>>Vendor</option>
									<option value="buyer" <?php { if($settings[0]->commission_from=="buyer") echo "selected='selected'"; }?>>Buyer</option>
								</select>
						
                          
                        </div>
                      </div>
						
						
						
						
						 <div class="item form-group" id="vendoronly" <?php if($settings[0]->commission_from!="vendor"){?>style="display:none;"<?php } ?>>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="commission mode">Commission Mode <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						
						<select name="commission_mode_vendor" id="commission_mode" class="form-control" required="required">
									
									<option value="percentage" <?php { if($settings[0]->commission_mode=="percentage") echo "selected='selected'"; }?>>Percentage</option>
								</select>
						
                          
                        </div>
                      </div>
					  
					  
					   
					   
					   <div class="item form-group" id="buyeronly" <?php if($settings[0]->commission_from!="buyer"){?>style="display:none;"<?php } ?>>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="commission mode">Commission Mode <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						
						<select name="commission_mode_buyer" id="commission_mode" class="form-control" required="required">
									<option value="fixed" <?php { if($settings[0]->commission_mode=="fixed") echo "selected='selected'"; }?>>Fixed</option>
									<option value="percentage" <?php { if($settings[0]->commission_mode=="percentage") echo "selected='selected'"; }?>>Percentage</option>
								</select>
						
                          
                        </div>
                      </div>
					   
					  
					  
					  
						
						
						<div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Enter Amout / percentage</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="commission_amt" type="text" name="commission_amt" value="<?php echo $settings[0]->commission_amt; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  
                        </div>
                      </div>
					  
					  
					  <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Post per page</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="message_per_page" type="text" name="message_per_page" value="<?php echo $settings[0]->message_per_page; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  
                        </div>
                      </div>
					  
					  
					 
					  
					  
					  
					   <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="commission mode">Paypal site Mode <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						
						<select name="paypal_url" id="paypal_url" class="form-control" required="required">
						<option value="">Select</option>
									<option value="https://www.sandbox.paypal.com/cgi-bin/webscr" <?php { if($settings[0]->paypal_url=="https://www.sandbox.paypal.com/cgi-bin/webscr") echo "selected='selected'"; }?>>Test</option>
									<option value="https://www.paypal.com/cgi-bin/webscr" <?php { if($settings[0]->paypal_url=="https://www.paypal.com/cgi-bin/webscr") echo "selected='selected'"; }?>>Live</option>
								</select>
						
                          
                        </div>
                      </div>
					  
					   <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Paypal Id</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="paypal_id" type="text" name="paypal_id" value="<?php echo $settings[0]->paypal_id; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  
                        </div>
                      </div>
					  
					  
					  
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="commission mode">Stripe site Mode <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						
						<select name="stripe_mode" id="stripe_mode" class="form-control" required="required">
						<option value="">Select</option>
									<option value="test" <?php { if($settings[0]->stripe_mode=="test") echo "selected='selected'"; }?>>Test</option>
									<option value="live" <?php { if($settings[0]->stripe_mode=="live") echo "selected='selected'"; }?>>Live</option>
								</select>
						
                          
                        </div>
                      </div>
					  
					  
					  
					  <div class="item form-group" id="stripe_test_publish" <?php if($settings[0]->stripe_mode!="test"){?>style="display:none;"<?php } ?>>
                        <label for="test_publish_key" class="control-label col-md-3">Test Publishable key</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="test_publish_key" type="text" name="test_publish_key" value="<?php echo $settings[0]->test_publish_key; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  
                        </div>
                      </div>
					  
					  
					   <div class="item form-group" id="stripe_test_secret" <?php if($settings[0]->stripe_mode!="test"){?>style="display:none;"<?php } ?>>
                        <label for="test_secret_key" class="control-label col-md-3">Test Secret key</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="test_secret_key" type="text" name="test_secret_key" value="<?php echo $settings[0]->test_secret_key; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  
                        </div>
                      </div>
					  
					  
					  
					  
					  
					  
					  <div class="item form-group" id="stripe_live_publish" <?php if($settings[0]->stripe_mode!="live"){?>style="display:none;"<?php } ?>>
                        <label for="live_publish_key" class="control-label col-md-3">Live Publishable key</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="live_publish_key" type="text" name="live_publish_key" value="<?php echo $settings[0]->live_publish_key; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  
                        </div>
                      </div>
					  
					  
					   <div class="item form-group" id="stripe_live_secret" <?php if($settings[0]->stripe_mode!="live"){?>style="display:none;"<?php } ?>>
                        <label for="live_secret_key" class="control-label col-md-3">Live Secret key</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="live_secret_key" type="text" name="live_secret_key" value="<?php echo $settings[0]->live_secret_key; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  
                        </div>
                      </div>
					  
					  
					  
					  
					  
					  
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="commission mode">Payumoney site Mode <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						
						<select name="payu_mode" id="payu_mode" class="form-control" required="required">
						<option value="">Select</option>
									<option value="test" <?php { if($settings[0]->payu_mode=="test") echo "selected='selected'"; }?>>Test</option>
									<option value="live" <?php { if($settings[0]->payu_mode=="live") echo "selected='selected'"; }?>>Live</option>
								</select>
						
                          
                        </div>
                      </div>
					  
					  
					  
					 
                    <div class="item form-group">
                        <label for="merchant_key" class="control-label col-md-3">Merchant Key</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="merchant_key" type="text" name="merchant_key" value="<?php echo $settings[0]->merchant_key; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  
                        </div>
                      </div>
					  
					  
					   <div class="item form-group">
                        <label for="salt_id" class="control-label col-md-3">Salt</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="salt_id" type="text" name="salt_id" value="<?php echo $settings[0]->salt_id; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  
                        </div>
                      </div>


					 
					  
					  
					  
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payment mode">Payment Option
                        </label>
						
                        <div class="col-md-6 col-sm-6 col-xs-12">
						
						<?php 
						
						
						$arrays =  explode(',', $settings[0]->payment_option);
						
						
						foreach($paymentopt as $draw){?>
						<input type="checkbox" name="payment_opt[]"  value="<?php echo $draw;?>" <?php  if(in_array($draw,$arrays)){?> checked <?php } ?> > <?php echo $draw;?><br/>
						<?php } ?>
						</div>
						
						</div>
					  
					  
					  
					  
					  
					  
					  
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="commission mode">Withdraw Option
                        </label>
						
                        <div class="col-md-6 col-sm-6 col-xs-12">
						
						<?php 
						
						
						$array =  explode(',', $settings[0]->withdraw_option);
						
						
						foreach($withdraw as $draw){?>
						<input type="checkbox" name="withdraw_opt[]" value="<?php echo $draw;?>" <?php  if(in_array($draw,$array)){?> checked <?php } ?> > <?php echo $draw;?><br/>
						<?php } ?>
						</div>
						
						</div>
						
						
						
						
						<?php /* ?><?php  if(in_array($draw,$narray)){?> checked <?php } ?><?php */?>
						
						<div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Min. Withdraw Amount</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="withdraw_amt" type="text" name="withdraw_amt" value="<?php echo $settings[0]->withdraw_amt; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  
                        </div>
                      </div>
						
						
						
					  
					  <input type="hidden" name="currentlogo" value="<?php echo $settings[0]->site_logo;?>">
					  
					  
					  <input type="hidden" name="currentfav" value="<?php echo $settings[0]->site_favicon;?>">
					  
					  <input type="hidden" name="currentban" value="<?php echo $settings[0]->site_banner;?>">
					 
					  
					  
					  
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="commission mode">Approve Jobs <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						
						<select name="approve_requests" id="approve_requests" class="form-control" required="required">
						<option value="">Select</option>
									<option value="yes" <?php { if($settings[0]->approve_requests=="yes") echo "selected='selected'"; }?>>Yes</option>
									<option value="no" <?php { if($settings[0]->approve_requests=="no") echo "selected='selected'"; }?>>No</option>
								</select>
						
                          
                        </div>
                  </div>
					  
					  
					   <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Minimum Skills</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="min_skills" type="text" name="min_skills" value="<?php echo $settings[0]->min_skills; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
						
						
						<div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Maximum Skills</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="max_skills" type="text" name="max_skills" value="<?php echo $settings[0]->max_skills; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
						
					  
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payment mode">Social Login Option
                        </label>
						
                        <div class="col-md-6 col-sm-6 col-xs-12">
						
						<?php 
						
						
						$arrays_new =  explode(',', $settings[0]->social_login_option);
						
						
						foreach($socialopt as $draww){?>
						<input type="checkbox" name="social_opt[]"  value="<?php echo $draww;?>" <?php  if(in_array($draww,$arrays_new)){?> checked <?php } ?> > <?php echo $draww;?><br/>
						<?php } ?>
						</div>
						
						</div>
					  
					  
					  
					  
					  
					  <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Featured Job Price</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="featured_gig_price" type="text" name="featured_gig_price" value="<?php echo $settings[0]->featured_gig_price; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
					  <input id="featured_days" type="hidden" name="featured_days" value="10">
					  
					  <?php /* ?><div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Featured Job Days</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="featured_days" type="text" name="featured_days" value="<?php echo $settings[0]->featured_days; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div><?php */?>
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Processing Fee <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="processing_fee" class="form-control col-md-7 col-xs-12"  name="processing_fee" value="<?php echo $settings[0]->processing_fee; ?>" required="required" type="text">
                        
					   </div>
                      </div>
					  
					  
					  
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <a href="<?php echo $url;?>/admin/settings" class="btn btn-primary">Cancel</a>
						  <?php if(config('global.demosite')=="yes"){?><button type="button" class="btn btn-success btndisable">Submit</button> 
								<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
						  
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
								<?php } ?>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
			  
		
		
		
		
		
		
		
		
		
		
		
		
		
		
        <!-- /page content -->

      @include('admin.footer')
      </div>
    </div>

    
	
  </body>
</html>

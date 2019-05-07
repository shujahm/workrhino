<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	




</head>
<body>

    

    <!-- fixed navigation bar -->
    @include('header')

    <!-- slider -->
    

	
    
	
	
	
	
	
	
	
	<div class="clearfix sv_mob_clearfix"></div>
	
	
	
	
	
	<div class="video">
	<div class="clearfix sv_mob_clearfix"></div>
	<div class="headerbg">
	 <div class="col-md-12" align="center"><h1>Send Message</h1></div>
	 </div>
	<div class="container">
	
	 <div class="height30"></div>
	 <div class="row">
	<div class="col-md-12">
	
	
	
	
	
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
			   
			   <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('send-message') }}" id="formID" enctype="multipart/form-data">
                        {{ csrf_field() }}
						
						
						
						 <div class="form-group">
                            <label for="name" class="col-md-4 control-label">To : </label>

                            <div class="col-md-6">
                                <?php echo $receive_user[0]->name;?>

                                
                            </div>
                        </div>
						
						<div class="clearfix height20"></div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Your Message : </label>

                            <div class="col-md-6">
                                <textarea class="form-control validate[required]" style="min-height:200px;" name="message_txt" autofocus></textarea>

                                
                            </div>
                        </div>
						
						<input type="hidden" name="sender" value="<?php echo $sender;?>">
						<input type="hidden" name="receiver" value="<?php echo $receiver;?>">
						
						<?php if($receive_user[0]->admin==0) { $typer = "customer"; } else if($receive_user[0]->admin==2){ $typer = "seller"; } else if($receive_user[0]->admin==1){ $typer = "admin"; } ?>
						<input type="hidden" name="send_by" value="<?php echo $typer;?>">
						
						<div class="clearfix height20"></div>
						
						
						 <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
							
							<?php if(config('global.demosite')=="yes"){?><button type="button" class="btn btn-primary btndisable">Update</button> <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
							
                                <button type="submit" class="btn btn-primary">
                                    Send
                                </button>
							<?php } ?>
                            </div>
                        </div>
						
						
	
	</form>
	</div>
	          
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	</div>
	
	
	
	
	</div>
	
	</div>
	</div>
	
	
	

      <div class="clearfix"></div>
	   <div class="clearfix"></div>

      @include('footer')
</body>
</html>
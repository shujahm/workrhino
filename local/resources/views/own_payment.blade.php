<?php
	use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");


?>
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
	 <div class="col-md-12" align="center"><h1>Thank you for your payment!</h1></div>
	 </div>
	<div class="container">
	<div class="height50"></div>
	 
	
	<div class="container">
	
	 <div class="height30"></div>
	 <div class="row">
	
	@if(Session::has('success'))
<div class="col-md-12">
	    <div class="alert alert-success">

	      {{ Session::get('success') }}

	    </div>
</div>
	@endif
	
	
	
	@if(Session::has('error'))
<div class="col-md-12">
	    <div class="alert alert-danger">

	      {{ Session::get('error') }}

	    </div>
</div>
	@endif
	
	<div class="col-md-12">
	
	
	<div class="font25">So what's going to happen next?</div>
	
	<div class="height20"></div>
	<ul type="disc">
	
	
	<div class="height20"></div>
	<div>
	
	<p><li> You can track job on  <a href="<?php echo $url;?>/buyer_track/<?php echo $track_id;?>" style="color:blue;">click here</a></li></p>
	</div>
	</ul>
	<div class="height20"></div>
	
	
	
	
	</div>
	
	
	
	
	</div>
	
	</div>
	
	
	
	
	
	
	
	
	</div>
	</div>
	
	
	<div class="height100"></div>

      <div class="clearfix"></div>
	   <div class="clearfix"></div>
    
	
	

      @include('footer')
</body>
</html>
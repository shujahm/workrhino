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

    
	<div class="clearfix sv_mob_clearfix"></div>
	
	
	
	
	
	<div class="video">
	<div class="clearfix sv_mob_clearfix"></div>
	<div class="headerbg">
	 <div class="col-md-12" align="center"><h1>Fund Now!</h1></div>
	 </div>
	<div class="container">
	 
	 
	 
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
	 
	 
	 
	 <?php if(!empty($gig_counter)){?>
	 
	 
	 <form action="{{ route('order') }}" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}
	<?php if(!empty($req_proposal_count))
	{
		$price = $req_proposal_get[0]->bid_price;
		$bidded_id = $req_proposal_get[0]->prop_user_id;
	}
	else
	{
		$price = "";
		$bidded_id = "";
	}
	?>
	
	<input type="hidden" name="price" value="<?php echo $price;?>">
	<input type="hidden" name="gig_type" value="">
	
	<input type="hidden" name="gig_id" value="<?php echo $gig_details[0]->gid;?>">
	<input type="hidden" name="gig_name" value="<?php echo $gig_details[0]->subject;?>">
	
	
	
	<h3 class="orange"><?php echo $gig_details[0]->subject;?></h3>
	<div class="font18"><?php echo $gig_details[0]->description;?></div>
	<div class="height50"></div>
	
	<div class="text-left font25">Fund price: <strong><?php echo $site_setting[0]->site_currency.' '.$price;?></strong></div>
	<div class="height20"></div>
	
	
	<div class="newbtn">
	<input type="submit" name="submit" class="btn btn-primary" value="Pay Now">
	</div>
	
	

	</form>
	
	<?php } else { ?>
	<div class="height100"></div>
	<div align="center"><h2>No Data Found!</h2></div>
	
	<?php } ?>
	</div>
	</div>
	
	
	
	

      <div class="height100 clearfix"></div>
	   <div class="clearfix"></div>

	

      @include('footer')
</body>
</html>
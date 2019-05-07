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
	
	
	
	<?php 
	echo $user_details;
	if(!empty($user_details)){
		$user = DB::table('users')
						->where('id', '=', $id)
						->get();
		?>
	
	<div class="video">
	
	<div class="headerbg">
	 <div class="col-md-12" align="center"><h1><?php echo $user[0]->name;?> - Profile</h1></div>
	 </div>
	<div class="container">
	
	 <div class="height30"></div>
	 
	 <div class="col-md-2"></div>
	 <div class="col-md-8">
	 
	 
	<div class="col-md-6 ">
			<div class="profile-sidebar">
				
				<div class="profile-userpic">
				<?php 
				$url = URL::to("/");
				$userphoto="/userphoto/";
						$path ='/local/images'.$userphoto.$user[0]->photo;
						if($user[0]->photo!=""){?>
					<img src="<?php echo $url.$path;?>" class="img-responsive" alt="">
						<?php } else { ?>
						<img src="<?php echo $url.'/local/images/nophoto.jpg';?>" class="img-responsive" alt="">
						<?php } ?>
				</div>
	         </div>
	</div>
	
	<div class="col-md-6 ">
	<?php if($user[0]->admin==2){ $use = "Vendor"; } else if($user[0]->admin==0){ $use = "Customer"; } else { $use = "Admin"; } ?>
	<div class="fonter"><span>Name      : </span> <?php echo $user[0]->name;?></div><br/>
	<div class="fonter"><span>User Type : </span> <?php echo $use;?></div><br/>
	<div class="fonter"><span>Gender    : </span> <?php echo $user[0]->gender;?></div>
	
	</div>
	
	</div>
	<div class="col-md-2"></div>
	
	
	</div>
	
	</div>
	</div>
	<?php } ?>
	
	

      <div class="clearfix"></div>
	   <div class="clearfix"></div>

      @include('footer')
</body>
</html>
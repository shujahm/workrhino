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
	<div class="clearfix height30 sv_mob_clearfix"></div>
	<div class="headerbg">
	 <div class="col-md-12" align="center"><h1>CONVERSATION WITH <?php echo $users[0]->name;?></h1></div>
	 </div>
	
	
	<div class="clearfix height50"></div>
	<div class="container">
	
	
	
	<div class="row">
	
	<div class="col-md-12">
	
	
	<?php 
	
	if(!empty($checkvel))
		{
			DB::table('conversations')
			             ->where('id', '=', $checkvel)
						 ->get();
						 if($view_msg[0]->read_write_status==1)
						 {
							 $checker = 0;
						 }
						 else
						 {
							 $checker ="";
						 }
			DB::update('update conversations set read_write_status="'.$checker.'" where id = ?', [$checkvel]);
		}
	?>
	
	<?php
	if(!empty($view_msg_cnt)){?>
	<?php foreach($view_msg as $view){
		$userid = $view->sender;
		$gigid = $view->gig_id;
		$viewgig = DB::table('gigs')
				->where('gid', '=', $gigid)
				->get();
				
		$viewgig_cnt = DB::table('gigs')
				->where('gid', '=', $gigid)
				->count();	
				
				
		$userr = DB::table('users')
				->where('id', '=', $userid)
				->get();
				$userr_cnt = DB::table('users')
				->where('id', '=', $userid)
				->count();
	
	?>
	
		
	<div class="gallerybox text-left clearfix" style="height:auto !important;">
	
	
	<?php if(!empty($userr_cnt)){ ?>
	<div class="col-md-2 text-center">
	<a href="<?php echo $url;?>/user/<?php echo $userr[0]->id;?>/<?php echo $userr[0]->name;?>">
	<?php 
	
	if(!empty($userr[0]->photo)){?>
				 <img src="<?php echo $url;?>/local/images/userphoto/<?php echo $userr[0]->photo;?>" width="70" class="round">
				 <?php } else { ?>
				 <img src="<?php echo $url;?>/local/images/nophoto.jpg" alt="" width="70" class="round">
				 <?php }  ?>
				 </a>
				 
				 
				 <strong class="font18"><?php echo $userr[0]->name;?></strong>
	</div>
	<?php
	if($viewgig[0]->job_type!="request")
	{
		$cust_url = "<a href='".$url."/service/".$view->gig_id."'>".$viewgig[0]->subject."</a>";
	}
	else
	{
		$cust_url = $viewgig[0]->subject;
	}
	?>
	<div class="col-md-8">
	<div class="height30"></div>
	<?php if(!empty($viewgig_cnt)){?><div class="sv_msg">This message is related to your job "<?php echo $cust_url;?>" </div><?php } ?>
	
	<div><?php echo $view->message;?></div>
	<div><a href="<?php echo $url;?>/local/images/gigs/<?php echo $view->file;?>" download><?php echo $view->file;?></a></div>
	
	</div>
	
	<div class="col-md-2"><div class="height30"></div>
	<?php echo $view->date_submitted;?>
	</div>
	
	
	<?php } ?>
	
	</div>
	<div class="clearfix height20"></div>
	<?php } ?>
	<?php } ?>
	
	
	
	
	<div>
	<div class="btn btn-primary sv_send_message">Send a Message</div> 
	
	<div class="conversation_bg">
	<form action="{{ route('conversations') }}" method="post" id="formID" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class='form-group card required'>
                  <label class='control-label'>Message</label>
                <textarea autocomplete='off' name="msg" class='form-control validate[required] c_convert'></textarea>
              </div>
	<div class='form-group card required'>
                  <label class='control-label'>Add a file attachment</label>
                <input type="file" name="photo" class="form-control" />
				<p>Accepted File Formats: jpeg, jpg, gif, png, tif, bmp, avi, mpeg, mpg, mov, rm, 3gp, flv, 
				mp4, zip, rar, mp3, wav, wma and ogg</p>
              </div>
			  
	<input type="hidden" name="gig_user_id" value="<?php echo $gig_user;?>">
	<input type="hidden" name="log_user_id" value="<?php echo $log_id;?>">
	<input type="hidden" name="gig_id" value="<?php echo $gig_id;?>">
	
	<div class='form-group card required'>
	<input type="submit" name="csubmit" value="Submit" class="btn btn-success">
    </div>	
	
	</form>
	
	</div>
	
	
	
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	</div>
	
	
	
	
	
	
	
	
	
	<div class="col-md-4">
	<?php if(!empty($site_setting[0]->job_advertisement)){?>
	<div class="gallerybox clearfix text-center">
	<div class="height10"></div>
	<?php echo html_entity_decode($site_setting[0]->job_advertisement);?>
	<div class="height10"></div>
	</div>
	<?php } ?>
	</div>
	
	</div>
	
	
	
	
	
	
	
	
	
	</div>
	
	
	
	 <div class="height50 clearfix"></div>
	
	</div>
	
	
	<div class="height100"></div>

      <div class="clearfix"></div>
	   <div class="clearfix"></div>
    
	
	

      @include('footer')
</body>
</html>
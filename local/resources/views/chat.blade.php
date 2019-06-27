 
<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	


<script type="text/javascript">
$(window).load(function() {
  $(".msgboxes").animate({ scrollTop: $(document).height() }, 1000);
  
});
</script>

</head>
<body>

    <?php $url = URL::to("/"); ?>

    <!-- fixed navigation bar -->
    @include('header')

    <!-- slider -->

	<?php $check_shop = DB::table('shop')
							->where('user_id', '=', $sender)
							->count();
		$user_cnt = DB::table('users')
                             ->where('id','=',$sender)
                             ->count();	
  if(!empty($user_cnt))
  {	  
    $userr = DB::table('users')
			->where('id','=',$sender)
			->get();
	if($userr[0]->admin==2)
			{
				if(!empty($check_shop))
				{
				$pather = $url."/rhino/".$userr[0]->name;
				$class="";
				}
				else
				{
					$pather="#";
					$class="hideclass";
				}
			}
			else
			{
				$pather = $url."/user/".$userr[0]->id.'/'.$userr[0]->name;
				$class="";
			} 
			
  }		
			?>
	<div class="video">

	<div class="headerbg">
	 <div class="col-md-12" align="center"><h2>Conversations With <span class="black"><a href="<?php echo $pather;?>" class="black <?php echo $class;?>"><?php echo $usernamo;?></a></span></h2></div>
	 </div>
	<div class="container">
	 
	 <div class="height30"></div>
	 
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
	<div class="container">
	
	
	<div style="max-height:700px; overflow-y:scroll; bottom: auto; top: 3px;" class="msgboxes col-md-12">
	
	 
	<?php if(!empty($view_message_count)){?>
	
	
	<?php foreach($view_message as $view){
		
		$userr = DB::table('users')
				->where('id', '=', $view->sender)
				 ->get();
				$userr_cnt = DB::table('users')
				->where('id', '=', $view->sender)
				->count();
		
		?>
	
	<?php if(!empty($userr_cnt)){ ?>
	
	<div class="row gallerybox clearfixed text-left" style="margin-bottom:20px;">
	<div class="height10"></div>
	<div class="col-md-2 text-center">
	
	<?php 
	
	if(!empty($userr[0]->photo)){?>
				 <img src="<?php echo $url;?>/local/images/userphoto/<?php echo $userr[0]->photo;?>" width="70" class="round">
				 <?php } else { ?>
				 <img src="<?php echo $url;?>/local/images/nophoto.jpg" alt="" width="70" class="round">
				 <?php }  ?>
				 
				 <br/>
				 
				 <strong class="font18"><?php echo $userr[0]->name;?></strong>
	</div>
	
	
	
	<div class="col-md-8">
	<div class="height20"></div>
	<?php echo $view->message;?>
	</div>
	
	<div class="col-md-2">
	<div class="height20"></div>
	<?php echo $view->submitted;?>
	</div>
	
	</div>
	
	
	<?php } ?>
	<?php } ?>
	<?php } ?>
	
	</div>
	
	
	</div>
	
	
	<div class="height20"></div>
	<div class="container">
	<div class="btn btn-primary sv_send_message">Send a Message</div> 
	
	<div class="conversation_bg">
	<form action="{{ route('chat') }}" method="post" id="formID" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="form-group card required">
                  <label class="control-label">Message</label>
                <textarea autocomplete="off" name="msg" class="form-control validate[required] c_convert" style="min-height:200px;"></textarea>
              </div>
	
			  
	<input type="hidden" name="sender" value="<?php echo $receiver;?>">
	<input type="hidden" name="receiver" value="<?php echo $sender;?>">
	
	
	<div class="form-group card required">
	<a href="<?php echo $url;?>/messages" class="btn btn-primary">Back</a>
	<input type="submit" name="csubmit" value="Submit" class="btn btn-success">
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
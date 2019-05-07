 
<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	




</head>
<body>

    <?php $url = URL::to("/"); ?>

    <!-- fixed navigation bar -->
    @include('header')

    <!-- slider -->

	<div class="video">

	<div class="headerbg">
	 <div class="col-md-12" align="center"><h1>My Messages</h1></div>
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
	
	
	
	
	 
	<div class="row">
	<div class="table-responsive">
	<table class="table">
  <thead>
    <tr>
      <th>Sno</th>
	  <th>Photo</th>
      <th>Username</th>
      
      
    </tr>
  </thead>
  <tbody class="pagenavigation">
  
  <?php 
  if(!empty($view_message_count)){
  $i=1;
  foreach($view_message as $message)
  {
	  
   $receiver_id = $message->receiver;
   $receive_user = DB::table('users')
               ->where('id', '=', $receiver_id)
                ->get(); 
$logid = Auth::user()->id;
   $view_unread_count = DB::table('tbl_private_message')
                        ->where('sender', '=', $receiver_id)
						->where('receiver', '=', $logid)
						->where('read_status', '=', 1)
						
						->orderBy('pid','desc')
                        ->count();
					
  ?>
  
    <tr>
      <th><?php echo $i;?></th>
      <td>
	  <?php 
				$url = URL::to("/");
				$userphoto="/userphoto/";
						$path ='/local/images'.$userphoto.$receive_user[0]->photo;
						if($receive_user[0]->photo!=""){?>
					<a href="<?php echo $url;?>/chat/<?php echo $receiver_id;?>" title="<?php echo $receive_user[0]->name;?>"><img src="<?php echo $url.$path;?>" class="img-responsive round" alt=""></a>
						<?php } else { ?>
						<a href="<?php echo $url;?>/chat/<?php echo $receiver_id;?>" title="<?php echo $receive_user[0]->name;?>"><img src="<?php echo $url.'/local/images/nophoto.jpg';?>" class="img-responsive round" alt="">
						<?php } ?></a>
	  </td>
      <td>
	  <div class="height30"></div>
	  <a href="<?php echo $url;?>/chat/<?php echo $receiver_id;?>"><?php echo $receive_user[0]->name;?><?php if(!empty($view_unread_count)){?> <span class="countes"><?php echo $view_unread_count;?></span><?php } ?></a>
	  </td>
      
	  
    </tr>
  <?php $i++; } ?>
  <?php } ?>
    
	
	
	
  </tbody>
</table>
	</div>
	
	<div class="pagee"></div>
	
	
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
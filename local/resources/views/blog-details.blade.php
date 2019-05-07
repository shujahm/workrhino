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
	
	
	<?php if(!empty($count)){?>
	<?php 
	
	 $get = DB::table('blog')
		         ->where('id','=',$id)
				 
				 ->get();
	$previous = DB::table('blog')
					->where('id', '<', $get[0]->id)->max('id');

    
        $next = DB::table('blog')
		       ->where('id', '>', $get[0]->id)->min('id');			 
				 ?>
	
	<div class="video">
	<div class="clearfix sv_mob_clearfix"></div>
	<div class="headerbg">
	 <div class="col-md-12" align="center"><h1><?php echo substr($get[0]->name,0,150);?></h1></div>
	 </div>
	<div class="container">
	
	 <div class="height30"></div>
	 
	 
	 
	 <div class="row">
	 
	 <div class="col-md-9">
	 
	 <div>
	 <?php if($get[0]->image!=""){?>
	<a href="<?php echo $url;?>/blog-details/<?php echo $get[0]->id;?>"><img src="<?php echo $url;?>/local/images/blog/<?php echo $get[0]->image;?>" border="0" class="img-responsive"></a>
	<?php } else { ?>
	<a href="<?php echo $url;?>/blog-details/<?php echo $get[0]->id;?>"><img src="<?php echo $url;?>/local/images/noimage.jpg" border="0" class="img-responsive"></a>
	<?php } ?>
	 </div>
	 
	 <div class="height20"></div>
	 <div>
	 
	 <h3 style="margin-top:0px;" class="colorr"><?php echo $get[0]->name;?></h3>
	 <span style="font-style:italic;"><?php echo date("d M Y",strtotime($get[0]->post_date));?></span>
	<p style="margin-top:10px; "><?php echo html_entity_decode($get[0]->description);?></p>
	 </div>
	 
	 <div class="height20"></div>
	 <div>
	 <div class="col-md-6 text-left paddingoff"><?php if(!empty($previous)){?><a href="<?php echo $url;?>/blog-details/<?php echo $previous;?>" class="btn borbtn">Previous</a><?php } ?></div>
	 <div class="col-md-6 text-right paddingoff"><?php if(!empty($next)){?><a href="<?php echo $url;?>/blog-details/<?php echo $next;?>" class="btn borbtn">Next</a><?php } ?></div>
	 </div>
	 
	 </div>
	 
	 
	 <div class="col-md-3">
	 <h3>Latest Post</h3>
	 <div class="height20"></div>
	 <?php if(!empty($gcount)){
		 
		 $gget = DB::table('blog')
		         
				 ->orderBy('id', 'desc')
				 ->take(5)
				 ->get();
				 foreach($gget as $blog){ 
		 ?>
	 <div class="row">
	 
	 
	<div class="col-md-4">
	<?php if($blog->image!=""){?>
	<a href="<?php echo $url;?>/blog-details/<?php echo $blog->id;?>"><img src="<?php echo $url;?>/local/images/blog/<?php echo $blog->image;?>" border="0" class="img-responsive"></a>
	<?php } else { ?>
	<a href="<?php echo $url;?>/blog-details/<?php echo $blog->id;?>"><img src="<?php echo $url;?>/local/images/noimage.jpg" border="0" class="img-responsive"></a>
	<?php } ?>
	</div>
	
	<div class="col-md-8">
	<a href="<?php echo $url;?>/blog-details/<?php echo $blog->id;?>" class="gcolorr"><?php echo $blog->name;?></a>
	<br/>
	<span style="font-style:italic;"><?php echo date("d M Y",strtotime($blog->post_date));?></span>
	
	</div>
	
	</div>
	<div class="height20"></div>
	
	 
				 <?php } } ?>
	 </div>
	
	
	</div>
	 
	
	
	<div class="height40"></div>
	
		
	
	
	
	
	
	</div>
	</div>
	
	<?php } ?>
	
	
	

      <div class="clearfix"></div>
	   <div class="clearfix"></div>

      @include('footer')
</body>
</html>
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
	
	
	
	
	
	<div class="video">
	<div class="clearfix sv_mob_clearfix"></div>
	<div class="headerbg">
	 <div class="col-md-12" align="center"><h1>Blog</h1></div>
	 </div>
	<div class="container">
	
	 <div class="height30"></div>
	 <div class="pagenavigation">
	 
	 <?php if(!empty($count)){
		$view_blog = DB::table('blog')
		         
				 ->orderBy('id', 'desc')
				 ->get();
        foreach($view_blog as $blog){  				 
		 ?>
	 <div class="row">
	 
	 
	<div class="col-md-3">
	<?php if($blog->image!=""){?>
	<a href="<?php echo $url;?>/blog-details/<?php echo $blog->id;?>"><img src="<?php echo $url;?>/local/images/blog/<?php echo $blog->image;?>" border="0" class="img-responsive"></a>
	<?php } else { ?>
	<a href="<?php echo $url;?>/blog-details/<?php echo $blog->id;?>"><img src="<?php echo $url;?>/local/images/noimage.jpg" border="0" class="img-responsive"></a>
	<?php } ?>
	</div>
	
	<div class="col-md-9">
	<h3 style="margin-top:0px;"><a href="<?php echo $url;?>/blog-details/<?php echo $blog->id;?>" class="colorr"><?php echo $blog->name;?></a></h3>
	<p><?php echo html_entity_decode(substr($blog->description,0,700));?></p>
	<span style="font-style:italic;"><?php echo date("d M Y",strtotime($blog->post_date));?></span>
	
	</div>
	<div class="height40"></div>
	</div>
	
	
	
		<?php } } ?>
	
	</div>
	
	<div class="pagee"></div>
	
	
	
	</div>
	</div>
	
	
	

      <div class="clearfix"></div>
	   <div class="clearfix"></div>

      @include('footer')
</body>
</html>
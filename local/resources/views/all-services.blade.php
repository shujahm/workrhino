<?php
/*if (Auth::check())
{
	
}
else
{
	//redirect()->route('login');
	
	echo Redirect::to('login');
}*/
?>   
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
    

	
    
	
	
	
	
	
	
	
	<div class="clearfix sv_mob_clearfix"></div>
	
	
	
	
	
	<div class="video">
	<div class=" clearfix sv_mob_clearfix"></div>
	<div class="headerbg">
	 <div class="col-md-12" align="center"><br/><h1>All Services</h1></div>
	 </div>
	
	
	<div class="container">
	
	 <div class="height30"></div>
	 <div class="row">
	 
	 
	 
	
   <?php if(!empty($user_count)){?>
   
   <div id="products" class="row list-group">
   
   <?php 
   $services = DB::table('services')
			->orderBy('name','asc')
			->get();
   foreach($services as $service){
		$subserve=strtolower($service->name);
			$result_url = preg_replace('/[ ,]+/', '-', trim($subserve));
		?>
        <div class="item  col-md-2 serv">
            <div class="thumbnail">
                
				<?php 
           $servicephoto="/servicephoto/";
						$path ='/local/images'.$servicephoto.$service->image;
						if($service->image!=""){
						?>
	<a href="<?php echo $url; ?>/subservices/<?php echo $result_url;?>"><img src="<?php echo $url.$path;?>" class="group list-group-image img-responsive" style="margin:0 auto;"/></a>
						<?php } else {?>
						<a href="<?php echo $url; ?>/subservices/<?php echo $result_url;?>"><img src="<?php echo $url.'/local/images/noimage.jpg';?>" style="margin:0 auto;" class="group list-group-image img-responsive"></a>
						<?php } ?>
				
                <div class="caption">
                    <h4 class="group inner list-group-item-heading">
                        <a href="<?php echo $url; ?>/subservices/<?php echo $result_url;?>"><?php echo $service->name;?></a></h4>
                   
                    
                </div>
            </div>
        </div>
        <?php } ?>
	   
			
    </div>
	
   <?php } ?>


			                                  
	
	
	
	
	
	</div>
	
	</div>
	</div>
	
	
	

      <div class="clearfix"></div>
	   <div class="clearfix"></div>

      @include('footer')
</body>
</html>
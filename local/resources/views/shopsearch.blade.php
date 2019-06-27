<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	
<style type="text/css">
.noborder ul,li { margin:0; padding:0; list-style:none;}
.noborder .label { color:#000; font-size:16px;}
</style>


<?php
$ip_address=$_SERVER['REMOTE_ADDR'];
$geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip_address;
$addrDetailsArr = unserialize(file_get_contents($geopluginURL));
$city_name = $addrDetailsArr['geoplugin_city'];
$country_name = $addrDetailsArr['geoplugin_countryName'];

?>
</head>
<body>

    <?php $url = URL::to("/"); ?>

    <!-- fixed navigation bar -->
    @include('header')

    <!-- slider -->
    

	
    
	
	
	
	
	
	
	
	<div class="clearfix sv_mob_clearfix"></div>
	
	
	
	
	
	<div class="video">
	<div class="clearfix sv_mob_clearfix"></div>
	<div class="headerbg">
	 <div class="col-md-12" align="center"><h1>Search </h1></div>
	 </div>
	<div class="container">
	 
	 <div class="height30"></div>
	 
	 
	<div class="container">
	<div class="row">
	<form class="form-horizontal" role="form" method="POST" action="{{ route('shopsearch') }}" id="formID" enctype="multipart/form-data">
   <div class="col-md-12">
   {!! csrf_field() !!}
   
   
   
  
   
	<div class="col-md-4 swidth noborder" >
	
		<?php //if(!empty($serid[0]->subid)){ echo $serid[0]->subid; }
		
		?>
		<?php
	if(!empty($selservice))
	{
	$arrays =  explode(',', $selservice);
	}
	?>		
				<select name="langOpt[]" multiple id="langOpt" class="validate[required]">
				<?php 
				
				foreach($viewservices as $service){
					$sel=explode(",",$viewnames);
						
						
						
						
					?>
					
                <option value="<?php echo $service->subid;?>"  <?php if(!empty($selservice)){ if(in_array($service->subid,$arrays)){?> selected <?php }  } ?>    ><?php echo $service->subname;?></option>
                <?php } ?>
                </select>
	
	</div>
	
	
	
	<div class="col-md-3 swidth nocity">	
		
		<input type="text"  name="city" id="txtPlaces" class="form-control" placeholder="Enter City" value="<?php echo $city_name; ?>">
	</div>	
	
	
	<div class="col-md-3 swidth nocity">
	<select name="star_rate" class="form-control">
	<option value="">Star Rating</option>
	<option value="1" <?php if(!empty($star_rate)) { if($star_rate==1){?> selected <?php } } ?>>1 Star</option>
	<option value="2" <?php if(!empty($star_rate)) { if($star_rate==2){?> selected <?php } } ?>>2 Stars</option>
	<option value="3" <?php if(!empty($star_rate)) { if($star_rate==3){?> selected <?php } } ?>>3 Stars</option>
	<option value="4" <?php if(!empty($star_rate)) { if($star_rate==4){?> selected <?php } } ?>>4 Stars</option>
	<option value="5" <?php if(!empty($star_rate)) { if($star_rate==5){?> selected <?php } } ?>>5 Stars</option>
	</select>
	</div>
	
	
	<div class="col-md-2 custobtn">
		                       
							   
                                <button type="submit" class="btn btn-success btn-md">
                                    Filter
                                </button>
                           
		</div>
	
	
	
	</div>
	
	
	
	
	
	</form>
	
	</div>
	
	
	
	</div>
	
	</div>
	<div class="notopborder"></div>
	<div class="container">
	
	<div class="container">
	
	
	
	
	
	
	<div class="clearfix"></div>
	
	<?php /* ?><?php if(!empty($count)) { if(!empty($viewnames)){?><div><h4 style="line-height:25px;">Search Result : <?php echo $viewnames;?></h4></div><?php } } ?><?php */?>
	
	
	
	
	
	
	 
	
	<?php if(!empty($count)) {
		
		
		
		if(!empty($category))
	 {
		$newlang = ""; 
	foreach($category as $langs)
		 {
			 
			 $newlang .=$langs.",";
			
		 }
		 
		 $selservice =rtrim($newlang,",");
			 
		 
     $newsearches = DB::table('shop')
		->leftJoin('seller_services', 'seller_services.shop_id', '=', 'shop.id')
		->leftJoin('rating', 'rating.rshop_id', '=', 'shop.id')
		->leftJoin('users', 'users.email', '=', 'shop.seller_email')
		->whereRaw('FIND_IN_SET(seller_services.subservice_id,"'.$selservice.'")')
		
		
		->where('shop.status', '=', "approved")
		
		 ->groupBy('seller_services.shop_id')
		 
         ->get();	
		 
		 $return = 1;
	 }
	 
	 
	 if(!empty($city))
	 {
		 
		 $city_valuee = "'%".$city."%'";
		 $approved = "approved";
		 /*$newsearches = DB::table('shop')
		->leftJoin('seller_services', 'seller_services.shop_id', '=', 'shop.id')
		->leftJoin('rating', 'rating.rshop_id', '=', 'shop.id')
		->leftJoin('users', 'users.email', '=', 'shop.seller_email')
		->where('shop.status', '=', "'".$approved."'")
			->where('shop.address','LIKE',$city_valuee)
			 ->groupBy('shop.id')
		     ->get();*/
		 
		 $newsearches = DB::SELECT("select * from shop left join seller_services on seller_services.shop_id = shop.id left join rating on rating.rshop_id = shop.id left join users on users.email = shop.seller_email where shop.status = '".$approved."' and shop.address LIKE {$city_valuee} group by shop.id");
		 
		 
		 
		 
		 $return = 2;
	 }
	 
	 
	 if(!empty($star_rate))
	 {
		 
		 
		 
		 
	 $newsearches = DB::table('shop')
		->leftJoin('seller_services', 'seller_services.shop_id', '=', 'shop.id')
		->leftJoin('rating', 'rating.rshop_id', '=', 'shop.id')
		->leftJoin('users', 'users.email', '=', 'shop.seller_email')
		->where('shop.status', '=', "approved")
			->where('rating.rating','=', $star_rate)
			 ->groupBy('seller_services.shop_id')
		 
         ->get();
		 $return = 3;
	 }
	 
	 
	 
	 if(!empty($city) && !empty($star_rate))
		{
		 $city_valuee = "'%".$city."%'";
		 $approved = "approved";
		 
		 $newsearches = DB::SELECT("select * from shop left join seller_services on seller_services.shop_id = shop.id left join rating on rating.rshop_id = shop.id left join users on users.email = shop.seller_email where shop.address LIKE {$city_valuee} and rating.rating = '".$star_rate."' and shop.status = '".$approved."' group by shop.id");
		 
		$return = 4;

		}
		
		
		
		
		 if(!empty($category) && !empty($star_rate) && !empty($city))
		 {
			 
			 $newlang = ""; 
	   foreach($category as $langs)
		 {
			 
			 $newlang .=$langs.",";
			
		 }
		 
		 
		 $city_valuee = "'%".$city."%'";
		 $approved = "approved";
		 $selservice =rtrim($newlang,",");
		
		 
		 $newsearches = DB::SELECT("select * from shop left join seller_services on seller_services.shop_id = shop.id left join rating on rating.rshop_id = shop.id left join users on users.email = shop.seller_email where FIND_IN_SET(seller_services.subservice_id,'".$selservice."') and shop.address LIKE {$city_valuee} and rating.rating = '".$star_rate."' and shop.status = '".$approved."' group by shop.id");
		 
		 
		 
		 $return = 5;
		 }
		 
		 
		 
		 if(!empty($category) && !empty($city))
		 {
			 
			 $newlang = ""; 
	   foreach($category as $langs)
		 {
			 
			 $newlang .=$langs.",";
			
		 }
		 
		 $city_valuee = "'%".$city."%'";
		 $approved = "approved";
		 $selservice =rtrim($newlang,",");
		 
		$newsearches = DB::SELECT("select * from shop left join seller_services on seller_services.shop_id = shop.id left join rating on rating.rshop_id = shop.id left join users on users.email = shop.seller_email where FIND_IN_SET(seller_services.subservice_id,'".$selservice."') and shop.address LIKE {$city_valuee} and shop.status = '".$approved."' group by seller_services.shop_id"); 
		 
		 
		 
			 
		 $return = 6;
		 }
		 
		 
		 
		 
		 if(!empty($category) && !empty($star_rate) && empty($city))
		 {
			 
			 $newlang = ""; 
	   foreach($category as $langs)
		 {
			 
			 $newlang .=$langs.",";
			
		 }
		 
		 $approved = "approved";
		 $selservice =rtrim($newlang,",");
			 
		 
		 
		 
		 $newsearches =  DB::SELECT("select * from shop left join seller_services on seller_services.shop_id = shop.id left join rating on rating.rshop_id = shop.id left join users on users.email = shop.seller_email where FIND_IN_SET(seller_services.subservice_id,'".$selservice."') and rating.rating = '".$star_rate."' and shop.status = '".$approved."' group by seller_services.shop_id");
		 
		 
		 
		 $return = 7;
		 }
		 
		 
		 
		 if(empty($category) && empty($city) && empty($star_rate)) {
			 
			 $approved = "approved";
			$newsearches = DB::table('shop')
		 ->leftJoin('users', 'users.email', '=', 'shop.seller_email')
		 ->leftJoin('rating', 'rating.rshop_id', '=', 'shop.id')
		 ->where('shop.status', '=', "'".$approved."'")->orderBy('shop.id','desc')->groupBy('shop.id')->get();
			 $return = 8;
		 }
     
	
	?>
	<div class="row">
	<div class="col-md-12">
	<div class="clearfix"></div>
	<?php 
	
	foreach($newsearches as $shop){ 
	
	?>
	
	
	<div class="col-md-4">
		<div class="shop-list-page">
			<div class="shop_pic">
			<?php 
					   $shopphoto="/shop/";
						$paths ='/local/images'.$shopphoto.$shop->cover_photo;
						if($shop->cover_photo!=""){
						?>
						<a href="<?php echo $url; ?>/vendor/<?php echo $shop->name;?>" ><img src="<?php echo $url.$paths;?>" class="img-responsive imgservice"></a>
						<?php } else { ?>
						<a href="<?php echo $url; ?>/vendor/<?php echo $shop->name;?>" ><img src="<?php echo $url.'/local/images/no-image-big.jpg';?>" class="img-responsive imgservice"></a>
						<?php } ?>
			</div>
			
			
			
			<div class="col-lg-12 imgthumb">
			<?php 
						$npaths ='/local/images'.$shopphoto.$shop->profile_photo;
						if($shop->profile_photo!=""){?>
        <img align="center" class="sthumb" src="<?php echo $url.$npaths;?>" alt="Profile Photo"/>
						<?php } else { ?>
						<img align="center" class="sthumb" src="<?php echo $url.'/local/images/nophoto.jpg';?>" alt="Profile Photo"/>
						<?php } ?>
			</div>
			
			<?php
		if($shop->rating=="")
		{
			$starpath = '/local/images/nostar.png';
		}
		else {
		$starpath = '/local/images/'.$shop->rating.'star.png';
		}
		
		
		?>
			
			<div class="col-lg-12 shop_content">
				<h4 class="sv_shop_style"><a href="<?php echo $url; ?>/vendor/<?php echo $shop->name;?>" ><?php echo $shop->shop_name; ?></a></h4>
				<img src="<?php echo $url.$starpath;?>" alt="rated <?php if($shop->rating==""){ echo "0"; } else { echo $shop->rating; }?> stars"  class="star_rates" />
				<?php /* ?><h5><span class="lnr lnr-map-marker"></span>&nbsp;<?php echo $shop->city; ?></h5><?php */?>
				
				<?php 				
					if($shop->start_time>12)
					{
						$start=$shop->start_time-12;
						$stime=$start."PM";
					}
					else
					{
						$stime=$shop->start_time."AM";
					}
					if($shop->end_time>12)
					{
						$end=$shop->end_time-12;
						$etime=$end."PM";
					}
					else
					{
						$etime=$shop->end_time."AM";
					}
				?>
				<h5><span class="lnr lnr-clock"></span>&nbsp; <?php echo $stime; ?> - <?php echo $etime; ?></h5>
							
				<div align="center"><a href="vendor/<?php echo $shop->name;?>" class="btn btn-success radiusoff" style="background-color:#FFCC16; color:black !important; border-color:#FFCC16;">View Shop & Book</a></div>
			</div> 
			
			
	    </div>
	</div>	
	
	<?php }?>
    </div>


	
	<div class="col-md-6" style="display:none;">
	<?php 
	$wel_count = count($newsearches);
	if(!empty($wel_count)){?>
	<div id="map_canvas" style="width:100%; min-height:700px; margin-top:30px; display:none;"></div>
    <?php } ?>
	
  <script type="text/javascript">


    
var locations = [
<?php foreach($newsearches as $shop){ ?>
    ['<?php echo $shop->shop_name;?>', '<?php echo $shop->address;?>', '<?php echo $url;?>/vendor/<?php echo $shop->name;?>'],
<?php } ?>    
];

var geocoder;
var map;
var bounds = new google.maps.LatLngBounds();

function initialize() {
    map = new google.maps.Map(
    document.getElementById("map_canvas"), {
        center: new google.maps.LatLng(),
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    geocoder = new google.maps.Geocoder();

    for (i = 0; i < locations.length; i++) {


        geocodeAddress(locations, i);
    }
}
google.maps.event.addDomListener(window, "load", initialize);

function geocodeAddress(locations, i) {
    var title = locations[i][0];
    var address = locations[i][1];
    var url = locations[i][2];
    geocoder.geocode({
        'address': locations[i][1]
    },

    function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var marker = new google.maps.Marker({
                icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
                map: map,
                position: results[0].geometry.location,
                title: title,
                animation: google.maps.Animation.DROP,
                address: address,
                url: url
            })
            infoWindow(marker, map, title, address, url);
            bounds.extend(marker.getPosition());
            map.fitBounds(bounds);
        } else {
            //alert("geocode of " + address + " failed:" + status);
        }
    });
}

function infoWindow(marker, map, title, address, url) {
    google.maps.event.addListener(marker, 'click', function () {
        var html = "<div><h3>" + title + "</h3><p>" + address + "<br></div><a href='" + url + "'>View Shop</a></p></div>";
        iw = new google.maps.InfoWindow({
            content: html,
            maxWidth: 350
        });
        iw.open(map, marker);
    });
}

function createMarker(results) {
    var marker = new google.maps.Marker({
        icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
        map: map,
        position: results[0].geometry.location,
        title: title,
        animation: google.maps.Animation.DROP,
        address: address,
        url: url
    })
    bounds.extend(marker.getPosition());
    map.fitBounds(bounds);
    infoWindow(marker, map, title, address, url);
    return marker;
}




</script>

	
	
	</div>
	
	
	
	
	
	
	
	
	</div>
   <?php	} ?>
   
   
   
   
   
	<?php if($count==0){ ?>
	<div class="row"> <div class="col-md-12 text-center red">No data found!</div></div>
	
	<?php }   ?>
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<?php  
	
	if($count==0){
	if(empty($category) && empty($city) && empty($star_rate)) { 
		
		
		
		
		 $shopview=DB::table('shop')
		 ->leftJoin('users', 'users.email', '=', 'shop.seller_email')
		 ->leftJoin('rating', 'rating.rshop_id', '=', 'shop.id')
		 ->where('shop.status', 'approved')->orderBy('shop.id','desc')->groupBy('shop.id')->get();?>
	
	
	<div class="row">
	<div class="col-md-6">
	<div class="clearfix"></div>
	<?php foreach($shopview as $shop){ 
	
	?>
	
	
	<div class="col-md-3">
		<div class="shop-list-page">
			<div class="shop_pic">
			<?php 
					   $shopphoto="/shop/";
						$paths ='/local/images'.$shopphoto.$shop->cover_photo;
						if($shop->cover_photo!=""){
						?>
						<a href="<?php echo $url; ?>/vendor/<?php echo $shop->name;?>" ><img src="<?php echo $url.$paths;?>" class="img-responsive imgservice"></a>
						<?php } else { ?>
						<a href="<?php echo $url; ?>/vendor/<?php echo $shop->name;?>" ><img src="<?php echo $url.'/local/images/no-image-big.jpg';?>" class="img-responsive imgservice"></a>
						<?php } ?>
			</div>
			
			
			<div class="col-lg-12 imgthumb">
			<?php 
						$npaths ='/local/images'.$shopphoto.$shop->profile_photo;
						if($shop->profile_photo!=""){?>
        <img align="center" class="sthumb" src="<?php echo $url.$npaths;?>" alt="Profile Photo"/>
						<?php } else { ?>
						<img align="center" class="sthumb" src="<?php echo $url.'/local/images/nophoto.jpg';?>" alt="Profile Photo"/>
						<?php } ?>
			</div>
			
			
			
			<?php
		if($shop->rating=="")
		{
			$starpath = '/local/images/nostar.png';
		}
		else {
		$starpath = '/local/images/'.$shop->rating.'star.png';
		}
		?>
			<div class="col-lg-12 shop_content">
				<h4 class="sv_shop_style"><a href="<?php echo $url; ?>/vendor/<?php echo $shop->name;?>" ><?php echo $shop->shop_name; ?></a></h4>
				<img src="<?php echo $url.$starpath;?>" alt="rated <?php if($shop->rating==""){ echo "0"; } else { echo $shop->rating; }?> stars" class="star_rates" />
				<?php /* ?><h5><span class="lnr lnr-map-marker"></span>&nbsp;<?php echo $shop->city; ?></h5><?php */?>
				
				<?php 				
					if($shop->start_time>12)
					{
						$start=$shop->start_time-12;
						$stime=$start."PM";
					}
					else
					{
						$stime=$shop->start_time."AM";
					}
					if($shop->end_time>12)
					{
						$end=$shop->end_time-12;
						$etime=$end."PM";
					}
					else
					{
						$etime=$shop->end_time."AM";
					}
				?>
				<h5><span class="lnr lnr-clock"></span>&nbsp; <?php echo $stime; ?> - <?php echo $etime; ?></h5>
							
				<div align="center"><a href="vendor/<?php echo $shop->name;?>" class="btn btn-success radiusoff" style="background-color:#FFCC16; color:black !imoprtant; border-color:#FFCC16;">View Shop & Book</a></div>
			</div> 
			
			
	    </div>
	</div>	
	
	
	
	
	
	<?php } ?>
	</div>
	
	<?php } ?>
    </div>

	
	
	
	<div class="col-md-6">
	<?php 
	$wel_count = count($shopview);
	if(!empty($wel_count)){?>
	<div id="map_canvas" style="width:100%; min-height:700px; margin-top:30px;"></div>
    <?php } ?>
	
  <script type="text/javascript">


    
var locations = [
<?php foreach($shopview as $shop){ ?>
    ['<?php echo $shop->shop_name;?>', '<?php echo $shop->address;?>', '<?php echo $url;?>/vendor/<?php echo $shop->name;?>'],
<?php } ?>    
];

var geocoder;
var map;
var bounds = new google.maps.LatLngBounds();

function initialize() {
    map = new google.maps.Map(
    document.getElementById("map_canvas"), {
        center: new google.maps.LatLng(),
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    geocoder = new google.maps.Geocoder();

    for (i = 0; i < locations.length; i++) {


        geocodeAddress(locations, i);
    }
}
google.maps.event.addDomListener(window, "load", initialize);

function geocodeAddress(locations, i) {
    var title = locations[i][0];
    var address = locations[i][1];
    var url = locations[i][2];
    geocoder.geocode({
        'address': locations[i][1]
    },

    function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var marker = new google.maps.Marker({
                icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
                map: map,
                position: results[0].geometry.location,
                title: title,
                animation: google.maps.Animation.DROP,
                address: address,
                url: url
            })
            infoWindow(marker, map, title, address, url);
            bounds.extend(marker.getPosition());
            map.fitBounds(bounds);
        } else {
            //alert("geocode of " + address + " failed:" + status);
        }
    });
}

function infoWindow(marker, map, title, address, url) {
    google.maps.event.addListener(marker, 'click', function () {
        var html = "<div><h3>" + title + "</h3><p>" + address + "<br></div><a href='" + url + "'>View Shop</a></p></div>";
        iw = new google.maps.InfoWindow({
            content: html,
            maxWidth: 350
        });
        iw.open(map, marker);
    });
}

function createMarker(results) {
    var marker = new google.maps.Marker({
        icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
        map: map,
        position: results[0].geometry.location,
        title: title,
        animation: google.maps.Animation.DROP,
        address: address,
        url: url
    })
    bounds.extend(marker.getPosition());
    map.fitBounds(bounds);
    infoWindow(marker, map, title, address, url);
    return marker;
}




</script>

	
	
	</div>
	
	
	
	
	
	
	</div>
	<?php } ?>
	
	
	
	
	
	
	
	</div>
	
	
	
	
	</div>
	
	</div>
	</div>
	
	
	

      <div class="clearfix"></div>
	   <div class="clearfix"></div>

      @include('footer')
</body>
</html>
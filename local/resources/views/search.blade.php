 
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
	 <div class="col-md-12" align="center"><h1>Search</h1></div>
	 </div>
	<div class="container">
	
	 <div class="height30"></div>
	 
	 
	<div class="container">
	<div class="row">
	<form class="form-horizontal" role="form" method="POST" action="{{ route('shopsearch') }}" id="formID" enctype="multipart/form-data">
   <div class="col-md-12">
   {!! csrf_field() !!}
   
   
   
   
   
	<div class="col-sm-4 swidth noborder" >
	
		<?php //if(!empty($serid[0]->subid)){ echo $serid[0]->subid; }
		
		?>
			
				<select name="langOpt[]" multiple id="langOpt" class="validate[required] input-lg">
				<?php foreach($viewservices as $service){
					$sel=explode(",",$service->subid);
						$lev=count($sel);
					?>
                <option value="<?php echo $service->subid;?>" <?php  if(!empty($services[0]->subid)){ if($service->subid==$services[0]->subid){ echo "selected"; } }?>><?php echo $service->subname;?></option>
                <?php } ?>
                </select>
	
	</div>
	
	
	
	<div class="col-sm-3 swidth nocity">	
		
		<input type="text"  name="city" id="txtPlaces" class="form-control input-lg"  value="<?php echo $city_name;?>">
	</div>	
	
	
	
	<div class="col-sm-3 swidth nocity">
	<select name="star_rate" class="form-control input-lg">
	<option value="">Star Rating</option>
	<option value="1">1 Star</option>
	<option value="2">2 Stars</option>
	<option value="3">3 Stars</option>
	<option value="4">4 Stars</option>
	<option value="5">5 Stars</option>
	</select>
	</div>
	
	
	
	<div class="col-sm-2 custobtn">
		                       
							   
                                <button type="submit" class="borbtn-inverse filter-btn form-control btn-lg">
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
	
	
	<?php if(!empty($search_text)){?>
	
	
	<?php if(!empty($count)){?>
	
	 
	
	
	<div class="row">
	<div class="col-md-12">
	<div class="clearfix"></div>
	<?php foreach($subsearches as $shop){ 
	
	?>
	
	
	<div class="col-md-4">
	<?php if($shop->featured=="yes"){?><div class="ribbon"><span>Featured</span></div><?php } ?>
		<div class="shop-list-page">
		
			<div class="shop_pic">
			<?php 
					   $shopphoto="/shop/";
						$paths ='/local/images'.$shopphoto.$shop->cover_photo;
						if($shop->cover_photo!=""){
						?>
						<a href="<?php echo $url; ?>/rhino/<?php echo $shop->name;?>" ><img src="<?php echo $url.$paths;?>" class="img-responsive imgservice"></a>
						<?php } else { ?>
						<a href="<?php echo $url; ?>/rhino/<?php echo $shop->name;?>" ><img src="<?php echo $url.'/local/images/no-image-big.jpg';?>" class="img-responsive imgservice"></a>
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
				<h4 class="sv_shop_style"><a href="<?php echo $url; ?>/rhino/<?php echo $shop->name;?>" ><?php echo $shop->shop_name; ?></a></h4>
				
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
				
				
				
							
				<div align="center"><a href="<?php echo $url; ?>/rhino/<?php echo $shop->name;?>" class="btn btn-success radiusoff" style="background-color:#FFCC16; color:black !important; border-color:#FFCC16;">View Shop & Book</a></div>
			</div> 
			
			
	    </div>
	</div>	
	
	
	
	
	
	<?php } ?>
	</div>
	
	
	<!--
	<div class="col-md-6">
	<?php 
	$wel_count = count($subsearches);
	if(!empty($wel_count)){?>
	<div id="map_canvas" style="width:100%; min-height:700px; margin-top:30px;"></div>
    <?php } ?>
	
  <script type="text/javascript">


    
var locations = [
<?php foreach($subsearches as $shop){ ?>
    ['<?php echo $shop->shop_name;?>', '<?php echo $shop->address;?>', '<?php echo $url;?>/rhino/<?php echo $shop->name;?>'],
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
	-->
	
	

	
	
	<?php } ?>
	</div>
	
	
	
	
	
	<?php if(empty($count)){?>
	
	<div class="col-md-12 noservice" align="center">No services found!</div>
	
	<?php } ?>
	
	
	

	
	
	
	
	<?php } if(empty($search_text) && empty($sub_value)) { ?>
	
	
	
	
	<div class="row">
	<div class="col-md-12">
	<div class="clearfix"></div>
	<?php foreach($shopview as $shop){

	?>
	
	
	<div class="col-md-4">
	<?php if($shop->featured=="yes"){?><div class="ribbon"><span>Featured</span></div><?php } ?>
		<div class="shop-list-page">
			<div class="shop_pic">
			<?php 
					   $shopphoto="/shop/";
						$paths ='/local/images'.$shopphoto.$shop->cover_photo;
						if(!empty($shop->cover_photo)){
						?>
						<a href="<?php echo $url; ?>/rhino/<?php echo $shop->name;?>" ><img src="<?php echo $url.$paths;?>" class="img-responsive imgservice"></a>
						<?php } else { ?>
						<a href="<?php echo $url; ?>/rhino/<?php echo $shop->name;?>" ><img src="<?php echo $url.'/local/images/no-image-big.jpg';?>" class="img-responsive imgservice"></a>
						<?php } ?>
			</div>
			
			<div class="col-lg-12 imgthumb">
			<?php 
						$npaths ='/local/images'.$shopphoto.$shop->profile_photo;
						if(!empty($shop->profile_photo)){?>
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
				<h4 class="sv_shop_style"><a href="<?php echo $url; ?>/rhino/<?php echo $shop->name;?>" ><?php echo $shop->shop_name; ?></a></h4>
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
							
				<div align="center"><a href="vendor/<?php echo $shop->name;?>" class="btn btn-success radiusoff" style="background-color:#FFCC16; color:black !important; border-color:#FFCC16;">View Shop & Book</a></div>
			</div> 
			
			
	    </div>
	</div>	
	
	
	
	
	
	<?php } ?>
	</div>
	
	
	<!--
	<div class="col-md-6">
	<?php 
	$wel_count = count($shopview);
	if(!empty($wel_count)){?>
	<div id="map_canvas" style="width:100%; min-height:700px; margin-top:30px;"></div>
    <?php } ?>
	
  <script type="text/javascript">


    
var locations = [
<?php foreach($shopview as $shop){ ?>
    ['<?php echo $shop->shop_name;?>', '<?php echo $shop->address;?>', '<?php echo $url;?>/rhino/<?php echo $shop->name;?>'],
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
	-->
	
	
	
	
	
	
	<?php } ?>
	
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<?php if(!empty($sub_value)){?>
	
	
	
	
	<div class="row">
	<div class="clearfix"></div>
	<?php foreach($subsearches as $shop){ 
	
	?>
	
	
	<div class="col-md-3 col-sm-3 sv_listpage">
	<?php if($shop->featured=="yes"){?><div class="ribbon"><span>Featured</span></div><?php } ?>
		<div class="shop-list-page">
			<div class="shop_pic">
			<?php 
					   $shopphoto="/shop/";
						$paths ='/local/images'.$shopphoto.$shop->cover_photo;
						if($shop->cover_photo!=""){
						?>
						<a href="<?php echo $url; ?>/rhino/<?php echo $shop->name;?>" ><img src="<?php echo $url.$paths;?>" class="img-responsive imgservice"></a>
						<?php } else { ?>
						<a href="<?php echo $url; ?>/rhino/<?php echo $shop->name;?>" ><img src="<?php echo $url.'/local/images/no-image-big.jpg';?>" class="img-responsive imgservice"></a>
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
				<h4 class="sv_shop_style"><a href="<?php echo $url; ?>/rhino/<?php echo $shop->name;?>" ><?php echo $shop->shop_name; ?></a></h4>
				
				<img src="<?php echo $url.$starpath;?>" alt="rated <?php if($shop->rating==""){ echo "0"; } else { echo $shop->rating; }?> stars" class="star_rates" />
				<h5><span class="lnr lnr-map-marker"></span>&nbsp;<?php echo $shop->city; ?></h5>
				
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
				
				
				
							
				<div align="center"><a href="<?php echo $url; ?>/rhino/<?php echo $shop->name;?>" class="btn btn-success radiusoff" style="background-color:#FFCC16; color:black !important; border-color:#FFCC16;">View Shop & Book</a></div>
			</div> 
			
			
	    </div>
	</div>	
	
	
	
	
	
	<?php } ?>
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
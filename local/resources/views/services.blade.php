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
	 <div class="col-md-12" align="center"><h1>Services</h1></div>
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
	<form class="form-horizontal" role="form" method="POST" action="{{ route('services') }}" id="formID" enctype="multipart/form-data">
   <div class="row">
   {!! csrf_field() !!}
   
   
   <input type="hidden" name="editid" value="<?php echo $editid;?>">
   
   
	<div class="col-sm-4">
	<div class="col-sm-12">
	<div class="form-group" >
	<label>Services Name<span class="star">*</span></label>
		<select class="form-control input-lg validate[required]" id="subservice_id" name="subservice_id" required>
			<option value="">Select Services</option>
			<?php foreach($services as $disp){?>
			<option value="<?php echo $disp->id;?>" disabled><?php echo $disp->name;?></option>
			<?php $subservices = DB::table('subservices')->where('service', '=', $disp->id)->orderBy('subname','asc')->get();
			foreach($subservices as $dispsub){
			?>
			   <option value="<?php echo $dispsub->subid;?>" <?php if(!empty($sellservices)) { if($sellservices[0]->subservice_id==$dispsub->subid){?> selected <?php } } ?>> -- <?php echo $dispsub->subname;?></option>
			<?php } } ?>
		</select>
	</div>
	</div>
	</div>
	<div class="col-sm-2">
	<div class="col-sm-12">
	<div class="form-group">	
		<label>Currency</label>
		<input type="text"  name="" id="" class="form-control input-lg validate[required] text-input" disabled="disabled" value="<?php echo $setting[0]->site_currency;?>">
	</div>	
	</div>	
	</div>	
	<div class="col-sm-2">
	<div class="col-sm-12">
	<div class="form-group">		
		<label>Price <span class="star">*</span></label>
		<input type="text"  name="price" required id="price" class="form-control input-lg validate[required] text-input" value="<?php if(!empty($sellservices)) { echo $sellservices[0]->price; }?>">
	</div>
	</div>
	</div>
	<div class="col-sm-4">
	<div class="col-sm-12">
	<div class="form-group" id="shop_address" >
		<label>Time (Hours)</label>
		<input type="text" name="time" id="time" class="form-control input-lg validate[required] text-input" value="<?php if(!empty($sellservices)) { echo $sellservices[0]->time; }?>">
	</div>
	</div>
	</div>
		
	<input type="hidden" name="user_id" value="<?php echo $uuid;?>">
	
	<input type="hidden" name="shop_id" value="<?php echo $shopview[0]->id;?>">

	</div>

	
	<div class="clearboth"></div>
	<div class="row">
	<div class="col-sm-12">		                      
		<a href="<?php echo $url;?>/services" class="btn btn-primary radiusoff">Reset</a>
		<?php if(config('global.demosite')=="yes"){?><button type="button" class="btn btn-success btn-md radiusoff btndisable">Submit</button> 
		<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
        <button disabled type="submit" class="btn btn-success btn-md radiusoff">
            Submit
        </button>
		<?php } ?>
	</div>
	</div>
		
	</form>
	
	</div>
		
	<div class="clearfix"></div>
	<div class="row" align="right" style="margin-bottom:2px;">
	 <?php if(config('global.demosite')=="yes"){?><span class="disabletxt">( <?php echo config('global.demotxt');?> ) </span><button type="button" class="btn btn-primary radiusoff btndisable">Add Services</button> 
								<?php } else { ?>
	
	 <a href="<?php echo $url;?>/services" class="btn btn-primary radiusoff disabled">Add Services</a>
								<?php } ?>
	 
	 </div>
	 
	<div class="row">
	<div class="table-responsive">
	<table class="table table-bordered">
  <thead>
    <tr>
      <th>Sno</th>
      <th>Services</th>
      <th>Price</th>
      <th>Hours</th>
	  <th>Update</th>
	  <th>Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $ii=1;
  foreach($viewservice as $newserve){?>
    <tr>
      <th><?php echo $ii;?></th>
      <td><?php echo $newserve->subname;?></td>
      <td><?php echo $newserve->price.' '.$setting[0]->site_currency;?></td>
      <td><?php echo $newserve->time;?></td>
	  <td>
	  <?php if(config('global.demosite')=="yes"){?>
	  <a href="#" class="btndisable"><img src="<?php echo $url.'/local/images/edit.png';?>" alt="Edit" border="0"></a> <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
	  <?php } else { ?>
	  <a href="<?php echo $url;?>/services/<?php echo $newserve->id;?>"><img src="<?php echo $url.'/local/images/edit.png';?>" alt="Edit" border="0"></a>
	  <?php } ?>
	  	  
	  </td>
	  <td>
	   <?php if(config('global.demosite')=="yes"){?>
	  <a href="#" class="btndisable"><img src="<?php echo $url.'/local/images/delete.png';?>" alt="Delete" border="0"></a> <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
	  <?php } else { ?>
	  <a href="<?php echo $url;?>/services/<?php echo $newserve->id;?>/delete" onclick="return confirm('Are you sure you want to delete this?')">
	  <img src="<?php echo $url.'/local/images/delete.png';?>" alt="Delete" border="0"></a></td>
	  <?php } ?>
    </tr>
  <?php $ii++; } ?>

  </tbody>
</table>
	</div>
	
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
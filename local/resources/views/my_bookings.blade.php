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
    

	

	
	<div class="video">

	<div class="headerbg">
	 <div class="col-md-12" align="center"><h1>My Bookings</h1></div>
	 </div>
	  
	 <div class="col-md-12">
	 <div class="row">
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
	</div>
	</div>
	
	
	<div class="container">
	
	 <div class="height30"></div>
	 
	 <div class="row">
		
	<?php 
			
			if($count==0)
			{
			  ?>
			  <div class="err-msg" align="center">No booking found!</div>
			<?php
			} else {
				$iq=1;
			foreach($booking as $book)
			{
				
				$ser_id=$book->services_id;
				$sel=explode("," , $ser_id);
				$lev=count($sel);
				$ser_name="";
				$sum="";
				$price="";
				for($i=0;$i<$lev;$i++)
				{
					$id=$sel[$i];		
					
					
                    $fet1_cnt = DB::table('subservices')
								 ->where('subid', '=', $id)
								 ->count();

					if(!empty($fet1_cnt))
					{
					$fet1 = DB::table('subservices')
								 ->where('subid', '=', $id)
								 ->get();
				$ser_name.='<div class="book-profile radiusoff">'.$fet1[0]->subname.'</div>';
				$ser_name.=",";				 
				
				
				
				$ser_name=trim($ser_name,",");
					}
                    else
					{
						$ser_name = "";
					}						
					
					
				}
				$shop_id=$book->shop_id;
				$buser = $book->user_id;
				
				$bookk = $book->book_id;
				
				
				 $booking_time=$book->booking_time;
										 
				 if($booking_time>12)
				{
					$final_time=$booking_time-12;
					$final_time=$final_time."PM";
				}
				else
				{
					$final_time=$booking_time."AM";
				}
				
				
				$viewrating = DB::table('rating')
								 ->where('rshop_id', '=', $shop_id)
								 ->where('email', '=', $email)
								 ->get();
              $nucount = DB::table('rating')
								 ->where('rshop_id', '=', $shop_id)
								 ->where('email', '=', $email)
								 ->count();
								 
				$checkcounte =	DB::table('booking')
								 ->where('shop_id', '=', $shop_id)
								 ->where('user_id', '=', $buser)
								 ->count();	


                $view_list =	DB::table('booking')
								 ->where('book_id', '=', $bookk)
								 ->get();									 
				
                $bb_time = $view_list[0]->booking_time - 1;
                $booking_date_time = $view_list[0]->booking_date.' '.$bb_time.':00:00';
				
				
				
				$current_date_time = date('Y-m-d H:i:s');
				
				
				$source = strtotime($current_date_time);
				
				
				
				$destination = strtotime($booking_date_time);
				
 				
			?>
			<script>
(function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);

var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")}}if(!e){return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()})

$(function(){

  $('#new-review<?php echo $bookk; ?>').autosize({append: "\n"});

  var reviewBox = $('#post-review-box<?php echo $bookk; ?>');
  var newReview = $('#new-review<?php echo $bookk; ?>');
  var openReviewBtn = $('#open-review-box<?php echo $bookk; ?>');
  var closeReviewBtn = $('#close-review-box<?php echo $bookk; ?>');
  var ratingsField = $('#ratings-hidden<?php echo $shop_id; ?>');

  openReviewBtn.click(function(e)
  {
    reviewBox.slideDown(400, function()
      {
        $('#new-review<?php echo $bookk; ?>').trigger('autosize.resize');
        newReview.focus();
      });
    openReviewBtn.fadeOut(100);
    closeReviewBtn.show();
  });

  closeReviewBtn.click(function(e)
  {
    e.preventDefault();
    reviewBox.slideUp(300, function()
      {
        newReview.focus();
        openReviewBtn.fadeIn(200);
      });
    closeReviewBtn.hide();
    
  });

  $('.starrr').on('starrr:change', function(e, value){
    ratingsField.val(value);
  });
});
</script>
	
			
			<div class="row booking_page" style="background:black">
				<div class="shop_pic col-lg-4">
				<?php
				 $shopphoto="/shop/";
						$paths ='/local/images'.$shopphoto.$book->cover_photo;
					if($book->cover_photo!="")
					{
				?>
				<a href="<?php echo $url; ?>/rhino/<?php echo $book->name;?>" target="_blank"><img class="img-responsive newcsl" src="<?php echo $url.$paths;?>" alt=""></a>
				<?php } else { ?>
				<a href="<?php echo $url; ?>/rhino/<?php echo $book->name;?>" target="_blank">	<img class="img-responsive" src="<?php echo $url.'/local/images/noimage.jpg';?>" alt="" style="min-width:400px; max-height:200px;"></a>
				<?php } ?>
					
				</div>
				
				<div class="col-lg-4 paddingleft20">
				<h3 class="sv_shop_style"><a href="<?php echo $url; ?>/rhino/<?php echo $book->name;?>" target="_blank"><?php echo $book->shop_name; ?></a></h3>
					
					<p><span class="lnr lnr-calendar-full"></span>	<?php echo $book->booking_date; ?> - <span class="lnr lnr-clock"></span>
						<?php echo $final_time; ?></p>
					
					<?php if($book->payment_mode=="paypal"){ $txt_id = "Txn Id : ".$book->paypal_token; }
						 else if($book->payment_mode=="stripe"){ $txt_id = "Txn Id : ".$book->stripe_token; }
						 else if($book->payment_mode=="payumoney"){ $txt_id = "Txn Id : ".$book->payu_token; }
						 else { $txt_id = ""; }
						 
						 ?>
					
					
					<h5>Booking Id : <?php echo $book->book_id; ?> <br/><br/>
					
					Payment Method : <?php echo $book->payment_mode; ?> <br/><br/>
					
					 <?php echo $txt_id; ?></h5>
					
					  <?php echo $ser_name; ?>
								
				</div>
				
				<div class="col-lg-4 book_content">
				<div class="col-md-12 paddingtop20">
				
    	<div class="well-sm mtop10">
            <div class="revbtn">
                <a class="btn btn-success btn-green radiusoff" href="#reviews-anchor" id="open-review-box<?php echo $bookk; ?>">Leave a Review</a> <a href="<?php echo $url;?>/send-message/<?php echo Auth::user()->id;?>/<?php echo $book->user_id;?>" class="btn btn-primary btn-md radiusoff">send message</a>
				
				<?php if($book->service_complete==1){?>
				<br/><br/><a href="<?php echo $url;?>/my_bookings/release/<?php echo base64_encode($book->book_id);?>/<?php echo $book->shop_id;?>" class="btn btn-primary radiusoff">Release the payment</a><br/><br/>
				
				<a href="#" class="btn btn-danger radiusoff" data-toggle="modal" data-target="#myDispute<?php echo $book->book_id;?>">Dispute</a>
				
				
				<div class="modal fade" id="myDispute<?php echo $book->book_id;?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $book->shop_name; ?> - Dispute</h4>
        </div>
        <div class="modal-body">
          
		  <form class="" role="form" method="POST" action="{{ route('my_book') }}" id="formID" enctype="multipart/form-data">
          {{ csrf_field() }}
		  <div class="form-group">
    <label for="email">Booking Id: <?php echo $book->book_id;?></label>
    <input type="hidden" name="book_id" value="<?php echo $book->book_id;?>">
  </div>
		  
	<input type="hidden" name="customer_id" value="<?php echo $view_list[0]->user_id;?>">
    <input type="hidden" name="shop_id" value="<?php echo $book->shop_id;?>">
	
  <div class="form-group">
    <label for="email">Subject:</label>
    <input type="text" class="form-control validate[required]" id="subject" name="subject">
  </div>
  <div class="form-group">
    <label for="pwd">Message:</label>
    <textarea class="form-control validate[required]" name="message" style="min-height:100px;"></textarea>
  </div>
  
  <button type="submit" class="btn btn-success">Submit</button>
</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
				<?php } ?>
            </div>
			
			
			
			
			
			<?php if($view_list[0]->status=="paid" && $book->service_complete==0){
				
				if($source < $destination)
				{
				?>
			<div style="margin-top:20px;">
			<a href="<?php echo $url;?>/my_bookings/cancel/<?php echo base64_encode($book->book_id);?>" onclick="return confirm('Are you sure you want to do this?');">Cancel this booking</a>
			</div>
				<?php } } ?>
			
			<div style="margin-top:20px;">
			
			<div class="total-price radiusoff">Total Price - <?php if($book->total_amt=="") { echo "0"; } else { echo $book->total_amt; }?>&nbsp;<?php echo $book->currency; ?></div>
				
				<div style="clear:both; height:10px;"></div>
			
				<div>
				<strong>Payment Status :</strong> <?php echo $view_list[0]->status; ?><?php if(!empty($view_list[0]->reject)){ echo ','.$view_list[0]->reject; } ?>
				</div>
				<div style="clear:both; height:10px;"></div>
				
				<div>
				<?php if(empty($view_list[0]->reject)){?>
				<strong>Service Status :</strong> <?php if($book->service_complete==0){?>Awaiting completion<?php } ?> <?php if($book->service_complete==1){?>Completed<?php } ?> <?php if($book->service_complete==2){?>Released the payment<?php } ?>
				
				<?php } ?>
				</div>
				<div style="clear:both; height:10px;"></div>
				<div style="margin-bottom:10px;">
				<?php $cidd = Auth::user()->id;
				$dispwives = DB::table('dispute')
              
			               ->where('booking_id', '=', $book->book_id)
			               ->where('customer_id', '=', $cidd)
                           ->count();
				if(!empty($dispwives))
				{
					$disp_view = DB::table('dispute')
              
			               ->where('booking_id', '=', $book->book_id)
			               ->where('customer_id', '=', $cidd)
                           ->get();
					if($disp_view[0]->status=="")
					{ 
				      $viewstatus = "<strong>Dispute Status :</strong> Awaiting for admin action";
					}
                    else
					{
						$viewstatus = "<strong>Dispute Status :</strong> ".$disp_view[0]->status;
					}						
					
				}
				else
				{
					$viewstatus = "";
				}
				?>
				
				
				<?php echo $viewstatus;?>
				
				</div>
				
				</div>
				
				
				
				
				
       
            <div class="row" id="post-review-box<?php echo $bookk; ?>" style="display:none;">
                <div class="col-md-12">
                    <form accept-charset="UTF-8" action="{{ route('my_bookings') }}" method="post">
					 {{ csrf_field() }}
					<input type="hidden" name="rate_id" value="<?php if(!empty($nucount)) { echo $viewrating[0]->rid; } ?>">
                        <input id="ratings-hidden<?php echo $shop_id; ?>" name="rating" type="hidden"> 
						<input type="hidden" id="shop_id" name="shop_id" value="<?php echo $shop_id; ?>">
                        <textarea required class="form-control animated radiusoff" cols="50" id="new-review<?php echo $shop_id; ?>" name="comment" placeholder="Enter your review here..." rows="5"><?php if(!empty($nucount)){ echo $viewrating[0]->comment; } ?></textarea>
        
                        <div class="text-right">
                            <div class="stars starrr" data-rating="<?php if(!empty($nucount)){ echo $viewrating[0]->rating; } ?>"></div>
                            <a class="btn btn-danger btn-md radiusoff" href="#" id="close-review-box<?php echo $bookk; ?>" style="display:none; margin-right: 10px;">
                            Cancel</a>
							
							
							<?php if(config('global.demosite')=="yes"){?><button type="button" class="btn btn-success btn-md radiusoff btndisable">Save</button> 
								<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
							
                            <button class="btn btn-success btn-md radiusoff" type="submit">Save</button>
								<?php } ?>
							
                        </div>
                    </form>
                </div>
            </div>
			
			
			
			
			
			
        </div> 
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
         
		</div>
			</div>
















			
</div>
		
			<?php } } ?>

	
	
	
	
	
	
	
	
	
	
	
	</div>
	
	</div>
	</div>
	
	
	

      <div class="clearfix"></div>
	   <div class="clearfix"></div>

      @include('footer')
	  <?php if(session()->has('message')){?>
    <script type="text/javascript">
        alert("<?php echo session()->get('message');?>");
		</script>
    </div>
	 <?php } ?>
</body>
</html>
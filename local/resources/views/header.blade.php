<?php
use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");
$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
if(Auth::check()) 
{
	
	if(Auth::user()->provider!="" && Auth::user()->admin==3)
	{
		if($currentPaths!='step2'){
		?>
		<script type="text/javascript">
		window.location.href="<?php echo $url;?>/step2";
		</script>
		<?php
		}
	}

}		
?>		
<div class="navbar navbar-fixed-top <?php if($currentPaths=="index" or $currentPaths=="/"){?>homenav<?php } else {?>migrateshop_othernav<?php } ?> navbar-inverse" role="navigation">
      <div class="container topbottom">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#b-menu-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  
          <a class="" href="<?php echo $url;?>">
		   <?php if(!empty($setts[0]->site_logo)){ ?>
		  
		  <img style="max-width: 60px;" src="<?php echo $url.'/local/images/settings/'.$setts[0]->site_logo;?>" border="0" alt="" />
		   <?php } ?>
		   
		  </a>
        </div>
        <div class="collapse navbar-collapse" id="b-menu-1">
			
		
          <ul class="nav navbar-nav navbar-right <?php if($currentPaths=="index" or $currentPaths=="/"){?>sangvish_homepage<?php } else {?>sangvish_otherpage<?php } ?>">
		  <!--<li class="active"><a href="#">Join as a pro</a></li>-->
            <?php if (Auth::guest()) {?>
			
            <li><a href="<?php echo $url;?>/register"><div style="color:#000000;">Sign Up</div></a></li>
            <li><a href="<?php echo $url;?>/login"><div style="color:#000000;">Login</div></a></li>
			<li style="display:none"><a href="<?php echo $url;?>/new-request"  class="borbtn">Post a Job</a></li>
            <?php } else { ?>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{ Auth::user()->name }} <i class="fa fa-angle-down" aria-hidden="true"></i>
</a>
              <ul class="dropdown-menu">
                 <?php if(Auth::check()) {

               $view_unread = DB::table('tbl_private_message')
                        
						->where('receiver', '=', Auth::user()->id)
						->where('read_status', '=', 1)
						->orderBy('pid','desc')
                        ->count();

				 ?>
                <?php if(Auth::user()->admin==1) {?>
				<li><a href="{{ url('admin/') }}" target="_blank">Admin Dashboard</a></li>
				<?php } ?>
								
				<?php if(Auth::user()->admin==0) {?>
				<li><a href="<?php echo $url;?>/index">Home</a></li>
				<li><a href="<?php echo $url;?>/dashboard">My Profile</a></li>
				
				<li><a href="<?php echo $url;?>/my_bookings">My Bookings</a></li>
				
				<li class="dropdown-submenu">
                <a style="display:none" tabindex="-1" href="#">My Jobs</a>
                <ul class="dropdown-menu ">
                  <li style="display:none"><a href="<?php echo $url;?>/my_request">My Posted Jobs</a></li>
                 
                  <li><a href="<?php echo $url;?>/my_client_request">My Running Jobs (as Client)</a></li>
				  <li><a href="<?php echo $url;?>/my_freelancer_request">My Running Jobs (as Freelancer)</a></li>
                  <li><a href="<?php echo $url;?>/my_applied_request">My Applied Jobs</a></li>
				  <li><a href="<?php echo $url;?>/buyer_request">All Jobs</a></li>
                </ul>
              </li>
				
				<li><a href="<?php echo $url;?>/messages">My Messages <?php if(!empty($view_unread)){?><span class="countes"><?php echo $view_unread;?></span><?php } ?></a></li>
				<li style="display:none"><a href="<?php echo $url;?>/wallet">Wallet</a></li>
				<?php } ?>			
								
								
			    <?php if(Auth::user()->admin==2) {
					
					$sellmail = Auth::user()->email;
    	 $shcount = DB::table('shop')
		 ->where('seller_email', '=',$sellmail)
		 ->count();

	$shstatus = DB::table('shop')
		 ->where('seller_email', '=',$sellmail)
		 ->get();
					?>
				<li><a href="<?php echo $url;?>/dashboard">My Profile</a></li>
				<?php if(empty($shcount)){?><li><a href="<?php echo $url;?>/addshop">Rhino Registration</a></li><?php } ?>
				<li style="display:none"><a href="<?php echo $url;?>/my_bookings">My Bookings</a></li>
				<li><a href="<?php echo $url;?>/messages">My Messages <?php if(!empty($view_unread)){?><span class="countes"><?php echo $view_unread;?></span><?php } ?></a></li>
				<li><a href="<?php echo $url;?>/myorder"> My Order</a></li>
				
				
				 <li style="display:none"class="dropdown-submenu">
                <a tabindex="-1" href="#" class="test">My Jobs</a>
                <ul class="dropdown-menu sv_sub_menu">
                  <li><a href="<?php echo $url;?>/my_request">My Posted Jobs</a></li>
                 
                  <li><a href="<?php echo $url;?>/my_client_request">My Running Jobs (as Client)</a></li>
				  <li><a href="<?php echo $url;?>/my_freelancer_request">My Running Jobs (as Freelancer)</a></li>
                  <li><a href="<?php echo $url;?>/my_applied_request">My Applied Jobs</a></li>
				  <li><a href="<?php echo $url;?>/buyer_request">All Jobs</a></li>
                </ul>
              </li>
				
				
				<li><a href="<?php if(empty($shcount)){?><?php echo $url;?>/addshop<?php } else { ?><?php echo $url;?>/shop<?php } ?>">My Shop</a></li>
				<li style="display:none"<?php if(empty($shcount)||$shstatus[0]->status=="unapproved"){?>class="disabled"<?php } ?>><a href="<?php echo $url;?>/services" <?php if(empty($shcount)||$shstatus[0]->status=="unapproved"){?>class="disabled"<?php } ?>>My Services</a></li>
				<li <?php if(empty($shcount)||$shstatus[0]->status=="unapproved"){?>class="disabled"<?php } ?>><a href="<?php echo $url;?>/gallery" <?php if(empty($shcount)||$shstatus[0]->status=="unapproved"){?>class="disabled"<?php } ?>>Shop Gallery</a></li>
				<li style="display:none" <?php if(empty($shcount)){?>class="disabled"<?php } ?>><a href="<?php echo $url;?>/wallet" <?php if(empty($shcount)){?>class="disabled"<?php } ?>>Wallet</a></li>
				
				<?php } ?>			
								
								
								
								
								
								
								
								<?php } ?>										
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout</a></li>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
              </ul>
            </li>
			<li style="display:none"><a href="<?php echo $url;?>/new-request"  class="borbtn">Post a Job</a></li>
			<?php } ?>
          </ul>
        </div> <!-- /.nav-collapse -->
      </div> <!-- /.container -->
    </div> <!-- /.navbar -->
	
	<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>



<!-- Mobile menu start here -->
<header class="sv_mob_menu">
<div id="mySidenav" class="sidenav ">
    <div class="header_part">
    <span class="sv_menu_title">Workrhino</span>
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  </div>
  
    <?php if (Auth::guest()) {?>
			
           <a href="<?php echo $url;?>/register"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Sign Up</a>
           <a href="<?php echo $url;?>/login"><i class="fa fa-sign-in" aria-hidden="true"></i>  Login</a>
		    <a style="display:none" href="<?php echo $url;?>/new-request"  class="borbtn"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Post a Job</a>
            <?php } else {  ?>
            
           
                 <?php if(Auth::check()) {

               $view_unread = DB::table('tbl_private_message')
                        
						->where('receiver', '=', Auth::user()->id)
						->where('read_status', '=', 1)
						->orderBy('pid','desc')
                        ->count();

				 ?>
                <?php if(Auth::user()->admin==1) {?>
				<li><a href="{{ url('admin/') }}" target="_blank">Admin Dashboard</a></li>
				<?php } ?>
								
				<?php if(Auth::user()->admin==0) {?>
				<li><a href="<?php echo $url;?>/dashboard"><i class="fa fa-user-o" aria-hidden="true"></i> My Profile</a></li>
				
				<li><a href="<?php echo $url;?>/my_bookings"><i class="fa fa-check" aria-hidden="true"></i> My Bookings</a></li>
				
			
              
               
                  <li style="display:none"><a href="<?php echo $url;?>/my_request"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> My Posted Jobs</a></li>
                 
                  <li style="display:none"><a href="<?php echo $url;?>/my_client_request"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>  My Running Jobs (as Client)</a></li>
				  <li><a href="<?php echo $url;?>/my_freelancer_request"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>  My Running Jobs (as Freelancer)</a></li>
                  <li style="display:none"><a href="<?php echo $url;?>/my_applied_request"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>  My Applied Jobs</a></li>
				  <li style="display:none"><a href="<?php echo $url;?>/buyer_request"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>  All Jobs</a></li>
              
             
				
				<li><a href="<?php echo $url;?>/messages"><i class="fa fa-commenting-o" aria-hidden="true"></i> My Messages <?php if(!empty($view_unread)){?><span class="countes"><?php echo $view_unread;?></span><?php } ?></a></li>
				<li style="display:none"><a href="<?php echo $url;?>/wallet"><i class="fa fa-money" aria-hidden="true"></i> Wallet</a></li>
				<?php } ?>			
								
								
			    <?php if(Auth::user()->admin==2) {
					
					$sellmail = Auth::user()->email;
    	 $shcount = DB::table('shop')
		 ->where('seller_email', '=',$sellmail)
		 ->count();

	$shopstatus = DB::table('shop')
		->where('seller_email', '=',$sellmail)
		->get();

					?>
				<li><a href="<?php echo $url;?>/dashboard"><i class="fa fa-user-o" aria-hidden="true"></i> My Profile</a></li>
				<?php if(empty($shcount)){?><li><a href="<?php echo $url;?>/addshop">Rhino Registration</a></li><?php } ?>
				<li style="display:none"><a href="<?php echo $url;?>/my_bookings"><i class="fa fa-check" aria-hidden="true"></i>  My Bookings</a></li>
				<li><a href="<?php echo $url;?>/messages"><i class="fa fa-commenting-o" aria-hidden="true"></i>  My Messages <?php if(!empty($view_unread)){?><span class="countes"><?php echo $view_unread;?></span><?php } ?></a></li>
				<li><a href="<?php echo $url;?>/myorder"><i class="fa fa-first-order" aria-hidden="true"></i> My Order</a></li>
				
				
				<li class="dropdown" style="display:none">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-search-minus" aria-hidden="true"></i> My Jobs <i class="fa fa-angle-down" aria-hidden="true"></i></a>
              <ul class="dropdown-menu">
                   <li><a href="<?php echo $url;?>/my_request">My Posted Jobs</a></li>
                 
                  <li><a href="<?php echo $url;?>/my_client_request">My Running Jobs (as Client)</a></li>
				  <li><a href="<?php echo $url;?>/my_freelancer_request">My Running Jobs (as Freelancer)</a></li>
                  <li><a href="<?php echo $url;?>/my_applied_request">My Applied Jobs</a></li>
				  <li><a href="<?php echo $url;?>/buyer_request">All Jobs</a></li>
                  </ul>
                  </li>
				
				
				
				<li><a href="<?php if(empty($shcount)){?><?php echo $url;?>/addshop<?php } else { ?><?php echo $url;?>/shop<?php } ?>"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> My Shop</a></li>
				<li style="display:none" <?php if(empty($shcount)){?>class="disabled"<?php } ?>><a href="<?php echo $url;?>/services" <?php if(!empty($shcount)){?>class="disabled"<?php } ?>><i class="fa fa-cogs" aria-hidden="true"></i> My Services</a></li>
				<li <?php if(empty($shcount)){?>class="disabled"<?php } ?>><a href="<?php echo $url;?>/gallery" <?php if(empty($shcount)){?>class="disabled"<?php } ?>><i class="fa fa-picture-o" aria-hidden="true"></i> Shop Gallery</a></li>
				<li style="display:none" <?php if(empty($shcount)){?>class="disabled"<?php } ?>><a href="<?php echo $url;?>/wallet" <?php if(empty($shcount)){?>class="disabled"<?php } ?>><i class="fa fa-money" aria-hidden="true"></i> Wallet</a></li>
				
				<?php } ?>			
								
								
								
								
								
								
								
								<?php } ?>										
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
             
            
		
			<?php } ?>
  
  
</div>



<span style="font-size:30px;cursor:pointer; color:black;" onclick="openNav()">&#9776;</span>

 <a class="" href="<?php echo $url;?>">
		   <?php if(!empty($setts[0]->site_logo)){ ?>
		  
		  <img style="max-width:70px;" src="<?php echo $url.'/local/images/settings/'.$setts[0]->site_logo;?>" border="0" alt="" />
		   <?php } ?>
		   
		  </a>

<script type="text/javascript">
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
 </header>  

<script>
    
    // Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('header').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('header').removeClass('nav-down').addClass('nav-up');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('header').removeClass('nav-up').addClass('nav-down');
        }
    }
    
    lastScrollTop = st;
}
</script>




















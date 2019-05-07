<?php
use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
   @include('style')
</head>
<body>
    <?php
$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$hidden = explode(',',$setts[0]->social_login_option);
		?>	
<div class="forgot-password-page">

	
	@if(Session::has('success'))

	    <div class="alert alert-success">

	      {{ Session::get('success') }}

	    </div>

	@endif
	
 
		
	


		<div class="login-box">
        <div class="login-box-overlay">
            <div class="panel panel-default">
                
				<div class="panel-body">
				<div class="col-md-10 col-xs-10 col-xs-offset-1">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('forgot') }}">
                        {{ csrf_field() }}
						
						<div class="login-logo text-center">
						 <a class="" href="<?php echo $url;?>"><img src="<?php echo $url.'/local/images/settings/'.$setts[0]->site_logo;?>" border="0" alt="" /></a>
						</div>
						<div class="title-bar text-center">
						<h2>Reset Password</h2>
						<p>Enter your email and we'll send you instructions to reset your password</p>
						<div class="form-group">
                                <input id="email" type="email" class="form-control input-lg" placeholder="E-Mail Address" name="email" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="borbtn-inverse form-control btn btn-lg">
                                Send Password Reset Link
                            </button>
                        </div>
                        	@if(Session::has('error'))

	    <div class="alert alert-danger">

	      {{ Session::get('error') }}

	    </div>

	@endif
						</div>
                    </form>
                </div>
				
            </div>
        </div>
	</div>

	</div>
	</div>

</body>
</html>
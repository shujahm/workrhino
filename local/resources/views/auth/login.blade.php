<div class="login-page">
<?php
use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");
?>

@extends('layouts.app')
@section('content')
@include('style')

<?php
$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$hidden = explode(',',$setts[0]->social_login_option);
		?>		
	
	
	 @if(Session::has('success'))

	    <div class="alert alert-success">

	      {{ Session::get('success') }}

	    </div>

	@endif


	
	
 
	
	
	@if(Session::has('resenderr'))
		
<?php 

$gett = Session::get('resenderr');

$ery = 'Please confirm email verfication to login <a href="'.$url.'/index/'.$gett.'" style="font-weight:bold; text-decoration:underline;">Resend Email</a>'; ?>
	    <div class="alert alert-danger">

	      <?php echo $ery;?>

	    </div>

	@endif
	
	
	
        <div class="login-box">
        <div class="login-box-overlay">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
						<div class="login-logo text-center">
						 <a class="" href="<?php echo $url;?>"><img style="width:144px;" src="<?php echo $url.'/local/images/settings/'.$setts[0]->site_logo;?>" border="0" alt="" /></a>
						</div>
						<div class="col-sm-12">
						<div class="col-sm-8 col-sm-offset-2 text-center">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="username" type="text" class="form-control input-lg" placeholder="Username" name="username" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control input-lg" placeholder="Password" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <span style="color:#428bca">Remember Me</span>
                                    </label>
                                </div>
                        </div>						

                        <div class="form-group">
                                <button type="submit" class="borbtn-inverse form-control btn-lg">
                                    Login
                                </button>
                        </div>
                        	@if(Session::has('error'))

	    <div class="alert alert-danger">

	      {{ Session::get('error') }}

	    </div>

	@endif
						<div class="form-group">
                                <a class="btn-link" href="{{ route('forgot') }}">
                                    Forgot Your Password?
                                </a><br>
                                <span style="color:#428bca">Not Registered?</span>  <a class="btn-link" href="{{ route('register') }}">Create an account</a>
                        </div>
						</div>
						</div>
						
						<div class="col-sm-12 text-center">
						<?php  if (in_array('Facebook', $hidden)){?>
							<div class="form-group"><a href="{{ url('/login/facebook') }}"><img src="<?php echo $url;?>/local/images/button1.png" border="0"></a></div>
						<?php } ?>		
						<?php  if (in_array('Twitter', $hidden)){?>
							<div class="form-group"><a href="{{ url('/login/twitter') }}"><img src="<?php echo $url;?>/local/images/button2.png" border="0"></a></div>
						<?php } ?>	
							<?php  if (in_array('GPlus', $hidden)){?>
							<div class="form-group"><a href="{{ url('/login/google') }}"><img src="<?php echo $url;?>/local/images/button3.png" border="0"></a></div>
						<?php } ?>
					</div>
						
						
                    </form>
                </div>
            </div>
        </div>
        </div>

</div>

@endsection

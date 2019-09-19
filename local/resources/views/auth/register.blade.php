<div class="register-page">
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


	<div class="register-box">
        <div class="register-box-overlay">
            <div class="panel panel-default">
                
				<div class="panel-body text-center">
				<div class="login-logo text-center">
						 <a class="" href="<?php echo $url;?>"><img style="width:144px;" src="<?php echo $url.'/local/images/settings/'.$setts[0]->site_logo;?>" border="0" alt="" /></a>
					</div>
				<div class="col-xs-8 col-xs-offset-2">
					
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">

                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                                <input id="name" type="text" class="form-control input-lg" placeholder="Username" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                <input id="email" type="email" class="form-control input-lg" placeholder="E-Mail Address" name="email" value="{{ old('email') }}" required>

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
                                <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control input-lg" name="password_confirmation" required>
                        </div>											
						
						 <div class="form-group">
                                <input id="phoneno" type="text" class="form-control input-lg" placeholder="Phone No" name="phoneno" required>
                        </div>												
						
						<div class="form-group">
							<select name="gender" class="form-control input-lg" required>
							  
							  <option value="">Gender</option>
							   <option value="male">Male</option>
							   <option value="female">Female</option>
							</select>
                        </div>
						
						<div class="form-group">
							<select name="usertype" class="form-control input-lg" required>
							  
							  <option value="">User Type</option>
							   <option value="0">Customer</option>
							   <option style="display:none" value="2">Rhino</option>
							</select>                              
                        </div>

                        <div class="form-group">
                            <button type="submit" class="borbtn-inverse form-control btn btn-lg" style="color:black;">
                                Create account
                            </button>
                        </div>
                        
                         Already have an account? <a class="btn-link" href="{{ route('login') }}">Sign in</a>
                    </form>
                </div>
                </div>
				
            </div>
        </div>
    </div>
</div>
@endsection
<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	




</head>
<body>

    

    <!-- fixed navigation bar -->
    @include('header')

    <!-- slider -->
    

	
    
	
	
	
	
	
	
	
	<div class="clearfix sv_mob_clearfix"></div>
	
	
	
	
	
	<div class="video">
	<div class="clearfix sv_mob_clearfix"></div>
	<div class="headerbg">
	 <div class="col-md-12" align="center"><h1>2 Step Registration</h1></div>
	 </div>
	 
	 <div class="height30"></div>
	 
	 
	<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                
				<div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('step2') }}">
                        {{ csrf_field() }}

                        
						
						 <div class="form-group">
                            <label for="phoneno" class="col-md-4 control-label">Phone No</label>

                            <div class="col-md-6">
                                <input id="phoneno" type="text" class="form-control" name="phoneno" required>
                            </div>
                        </div>
						
						
						
						<div class="form-group">
                            <label for="gender" class="col-md-4 control-label">Gender</label>

                            <div class="col-md-6">
							<select name="gender" class="form-control" required>
							  
							  <option value=""></option>
							   <option value="male">Male</option>
							   <option value="female">Female</option>
							</select>
                               
                            </div>
                        </div>
						
						
						
						<div class="form-group">
                            <label for="usertype" class="col-md-4 control-label">User Type</label>

                            <div class="col-md-6">
							<select name="usertype" class="form-control" required>
							  
							  <option value=""></option>
							   <option value="0">Customer</option>
							   <option value="2">Seller</option>
							</select>
                               
                            </div>
                        </div>
						
						
						

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
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
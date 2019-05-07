<?php

namespace Responsive\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use File;
use Image;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	 
	 
	
 
	 
	 
	public function sangvish_step2()
	{
		if(Auth::user()->provider!="" && Auth::user()->admin==3)
	    {
		return view('step2');
		}
		else
		{
			return view('404');
			
		}
	}		
	 
	protected function sangvish_step2data(Request $request)
    {
		$data = $request->all();
		$logg = Auth::user()->id;
		
		$phoneno = $data['phoneno'];
		$gender = $data['gender'];
		$usertype = $data['usertype'];
		
		
		DB::update('update users set phone="'.$phoneno.'",gender="'.$gender.'",admin="'.$usertype.'" where id = ?', [$logg]);
		
		return redirect('/dashboard');
	}
	 
	 
    public function index()
    {
        $userid = Auth::user()->id;
		$editprofile = DB::select('select * from users where id = ?',[$userid]);
		$data = array('editprofile' => $editprofile);
		return view('dashboard')->with($data);
    }
	
	
	public function sangvish_logout()
	{
		Auth::logout();
       return back();
	}
	
	
	public function sangvish_deleteaccount()
	{
		$userid = Auth::user()->id;
		
		
		$userdetails = DB::table('users')
		 ->where('id', '=', $userid)
		 ->get();
		 
		 $getshop = DB::table('shop')
		 ->where('user_id', '=', $userid)
		 ->get();
		 
		 $getshop_count = DB::table('shop')
		 ->where('user_id', '=', $userid)
		 ->count();
		 
		 
		 
	  
	 $uemail = $userdetails[0]->email;
		
		
		DB::delete('delete from seller_services where user_id = ?',[$userid]);
	  DB::delete('delete from rating where email = ?',[$uemail]);
	  
	  if(!empty($getshop_count))
	  {
	  $shopid = $getshop[0]->id;
	  
	  DB::delete('delete from booking where shop_id = ?',[$shopid]);
	  DB::delete('delete from withdraw where withdraw_shop_id = ?',[$shopid]);
	  }
	  
	   DB::delete('delete from shop_gallery where user_id = ?',[$userid]);
	   
	   
	   
	   DB::delete('delete from shop where user_id = ?',[$userid]);
		
		
		DB::delete('delete from users where id!=1 and id = ?',[$userid]);
		return back();
	}
	
	
	
	
	 protected function sangvish_edituserdata(Request $request)
    {
       
		
		
		
		 $this->validate($request, [

        		'name' => 'required',

        		'email' => 'required|email'

        		
				
				

        	]);
         
		 $data = $request->all();
			
         $id=$data['id'];
        			
		$input['email'] = Input::get('email');
       
		$input['name'] = Input::get('name');
		
		
		$rules = array(
        
       
		
        'email'=>'required|email|unique:users,email,'.$id,
		'name' => 'required|regex:/^[\w-]*$/|max:255|unique:users,name,'.$id,
		'photo' => 'max:1024|mimes:jpg,jpeg,png'
		
		
        );
		
		
		$messages = array(
            
            'email' => 'The :attribute field is already exists',
            'name' => 'The :attribute field must only be letters and numbers (no spaces)'
			
        );
		
		
		
		
		
		 $validator = Validator::make(Input::all(), $rules, $messages);

		

		if ($validator->fails())
		{
			 $failedRules = $validator->failed();
			 
			return back()->withErrors($validator);
		}
		else
		{ 
		  

		$name=$data['name'];
		$email=$data['email'];
		$password=bcrypt($data['password']);
		
		
		
		$phone=$data['phone'];
		
		
		$currentphoto=$data['currentphoto'];
		
		
		$image = Input::file('photo');
        if($image!="")
		{	
            $userphoto="/userphoto/";
			$delpath = base_path('images'.$userphoto.$currentphoto);
			File::delete($delpath);	
			$filename  = time() . '.' . $image->getClientOriginalExtension();
            
            $path = base_path('images'.$userphoto.$filename);
      
                Image::make($image->getRealPath())->resize(200, 200)->save($path);
				$savefname=$filename;
		}
        else
		{
			$savefname=$currentphoto;
		}			
		
		
		if($data['password']!="")
		{
			$passtxt=$password;
		}
		else
		{
			$passtxt=$data['savepassword'];
		}
		
		$admin=$data['usertype'];
		
		
		if(!empty($data['gender']))
		{
		$gender = $data['gender'];
		}
		else
		{
			$gender = "";
		}
		
		
		
		DB::update('update users set name="'.$name.'",email="'.$email.'",password="'.$passtxt.'",phone="'.$phone.'",photo="'.$savefname.'",admin="'.$admin.'",gender="'.$gender.'" where id = ?', [$id]);
		
		DB::update('update shop set seller_email="'.$email.'" where user_id = ?', [$id]);
		
			return back()->with('success', 'Account has been updated');
        }
		
		
		
		
    }
	
	
}

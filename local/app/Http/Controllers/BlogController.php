<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Mail;


use Illuminate\Http\Middleware\VerifyCsrfToken;
class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
	
	
	public function blog_view() 
	{
      $count = DB::table('blog')
		         
				 ->orderBy('id', 'desc')
				 ->count(); 
	$data = array( 'count' => $count);			 
      return view('blog')->with($data);
    }
	
	
	public function blog_single($id)
	{
		$count = DB::table('blog')
		         ->where('id','=',$id)
				 
				 ->count(); 
		$gcount = DB::table('blog')
		         
				 ->orderBy('id', 'desc')
				 ->take(5)
				 ->count(); 

        
				 
				 
	$data = array( 'count' => $count, 'id' => $id, 'gcount' => $gcount);
		
		return view('blog-details')->with($data);
	}
   
   
	
	
}

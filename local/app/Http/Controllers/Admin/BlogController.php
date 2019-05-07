<?php

namespace Responsive\Http\Controllers\Admin;



use File;
use Image;
use Responsive\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Responsive\Http\Requests;
use Illuminate\Http\Request;
use Responsive\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        $blog = DB::table('blog')
		                ->orderBy('id','desc')
					   ->get();

        return view('admin.blog', ['blog' => $blog]);
    }
	
	
	public function destroy($id) {
		
		$image = DB::table('blog')->where('id', $id)->first();
		$orginalfile=$image->image;
		$blogphoto="/blog/";
       $path = base_path('images'.$blogphoto.$orginalfile);
	  File::delete($path);
      DB::delete('delete from blog where id = ?',[$id]);
	   
      return back();
      
   }
	
}
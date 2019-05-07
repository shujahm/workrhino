<?php

namespace Responsive\Http\Controllers;



use File;
use Image;
use Responsive\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Auth;

use Responsive\Http\Requests;
use Illuminate\Http\Request;
use Responsive\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class SubservicesController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
	
 
	 
    public function sangvish_index()
    {
        $services = DB::table('subservices')->orderBy('subname', 'asc')->get();
		
		
		
		
		$data = array('services' => $services);

        return view('subservices')->with($data); 
		  
    }
	
	public function sangvish_servicefind($id)
	{
		$subview=strtolower($id);
			$results = preg_replace('/-+/', ' ', $subview);
			
			 $service_id = DB::table('services')
			           ->where('name','=', $results)
					   ->get();
					   
			$services = DB::table('subservices')
			           
			           ->where('service','=', $service_id[0]->id)
					   ->get();	

			$serv_count = DB::table('subservices')
			           
			           ->where('service','=', $service_id[0]->id)
					   ->count();		   
		
		$data = array('services' => $services, 'serv_count' => $serv_count, 'service_id' => $service_id, 'id' => $id);

        return view('subservices')->with($data); 
		
	}
	
	
   
   
   
   
   
	
}
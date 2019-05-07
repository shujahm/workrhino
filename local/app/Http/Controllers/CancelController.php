<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Mail;


use Illuminate\Http\Middleware\VerifyCsrfToken;
class CancelController extends Controller
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
    
	protected $except = [
    'payu_failed/*',
    

    ];
	
	public function sangvish_showpage() {
		
		 
		 
		 
		 
		
		
		
		
		
	 
	  
      return view('cancel');
   }
   
   public function sangvish_payu(Request $request)
   {
	   $cid = $request->get('cid');
	   return redirect('payu_failed/'.$cid);
   }
  
  
	public function sangvish_payu_failed($cid) 
	{
			
			
			
			
				
				
				
				
				
				
				
				
				
		
		 $bookingupdate = DB::table('booking')
						->where('book_id', '=', $cid)
						->update(['status' => 'failed']);
			
			
		
		
		
		$datas = array('cid' => $cid);
     return view('payu_failed')->with($datas);
		
	
	  
	
	}
	
	
	
	
	
	
}

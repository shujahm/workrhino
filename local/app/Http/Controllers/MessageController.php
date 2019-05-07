<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Responsive\Http\Requests;
use Responsive\User;

use Mail;
use Auth;


class MessageController extends Controller
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
    
	
	
	public function my_chat_history($sender)
	{
		$receiver = Auth::user()->id;
		
		
		DB::update('update tbl_private_message set read_status="0" where receiver="'.$receiver.'" and sender = ?', [$sender]);
		
		
		$view_message_count = DB::table('tbl_private_message')
		                ->where('message','!=','')
                        ->whereIn('sender', [$sender,$receiver])
						->whereIn('receiver', [$sender,$receiver])
						->orderBy('pid','asc')
                        ->count();
						
		$view_message = DB::table('tbl_private_message')
		                ->where('message','!=','')
                        ->whereIn('sender', [$sender,$receiver])
						->whereIn('receiver', [$sender,$receiver])
						->orderBy('pid','asc')
                        ->get();
						
			$selected_user = DB::table('users')
                             ->where('id','=',$sender)
                             ->get();							 
						$usernamo = $selected_user[0]->name;
		
		$data = array('view_message' => $view_message, 'view_message_count' => $view_message_count, 'sender' => $sender, 'receiver' => $receiver, 'usernamo' => $usernamo);
		return view('chat')->with($data);
	
	}
	
	
	
	
	public function my_message()
	{
		$logid = Auth::user()->id;
		
		
		
		
		
		$view_message_count = DB::table('tbl_private_message')
                        ->where('sender', '=', $logid)
						->where('receiver', '!=', $logid)
						->groupBy('receiver')
						->orderBy('pid','desc')
                        ->count();
		
		
		
		$view_message = DB::table('tbl_private_message')
                        ->where('sender', '=', $logid)
						->where('receiver', '!=', $logid)
						->groupBy('receiver')
						->orderBy('pid','desc')
                        ->get();
		
		$data = array('view_message' => $view_message, 'view_message_count' => $view_message_count);
		return view('messages')->with($data);
		
	}
	
	
	public function add_message($sender,$receiver) 
	{
		
		
		$receive_user = DB::table('users')
               ->where('id', '=', $receiver)
                ->get();
		
	  
      
	  $data = array('receive_user' => $receive_user, 'sender' => $sender, 'receiver' => $receiver);
		return view('send-message')->with($data);
   }
   
   
   
   
   
   public function single_message(Request $request)
   {
	   
	   
	   $data = $request->all();
	   $sender = $data['sender'];
	   $receiver = $data['receiver'];
	   $msg = $data['msg'];
	   
	   $user_chk = DB::table('users')
                        ->where('id', '=', $sender)
						->get();
	   if($user_chk[0]->admin==2)
	   {
		   $types = "seller";
	   }
	   else if($user_chk[0]->admin==0)
	   {
		   $types = "customer";
	   }
	   else if($user_chk[0]->admin==1)
	   {
		   $types = "admin";
	   }
	   
	   $date_submitted = date('Y-m-d H:i:s');
	   
	   $read_status = 1;
	   
	   DB::insert('insert into tbl_private_message (sender,receiver,message,send_by,read_status,submitted) values (?, ?,?, ?,?,?)', [$sender,$receiver,$msg,$types,$read_status,$date_submitted]);
	   
	   
	   return back();
	   
   }	   
   
   
   public function post_message(Request $request)
   {
	   
	   
	   $data = $request->all();
	   
	   $sender = $data['sender'];
	   $receiver = $data['receiver'];
	   $message_txt = $data['message_txt'];
	   $send_by = $data['send_by'];
	   $date_submitted = date('Y-m-d H:i:s');
	   
	   
	DB::insert('insert into tbl_private_message (sender,receiver,message,send_by,submitted) values (?, ?,?, ?,?)', [$sender,$receiver,$message_txt,$send_by,$date_submitted]);
	
	
	$view_count = DB::table('tbl_private_message')
                        ->where('sender', '=', $receiver)
						->where('receiver', '=', $sender)
						->count();
		if(empty($view_count))
		{
			DB::insert('insert into tbl_private_message (sender,receiver,message,send_by,submitted) values (?, ?,?, ?,?)', [$receiver,$sender,'',$send_by,$date_submitted]);
		}			
		
		
			return back()->with('success', 'Your message has been sent successfully');   
	   
	   
	   
   }
   
   
   
   
	
	
	
}

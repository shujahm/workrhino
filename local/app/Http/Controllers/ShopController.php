<?php

namespace Responsive\Http\Controllers;

use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Image;
use Mail;

class ShopController extends Controller
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

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function remove_yourfav($shop_id)
    {

        DB::delete('delete from favorites where shop_id="' . $shop_id . '" and user_id = ?', [Auth::user()->id]);
        return back();
    }

    public function yourfav()
    {

        $shopcount = DB::table('shop')
            ->leftJoin('users', 'users.email', '=', 'shop.seller_email')
            ->leftJoin('rating', 'rating.rshop_id', '=', 'shop.id')
            ->leftJoin('favorites', 'favorites.shop_id', '=', 'shop.id')
            ->where('shop.status', '=', 'approved')
            ->where('favorites.user_id', '=', Auth::user()->id)
            ->orderBy('shop.id', 'desc')
            ->groupBy('shop.id')
            ->count();

        $data = array('shopcount' => $shopcount);
        return view('your-favorites')->with($data);

    }

    public function sangvish_successfull()
    {
        $userId = Auth::user()->id;
        $shopCount = DB::table('shop')
        ->where('user_id', '=', $userId)
        ->count();

        if($shopCount != 0)
        
            return view('registered_successfully');
        
        else 
        {
            return back();
        }
    }

    public function favorites($user_id, $shop_id)
    {

        $chk = DB::table('favorites')
            ->where('shop_id', '=', $shop_id)
            ->where('user_id', '=', $user_id)
            ->count();
        if (empty($chk)) {

            DB::insert('insert into favorites (shop_id,user_id) values (?, ?)', [$shop_id, $user_id]);
            return back();

        } else {

        }

    }

    public function sangvish_viewshop()
    {

        $time = array("12:00 AM" => "0", "01:00 AM" => "1", "02:00 AM" => "2", "03:00 AM" => "3", "04:00 AM" => "4", "05:00 AM" => "5", "06:00 AM" => "6", "07:00 AM" => "7", "08:00 AM" => "8",
            "09:00 AM" => "9", "10:00 AM" => "10", "11:00 AM" => "11", "12:00 PM" => "12", "01:00 PM" => "13", "02:00 PM" => "14", "03:00 PM" => "15", "04:00 PM" => "16", "05:00 PM" => "17", "06:00 PM" => "18",
            "07:00 PM" => "19", "08:00 PM" => "20", "09:00 PM" => "21", "10:00 PM" => "22", "11:00 PM" => "23");

        $days = array("1 Day" => "1", "2 Days" => "2", "3 Days" => "3", "4 Days" => "4", "5 Days" => "5", "6 Days" => "6", "7 Days" => "7", "8 Days" => "8", "9 Days" => "9",
            "10 Days" => "10", "11 Days" => "11", "12 Days" => "12", "13 Days" => "13", "14 Days" => "14", "15 Days" => "15", "16 Days" => "16", "17 Days" => "17", "18 Days" => "18",
            "19 Days" => "19", "20 Days" => "20", "21 Days" => "21", "22 Days" => "22", "23 Days" => "23", "24 Days" => "24", "25 Days" => "25", "26 Days" => "26", "27 Days" => "27",
            "28 Days" => "28", "29 Days" => "29", "30 Days" => "30");

        $daytxt = array("Sunday" => "0", "Monday" => "1", "Tuesday" => "2", "Wednesday" => "3", "Thursday" => "4", "Friday" => "5", "Saturday" => "6");

        $sellermail = Auth::user()->email;
        $shopcount = DB::table('shop')
            ->where('seller_email', '=', $sellermail)
            ->count();

        $shop = DB::table('shop')
            ->where('seller_email', '=', $sellermail)
            ->get();

        if ($shop[0]->start_time > 12) {
            $start = $shop[0]->start_time - 12;
            $stime = $start . "PM";
        } else {
            $stime = $shop[0]->start_time . "AM";
        }
        if ($shop[0]->end_time > 12) {
            $end = $shop[0]->end_time - 12;
            $etime = $end . "PM";
        } else {
            $etime = $shop[0]->end_time . "AM";
        }

        $sel = explode(",", $shop[0]->shop_date);
        $lev = count($sel);

        $uberid = Auth::user()->id;

        $viewservice = DB::table('seller_services')
            ->where('user_id', $uberid)
            ->orderBy('id', 'desc')
            ->leftJoin('subservices', 'subservices.subid', '=', 'seller_services.subservice_id')
            ->get();

        $set_id = 1;
        $setting = DB::table('settings')->where('id', $set_id)->get();

        $shop_id = $shop[0]->id;

        $rating_count = DB::table('rating')
            ->where('rshop_id', '=', $shop_id)

            ->count();

        $rating = DB::table('rating')
            ->leftJoin('users', 'users.email', '=', 'rating.email')
            ->where('rshop_id', '=', $shop_id)
            ->orderBy('rid', 'desc')

            ->get();

        $data = array('time' => $time, 'days' => $days, 'daytxt' => $daytxt, 'shopcount' => $shopcount, 'shop' => $shop, 'stime' => $stime,
            'etime' => $etime, 'lev' => $lev, 'sel' => $sel, 'viewservice' => $viewservice, 'setting' => $setting, 'rating_count' => $rating_count, 'rating' => $rating);
        return view('shop')->with($data);
    }

    public function sangvish_addshop()
    {

        $time = array("12:00 AM" => "0", "01:00 AM" => "1", "02:00 AM" => "2", "03:00 AM" => "3", "04:00 AM" => "4", "05:00 AM" => "5", "06:00 AM" => "6", "07:00 AM" => "7", "08:00 AM" => "8",
            "09:00 AM" => "9", "10:00 AM" => "10", "11:00 AM" => "11", "12:00 PM" => "12", "01:00 PM" => "13", "02:00 PM" => "14", "03:00 PM" => "15", "04:00 PM" => "16", "05:00 PM" => "17", "06:00 PM" => "18",
            "07:00 PM" => "19", "08:00 PM" => "20", "09:00 PM" => "21", "10:00 PM" => "22", "11:00 PM" => "23");

        $days = array("1 Day" => "1", "2 Days" => "2", "3 Days" => "3", "4 Days" => "4", "5 Days" => "5", "6 Days" => "6", "7 Days" => "7", "8 Days" => "8", "9 Days" => "9",
            "10 Days" => "10", "11 Days" => "11", "12 Days" => "12", "13 Days" => "13", "14 Days" => "14", "15 Days" => "15", "16 Days" => "16", "17 Days" => "17", "18 Days" => "18",
            "19 Days" => "19", "20 Days" => "20", "21 Days" => "21", "22 Days" => "22", "23 Days" => "23", "24 Days" => "24", "25 Days" => "25", "26 Days" => "26", "27 Days" => "27",
            "28 Days" => "28", "29 Days" => "29", "30 Days" => "30");

        $daytxt = array("Sunday" => "0", "Monday" => "1", "Tuesday" => "2", "Wednesday" => "3", "Thursday" => "4", "Friday" => "5", "Saturday" => "6");

        $sellermail = Auth::user()->email;
        $shopcount = DB::table('shop')
            ->where('seller_email', '=', $sellermail)
            ->count();

        $shop = DB::table('shop')
            ->where('seller_email', '=', $sellermail)
            ->get();

	$professions = DB::table('subservices')
		->orderBy('subname','asc')
		->get(); 


	$admin_type = Auth::user()->admin;
	$user_type = DB::table('users')
		->where('admin', '=', $admin_type);

        $admin_idd = 1;

        $admin_email_id = DB::table('users')
            ->where('id', '=', $admin_idd)
            ->get();

        $siteid = 1;
        $site_setting = DB::select('select * from settings where id = ?', [$siteid]);

        $data = array('time' => $time, 'days' => $days, 'daytxt' => $daytxt, 'professions' => $professions, 'admin_type' => $admin_type, 'shopcount' => $shopcount, 'shop' => $shop, 'admin_email_id' => $admin_email_id,
            'site_setting' => $site_setting);
        return view('addshop')->with($data);
    }

    public function sangvish_editshop(Request $request)
    {

        $testimonials = DB::table('testimonials')->orderBy('id', 'desc')->get();

        $time = array("12:00 AM" => "0", "01:00 AM" => "1", "02:00 AM" => "2", "03:00 AM" => "3", "04:00 AM" => "4", "05:00 AM" => "5", "06:00 AM" => "6", "07:00 AM" => "7", "08:00 AM" => "8",
            "09:00 AM" => "9", "10:00 AM" => "10", "11:00 AM" => "11", "12:00 PM" => "12", "01:00 PM" => "13", "02:00 PM" => "14", "03:00 PM" => "15", "04:00 PM" => "16", "05:00 PM" => "17", "06:00 PM" => "18",
            "07:00 PM" => "19", "08:00 PM" => "20", "09:00 PM" => "21", "10:00 PM" => "22", "11:00 PM" => "23");

        $days = array("1 Day" => "1", "2 Days" => "2", "3 Days" => "3", "4 Days" => "4", "5 Days" => "5", "6 Days" => "6", "7 Days" => "7", "8 Days" => "8", "9 Days" => "9",
            "10 Days" => "10", "11 Days" => "11", "12 Days" => "12", "13 Days" => "13", "14 Days" => "14", "15 Days" => "15", "16 Days" => "16", "17 Days" => "17", "18 Days" => "18",
            "19 Days" => "19", "20 Days" => "20", "21 Days" => "21", "22 Days" => "22", "23 Days" => "23", "24 Days" => "24", "25 Days" => "25", "26 Days" => "26", "27 Days" => "27",
            "28 Days" => "28", "29 Days" => "29", "30 Days" => "30");

        $daytxt = array("Sunday" => "0", "Monday" => "1", "Tuesday" => "2", "Wednesday" => "3", "Thursday" => "4", "Friday" => "5", "Saturday" => "6");

        $sellermail = Auth::user()->email;
        $shopcount = DB::table('shop')
            ->where('seller_email', '=', $sellermail)
            ->count();

        $shop = DB::table('shop')
            ->where('seller_email', '=', $sellermail)
            ->get();

        if ($shop[0]->start_time > 12) {
            $start = $shop[0]->start_time - 12;
            $stime = $start . "PM";
        } else {
            $stime = $shop[0]->start_time . "AM";
        }
        if ($shop[0]->end_time > 12) {
            $end = $shop[0]->end_time - 12;
            $etime = $end . "PM";
        } else {
            $etime = $shop[0]->end_time . "AM";
        }

        $sel = explode(",", $shop[0]->shop_date);
        $lev = count($sel);

        $requestid = $request->id;

        $editshop = DB::select('select * from shop where id = ?', [$requestid]);

        $data = array('time' => $time, 'days' => $days, 'daytxt' => $daytxt, 'shopcount' => $shopcount, 'shop' => $shop, 'stime' => $stime,
            'etime' => $etime, 'lev' => $lev, 'sel' => $sel, 'requestid' => $requestid, 'editshop' => $editshop);
        return view('editshop')->with($data);
    }

    protected function sangvish_savedata(Request $request)
    {

        $data = $request->all();

        $editid = $data['editid'];

        $rules = array(

            'shop_cover_photo' => 'max:1024|mimes:jpg,jpeg,png',
            'shop_profile_photo' => 'max:1024|mimes:jpg,jpeg,png',
            //'the-pdf' => 'max:2048|mimes:jpg,jpeg,png,pdf',		

        );

        $messages = array(

            'email' => 'The :attribute field is already exists',
            'name' => 'The :attribute field must only be letters and numbers (no spaces)',

        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            $failedRules = $validator->failed();

            return back()->withErrors($validator);
        } else {

            $shop_cover_photo = Input::file('shop_cover_photo');
            $shop_profile_photo = Input::file('shop_profile_photo');

            $image = $request->file('the-pdf');

            if ($shop_cover_photo != "") {

                $filename = time() . '322.' . $shop_cover_photo->getClientOriginalExtension();
                $shopphoto = "/shop/";
                $path = base_path('images' . $shopphoto . $filename);
                $destinationPath = base_path('images' . $shopphoto);

                Image::make($shop_cover_photo->getRealPath())->resize(1400, 300)->save($path);

                $namef = $filename;
            } else {

                if ($editid != "") {
                    $namef = $data['current_cover'];
                } else {
                    $namef = "";
                }

            }

            if ($shop_profile_photo != "") {

                $profilename = time() . '115.' . $shop_profile_photo->getClientOriginalExtension();
                $shopphoto = "/shop/";
                $paths = base_path('images' . $shopphoto . $profilename);

                /*$destinaPath=base_path('images'.$shopphoto);*/

                Image::make($shop_profile_photo->getRealPath())->resize(150, 150)->save($paths);
                /*Input::file('shop_profile_photo')->move($destinaPath, $profilename);*/
                $namepro = $profilename;
            } else {

                if ($editid != "") {
                    $namepro = $data['current_photo'];
                } else {
                    $namepro = "";
                }

            }

            if ($image != "") {
                $filename = time() . '550.' . $image->getClientOriginalExtension();
                $userphoto = "/shop/";
                $path = base_path('images' . $userphoto . $filename);
                $destinationPath = base_path('images' . $userphoto);

                /*Image::make($image->getRealPath())->resize(150, 150)->save($path);*/
                Input::file('the-pdf')->move($destinationPath, $filename);

                $nameff = $filename;
            } else {

                if ($editid != "") {
                    $nameff = $data['current_document'];
                } else {
                    $nameff = "";
                }

            }

            /*if($shop_cover_photo!="" &&  $shop_profile_photo!="" && $image!="")
            {

            if($shop_cover_photo!="")
            {
            if($editid!="")
            {
            $shophoto="/shop/";
            $delpath = base_path('images'.$shophoto.$data['current_cover']);
            File::delete($delpath);
            }

            $filename  = time() . '.' . $shop_cover_photo->getClientOriginalExtension();
            $shopphoto="/shop/";
            $path = base_path('images'.$shopphoto.$filename);
            $destinationPath=base_path('images'.$shopphoto);

            Image::make($shop_cover_photo->getRealPath())->resize(1400, 300)->save($path);

            $namef=$filename;
            }

            if($shop_profile_photo!="")
            {
            if($editid!="")
            {
            $shopro="/shop/";
            $delpaths = base_path('images'.$shopro.$data['current_photo']);
            File::delete($delpaths);
            }

            $profilename  = time() . '.' . $shop_profile_photo->getClientOriginalExtension();
            $shopphoto="/shop/";
            $paths = base_path('images'.$shopphoto.$profilename);

            Image::make($shop_profile_photo->getRealPath())->resize(150, 150)->save($paths);

            $namepro=$profilename;
            }

            if($image!="")
            {
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $userphoto="/shop/";
            $path = base_path('images'.$userphoto.$filename);
            $destinationPath=base_path('images'.$userphoto);

            Input::file('the-pdf')->move('../uploads', $filename);

            $nameff=$filename;
            }

            }*/

            $shop_name = $data['shop_name'];
            $shop_address = $data['shop_address'];

            $shop_phone_no = $data['shop_phone_no'];
            $shop_desc = $data['shop_desc'];
            $shop_working_days = $data['shop_working_days'];

            $shop_start_time = $data['shop_start_time'];
            $shop_end_time = $data['shop_end_time'];

            if ($shop_start_time > 12) {
                $start = $shop_start_time - 12;
                $stime = $start . "PM";
            } else {
                $stime = $shop_start_time . "AM";
            }
            if ($shop_end_time > 12) {
                $end = $shop_end_time - 12;
                $etime = $end . "PM";
            } else {
                $etime = $shop_end_time . "AM";
            }

            $shop_booking_upto = $data['shop_booking_upto'];
            $shop_booking_hour = $data['shop_booking_hour'];

            $workdays = "";
            foreach ($shop_working_days as $working_days) {
                $workdays .= $working_days . ',';
            }
            $workingdays = rtrim($workdays, ",");
		
		$profession = $data['profession'];

		$name_of_owner_or_contractor = $data['name_of_owner_or_contractor'];

		$number_of_rhinos_in_team = $data['number_of_rhinos_in_team'];

		$name_of_firm = $data['name_of_firm'];

		$shop_type_id = $data['shop_type_id'];

		$associated_with_contractor = $data['associated_with_contractor'];

		$date_of_registration = $data['date_of_registration'];

		$gender = $data['gender'];

		$cnic = $data['cnic'];

            $sellermail = Auth::user()->email;

            $sellerid = Auth::user()->id;

            $featured = "no";

            $status = "unapproved";

            $admin_email_status = 0;

            $adminid = 1;

            if (!empty($data['status'])) {
                $editstatus = $data['status'];
            } else {
                $editstatus = "";
            }

            if (!empty($data['tax_percent'])) {
                $tax_percent = $data['tax_percent'];
            } else {
                $tax_percent = "";
            }

            $site_logo = $data['site_logo'];

            $site_name = $data['site_name'];

            $sellermaile = Auth::user()->email;
            $shopcnt = DB::table('shop')
                ->where('seller_email', '=', $sellermaile)
                ->count();

            if ($editid == "") {
                if ($shopcnt == 0) {

                    DB::insert('insert into shop (shop_name,address,shop_phone_no,description,shop_date,start_time,end_time,cover_photo,
		profile_photo,	shop_document,seller_email,user_id,featured,status,admin_email_status,booking_opening_days,booking_per_hour,tax_percent   ,profession,name_of_owner_or_contractor,number_of_rhinos_in_team,name_of_firm,shop_type_id,associated_with_contractor,date_of_registration,gender,cnic) values (?, ?, ? ,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?    ,?,?,?,?,?,?,?,?,?)',
                        [$shop_name, $shop_address, $shop_phone_no, $shop_desc, $workingdays, $shop_start_time,
                            $shop_end_time, $namef, $namepro, $nameff, $sellermail, $sellerid, $featured, $status, $admin_email_status, $shop_booking_upto, $shop_booking_hour, $tax_percent    ,$profession,$name_of_owner_or_contractor,$number_of_rhinos_in_team,$name_of_firm,$shop_type_id,$associated_with_contractor,$date_of_registration,$gender,$cnic]);


		//$shop_booking_hour;
		$hours_time="8";
		//$profession;
		$servi_id=DB::table('subservices')->where('subid', $profession)->get();
	   	$service_id = $servi_id[0]->service;
		//$sellerid;
		$shop_data=DB::table('shop')->where('user_id',$sellerid)->get();
		$shop_id = $shop_data[0]->id;
		
		DB::insert('insert into seller_services (service_id,subservice_id,price,time,user_id,shop_id) values (?,?,?,?,?,?)' , [$service_id,$profession,$shop_booking_hour,$hours_time,$sellerid,$shop_id]);

                    Mail::send('shopadminemail', ['shop_name' => $shop_name, 'address' => $shop_address, 'shop_phone_no' => $shop_phone_no, 'description' => $shop_desc, 'booking_opening_days' => $shop_booking_upto,
                        'booking_per_hour' => $shop_booking_hour, 'stime' => $stime, 'etime' => $etime, 'site_logo' => $site_logo, 'site_name' => $site_name], function ($message) {
                        $message->subject('Rhino Registered Successfully');

                        /* $message->from(Auth::user()->email, Auth::user()->name);

                        $message->to(Input::get('admin_email_id')); */

                        $message->from(Input::get('admin_email_id'), 'Admin');

                        $message->to(Input::get('admin_email_id'));

                    });

                    Mail::send('shopuseremail', ['shop_name' => $shop_name, 'address' => $shop_address, 'shop_phone_no' => $shop_phone_no, 'description' => $shop_desc, 'booking_opening_days' => $shop_booking_upto,
                        'booking_per_hour' => $shop_booking_hour, 'stime' => $stime, 'etime' => $etime, 'site_logo' => $site_logo, 'site_name' => $site_name], function ($message) {
                        $message->subject('New Rhino Registered');

                        $message->from(Input::get('admin_email_id'), 'Admin');

                        $message->to(Auth::user()->email);

                    });

                }

            } else if ($editid != "") {
                DB::update('update shop set shop_name="' . $shop_name . '",address="' . $shop_address . '",shop_phone_no="' . $shop_phone_no . '",description="' . $shop_desc . '",shop_date="' . $workingdays . '",start_time="' . $shop_start_time . '",
			end_time="' . $shop_end_time . '",cover_photo="' . $namef . '",profile_photo="' . $namepro . '",shop_document="' . $nameff . '",seller_email="' . $sellermail . '",user_id="' . $sellerid . '",featured="' . $featured . '",
			status="' . $editstatus . '",admin_email_status="' . $admin_email_status . '",booking_opening_days="' . $shop_booking_upto . '",booking_per_hour="' . $shop_booking_hour . '",tax_percent="' . $tax_percent . '" where id = ?', [$editid]);
            }

            /* return back()->with('success', 'Shop has been created');*/

            return redirect('registered-successfully');

        }

    }

}

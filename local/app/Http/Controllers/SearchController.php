<?php

namespace Responsive\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
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
	
	public function sangvish_view()

	{
		
		$viewservices= DB::table('subservices')->orderBy('subname','asc')->get();
      
		$shopview=DB::table('shop')
		->leftJoin('users', 'users.email', '=', 'shop.seller_email')
		->leftJoin('rating', 'rating.rshop_id', '=', 'shop.id')
		->where('shop.status', 'approved')->orderBy('shop.id','desc')
		->groupBy('shop.id')
		->get();
		
		
		
		
		
		
		
		
		$data = array('viewservices' => $viewservices,'shopview' => $shopview);
		return view('search')->with($data);
	}
	
	
	public function sangvish_homeindex($id)
	{
		
		$subview=strtolower($id);
			$results = preg_replace('/-+/', ' ', $subview); 
		
		
		
		 $services = DB::table('subservices')->where('subname', $results)->get();
		 
		 $subsearches = DB::table('shop')
		->leftJoin('seller_services', 'seller_services.shop_id', '=', 'shop.id')
		->leftJoin('rating', 'rating.rshop_id', '=', 'shop.id')
		->leftJoin('users', 'users.email', '=', 'shop.seller_email')
		->where('shop.status', '=', 'approved')
		->where('seller_services.subservice_id', '=', $services[0]->subid)
		->groupBy('shop.id')
		->get();
		
		$viewservices= DB::table('subservices')->orderBy('subname','asc')->get();
		
		$shopview=DB::table('shop')
		         ->leftJoin('rating', 'rating.rshop_id', '=', 'shop.id')
		         ->where('shop.status', '=', 'approved')
				 ->orderBy('shop.id','desc')->get();
		
		$sub_value = $id;
		
		$data = array('subsearches' => $subsearches, 'viewservices' => $viewservices, 'shopview' => $shopview, 'sub_value' => $sub_value, 'services' => $services);
            return view('search')->with($data);
		
	}
	
    public function sangvish_index(Request $request)
    {
		
       
		$datas = $request->all();
          
		  $search_text=$datas['search_text'];
		  $count= DB::table('subservices')->where('subname', $search_text)->count();
		  
		  if(!empty($count))
		  {
		  $services = DB::table('subservices')->where('subname', $search_text)->get();
		  
		   $subsearches = DB::table('shop')
		->leftJoin('seller_services', 'seller_services.shop_id', '=', 'shop.id')
		->leftJoin('rating', 'rating.rshop_id', '=', 'shop.id')
		->leftJoin('users', 'users.email', '=', 'shop.seller_email')
		->where('shop.status', '=', 'approved')
		->where('seller_services.subservice_id', '=', $services[0]->subid)
		->orderBy('shop.id','desc')
		->groupBy('shop.id')
		->get();
		  }
		 if(empty($count))
		  {
			  $services = "";
			   $subsearches = "";
		  }
		  
		  $viewservices= DB::table('subservices')->orderBy('subname','asc')->get();
		  
		  $shopview=DB::table('shop')
		         ->leftJoin('rating', 'rating.rshop_id', '=', 'shop.id')
		         ->where('shop.status', '=', 'approved')
				 ->orderBy('shop.id','desc')->get();
		  
		  
		  $sub_value="";
		 
      
		
		$data = array('services' => $services, 'viewservices' => $viewservices, 'shopview' => $shopview, 'subsearches' => $subsearches, 'count' => $count,
		'search_text' => $search_text, 'sub_value' => $sub_value);
            return view('search')->with($data);
    }
	
	public function sangvish_search(Request $request)
	{
		
		 $shopview=DB::table('shop')
		 ->leftJoin('users', 'users.email', '=', 'shop.seller_email')
		 ->leftJoin('rating', 'rating.rshop_id', '=', 'shop.id')
		 ->where('shop.status', 'approved')->orderBy('shop.id','desc')->get();
		
		 $viewservices= DB::table('subservices')->orderBy('subname','asc')->get();
		 
		 $datas = $request->all();
		 
		 
		 
		 
		 
		 
		 if(!empty($datas["langOpt"])){ $category = $datas["langOpt"]; }
		 if(!empty($datas['city'])) { $city = $datas['city']; }
		 if(!empty($datas['star_rate'])){ $star_rate = $datas['star_rate']; }
		 
		 $approved='approved';
		 
		 
		 if(!empty($category))
		 {
		 
		 $langOpt=$datas["langOpt"];
		 $newlang="";
		 $vvnew="";
		 $views="";
		 foreach($langOpt as $langs)
		 {
			 $viewname= DB::table('subservices')->where("subid", "=" , $langs)->get();
			 $views .=$viewname[0]->subname.",";
			 $newlang .=$langs.",";
			 $vvnew .="'".$langs."',";
		 }
		 $viewnames =rtrim($views,",");
		 $selservice =rtrim($newlang,",");
		 $welservice =rtrim($vvnew,",");
		 
		 
		 
		 $count = DB::table('shop')
		->leftJoin('seller_services', 'seller_services.shop_id', '=', 'shop.id')
		->leftJoin('rating', 'rating.rshop_id', '=', 'shop.id')
		->leftJoin('users', 'users.email', '=', 'shop.seller_email')
		
		->whereRaw('FIND_IN_SET(seller_services.subservice_id,"'.$selservice.'")')
		
		->where('shop.status', '=', "approved")
		
		 ->groupBy('seller_services.shop_id')
		 
         ->count();
		 
		 
		$return = 1;
		 
		 $data = array('viewservices' => $viewservices,  'selservice' => $selservice, 'viewnames' => $viewnames,
		 'count' => $count, 'return' => $return, 'category' => $category,'shopview' => $shopview);
		 }
		 
		 
		 
		 
		 
		 
		 if(!empty($city))
		 {
			   
		 $city_valuee = "'%".$city."%'";
		 $approved = "approved";
		 
		/* $count = DB::table('shop')
		->leftJoin('seller_services', 'seller_services.shop_id', '=', 'shop.id')
		->leftJoin('rating', 'rating.rshop_id', '=', 'shop.id')
		->leftJoin('users', 'users.email', '=', 'shop.seller_email')
		->where('shop.status', '=', "'".$approved."'")
			->where('shop.addresss','LIKE',$city_valuee)
			 ->groupBy('shop.id')
		 
         ->count();*/
		 
		 $counted = DB::table("select * from shop left join seller_services on seller_services.shop_id = shop.id left join rating on rating.rshop_id = shop.id left join users on users.email = shop.seller_email where shop.status = '".$approved."' and shop.address LIKE {$city_valuee} group by shop.id");
		 
		 $count = count($counted);
		
	     
		 
		 
		 $viewnames =$datas['city'];
		 
		  $return = 2;
		 
			$data = array('viewservices' => $viewservices, 'viewnames' => $viewnames, 'count' => $count, 'return' => $return, 'city' => $city,'shopview' => $shopview);
		  
		  
		 }
		 
		 
		 
		 if(!empty($star_rate))
		 {
			 
			  
		 
		 
		 $count = DB::table('shop')
		->leftJoin('seller_services', 'seller_services.shop_id', '=', 'shop.id')
		->leftJoin('rating', 'rating.rshop_id', '=', 'shop.id')
		->leftJoin('users', 'users.email', '=', 'shop.seller_email')
		->where('shop.status', '=', "approved")
			
			->where('rating.rating','=', $datas['star_rate'])
			 ->groupBy('seller_services.shop_id')
		 
         ->count();
		 
		 
		 $viewnames =$datas['city'];
		 
		 $return = 3;
		 
		 
	$data = array('viewservices' => $viewservices,  'viewnames' => $viewnames, 'count' => $count, 'return' => $return, 'star_rate' => $star_rate,'shopview' => $shopview);
	
	 } 
		 
	
	
	if(!empty($city) && !empty($star_rate))
		{
			
			$city_valuee = "'%".$city."%'";
		 $approved = "approved";
			
		 
		 
		 
		 $counted = DB::SELECT("select * from shop left join seller_services on seller_services.shop_id = shop.id left join rating on rating.rshop_id = shop.id left join users on users.email = shop.seller_email where shop.address LIKE {$city_valuee} and rating.rating = '".$star_rate."' and shop.status = '".$approved."' group by shop.id");
		 
		 $count = count($counted);
		 
		$return = 4;
		 
		 $data = array('viewservices' => $viewservices,  'viewnames' => $viewnames,
		 'count' => $count, 'return' => $return, 'city' => $city, 'star_rate' => $star_rate,'shopview' => $shopview);
		}
	
	
	
	
	if(!empty($category) && !empty($star_rate) && !empty($city))
		 {
		     $langOpt=$datas["langOpt"];
		 $newlang="";
		 $vvnew="";
		 $views="";
		 foreach($langOpt as $langs)
		 {
			 $viewname= DB::table('subservices')->where("subid", "=" , $langs)->get();
			 $views .=$viewname[0]->subname.",";
			 $newlang .=$langs.",";
			 $vvnew .="'".$langs."',";
		 }
		 $viewnames =rtrim($views,",");
		 $selservice =rtrim($newlang,",");
		 $welservice =rtrim($vvnew,",");
		 
		 $city_valuee = "'%".$city."%'";
		 $approved = "approved";
		 
		 
		 
		 
		 $counted = DB::SELECT("select count(*) as aggregate from shop left join seller_services on seller_services.shop_id = shop.id left join rating on rating.rshop_id = shop.id left join users on users.email = shop.seller_email where FIND_IN_SET(seller_services.subservice_id,'".$selservice."') and shop.address LIKE {$city_valuee} and rating.rating = '".$star_rate."' and shop.status = '".$approved."' group by shop.id");
		 
		 
		$count = count($counted);
		 
		 $data = array('viewservices' => $viewservices,  'selservice' => $selservice, 'viewnames' => $viewnames,
		 'count' => $count, 'return' => $return, 'category' => $category, 'star_rate' => $star_rate, 'city' => $city,'shopview' => $shopview);

		 
		 }
		 
	
	
	if(!empty($category) && !empty($city) && empty($star_rate))
		 {
		     $langOpt=$datas["langOpt"];
		 $newlang="";
		 $vvnew="";
		 $views="";
		 foreach($langOpt as $langs)
		 {
			 $viewname= DB::table('subservices')->where("subid", "=" , $langs)->get();
			 $views .=$viewname[0]->subname.",";
			 $newlang .=$langs.",";
			 $vvnew .="'".$langs."',";
		 }
		 $viewnames =rtrim($views,",");
		 $selservice =rtrim($newlang,",");
		 $welservice =rtrim($vvnew,",");
		 
		 $city_valuee = "'%".$city."%'";
		 $approved = "approved";
		 
		 
		 
		 
		 $counted = DB::SELECT("select * from shop left join seller_services on seller_services.shop_id = shop.id left join rating on rating.rshop_id = shop.id left join users on users.email = shop.seller_email where FIND_IN_SET(seller_services.subservice_id,'".$selservice."') and shop.address LIKE {$city_valuee} and shop.status = '".$approved."' group by seller_services.shop_id");
		 
		 
		 $count = count($counted);
		 
		 
		 
		$return = 6;
		 
		 $data = array('viewservices' => $viewservices,  'selservice' => $selservice, 'viewnames' => $viewnames,
		 'count' => $count, 'return' => $return, 'category' => $category, 'city' => $city,'shopview' => $shopview);

		 
		 }
		 
		 
		 
		 if(!empty($category) && !empty($star_rate) && empty($city))
		 {
		     $langOpt=$datas["langOpt"];
		 $newlang="";
		 $vvnew="";
		 $views="";
		 foreach($langOpt as $langs)
		 {
			 $viewname= DB::table('subservices')->where("subid", "=" , $langs)->get();
			 $views .=$viewname[0]->subname.",";
			 $newlang .=$langs.",";
			 $vvnew .="'".$langs."',";
		 }
		 $viewnames =rtrim($views,",");
		 $selservice =rtrim($newlang,",");
		 $welservice =rtrim($vvnew,",");
		 
		 
		 
		 
		 
		 
		 $counted = DB::SELECT("select count(*) as aggregate from shop left join seller_services on seller_services.shop_id = shop.id left join rating on rating.rshop_id = shop.id left join users on users.email = shop.seller_email where FIND_IN_SET(seller_services.subservice_id,'".$selservice."') and rating.rating = '".$star_rate."' and shop.status = '".$approved."' group by seller_services.shop_id");
		 
		 $count = count($counted);
		 
		 
		$return = 7;
		 
		 $data = array('viewservices' => $viewservices,  'selservice' => $selservice, 'viewnames' => $viewnames,
		 'count' => $count, 'return' => $return, 'category' => $category, 'star_rate' => $star_rate,'shopview' => $shopview);

		 
		 }
		 
		 
	if(empty($category) && empty($city) && empty($star_rate)) { 
	
	$count=DB::table('shop')
		 ->leftJoin('users', 'users.email', '=', 'shop.seller_email')
		 ->leftJoin('rating', 'rating.rshop_id', '=', 'shop.id')
		 ->where('shop.status', 'approved')->orderBy('shop.id','desc')->groupBy('shop.id')->count();
	$viewnames = "";
	$return = 8;
	
	$data = array('viewservices' => $viewservices,  'viewnames' => $viewnames,
		 'count' => $count, 'return' => $return);
	}
		 
		 
		 
		 
		 
		
		 
            return view('shopsearch')->with($data);
	}
	
	
	
	
	
	
	
	
	
	
	
}

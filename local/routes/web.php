<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

/*Route::get('/index', 'CommonController@home');
Route::get('/',confirmation 'CommonController@home');*/

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('index/{username}', 'IndexController@resend_email');

Route::get('/', 'IndexController@sangvish_index');
Route::get('/index', 'IndexController@sangvish_index');

Route::get('searchajax', array('as' => 'searchajax', 'uses' => 'IndexController@sangvish_autoComplete'));

Route::get('dateavailable/{val}', array('as' => 'dateavailable', 'uses' => 'BookingController@dateavailable'));

Route::get('/become-a-rhino', 'DashboardController@sangvish_logout');
Route::get('/logout', 'DashboardController@sangvish_logout');
Route::get('/delete-account', 'DashboardController@sangvish_deleteaccount');
Route::post('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@sangvish_edituserdata']);

Route::get('/shop', 'ShopController@sangvish_viewshop');
Route::get('/registered-successfully', 'ShopController@sangvish_successfull');

Route::get('/addshop', 'ShopController@sangvish_addshop');

Route::get('/editshop/{id}', 'ShopController@sangvish_editshop');

Route::post('/editshop', ['as' => 'editshop', 'uses' => 'ShopController@sangvish_savedata']);

Route::post('/addshop', ['as' => 'addshop', 'uses' => 'ShopController@sangvish_savedata']);

Route::get('/rhino/{id}', 'VendorController@sangvish_showpage');
Route::post('/rhino', ['as' => 'rhino', 'uses' => 'VendorController@sangvish_savedata']);

Route::get('/step2', 'DashboardController@sangvish_step2');
Route::post('/step2', ['as' => 'step2', 'uses' => 'DashboardController@sangvish_step2data']);

Route::get('/confirmemail/{id}', 'IndexController@confirmation');

Route::get('/confirmemail', 'IndexController@view_former');

Route::get('/forgot', 'IndexController@sangvish_forgot');
Route::post('/forgot', ['as' => 'forgot', 'uses' => 'IndexController@sangvish_forgotdata']);

Route::get('/reset/{token}', 'IndexController@sangvish_reset');
Route::post('/reset', ['as' => 'reset', 'uses' => 'IndexController@sangvish_resetdata']);

Route::get('/booking/{shop_id}/{service_id}/{userid}', 'BookingController@sangvish_showpage')->middleware('noCache');
Route::post('/booking', ['as' => 'booking', 'uses' => 'BookingController@sangvish_savedata']);

Route::get('/booking_info', 'BookinginfoController@sangvish_viewbook');

Route::post('/booking_info', ['as' => 'booking_info', 'uses' => 'PaymentController@sangvish_showpage'])->middleware('homeRedirect');
/* not working */
Route::get('/payment/{sum_val}/{admin_email}', 'PaymentController@sangvish_showpage');

Route::post('/payment', ['as' => 'payment', 'uses' => 'PaymentController@sangvish_wallet_transfer']);
/* not wroking */
Route::get('/success/{cid}', 'SuccessController@sangvish_success');
Route::post('/stripe-success', ['as' => 'stripe-success', 'uses' => 'StripeController@sangvish_stripe']);

Route::get('/payu_failed/{cid}', 'CancelController@sangvish_payu_failed');

/*Route::post('payu_failed/{cid}', function () {

return redirect('payu_failed/{cid}');
});*/

/* messages */

Route::get('/send-message/{sender_id}/{receiver_id}', 'MessageController@add_message');

Route::post('/send-message', ['as' => 'send-message', 'uses' => 'MessageController@post_message']);

Route::get('/messages', 'MessageController@my_message');

Route::get('/chat/{sender}', 'MessageController@my_chat_history');

Route::post('/chat', ['as' => 'chat', 'uses' => 'MessageController@single_message']);

/* messages */

Route::post('payu_failed/{cid}', function ($cid) {

    return redirect('payu_failed/' . $cid);
});

Route::get('/payu_success/{cid}/{txtid}', 'SuccessController@sangvish_payu_success');

Route::post('payu_success/{cid}/{txtid}', function ($cid, $txtid) {

    return redirect('payu_success/' . $cid . '/' . $txtid);
});

Route::get('/cancel', 'CancelController@sangvish_showpage');

Route::get('/myorder', 'MyorderController@sangvish_showpage');

Route::get('/myorder/{id}', 'MyorderController@sangvish_destroy');

Route::get('/myorder/{reject}/{id}', 'MyorderController@sangvish_reject');

Route::get('/myorder/{service}/{id}/{status_id}', 'MyorderController@sangvish_service_status');

Route::get('/myorderPayment/{service}/{id}/{status}', 'MyorderController@sangvish_payment_status');

// Route::get('/my_request', 'RequestController@my_request');

Route::get('/my_applied_request', 'RequestController@my_applied_request');

Route::get('/buyer_request', 'ViewRequestController@view_all_request');

Route::get('/my_freelancer_request', 'JobSalesController@view_freelancer_manage_sales');

// Route::get('/my_client_request', 'JobSalesController@view_my_client_shopping');

Route::get('/my_bookings/{release}/{id}/{shop_id}', 'MybookingsController@sangvish_released');
//Route::get('/my_bookings/{release}/{MTQS}/{shop_id}', 'MybookingsController@sangvish_released');

Route::get('/my_bookings/{cancel}/{id}', 'MybookingsController@sangvish_cancel_booking');

Route::get('/my_bookings', 'MybookingsController@sangvish_showpage');

Route::post('/my_bookings', ['as' => 'my_bookings', 'uses' => 'MybookingsController@sangvish_savedata']);

Route::post('/my_book', ['as' => 'my_book', 'uses' => 'MybookingsController@sangvish_disputedata']);

Route::get('/wallet', 'WalletController@sangvish_showpage');

Route::post('/wallet', ['as' => 'wallet', 'uses' => 'WalletController@sangvish_savedata']);

Auth::routes();

Route::get('/about-us', 'PageController@sangvish_about_us');

Route::get('/become-a-rhino', 'PageController@sangvish_become_a_rhino');

Route::get('/our-services', 'PageController@sangvish_our_services');

Route::get('/our-locations', 'PageController@sangvish_our_locations');

Route::get('/terms-and-privacy', 'PageController@sangvish_terms_and_privacy');

Route::get('/privacy-policy', 'PageController@sangvish_privacy_policy');

Route::get('/404', 'PageController@sangvish_404');

Route::get('/how-it-works', 'PageController@sangvish_howit');

Route::get('/safety', 'PageController@sangvish_safety');

Route::get('/service-guide', 'PageController@sangvish_guide');

Route::get('/how-to-pages', 'PageController@sangvish_topages');

//Route::get('/contact', 'PageController@sangvish_contact');

//Route::post('/contact', ['as' => 'contact', 'uses' => 'PageController@sangvish_mailsend']);

//Route::get('/services', 'ServicesController@sangvish_index');
//Route::get('/services/{id}', 'ServicesController@sangvish_editdata');

//Route::post('/services', ['as' => 'services', 'uses' => 'ServicesController@sangvish_savedata']);
//Route::get('/services/{did}/delete', 'ServicesController@sangvish_destroy');

Route::get('/gallery', 'GalleryController@sangvish_index');
Route::post('/gallery', ['as' => 'gallery', 'uses' => 'GalleryController@sangvish_savedata']);
Route::get('/gallery/{id}', 'GalleryController@sangvish_editdata');
Route::get('/gallery/{did}/delete', 'GalleryController@sangvish_destroy');

Route::get('/search', 'SearchController@sangvish_view');

Route::get('/search/{id}', 'SearchController@sangvish_homeindex');

Route::post('/search', ['as' => 'search', 'uses' => 'SearchController@sangvish_index']);
Route::get('/shopsearch', 'SearchController@sangvish_view');
Route::post('/shopsearch', ['as' => 'shopsearch', 'uses' => 'SearchController@sangvish_search']);

Route::get('/subservices', 'SubservicesController@sangvish_index');

Route::get('/subservices/{id}', 'SubservicesController@sangvish_servicefind');

/* Route::group(['namespace' => 'Admin', 'middleware' => 'admin'], function() {*/

Route::group(['middleware' => 'admin'], function () {

    Route::get('/admin', 'Admin\DashboardController@index');
    Route::get('/admin/index', 'Admin\DashboardController@index');

    /* user */
    Route::get('/admin/users', 'Admin\UsersController@index');
    Route::get('/admin/sellers', 'Admin\UsersController@seller_index');
    Route::get('/admin/adduser', 'Admin\AdduserController@formview');
    Route::post('/admin/adduser', ['as' => 'admin.adduser', 'uses' => 'Admin\AdduserController@adduserdata']);

    Route::get('/admin/users/{id}', 'Admin\UsersController@destroy');
    Route::get('/admin/edituser/{id}', 'Admin\EdituserController@showform');
    Route::post('/admin/edituser', ['as' => 'admin.edituser', 'uses' => 'Admin\EdituserController@edituserdata']);
    /* end user */

    /* services */
    Route::get('/admin/services', 'Admin\ServicesController@index');
    Route::get('/admin/addservice', 'Admin\AddserviceController@formview');
    Route::post('/admin/addservice', ['as' => 'admin.addservice', 'uses' => 'Admin\AddserviceController@addservicedata']);
    Route::get('/admin/services/{id}', 'Admin\ServicesController@destroy');
    Route::get('/admin/editservice/{id}', 'Admin\EditserviceController@showform');
    Route::post('/admin/editservice', ['as' => 'admin.editservice', 'uses' => 'Admin\EditserviceController@editservicedata']);

    /* end services */

    /* sub services */

    Route::get('/admin/subservices', 'Admin\SubservicesController@index');
    Route::get('/admin/addsubservice', 'Admin\AddsubserviceController@formview');
    Route::get('/admin/addsubservice', 'Admin\AddsubserviceController@getservice');
    Route::post('/admin/addsubservice', ['as' => 'admin.addsubservice', 'uses' => 'Admin\AddsubserviceController@addsubservicedata']);
    Route::get('/admin/subservices/{id}', 'Admin\SubservicesController@destroy');

    Route::get('/admin/editsubservice/{id}', 'Admin\EditsubserviceController@edit');

    Route::post('/admin/editsubservice', ['as' => 'admin.editsubservice', 'uses' => 'Admin\EditsubserviceController@editsubservicedata']);
    /* end sub services */

    /* Testimonials */

    Route::get('/admin/testimonials', 'Admin\TestimonialsController@index');
    Route::get('/admin/add-testimonial', 'Admin\AddtestimonialController@formview');
    Route::post('/admin/add-testimonial', ['as' => 'admin.add-testimonial', 'uses' => 'Admin\AddtestimonialController@addtestimonialdata']);
    Route::get('/admin/testimonials/{id}', 'Admin\TestimonialsController@destroy');
    Route::get('/admin/edit-testimonial/{id}', 'Admin\EdittestimonialController@showform');
    Route::post('/admin/edit-testimonial', ['as' => 'admin.edit-testimonial', 'uses' => 'Admin\EdittestimonialController@testimonialdata']);

    /* end Testimonials */

    /* pages */

    Route::get('/admin/pages', 'Admin\PagesController@index');
    Route::get('/admin/edit-page/{id}', 'Admin\PagesController@showform');
    Route::post('/admin/edit-page', ['as' => 'admin.edit-page', 'uses' => 'Admin\PagesController@pagedata']);

    /* end pages */

    /* dispute */

    Route::get('/admin/dispute', 'Admin\DisputeController@index');

    Route::get('/admin/dispute/{customer_id}/{vendor_id}/{booking_id}', 'Admin\DisputeController@refund_customer');

    Route::get('/admin/dispute/{customer_id}/{vendor_id}/{booking_id}/{amount}', 'Admin\DisputeController@refund_vendor');
    /* end dispute */

    /* start settings */

    Route::get('/admin/settings', 'Admin\SettingsController@showform');
    Route::post('/admin/settings', ['as' => 'admin.settings', 'uses' => 'Admin\SettingsController@editsettings']);

    /* end settings */

    /* start shop */

    Route::get('/admin/shop', 'Admin\ShopController@index');
    Route::get('/admin/edit-shop/{id}', 'Admin\ShopController@showform');
    Route::post('/admin/edit-shop', ['as' => 'admin.edit-shop', 'uses' => 'Admin\ShopController@savedata']);
    Route::get('/admin/shop/{id}/{sid}', 'Admin\ShopController@status_view');
    Route::get('/admin/shop/{id}', 'Admin\ShopController@destroy');

    /* end shop */

    /* booking history */

    Route::get('/admin/booking', 'Admin\BookingController@index');
    Route::get('/admin/booking/{id}', 'Admin\BookingController@destroy');

    /*  end booking history */

    /* withdraw */

    Route::get('/admin/pending_withdraw', 'Admin\WithdrawController@index');
    Route::get('/admin/pending_withdraw/{id}', 'Admin\WithdrawController@update');
    Route::get('/admin/completed_withdraw', 'Admin\WithdrawController@doneindex');

    /* end withdraw */

});

/* jobs and job orders*/

Route::get('/admin/request', 'Admin\RequestController@index');
Route::get('/admin/request-orders', 'Admin\OrdersController@request_index');
Route::get('/admin/view_request/{id}', 'Admin\RequestController@gig_viewmore');
Route::get('/admin/request/{status}/{sid}/{id}', 'Admin\RequestController@status');
Route::get('/admin/request/{id}', 'Admin\RequestController@destroy');
Route::get('/admin/orders/{sid}/{id}', 'Admin\OrdersController@status');
Route::get('/admin/orders/{id}', 'Admin\OrdersController@destroy');

/* jobs and job orders */

Route::group(['middleware' => 'web'], function () {

    Route::get('/dashboard', 'DashboardController@index');

});











Route::post('/sangvish_payu-CC', 'CancelController@sangvish_payu');
Route::post('/savedata-commonController', 'CommonController@savedata');
Route::get('/view_inboxCC', 'CommonController@view_inbox');
Route::get('/view_gigerCC', 'CommonController@view_giger');
Route::get('/status_gigeCC/{id}', 'CommonController@status_gig');
Route::get('/order_gigerCC/{gig}/{logid}/{order}', 'CommonController@order_giger');
Route::get('/delete_gigerCC/{delete}/{gid}', 'CommonController@delete_giger');
Route::get('/delete_msgCC/{id}/{status}', 'CommonController@delete_msg');
Route::get('/selected_msgCC/{user}/{logid}/{senderid}', 'CommonController@selected_msg');
Route::get('/status_msgCC/{id}', 'CommonController@status_msg');
Route::get('/homeCC', 'CommonController@home');    


Route::get('/feature_submissionConvC/{gid}/{price}/{days}', 'ConversationsController@feature_submission');
Route::get('/conversationsConvC/{giguser}/{logid}/{gigid}/{checkvel}', 'ConversationsController@conversations');
Route::post('/feauture_paymentConvC}', 'ConversationsController@feature_payment');


Route::get('/getajaxGC/{id}', 'GigsController@getajax');
Route::get('/delete_imgGC/{id}', 'GigsController@delete_img');
Route::get('/my_custom_orderGC', 'GigsController@my_custom_orders');
Route::get('/create_custom_jobGC', 'GigsController@create_custom_job');
Route::get('/sangvish_viewjobGC', 'GigsController@sangvish_viewjob');
Route::get('/edit_jobGC/{gid}', 'GigsController@edit_job');
Route::get('/customorder_viewGC/{id}', 'GigsController@customorder_view');
Route::get('/custom_orderGC/{id}', 'GigsController@custom_order');
Route::post('/custom_order_dataGC', 'GigsController@custom_order_data');
Route::post('/custom_savedataGC', 'GigsController@custom_savedata');
Route::post('/savedataGC', 'GigsController@savedata');


/*working*/Route::get('/all_servicesIC', 'IndexController@all_services');


Route::get('/view_revenuesJSC', 'JobSalesController@view_revenues');
Route::get('/view_salesJSC', 'JobSalesController@view_sales');
Route::get('/type_withdrawJSC/{action}/{type}/{price}', 'JobSalesController@type_withdraw');
/*working*/Route::get('/buyer_track/{order_id}', 'JobSalesController@buyer_track');
/*working*/Route::post('/buyer_track', ['as' => 'buyer_track' , 'uses' => 'JobSalesController@buyer_savedata']);
Route::get('/seller_trackJSC/{order_id}', 'JobSalesController@seller_track');
Route::get('/view_my_shoppingsJSC', 'JobSalesController@view_my_shopping');
Route::get('/view_manage_salesJSC', 'JobSalesController@view_manage_sales');
Route::get('/seller_cancelJSC/{chat_id}/{order_id}/{status}', 'JobSalesController@seller_cancel');
Route::post('/search_filterJSC', 'JobSalesController@search_filter');
Route::post('/track_completedJSC', 'JobSalesController@track_completed');
Route::get('/buyer_cancelJSC/{chat_id}/{order_id}/{status}', 'JobSalesController@buyer_cancel');
Route::post('/seller_savedataJSC', 'JobSalesController@seller_savedata');


Route::get('/destroyMBC/{id}', 'MybookingsController@destroy');


Route::post('/coupon_dataOC', 'OrderController@coupon_data');
Route::get('/own_submissionOC/{price}/{gid}/{type}/{ex_text}/{balance_type}/{balance}', 'OrderController@own_submission');
Route::get('/own_pageOC', 'OrderController@own_page');
Route::post('/bank_paymentOC', 'OrderController@bank_payment');
Route::get('/success_pageOC/{ref_id}', 'OrderController@success_page');
Route::get('/payment_payumoney_processOC/{price}/{gid}/{type}/{ex_text}/{coupon}', 'OrderController@payment_payumoney_process');
Route::get('/payment_stripe_processOC/{price}/{gid}/{type}/{ex_text}/{coupon}', 'OrderController@payment_stripe_process');
Route::get('/payment_processOC/{price}/{gid}/{type}/{ex_text}/{coupon}', 'OrderController@payment_process');
Route::get('/own_successOC/{price}/{gid}/{request}', 'OrderController@own_success');
/*working*/Route::get('/own_trackOC/{track_id}', 'OrderController@own_track');
Route::get('/sangvish_successOC/{gid}/{ref_id}/{admin_email}', 'OrderController@sangvish_success');
/*working*/Route::get('/feature/{id}', 'OrderController@feature');
/*working*/Route::get('/order_viewOC', 'OrderController@order_view');
Route::post('/savedataOC', 'OrderController@savedata');


/*working*/Route::get('/sangvish_topagesPC', 'PageController@sangvish_topages');


Route::get('/paymentCallbackPayC', 'PaymentController@paymentCallback');
/*working*/Route::post('/payment_new', ['as'=>'payment_new','uses'=>'PaymentController@neworder']);
Route::post('/savedataPayC', 'PaymentController@savedata');


Route::get('/projg{user_id}/{req_id}/{prop_id}', 'ProjectController@award_view');
Route::get('/project/{user_id}/{new-prog}', 'ProjectController@single_view');

/*working*/Route::get('/single_viewProjC/{id}/{slug}', 'ProjectController@single_view');
Route::post('/savedataProjC', 'ProjectController@savedata');


/*working*/Route::get('/feature_paymentRC/{buyer}/{id}/{gid}', 'RequestController@feature_payment');
Route::get('/getajaxRC/{id}', 'RequestController@getajax');
/*working*/Route::get('/custom_payRC/{id}', 'RequestController@custom_pay');
Route::get('/view_offersRC/{id}', 'RequestController@view_offers');
Route::get('/my_request_deleteRC/{delete}/{id}', 'RequestController@my_request_delete');
Route::post('/submit_offerRC', 'RequestController@submit_offer');
Route::get('/seoUrlRC/{string}', 'RequestController@seoUrl');
/*working*/Route::get('/new-request', 'RequestController@sangvish_view_request');
/*working*/Route::post('/new-request', ['as' => 'new-request', 'uses' => 'RequestController@savedata']);
Route::get('/request_editRC/{id}', 'RequestController@request_edit');


Route::get('/view_revenuesSC', 'SalesController@view_revenues');
Route::get('/view_salesSC', 'SalesController@view_sales');
Route::get('/type_withdrawSC/{action}/{type}/{price}', 'SalesController@type_withdraw');
Route::get('/buyer_trackSC/{order_id}', 'SalesController@buyer_track');
Route::get('/view_my_shoppingSC', 'SalesController@view_my_shopping');
Route::get('/view_my_client_shoppingSC', 'SalesController@view_my_client_shopping');
Route::get('/view_manage_salesSC', 'SalesController@view_manage_sales');
Route::get('/view_freelancer_manage_salesSC', 'SalesController@view_freelancer_manage_sales');
Route::get('/seller_cancelSC/{chat_id}/{order_id}/{status}', 'SalesController@seller_cancel');
Route::post('/search_filterSC', 'SalesController@search_filter');
Route::post('/track_completedSC', 'SalesController@track_completed');
Route::get('/buyer_cancelSC/{chat_id}/{order_id}/{status}', 'SalesController@buyer_cancel');
Route::post('/buyer_savedataSC', 'SalesController@buyer_savedata');
Route::post('/seller_savedataSC', 'SalesController@seller_savedata');


Route::get('/remove_yourfavShopC/{shop_id}', 'ShopController@remove_yourfav');
Route::get('/yourfavShopC', 'ShopController@yourfav');
Route::get('/favoritesShopC/{user_id}/{shop_id}', 'ShopController@favorites');


Route::post('/sangvish_stripe_fundStripC', 'StripeController@sangvish_stripe_fund');
Route::post('/sangvish_stripe_featuredStripC', 'StripeController@sangvish_stripe_featured');


Route::get('/success_pageSSC/{ref_id}', 'SuccessController@success_page');
Route::get('/sangvish_payu_fund_successSSC/{gid}/{refid}/{txnid}', 'SuccessController@sangvish_payu_fund_success');
Route::get('/sangvish_payu_feature_successSSC/{gid}/{refid}/{txnid}', 'SuccessController@sangvish_payu_feature_success');
Route::get('/sangvish_fsuccessSSC/{gid}/{ref_id}/{admin_email}', 'SuccessController@sangvish_fsuccess');


Route::get('/type_requestVRC/{status}/{type}', 'ViewRequestController@type_request');
Route::get('/view_requestVRC/{cid}', 'ViewRequestController@view_request');
/*working*/Route::post('/buyer_request',[ 'as' => 'buyer_request' , 'uses' => 'ViewRequestController@submit_data']);


Route::get('/formviewABC', 'Admin\AddblogController@formview');
Route::get('/validatorABC/{data}', 'Admin\AddblogController@validator');
Route::post('/addblogdataABC', 'Admin\AddblogController@addblogdata');


Route::get('/validatorASC/{data}', 'Admin\AddserviceController@validator');


Route::get('/validatorASSC/{data}', 'Admin\AddsubserviceController@validator');


Route::get('/validatorATC/{data}', 'Admin\AddtestimonialController@validator');


Route::get('/validatorAUC/{data}', 'Admin\AdduserController@validator');


Route::get('/indexAdC', 'Admin\AdminController@index');


/*working*/Route::get('/indexBC', 'Admin\BlogController@index');
Route::get('/destroyBC/{id}', 'Admin\BlogController@destroy');


Route::get('/validatorEBC/{data}', 'Admin\EditblogController@validator');
Route::post('/blogdataEBC', 'Admin\EditblogController@blogdata');


Route::get('/validatorESC', 'Admin\EditserviceController@validator');


Route::get('/validatorESSC', 'Admin\EditsubserviceController@validator');


Route::get('/validatorETC', 'Admin\EdittestimonialController@validator');


Route::get('/validatorEUC', 'Admin\EdituserController@validator');


Route::get('/indexOC', 'Admin\OrdersController@index');
Route::get('/viewsindexOC', 'Admin\OrdersController@viewsindex');
/* working */Route::get('/views_requestOC', 'Admin\OrdersController@views_request');
Route::get('/approval_statusOC/{status}/{order_id}/{gig_user_id}', 'Admin\OrdersController@approval_status');


Route::get('/destroyPC/{id}', 'Admin\PagesController@destroy');


Route::get('/indexSC', 'Admin\ServicesController@index');
Route::get('/destroySC/{id}', 'Admin\ServicesController@destroy');


Route::get('/indexStC', 'Admin\SettingsController@index');
Route::get('/destroyStC/{id}', 'Admin\SettingsController@destroy');


Route::get('/getserviceSSC', 'Admin\SubservicesController@getservice');



/*woriking*/ Route::get('/blog-details/{id}', 'BlogController@blog_single');
/*working*/ Route::get('/blog_viewBC', 'BlogController@blog_view');

Route::get('/viewbook', 'BookingController@viewbook');

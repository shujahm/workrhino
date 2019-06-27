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
Route::get('/', 'CommonController@home');*/

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('index/{username}', 'IndexController@resend_email');

Route::get('/', 'IndexController@sangvish_index');
Route::get('/index', 'IndexController@sangvish_index');

Route::get('searchajax', array('as' => 'searchajax', 'uses' => 'IndexController@sangvish_autoComplete'));

Route::get('dateavailable/{val}', array('as' => 'dateavailable', 'uses' => 'BookingController@dateavailable'));

Route::get('/logout', 'DashboardController@sangvish_logout');
Route::get('/delete-account', 'DashboardController@sangvish_deleteaccount');
Route::post('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@sangvish_edituserdata']);

Route::get('/shop', 'ShopController@sangvish_viewshop');

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

Route::get('/booking/{shop_id}/{service_id}/{userid}', 'BookingController@sangvish_showpage');
Route::post('/booking', ['as' => 'booking', 'uses' => 'BookingController@sangvish_savedata']);

Route::get('/booking_info', 'BookinginfoController@sangvish_viewbook');

Route::post('/booking_info', ['as' => 'booking_info', 'uses' => 'PaymentController@sangvish_showpage']);

Route::get('/payment/{sum_val}/{admin_email}', 'PaymentController@sangvish_showpage');

Route::post('/payment', ['as' => 'payment', 'uses' => 'PaymentController@sangvish_wallet_transfer']);

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

Route::get('/my_bookings/{release}/{id}/{shop_id}', 'MybookingsController@sangvish_released');

Route::get('/my_bookings/{cancel}/{id}', 'MybookingsController@sangvish_cancel_booking');

Route::get('/my_bookings', 'MybookingsController@sangvish_showpage');

Route::post('/my_bookings', ['as' => 'my_bookings', 'uses' => 'MybookingsController@sangvish_savedata']);

Route::post('/my_book', ['as' => 'my_book', 'uses' => 'MybookingsController@sangvish_disputedata']);

Route::get('/wallet', 'WalletController@sangvish_showpage');

Route::post('/wallet', ['as' => 'wallet', 'uses' => 'WalletController@sangvish_savedata']);

Auth::routes();

Route::get('/about', 'PageController@sangvish_about');

Route::get('/404', 'PageController@sangvish_404');

Route::get('/how-it-works', 'PageController@sangvish_howit');

Route::get('/safety', 'PageController@sangvish_safety');

Route::get('/service-guide', 'PageController@sangvish_guide');

Route::get('/how-to-pages', 'PageController@sangvish_topages');

Route::get('/success-stories', 'PageController@sangvish_stories');

Route::get('/terms-conditions', 'PageController@sangvish_terms');

Route::get('/privacy-policy', 'PageController@sangvish_privacy');

Route::get('/contact', 'PageController@sangvish_contact');

Route::post('/contact', ['as' => 'contact', 'uses' => 'PageController@sangvish_mailsend']);

Route::get('/services', 'ServicesController@sangvish_index');
Route::get('/services/{id}', 'ServicesController@sangvish_editdata');

Route::post('/services', ['as' => 'services', 'uses' => 'ServicesController@sangvish_savedata']);
Route::get('/services/{did}/delete', 'ServicesController@sangvish_destroy');

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

Route::group(['middleware' => 'web'], function () {

    Route::get('/dashboard', 'DashboardController@index');

});

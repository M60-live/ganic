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

/*Route::get('/', function () {
//    return view('welcome');
    return view('index');
});*/

Auth::routes();

//Route::get('/', 'ProductsController@index');
Route::get('/', 'HomeController@index');
Route::get('/products/', 'ProductsController@index');
Route::get('/products/category/{id?}', 'ProductsController@view_category');
Route::get('/products/view/{id_category}/{product_id}/{category_name?}', 'ProductsController@product_details');
Route::post('/add_to_cart', 'ProductsController@add_to_cart');
Route::post('/get_user_cart_count', 'ProductsController@get_user_cart_count');
Route::get('/home', 'HomeController@index');

//*** Auth Middleware - PROFILE
Route::get('/account', 'AccountController@index');
Route::get('/account/profile', 'AccountController@profile');
Route::post('/account/update', 'AccountController@update_profile');
Route::get('/account/orders', 'AccountController@orders');

//*** SEARCH FUNCTIONS
Route::post('/search/{keyword?}', 'ProductsController@search');

//*** BLOG POSTS
Route::get('/lifestyle', 'PostsController@lifestyle');
Route::get('/beauty', 'PostsController@beauty');
Route::get('/blog/{heading}/{id}/{title}', 'PostsController@view_post');

//*** Contact Form
Route::get('/contact_form', 'ContactController@index');
Route::post('/send_message', 'ContactController@send_message');

//*** Admin Middleware - Category
Route::get('/admin/catgory/list', 'CategoryController@index');
Route::get('/admin/catgory/view/{category_id}', 'CategoryController@view');
Route::post('/admin/catgory/update', 'CategoryController@update');

//*** Admin Middleware - PRODUCTS
Route::get('/admin/product/dashboard', 'AdminController@index');
Route::get('/admin/product/list_products/', 'AdminController@list_products');
Route::get('/admin/product/view_product/{product_id}', 'AdminController@view_product');
Route::post('/admin/product/update_product', 'AdminController@update_product');
Route::get('/admin/product/create', 'AdminController@create');
Route::post('/admin/product/create', 'AdminController@create_product');
Route::get('/admin/product/delete/{id}', 'AdminController@delete_product');

//*** Admin Middleware - REGISTRATION
Route::get('/admin/users/dashboard', 'RegUsersController@index');
Route::get('/admin/users/view_user/{user_id}', 'RegUsersController@view_users');

//*** Auth Middleware - Cart
Route::get('/cart', 'CartController@index')->middleware('auth');
Route::get('/cart/remove/{card_id}', 'CartController@remove_item');
Route::post('/cart/remove', 'CartController@remove_cart_item');
Route::post('/confirmation', 'CartController@confirmation');
Route::post('/payment/notify', 'CartController@notify_url');
Route::get('/payment/success', 'CartController@success');
Route::get('/payment/cancel', 'CartController@cancel');


//*** Admin Middleware - Blog
Route::get('/admin/blog/dashboard', 'BlogController@index');
Route::get('/admin/blog/create', 'BlogController@create_page');
Route::post('/admin/blog/create', 'BlogController@create');
Route::get('/admin/blog/{post_id}', 'BlogController@view_post');
Route::post('/admin/blog/update', 'BlogController@update');

/*Route::get('/dashboard', function(){
  return "admin Dashboard";
});*/

//*** Admin Middleware - Fulfillment
Route::get('/admin/orders/dashboard', 'FulfilmentController@index');
Route::get('/admin/orders/view_order/{pf_payment_id}', 'FulfilmentController@view_order');
Route::post('/admin/orders/change_order_status', 'FulfilmentController@change_order_status');

//*** POPUP ACTION
Route::post('/campaign', 'CampaignController@capture');
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

//front route-----------------------
Route::get('/', 'HomeController@index');

//show category wise here-----
Route::get('/product_by_category/{category_id}', 'HomeController@show_product_by_category');
//show menufecture wise here
Route::get('/product_by_menufecture/{menufecture_id}','HomeController@show_product_by_menufecture');
//product detalils------

Route::get('/view_product/{product_id}', 'HomeController@show_product_details');

//cart route are here-------
Route::post('/add-to-cart', 'CardController@add_to_cart');
Route::get('/show-cart', 'CardController@show_cart');
//delete-to-cart---------
Route::get('/delete-to-cart/{rowId}','CardController@delete_to_cart');
Route::post('/update-cart','CardController@update_cart');

//ckeck out rotue -----------------
Route::get('/login-check','CheckoutController@login_check');
Route::post('/customer-registration','CheckoutController@customer_registration');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save-shipping-details','CheckoutController@save_shipping_details');
Route::post('/customer-login','CheckoutController@customer_login');
Route::get('/customer-logout','CheckoutController@customer_logout');

//payment route-----------
Route::get('/payment', 'CheckoutController@payment');
Route::post('/order-place', 'CheckoutController@order_place');

//my work ------catagroy wase product--------------------
Route::get('/category-product/{cat_id}','HomeController@category_product');


//backend route--------------------------------
Route::get('/admin', 'AdminController@index');
Route::get('/deshboard', 'SupperAdminController@index');
Route::post('admin-deshboard', 'AdminController@deshboard');
Route::get('/logout', 'SupperAdminController@logout');

//category rellete route
Route::get('/add-category','CategoryController@index');
Route::get('/all-category','CategoryController@all_category');
Route::post('/save_category','CategoryController@save_category');
Route::get('/edit-category/{category_id}','CategoryController@edit_category');
Route::post('/update_category','CategoryController@update_category');
Route::get('/unactive_category/{category_id}','CategoryController@unactive_category');
Route::get('/active_category/{category_id}','CategoryController@active_category');
Route::get('/delete-category/{category_id}','CategoryController@delete_category');


//menufecture of brand route----------------------

Route::get('/add-menufecture','MenufectureController@index');
Route::post('/save_menufecture','MenufectureController@save_menufecture');
Route::get('/all-menufecture','MenufectureController@all_menufecture');
Route::get('/unactive_menufecture/{menufecture_id}','MenufectureController@unactive_menufecture');
Route::get('/active_menufecture/{menufecture_id}','MenufectureController@active_menufecture');
Route::get('/edit-menufecture/{menufecture_id}','MenufectureController@edit_menufecture');
Route::post('/update_menufecture','MenufectureController@update_menufecture');
Route::get('/delete-menufecture/{menufecture_id}','MenufectureController@delete_menufecture');


//product route-----------------
Route::get('/add-product','ProductController@index');
Route::post('/save_product','ProductController@save_product');
Route::get('/all-product','ProductController@all_product');
Route::get('/unactive_product/{product_id}','ProductController@unactive_product');
Route::get('/active_product/{product_id}','ProductController@active_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::post('/update-product','ProductController@update_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');


//slider route-----------------
Route::get('/add-slider','SliderController@index');
Route::post('/save_slider','SliderController@save_slider');
Route::get('/all-slider','SliderController@all_slider');
Route::get('/unactive_slider/{slider_id}','SliderController@unactive_slider');
Route::get('/active_slider/{slider_id}','SliderController@active_slider');
Route::get('/edit-slider/{slider_id}','SliderController@edit_slider');
Route::post('/update_slider','SliderController@update_slider');
Route::get('/delete-slider/{slider_id}','SliderController@delete_slider');


//order_route --------------
Route::get('/manage-order', 'OrderController@index');
Route::get('/order-view/{order_id}', 'OrderController@order_view');





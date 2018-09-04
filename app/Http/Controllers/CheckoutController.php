<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Hash;
use Session;
session_start();
use Cart;
class CheckoutController extends Controller
{
    public function login_check(){
    	return view('pages.login');
    }
    public function customer_registration(Request $request){
    	$data=DB::table('tbl_customer')->insertGetId([
    	'customer_name'=>$request->customer_name,
    	'customer_email'=>$request->customer_email,
    	'customer_password'=>Hash::make($request->customer_password),
    	'customer_mobile'=>$request->customer_mobile,
    	]);

    	Session::put('customer_id', $data);
    	Session::put('customer_name',$request->customer_name);
    	return redirect('/checkout');
    }
    public function checkout(){
    	return view('pages.check_out');
    }

    public function save_shipping_details(Request $request){

        $this->validate($request,[
            'shipping_email'=>'required|max:100',
            'shipping_first_name'=>'required|max:100',
            'shipping_last_name'=>'required|max:100',
            'shipping_address'=>'required|max:100',
            'shipping_mobile_number'=>'required|max:100',
            'shipping_city'=>'required|max:100',


        ]);

        $shipping_id=DB::table('tbl_shipping')->insertGetId([

           'shipping_email'=>$request->shipping_email,
           'shipping_first_name'=>$request->shipping_first_name,
           'shipping_last_name'=>$request->shipping_last_name,
           'shipping_address'=>$request->shipping_address,
           'shipping_mobile_number'=>$request->shipping_mobile_number,
           'shipping_city'=>$request->shipping_city,

        ]);
        Session::put('shipping_id',$shipping_id);
        //echo "success";
        return redirect('/payment');
    }

    public function customer_login(Request $request){
        $customer_email=$request->customer_email;
        //$password=Hash($request->customer_email);
        $result=DB::table('tbl_customer')
                ->where('customer_email',$customer_email)
                ->first();
        if($result){
            Session::put('customer_id', $result->customer_id);
            return redirect('/checkout');
        }
        else
        {
          return redirect('/login-check');
        }

    }

    public function customer_logout(){
        Session::flush();
        return redirect('/');
    }



    //payment

    public function payment(){
        //echo "fsdkl";
        return view('pages.payment');
    }


    public function order_place(Request $request){
      $payment_getway=$request->payment_method;
      
        $payment_id=DB::table('tbl_payment')->insertGetId([

            'payment_method'=>$payment_getway,
            'payment_status'=>'pending',
        ]);

        $order_id=DB::table('tbl_order')->insertGetId([

            'customer_id'=>Session::get('customer_id'),
            'shipping_id'=>Session::get('shipping_id'),
            'payment_id'=>$payment_id,
            'order_total'=>Cart::total(),
            'order_status'=>'pending',
        ]);

        $contents=Cart::content();
        $oddata=array();
        /*echo "<pre>";
        print_r($contents);
        echo "</pre>";*/

        foreach($contents as $v_content){
        $oddata['order_id']=$order_id;
        $oddata['product_id']=$v_content->id;
        $oddata['product_name']=$v_content->name;
        $oddata['product_price']=$v_content->price;
        $oddata['product_sales_quantity']=$v_content->qty;
        DB::table('tbl_order_details')
                ->insert($oddata);



            }
            /* DB::table('tbl_order_details')->insert([
            'order_id'=>$order_id,
            'product_id'=>$v_content->id,
            'product_name'=>$v_content->name,
            'product_price'=>$v_content->price,
            'product_sales_quantity'=>$v_content->qty,
        ]);*/

            if($payment_getway=='handcash'){
                Cart::destroy();
               return view('pages.handcash');
             }
             elseif($payment_getway=='Debit'){
                 echo 'Debit';
             }
             elseif($payment_getway=='BCash'){
                 echo 'BCash';
             }
             else{
                echo "somthing worng";
             }
        
    }
}

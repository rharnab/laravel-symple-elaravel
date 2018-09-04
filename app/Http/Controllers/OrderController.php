<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DB;
use Session;
session_start();
class OrderController extends Controller
{
    public function index(){
      $this->AdimnAuth();
    	$all_order_info=DB::table('tbl_order')
    				->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
    				->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
    				->select('tbl_order.*', 'tbl_customer.customer_name', 'tbl_shipping.shipping_first_name','tbl_shipping.shipping_last_name')
    				->get();
    	return view('admin.manage_order')->with('all_order_info', $all_order_info);
    }
    public function order_view($order_id){
        $this->AdimnAuth();
    	$order_by_id=DB::table('tbl_order')
    				->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
    				->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
    				->join('tbl_order_details', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')
    				->where('tbl_order.order_id',$order_id)
    				->select('tbl_order.*', 'tbl_customer.*', 'tbl_shipping.*','tbl_order_details.*')
    				->get();
    				/*echo "<pre>";
    				print_r($order_by_id);
    				echo "</pre>";*/
    	 $view_order=view('admin.view_order')->with('order_by_id',$order_by_id);
    	 return view('admin_layout')->with('admin.view_order',$view_order);
    }

    public function AdimnAuth(){
       
        $admin_id=Session::get('admin_id');
        if($admin_id){
            return;
        }
        else{

            return redirect('/admin')->send();
        }
    }
}

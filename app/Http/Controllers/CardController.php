<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Illuminate\Support\Facades\Redirect;
class CardController extends Controller
{
    public function add_to_cart(Request $request){
    	$qty=$request->qty;
    	$product_id=$request->product_id;
    	$product_info=DB::table('tbl_product')->where('product_id',$product_id)->first();
    	//print_r($product_info);
    	$data['qty']=$qty;
    	$data['name']=$product_info->product_name;
    	$data['id']=$product_info->product_id;
    	$data['price']=$product_info->product_price;
    	$data['options']['image']=$product_info->product_image;
    	Cart::add($data);
    	return redirect('show-cart');
    }
    public function show_cart(){
    	//echo "dsfsdjkl";
    	 $all_category=DB::table('tbl_category')->where('publication_status',1)->get();
    	 $manage_publis_category=view('pages.add_to_cart')->with('all_category',$all_category);
          
    	 return view('layout')->with('pages.add_to_cart',$manage_publis_category);
         
    	

    }
    public function delete_to_cart($rowId){
    	//echo $cart_id;
    	$delete=Cart::remove($rowId);

    	return Redirect::to('show-cart');

    }

    public function update_cart(Request $request){
    	$qty=$request->qty;
    	$rowId=$request->rowId;
    	Cart::update($rowId, $qty);
    	return Redirect::to('show-cart');
    }
}

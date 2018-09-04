<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;
Session::start();
class ProductController extends Controller
{
    public function index(){
        $this->AdimnAuth();
    	return view('admin.add_product');
    }

    public function save_product(Request $request){
         $this->AdimnAuth();
    	$this->validate($request,[
    		'product_name'=>'required|max:50',
    		'category_id'=>'required',
    		'menufecture_id'=>'required',
    		'product_short_description'=>'required|max:100',
    		'product_long_description'=>'required',
    		'product_price'=>'required|max:10',
    		'product_image'=>'required|max:5120',
    		'product_size'=>'required|max:10',
    		'product_color'=>'required',

    	]);
    	$image=$request->file('product_image');
    	if($image){
    		$permit=['jpg','png','jpeg'];
    		$name=$image->getClientOriginalName();
    		$exten=$image->getClientOriginalExtension();
    		//$exten_sm=strtolower($exten);
    		if(in_array($exten, $permit)==true){
    			$unique=substr(md5(time()),0,5).$name;
    			$path='image/';
    			$full_path=$path.$unique;
    			$upload=$image->move($path, $unique);
    			if($upload){

    				$data=DB::table('tbl_product')->insert([

			    		'product_name'=>$request->product_name,
			    		'category_id'=>$request->category_id,
			    		'menufecture_id'=>$request->menufecture_id,
			    		'product_short_description'=>$request->product_short_description,
			    		'product_long_description'=>$request->product_long_description,
			    		'product_price'=>$request->product_price,
			    		'product_image'=>$full_path,
			    		'product_size'=>$request->product_size,
			    		'product_color'=>$request->product_color,
			    		'publication_status'=>$request->publication_status,

			    	]);
				    	if($data){
				    		Session::put('message','Product added succefull');
				    		return redirect('add-product');
				    	}
				    	else{
				    		Session::put('message','Product not added!!!!!!');
				    		return redirect('add-product');
				    	}

    			}
    		}
    		else{
    			Session::put('message','You can Only upload jpg,png,jpeg');
				    		return redirect('add-product');
    		}

    	}

    	
    	
    }

    public function all_product(){
        $this->AdimnAuth();
    	$data=DB::table('tbl_product')
    	->join('tbl_category','tbl_product.category_id', '=', 'tbl_category.category_id')
    	->join('tbl_menufecture', 'tbl_product.menufecture_id', '=', 'tbl_menufecture.menufecture_id')
    	->select('tbl_product.*', 'tbl_category.category_name', 'tbl_menufecture.menufecture_name')
    	->get();
    	$all_product=view('admin.all_product')->with('all_product_info',$data);
    	return view('admin_layout')->with('admin.all_product',$all_product);
    	/*echo "<pre>";
    	print_r($data);
    	echo "</pre>";*/
    }
    public function unactive_product($product_id){
         $this->AdimnAuth();
    		DB::table('tbl_product')->where('product_id',$product_id)->update([

    			'publication_status'=>0,

    		]);
    		Session::put('message','product UnActive successfully');
    		return redirect('all-product');
    }
    public function active_product($product_id){
         $this->AdimnAuth();
    		DB::table('tbl_product')->where('product_id',$product_id)->update([

    			'publication_status'=>1,

    		]);
    		Session::put('message','product Active successfully');
    		return redirect('all-product');
    }
    public function edit_product($product_id){
         $this->AdimnAuth();
    	$product=DB::table('tbl_product')->where('product_id',$product_id)->first();
    	return view('admin.edit_product')->with('info',$product);


    }

    public function update_product(Request $request){
         $this->AdimnAuth();

    	if(!empty($request->file('product_image'))){

    			$image=$request->file('product_image');
    	if($image){
    		$permit=['jpg','png','jpeg'];
    		$name=$image->getClientOriginalName();
    		$exten=$image->getClientOriginalExtension();
    		//$exten_sm=strtolower($exten);
    		if(in_array($exten, $permit)==true){
    			$unique=substr(md5(time()),0,5).$name;
    			$path='image/';
    			$full_path=$path.$unique;
    			$upload=$image->move($path, $unique);
    			if($upload){

    				$data=DB::table('tbl_product')->where('product_id',$request->edit_id)->update([

			    		'product_name'=>$request->product_name,
			    		'category_id'=>$request->category_id,
			    		'menufecture_id'=>$request->menufecture_id,
			    		'product_short_description'=>$request->product_short_description,
			    		'product_long_description'=>$request->product_long_description,
			    		'product_price'=>$request->product_price,
			    		'product_image'=>$full_path,
			    		'product_size'=>$request->product_size,
			    		'product_color'=>$request->product_color,
			    		

			    	]);
				    	if($data){
				    		Session::put('message','Product Update succefull');
				    		return redirect('all-product');
				    	}
				    	else{
				    		Session::put('message','Product not added!!!!!!');
				    		return redirect('all-product');
				    	}

    			}
    		}
    		else{
    			Session::put('message','You can Only upload jpg,png,jpeg');
				    		return redirect('all-product');
    		}

    	}



    	}
    	else{

    		$data=DB::table('tbl_product')->where('product_id',$request->edit_id)->update([

			    		'product_name'=>$request->product_name,
			    		'category_id'=>$request->category_id,
			    		'menufecture_id'=>$request->menufecture_id,
			    		'product_short_description'=>$request->product_short_description,
			    		'product_long_description'=>$request->product_long_description,
			    		'product_price'=>$request->product_price,
			    		'product_size'=>$request->product_size,
			    		'product_color'=>$request->product_color,
			    		

			    	]);
				    	if($data){
				    		Session::put('message','Product Update succefull');
				    		return redirect('all-product');
				    	}
				    	else{
				    		Session::put('message','Product not added!!!!!!');
				    		return redirect('all-product');
				    	}

    	}
    }


    public function delete_product($product_id){
         $this->AdimnAuth();
    	$delete=DB::table('tbl_product')->where('product_id',$product_id)->delete();
    	if($delete){
    		Session::put('message','Produc Delete successfully');
    		return redirect('all-product');
    	}
    	else{
    		Session::put('message','Produc not Deleted ');
    		return redirect('all-product');
    	}

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

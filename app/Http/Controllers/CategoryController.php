<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
session::start();
use Illuminate\Support\Facades\DB;
class CategoryController extends Controller
{
    public function index(){
        $this->AdimnAuth();
    	return view('admin.add_category');

    }
    public function all_category(){
        $this->AdimnAuth();
    	$data=DB::table('tbl_category')->get();
    	$all_category=view('admin.all_category')->with('all_category_info',$data);
    	return view('admin_layout')->with('admin.all_category',$all_category);
    }
    public function save_category(Request $request){
        $this->AdimnAuth();
    	$errors=$this->validate($request,[
    		'category_name'=>'required|max:20',
    		'category_description'=>'required|max:500',
    		
    	]);
    	
    	$data=DB::table('tbl_category')->insert([
    		'category_name'=>$request->category_name,
    		'category_description'=>$request->category_description,
    		'publication_status'=>$request->publication_status,
    	]);
    	if($data){
    		Session::put('message','Category insert success........');
    		return redirect('add-category');
    	}
    	else{
    		Session::put('message','Category insert fail!!!!!!!');
    		return redirect('add-category');
    	}
    	

    }

    public function unactive_category($category_id){
        $this->AdimnAuth();
    		DB::table('tbl_category')->where('category_id',$category_id)->update([

    			'publication_status'=>0,

    		]);
    		Session::put('message','Category UnActive successfully');
    		return redirect('all-category');
    }
    public function active_category($category_id){
        $this->AdimnAuth();
    		DB::table('tbl_category')->where('category_id',$category_id)->update([

    			'publication_status'=>1,

    		]);
    		Session::put('message','Category Active successfully');
    		return redirect('all-category');
    }
    public function edit_category($category_id){
        $this->AdimnAuth();
    	$category=DB::table('tbl_category')->where('category_id',$category_id)->first();
    	return view('admin.edit_category')->with('info',$category);

    }
    public function update_category(Request $request){
        $this->AdimnAuth();
    	$update=DB::table('tbl_category')->where('category_id',$request->edit_id)->update([
    		'category_name'=>$request->category_name,
    		'category_description'=>$request->category_description,

    	]);
    	if($update){
    		Session::put('message','Category update successfully');
    		return redirect('all-category');
    	}
    }
    public function delete_category($category_id){
    	$delete=DB::table('tbl_category')->where('category_id',$category_id)->delete();
    	if($delete){
    		Session::put('message','Category deleted successfull');
    		return redirect('all-category');
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

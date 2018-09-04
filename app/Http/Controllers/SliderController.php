<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DB;
use Session;
session_start();
class SliderController extends Controller
{
    public function index(){
        $this->AdimnAuth();
    	return view('admin.add_slider');
    }
    public function save_slider(Request $request){
          $this->AdimnAuth();
    	$this->validate($request, [
    		'slider_name'=>'required',
    		'slider_image'=>'required',
    	]);

    	$image=$request->file('slider_image');
    	if($image){
    		$permit=['jpg','png','jpeg'];
    		$name=$image->getClientOriginalName();
    		$exten=$image->getClientOriginalExtension();
    		$exten_sm=strtolower($exten);
    		if($exten_sm){
    			if(in_array($exten_sm, $permit)==true){
    				$unnique=substr(md5(time()),0,5).$name;
    				$path="image/";
    				$full_path=$path.$unnique;
    				$upload=$image->move($path, $unnique);
    				if($upload){
    					DB::table('tbl_slider')->insert([
    						'slider_name'=>$request->slider_name,
    						'slider_image'=>$full_path,
    						'publication_status'=>$request->publication_status,
    					]);

    					Session::put('message','Slider uploaded success');
    					return redirect('add-slider');
    				}
    			}
    			else{
    				Session::put('message','Slider Not uploaded');
    					return redirect('add-slider');
    			}
    			

    		}
    		else{
    			Session::put('message','You can only jpg');
    					return redirect('add-slider');
    		}
    	}
    }

    public function all_slider(){
          $this->AdimnAuth();
    	$data=DB::table('tbl_slider')->get();
    	return view('admin.all_slider')->with('all_slider_info',$data);

    }
    public function unactive_slider($slider_id){
          $this->AdimnAuth();
    	$unactive=DB::table('tbl_slider')->where('slider_id',$slider_id)->update([
    		'publication_status'=>0,

    	]);
    	Session::put('message','slider unactive success');
    			return redirect('all-slider');
    }
    public function active_slider($slider_id){
          $this->AdimnAuth();
    	$unactive=DB::table('tbl_slider')->where('slider_id',$slider_id)->update([
    		'publication_status'=>1,

    	]);
    	Session::put('message','slider active success');
    			return redirect('all-slider');
    }
    public function edit_slider($slider_id){
          $this->AdimnAuth();

    	$data=DB::table('tbl_slider')->where('slider_id',$slider_id)->first();
    	return view('admin.edit_slider')->with('slider_info',$data);
    }


    public function update_slider(Request $request){
          $this->AdimnAuth();
    	
    	$image=$request->file('slider_image');
    	if($image){
    		$permit=['jpg','png','jpeg'];
    		$name=$image->getClientOriginalName();
    		$exten=$image->getClientOriginalExtension();
    		$exten_sm=strtolower($exten);
    		if($exten_sm){
    			if(in_array($exten_sm, $permit)==true){
    				$unnique=substr(md5(time()),0,5).$name;
    				$path="image/";
    				$full_path=$path.$unnique;
    				$upload=$image->move($path, $unnique);
    				if($upload){
    					DB::table('tbl_slider')->where('slider_id',$request->edit_id)->update([
    						'slider_name'=>$request->slider_name,
    						'slider_image'=>$full_path,
    						
    					]);
    					if($upload){
    						Session::put('message','Slider Edit success');
    					 return redirect('all-slider');

    					}

    					 
    				}
    			}
    			else{
    				
    				Session::put('message','Slider no Edit ');
    				 	return redirect('all-slider');
    			}
    			

    		}
    		else{
    			 Session::put('message','You can only jpg');
    			return redirect('all-slider');
    		}
    	}
    	else{

    		DB::table('tbl_slider')->where('slider_id',$request->edit_id)->update([
    						'slider_name'=>$request->slider_name,
    					]);
    		

    					 Session::put('message','Slider Update success');
    					 return redirect('all-slider');

    	}


    }

    public function delete_slider($slider_id){
          $this->AdimnAuth();
    	$delete=DB::table('tbl_slider')->where('slider_id',$slider_id)->delete();
    	if($delete){
    		Session::put('message','slider Delete successful');
    		return redirect('all-slider');
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

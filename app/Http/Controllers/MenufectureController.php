<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
session::start();
use Illuminate\Support\Facades\DB;

class MenufectureController extends Controller
{
    public function index(){
        $this->AdimnAuth();
    	return view('admin.add_menufecture');
    }

    public function save_menufecture(Request $request){
         $this->AdimnAuth();
        $errors=$this->validate($request,[
            'menufecture_name'=>'required|max:20',
            'menufecture_description'=>'required|max:500',
            
        ]);
        
        $data=DB::table('tbl_menufecture')->insert([
            'menufecture_name'=>$request->menufecture_name,
            'menufecture_description'=>$request->menufecture_description,
            'publication_status'=>$request->publication_status,
        ]);
        if($data){
            Session::put('message','Menufecture insert success........');
            return redirect('add-menufecture');
        }
        else{
            Session::put('message','Menufecture insert fail!!!!!!!');
            return redirect('add-menufecture');
        }
        

    }
    public function all_menufecture(){
        $this->AdimnAuth();
    	$data=DB::table('tbl_menufecture')->get();
    	$all_menufecture=view('admin.all_menufecture')->with('all_menufecture_info',$data);
    	return view('admin_layout')->with('admin.all_menufecture',$all_menufecture);
    }
    public function unactive_menufecture($menufecture_id){
         $this->AdimnAuth();
    	DB::table('tbl_menufecture')->where('menufecture_id',$menufecture_id)->update([

    		'publication_status'=>0,
    	]);
    	Session::put('message','menufecture unactive successfull');
    	return redirect('all-menufecture');
    }
    public function active_menufecture($menufecture_id){
         $this->AdimnAuth();
    	DB::table('tbl_menufecture')->where('menufecture_id',$menufecture_id)->update([

    		'publication_status'=>1,
    	]);
    	Session::put('message','menufecture unactive successfull');
    	return redirect('all-menufecture');
    }
    public function edit_menufecture($menufecture_id){
         $this->AdimnAuth();
    	$data=DB::table('tbl_menufecture')->where('menufecture_id',$menufecture_id)->first();
    	if($data){
    		return view('admin.edit_menufecture')->with('info',$data);
    	}
    }
    public function update_menufecture(Request $request){
         $this->AdimnAuth();
    	$data=DB::table('tbl_menufecture')->where('menufecture_id',$request->edit_id)->update([
    		'menufecture_name'=>$request->menufecture_name,
    		'menufecture_description'=>$request->menufecture_description,
    		


    	]);
    	if($data){
    		Session::put('message','Menufecture update successful');
    		return redirect('all-menufecture');
    	}
    }
    public function delete_menufecture($menufecture_id){
         $this->AdimnAuth();
    	$delete=DB::table('tbl_menufecture')->where('menufecture_id',$menufecture_id)->delete();
    	if($delete){
    		Session::put('message','Menufecture Delete successful');
    		return redirect('all-menufecture');
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

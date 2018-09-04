<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Illuminate\Support\Facades\DB;
use Session;
session_start();

class AdminController extends Controller
{
    public function index(){
    	if(Session::get('admin_id')){
    		return back();
    		//return view('admin_login');
    	}
    	else{
    		return view('admin_login');
    	}
    	
    }
    public function admin_deshboard(){
    	
    }
    public function deshboard(Request $request){
		$admin_email=$request->admin_email;    	
		$admin_password=md5($request->admin_password);
		$result=DB::table('tbl_admin')
				->where('admin_email',$admin_email)    	
				->where('admin_password',$admin_password)
				->first();
		if($result){
			Session::put('admin_name',$result->admin_name);
			Session::put('admin_id',$result->admin_id);
			return redirect('deshboard');
		}
		else{
			Session::put('message','Email Or Password is Invalid');
			return redirect('admin');
		}    	
    }
}

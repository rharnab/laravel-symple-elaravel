<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
session_start();

class SupperAdminController extends Controller
{
	public function index(){
		$this->AdimnAuth();
		return view('admin.deshboard');


	}



    public function logout(){
    	/*Session::put('admin_name',null);
    	Session::put('admin_id',null);*/

    	Session::flush();
    	return redirect('/admin');
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

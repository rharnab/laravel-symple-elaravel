<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index(){
    	$all_product=DB::table('tbl_product')
    				->join('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.category_id')
  					->join('tbl_menufecture', 'tbl_product.menufecture_id', '=', 'tbl_menufecture.menufecture_id')
  					->select('tbl_product.*', 'tbl_category.category_name' ,'tbl_menufecture.menufecture_name')
  					->where('tbl_product.publication_status',1)
  					->limit(9)
    				->get();
    				
    	return view('pages.home_content')->with('all_product_info',$all_product);
    }

    public function show_product_by_category($category_id){

      $product_by_category=DB::table('tbl_product')
              ->join('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.category_id')
              ->select('tbl_product.*', 'tbl_category.category_name')
              ->where('tbl_product.category_id',$category_id)
              ->where('tbl_product.publication_status',1)
              ->get();
              
          if($product_by_category){
            return view('pages.product_by_category')->with('product_by_category',$product_by_category);
          }

    }

    public function show_product_by_menufecture($menufecture_id){

      $product_by_menufecture=DB::table('tbl_product')
            ->join('tbl_menufecture', 'tbl_product.menufecture_id', '=', 'tbl_menufecture.menufecture_id')
            ->select('tbl_product.*', 'tbl_menufecture.menufecture_name')
            ->where('tbl_product.menufecture_id',$menufecture_id)
            ->where('tbl_product.publication_status', 1)
            ->get();
           /* echo "<pre>";
            print_r($product_by_menufecture);
            echo "</pre>";*/
            return view('pages.product_by_menufecture')->with('product_by_menufecture',$product_by_menufecture);
    }

    public function show_product_details($product_id){
        $product_view=DB::table('tbl_product')
            ->join('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.category_id')
            ->join('tbl_menufecture', 'tbl_product.menufecture_id', '=', 'tbl_menufecture.menufecture_id')
            ->select('tbl_product.*','tbl_category.category_name', 'tbl_menufecture.menufecture_name')
            ->where('tbl_product.product_id',$product_id)
            ->first();
        if($product_view){
           return view('pages.product_details')->with('details',$product_view);
        }

            /*echo "<pre>";
            print_r($product_view);
            echo "</pre>";*/

    }

    // public function category_product($cat_id){

    // $all_category_product=DB::table('tbl_product')
    //                   ->join('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.category_id')
    //                   ->where('tbl_product.category_id',$cat_id)
    //                   ->get();
    //     if($all_category_product){

    //       return view('pages.home_content')->with('all_category_product',$all_category_product);


    //     } 
    //                 echo "<pre>";
    //                 print_r($category_product);
    //                 echo "</pre>";


    // }
}

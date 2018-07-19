<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class CartController extends Controller
{
    //
    public function cart()
    {

    	$res = DB::table('cart')->get();

    	return view('home.cart.cart',['title'=>'购物车','res'=>$res]);


	

    }

    public function ajaxcart(Request $request)
    {

    	$id = $request->input('id');

    	// 构造器删除
    	$data = DB::table('cart')->where('id',$id)->delete();



    	// 模型删除
    	// Cart::where('id',$id)->delete();

    	//Cart::destory($id);


    	if ($data) {
    		# code...
    		echo 1;
    	} else {

    		echo 0;
    	}
    }
    
}

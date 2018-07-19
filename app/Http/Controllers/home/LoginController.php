<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //
    public function login()
    {
    	return view('home.login',['title'=>'登录页面']);

    }

    public function zhuce()
    {
    	return view('home.zhuce',['title'=>'注册页面']);
    }

    public function dozhuce()
    {
    	$res = $request->except('_token','repass');
    }


}

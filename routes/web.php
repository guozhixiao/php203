<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 后台登录
Route::get('admin/login','admin\LoginController@login');
Route::post('admin/dologin','admin\LoginController@dologin');
Route::get('admin/captcha','admin\LoginController@captcha');
// 后台路由组
Route::group(['middleware'=>'login'],function(){

	Route::get('admin/user','admin\UserController@index');
	Route::resource('admin/user','admin\UserController');
	// Route::get('admin/user/create','admin\UserController@create');

	//后台首页
	Route::any('admin/index','admin\IndexController@index');

	//分类管理
	Route::resource('/admin/category','admin\CategoryController');

	//后台退出
	Route::any('admin/logout','admin\LoginController@logout');
	// 商品管理
	Route::resource('admin/goods','admin\GoodsController');

	//后台轮播图添加
	Route::get('admin/lunbo','admin\LunboController@index');
	Route::get('admin/lunbo/add','admin\LunboController@add');
	Route::post('admin/lunbo/store','admin\LunboController@store');
	Route::get('admin/lunbo/{lid}/edit','admin\LunboController@edit');
	Route::get('admin/lunbo/{lid}/update','admin\LunboController@update');
	Route::post('admin/lunbo/{lid}/delete','admin\LunboController@delete');
	Route::get('admin/lunbo/{lid}/lundetails','admin\LunboController@lundetails');

	//后台友情链接
	Route::resource('admin/friends','admin\FriendsController');
	//前台友情链接
	Route::any('home/friend','admin\FriendsController@friend');

	//后台新闻管理
	Route::resource('admin/xinwen','admin\XinwenController');

	//后台地址管理
	Route::resource('admin/address','admin\AddressController');



});

	//前台登录
Route::get('home/login','home\LoginController@login');
	//前台注册
Route::get('home/zhuce','home\LoginController@zhuce');
Route::get('home/dozhuce','home\LoginController@dozhuce');


// 前台路由组
Route::group([],function(){
	

	//前台首页
	Route::any('home/index','home\IndexController@index');

	//购物车
	Route::any('/home/cart','home\CartController@cart');
	Route::any('/home/ajaxcart','home\CartController@ajaxcart');


	//前台轮播图详情页面跳转
	Route::get('lunbo/lunbodetails/{lid}','home\lunbo\LunbodetailsController@index');
	

});
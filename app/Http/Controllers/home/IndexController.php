<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\Category;
use App\Model\admin\Goods;
use DB;

class IndexController extends Controller
{
    //
    public function index()
    {
    	// $arr = Category::get();
    	$res = self::getsubcate(0);

    	// dump($res);
    	

        //轮播图链接
         $lunboimg = DB::table('lunbo')->get();

         // dd($lunboimg);

         $friends = DB::table('friends')->get();

         // $goods = DB::table('goods')->get();

         // dd($goods);

         $goods = Goods::get();
         dd($goods);



         return view('home.index',[
            'res'=>$res,
            'title'=>'美丽说', 
            
            'lunboimg'=>$lunboimg,
             //轮播图链接
            'friends'=>$friends,
            //友情链接
            'goods'=>$goods,
       

            
         ]);

          // //轮播详情页获取友情链接信息
          //   public static function getmessage()
          //   {
          //       $friends = DB::table('friends')->get();
          //       return $friends;
          //   }


         

    }















    public static function getsubcate($pid)
    {

        $cate = Category::where('pid',$pid)->get();
        
        $arr = [];

        foreach($cate as $k=>$v){

            if($v->pid==$pid){

                $v->sub=self::getsubcate($v->id);

                $arr[]=$v;
            }
        }  
        return $arr;
    }

    
}

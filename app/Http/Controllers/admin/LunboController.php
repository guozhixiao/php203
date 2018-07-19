<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class LunboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $res = DB::table('lunbo')->paginate(5);
        return view('admin.lunbo.index',['title'=>'浏览图片','res'=>$res]);
    }

     public function add()
    {


           return view('admin.lunbo.add',['title'=>'轮播图添加']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

      //dd($request->all());
        //处理首页图片
        if($request->hasFile('gimg')){
            //文件名
            $name = rand(1111,9999).'_'.time();
            //获取后缀
            //$suffix = $request->file('gimg')->getClientOriginalExtension();
            $suffix = $request->file('gimg')->getClientOriginalExtension();

            //文件的保存
            $path = $request->file('gimg')->move('./uploads/lunbo/',$name.'.'.$suffix);
            
        }

       //$res = $request->except('_token','gimg');
        $res['lname'] = $request->input('lname');
        $res['status'] = $request->input('status');

        
        $res['path'] = '/uploads/lunbo/'.$name.'.'.$suffix;

        $res['ltime'] = time();

        //dd($res);
        $lundid = DB::table('lunbo')->insertGetId($res);

        //dd($lundid);
         //处理详情页图片
        if($request->hasFile('profile')){
              $lunimg = $request->file('profile');

              $imgs = [];
              //foreach循环
              foreach($lunimg as $k=>$v){
                $gm = [];
                $lunname = rand(1111,9999).time();
                $lunsuffix = $v->getClientOriginalExtension();
                $v->move('./uploads/lundetails/',$lunname.'.'.$lunsuffix);
                $gm['lundid'] = $lundid;
                $gm['luntime'] = time();
                $gm['lunaddr'] = '/uploads/lundetails/'.$lunname.'.'.$lunsuffix;
                $imgs[] = $gm;
              }

        }

        //dd($imgs);
        $data = DB::table('lundetails')->insert($imgs);


        if($data){
            return redirect('admin/lunbo');
        } else {
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($lid)
    {
        //
        $res = DB::table('lunbo')->where('lid',$lid)->first();
        

        return view('admin.lunbo.edit',['title'=>'修改图片','res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($lid)
    {
        //echo 'dkga';
      //获取轮播详情表的lundid
      $lundid = $lid;
      //查询轮播详情表的数据
      $lunres = DB::table('lundetails')->where('lundid',$lundid)->get();

      //dd($lunres);
      if($lunres){

          foreach($lunres as $k=>$v){
            $lundata = $v->lunaddr;
            $luninfo = unlink('.'.$lundata);
            //dd($lundata);
            //删除轮播详情里面的图片
          }

      }

      //删除轮播详情数据表信息
      DB::table('lundetails')->where('lundid',$lundid)->delete();

      $res = DB::table('lunbo')->where('lid',$lid)->first();

      $lunpath = $res->path;
      unlink('.'.$lunpath);

      $data = DB::table('lunbo')->where('lid',$lid)->delete();

      if($data){
        return redirect('admin/lunbo');
      } else {
        return back();
      }

    }

   
    public function lundetails($lid)
    {
      $lundid = $lid;
      $lunres['luntime'] = time();
      $lunres = DB::table('lundetails')->where('lundid',$lundid)->get();

      //dd($lunres);
      return view('admin/lunbo/lundetails',['title'=>'轮播图片详情页','lunres'=>$lunres]);
    }

    public function update(Request $request ,$lid)
    {
        echo 'dgasd';
    }
}

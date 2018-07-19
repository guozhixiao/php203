<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\admin\Goods;
use App\Model\admin\Goodsimg;

use App\Model\admin\Category;

use DB;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

         $gname = Goods::orderBy('id','asc')
            ->where(function($query) use($request){
                //检测关键字
                $gname = $request->input('gname');
                $price = $request->input('price');
                //如果用户名不为空
                if(!empty($gname)) {
                    $query->where('gname','like','%'.$gname.'%');
                }
                //如果邮箱不为空
                if(!empty($price)) {
                    $query->where('price','like','%'.$price.'%');
                }
            })

            ->paginate($request->input('num',10));

            return view('admin.goods.index',[
                'title'=>'商品浏览页',
                'res'=>$gname,
                'request'=> $request
            ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $res = Category::select(DB::raw('*, concat(path,id) as paths'))->
            orderBy('paths')->
            get();


           foreach($res as $k => $v){
            //获取path
            // $paths = explode(',',$v->path);
            //$evl = count($paths)-2;

            $rs = substr_count($v->path,',')-1;

            $v->catename = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$rs).'|--'.$v->catename;
        }
        return view ('admin.goods.add',[

            'title'=>'商品添加',
            'res'=>$res
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 表单验证
        $res = $request->except('_token','gpic[]');

        $data = Goods::create($res);
        // dd($data);

        $gid = $data->id;
// dd($gid);
        //商品图片
        if($request->hasFile('gpic')){

            $gp = $request->file('gpic');
            // dd($gp);
            $goodspc = [];
            // dump($gpic);
            foreach($gp as $k => $v){

                $gc = [];

                //设置名字
                $name = str_random(10).time();

                // 设置后缀
                $suffix = $v->getClientOriginalExtension();

                // 移动
                $v->move('./uploads/',$name.'.'.$suffix);

                $gc['gid'] = $gid;

                $gc['gpic'] = '/uploads/'.$name.'.'.$suffix;

                $goodspc[] = $gc;
            }

        }

        // Goodspic::create(['gid'=>'1','gpic']);
        //dump($goodspc);

        $goods = Goods::find($gid);

        // dump($goods);
        try{
             $data = $goods->gs()->createMany($goodspc);

             if($data){
                return redirect('/admin/goods')->with('success','添加成功');;
             }
        }catch(\Exception $e){

            return back();
        }
        

        // dump($data);

    
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
    public function edit($id)
    {
        // 

        $cate = Category::select(DB::raw('*, concat(path,id) as paths'))->
            orderBy('paths')->
            get();


           foreach($cate as $k => $v){
            //获取path
            // $paths = explode(',',$v->path);
            //$evl = count($paths)-2;

            $rs = substr_count($v->path,',')-1;

            $v->catename = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$rs).'|--'.$v->catename;
        }

        $goodsone = Goods::where('id',$id)->first();

        $goodsimg = Goodsimg::where('gid',$id)->get();



        return view('admin.goods.edit',[
            'title'=>'商品的修改',
            'goodsone'=>$goodsone,
            // 'goodspic'=>$goodspic,
            'cate'=>$cate

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
          $res = $request->except('_token','gpic[]','_method');

          $data = Goods::where('id',$id)->update($res);

        // dump($data);

        // $gid = $data->id;

        //商品图片
        if($request->hasFile('gpic')){

            $gp = $request->file('gpic');

            $goodspc = [];
            // dump($gpic);
            foreach($gp as $k => $v){

                $gc = [];

                //设置名字
                $name = str_random(10).time();

                // 设置后缀
                $suffix = $v->getClientOriginalExtension();

                // 移动
                $v->move('./uploads/',$name.'.'.$suffix);

                $gc['gid'] = $gid;

                $gc['gpic'] = '/uploads/'.$name.'.'.$suffix;

                $goodspc[] = $gc;
            }

        }

        // Goodspic::create(['gid'=>'1','gpic']);
        //dump($goodspc);

        $goods = Goods::find($id);

        // dump($goods);
        try{
             $data = $goods->gs()->createMany($goodspc);

             if($data){
                return redirect('/admin/goods')->with('success','修改成功');;
             }
        }catch(\Exception $e){

            return back();
        }
        

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $goods = Goods::find($id);

        $goods->delete();

        $res = $goods->gs()->delete();

        // dump($res);
         return redirect('/admin/goods')->with('success','删除成功');

        // foreach ($data as $k => $v) {
           
        //     // dump($v->gimg);
        //     $res = unlink('.'.$v->gimg);
        // }

        
    }
}

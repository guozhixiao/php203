<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\admin\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $res = Category::select(DB::raw('*, concat(path,id) as paths'))->
            orderBy('paths')->
            where('catename','like','%'.$request->input('search').'%')-> paginate($request->input('num',10));


           foreach($res as $k => $v){
            //获取path
            // $paths = explode(',',$v->path);
            //$evl = count($paths)-2;

            $rs = substr_count($v->path,',')-1;

            $v->catename = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$rs).'|--'.$v->catename;
        }

        
        return view('admin.category.index',[

            'title'=>'分类列表',
            'res'=>$res,

            'request'=>$request

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

        return view('admin.category.add',[
            'title'=>'分类添加',
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
        //表单验证
        $res = $request->except('_token');
        // dump($res);

        // var_dump()
        if($res['pid'] == '0'){

           $res['path'] = '0,';

        } else {

            $foo = Category::where('id',$res['pid'])->first();

        

            // dd ($foo);
            $res['path'] = $foo->path.$foo->id.',';

        }

        $data = Category::create($res);

        if($data) {
            return redirect('/admin/category')->with('success','添加成功');
        } else {
            return back()->with('error','添加失败');
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
    public function edit($id)
    {
        //
       $info = Category::find($id);

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
        
        return view('admin.category.edit',
        [
            'title'=>'分类修改',
            'res'=>$res,
            'info'=>$info
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

         //表单验证

        $res = $request->except('_token','_method');

        try{
            $data = Category::where('id',$id)->update($res);

            if($data){
                return redirect('/admin/category')->with('success','修改成功');
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
        $cate=Category::where('pid','=',$id)->first();

        // var_dump($cate);
        //
        //判断有没有子类
        //如果有子类不能删除
        if($cate){
            return redirect('/admin/category')->with('error','删除失败');
        }

        try {
            $res = Category::where('id',$id)->delete();
            //如果没有就可以删除

            if($res){
                return redirect('/admin/category')->with(['success'=>'删除成功']);
            }

        } catch (\Exception $e) {

                return redirect('/admin/category')->with('error','删除失败');
        }
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

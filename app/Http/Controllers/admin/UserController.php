<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use Hash;
use App\Model\Admin\User;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // echo 111;
        // echo 111;
        // dump($request->all());
        // $res = User::paginate(10);
        // $res = User::where('username','like','%'.$request->input('search').'%')->paginate(10);
         $res = User::where('username','like','%'.$request->input('search').'%')->
                paginate($request->input('num',10));

        $arr = ['num'=>$request->input('num'),'search'=>$request->input('search')];

        return view('admin.user.index',[
            'title'=>'用户管理页面',
            'res'=>$res,
            'arr'=>$arr

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


        return view('admin.user.add',[

            'title'=>'用户的添加'
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
        // dump($request->all());
         $this->validate($request, [
            'username' => 'required|regex:/^\w{6,18}$/',
            'password' => 'required|regex:/^\S{6,12}$/',
            'repass' => 'same:password',
            'email'=>' email',
            'phone'=>'required|regex:/^1[3456789]\d{9}$/',
            // 'body' => 'required',
         ],[
            'username.required'=>'用户名不能为空',
            'username.regex'=>'格式不正确',
            'password.required'=>'密码不能为空',
            'password.regex'=>'密码格式不正确',
            'repass.same'=>'两次密码不一致',
            'email.email'=>'邮箱格式不正确',
            'phone.required'=>'手机号不能为空',
            'phone.regex'=>'手机号格式不正确'

         ]);

        $res = $request->except(['_token','profile','repass']);
        // 头像
       
        if($request->hasFile('profile')){
            //设置名字
            $name = str_random(10).time();
            // dd($name);
            // 获取后缀
            $suffix = $request->file('profile')->getClientOriginalExtension();

            // 移动
            $request->file('profile')->move('./uploads/',$name.'.'.$suffix);
        }
        // dd(str_random(10).time());
        // 头像存数据表
        $res['profile'] = Config::get('app.path').$name.'.'.$suffix;
        // dd($res['profile']);


        //密码加密
        $res['password'] = Hash::make($request->input('password'));

         //模型
        try{

             $data = User::create($res);

        if($data){

            return redirect('/admin/user')->with('info','添加成功');

            }
        } catch (\Exception $e){

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
    public function edit($id)
    {
        //
        $res = User::find($id);

        // dump($res);
        return view('admin.user.edit',['title'=>'用户名的修改页面','res'=>$res]);
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
        // dd($request);
        //表单验证
        $this->validate($request, [
            'username' => 'required|regex:/^\w{6,12}$/',
            // 'body' => 'required|regex:/^\w{6~12}$/',
             'phone'=>'required|regex:/^1[3456789]\d{9}$/',
             'profile'=>'required',

        ],[

            'username.required'=>'用户名不能为空',
            'username.regex'=>'格式不正确',
            // 'body.required'=>'用户名不能为空',
            'phone.required'=>'手机号不能为空',
            'phone.regex'=>'手机号格式不正确',
            'profile.required'=>'请修改头像',
         
        ]);
        // $foo = User::find($id);

        // $urls = $foo->profile;

        // // dd($urls);

        // $info = '@'.unlink('.'.$urls);

        // if(!$info)  return;

       



        $res = $request->except('_token','_method','profile');

        // dump($res);
        if($request->hasFile('profile')){
            //设置名字
            $name = str_random(10).time();
            // dd($name);
            // 获取后缀
            $suffix = $request->file('profile')->getClientOriginalExtension();

            // 移动
            $request->file('profile')->move('./uploads/',$name.'.'.$suffix);
        }

         // 存数据表
       $res['profile'] = Config::get('app.path').$name.'.'.$suffix;
        // dd($res['profile']);

         //模型
        try{

             $data = User::where('id',$id)->update($res);

        if($data){

            return redirect('/admin/user')->with('success','修改成功');

            }
        } catch (\Exception $e){

            return back()->with('error');
        
       
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
        // //
        // $foo = User::find($id);

        // $urls = $foo->profile;

        // // dd($urls);
        // $res = User::where('id',$id)->delete();

        // if ( $res ) {

        //     // DD('111');
        //     $info = '@'.unlink('.',$urls);


        // }



        // $info = '@'.unlink($urls);

        // if(!$info)  return;

        

        // $res = User::destroy($id);
         $req = DB::table('user')->where('id',$id)->get();
       
        $res = DB::table('user')->where('id',$id)->delete();

        if ($res) {

            foreach ($req as $k=>$v) {

                unlink('.'.$v->profile);

                  }
        return redirect('/admin/user')->with('success','删除成功');


    }


    }
}

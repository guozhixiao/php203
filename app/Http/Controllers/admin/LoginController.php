<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\PhraseBuilder; 
use Gregwar\Captcha\CaptchaBuilder; 
use Session;
use Hash;
use App\Model\Admin\User;

class LoginController extends Controller
{
    //
    public function login()
    {
    	return view('admin.login.login',['title'=>'后台登录']);
    }


    public function dologin(Request $request)
    {
    
       // 获取数据
        $res = $request->except('_token');

        // dump($res);
        $uname = User::where('username',$res['username'])->first();

        $pwd = $request->input('pwd');




        

         // dd($hash);
        //获取用户名
        if(!$uname){

            return back()->with('err','用户名或密码不正确');


        }

         // dd ($uname->password);

        //判断密码
        if (!Hash::check($res['pwd'], $uname->password)) {
            // 密码对比...
            
            //如果说密码失败
            return back()->with('err','用户名或密码不正确');
        }
        // dd ($res);





        //验证码
        if(session('code') != $res['code']){

            return back()->with('err','验证码不正确');
        }

        session(['uname'=>$res['username']]);

        // session(['uname'=>$uname->username]);

        // session(['profile'=>$uname->profile]);

        return redirect('/admin/index');


    }

    
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    //  public function captcha()
    // {
    //      //生成验证码图片的Builder对象，配置相应属性
    //     $builder = new CaptchaBuilder;
    //     //可以设置图片宽高及字体
    //     $builder->build($width = 80, $height = 30, $font = null);
    //     //获取验证码的内容
    //     $phrase = $builder->getPhrase();
        
    //     //把内容存入session
    //     Session::flash('milkcaptcha', $phrase);
    //     //生成图片
    //     header("Cache-Control: no-cache, must-revalidate");
    //     header('Content-Type: image/jpeg');
    //     $builder->output();
    // }

    //生成验证码方法
    public function captcha()
    {
        $phrase = new PhraseBuilder;
        // 设置验证码位数
        $code = $phrase->build(4);
        // 生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        // 设置背景颜色
        $builder->setBackgroundColor(123, 203, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        // 可以设置图片宽高及字体
        $builder->build($width = 90, $height = 30, $font = null );
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
        Session::flash('code', $phrase);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }

    public function logout()
    {
        //第一步删除session里面储存的信息
        //

    }



}

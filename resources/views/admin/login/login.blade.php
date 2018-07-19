<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- <title>『豪情』后台管理</title> -->
	<link rel="stylesheet" type="text/css" href="/login/css/admin_login.css"/>
    <title>{{$title}}</title>
</head>
<body>
<div class="admin_login_wrap">
    <div class="adming_login_border">
    <!-- <h1><b><font color="black">后台管理</font></b></h1> -->
        <div class="admin_input">

    <!-- @if(session('err'))
        <li class="error" style='color:red;font-size:17px;list-style:none'>{{session('err')}}</li>
    @endif -->

    
            <form action="/admin/dologin" method="post">
                <ul class="admin_items">
                     @if(session(''))
                        <li class="error" style='color:red;font-size:17px;list-style:none'>{{session('err')}}</li>
                      @endif
                      @if(session('msg'))
                        <li class="error" style='color:green;font-size:17px;list-style:none'>{{session('msg')}}</li>
                      @endif

                    @if(session('err'))
                            <div class="mws-form-message warning" style='color:red;font-size:17px;list-style:none'>
                                {{session('err')}}
                            </div>
                    @endif

                    <li>
                        <label for="user">用户名：</label>
                        <input type="text" name="username" value=" " id="user" size="40" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="pwd">密码：</label>
                        <input type="password" name="pwd" value="" id="pwd" size="40" class="admin_input_style" />
                    </li>

                    <div>
                        <label for="pwd">验证码：</label>
                        <input type="text" name="code" value="" placeholder="请输入验证码" id="code"  class="admin_input_style" />
                        <!-- <img src="/admin/captcha" alt=""> -->
                        <img src="/admin/captcha" alt="" title="刷新图片" onclick='this.src=this.src+="?1"'>
                    </div>
                    {{ csrf_field() }}
                    <li>
                        <input type="submit" tabindex="3" value="登录" class="btn btn-primary" />
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <p class="admin_copyright"><a tabindex="5" href="#" target="_blank">进入前台</a> &copy; 2016 Powered by <a href="#" target="_blank">你的大名</a></p>
</div>
</body>

</html>
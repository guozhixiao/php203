@extends('layout.admin')

@section('title',$title)

@section('content')

    <div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                        <span>{{$title}}</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        
                        @if (count($errors) > 0)
                            <div class="mws-form-message error">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="list-style:none">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="/admin/user/{{$res->id}}" method="post" class="mws-form" enctype="multipart/form-data">
                            <div class="mws-form-inline">

                                <div class="mws-form-row">
                                    <label class="mws-form-label">用户名</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="small" name="username" value='{{$res->username}}'>
                                    </div>
                                </div>

                                <div class="mws-form-row">
                                    <label class="mws-form-label">电话</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="small"  name="phone" value='{{$res->phone}}'>
                                    </div>
                                </div>

                                <div class="mws-form-row">
                                    <label class="mws-form-label">邮箱</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="small" name="mail" value='{{$res->mail}}'>
                                    </div>
                                </div>

                                <div class="mws-form-row">
                                    <label class="mws-form-label" >头像</label>
                                    
                                    <div class="mws-form-item">
                                        <img src="{{$res->profile}}" alt="" width='200'>
                                        <!-- <input type="file" class="small"  name="profile"> -->
                                        <input type="file" name="profile" class="fileinput-preview" style="width: 100%;
                                            padding-right: 84px;" readonly='readonly' placeholder="No file selected...">
                                        
                                    </div>
                                </div>

                                <div class="mws-form-row">
                                    <label class="mws-form-label">状态</label>
                                    <div class="mws-form-item clearfix">
                                        <ul class="mws-form-list inline">
                                            <li><input type="radio" name="status" value="1" @if($res->status == '1') checked="checked" @endif> <label>激活</label></li>

                                            <li><input type="radio" name="status" value="0" @if($res->status == '0') checked="checked" @endif > <label>未激活</label></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="mws-button-row">
                                {{csrf_field()}}

                                {{method_field('PUT')}}
                                <input type="submit"  class="btn btn-success" value="修改">
                                
                            </div>
                        </form>
                    </div>      
                </div>
    
@endsection

@section('js')
<script type="text/javascript">

     setTimeout(function(){

          $('.mws-form-message').remove();

     },3000)

     // $('.mws-form-message').fadeOut(5000);


</script> 

@endsection
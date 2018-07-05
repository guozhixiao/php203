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
						                <li style='font-size:16px;list-style:none'>{{ $error }}</li>
						            @endforeach
						        </ul>
						    </div>
						@endif

						
                    	<form class="mws-form" action="/admin/user" method='post' enctype='multipart/form-data'> 
                    	<div class="mws-form-inline">

                    			<div class="mws-form-row">
                    				<label class="mws-form-label">用户名</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small" name='username'>
                    				</div>
                    			</div>

                    			<div class="mws-form-row">
                    				<label class="mws-form-label">密码</label>
                    				<div class="mws-form-item">
                    					<input type="password" class="small" name='password'>
                    				</div>
                    			</div>

                    			<div class="mws-form-row">
                    				<label class="mws-form-label">确认密码</label>
                    				<div class="mws-form-item">
                    					<input type="password" class="small" name='repass'>
                    				</div>
                    			</div>

                    			<div class="mws-form-row">
                    				<label class="mws-form-label">邮箱</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small" name='email'>
                    				</div>
                    			</div>

                    			<div class="mws-form-row">
                    				<label class="mws-form-label">手机号</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small" name='phone'>
                    				</div>
                    			</div>

                    			<div class="mws-form-row">
                    				<label class="mws-form-label">头像</label>
                    				<div class="mws-form-item">
                    					<!-- <input type="file" class="small" name='profile'> -->
                    					<input type="file" name='profile' class="fileinput-preview" style="width: 100%; padding-right: 85px;" readonly="readonly" placeholder="No file selected...">
                    				</div>
                    			</div>



                    			<div class="mws-form-row">
                    				<label class="mws-form-label">状态</label>
                    				<div class="mws-form-item clearfix">
                    					<ul class="mws-form-list inline">
                    						<li><input type="radio" name='status' value=1 checked='checked'> <label>启动</label></li>
                    						<li><input type="radio" name='status' value=0> <label>禁止</label></li>
                    						
                    					</ul>
                    				</div>
                    			</div>
                    		</div>
                    		<div class="mws-button-row">

                    			{{csrf_field()}}
                    			<input type="submit" value="提交" class="btn btn-success">
                    		</div>
                    	</form>
                    </div>    	
                </div>

@endsection

@section('js')
<script type="text/javascript">

	// setTimeout(function(){

	// 		$('.mws-form-message').remove();

	// },3000)
	$('.mws-form-message').fadeOut(3000);


</script>

@endsection
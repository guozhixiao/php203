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

                    	<form action="/admin/category" method="post" class="mws-form" enctype="multipart/form-data">
                    		<div class="mws-form-inline">

                    			<div class="mws-form-row">
                    				<label class="mws-form-label">类名</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small" name="catename">
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">分类</label>
                    				<div class="mws-form-item">
                    					<select name="pid" class="samll">
                    						<option value="0">请选择</option>
                    						@foreach($res as $k=>$v)
                    						<option value='{{$v->id}}'>{{$v->catename}}</option>
                    						@endforeach
                    						
                    					</select>
                    				</div>
                    			</div>

                    	</div>		
                    		<div class="mws-button-row">
                    			{{csrf_field()}}

                    			<input type="submit"  class="btn btn-success" value="提交">
                    			
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
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
		                <li style='color:blue;font-size:17px;list-style:none'>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif


		


    	<form action="/admin/friends/{{$res->id}}" method='post' class="mws-form" enctype='multipart/form-data'>
    		<div class="mws-form-inline">

    		<div class="mws-form-row">
                    <label class="mws-form-label">链接名称</label>
                    <div class="mws-form-item" style="display:inline">
                        <input type="text" name='fname' class="small" value="{{$res->fname}}">
                        
                    </div>
            </div>
			<div class="mws-form-row">
                    <label class="mws-form-label">链接地址</label>
                    <div class="mws-form-item" style="display:inline">
                        <input type="text" name='http' class="small" value="{{$res->http}}">
                        
                    </div>
            </div>

			<div class="mws-form-row">
				<label class="mws-form-label">链接图片</label>
				<div class="mws-form-item">
					<input type="file" name='urls' multiple readonly="readonly" style="width: 30%;" class="fileinput-preview" placeholder="No file selected...">
				</div>
			</div>

 		   <div class="mws-form-row">
                <label class="mws-form-label">链接状态</label>
                <div class="mws-form-item clearfix">
                    <ul class="mws-form-list inline">
                        <li>
                            <input type="radio" name="status" value="0" 
                            @if($res->status == 0)
                            	checked
                            @endif
                            ></input> 
                            <label>启用</label>
                        </li>
                        <li>
                            <input type="radio" name="status" value="1"
                            @if($res->status == 1)
								checked
							@endif
                            ></input>
                            <label>禁止</label>
                        </li>

                        
                    </ul>
                </div>
            </div>
	       </div>
    		<div class="mws-button-row">
            	
				{{method_field('PUT')}}
    			{{csrf_field()}}
    			<input type="submit" class="btn btn-danger" value="提交">
    			
    		</div>
    	</form>


    </div>    	
</div>

@endsection
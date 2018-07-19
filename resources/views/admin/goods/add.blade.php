@extends('layout.admin')

@section('title',$title)

<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>


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

                    	<form action="/admin/goods" method="post" class="mws-form" enctype="multipart/form-data">
                    		<div class="mws-form-inline">

                    			
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">分类</label>
                                        <div class="mws-form-item">
                                             <select name="cateid" class="samll">
                                                  <option value="0">请选择</option>
                                                  @foreach($res as $k=>$v)
                                                  <option value='{{$v->id}}'>{{$v->catename}}</option>
                                                  @endforeach
                                                  
                                             </select>
                                        </div>
                                   </div>
                                   <div class="mws-form-row">
                                        <label class="mws-form-label">商品名</label>
                                        <div class="mws-form-item">
                                             <input type="text" class="small" name="gname">
                                        </div>
                                   </div>
                    			<div class="mws-form-row">
                                        <label class="mws-form-label">价格</label>
                                        <div class="mws-form-item">
                                             <input type="text" class="small" name="price">
                                        </div>
                                   </div>
                                   <div class="mws-form-row">
                                        <label class="mws-form-label">颜色</label>
                                        <div class="mws-form-item">
                                             <input type="text" class="small" name="color">
                                        </div>
                                   </div>
                                   <div class="mws-form-row">
                    				<label class="mws-form-label">尺码</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small" name="size">
                    				</div>
                    			</div>
                                   <div class="mws-form-row">
                                        <label class="mws-form-label">商品图片</label>
                                         <div class="mws-form-item">

                                               <input type="file" name='gpic[]' multiple class="fileinput-preview" style="width: 100%; padding-right: 84px;" readonly="readonly" placeholder="No file selected...">
                                        </div>
                                   </div>


                                    <script>
                                        
                                        //实例化编辑器
                                        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                                        var ue = UE.getEditor('editor');

                                    </script>

                                   <div class="mws-form-row">
                                        <label class="mws-form-label">商品详情</label>
                                        <div class="mws-form-item">
                                             <script id="editor" name="content" type="text/plain" style="width:600px;height:360px;"></script>
                                        </div>
                                   </div>
                                   <div class="mws-form-row">
                                        <label class="mws-form-label">状态</label>
                                        <div class="mws-form-item clearfix">
                                             <ul class="mws-form-list inline">
                                                  <li><input type="radio" name='status' value='1' checked='checked'> <label>上架</label></li>
                                                  <li><input type="radio" name='status' value='0'> <label>下架</label></li>
                                             </ul>
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

     // setTimeout(function(){

     //      $('.mws-form-message').remove();

     // },3000)

     $('.mws-form-message').fadeOut(5000);


</script> 

@endsection
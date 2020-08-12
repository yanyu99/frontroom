@extends('admin.layouts.base')
@section('head')
<link href="{{$common_cdn}}/js/ios-switch/switchery.css" rel="stylesheet">
@endsection
@section('content')

<div class="row">
	<div class="col-sm-12">
	<section class="panel">
		<header class="panel-heading">导航配置</header>
		<div class="panel-body">
			@if($ctrl->errors_has('error'))
				<div class="form-group">
					<div>
						<div id="js-validate-alert" class="alert alert-danger alert-validate" style="margin-bottom: 0px;">
							<span class="text">{{$ctrl->errors_first('error', ':message')}}</span>
						</div>
					</div>
				</div>
			@endif

	<form class="form-horizontal" method="post">
		{{ $ctrl->csrf_field() }}
		<input class="form-control" name="id" type='hidden' @if($edit) readonly @endif value="@if($edit){{$edit->id}}@endif"  >

			
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">名称:*</span>
				<div class="col-sm-4">
					<input  class="form-control" type="text" name="title" @if($edit) value="{{$edit->title}}" @endif ></div>
			</div>
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">排序:*</span>
				<div class="col-sm-4">
					<input  class="form-control" type="text" name="sort" @if($edit) value="{{$edit->sort}}" @endif ></div>
			</div>
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">ICON(10KB)：</span>
				<div class="col-sm-8">
					<div class="img-upload">
						<div id="idIconImg"></div>
						<p id="idicon_img_msg" class="webuploader-tip">
							<p>
								<input  class="form-control" type="hidden" name="icon" id="idiconImg" @if($edit) value="{{$edit->
								icon}}" @endif/>
								<img id="idicon_img" @if($edit) src="{{$edit->icon}}" @endif alt="" height="30"/></p>
						</p>
					</div>
				</div>
				<button class="btn btn-danger js-clear" type="button" >清除</button>
			</div>
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">位置：*</span>
				<div class="col-sm-4">
					<select name="pos" id="typePos" class="form-control">
						@foreach($posTypes as $key=>$value)
						<option value="{{$key}}" @if($edit) @if($key == $edit->pos) selected  @endif @endif >{{$value['name']}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">响应类型：*</span>
				<div class="col-sm-4">
					<select id="typeSelect" name="type"  class="form-control">
						@foreach($navTypes as $key=>$value)
						<option @if(isset($value['pos']))class="type-select-{{$value['pos']}}"@endif value="{{$key}}" @if($edit) @if($key == $edit->type) selected  @endif @endif >{{$value['name']}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group types type-4003">
				<span class="col-sm-2 col-sm-2 control-label">链接地址:*</span>
				<div class="col-sm-4">
					<input  class="form-control" type="text" name="url" @if($edit && $edit->type == 4003&& isset($edit->url['url'])) value="{{$edit->url['url']}}" @else value="http://" @endif ></div>
			</div>
			<div class="form-group types type-4002 type-4002-img">
				
			</div>
			<div class="form-group types type-4009">
				<span class="col-sm-2 col-sm-2 control-label">是否影藏下载次数</span>
				<div class="col-sm-4">
					<input  type="checkbox" name="no_show_num" class="js-switch" @if($edit && $edit->type == 4009 && isset($edit->url['no_show_num']))  @if($edit->url['no_show_num']) checked @endif"  @endif>
				</div>
			</div>
			<div class="form-group types type-4017">
				<span class="col-sm-2 col-sm-2 control-label">轮播图宽度</span>
				<div class="col-sm-4">
					<input  type="text" name="width" class="form-control" @if($edit && $edit->type == 4017 && isset($edit->url['width'])) value="{{$edit->url['width']}}"  @endif>
				</div>
			</div>
			<div class="form-group types type-4017">
				<span class="col-sm-2 col-sm-2 control-label">轮播图高度</span>
				<div class="col-sm-4">
					<input  type="text" name="height" class="form-control" @if($edit && $edit->type == 4017 && isset($edit->url['height'])) value="{{$edit->url['height']}}"  @endif>
				</div>
			</div>
			<div class="form-group types type-4017">
				<span class="col-sm-2 col-sm-2 control-label"></span>
				<div class="col-sm-4">
					<input  type="button" class="btn btn-primary btn-addimg" value="新增图片">
				</div>
			</div>
			<div class="form-group types type-4017 type-4017-subs">

			</div>
			<div class="form-group types type-4002">
				<span class="col-sm-2 col-sm-2 control-label">QQ类型：*</span>
				<div class="col-sm-4">
					<select id="typeSelect" name="qqtype"  class="form-control">
						@foreach($qqTypes as $key=>$value)
						<option value="{{$key}}" @if($edit && $edit->type == 4002 && isset($edit->url['qqtype']) ) @if($key == $edit->url['qqtype']) selected  @endif @endif >{{$value['name']}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group types type-4005">
				<span class="col-sm-2 col-sm-2 control-label">标题</span>
				<div class="col-sm-4">
					<input  type="text" name="in_title" class="form-control" @if($edit && $edit->type == 4005 && isset($edit->url['in_title'])) value="{{$edit->url['in_title']}}"  @endif>
				</div>
			</div>

			<div class="form-group types type-4500">
				<span class="col-sm-2 col-sm-2 control-label">QQ号码:*</span>
				<div class="col-sm-4">
					<input  class="form-control" type="text" name="qq" @if($edit && $edit->type == 4500 && isset($edit->url['qq'])) value="{{$edit->url['qq']}}" @else value="" @endif ></div>
			</div>

			@if($curRoom->parent == 0 && empty($edit))
				<div class="form-group">
					<span class="col-sm-4  control-label" style="color: red;">是否同步创建：</span>
					<div class="col-sm-6">
						<input type="checkbox" class="js-switch" name="sync_child"  /></div>
				</div>
			@endif
		<div class="form-group">
			<div class="controls text-center">
				<button type="submit" class="btn btn-primary">确定</button>
			</div>
		</div>
	</form>
</div>
</div></section></div></div>
@endsection
@section('script')
<script src="{{$common_cdn}}/js/ios-switch/switchery.js"></script>
<script src="{{$common_cdn}}/js/ios-switch/ios-init.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
function addImg(id,url){
	var str = '<div class="col-sm-2"></div><div class="col-sm-10">\
		<div class="img-upload">\
			<div id="'+id+'"></div>\
			<p id="'+id+'Dsc" class="webuploader-tip"><p>\
				<input  class="form-control" value="'+url+'" type="hidden" name="imgurls[]" id="'+id+'Input"/>\
				<img id="'+id+'Img" src="'+url+'" height="200" />\
			</p></p>\
		</div>\
	</div>';
	$('.type-4017-subs').append(str);
	 doUpload({
    	id:id,
    	intputId:id+"Input",
    	showId:id+"Img",
    	descId:id+"Dsc",
    	resType:"png,gif,jpg,jepg",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:300*1024,
    });
};
function addImg4017(){
	@if($edit && $edit->type == 4017)
	@if(isset($edit->url['imgurls']))
		@foreach($edit->url['imgurls'] as $key=>$value )
		addImg("idHas{{$key}}","{{$value}}");
		@endforeach
	@endif
	@endif
	
}
function addImg4002(){
	var str = '<span class="col-sm-2 col-sm-2 control-label">图片(800*300):*</span>\
	<div class="col-sm-10">\
		<div class="img-upload">\
			<div id="idPicImg"></div>\
			<p id="idpic_img_msg" class="webuploader-tip"><p>\
				<input  class="form-control" type="hidden" name="imgurl" id="idPicInput" @if($edit && $edit->type == 4002 && isset($edit->url['imgurl']) ) value="{{$edit->url['imgurl']}}" @endif/>\
				<img id="idpic_img"  height="200" @if($edit && $edit->type == 4002 && isset($edit->url['imgurl'])) src="{{$edit->url['imgurl']}}" @endif />\
			</p></p>\
		</div>\
	</div>';
	$('.type-4002-img').html(str);
	doUpload({
    	id:"idPicImg",
    	intputId:"idPicInput",
    	showId:"idpic_img",
    	descId:"idpic_img_msg",
    	resType:"png,gif,jpg,jepg",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:300*1024,
    });
}

$(function () {
   $('.js-clear').click(function(){
    	$(this).parent().find("input").val("");
    	$(this).parent().find("img").attr("src","");
    })
   var idIndex = 0;
     $('.btn-addimg').click(function(){
     	var id = "idBannerImg"+idIndex++;
     	addImg(id,"");
     })
    doUpload({
    	id:"idIconImg",
    	intputId:"idiconImg",
    	showId:"idicon_img",
    	descId:"idicon_img_msg",
    	resType:"png,gif,jpg,jepg",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:300*1024,
    });
 
	$(".types").hide();
 @if($edit)
 	$('.type-{{$edit->type}}').show();
 	@if($edit->type == 4002)
 		addImg4002();
 	@elseif($edit->type==4017)
 		addImg4017()
 	@endif
 @endif
	$('#typeSelect').change(function(){
		$(".types").hide();
		$('.type-'+$(this).val()).show();
		if($(this).val() == 4002){
			addImg4002();
		}
	});
	function changePos(pos){
		$('.type-select-1').hide();
 		$('.type-select-2').hide();
 		$('.type-select-3').hide();
 		$('.type-select-'+pos).show();
	}
	$('#typePos').change(function(){
 		changePos($(this).val());
 	});
	changePos(1);

})
</script>
@endsection
@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading">客服QQ配置</header>
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

				<form class="form-horizontal" method="post" >
					{{ $ctrl->csrf_field() }}
					<input class="form-control" name="id" type='hidden' @if($edit) readonly @endif value="@if($edit){{$edit->
					id}}@endif"  >
					<div class="form-group">
			<span class="col-sm-2 col-sm-2 control-label">位置：*</span>
			<div class="col-sm-4">
				<select id="typeSelect" name="type"  class="form-control">
					@foreach($types as $key=>$value)
					<option value="{{$key}}" @if($edit) @if($key == $edit->type) selected  @endif @endif >{{$value['name']}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group">
			<span class="col-sm-2 col-sm-2 control-label">类型：*</span>
			<div class="col-sm-4">
				<select name="which"  class="form-control">
					@foreach($qqorwx as $key=>$value)
					<option value="{{$key}}" @if($edit) @if($key == $edit->which) selected  @endif @endif >{{$value}}</option>
					@endforeach
				</select>
			</div>
		</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">名称:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="name" @if($edit) value="{{$edit->name}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">QQ:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="qq" @if($edit) value="{{$edit->qq}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">手机号码:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="phone" @if($edit) value="{{$edit->phone}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">排序:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="sort" @if($edit) value="{{$edit->sort}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">开始时间:*</span>
						<div class="col-sm-4">
							<input type="text"  name="start_at" @if($edit) value="{{$edit->
								start_at}}" @endif class="form-control form_time" readonly="" size="16">
						</div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">结束时间:*</span>
						<div class="col-sm-4">
							<input type="text"  name="end_at" @if($edit) value="{{$edit->
								end_at}}" @endif class="form-control form_time" readonly="" size="16">
						</div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">图片：</span>
						<div class="col-sm-8">
							<div class="img-upload">
								<div id="idLogoImg"></div>
								<p id="idLogoImgTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="imgurl" id="idLogoImgInput" @if($edit) value="{{$edit->
										imgurl}}" @endif/>
										<img id="idLogoImgShow" @if($edit) src="{{$edit->imgurl}}" alt="" height="45" @endif/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>
					<div class="form-group">
						<div class="controls text-center">
							<button type="submit" class="btn btn-primary">确定</button>
						</div>
					</div>
				</form>
			</div>
		</section>
	</div>
</div>
@endsection
@section('script')
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-timepicker/css/timepicker.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript">
  $('.form_time').timepicker({
    minuteStep: 1,
    showSeconds: false,
    showMeridian: false,
    defaultTime: false
});
   $('.js-clear').click(function(){
    	$(this).parent().find("input").val("");
    	$(this).parent().find("img").attr("src","");
    })
    doUpload({
    	id:"idLogoImg",
    	intputId:"idLogoImgInput",
    	showId:"idLogoImgShow",
    	descId:"idLogoImgTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
//    	fileName:"{{$curRoomName}}/",
    });
</script>
@endsection
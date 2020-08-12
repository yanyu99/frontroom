@extends('admin.layouts.base')
@section('head')
<link href="{{$common_cdn}}/js/ios-switch/switchery.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading">系统配置</header>
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

				<form id="myForm" class="form-horizontal" method="post" >
					{{ $ctrl->csrf_field() }}
					<input type="hidden" name="id"  @if($edit) value="{{$edit->id}}"  @endif>
					<div class="form-group">
						<span class="col-sm-2 control-label">视频背景：</span>
						<div class="col-sm-6">
							<div class="img-upload">
								<div id="idVideoIMG"></div>
								<p id="idVideoIMGTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="imgurl" id="idVideoIMGInput" @if($edit) value="{{$edit->imgurl}}" @endif/>
										<img id="idVideoIMGShow" @if($edit) src="{{$edit->imgurl}}"  @endif alt="" height="200"/></p>
								</p>
							</div>
						</div>
		
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">开始时间:*</span>
						<div class="col-sm-2">
							<input type="text"  name="s_at" @if($edit) value="{{$edit->
								s_at}}" @endif class="form-control form_time" readonly="" size="16">
						</div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">结束时间:*</span>
						<div class="col-sm-2">
							<input type="text"  name="e_at" @if($edit) value="{{$edit->
								e_at}}" @endif class="form-control form_time" readonly="" size="16">
						</div>
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

@section("script")
<script src="{{$common_cdn}}/js/ios-switch/switchery.js"></script>
<script src="{{$common_cdn}}/js/ios-switch/ios-init.js"></script>
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-timepicker/css/timepicker.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript">
  $('.form_time').timepicker({
    minuteStep: 1,
    showSeconds: false,
    showMeridian: false,
    defaultTime: false
});
$(function(){
	$('.js-clear').click(function(){
    	$(this).parent().find("input").val("");
    	$(this).parent().find("img").attr("src","");
    });
    doUpload({
    	id:"idVideoIMG",
    	intputId:"idVideoIMGInput",
    	showId:"idVideoIMGShow",
    	descId:"idVideoIMGTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:200*1024,
    });
})
	
</script>
@endsection

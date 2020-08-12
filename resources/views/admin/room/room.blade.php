@extends('admin.layouts.base')
@section('head')
<link href="{{$common_cdn}}/js/ios-switch/switchery.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading">房间基础配置</header>
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
				<form id="myForm" class="form-horizontal" method="post" action="/admin/room/index" >
					{{ $ctrl->csrf_field() }}
					@if($main_power && $curRoom->parent == 0 || !$main_power)
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">标题：</span>
						<div class="col-sm-6">
							<input  class="form-control" type="text" name="title" value="{{$room->title}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">描述：</span>
						<div class="col-sm-8">
							<input  class="form-control" type="text" name="description" value="{{$room->description}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">关键词：</span>
						<div class="col-sm-8">
							<input  class="form-control" type="text" name="keywords" value="{{$room->keywords}}" ></div>
					</div>
					@endif
					<!--<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">copyright：</span>
						<div class="col-sm-8">
							<input  class="form-control" type="text" name="copyright" value="{{$room->copyright}}" ></div>
					</div>-->
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">动态公告：</span>
						<div class="col-sm-8">
							<input  class="form-control" type="text" name="notice_msg" value="{{$room->notice_msg}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">动态消息：</span>
						<div class="col-sm-8">
							<input  class="form-control" type="text" name="dynamic_msg" value="{{$room->dynamic_msg}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">自动私聊文字：</span>
						<div class="col-sm-8">
							<input  class="form-control" type="text" name="prichatmsg" value="{{$room->prichatmsg}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">开启无限自动私聊：</span>
						<div class="col-sm-8">
							<input type="checkbox" class="js-switch" name="pri_num" @if($room->pri_num) checked @endif" ><span style="color: red;">（说明：关闭后系统一天只会发一条自动私聊给用户，开启后只要用户一刷新直播间系统就会发）</span></div>
					</div>
					
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">通知：</span>
						<div class="col-sm-8">
							<input  class="form-control" type="text" name="chat_top_msg" value="{{$room->chat_top_msg}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">免责说明：</span>
						<div class="col-sm-8">
							<input  class="form-control" type="text" name="chat_bottom_msg" value="{{$room->chat_bottom_msg}}" ></div>
					</div>
					@if($main_power && $curRoom->parent == 0 || !$main_power)
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">&lt;body&gt;后的统计代码：</span>
						<div class="col-sm-8">
							<textarea  class="form-control "  type="text" name="code_body_pre"  >{{$room->code_body_pre}}</textarea></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">&lt;/body&gt;前统计代码：</span>
						<div class="col-sm-8">
							<textarea  class="form-control "  type="text" name="code"  >{{$room->code}}</textarea></div>
					</div>

						<div class="form-group">
							<span class="col-sm-2 col-sm-2 control-label">PC端LOGO：</span>
							<div class="col-sm-8">
								<div class="img-upload">
									<div id="idLogoImg"></div>
									<p id="idLogoImgTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="logo" id="idLogoImgInput" value="{{$room->
										logo}}"/>
										<img id="idLogoImgShow" src="{{$room->logo}}" alt="" height="45"/></p>
									</p>
								</div>
							</div>
							<button class="btn btn-danger js-clear" type="button" >清除</button>
						</div>

						<div class="form-group">
							<span class="col-sm-2 col-sm-2 control-label">手机端LOGO：</span>
							<div class="col-sm-8">
								<div class="img-upload">
									<div id="idMobileLogoImg"></div>
									<p id="idMobileLogoImgTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="mobile_logo" id="idMobileLogoImgInput" value="{{$room->
										mobile_logo}}"/>
										<img id="idMobileLogoImgShow" src="{{$room->mobile_logo}}" alt="" height="45"/></p>
									</p>
								</div>
								<p style="color: red;">不设置将使用PC端logo</p>
							</div>
							<button class="btn btn-danger js-clear" type="button" >清除</button>
						</div>

					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">ICON：</span>
						<div class="col-sm-8">
							<div class="img-upload">
								<div id="idIconImg"></div>
								<p id="idicon_img_msg" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="icon" id="idiconImg" value="{{$room->icon}}"/>
										<img id="idicon_img" src="{{$room->icon}}" alt="" height="30"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>
					@endif
					@if($room->parent == 0)
					<div class="form-group">
						<span class="col-sm-4  control-label" style="color: red;">是否将以上配置同步到所有代理房间：</span>
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
		</section>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{$common_cdn}}/js/ckeditor/ckeditor.js"></script>
<script src="{{$common_cdn}}/js/ios-switch/switchery.js"></script>
<script src="{{$common_cdn}}/js/ios-switch/ios-init.js"></script>
<script type="text/javascript">

$(function () {
    // 初始化Web Uploader
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
//    	fileName:"{{$curRoomName}}/logo",
    });

        doUpload({
    	id:"idMobileLogoImg",
    	intputId:"idMobileLogoImgInput",
    	showId:"idMobileLogoImgShow",
    	descId:"idMobileLogoImgTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
//    	fileName:"{{$curRoomName}}/logo",
    });
    
    doUpload({
    	id:"idIconImg",
    	intputId:"idiconImg",
    	showId:"idicon_img",
    	descId:"idicon_img_msg",
    	resType:"ico",
//    	fileName:"{{$curRoomName}}/ico",
    	csrf_token:'{{ $ctrl->csrf_token() }}'
    });
 
})
</script>
@endsection
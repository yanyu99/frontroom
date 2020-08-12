@extends('super.layouts.base')
@section('head')
<link href="{{$common_cdn}}/js/ios-switch/switchery.css" rel="stylesheet">
<link href="{{$common_cdn}}/js/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading">系统配置</header>
			<div class="panel-body">
				<form id="myForm" class="form-horizontal" method="post" action="/super/config/index">
					{{ $ctrl->csrf_field() }}

					<div class="form-group">
						<span class="col-sm-2  control-label">用户列表标题：</span>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="ul_title" value="{{$edit->ul_title}}"></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2  control-label">专家团队标题：</span>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="ter_title" value="{{$edit->ter_title}}"></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2  control-label">活动展示标题：</span>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="banner_title" value="{{$edit->banner_title}}"></div>
					</div>

					<div class="form-group">
						<span class="col-sm-2  control-label">登陆模式选择：</span>
						<div class="col-sm-6">
							<select class="form-control" name="reg_mod" onchange="$('.upload-for-reg-2').toggle();">
								@foreach(['1'=>"默认模式","2"=>"入场券模式"] as $key1=>$sitem)
									<option @if($key1 == $edit->reg_mod) selected @endif value='{{$key1}}'>{{$sitem}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group">
						<span class="col-sm-2  control-label">登陆注册`账号`字样：</span>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="reg_account_tag" value="{{$edit->reg_account_tag}}"></div>
					</div>

					<div class="form-group">
						<span class="col-sm-2  control-label">视频全屏模式：</span>
						<div class="col-sm-6">
							<select class="form-control" name="stretching">
								@foreach(["1"=>"按比例铺满","2"=>"铺满全屏", "3"=>"视频原始大小"] as $key1=>$sitem)
									<option @if($key1 == $edit->stretching) selected @endif value='{{$key1}}'>{{$sitem}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group">
						<span class="col-sm-2  control-label">手机全屏模式：</span>
						<div class="col-sm-6">
							<input type="checkbox" class="js-switch" name="mobilefullscreen" @if($edit->mobilefullscreen) checked @endif />
						<p><span style="color: red;">只用于线路4 关闭表示手机视频非全屏</span></p>
						</div>
					</div>

					<div class="form-group upload-for-reg-2" style="display: {{ $edit->reg_mod==2 ? 'block' : 'none'  }}">
						<span class="col-sm-2 control-label">入场券PC背景(建议1080*382)：</span>
						<div class="col-sm-6">
							<div class="img-upload">
								<div id="idReg2PCBg"></div>
								<p id="idReg2PCBgTip" class="webuploader-tip">
								<p>
									<input  class="form-control" type="hidden" name="reg2_pc_bg" id="idReg2PCBgInput" value="{{$edit->reg2_pc_bg}}"/>
									<img id="idReg2PCBgShow" src="{{$edit->reg2_pc_bg}}" alt="" height="200"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>

					<div class="form-group upload-for-reg-2" style="display: {{ $edit->reg_mod==2 ? 'block' : 'none'  }}">
						<span class="col-sm-2 control-label">入场券手机背景(建议750*1334)：</span>
						<div class="col-sm-6">
							<div class="img-upload">
								<div id="idReg2MobileBg"></div>
								<p id="idReg2MobileBgTip" class="webuploader-tip">
								<p>
									<input  class="form-control" type="hidden" name="reg2_mobile_bg" id="idReg2MobileBgInput" value="{{$edit->reg2_mobile_bg}}"/>
									<img id="idReg2MobileBgShow" src="{{$edit->reg2_mobile_bg}}" alt="" height="200"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>

					@if($site->proposing_opend)
					<div class="form-group">
						<span class="col-sm-2  control-label">用户关注重置时间（天）：</span>
						<div class="col-sm-6">
							<input  class="form-control" type="text" name="follow_reset" value="{{$edit->follow_reset}}" ></div>
					</div>
					@endif
					
					<div class="form-group">
						<span class="col-sm-2  control-label">管理员聊天背景色：</span>
						<div class="col-sm-6">
							<input name="mgr_color" class="form-control dropdown-toggle" id="selected-color1" data-toggle="dropdown" value="{{$edit->mgr_color}}">
							<ul class="dropdown-menu">
								<li><div id="colorpalette1"></div></li>
							</ul>
						</div>
					</div>
					<div class="form-group">
						<span class="col-sm-2  control-label">当前讲师替换：</span>
						<div class="col-sm-6">
							<input  class="form-control" type="text" name="teacher_pre" value="{{$edit->teacher_pre}}" ></div>
					</div>

					<div class="form-group">
						<span class="col-sm-2  control-label">讲师关闭投票提示：</span>
						<div class="col-sm-6">
							<input  class="form-control" type="text" name="is_vote_msg" value="{{$edit->is_vote_msg}}" >
							<p><span style="color: red;">可为空，默认提示信息为 该讲师暂时不接受投票</span></p>
						</div>
					</div>

					<div class="form-group">
						<span class="col-sm-2  control-label">用户每日点赞数：</span>
						<div class="col-sm-6">
							<input  class="form-control" type="text" name="max_agree_num" value="{{$edit->max_agree_num}}" >
							<p><span style="color: red;">每日给每位讲师最大点赞数，设置为0表示不允许点赞</span></p>
						</div>
					</div>

					<div class="form-group">
						<span class="col-sm-2  control-label">手机视频宽高比：</span>
						<div class="col-sm-6">
							<input  class="form-control" type="text" name="phone_video" value="{{$edit->phone_video}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2  control-label">聊天最大消息长度：</span>
						<div class="col-sm-6">
							<input  class="form-control" type="text" name="max_chat_length" value="{{$edit->max_chat_length}}" ></div>
					</div>

					<div class="form-group">
						<span class="col-sm-2  control-label">动态公告颜色：</span>
						<div class="col-sm-6">
							<input name="notice_msg_color" class="form-control dropdown-toggle" id="selected-color2" data-toggle="dropdown" value="{{$edit->notice_msg_color}}">
							<ul class="dropdown-menu">
								<li><div id="colorpalette2"></div></li>
							</ul>
						</div>
					</div>
					@if($site->hot_opend)
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">人气时间:*</span>
						<div class="col-sm-2">
							<div class="input-group">
								<input type="text"  name="hot_s_at" @if($edit) value="{{$edit->hot_s_at}}" @endif class="form-control form_time"  size="16">
								<span class="input-group-btn">
                                                            <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                                                            </span>
							</div>
							</div><div class="col-sm-2">
							<div class="input-group">
								<input type="text"  name="hot_e_at" @if($edit) value="{{$edit->hot_e_at}}" @endif class="form-control form_time"  size="16">
								<span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                                                            </span>
                           </div>
							
						</div>
					</div>
					
					<div class="form-group">
						<span class="col-sm-2 control-label">人气标题图片(212*38)：</span>
						<div class="col-sm-6">
							<div class="img-upload">
								<div id="idHotImg"></div>
								<p id="idHotImgTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="hot_img" id="idHotImgInput" value="{{$edit->hot_img}}"/>
										<img id="idHotImgShow" src="{{$edit->hot_img}}" alt="" height="26"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>
					@endif
					<div class="form-group">
						<span class="col-sm-2 control-label">助理图片（114*26）：</span>
						<div class="col-sm-6">
							<div class="img-upload">
								<div id="idQQIMG"></div>
								<p id="idQQIMGTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="qq_img" id="idQQIMGInput" value="{{$edit->qq_img}}"/>
										<img id="idQQIMGShow" src="{{$edit->qq_img}}" alt="" height="26"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>

					<div class="form-group">
						<span class="col-sm-2 control-label">关闭预览图图片：</span>
						<div class="col-sm-6">
							<div class="img-upload">
								<div id="idCloseImg"></div>
								<p id="idCloseImgTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="closeimg" id="idCloseImgInput" value="{{$edit->closeimg}}"/>
										<img id="idCloseImgShow" src="{{$edit->closeimg}}" alt="" height="100"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>


					<div class="form-group">
						<span class="col-sm-2 control-label">关闭预览图手机图片：</span>
						<div class="col-sm-6">
							<div class="img-upload">
								<div id="idCloseImgMobile"></div>
								<p id="idCloseImgMobileTip" class="webuploader-tip">
								<p>
									<input  class="form-control" type="hidden" name="closeimg_mobile" id="idCloseImgMobileInput" value="{{$edit->closeimg_mobile}}"/>
									<img id="idCloseImgMobileShow" src="{{$edit->closeimg_mobile}}" alt="" height="100"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>

					<div class="form-group">
						<span class="col-sm-2 control-label">是否关闭直播间：</span>
						<div class="col-sm-6">

							<input type="checkbox" class="js-switch" name="closed" @if($edit->closed) checked @endif /></div>
					</div>

					<div class="form-group">
						<span class="col-sm-2 control-label">密码背景(建议1920*1200)：</span>
						<div class="col-sm-6">
							<div class="img-upload">
								<div id="idPwdBg"></div>
								<p id="idPwdBgTip" class="webuploader-tip">
								<p>
									<input  class="form-control" type="hidden" name="pwd_bg" id="idPwdBgInput" value="{{$edit->pwd_bg}}"/>
									<img id="idPwdBgShow" src="{{$edit->pwd_bg}}" alt="" height="200"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>


					<div class="form-group">
						<span class="col-sm-2 control-label">手机密码背景(建议750*514)：</span>
						<div class="col-sm-6">
							<div class="img-upload">
								<div id="idMobilePwdBg"></div>
								<p id="idMobilePwdBgTip" class="webuploader-tip">
								<p>
									<input  class="form-control" type="hidden" name="mobile_pwd_bg" id="idMobilePwdBgInput" value="{{$edit->mobile_pwd_bg}}"/>
									<img id="idMobilePwdBgShow" src="{{$edit->mobile_pwd_bg}}" alt="" height="200"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>

				@if($site->ui_type == "v2")

					<div class="form-group">
						<span class="col-sm-2  control-label">聊天QQ文字：</span>
						<div class="col-sm-6">
							<input  class="form-control" type="text" name="qqtext" value="{{$edit->qqtext}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2  control-label">股票code：</span>
						<div class="col-sm-6">
							<input  class="form-control" type="text" name="stock_code" value="{{$edit->stock_code}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2  control-label">讲师观看时间统计：</span>
						<div class="col-sm-6">
							<input  class="form-control form_time" type="text" name="look_count_time" value="{{$edit->look_count_time}}" ></div>
					</div>
					
					@endif

					@if($site->video_cfg)
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">黄金时间:*</span>
						<div class="col-sm-2">
						<div class="input-group">
							<input type="text"  name="hj_start_at" @if($edit) value="{{$edit->
								hj_start_at}}" @endif class="form-control form_time" readonly="" size="16">
								<span class="input-group-btn">
                                                            <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                                                            </span>
								</div>

						</div><div class="col-sm-2">
								<div class="input-group">

								<input type="text"  name="hj_end_at" @if($edit) value="{{$edit->
								hj_end_at}}" @endif class="form-control form_time" readonly="" size="16">
								<span class="input-group-btn">
                                                            <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                                                            </span>
						</div>
							
						</div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 control-label">黄金背景：</span>
						<div class="col-sm-6">
							<div class="img-upload">
								<div id="idHJIMG"></div>
								<p id="idHJIMGTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="hj_bg" id="idHJIMGInput" value="{{$edit->hj_bg}}"/>
										<img id="idHJIMGShow" src="{{$edit->hj_bg}}" alt="" height="200"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>
					<div class="form-group">
						<span class="col-sm-2 control-label">是否开启黄金时间：</span>
						<div class="col-sm-6">

							<input type="checkbox" class="js-switch" name="hj_opend" @if($edit->hj_opend) checked @endif /></div>
					</div>
					@endif

					
					<div class="form-group">
						<span class="col-sm-2 control-label">禁看视频背景：</span>
						<div class="col-sm-6">
							<div class="img-upload">
								<div id="idLookVideo"></div>
								<p id="idLookVideoTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="lookvideoImg" id="idLookVideoInput" value="{{$edit->lookvideoImg}}"/>
										<img id="idLookVideoShow" src="{{$edit->lookvideoImg}}" alt="" height="200"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>
					@if($site->ui_type == "v2")
					<div class="form-group">
						<span class="col-sm-2 control-label">课程表背景：</span>
						<div class="col-sm-6">
							<div class="img-upload">
								<div id="idLessonBg"></div>
								<p id="idLessonBgTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="lessonImg" id="idLessonBgInput" value="{{$edit->lessonImg}}"/>
										<img id="idLessonBgShow" src="{{$edit->lessonImg}}" alt="" height="200"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>
					@endif
					<!--div class="form-group">
						<span class="col-sm-2 control-label">冻结房间图片：</span>
						<div class="col-sm-6">
							<div class="img-upload">
								<div id="idRoomErrorBg"></div>
								<p id="idRoomErrorBgTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="roomErrorImg" id="idRoomErrorBgInput" value="{{$edit->roomErrorImg}}"/>
										<img id="idRoomErrorBgShow" src="{{$edit->roomErrorImg}}" alt="" height="200"/>
									</p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div-->
					@foreach($showMap as $key=>$value)
					<div class="form-group">
						<span class="col-sm-2 control-label">{{$value}}:</span>
						<div class="col-sm-2">
							<input type="checkbox" class="js-switch" name="{{$key}}"   @if($edit->$key == 1) checked @endif /></div>
					</div>
					@endforeach

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
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-colorpalette/js/bootstrap-colorpalette.js" ></script>
<script type="text/javascript">

$(function(){
	  $('.form_time').timepicker({
    minuteStep: 1,
    showSeconds: false,
    showMeridian: false,
    defaultTime: false
});
	$('#colorpalette1').colorPalette().on('selectColor', function(e) {
		$('#selected-color1').val(e.color);
	});
	$('#colorpalette2').colorPalette().on('selectColor', function(e) {
		$('#selected-color2').val(e.color);
	});
	$('.js-clear').click(function(){
    	$(this).parent().find("input").val("");
    	$(this).parent().find("img").attr("src","");
    });
    doUpload({
    	id:"idQQIMG",
    	intputId:"idQQIMGInput",
    	showId:"idQQIMGShow",
    	descId:"idQQIMGTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:50*1024,
    });
    doUpload({
    	id:"idPwdBg",
    	intputId:"idPwdBgInput",
    	showId:"idPwdBgShow",
    	descId:"idPwdBgTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:200*1024,
    });
    doUpload({
    	id:"idMobilePwdBg",
    	intputId:"idMobilePwdBgInput",
    	showId:"idMobilePwdBgShow",
    	descId:"idMobilePwdBgTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:200*1024,
    });
    doUpload({
    	id:"idVideoIMG",
    	intputId:"idVideoIMGInput",
    	showId:"idVideoIMGShow",
    	descId:"idVideoIMGTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:200*1024,
    });
    doUpload({
    	id:"idHJIMG",
    	intputId:"idHJIMGInput",
    	showId:"idHJIMGShow",
    	descId:"idHJIMGTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:200*1024,
    });
    doUpload({
    	id:"idVideoLeft",
    	intputId:"idVideoLeftInput",
    	showId:"idVideoLeftShow",
    	descId:"idVideoLeftTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:200*1024,
    });
    doUpload({
    	id:"idVideoRight",
    	intputId:"idVideoRightInput",
    	showId:"idVideoRightShow",
    	descId:"idVideoRightTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:200*1024,
    });
    doUpload({
    	id:"idLookVideo",
    	intputId:"idLookVideoInput",
    	showId:"idLookVideoShow",
    	descId:"idLookVideoTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:200*1024,
    });
    doUpload({
    	id:"idLessonBg",
    	intputId:"idLessonBgInput",
    	showId:"idLessonBgShow",
    	descId:"idLessonBgTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:200*1024,
    });
     doUpload({
    	id:"idHotImg",
    	intputId:"idHotImgInput",
    	showId:"idHotImgShow",
    	descId:"idHotImgTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:50*1024,
    });
    doUpload({
    	id:"idCloseImg",
    	intputId:"idCloseImgInput",
    	showId:"idCloseImgShow",
    	descId:"idCloseImgTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:2*1024*1024
    });
    doUpload({
        id:"idCloseImgMobile",
        intputId:"idCloseImgMobileInput",
        showId:"idCloseImgMobileShow",
        descId:"idCloseImgMobileTip",
        csrf_token:'{{ $ctrl->csrf_token() }}',
        fileSize:2*1024*1024
    });
    doUpload({
        id:"idReg2PCBg",
        intputId:"idReg2PCBgInput",
        showId:"idReg2PCBgShow",
        descId:"idReg2PCBgTip",
        csrf_token:'{{ $ctrl->csrf_token() }}',
        fileSize:1024*1024
    });
    doUpload({
        id:"idReg2MobileBg",
        intputId:"idReg2MobileBgInput",
        showId:"idReg2MobileBgShow",
        descId:"idReg2MobileBgTip",
        csrf_token:'{{ $ctrl->csrf_token() }}',
        fileSize:1024*1024
    });

});
	
</script>
@endsection

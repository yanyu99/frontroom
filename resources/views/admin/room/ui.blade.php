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
				<form id="myForm" class="form-horizontal" method="post" >
					{{ $ctrl->csrf_field() }}
					@if($main_power && $curRoom->parent == 0  || !$main_power)
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">弹出图片(100KB)：</span>
						<div class="col-sm-8">
							<div class="img-upload">
								<div id="idPopImg"></div>
								<p id="idPopImgTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="pop_img" id="idPopImgInput" value="{{$roomUI->pop_img}}"/>
										<img id="idPopImgShow" src="{{$roomUI->pop_img}}" alt="" height="100"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>
					@if($site->ui_type == "v1")
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">课程表图片(300KB)：</span>
						<div class="col-sm-8">
							<div class="img-upload">
								<div id="idLesson"></div>
								<p id="idLessonTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="lesson_img" id="idLessonInput" value="{{$roomUI->
										lesson_img}}"/>
										<img id="idLessonShow" src="{{$roomUI->lesson_img}}" alt="" height="100"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>
					@endif

					@endif
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">公众号二维码(100KB)：</span>
						<div class="col-sm-8">
							<div class="img-upload">
								<div id="idEWM"></div>
								<p id="idEWMTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="wechat_img" id="idEWMInput" value="{{$roomUI->
										wechat_img}}"/>
										<img id="idEWMShow" src="{{$roomUI->wechat_img}}" alt="" height="100"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">游客登陆弹出框图片(720*280)(50KB)：</span>
						<div class="col-sm-8">
							<div class="img-upload">
								<div id="idLoginPopImg"></div>
								<p id="idLoginPopImgTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="login_pop_img" id="idLoginPopImgInput" value="{{$roomUI->
										login_pop_img}}"/>
										<img id="idLoginPopImgShow" src="{{$roomUI->login_pop_img}}" alt="" height="100"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>
					@if($main_power && $curRoom->parent == 0  || !$main_power)
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">用户列表图片(建议尺寸195*590)(50KB)：</span>
						<div class="col-sm-8">
							<div class="img-upload">
								<div id="idUlImg"></div>
								<p id="idUlImgTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="ulimg" id="idUlImgInput" value="{{$roomUI->ulimg}}"/>
										<img id="idUlImgShow" src="{{$roomUI->ulimg}}" alt="" height="100"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>

					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">登陆页面LOGO(50KB)：</span>
						<div class="col-sm-8">
							<div class="img-upload">
								<div id="idLoginLogo"></div>
								<p id="idLoginLogoTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="login_logo" id="idLoginLogoInput" value="{{$roomUI->login_logo}}"/>
										<img id="idLoginLogoShow" src="{{$roomUI->login_logo}}" alt="" height="100"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>


					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">登陆框广告图(400*355)(100KB)：</span>
						<div class="col-sm-8">
							<div class="img-upload">
								<div id="idLoginAd"></div>
								<p id="idLoginAdTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="login_ad" id="idLoginAdInput" value="{{$roomUI->login_ad}}"/>
										<img id="idLoginAdShow" src="{{$roomUI->login_ad}}" alt="" height="100"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>

					<div class="form-group">
						<span class="col-sm-2 control-label">冻结房间图片：</span>
						<div class="col-sm-6">
							<div class="img-upload">
								<div id="idRoomFrozenImg"></div>
								<p id="idRoomFrozenImgTip" class="webuploader-tip">
								<p>
									<input  class="form-control" type="hidden" name="room_frozen_img" id="idRoomFrozenImgInput" value="{{$roomUI->room_frozen_img}}"/>
									<img id="idRoomFrozenImgShow" src="{{$roomUI->room_frozen_img}}" alt="" height="200"/>
								</p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>


						<div class="form-group">
							<span class="col-sm-2 col-sm-2 control-label">PC顶部轮播图片</span>
							<div class="col-sm-4">
								<input  type="button" class="btn btn-primary btn-addimg" onclick="addUpImg('pc-banner', '', '', 'pc_banner')" value="新增图片">
							</div>
						</div>

						<div class="form-group" id="pc-banner"></div>

						<div class="form-group">
							<span class="col-sm-2 col-sm-2 control-label">手机轮播图片</span>
							<div class="col-sm-4">
								<input  type="button" class="btn btn-primary btn-addimg" onclick="addUpImg('mobile-banner', '', '', 'mobile_banner')" value="新增图片">
							</div>
						</div>

						<div class="form-group" id="mobile-banner"></div>

						<div class="form-group">
							<span class="col-sm-2 col-sm-2 control-label">是否开启进入页面：</span>
							<div class="col-sm-8">
								<input onchange="changeIsShowEnterPage(this)" type="checkbox" class="js-switch" name="show_enter_page" {{ !empty($roomUI->show_enter_page) ? 'checked' : ''  }}  /></div>
						</div>

						<div class="form-group enter_page" >
							<span class="col-sm-2 col-sm-2 control-label">是否只显示一次：</span>
							<div class="col-sm-8">
								<input type="checkbox" class="js-switch" name="enter_page[s_type]" {{ !empty($roomUI->enter_page_cfg['s_type']) ? 'checked' : ''  }} /></div>
						</div>

						<div class="form-group enter_page">
							<span class="col-sm-2 col-sm-2 control-label">页面类型：</span>
							<div class="col-sm-8">
								<select name="enter_page[p_type]" class="form-control" id="enter_page_p_select" onchange="changePageType(this)">
									@foreach($enter_page_map as $pk => $pv)
										<option {{ !empty($roomUI->enter_page_cfg['p_type']) && $roomUI->enter_page_cfg['p_type']==$pk ? 'selected' : '' }} value="{{$pk}}">{{$pv}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group enter_page p_type p_type_pic">
							<span class="col-sm-2 control-label">PC端 图片：</span>
							<div class="col-sm-6">
								<div class="img-upload">
									<div id="idEnterPagePicImg"></div>
									<p id="idEnterPagePicImgTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="enter_page[pic]" id="idEnterPagePicImgInput" value="{{ !empty($roomUI->enter_page_cfg['pic']) ? $roomUI->enter_page_cfg['pic'] : ''  }}"/>
										<img id="idEnterPagePicImgShow" src="{{ !empty($roomUI->enter_page_cfg['pic']) ? $roomUI->enter_page_cfg['pic'] : ''  }}" alt="" height="200"/>
									</p>
									</p>
								</div>
							</div>
							<button class="btn btn-danger js-clear" type="button" >清除</button>
						</div>

						<div class="form-group enter_page p_type p_type_pic">
							<span class="col-sm-2 control-label">手机端 图片：</span>
							<div class="col-sm-6">
								<div class="img-upload">
									<div id="idEnterPageMPicImg"></div>
									<p id="idEnterPageMPicImgTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="enter_page[mpic]" id="idEnterPageMPicImgInput" value="{{ !empty($roomUI->enter_page_cfg['mpic']) ? $roomUI->enter_page_cfg['mpic'] : ''  }}"/>
										<img id="idEnterPageMPicImgShow" src="{{ !empty($roomUI->enter_page_cfg['mpic']) ? $roomUI->enter_page_cfg['mpic'] : ''  }}" alt="" height="400"/>
									</p>
									</p>
								</div>
							</div>
							<button class="btn btn-danger js-clear" type="button" >清除</button>
						</div>

						<div class="form-group enter_page p_type p_type_video">
							<span class="col-sm-2 col-sm-2 control-label">视频：</span>
							<div class="col-sm-8">
								<input  class="form-control" type="text"  name="enter_page[video]"  value="{{ !empty($roomUI->enter_page_cfg['video']) ? $roomUI->enter_page_cfg['video'] : ''  }}" />
							</div>
						</div>
						<div class="form-group enter_page p_type p_type_html" >
							<span class="col-sm-2 col-sm-2 control-label">HTML代码：</span>
							<div class="col-sm-8">
								<textarea rows=10 class="form-control " type="text" name="enter_page[html]">{!! !empty($roomUI->enter_page_cfg['html']) ? $roomUI->enter_page_cfg['html'] : '' !!}</textarea>
							</div>
						</div>

					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">登陆框QQ：</span>
						<div class="col-sm-8">
							<input  class="form-control" type="text" name="login_qq" value="{{$roomUI->login_qq}}" ></div>
					</div>
					@endif
					<div class="form-group">
						<span class="col-sm-2 control-label">界面侧边栏显示:</span>
						<div class="col-sm-6">
							<div class="input-group">
								@foreach($showMap as $key=>$value)
									<label class="checkbox-inline" style="margin-left: 10px;">
										<input   type="checkbox" name="{{$key}}"  @if($roomUI->$key == 1) checked @endif>
										<span>{{$value}}</span>
									</label>
								@endforeach
							</div>
						</div>
					</div>
					@if($curRoom->parent == 0)
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
<script src="{{$common_cdn}}/js/ios-switch/switchery.js"></script>
<script src="{{$common_cdn}}/js/ios-switch/ios-init.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	var DATA_ENTER_SHOW = {{ !empty($roomUI->show_enter_page) ? 1 : 0  }};
	var DATA_ENTER_CFG = {!! !empty($roomUI->enter_page_cfg) ? json_encode($roomUI->enter_page_cfg, true) : '{}'  !!};

	function changeIsShowEnterPage(obj) {
	    var is_show =  $(obj).is(":checked") ? 1 : 0;
        _changeIsShowEnterPage(is_show);
    }
    
    function changePageType(obj) {
		var p_type = $(obj).val();
        _changePageType(p_type);
    }
    
    function _changePageType(p_type) {
        $('.p_type').hide();
        $('.p_type_' + p_type ).show();
    }

    function _changeIsShowEnterPage(is_show) {
	    if(is_show){
            $('.enter_page').show();
            _changePageType($('#enter_page_p_select').val());
		} else {
            $('.enter_page').hide();
		}
    }

    var DATA_MOBILE_BANNER_CFG = {!! !empty($roomUI->mobile_banner_cfg) ? json_encode($roomUI->mobile_banner_cfg, true) : '{}'  !!};
    var DATA_PC_BANNER_CFG = {!! !empty($roomUI->pc_banner_cfg) ? json_encode($roomUI->pc_banner_cfg, true) : '{}'  !!};

    $(function () {
        _changeIsShowEnterPage(DATA_ENTER_SHOW);

		function loadCfg(data, box, type) {
            for(var key in data){
                var item = data[key];
                item.src && addUpImg(box, item.src, item.href, type);
            }
        }
        loadCfg(DATA_PC_BANNER_CFG, 'pc-banner', 'pc_banner');
        loadCfg(DATA_MOBILE_BANNER_CFG, 'mobile-banner', 'mobile_banner');
    });

	function addUpImg(box, src, href, type) {
        href = href || '';
        var idx = $('#' + box).find('.img-upload').length;
        idx += 1;
        var id = box + '-' + idx;
        addImg(box, id, src, href, type)
    }

    function addImg(box, id, url, href, type){
	    var cls = id + 'class' ;
        var str = '<div class="col-sm-2 '+cls+'" ></div>\
        <div class="col-sm-9 '+cls+'" style="    border: 1px solid #f1f1f1;padding: 10px 0px; margin:10px 0px; ">\
		<div class="img-upload">\
		    <img id="'+id+'Img" src="'+url+'" height="60" alt="请上传图片" width="70%" />\
			<div id="'+id+'" style="width: 100px;float: right;padding-right: 10px;margin-top:10px;"></div>\
			<p id="'+id+'Dsc" class="webuploader-tip" ></p>\
            <input  class="form-control" value="'+url+'" type="hidden" name="' + type + '_src[]" id="'+id+'Input"  />\
            <div class="col-sm-10" >\
                <p style="margin-top:10px;">跳转链接：<input class="form-control" type="text" name="'+type+'_href[]" value="'+href+'" style="width:58%;display:inline-block;">\
                <button type="button" class="btn btn-primary" onclick="$(\'.'+cls+'\').remove()" >清除</button></p>\
            </div>\
		</div>\
	</div>';
        $('#' + box).append(str);
        doUpload({
            id:id,
            intputId:id+"Input",
            showId:id+"Img",
            descId:id+"Dsc",
            resType:"png,gif,jpg,jepg",
            csrf_token:'{{ $ctrl->csrf_token() }}',
            fileSize:1024*1024
        });
    }


$(function () {
    // 初始化Web Uploader
    $('.js-clear').click(function(){
    	$(this).parent().find("input").val("");
    	$(this).parent().find("img").attr("src","");
    });
     doUpload({
    	id:"idPopImg",
    	intputId:"idPopImgInput",
    	showId:"idPopImgShow",
    	descId:"idPopImgTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:100*1024,
    	//fileName:"{{$curRoomName}}/enter_pop",
    });
    doUpload({
    	id:"idEWM",
    	intputId:"idEWMInput",
    	showId:"idEWMShow",
    	descId:"idEWMTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:100*1024,
    	//fileName:"{{$curRoomName}}/gzh_ewm",
    });
    doUpload({
    	id:"idLesson",
    	intputId:"idLessonInput",
    	showId:"idLessonShow",
    	descId:"idLessonTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:300*1024,
    	//fileName:"{{$curRoomName}}/lesson",
    });
    doUpload({
    	id:"idLoginPopImg",
    	intputId:"idLoginPopImgInput",
    	showId:"idLoginPopImgShow",
    	descId:"idLoginPopImgTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:50*1024,
    	//fileName:"{{$curRoomName}}/login_pop",
    });
    doUpload({
    	id:"idUlImg",
    	intputId:"idUlImgInput",
    	showId:"idUlImgShow",
    	descId:"idUlImgTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:50*1024,
    	//fileName:"{{$curRoomName}}/login_pop",
    });
    doUpload({
    	id:"idLoginLogo",
    	intputId:"idLoginLogoInput",
    	showId:"idLoginLogoShow",
    	descId:"idLoginLogoTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:50*1024,
    	//fileName:"{{$curRoomName}}/login_pop",
    });
    doUpload({
        id:"idLoginAd",
        intputId:"idLoginAdInput",
        showId:"idLoginAdShow",
        descId:"idLoginAdTip",
        csrf_token:'{{ $ctrl->csrf_token() }}',
        fileSize:100*1024,
        //fileName:"{{$curRoomName}}/login_pop",
    });

    doUpload({
        id:"idRoomFrozenImg",
        intputId:"idRoomFrozenImgInput",
        showId:"idRoomFrozenImgShow",
        descId:"idRoomFrozenImgTip",
        csrf_token:'{{ $ctrl->csrf_token() }}',
        fileSize:1024*1024
    });

    doUpload({
        id:"idEnterPagePicImg",
        intputId:"idEnterPagePicImgInput",
        showId:"idEnterPagePicImgShow",
        descId:"idEnterPagePicImgTip",
        csrf_token:'{{ $ctrl->csrf_token() }}',
        fileSize:2 * 1024*1024,
    });

    doUpload({
        id:"idEnterPageMPicImg",
        intputId:"idEnterPageMPicImgInput",
        showId:"idEnterPageMPicImgShow",
        descId:"idEnterPageMPicImgTip",
        csrf_token:'{{ $ctrl->csrf_token() }}',
        fileSize:2 * 1024*1024,
    });
})
</script>

@endsection
@extends('super.layouts.base')
@section('head')
<link href="{{$common_cdn}}/js/ios-switch/switchery.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">用户设置</header>
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
          <div class="form-group">

            <span class="col-sm-2 col-sm-2 control-label">角色：</span>
            <div class="col-sm-4">
              <select id="typeSelect" name="type"  class="form-control">
               
                @foreach($userTypeDesc as $key=>$value)
                <option value="{{$key}}" @if($edit) @if($key == $edit->type) selected  @endif @endif >{{$value}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div id="roomSelect" class="form-group">
            <span class="col-sm-2 col-sm-2 control-label">房间：</span>
            <div class="col-sm-4">
              <select name="room_id"  class="form-control">
                @foreach($rooms as $value)
                <option value="{{$value->
                  id}}" @if($edit) @if($value->id == $edit->room_id) selected  @endif @endif >{{$value->name}}
                </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
            <span class="col-sm-2 col-sm-2 control-label">用户昵称：</span>
            <div class="col-sm-4">
              <input  class="form-control" type="text" name="name" @if($edit) value="{{$edit->name}}" @endif ></div>
          </div>
          <div class="form-group">
            <span class="col-sm-2 col-sm-2 control-label">密码：</span>
            <div class="col-sm-4">
              <input  class="form-control" type="text" name="password"  ></div>
          </div>
          <div id="idStartAt" class="form-group">
            <span class="col-sm-2 col-sm-2 control-label">开始时间:*</span>
            <div class="col-sm-4">
              <input type="text"  name="mgr_start_at" @if($edit && $edit->
              extern) value="{{$edit->extern->mgr_start_at}}" @endif class="form-control form_time" readonly="" size="16">
            </div>
          </div>
          <div id="idEndAt"  class="form-group">
            <span class="col-sm-2 col-sm-2 control-label">结束时间:*</span>
            <div class="col-sm-4">
              <input type="text"  name="mgr_end_at" @if($edit && $edit->
              extern) value="{{$edit->extern->mgr_end_at}}" @endif class="form-control form_time" readonly="" size="16">
            </div>
          </div>
          <div class="form-group">
            <span class="col-sm-2 col-sm-2 control-label">手机号码：</span>
            <div class="col-sm-4">
              <input  class="form-control" type="text" name="phone" @if($edit) value="{{$edit->phone}}" @endif ></div>
          </div>
          <div class="form-group">
            <span class="col-sm-2 col-sm-2 control-label">QQ：</span>
            <div class="col-sm-4">
              <input  class="form-control" type="text" name="qq" @if($edit) value="{{$edit->qq}}" @endif ></div>
          </div>
          <div class="form-group">
            <span class="col-sm-2 col-sm-2 control-label">简介：</span>
            <div class="col-sm-8">
              <textarea  class="form-control"  type="text" name="description"  >@if($edit){{$edit->description}}@endif</textarea>
            </div>
          </div>
          @if($edit)
          <div class="form-group">
            <span class="col-sm-2 col-sm-2 control-label">头像：</span>
            <span>图片规格：100px * 100px , 文件大小：50k 以内(建议使用jpg或png格式，并做压缩处理)</span>
            <div class="col-sm-10">
              <div class="img-upload">
                <div id="idPicImg"></div>
                <p id="idPicImgTip" class="webuploader-tip">
                  <p>
                    <input  class="form-control" type="hidden" name="pic" id="idPicImgInput" @if($edit) value="{{$edit->
                    pic}}" @endif/>
                    <img id="idPicImgShow" @if($edit) src="{{$edit->pic}}" @endif alt="" height="100"/></p>
                </p>
              </div>
            </div>
          </div>

          <div class="form-group">
            <span class="col-sm-2 col-sm-2 control-label">是否禁言：</span>
            <div class="col-sm-4">

              <input type="checkbox" class="js-switch" name="gag" @if($edit) @if($edit->gag) checked @endif @endif /></div>
          </div>
          <div class="form-group">
            <span class="col-sm-2 col-sm-2 control-label">是否踢出：</span>
            <div class="col-sm-4">

              <input type="checkbox" class="js-switch" name="kick" @if($edit) @if($edit->kick) checked @endif @endif /></div>
          </div>

          <div class="form-group">
            <span class="col-sm-2  control-label">用户IP：</span>
            <div class="col-sm-4">
              <input  class="form-control" type="text" name="ip" @if($edit) value="{{$edit->ip}}" @endif ></div>
          </div>
          <div class="form-group">
            <span class="col-sm-2 col-sm-2 control-label">用户区域：</span>
            <div class="col-sm-4">
              <input  class="form-control" type="text" name="ip_location" @if($edit) value="{{$edit->ip_location}}" @endif ></div>
          </div>
          @endif
          <div class="control-group">
            <div class="form-group">
              <div class="controls text-center">
                <button type="submit" class="btn btn-primary">确定</button>
              </div>
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
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-timepicker/css/timepicker.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript">
 
$(function () {
    // 初始化Web Uploader
    doUpload({
      id:"idPicImg",
      intputId:"idPicImgInput",
      showId:"idPicImgShow",
      descId:"idPicImgTip",
      csrf_token:'{{ $ctrl->csrf_token() }}'
    });
     @if($edit && $edit->type == \app\Libs\ConstDefine::USERTYPE_SUPER_MGR_ID)
      $('#roomSelect').hide();
         $("#idStartAt").hide();
         $("#idEndAt").hide();
     @endif
    $('#typeSelect').change(function(){  
      var p1=$(this).children('option:selected').val();//这就是selected的值 
      if(p1 == {{App\Libs\ConstDefine::USERTYPE_SUPER_MGR_ID}}){
        $('#roomSelect').hide();
         $("#idStartAt").hide();
         $("#idEndAt").hide();
      }else{
        $('#roomSelect').show();
        $("#idStartAt").show();
        $("#idEndAt").show();
      }
    }) 
     $('.form_time').timepicker({
    minuteStep: 1,
    secondStep:1,
    showSeconds: true,
    showMeridian: false,
    defaultTime: false
});
})
</script>
@endsection
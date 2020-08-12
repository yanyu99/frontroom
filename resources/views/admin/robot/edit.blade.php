@extends('admin.layouts.base')
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
              <select name="type"  class="form-control">
                @foreach($roles as $key=>$value)
          @if($value->role_id != App\Libs\ConstDefine::USERTYPE_SUPER_MGR_ID && $value->role_id != App\Libs\ConstDefine::USERTYPE_MGR_ID)
                <option value="{{$value->
                  role_id}}" @if($edit) @if($value->role_id == $edit->type) selected  @endif @endif >{{$value->name}}
                </option>
                @endif
          @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <span class="col-sm-2 col-sm-2 control-label">昵称：</span>
            <div class="col-sm-4">
              <input  class="form-control" type="text" name="name" @if($edit) value="{{$edit->name}}" @endif ></div>
          </div>
          <div class="form-group">
            <span class="col-sm-2 col-sm-2 control-label">星期：</span>
            <div class="col-sm-8">
              <div class="input-group">
                @foreach($weekDescs as $i=>$value)
              @if($edit && count($edit->getWeeks()) > 0 && in_array($i,$edit->getWeeks()))
                  <input class="checkbox-inline"  class="form-control" type="checkbox"  name="week[]" value="{{$i}}" checked >
                  {{$value}}
              @elseif($edit)
                  <input class="checkbox-inline" class="form-control" type="checkbox"  name="week[]" value="{{$i}}" >
                  {{$value}}
              @else
                <input class="checkbox-inline" checked class="form-control" type="checkbox"  name="week[]" value="{{$i}}" >
                  {{$value}}
              @endif
              @endforeach
                </div>
              </div>
            </div>
            <div class="form-group">
              <span class="col-sm-2 col-sm-2 control-label">上线时间：</span>
              <div class="col-sm-4">
                <input  class="form-control form_time" readonly type="text" name="start_at" @if($edit) value="{{$edit->start_at}}" @endif ></div>
            </div>
            <div class="form-group">
              <span class="col-sm-2 col-sm-2 control-label">下线时间：</span>
              <div class="col-sm-4">
                <input  class="form-control form_time" readonly type="text" name="end_at" @if($edit) value="{{$edit->end_at}}" @endif ></div>
            </div>
            <!--
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
          -->
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
  $('.form_time').timepicker({
    minuteStep: 1,
    secondStep:1,
    showSeconds: true,
    showMeridian: false,
    defaultTime: false
});
</script>
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
})
</script>
@endsection
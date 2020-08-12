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
            <span class="col-sm-2 col-sm-2 control-label">用户昵称：</span>
            <div class="col-sm-4">
              <input  class="form-control" readonly="" type="text" name="name" @if($edit) value="{{$edit->name}}" @endif ></div>
          </div>
            <div class="form-group">
            <span class="col-sm-2 col-sm-2 control-label">用户角色：</span>
            <div class="col-sm-4">
              <input  class="form-control" readonly="" type="text" name="" @if($edit) value="{{$edit->role->name}}" @endif ></div>
          </div>
          
          <div class="form-group">
            <span class="col-sm-2 control-label">讲师选择:</span>
            <div class="col-sm-6">
              <div class="input-group">
                @foreach($teachers as $key=>$value)
                <label class="checkbox-inline" style="margin-left: 10px;">
                  <input  class="mycheckbox"  type="checkbox" value="{{$value->id}}" name="tids[]"  @if(isset($tidMap[$value->id])) checked @endif>
                  <span>{{$value->name}}@if(isset($tidMap[$value->id]))({{$tidMap[$value->id]}})@endif</span>
                </label>
                @endforeach
              </div>
            </div>
          </div>
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
<script type="text/javascript">
var max = '{{$edit->role->follow_num}}';
  $('.mycheckbox').click(function(){
    var num = 0;
    $('.mycheckbox').each(function(){
      if( $(this).is(':checked') ){
        num++;
      }
    })
    if(num > max){
      alert("对不起，你只能选择" + max + "个项目!");
      $(this).prop("checked",false);
    }
  })
</script>
@endsection
@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">自动开课配置</header>
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
            <span class="col-sm-2 col-sm-2 control-label">讲师：*</span>
            <div class="col-sm-4">
              <select name="tid"  class="form-control">
                @foreach($teachers as $value)
                <option value="{{$value->id}}" @if($edit) @if($value->id == $edit->tid) selected  @endif @endif >{{$value->name}}
                </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
            <span class="col-sm-2 col-sm-2 control-label">课程:*</span>
            <div class="col-sm-4">
              <input  class="form-control" type="text" name="dsc" @if($edit) value="{{$edit->dsc}}" @endif ></div>
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
        <span class="col-sm-2 col-sm-2 control-label">自动开课:*</span>
        <div class="col-sm-4">
        <select name="opend"  class="form-control">
          @foreach($flagDesc as $key=>$flag)
          <option value="{{$key}}" @if($edit && $key==$edit->opend)  selected   @endif >{{$flag}}</option>
          @endforeach
        </select>
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
@section('script')
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-timepicker/css/timepicker.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript">
  $('.form_time').timepicker({
    minuteStep: 1,
    secondStep:1,
    showSeconds: false,
    showMeridian: false,
    defaultTime: false
});
   
</script>
@endsection
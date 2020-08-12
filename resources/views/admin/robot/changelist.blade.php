@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">机器人数量列表</header>
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
        <div class="adv-table">
          <div class="clearfix" >
   
            <div style="float:right;margin-bottom:10px;" id="dynamic-table_filter">
              <form  class="form-inline" method="post" action="/admin/robots/changeedit" >
              {{ $ctrl->csrf_field() }}
              <div class="form-group">

              <div class="input-group">
                @foreach($weekDescs as $i=>$value)
              @if($edit && in_array($i,$edit->getWeeks()))
                  <input class="checkbox-inline"  class="form-control" type="checkbox"  name="week[]" value="{{$i}}" checked >
                  {{$value}}
              @else
                  <input class="checkbox-inline" class="form-control" type="checkbox"  name="week[]" value="{{$i}}"  @if(!$edit) checked @endif>
                  {{$value}}
              @endif
              @endforeach
              </div>
            </div>
                <input  class="form-control" type="hidden" name="id"  @if($edit) value="{{$edit->id}}" @endif >
                <div class="form-group">
                  <span class="control-label">开始：</span>
                    <input  class="form-control form_time" readonly type="text" name="start_at" @if($edit) value="{{$edit->start_at}}" @endif >
                </div>
                <div class="form-group">
                  <span class="control-label">结束：</span>
                    <input  class="form-control form_time" readonly type="text" name="end_at" @if($edit) value="{{$edit->end_at}}" @endif >
                </div>
                <div class="form-group">
                  <span class=" control-label">数量：</span>
                  <input  class="form-control" type="text" name="robot_num"  @if($edit) value="{{$edit->robot_num}}" @endif ></div>
                <div class="form-group">
                  <span class=" control-label"></span>
                  <button type="submit" class="btn btn-sm btn-primary">@if($edit)修改@else新增@endif</button>
                </div>
              </form>
            </div>
          </div>
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">

            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>ID</th>
                  <th>数量</th>
                  <th>开始</th>
                  <th>结束</th>
                  <th>星期</th>
                  <th>添加人</th>
                  <th>操作</th>
                  <th>创建时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  <td>{{$list->robot_num}}</td>
                  <td>{{$list->start_at}}</td>
                  <td>{{$list->end_at}}</td>
                  <td style="max-width:200px;word-wrap: break-word;"> @foreach($list->getWeeks() as $i=>$value)@if(isset($weekDescs[$value])){{$weekDescs[$value]}}@endif @endforeach</td>
                  <td>@if($list->user){{$list->user->name}}@endif</td>
                  <td>
                    <form  style='float:left;margin-right:5px;'  method="post" action="/admin/robots/changedel" >
                      {{ $ctrl->csrf_field() }}
                      <input  type="hidden" name="id" value="{{$list->id}}">
                      <button class="btn btn-sm btn-danger">删除</button>
                    </form>
                    <form  style='float:left;margin-right:5px;'  method="post" action="/admin/robots/changes" >
                      {{ $ctrl->csrf_field() }}
                      <input  type="hidden" name="id" value="{{$list->id}}">
                      <button class="btn btn-sm btn-primary">编辑</button>
                    </form>
                  </td>
                  <td>{{$list->created_at}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_info" id="dynamic-table_info">{{$lists->total()}}条记录</div>
              </div>
              <div class="span6">{!!$lists->render()!!}</div>
            </div>
          </div>
        </div>
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
    showMeridian: false,
    defaultTime: false
});
</script>
@endsection
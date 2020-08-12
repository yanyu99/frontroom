@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">用户在线</header>
      <div class="panel-body">
        <div class="adv-table">
          
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
                   <form id="idMyForm" class="form-inline" method="get" action="" >
                   @if($rooms)
                  <div class="form-group">
                       <select class="form-control" name="roomId">
                        <option value="" >全部</option>
                        @foreach($rooms as $key=>$value)
                        <option value="{{$value->id}}" @if($value->id==$ctrl->_request('roomId')) selected  @endif >{{$value->name}}
                        </option>
                        @endforeach
                      </select>
                    </div>
                   @endif
                    <div class="form-group">

                       <select class="form-control" name="tid">
                        <option value="" >全部</option>
                        @foreach($teachers as $key=>$value)
                        <option value="{{$value->id}}" @if($value->id==$ctrl->_request('tid')) selected  @endif >{{$value->name}}
                        </option>
                        @endforeach
                      </select></div>
                    <div class="form-group">
                        用户ID:
                        <input class="form-control" type="text" value="{{$ctrl->_request('uid')}}" name="uid" class="form-control" />
                      </div>
                       <div class="form-group">
                           用户昵称:
                           <input class="form-control" type="text" value="{{$ctrl->_request('name')}}" name="name" class="form-control" />
                       </div>
                       <div class="form-group">
                           推广人ID:
                           <input class="form-control" type="text" value="{{$ctrl->_request('parent_id')}}" name="parent_id" class="form-control" />
                       </div>

                      
          <div class="form-group">
              <span class="control-label">时间：</span>
                <div class="input-group">
                  <input  class="form-control form_datetime" type="text" name="s_at"  readonly value="{{$ctrl->_request('s_at')}}"  >
                  <span class="input-group-addon text-muted">-</span>
                  <input  class="form-control form_datetime" type="text" name="e_at" readonly value="{{$ctrl->_request('e_at')}}" ></div>
            </div>
          <div class="form-group">
            <div class="controls text-center">
              <button  data-action="/admin/analysis/useronline" class="muilt-submit btn btn-primary">查询</button>
              <button  data-action="/admin/analysis/useronlineexport" class="muilt-submit btn btn-primary">导出</button>
              
            </div>
          </div>
        </form>
                </div>
              </div>
            </div>
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>ID</th>
                  @if($rooms)
                   <th>房间</th>
                  @endif
                  <th>讲师</th>
                  <th>直播内容</th>
                    <th>用户</th>
                    <th>推广人</th>
                  <th>用户IP</th>
                  <th>平台</th>
                  <th>来源</th>
                  <th>逗留（分钟）</th>
                  <th>进入时间</th>
                  <th>离开时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  @if($rooms)
                   <td>@if($list->room) {{$list->room->name}} @endif</td>
                  @endif
                  <td>@if($list->tid == 0 ) 无讲师 @elseif($list->teacher){{$list->teacher->name}}@else 已删除讲师 @endif</td>
                  <td>{{$list->lesson_title}}@if($list->lesson_title)<br> {{$list->lesson_time}}@endif</td>
                    <td>@if($list->user){{$list->user->name}}@else 已删除用户 @endif <br>{{$list->uid}} </td>
                    <td>@if($list->user && $list->user->parent){{$list->user->parent_name ?: '已删除用户'}}<br>{{$list->user->parent}} @else - @endif </td>
                  <td>{{$list->ip}} @if($list->ipLocation)<br>{{$list->ipLocation->ip_location}}@endif</td>
                  <td>{{$list->from}}</td>
                   <td style="max-width: 200px;word-wrap: break-word;;">{{$list->refer}}</td>
                    <td>{{((int)($list->online_ts/60)).""}}</td>
                  <td>{{$list->enter_at}}</td>
                  <td>{{$list->leave_at}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_info" id="dynamic-table_info">{{$lists->total()}}条记录</div>
              </div>
              <div class="span6">
                {!!$lists->render()!!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection
@section('script')
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-datetimepicker/css/datetimepicker-custom.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-datepicker/css/datepicker-custom.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">


$(".form_datetime").datetimepicker({
    format: "yyyy-mm-dd hh:ii:00",
    autoclose: true,
    language:"zh-CN",
    todayBtn: true,
    minuteStep: 10,
    startView:1,
});
$(function(){
   
     $('.muilt-submit').on('click',function(){
      $('#idMyForm').attr("action",$(this).attr('data-action'));
      $('#idMyForm').submit();
    })

  });
</script>
@endsection
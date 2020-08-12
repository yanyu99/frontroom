@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
@if($all)
 <div id="main-chart">
      <div id="main-chart-day-container" class="main-chart"></div>
  </div>
  @endif
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">@if($isParent)课程峰值汇总@else课程峰值@endif</header>
      <div class="panel-body">
        <div class="adv-table">
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
                   <form id="idMyForm" class="form-inline" method="get" action="" >
                    <div class="form-group">

                       <select class="form-control" name="tid">
                        <option value="" >全部</option>
                        @foreach($teachers as $key=>$value)
                        <option value="{{$value->id}}" @if($value->id==$ctrl->_request('tid')) selected  @endif >{{$value->name}}
                        </option>
                        @endforeach
                      </select></div>
                       <div class="form-group">
                        <span class="control-label">直播内容：</span>
                        <input  class="form-control " type="text" name="title"   value="{{$ctrl->_request('title')}}"  >
                       </div>
          <div class="form-group">  
              <span class="control-label">时间：</span>
                <div class="input-group">
                  <input  class="form-control form_datetime" type="text" name="s_time"  readonly value="{{$ctrl->_request('s_time')}}"  >
                  <span class="input-group-addon text-muted">-</span>
                  <input  class="form-control form_datetime" type="text" name="e_time"  readonly value="{{$ctrl->_request('e_time')}}"  >
                  </div>
            </div>
          <div class="form-group">
            <div class="controls text-center">
              <button  data-action="/admin/analysis/tlessoncount" class="muilt-submit btn btn-primary">查询</button>
              <button  data-action="/admin/analysis/tlessoncountexport" class="muilt-submit btn btn-primary">导出</button>
            </div>
          </div>
        </form>
         @if($isParent)
         <form style="margin-top: 10px;" class="form-inline" method="get" action="/admin/analysis/tlessoncountexport1" >
          <div class="form-group">  
              <span class="control-label">时间：</span>
                <div class="input-group">
                  <input  class="form-control form_datetime" type="text" name="time"  readonly value=""  >
                  
            </div>
             <div class="form-group">  
              <select class="form-control" name="type">
                <option value="online">峰值并发</option>
                <option value="ip_count">IP数</option>
                <option value="total_time">平均听课时间</option>
              </select>
                  
            </div>
          <div class="form-group">
            <div class="controls text-center">
              <button class="btn btn-danger">高级导出</button>
            </div>
          </div>
        </form>
        @endif
                </div>
              </div>
            </div>
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>ID</th>
                  <th>日期</th>
                  <th>讲师名称</th>
                  <th>直播时间</th>
                  <th>直播内容</th>
                  <th>总浏览数</th>
                  <th>平均听课时间(分)</th>
                  <th>峰值并发</th>
                  <th>IP数</th>
                  <th>峰值时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                   <td>{{$list->ts}}</td>
                  <td>@if($list->teacher){{$list->teacher->name}}@else 已删除讲师 @endif</td>
                  <td>{{$list->lesson_time}}</td>
                  <td>{{$list->lesson_title}}</td>
                  <td>{{$list->total_user}}</td>
                  <td>@if($list->total_user){{intval( $list->total_time/$list->total_user/60 ) }}@else 0 @endif</td>
                  <td>{{$list->online}}</td>
                  <td>{{$list->ip_count}}</td>
                  <td>{{$list->online_time}}</td>
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
<script src="{{$common_cdn}}/js/highcharts/js/highcharts.js"></script>
<script src="{{$common_cdn}}/js/highcharts/js/modules/exporting.js"></script>


<script type="text/javascript">


$(".form_datetime").datetimepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
    language:"zh-CN",
    todayBtn: true,
    minuteStep: 10,
    startView:2,
    minView:2,
});
$(function(){
   
     $('.muilt-submit').on('click',function(){
      $('#idMyForm').attr("action",$(this).attr('data-action'));
      $('#idMyForm').submit();
    })
 
  });
</script>
@endsection
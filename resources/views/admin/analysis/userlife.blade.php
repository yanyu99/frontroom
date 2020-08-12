@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">用户访问</header>
      <div class="panel-body">
        <div class="adv-table">

          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
                    <form id="search-form" class="form-inline" >
                      <div class="form-group">
                        用户ID:
                        <input class="form-control" type="text" value="{{$ctrl->_request('uid')}}" name="uid" class="form-control" />
                      </div>
                      <div class="form-group">
                        用户昵称:
                        <input class="form-control" type="text" value="{{$ctrl->_request('name')}}" name="name" class="form-control" />
                      </div>
                      <div class="form-group">
                          <span class=" control-label">开始：</span>
                          <input  class="form-control form_datetime" type="text" name="c_q_start_at"  readonly value="{{$ctrl->_request("c_q_start_at")}}" >
                      </div>
                      <div class="form-group">
                          <span class=" control-label">结束：</span>
                          <input  class="form-control form_datetime" type="text" name="c_q_end_at"  readonly value="{{$ctrl->_request("c_q_end_at")}}" >
                      </div>
                      <button type="submit" class="btn btn-sm btn-primary">查询</button>
                      <div class="form-group">
                        <span class=" control-label"></span>
                        <button type="submit"  id="download-excel-btn" class="btn btn-sm btn-primary">导出excel</button>
                      </div>
                      <div class="form-group">
                        <span class=" control-label"></span>
                        <button type="submit"  id="download-sum-excel-btn" class="btn btn-sm btn-primary">汇总导出</button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>UID</th>
                  <th>名称</th>
                  <th>账号</th>
                  <th>角色</th>
                  <th>用户IP</th>
                  <th>访问来源</th>
                  <th>访问时长</th>
                  <th>访问次数</th>
                  <th>时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)

                <tr>
                  <td>{{$list->uid}}</td>
                  <td>@if($list->user){{$list->user->name}}@else 已删除 @endif</td>
                  <td>@if($list->user){{$list->user->account}}@else 已删除 @endif</td>
                  <td>@if($list->user){{$list->user->role->name}} @else 已删除 @endif</td>
                  <td>{{$list->ip}}</td>
                  <td>{{$list->from}}</td>
                  <td>{{intval($list->life_time/3600)}}小时{{intval( ($list->life_time%3600)/60 )}}分钟{{$list->life_time%60}}秒</td>
                  <td>{{$list->visit_num}}</td>
                  <td>{{$list->created_at}}</td>
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
    $('#download-excel-btn').click(function(){
        $('#search-form').append('<input type="hidden" name="excel" value="1">');
        setTimeout(function(){
            $('#search-form').submit();
            $('#search-form').find('input[name=excel]').remove();
        }, 200);
    });
    $('#download-sum-excel-btn').click(function(){
        $('#search-form').append('<input type="hidden" name="excel" value="2">');
        setTimeout(function(){
            $('#search-form').submit();
            $('#search-form').find('input[name=excel]').remove();
        }, 200);
    });

$(".form_date").datepicker({
  format: "yyyy-mm-dd",
  autoclose: true,
  language:"zh-CN",
  todayBtn: true,
  startView:1
});


$(".form_datetime").datetimepicker({
  format: "yyyy-mm-dd hh:ii:ss",
  autoclose: true,
  language:"zh-CN",
  todayBtn: true,
  minuteStep: 10,
  startView:1
});

</script>
@endsection
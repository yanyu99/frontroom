
@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">下载流水</header>
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
        
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
           <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
                  <form  class="form-inline" >

                    <div class="form-group">
                      <span class=" control-label">名称：</span>

                      <input  class="form-control" type="text" name="name" value="{{$ctrl->_request("name")}}" ></div>
                      <!--
                    <div class="form-group">
                      <span class=" control-label">开始时间：</span>

                      <input  class="form-control form_datetime " type="text" name="c_start_at" readonly  value="{{$ctrl->_request("c_start_at")}}" ></div>

                    <div class="form-group">
                      <span class=" control-label">结束时间：</span>

                      <input  class="form-control form_datetime " type="text" name="c_end_at" readonly  value="{{$ctrl->_request("c_end_at")}}" ></div>-->
                    <div class="form-group">
                      <span class=" control-label"></span>

                      <button type="submit" class="btn btn-sm btn-primary">查询</button>

                    </div>

                  </form>
                </div>
              </div>
            </div>
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>ID</th>
                  <th>用户ID</th>
                  <th>用户昵称</th>
                   <th>文件名称</th>
                  <th>下载时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  <td>{{$list->uid}}</td>
                  <td>@if($list->user){{$list->user->name}}@elseif($list->robot) {{$list->robot->name}}@else删除的用户@endif</td>
                  <td>{{$list->filename}}</td>
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
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-datetimepicker/css/datetimepicker-custom.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-datepicker/css/datepicker-custom.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">

$(".form_date").datepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
    language:"zh-CN",
    todayBtn: true,

    startView:1,
});
$(".form_datetime").datetimepicker({
    format: "yyyy-mm-dd hh:ii:ss",
    autoclose: true,
    language:"zh-CN",
    todayBtn: true,
    minuteStep: 10,
    startView:1,
});

</script>
@endsection
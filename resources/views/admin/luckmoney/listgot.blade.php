@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">收红包列表</header>
      <div class="panel-body">
        <div class="adv-table">
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
                  <form  class="form-inline" >
                    <div class="form-group">
                      <span class=" control-label">UID:</span>
                      <input  class="form-control" type="text" name="uid" value="{{$ctrl->_request("uid")}}" ></div>
                    <div class="form-group">
                      <span class=" control-label">手机号码：</span>
                      <input  class="form-control" type="text" name="phone" value="{{$ctrl->_request("phone")}}" ></div>
                    <div class="form-group">
                      <span class=" control-label">开始时间：</span>

                      <input  class="form-control form_datetime " type="text" name="c_start_at" readonly  value="{{$ctrl->_request("c_start_at")}}" ></div>

                    <div class="form-group">
                      <span class=" control-label">结束时间：</span>

                      <input  class="form-control form_datetime " type="text" name="c_end_at" readonly  value="{{$ctrl->_request("c_end_at")}}" ></div>
                    <div class="form-group">
                      <span class=" control-label"></span>

                      <button type="submit" class="btn btn-sm btn-primary">查询</button>
                      <a href="/admin/luckmoney/got" class="btn btn-sm btn-primary">清除</a>

                    </div>

                  </form>
                </div>
              </div>
            </div>
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">

                  <th>ID</th>
                  <th>红包ID</th>
                  <th>用户ID</th>
                  <th>用户</th>
                  
                  <th>手机号码</th>
                  <th>金额</th>
                  <th>是否发放</th>
                  
                  <th>创建时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  <td>{{$list->lm_id}}</td>
                  <td>{{$list->uid}}</td>
                  <td>@if($list->user){{$list->user->name}}@endif</td>
                  
                  <td>{{$list->phone}}</td>
                  <td>{{$list->money/100}}</td>
                  @if($list->is_send)
                   <td style="color:green;"> 已发放</td>
                  @else
                  <td style="color:red;"> <form  style='float:left;margin-right:5px;'  method="post" action="/admin/luckmoney/setgot" >
                      {{ $ctrl->csrf_field() }}
                      <input  type="hidden" name="id" value="{{$list->id}}">
                      <button class="btn btn-sm btn-danger">标记为发放</button>
                    </form> </td>
                  @endif
                  <td>{{$list->created_at}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_info" id="dynamic-table_info">总共 {{$lists->total()}} 条</div>
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
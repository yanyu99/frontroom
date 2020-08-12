
@extends('super.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">奖励发放</header>

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
        <form id="myForm" class="form-horizontal" method="post" action="/super/jf/jcres" >
          {{ $ctrl->csrf_field() }}
          <div class="form-group">
            <span class="col-sm-2  control-label">送积分数：</span>
            <div class="col-sm-4">
              <input  class="form-control" type="text" name="jf_num" value="10" ></div>
          </div>
          <div class="form-group">
            <span class="col-sm-2 control-label">类型：</span>
            <div class="col-sm-4">
              <select  name="res_bet"  class="form-control">
                @foreach($betTypes as $key=>$value)
                <option value="{{$key}}" >{{$value}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
                  <span class="col-sm-2 control-label">时间：</span>
                  <div class="col-sm-4">
                    <div class="input-group">
                      <input  class="form-control form_datetime" type="text" name="s_at"  readonly  value="{{date('Y-m-d 00:00')}}">
                      <span class="input-group-addon text-muted">-</span>
                      <input  class="form-control form_datetime" type="text" name="e_at" readonly value="{{date('Y-m-d H:i')}}" ></div>
                  </div>

                </div>
          <div class="form-group">
            <div class="controls text-center col-sm-6">
              <button type="submit" class="btn btn-primary">确定</button>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">奖励发放流水</header>
      <div class="panel-body">
        <div class="adv-table">
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
                  <form  class="form-inline" >
                     <div class="form-group">
                  <span class="control-label">时间：</span>
                    <div class="input-group">
                      <input  class="form-control form_datetime" type="text" name="s_at"  readonly  value="{{$ctrl->_request("s_at")}}" >
                      <span class="input-group-addon text-muted">-</span>
                      <input  class="form-control form_datetime" type="text" name="e_at" readonly value="{{$ctrl->_request("e_at")}}" ></div>
                </div>
                <div class="form-group">
                      <span class="control-label"></span>
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
                  <th>竞猜结果</th>
                  <th>奖励积分</th>
                  <th>开始时间</th>
                  <th>结束时间</th>
                  <th>创建人</th>
                  <th>获奖总人数</th>
                  <th>发放总积分</th>
                  <th>创建时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  <td>{{$betTypes[$list->res_bet]}}</td>
                  <td>{{$list->jf_num}}</td>
                  <td>{{$list->s_at}}</td>
                  <td>{{$list->e_at}}</td>
                  <td>@if($list->createUser){{$list->createUser->name}}@else 删除的用户 @endif - {{$list->c_uid}}</td>
                  <td>{{$list->win_num}}</td>
                  <td>{{$list->jf_num*$list->win_num}}</td>
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


$(".form_datetime").datetimepicker({
    format: "yyyy-mm-dd hh:ii:00",
    autoclose: true,
    language:"zh-CN",
    todayBtn: true,
    minuteStep: 10,
    startView:1,
});

</script>

@endsection
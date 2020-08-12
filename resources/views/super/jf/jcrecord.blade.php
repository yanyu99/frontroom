
@extends('super.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">汇总计算</header>
      <div class="panel-body">
        <form id="myForm" class="form-inline" method="post" action="/super/jf/jccount" >
          {{ $ctrl->csrf_field() }}
          <div class="form-group">
              <span class="control-label">时间：</span>
                <div class="input-group">
                  <input  class="form-control form_datetime" type="text" name="s_at"  readonly value="{{date('Y-m-d 00:00')}}"  >
                  <span class="input-group-addon text-muted">-</span>
                  <input  class="form-control form_datetime" type="text" name="e_at" readonly value="{{date('Y-m-d H:i')}}" ></div>
            </div>
          <div class="form-group">
            <div class="controls text-center">
              <button type="submit" class="btn btn-primary">统计</button>
            </div>
          </div>
        </form>
        <div style="color: #333;font-size: 18px;font-weight: bold;padding-left: 20px;padding-top: 10px;">
          <p>总下注积分 ：<span id="idJfTotal"></span></p>
          <p>买涨总积分 ：<span  id="idJfZhangTotal"></span></p>
          <p>买跌总积分 ：<span  id="idJfDieTotal"></span></p>
          <p>买平总积分 ：<span  id="idJfPingTotal"></span></p>

        </div>
      </div>
    </section>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">竞猜流水</header>
      <div class="panel-body">
        <div class="adv-table">
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
                  <form id="idMult" class="form-inline" >
                     <div class="form-group">
                      <span class=" control-label">用户ID：</span>
                      <input  class="form-control" type="text" name="uid" value="{{$ctrl->_request("uid")}}" ></div>
                        <div class="form-group">
                        <span class="control-label">时间：</span>
                          <div class="input-group">
                            <input  class="form-control form_datetime" type="text" name="s_at"  readonly value="{{$ctrl->_request("s_at")}}"  >
                            <span class="input-group-addon text-muted">-</span>
                            <input  class="form-control form_datetime" type="text" name="e_at" readonly value="{{$ctrl->_request("e_at")}}" ></div>
                      </div>
                      <div class="form-group">
                        <select class="form-control" name="bet_type">
                        <option value="0">全部</option>
                          @foreach($betTypes as $key=>$value )
                          <option value="{{$key}}" @if($key == $ctrl->_request("bet_type") ) selected @endif>{{$value}}</option>
                          @endforeach
                        </select>
                      </div>
                     <div class="form-group">
                      <span class="control-label"></span>
                      <button data-action="/super/jf/jcrecord" type="button" class="btn btn-sm btn-primary muilt-submit">查询</button>
                      <button data-action="/super/jf/jcrecordexport" type="button" class="btn btn-sm btn-primary muilt-submit">导出</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>ID</th>
                  <th>所属房间</th>
                  <th>下注ID</th>
                  <th>下注昵称</th>
                  <th>下注项</th>
                  <th>奖励结果</th>
                  <th>消耗积分</th>
                  <th>剩余积分</th>
                  
                  <th>描述</th>
                  <th>创建时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  <td>@if($list->room){{$list->room->name}}@else 删除的房间@endif</td>
                  <td>{{$list->uid}}</td>
                  <td>@if($list->user){{$list->user->name}}@else 删除的用户@endif</td>
                  <td>{{$betTypes[$list->bet_type]}}</td>
                   <td>@if(empty($list->resulted)) 未发放 @else {{$betTypes[$list->bet_type]}} @endif</td>
                  <td>{{$list->jf_num}}</td>
                  <td>{{$list->jf_left}}</td>

                   <td>{{$list->dsc}}</td>
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
$('#myForm').submit(function(){
              var $obj = $('#myForm');
              var url = $obj.attr('action')? $obj.attr('action') : window.location.href;
              var post = $obj.serialize()? $obj.serialize() : null;
              $.post(url,post,function (data){
                  $('#idJfTotal').html(data.jfTotal);
                  $('#idJfZhangTotal').html(data.jfZhangTotal);
                  $('#idJfDieTotal').html(data.jfDieTotal);
                  $('#idJfPingTotal').html(data.jfPingTotal);
              });
              return false;
          })
 $('.muilt-submit').on('click',function(){
      $('#idMult').attr("action",$(this).attr('data-action'));
      $('#idMult').submit();
    })
</script>

@endsection
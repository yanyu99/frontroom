
@extends('super.layouts.base')
@section('head')

@endsection
@section('content')

<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">抽奖流水</header>
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
                        <select class="form-control" name="fortuneId">
                        <option value="0">全部</option>
                          @foreach($fortuneGifts as $key=>$value )
                          <option value="{{$value->id}}" @if($value->id == $ctrl->_request("fortuneId") ) selected @endif>{{$value->title}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                      <span class="control-label">发放状态：</span>
                          <div class="input-group">
                        <select class="form-control" name="resulted">
                        <option value="0" @if($ctrl->_request("resulted") == 0) selected @endif>全部</option>
                         <option value="2" @if($ctrl->_request("resulted") == 2) selected @endif>已发放</option>
                          <option value="1" @if($ctrl->_request("resulted") == 1) selected @endif>未发放</option>
                         
                        </select>
                        </div>
                      </div>
                     <div class="form-group">
                      <span class="control-label"></span>
                      <button data-action="/super/fortune/record" type="button" class="btn btn-sm btn-primary muilt-submit">查询</button>
                      <!--<button data-action="/super/jf/jcrecordexport" type="button" class="btn btn-sm btn-primary muilt-submit">导出</button>-->
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
                  <th>抽奖ID</th>
                  <th>抽奖昵称</th>
                  <th>抽奖结果</th>
                  <th>是否发放</th>
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
                  <td>{{$list->fortuneGift ? $list->fortuneGift->title : '已删除'}}</td>
                   <td @if(empty($list->resulted)) style="color:red;" @else style="color:green;" @endif >@if(empty($list->resulted)) 
                   未发放 
                    <form  style='float:left;margin-right:5px;'  method="post" action="/super/fortune/gave">
                      {{ $ctrl->csrf_field() }}
                      <input  type="hidden" name="id" value="{{$list->
                      id}}">
                      <button class="btn btn-sm btn-danger">发放</button>
                    </form>
                   @else 
                   已发放 
                   @endif


                   </td>
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
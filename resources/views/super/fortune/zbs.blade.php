
@extends('super.layouts.base')
@section('head')

@endsection
@section('content')

<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">中奖机器人</header>
      <div class="panel-body">
        <div class="adv-table">
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
                  <form class="form-inline"  method="post" action="/super/fortune/zbadd">
                     <div class="form-group">
                      <span class=" control-label">用户ID：</span>
                      <input  class="form-control" type="text" name="uid"/> </div>
                       
                      <div class="form-group">
                        <select class="form-control" name="fg_id">
                          @foreach($fortuneGifts as $key=>$value )
                          <option value="{{$value->id}}" >{{$value->title}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                      <span class=" control-label">中奖几率：</span>
                      <input  class="form-control" type="text" name="ratio" value="50" />% </div>

                     <div class="form-group">
                      <span class="control-label"></span>
                      <button type="submit" class="btn btn-sm btn-primary muilt-submit">新增</button>
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
                  <th>昵称</th>
                  <th>抽奖结果</th>
                  <th>几率</th>
                  <th>添加人</th>
                  <th>操作</th>
                  <th>创建时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  <td>@if($list->user){{$list->user->name}} @else 删除的用户 @endif </br>({{$list->uid}})</td>
                  <td>{{$list->fortuneGift->title}}</td>
                  <td>{{$list->ratio}}%</td>
                  <td>@if($list->cUser) {{$list->cUser->name}} @else 删除的用户 @endif </br> ({{$list->c_uid}})</td>
                  <TD>  <form  style='float:left;margin-right:5px;'  method="post" action="/super/fortune/zbdel">
                      {{ $ctrl->csrf_field() }}
                      <input  type="hidden" name="id" value="{{$list->
                      id}}">
                      <button class="btn btn-sm btn-danger">删除</button>
                    </form></TD>
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
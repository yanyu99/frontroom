@extends('super.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">用户列表</header>
      <div class="panel-body">
        <div class="adv-table">
          <div class="clearfix" >
            <div style="margin-bottom:20px;" >
              <a href="/super/user/edit" class="btn btn-primary">新增</a>
              <a href="javascript:;" style="margin-left:10px;" id="idGl" class="btn btn-success dropdown-toggle">
                高级过滤 <i class="fa fa-angle-down" aria-hidden="true"></i>
              </a>
            </div>
          </div>
          <div class="panel-body" id="idGlBody" @if(!$needShow)style="display:none;"@endif>
            <div class="row">
              <form class="form-horizontal">
                <div class="col-md-6">
                  <div class="form-group">
                    <span class="col-sm-4 control-label">用户ID：</span>
                    <div class="col-sm-8">
                      <input  class="form-control" type="text" name="uid" value="{{$ctrl->_request("uid")}}" ></div>
                  </div>
                 
                  <div class="form-group">
                    <span class="col-sm-4 control-label">账户类型：</span>
                    <div class="col-sm-8">
                      <select class="form-control" name="type" >
                         
                        @foreach($userTypeDesc as $key=>$val)
                        <option value="{{$key}}" @if($key==$ctrl->_request('type')) selected @endif >{{$val}}</option>
                        @endforeach
                        <option value="-1" @if($ctrl->_request('type')==-1) selected @endif>全部</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <span class="col-sm-4 control-label">创建时间：</span>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <input  class="form-control form_datetime" readonly type="text" name="c_start_at"  value="{{$ctrl->_request("c_start_at")}}" >
                        <span class="input-group-addon text-muted">-</span>
                        <input  class="form-control form_datetime"  readonly type="text" name="c_end_at"  value="{{$ctrl->_request("c_end_at")}}" ></div>
                    </div>

                  </div>
                  <div class="form-group">
                    <span class="col-sm-4 control-label">登录时间：</span>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <input  class="form-control form_datetime" type="text" readonly name="l_start_at"  value="{{$ctrl->_request("l_start_at")}}"  >
                        <span class="input-group-addon text-muted">-</span>
                        <input  class="form-control form_datetime" type="text" readonly name="l_end_at"  value="{{$ctrl->_request("l_end_at")}}"  ></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <span class="col-sm-4 control-label">名称：</span>
                    <div class="col-sm-8">
                      <input  class="form-control" type="text" name="name" value="{{$ctrl->_request("name")}}" ></div>
                  </div>
                  <div class="form-group">
                    <span class="col-sm-4 control-label">QQ：</span>
                    <div class="col-sm-8">
                      <input  class="form-control" type="text" name="qq"  value="{{$ctrl->_request("qq")}}" ></div>
                  </div>
                  <div class="form-group">
                    <span class="col-sm-4 control-label">手机：</span>
                    <div class="col-sm-8">
                      <input  class="form-control" type="text" name="phone" value="{{$ctrl->_request("phone")}}" ></div>
                  </div>
                  <div class="form-group">
                    <span class="col-sm-4 control-label">房间：</span>
                    <div class="col-sm-8">
                     <select name="room_id"  class="form-control">
                     <option value="">无</option>
                      @foreach($rooms as $value)
                     
                      <option value="{{$value->id}}" @if($value->id == $ctrl->_request("room_id")) selected  @endif >{{$value->name}}</option>
                     
                      @endforeach
                    </select>
                    </div>
                  </div>
                
                  <div class="form-group">
                    <span class="col-sm-4 control-label"></span>
                    <div class="col-sm-8">
                      <button type="submit" class="btn btn-primary">查询</button>
                      <a href="/super/user" class="btn btn-primary">清除过滤</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>操作</th>
                  <th>用户ID</th>
                  <th>账号</th>
                  <th>昵称</th>
                  <th>手机号</th>
                  <th>QQ</th>
                  <th>管理开始时间</th>
                  <th>管理结束时间</th>
                  <th>角色</th>
                  <th>房间号</th>
                  <th>IP</th>
                  <th>添加人</th>
                  <th>注册时间</th>
                  <th>最后登录时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>
                    <div class="btn-group">
                      <button data-toggle="dropdown" class="btn btn-sm btn-success dropdown-toggle" type="button">
                        操作
                        <span class="caret"></span>
                      </button>
                      <form id="del-{{$list->uid}}" method="post" action="/super/user/del" onsubmit="return confirm('确定删除？');">
                        {{ $ctrl->csrf_field()  }}
                        <input type="hidden" name="id" value="{{$list->uid}}">
                      </form>
                      <ul role="menu" class="dropdown-menu">
                        <li>
                          <a onclick="$('#del-' + '{{$list->uid}}').submit()" >删除</a>
                        </li>

                        <li>
                          <a href="/super/user/edit?id={{$list->uid}}" >编辑</a>
                        </li>
                      </ul>

                    </div>
                  </td>
                  <td>{{$list->uid}}</td>
                  <td>{{$list->account}}</td>
                  <td>{{$list->name}}</td>
                  <td>{{$list->phone}}</td>
                  <td>{{$list->qq}}</td>
                  @if($list->extern)
                  <td>{{$list->extern->mgr_start_at}}</td>
                  <td>{{$list->extern->mgr_end_at}}</td>
                  @else
                  <td></td>
                  <td></td>
                  @endif
                  <td>{{$list->role->name}}</td>

                  <td>@if($list->room_id != 0 && $list->room){{$list->room->name}}@endif</td>
                  <td>{{$list->ip}}<br>{{$list->ip_location}}</td>
                  <td>@if($list->addUser){{$list->addUser->name}}@elseif($list->add_uid) 删除的用户 @else 无 @endif</td>
                  <td>{{$list->created_at}}</td>
                  @if(empty($list->last_login))
                  <td>-:-:-</td>
                  @else
                  <td>{{date('Y-m-d H:i',$list->last_login)}}</td>
                  @endif
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
<script type="text/javascript">

$(".form_datetime").datetimepicker({
    format: "yyyy-mm-dd hh:ii:ss",
    autoclose: true,
    language:"zh-CN",
    todayBtn: true,
    minuteStep: 10,
    startView:1,
});


  $(function(){
    $("#idGl").on('click',function(){
      $('#idGlBody').slideToggle('fast');
    })
  });



</script>
@endsection
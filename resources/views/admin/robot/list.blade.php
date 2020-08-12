@extends('admin.layouts.base')
@section('head')
    <link href="{{$common_cdn}}/js/ios-switch/switchery.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">

      <header class="panel-heading">用户列表</header>
      <div class="panel-body">
        <div class="adv-table">
          <div class="clearfix" >
            <div style="float:left;margin-bottom:10px;" >
              <a href="/admin/robots/edit" class="btn btn-primary">新增</a>

              <a href="javascript:;" style="margin-left:10px;" id="idRobot" class="btn btn-success dropdown-toggle">
                添加机器人 <i class="fa fa-angle-down" aria-hidden="true"></i>
              </a>

            </div>
            <div style="float:right;margin-bottom:10px;" id="dynamic-table_filter">
              <form  class="form-inline" >
                <div class="form-group">
                  角色：
                  <select class="form-control" name="type">
                    <option value="" >全部</option>
                    @foreach($roles as $key=>$value)
                        @if($value->role_id != App\Libs\ConstDefine::USERTYPE_SUPER_MGR_ID)
                    <option value="{{$value->
                      role_id}}" @if($value->role_id==$ctrl->_request('type')) selected  @endif >{{$value->name}}
                    </option>
                    @endif
                        @endforeach
                  </select>

                </div>
                <div class="form-group">
                  <span class=" control-label">名称：</span>

                  <input  class="form-control" type="text" name="name" value="{{$ctrl->_request("name")}}" ></div>

                <div class="form-group">
                  <span class=" control-label"></span>

                  <button type="submit" class="btn btn-sm btn-primary">查询</button>
                  <a href="/admin/robots" class="btn btn-sm btn-primary">清除</a>

                </div>

              </form>
            </div>

          </div>

          <div class="panel-body" id="idRobotBody" style="display:none;">
            <div class="row">
              <form class="form-horizontal" method="post" action="/admin/robots/batch">
                {{ $ctrl->csrf_field() }}
                <div class="col-md-12">
                  <div class="form-group">
                    <span class="col-sm-2 control-label">机器人名称：(半角逗号分隔)</span>
                    <div class="col-sm-10">
                      <textarea  class="form-control"  type="text" name="names"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <span class="col-sm-4 control-label"></span>
                    <div class="col-sm-8">
                      <button type="submit" class="btn btn-primary">创建</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <form  method="post" id="idBatch"  class="form-inline"  action="">
          {{ $ctrl->csrf_field() }}
              <input type="hidden" name="page" value="{{$ctrl->_request('page')}}">
              <div class="form-group" >
                  控制：
                  <select class="form-control" name="is_auto"  onchange="changeBatchType(this)">
                      <option {{$ctrl->_request('is_auto')==1 || !$ctrl->_has('is_auto') ? 'selected' : ''}} value="1">自动</option>
                      <option {{$ctrl->_request('is_auto')==1 || !$ctrl->_has('is_auto') ? '' : 'selected'}} value="0">手动</option>
                  </select>
              </div>
              <div class="form-group batch-auto-on">
                <div class="input-group">
                  @foreach($weekDescs as $i=>$value)
                    <input class="checkbox-inline"  class="form-control" type="checkbox"  name="week[]" value="{{$i}}"  >
                    {{$value}}
                @endforeach
                 </div>
              </div>
              <div class="form-group batch-auto-on">
                <span class="control-label">开始：</span>
                  <input  class="form-control form_time" readonly type="text" name="start_at" >
              </div>
              <div class="form-group batch-auto-on">
                <span class="control-label">结束：</span>
                  <input  class="form-control form_time" readonly type="text" name="end_at"  >
              </div>

              <div class="form-group batch-auto-off" style="display: none;margin-left: 20px;">

                  <input class="checkbox-inline"  class="form-control" type="checkbox"  name="is_active" value="1"  >
                  启用
              </div>
              <div class="form-group batch-auto-on">
                  角色：
                  <select class="form-control" name="type">
                    <option value="" >全部</option>
                    @foreach($roles as $key=>$value)
                        @if($value->role_id != App\Libs\ConstDefine::USERTYPE_SUPER_MGR_ID)
                    <option value="{{$value->role_id}}" >{{$value->name}}
                    </option>
                    @endif
                        @endforeach
                  </select>
                </div>
              <div class="form-group" style="margin-top: 10px;display: block;">
                <button data-action="/admin/robots/batchchange" type="button" class="muilt-submit btn btn-sm btn-primary">批量修改</button>
                <button data-action="/admin/robots/batchdel" class="btn btn-sm btn-danger muilt-submit ">批量删除</button>
              </div>
              <div class="form-group">
              </div>

          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th><input id="idAllCheck" type="checkbox" name="">全选</th>
                  <th>ID</th>
                  <th>名称</th>
                  <th>角色</th>
                  <th>上下线设置</th>
                  <th>星期</th>
                  <th>添加人</th>
                  <th>操作</th>
                  <th>创建时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                <td><input class="myidcheck" type="checkbox" name="ids[]" value="{{$list->uid}}"> </td>
                  <td>{{$list->uid}}</td>
                  <td>{{$list->name}}</td>
                  <td>@if($list->role){{$list->role->name}}@endif</td>
                  <td>
                      <div style="">
                        <select class="form-control" data-uid="{{$list->uid}}" onchange="changeIsAuto(this)">
                          <option {{ $list->is_auto==0 ? 'selected' : '' }} value="0">手动</option>
                          <option {{ $list->is_auto==1 ? 'selected' : '' }} value="1">自动</option>
                        </select>
                          <span id="span-time-{{$list->uid}}" style="{{ $list->is_auto==0 ? 'display: none;' : ''  }}">
                              {{$list->start_at}}-{{$list->end_at}}
                          </span>
                          <span id="span-active-{{$list->uid}}" style="{{ $list->is_auto==1 ? 'display: none;' : ''  }}">
                                <input type="checkbox" class="js-switch" data-uid="{{$list->uid}}"  onchange="changeIsActive(this)" {{ $list->is_active ? 'checked' : '' }} />
                          </span>
                      </div>
                  </td>
                  <td style="max-width:200px;word-wrap: break-word;">@foreach($list->getWeeks() as $i=>$value)@if(isset($weekDescs[$value])) {{$weekDescs[$value]}} @endif @endforeach</td>
                   <td>@if($list->user){{$list->user->name}}@endif</td>
                  <td>
                    <a class="btn btn-sm btn-danger" href="/admin/robots/del?id={{$list->uid}}">删除</a>
                    <a class="btn btn-sm btn-primary" href="/admin/robots/edit?id={{$list->uid}}">编辑</a>
                  </td>
                  <td>{{$list->created_at}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>


          </div>
          </form>
            <div class="row-fluid form-inline">
                <div class="span6">
                    <div class="dataTables_info" id="dynamic-table_info">{{$lists->total()}}条记录</div>
                </div>
                <div class="span6">{!!$lists->render()!!}</div>
            </div>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection
@section('script')
    <script src="{{$common_cdn}}/js/ios-switch/switchery.js"></script>
    <script src="{{$common_cdn}}/js/ios-switch/ios-init.js"></script>
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ $ctrl->csrf_token() }}'
            }
        });
    });

  $(function(){
    $('#idAllCheck').click(function(){
        $('.myidcheck').prop('checked',$(this).is(':checked'));
    })
    $('.myidcheck').change(function(){
        $('#idAllCheck').prop('checked',false);
    })
    $("#idGl").on('click',function(){
      $('#idRobotBody').slideUp('fast');
      $('#idGlBody').slideToggle('fast');
    })
    $("#idRobot").on('click',function(){
      $('#idGlBody').slideUp('fast');
      $('#idRobotBody').slideToggle('fast');
    })
    $('.muilt-submit').on('click',function(){
      $('#idBatch').attr("action",$(this).attr('data-action'));
      $('#idBatch').submit();
    });

    changeBatchType($('select[name=is_auto]'));
  });

  function changeBatchType(obj) {
      var is_auto = parseInt($(obj).val());
      if(is_auto===1){
          $('.batch-auto-on').show();
          $('.batch-auto-off').hide();
      } else {
          $('.batch-auto-on').hide();
          $('.batch-auto-off').show();
      }
  }
    function changeIsActive(obj) {
        var uid = $(obj).data('uid'),
            is_active = $(obj).is(":checked") ? 1 : 0;
        var data = {uid:uid, is_active:is_active};
        $.ajax({
            url: '/admin/robots/editapi',
            type: "POST",
            dataType: 'json',
            data: data,
            success: function (json) {
                if(json.code === 0){
                } else {
                    console.log('editapi', data, json);
                }
            }
        });
    }

    function changeIsAuto(obj) {
        var uid = $(obj).data('uid'),
            is_auto = parseInt($(obj).val());
        var data = {uid:uid, is_auto:is_auto};
        $.ajax({
            url: '/admin/robots/editapi',
            type: "POST",
            dataType: 'json',
            data: data,
            success: function (json) {
                if(json.code === 0){
                    if( is_auto===1 ){
                        $('#span-time-' + uid).show();
                        $('#span-active-' + uid).hide();
                    } else {
                        $('#span-time-' + uid).hide();
                        $('#span-active-' + uid).show();
                    }
                } else {
                  console.log('editapi', data, json);
                }
            }
        });
    }
</script>
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-timepicker/css/timepicker.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript">
  $('.form_time').timepicker({
    minuteStep: 1,
    secondStep:1,
    showSeconds: true,
    showMeridian: false,
    defaultTime: false
});
</script>
@endsection
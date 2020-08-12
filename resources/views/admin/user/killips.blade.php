@extends('admin.layouts.base')
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
            <div style="float:left;margin-bottom:10px;" >
              
              <a href="javascript:;" style="margin-left:10px;" id="idRobot" class="btn btn-success dropdown-toggle">
                添加IP <i class="fa fa-angle-down" aria-hidden="true"></i>
              </a>
            </div>
            <div style="float:right;margin-bottom:10px;" id="dynamic-table_filter">
              <form  class="form-inline" >
                <div class="form-group">
                  <span class=" control-label">IP：</span>
                  <input  class="form-control" type="text" name="ip" value="{{$ctrl->_request("ip")}}" ></div>
                <div class="form-group">
                  <span class=" control-label"></span>
                  <button type="submit" class="btn btn-sm btn-primary">查询</button>
                </div>

              </form>
            </div>

          </div>

          <div class="panel-body" id="idRobotBody" style="display:none;">
            <div class="row">
              <form class="form-horizontal" method="post" action="/admin/user/ipbatch">
                {{ $ctrl->csrf_field() }}
                <div class="col-md-12">
                  <div class="form-group">
                    <span class="col-sm-2 control-label">IP：(半角逗号分隔)</span>
                    <div class="col-sm-10">
                      <textarea  class="form-control"  type="text" name="ips"></textarea>
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
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">

            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>ID</th>
                  <th>IP</th>
                  <th>添加人</th>
                  <th>操作</th>
                  <th>创建时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  <td>{{$list->ip}}</td>
                   <td>@if($list->user){{$list->user->name}}@endif</td>
                  <td>
                    <form  style='float:left;margin-right:5px;'  method="post" action="/admin/user/delip" >
                      {{ $ctrl->csrf_field() }}
                      <input  type="hidden" name="id" value="{{$list->id}}">
                      <button class="btn btn-sm btn-danger">删除</button>
                    </form>
                    
                  </td>
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

<script type="text/javascript">
  $(function(){
    $("#idGl").on('click',function(){
      $('#idRobotBody').slideUp('fast');
      $('#idGlBody').slideToggle('fast');
    })
    $("#idRobot").on('click',function(){
      $('#idGlBody').slideUp('fast');
      $('#idRobotBody').slideToggle('fast');
    })
  })
</script>
@endsection
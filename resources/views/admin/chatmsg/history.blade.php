@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">消息列表</header>
      <div class="panel-body">
        <div class="adv-table">
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
                  <form  class="form-inline" >

                    <div class="form-group">
                      <span class=" control-label">发送昵称：</span>
                      <input  class="form-control" type="text" name="s_name" value="{{$ctrl->_request("s_name")}}" >
                      </div>
                       <div class="form-group">
                      <span class=" control-label">审核昵称：</span>
                      <input  class="form-control" type="text" name="a_name" value="{{$ctrl->_request("a_name")}}" >
                      </div>
                      <div class="form-group">
                      <span class=" control-label">消息内容：</span>
                      <input  class="form-control" type="text" name="message" value="{{$ctrl->_request("message")}}" >
                      </div>
                      <button type="submit" class="btn btn-sm btn-primary">查询</button>
                      <a href="/admin/chatmsg/history" class="btn btn-sm btn-primary">清除</a>

                    </div>

                  </form>
                </div>
              </div>
            </div>
            <form  method="post" id="idBatch"  class="form-inline"  action="/admin/chatmsg/del">
          {{ $ctrl->csrf_field() }}
              <div class="form-group" style="    display: block;">
                <button data-action="/admin/chatmsg/batchdel" class="btn btn-sm btn-danger muilt-submit ">批量删除</button>
              </div>
                <div class="form-group">
              </div>
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                <th><input id="idAllCheck" type="checkbox" name="">全选</th>
                  <th>ID</th>
                  <th>昵称</th>
                  <th>角色</th>
                  <th>内容</th>
                  <th>是否需要审核</th>
                  <th>审核用户</th>
                  <th>操作</th>
                  <th>审核时间</th>
                  <th>创建时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                   <td><input class="myidcheck" type="checkbox" name="ids[]" value="{{$list->id}}"> </td>
                  <td>{{$list->id}}</td>
                  <td>{{$list->name}}({{$list->uid}})</td>
                  <td>{{$list->role->name}}</td>
                  <td style="max-width:200px;    word-wrap: break-word;">{{$list->message}}</td>
                   <td>{{$list->origin_audit?"否":"是"}}</td>
                  @if($list->auditUser)
                  <td>{{$list->auditUser->name}}</td>
                  @else
                  <td>UID:{{$list->audit_uid}}</td>
                  @endif
                  <td>
                    <form class="pull-left"  style='float:left;margin-right:5px;' method="post" action="/admin/chatmsg/del" >
                      <input type="hidden" name="id" value="{{$list->id}}">
                      <button data-action="/admin/chatmsg/del" class="btn btn-sm btn-danger muilt-submit">删除</button>
                    </form>
                  </td>
                  <td>{{$list->updated_at}}</td>
                  <td>{{$list->created_at}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
             </form>
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
<script type="text/javascript">
  $(function(){
    $('#idAllCheck').click(function(){
        $('.myidcheck').prop('checked',$(this).is(':checked'));
    })
    $('.myidcheck').change(function(){
        $('#idAllCheck').prop('checked',false);
    })
     $('.muilt-submit').on('click',function(){
      $('#idBatch').attr("action",$(this).attr('data-action'));
      $('#idBatch').submit();
    })

  });
  </script>
@endsection
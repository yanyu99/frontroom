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
                @if(isset($fields))
                <div class="dataTables_filter" id="dynamic-table_filter">
                    <form  class="form-inline" >
                      <div class="form-group">
                        类型：
                        <select class="form-control" name="field">
                          @foreach($fields as $key=>$val)
                          <option value="{{$key}}" @if($key==$ctrl->_request('field')) selected @endif >{{$val}}</option>
                          @endforeach
                        </select>
                        <input class="form-control" type="text" value="{{$ctrl->_request('val')}}" name="val" class="form-control" />
                      </div>
                      <button type="submit" class="btn btn-primary">查询</button>
                    </form>
                </div>
                @endif
              </div>
            </div>
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">

                  <th>ID</th>
                  <th>昵称</th>
                  <th>角色</th>
                  <th>内容</th>
                  <th>操作</th>
                  <th>创建时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  <td>{{$list->name}}</td>
                  <td>{{$list->role->name}}</td>
                  <td style="max-width:200px;    word-wrap: break-word;">{{$list->message}}</td>
                 
                  <td>
                    <form class="pull-left"  style='float:left;margin-right:5px;' method="post" action="/admin/chatmsg/pass">
                      <input type="hidden" name="id" value="{{$list->id}}">
                        {{ $ctrl->csrf_field() }}
                      <button id="stateBtn" class="btn btn-sm btn-primary">审核</button>
                    </form>
                    <form class="pull-left"  style='float:left;margin-right:5px;' method="post" action="/admin/chatmsg/del" >
                      <input type="hidden" name="id" value="{{$list->id}}">
                        {{ $ctrl->csrf_field() }}
                      <button id="stateBtn" class="btn btn-sm btn-danger">删除</button>
                    </form>
                  </td>
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

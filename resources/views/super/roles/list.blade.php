@extends('super.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">角色管理</header>
      <div class="panel-body">
        <div class="adv-table">
        <div class="clearfix" >
            <div class="btn-group" style='margin-bottom:10px;'>
              <a href="/super/roles/edit" class="btn btn-primary">新增</a>
            </div>
          </div>
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
                  <th>编号</th>
                  <th>角色ID</th>
                  <th>角色名称</th>
                  <th>角色描述</th>
                  <th>角色图标</th>
                  <th>图标宽度</th>
                  <th>发言间隔</th>
                  <th>创建时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  <td>{{$list->role_id}}</td>
                  <td>{{$list->name}}</td>
                  <td>{{$list->desc}}</td>
                  <td><img src="{{$list->imgurl}}" height="40px"></td>
                  <td>{{$list->imgwidth}}</td>
                  <td>{{$list->chat_ts}}</td>
                  <td>{{$list->created_at}}</td>
                  <td>
                     <a class="btn btn-sm btn-primary" href="/super/roles/edit?id={{$list->id}}">编辑</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
           
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection

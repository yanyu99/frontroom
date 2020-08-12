

@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">房间列表</header>
      <div class="panel-body">
        <div class="adv-table">
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
              <div class="span6">
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
              </div>
            </div>
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>房间ID</th>
                  <th>用户ID</th>
                  <th>用户昵称</th>
                  <th>来源</th>
                  <th>登录时间</th>
                  <th>登出时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                 @foreach($lists as $list)
                  <tr>
                    <td>{{$list->room_id}}</td>
                    <td>{{$list->uid}}</td>
                    <td>{{$list->user->name}}</td>
                    <td>{{$list->from}}</td>
                    <td>{{$list->created_at}}</td>
                    <td>@if($list->leaved){{date('Y-m-d H:i:s',$list->leave_at)}}@endif</td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_info" id="dynamic-table_info">Showing 1 to 10 of 57 entries</div>
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
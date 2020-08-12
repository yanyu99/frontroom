
@extends('super.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">日志流水</header>
      <div class="panel-body">
        <div class="adv-table">
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
                  <form  class="form-inline" >
                  <div class="form-group">
                  UID:
                  <input type="text" name="uid" class="form-control">
                  </div>
                    <div class="form-group">
                      类型：
                      <select class="form-control" name="type">
                        <option value="" >全部</option>
                        @foreach($log_descs as $key=>$val)
                        <option value="{{$key}}" @if($key==$ctrl->_request('type')) selected @endif >{{$val}}</option>
                        @endforeach
                      </select>
                      
                    </div>
                    <button type="submit" class="btn btn-primary">查询</button>
                  </form>
                </div>
              </div>
            </div>
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>ID</th>
                  <th>操作人</th>
                  <th>类型</th>
                  <th>描述</th>
                  <th>操作时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  <td>@if($list->opUser){{$list->opUser->name}}@else 删除的用户UID({{$list->op_uid}}) @endif</td>
                  <td>{{$log_descs[$list->type]}}</td>
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
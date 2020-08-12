
@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">内参列表</header>
      <div class="panel-body">
        <div class="adv-table">
          <div class="clearfix" >
            <div class="btn-group" style='margin-bottom:10px;'>
              <a href="/admin/modnc/edit" class="btn btn-primary">新增</a>
            </div>
          </div>
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            @if(isset($fields))
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
            @endif
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>ID</th>
                  <th>内容</th>
                  <th>时间</th>
                  <th>分析师</th>
                   <th>操作</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $modnc)
                <tr>
                    <td>{{$modnc->id}}</td>
                  <td>{!!$modnc->text!!}</td>
                  <td>{!!$modnc->ts!!}</td>
                  @if($modnc->teacher)
                  <td>{{$modnc->teacher->name}}</td>
                  @else
                  <td>已删除的用户</td>
                  @endif
                  <td>
                    <a style='float:left;margin-right:5px;' class="btn btn-sm btn-primary" href="/admin/modnc/edit?id={{$modnc->id}}">编辑</a>
                    <form  style='float:left;margin-right:5px;'  method="post" action="/admin/modnc/del" onsubmit="return confirm('确定删除？');">
                      {{ $ctrl->csrf_field() }}
                      <input  type="hidden" name="id" value="{{$modnc->
                      id}}">
                      <button class="btn btn-sm btn-danger">删除</button>
                    </form>
                  </td>

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
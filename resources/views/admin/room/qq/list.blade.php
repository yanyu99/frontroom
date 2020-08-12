
@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">客服QQ列表</header>
      <div class="panel-body">
        @if($ctrl->errors_has('error'))
          <div class="form-group">
            <div>
              <div id="js-validate-alert" class="alert alert-danger alert-validate" style="margin-bottom: 0px;">
                <span class="text">{{$ctrl->errors_first('error', ':message')}}</span>
              </div>
            </div>
          </div>
        @endif

        <div class="adv-table">
          <div class="clearfix" >
            <div class="btn-group" style='margin-bottom:10px;'>
              <a href="/admin/qq/edit" class="btn btn-primary">新增</a>
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
                  <th>位置</th>
                  <th>类型</th>
                  <th>名称</th>
                  <th>QQ</th>
                  <th>开始时间</th>
                  <th>结束时间</th>
                  <th>排序值</th>
                  <th>操作</th>
                  <th>创建时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  <td >@if(isset($types[$list->type])){{$types[$list->type]['name']}}@endif</td>
                  <td >@if(isset($qqorwx[$list->which])){{$qqorwx[$list->which]}}@endif</td>
                  <td>{{$list->name}}</td>
                  <td >{{$list->qq}}</td>
                  <td >{{$list->start_at}}</td>
                  <td >{{$list->end_at}}</td>
                  <td >{{$list->sort}}</td>
                  <td>
                    <form  style='float:left;margin-right:5px;'  method="post" action="/admin/qq/del" onsubmit="return confirm('确定删除？');">
                      {{ $ctrl->csrf_field() }}
                      <input  type="hidden" name="id" value="{{$list->
                      id}}">
                      <button class="btn btn-sm btn-danger">删除</button>
                    </form>
                    <a class="btn btn-primary btn-sm" href="/admin/qq/edit?id={{$list->id}}">编辑</a>
                  </td>
                  <td>{{$list->created_at}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <!--<div class="row-fluid">
            <div class="span6">
              <div class="dataTables_info" id="dynamic-table_info">Showing 1 to 10 of 57 entries</div>
            </div>
            <div class="span6">
              <div class="dataTables_paginate paging_bootstrap pagination">
                <ul>
                  <li class="prev disabled">
                    <a href="#">← Previous</a>
                  </li>
                  <li class="active">
                    <a href="#">1</a>
                  </li>
                  <li>
                    <a href="#">2</a>
                  </li>
                  <li>
                    <a href="#">3</a>
                  </li>
                  <li>
                    <a href="#">4</a>
                  </li>
                  <li>
                    <a href="#">5</a>
                  </li>
                  <li class="next">
                    <a href="#">Next →</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          -->
        </div>
      </div>
    </div>
  </section>
</div>
</div>
@endsection
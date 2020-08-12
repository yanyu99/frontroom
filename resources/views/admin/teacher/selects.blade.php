
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
          <div class="clearfix" >

          <a href="/admin/teacher/select"  style='margin-bottom:10px;' class="btn btn-primary">新增</a>
          </div>
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
         
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>ID</th>
                  <th>名称</th>
                  <th>描述</th>
                  <th>开始时间</th>
                  <th>结束时间</th>
                  <th>自动开课</th>
                  <th>操作</th>
                  <th>创建时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  <td>@if($list->teacher){{$list->teacher->name}}@else 删除的讲师 @endif</td>
                  <td>{{$list->dsc}}</td>
                  <td>{{$list->start_at}}</td>
                  <td>{{$list->end_at}}</td>
                  <td>@if($list->opend)开启@else关闭@endif</td>
                  <td>
                    <form class="pull-left" method="post" style='float:left;margin-right:5px;' action="/admin/teacher/selectdel" >
                    {{ $ctrl->csrf_field() }}
                      <input type="hidden" name="id" value="{{$list->id}}">
                      <button id="stateBtn" class="btn btn-sm btn-success">删除</button>
                    </form>
                    <a class="btn btn-sm  btn-danger" href="/admin/teacher/select?id={{$list->id}}">编辑</a>
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
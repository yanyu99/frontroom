
@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">投票流水</header>
      <div class="panel-body">
        <div class="adv-table">
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
                  <form id="idMyForm" class="form-inline" method="get" action="" >
                    <div class="form-group">

                       <select class="form-control" name="tid">
                        <option value="" >全部</option>
                        @foreach($teachers  as $key=>$value)
                        <option value="{{$value->id}}" @if($value->id==$ctrl->_request('tid')) selected  @endif >{{$value->name}}
                        </option>
                        @endforeach
                      </select></div>

       
          <div class="form-group">
            <div class="controls text-center">
            
              <button type="submit" class="muilt-submit btn btn-primary">查询</button>
             
            </div>
          </div>
        </form>
                </div>
              </div>
            </div>
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>ID</th>
                  <th>房间号</th>
                  <th>用户ID</th>
                  <th>用户昵称</th>
                  <th>讲师</th>
                  <th>操作时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  <td>@if($list->room) {{$list->room->name}} @endif</td>
                  <td>{{$list->uid}}</td>
                  <td>@if($list->user){{$list->user->name}}@else 删除的用户@endif</td>
                  <td>@if($list->teacher){{$list->teacher->name}}@else 删除的讲师@endif</td>
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
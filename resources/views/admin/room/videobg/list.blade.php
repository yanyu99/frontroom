
@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">视频背景</header>
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
            <a href="/admin/room/videobg" class="btn btn-primary">新增</a>
          </div>
        </div>
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>ID</th>
                  <th>图片</th>
                  <th>开始时间</th>
                  <th>结束时间</th>
                  <th>操作</th>
                  <th>创建时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  <td><img src="{{$list->imgurl}}" height="30"></td>
                  <td>{{$list->s_at}}</td>
                  <td>{{$list->e_at}}</td>
                  <td>
                    <form class="pull-left" method="post" style='float:left;margin-right:5px;' action="/admin/room/videobgdel" >
                    {{ $ctrl->csrf_field() }}
                      <input type="hidden" name="id" value="{{$list->id}}">
                      <button id="stateBtn" class="btn btn-sm btn-danger">删除</button>
                    </form>
                    <a href="/admin/room/videobg?id={{$list->id}}" class="btn btn-sm btn-primary">编辑</a>
                  </td>
                  <td>{{$list->created_at}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
      </div>
    </section>
  </div>
</div>
@endsection

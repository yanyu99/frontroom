
@extends('admin.layouts.base')
@section('head')
  <link href="{{$common_cdn}}/js/ios-switch/switchery.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">讲师列表</header>
      <div class="panel-body">
        <div class="adv-table">
          <div class="clearfix" >
            <div class="btn-group" style='margin-bottom:10px;'>
              <a href="/admin/teacher/edit" class="btn btn-primary">新增</a>
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
                  <th>信息</th>
                  <th>图片</th>
                  <th>描述</th>
                  <th>排序值</th>
                  @if($agree_opend)
                    <th>点赞</th>
                  @endif
                   @if($site->hot_opend)
                      <th>投票数</th>
                      <th>开启投票</th>
                   @endif
                  <th>是否展示</th>
                  <th>操作</th>
                  <th>创建时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>
                    <p>ID：{{$list->id}}</p>
                    <p>名称：{{$list->name}}</p>
                    <p>别名：{{$list->j_name}}</p>
                  </td>
                 
                  <td><img height="45" width="45" src="{{$list->imgurl}}"></td>
                  <td style="max-width:200px;    word-wrap: break-word;">
                      <div style="max-height: 250px;overflow-y: auto">
                          {!!$list->introduction!!}
                      </div>
                  </td>
                  <td >{{$list->sort}}</td>
                  @if($agree_opend)
                    <td style="min-width: 145px;" >
                      <p>进度条底数：{{$list->base}}</p>
                      <p>今日基数：{{$list->today_base}}</p>
                      <p>累计基数：{{$list->total_base}}</p>
                      <p>今日点赞数：{{$list->today}}</p>
                      <p>累计点赞数：{{$list->total}}</p>
                    </td>
                  @endif
                  @if($site->hot_opend)
                    <td>
                      <p>投票数：{{$list->hot_got}}</p>
                      <p>投票基数：{{$list->hot_base}}</p>
                    </td>
                    <td><input type="checkbox" class="js-switch" data-tid="{{$list->id}}"  onchange="changeIsVote(this)" {{ $list->is_vote ? 'checked' : '' }} /></td>
                   @endif
                  <td>@if($list->show)开启@else关闭@endif</td>
                  <td>
                   <form class="pull-left" method="post" style='float:left;margin-right:5px;' action="/admin/teacher/fire" onsubmit="return confirm('确认@if($list->fired == 0) 淘汰 @else 取消淘汰 @endif？');">
                    {{ $ctrl->csrf_field() }}
                      <input type="hidden" name="id" value="{{$list->
                      id}}">
                      <input type="hidden" id="fired" name='fired' value="@if($list->
                      fired == 0) 1 @else 0 @endif">
                      <button id="stateBtn" class="btn btn-sm btn-danger">@if($list->fired == 0) 淘汰 @else 取消淘汰 @endif</button>
                    </form>
                    <form  style='float:left;margin-right:5px;'  method="post" action="/admin/teacher/del" onsubmit="return confirm('确定删除？');">
                      {{ $ctrl->csrf_field() }}
                      <input  type="hidden" name="id" value="{{$list->
                      id}}">
                      <button class="btn btn-sm btn-danger">删除</button>
                    </form>
                    <a class="btn btn-sm btn-primary" href="/admin/teacher/edit?id={{$list->id}}">编辑</a>
                  </td>
                  <td>{{$list->created_at}}</td>
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

@section('script')
  <script src="{{$common_cdn}}/js/ios-switch/switchery.js"></script>
  <script src="{{$common_cdn}}/js/ios-switch/ios-init.js"></script>
  <script type="text/javascript">
      $(function () {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': '{{ $ctrl->csrf_token() }}'
              }
          });
      });

      function changeIsVote(obj) {
          var id = $(obj).data('tid'),
              is_vote = $(obj).is(":checked") ? 1 : 0;
          var data = {id:id, is_vote:is_vote};
          $.ajax({
              url: '/admin/teacher/isvote',
              type: "POST",
              dataType: 'json',
              data: data,
              success: function (json) {
                  if(json.code === 0){
                  } else {
                      console.log('isvote', data, json);
                  }
              }
          });
      }
  </script>
@endsection
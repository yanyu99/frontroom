
@extends('super.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading"> @if($parent)子房间列表@else 主房间列表 @endif</header>
      <div class="panel-body">
        <div class="adv-table">
        @if($parent)
        <div class="clearfix" >
        <a href="/super/rooms" class="btn btn-primary">返回主房间列表</a>
        </div>
        @endif
       
          <div class="clearfix" >
@if($ctrl->errors_has('room'))
        <div class="form-group">
          <div>
            <div id="js-validate-alert" class="alert alert-danger alert-validate" style="margin-bottom: 0px;">
              <span class="text">{{$ctrl->errors_first('room', ':message')}}</span>
            </div>
          </div>
        </div>
        @endif
         @if($can_create)
        <form class="form-inline" method="post" action="/super/rooms/create">
          {{ $ctrl->csrf_field() }}
            <div class="form-group">
              <span class=" control-label"></span>
                <input  class="form-control" placeholder="房间名称" type="text" name="name" >
            </div>
            <div class="form-group">
              <span class=" control-label"></span>
                <input  class="form-control" placeholder="房间别名" type="text" name="f_name" >
            </div>
            @if($parentMaxNum > $curParentNum)
            <div class="form-group">
              <span class=" control-label"></span>
              <label class="checkbox-inline" style="margin-left: 10px;">
                    <input   type="checkbox" name="istest">
                    <span>试音间</span>
                  </label>
            </div>
            @else
            <input  class="form-control"  type="hidden" name="istest" value="1" >
            @endif
            <div class="form-group">
                <button type="submit" class="btn btn-primary">@if($parentMaxNum <= $curParentNum) 新增试音间 @else 新增主房间 @endif</button>
            </div>
        </form>
        @endif
          </div>
        

          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
                  <form  class="form-inline" >
                    <div class="form-group">
                      房间：
                      @if($parent)
                      <input type="hidden" name="mainRoomId" value="{{$parent}}">
                      @endif
                      <input class="form-control" type="text" value="{{$ctrl->_request('name')}}" name="name"/>
                    </div>
                    <button type="submit" class="btn btn-success">查询</button>
                  </form>
                </div>
              </div>
            </div>
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>房间ID</th>
                  <th>房间名称</th>
                  <th>别名</th>
                  <th>房间标题</th>
                  <th>房间LOGO</th>
                  <th>人数</th>
                  <th>状态</th>
                  <th>操作</th>
                   <th>创建人</th>
                  <th>创建时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  <td>{{$list->name}}@if($list->parent == 0 && $list->istest)<br><span style="color: red;">试音间</span>@endif</td>
                  <td>{{$list->f_name}}</td>
                  <td>{{$list->title}}</td>
                  <td><img src="{{$list->logo}}" height="30"></td>
                  <td>{{$list->online_num}}</td>
                  <td id='stateShow'>{{$flag[$list->flag]}}</td>
                  <td>
                    <form class="pull-left" method="post" style='float:left;margin-right:5px;' action="/super/rooms/freeze" onsubmit="return confirm('确认@if($list->flag == 0) 解冻 @else 冻结 @endif？');">
                    {{ $ctrl->csrf_field() }}
                      <input type="hidden" name="id" value="{{$list->
                      id}}">
                      <input type="hidden" id="flag" name='flag' value="@if($list->
                      flag == 0) 1 @else 0 @endif">
                      <button id="stateBtn" class="btn btn-sm btn-danger">@if($list->flag == 0) 解冻 @else 冻结 @endif</button>
                    </form>
                    @if(!empty( $list->parent) && (in_array($list->id, $roomids) || in_array("all", $roomids)) )
                    <form class="pull-left" method="post" style='float:left;margin-right:5px;' action="/super/rooms/alonevideo" onsubmit="return confirm('确认@if($list->alone_video == 0) 开启独立视频 @else 关闭独立视频 @endif？');">
                    {{ $ctrl->csrf_field() }}
                      <input type="hidden" name="id" value="{{$list->
                      id}}">
                      <input type="hidden" id="alone_video" name='alone_video' value="@if($list->
                      alone_video == 0) 1 @else 0 @endif">
                      <button id="stateBtn" class="btn btn-sm btn-danger">@if($list->alone_video == 0) 开启独立视频 @else 关闭独立视频 @endif</button>
                    </form>
                    @endif
                    <form class="pull-left" method="post" style='float:left;margin-right:5px;' action="/admin/changeroom" >
                    {{ $ctrl->csrf_field() }}
                      <input type="hidden" name="room_id" value="{{$list->id}}">
                      <input type="hidden"  name='to' value="/admin/room">
                      <button id="stateBtn" class="btn btn-sm btn-success">管理</button>
                    </form>
                     @if(empty( $list->parent)  && empty($list->istest))
                    <a  class="btn btn-sm btn-primary pull-left" href="/super/rooms?mainRoomId={{$list->id}}">查看子房间</a>
                    @endif
                    <form class="pull-left" method="post" style='float:left;margin-right:5px;' action="/super/rooms/changefname" >
                    {{ $ctrl->csrf_field() }}
                      <input type="hidden" name="room_id" value="{{$list->id}}">
                      <input type="text" class="form-control" name="f_name"  placeholder="房间别名" value="" required="">
                      <button id="stateBtn" class="btn btn-sm btn-success">修改</button>
                    </form>
                    @if(!empty( $list->parent) )
                    <form class="pull-left" method="post" style='float:left;margin-right:5px;' action="/super/rooms/noturn" onsubmit="return confirm('确认@if($list->no_turn_parent == 0) 关闭转发 @else 开启转发 @endif？');">
                    {{ $ctrl->csrf_field() }}
                      <input type="hidden" name="room_id" value="{{$list->
                      id}}">
                      <input type="hidden" id="no_turn_parent" name='no_turn_parent' value="@if($list->
                      no_turn_parent == 0) 1 @else 0 @endif">
                      <button id="stateBtn" class="btn btn-sm @if($list->no_turn_parent == 0) btn-danger @else btn-success @endif">@if($list->no_turn_parent == 0) 关闭转发 @else 开启转发 @endif</button>
                    </form>
                    @endif
                    @if(empty( $list->parent) && $can_create && empty($list->istest))
                     <form class="pull-left" method="post" style='float:left;margin-right:5px;' action="/super/rooms/create" >
                    {{ $ctrl->csrf_field() }}
                      <input type="hidden" name="room_id" value="{{$list->id}}">
                      <input type="text" class="form-control" name="name"  placeholder="子房间名" value="" required="">
                        <input type="text" class="form-control" name="f_name"  placeholder="子房间别名" value="" required="">
                      <button id="stateBtn" class="btn btn-sm btn-success">创建子房间</button>
                    </form>
                    @endif
                    <form class="pull-left" method="post" style='float:left;margin-right:5px;' action="/super/rooms/clearuser" >
                    {{ $ctrl->csrf_field() }}
                      <input type="hidden" name="room_id" value="{{$list->id}}">
                      <button id="stateBtn" class="btn btn-sm btn-success">清空人数</button>
                    </form>
                    <!--<a class="btn btn-primary" href="/super/rooms/edit?id={{$list->id}}">查看</a>-->
                  </td>
                  <td>@if($list->createdUser){{$list->createdUser->name}}@endif</td>
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
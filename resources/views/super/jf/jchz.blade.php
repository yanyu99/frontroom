
@extends('super.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">竞猜汇总</header>
      <div class="panel-body">
        <div class="adv-table">
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
                  <form  class="form-inline" id="search_form">
                     <div class="form-group">
                      <span class=" control-label">名称：</span>
                      <input  class="form-control" type="text" name="name" value="{{$ctrl->_request("name")}}" ></div>
                       <div class="form-group">
                    <span class="control-label">房间：</span>
                     <select name="room_id"  class="form-control">
                     <option value="">无</option>
                      @foreach($rooms as $value)
                      <option value="{{$value->id}}" @if($value->id == $ctrl->_request("room_id")) selected  @endif >{{$value->name}}</option>
                      @endforeach
                    </select>
                  </div>
                     <div class="form-group">
                      <span class="control-label"></span>
                      <button type="submit" class="btn btn-sm btn-primary">查询</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <form  method="post" id="idBatch"  class="form-inline"  action="/super/jf/batchop">
          {{ $ctrl->csrf_field() }}
          <div class="form-group" style="    display: block;">
              <input  class="form-control" type="text" name="num" value="" >
                <button class="btn btn-sm btn-danger muilt-submit ">批量操作积分</button>
              </div>
                <div class="form-group">
              </div>
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                <th><input id="idAllCheck" type="checkbox" name="">全选</th>
                  <th class="sorting uid" >用户ID</th>
                  <th class=" user-name" >用户昵称</th>
                  <th class=" user-room-name">所属房间</th>
                  <th class="sorting jc_num">总竞猜次数</th>
                  <th class="sorting jc_win_num">获胜次数</th>
                  <th class=" jc_win_num-div-jc_num">获胜概率</th>
                  <th class="sorting jf_win">赢得总积分</th>
                  <th class="sorting jf_cur">剩余总积分</th>
                </tr>
                @include('widget.sort-table-th', [
                    'search_form' => 'search_form',
                    'allow_sort_field'=> $allow_sort_field,
                    'page'=>$lists->currentPage(),
                    'sort_option'=> $sort_option,
                ])
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                   <tr>
                       <td><input class="myidcheck" type="checkbox" name="ids[]" value="{{$list->uid}}"> </td>
                       <td>{{$list->uid}}</td>
                       <td>{{ $list->user ? $list->user->name : '已删除'}}</td>
                       <td>{{ $list->user && $list->user->room ? $list->user->room->name : '无房间'  }}</td>
                       <td>{{$list->jc_num}}</td>
                       <td>{{$list->jc_win_num}}</td>
                       <td>@if(empty($list->jc_num)) 0% @else{{$list->jc_win_num*100/$list->jc_num}}% @endif</td>
                       <td>{{$list->jf_win}}</td>
                       <td>{{$list->jf_cur}}</td>
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
@section('script')
<script type="text/javascript" src="/assets/js/base-polyfill.js"></script>
<script type="text/javascript">
  $(function(){
    $('#idAllCheck').click(function(){
        $('.myidcheck').prop('checked',$(this).is(':checked'));
    })
    $('.myidcheck').change(function(){
        $('#idAllCheck').prop('checked',false);
    })


  });
  </script>
@endsection
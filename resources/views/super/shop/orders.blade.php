
@extends('super.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">订单列表</header>
      <div class="panel-body">
        <div class="adv-table">

          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
                  <form  class="form-inline" >
                  <div class="form-group">
                      
                       订单Id:
                        <input class="form-control" type="text" value="{{$ctrl->_request('id')}}" name="id" class="form-control" />
                    </div>
                    <div class="form-group">
                      
                       房间号:
                        <input class="form-control" type="text" value="{{$ctrl->_request('roomName')}}" name="roomName" class="form-control" />
                    </div>
                   <div class="form-group">
                      
                       用户ID:
                        <input class="form-control" type="text" value="{{$ctrl->_request('uid')}}" name="uid" class="form-control" />
                    </div>
                    <div class="form-group">
                        用户昵称:
                        <input class="form-control" type="text" value="{{$ctrl->_request('name')}}" name="name" class="form-control" />
                      </div>
                    <button type="submit" class="btn btn-primary">查询</button>
                  </form>
                </div>
              </div>
            </div>
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>订单ID</th>
                  <th>货品名称</th>
                  <th>兑换数量</th>
                  <th>兑换积分</th>
                  <th>兑换人</th>
                  <th>所属房间</th>
                  <th>地址</th>
                  <th>姓名</th>
                  <th>电话</th>
                  <th>订单状态</th>
                  <th>备注</th>
                   <th>操作</th>
                  <th>创建日期</th>
                 
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  <td>@if($list->commodity){{$list->commodity->name}}@else 删除的商品 @endif</td>
                  <td>{{$list->num}}</td>
                  <td>{{$list->jf_num}}</td>
                  <td>@if($list->user){{$list->user->name}}（{{$list->uid}}）@else 删除的用户UID:{{$list->uid}} @endif </td>
                  <td>@if($list->room){{$list->room->name}}@else 无所属房间 @endif</td>
                   <td>{{$list->address}}</td>
                   <td>{{$list->name}}</td>
                   <td>{{$list->phone}}</td>
                   <td>{{$flagDescs[$list->flag]}}</td>
                   <td>{{$list->dsc}}</td>

                   
                  <td> 
                    @if($list->flag != 2)
                     <form  style='float:left;margin-right:5px;'  method="post" action="/super/shop/orderstatus" onsubmit="return confirm('确定退货？');">
                      {{ $ctrl->csrf_field() }}
                      <input  type="hidden" name="orderId" value="{{$list->id}}">
                       <input  type="hidden" name="status" value="2">
                      <button class="btn btn-sm btn-danger">退货</button>
                    </form>
                    @endif
                    @if($list->flag == 0)
                     <form  style='float:left;margin-right:5px;'  method="post" action="/super/shop/orderstatus" onsubmit="return confirm('确定发货？');">
                      {{ $ctrl->csrf_field() }}
                      <input  type="hidden" name="orderId" value="{{$list->id}}">
                       <input  type="hidden" name="status" value="1">
                      <button class="btn btn-sm btn-success">发货</button>
                    </form>
                    @endif
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
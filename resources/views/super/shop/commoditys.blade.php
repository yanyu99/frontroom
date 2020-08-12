
@extends('super.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">货品列表</header>
      <div class="panel-body">
        <div class="adv-table">
        <div class="clearfix" >
            <div class="btn-group" style='margin-bottom:10px;'>
              <a href="/super/shop/commodityedit" class="btn btn-primary">新增</a>
            </div>
          </div>
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
                  <form  class="form-inline" >
                   <div class="form-group">
                      分类：
                     <select name="category_id"  class="form-control">
                     <option value="">全部</option>
                        @foreach($categorys as $key=>$value)
                        <option value="{{$value->id}}" @if($value->id == $ctrl->_request("category_id")) selected   @endif >{{$value->name}}</option>
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
                  <th>货品名称</th>
                  <th>货品分类</th>
                  <th>货品购买所需积分</th>
                  <th>总库存</th>
                  <th>剩余库存</th>
                  <th>状态</th>
                  <th>发布者</th>
                  <th>发布时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  <td>{{$list->name}}</td>
                  <td>@if($list->category){{$list->category->name}}@else 删除的分类 @endif</td>

                  <td>{{$list->price}}</td>
                  <td>{{$list->total}}</td>
                  <td>{{$list->total - $list->saled}}</td>
                  <td>{{$flagDescs[$list->flag]}}</td>
                  <td>@if($list->user){{$list->user->name}}@else 删除的用户UID({{$list->uid}}) @endif</td>
                  <td>{{$list->created_at}}</td>
                  <td> 
                  <a style='float:left;margin-right:5px;' class="btn btn-sm btn-primary" href="/super/shop/commodityedit?id={{$list->id}}">编辑</a>
                    <form  style='float:left;margin-right:5px;'  method="post" action="/super/shop/commoditydel" onsubmit="return confirm('确定删除？');">
                      {{ $ctrl->csrf_field() }}
                      <input  type="hidden" name="id" value="{{$list->id}}">
                      <button class="btn btn-sm btn-danger">删除</button>
                    </form>
                  </td>
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
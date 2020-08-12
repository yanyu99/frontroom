
@extends('super.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">投票问题配置</header>
      <div class="panel-body">
        <div class="adv-table">
          <div class="clearfix" >
            <div class="btn-group" style='margin-bottom:10px;'>
              <a href="/super/hotquestion/edit" class="btn btn-primary">新增</a>
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
                  <th>讲师</th>
                  <th>问题</th>
                  <th>答案一</th>
                  <th>答案二</th>
                  <th>答案三</th>
                  <th>有效期</th>
                  <th>排序值</th>
                  <th>操作</th>
                  <th>创建时间</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  <td>{{$list->id}}</td>
                  <td>@if($list->teacher){{$list->teacher->name}}@endif</td>
                  <td style=" word-break: break-all;max-width: 150px">{{$list->ask}}</td>
                  <td style=" word-break: break-all;max-width: 150px" @if($list->right_answer == 1) style="color:red;" @endif>{{$list->answer1}}</td>
                  <td style="word-break: break-all;max-width: 150px" @if($list->right_answer == 2) style="color:red;" @endif>{{$list->answer2}}</td>
                  <td style=" word-break: break-all;max-width: 150px" @if($list->right_answer == 3) style="color:red;" @endif>{{$list->answer3}}</td>
                  <td>{{ !empty($list->expiry_start) && strtotime($list->expiry_end) > 0 ? "{$list->expiry_start}-{$list->expiry_end}" : "-"  }}</td>
                  <td>{{$list->sort}}</td>
                  <td>
                    <form  style='float:left;margin-right:5px;'  method="post" action="/super/hotquestion/del" onsubmit="return confirm('确定删除？');">
                      {{ $ctrl->csrf_field() }}
                      <input  type="hidden" name="id" value="{{$list->
                      id}}">
                      <button class="btn btn-sm btn-danger">删除</button>
                    </form>
                    <a class="btn btn-sm btn-primary" href="/super/hotquestion/edit?id={{$list->id}}">编辑</a>
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
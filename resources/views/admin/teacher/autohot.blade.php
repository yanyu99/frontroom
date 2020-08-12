
@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">动态票数</header>
            <div class="panel-body">
                <div class="adv-table">

                    <div class="clearfix" >
                        <div class="btn-group" style='margin-bottom:10px;'>
                            <a href="/admin/teacher/edithot" class="btn btn-primary">新增</a>
                        </div>
                    </div>

                    <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
                        <!--div class="row-fluid">
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
                        </div-->
                        <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
                            <thead>
                            <tr role="row">
                                <th>ID</th>
                                <th>讲师昵称</th>
                                <th>投票数量</th>
                                <th>持续时间</th>
                                <th>投票时间</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                            @foreach($lists as $list)
                            <tr>
                                <td>{{$list->id}}</td>
                                <td>{{$list->teacher ? $list->teacher->name : '删除的讲师'}}</td>
                                <td>{{$list->hot_num}}</td>
                                <td>{{$list->time_range}}</td>
                                <td>{{$list->schedule_at}}</td>
                                <td>
                                    <span  class="{{ $list->flag == 3 ? 'text-success' : ($list->flag == 9 ? 'text-danger' : '')  }}">
                                        {{  !empty($flag_map[$list->flag]) ? $flag_map[$list->flag] : '-' }}
                                    </span>
                                </td>
                                <td>
                                    @if( $list->flag == 1 )
                                    <form  style='float:left;margin-right:5px;'  method="post" action="/admin/teacher/delhot" onsubmit="return confirm('确定删除？');">
                                        {{ $ctrl->csrf_field() }}
                                        <input  type="hidden" name="id" value="{{$list->
                      id}}">
                                        <button class="btn btn-sm btn-danger">删除</button>
                                    </form>

                                    <a class="btn btn-sm btn-primary" href="/admin/teacher/edithot?id={{$list->id}}">编辑</a>
                                    @else
                                        -
                                    @endif
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
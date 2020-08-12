
@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">竞猜汇总</header>
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
                        <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="dataTables_filter" id="dynamic-table_filter">
                                        <form  class="form-inline" id="search_form" >
                                            <div class="form-group">
                                                <span class=" control-label">昵称：</span>
                                                <input  class="form-control" type="text" name="name" value="{{$ctrl->_request("name")}}" ></div>

                                            <div class="form-group">
                                                <span class="control-label"></span>
                                                <button type="submit" class="btn btn-sm btn-primary">查询</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <form  method="post" id="idBatch"  class="form-inline"  action="/admin/jf/batchop">
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
                                        <th class="sorting uid">用户ID</th>
                                        <th class=" " >账号</th>
                                        <th class=" " >昵称</th>
                                        <th class=" ">角色</th>
                                        <th class="sorting jf_giftsend">送礼消耗积分</th>
                                        <th class="sorting jf_win">竞猜赢得积分</th>
                                        <th class="sorting jf_cur">剩余积分</th>
                                        <th class=" ">操作</th>
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
                                            <td>{{ !empty($list->user) ? $list->user->account : '已删除'}}</td>
                                            <td>{{ !empty($list->user) ? $list->user->name : '已删除'}}</td>
                                            <td>
                                                <span>
                                                    {{ (!empty($list->user) && !empty($roleMap[$list->user->type])) ? $roleMap[$list->user->type]['name'] : '-'  }}
                                                </span>
                                            </td>
                                            <td>{{$list->jf_giftsend}}</td>
                                            <td>{{$list->jf_win}}</td>
                                            <td>{{$list->jf_cur}}</td>
                                            <td>
                                                @if(!empty($list->user) && $list->user->type < App\Libs\ConstDefine::USERTYPE_MGR_ID && $list->user->type !=App\Libs\ConstDefine::USERTYPE_ROBOT_ID)
                                                <a class="btn btn-primary" href="/admin/user/edit?id={{$list->uid}}&last={{ urlencode($_SERVER['REQUEST_URI'])  }}">编辑</a>
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
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('script')
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
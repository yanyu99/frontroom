@extends('super.layouts.base')
@section('head')

@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">子房间列表</header>
                <div class="panel-body">
                    <div class="adv-table">

                        <div class="clearfix">
                            <table class="display table table-bordered table-striped dataTable" id="dynamic-table"
                                   aria-describedby="dynamic-table_info">
                                <thead>
                                <tr role="row">
                                    <th>房间ID</th>
                                    <th>房间名称</th>
                                    <th>主房间</th>
                                    <th>独立消息条数</th>
                                    <th>状态</th>
                                    <th style="max-width: 650px">消息来源</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                @foreach($lists as $list)
                                    <tr data-id="{{$list->id}}" data-pid="{{$list->parent}}">
                                        <td>{{$list->id}}</td>
                                        <td>{{$list->name}}</td>
                                        <td>{{!empty($list->parent_room) ? $list->parent_room->name : '-'}}</td>
                                        <td>{{$list->msg_num}}</td>
                                        <td id='stateShow'>{{$flag[$list->flag]}}</td>
                                        <td id="td-{{$list->id}}">

                                            @foreach($list->proxy_list as $proxy)
                                                <span style="margin-left: 10px">
                                                    <input type="checkbox"  data-tid="{{$list->id}}" data-sid="{{$proxy->id}}" {{ $proxy->id == $list->id ? 'disabled=disabled' : ''  }} onchange="shangeProxy(this)" {{ $proxy->id == $list->id || !empty($list->source_map[$proxy->id]) ? 'checked=checked' : ''  }}>
                                                    {{$proxy->name}}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <span style="" class="btn btn-primary" onclick="selectAll('{{$list->id}}', 1)">全选</span>
                                            <span style="" class="btn btn-primary" onclick="selectAll('{{$list->id}}', 0)">取消</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="dataTables_info" id="dynamic-table_info">
                                        总共 {{ count($lists)  }}条
                                    </div>
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
    <script type="text/javascript">
        function shangeProxy(obj) {
            var state = $(obj).is(':checked') ? 1 : 0;
            $.ajax({
                url: '/super/rooms/stateproxy',
                type: "POST",
                dataType: 'json',
                data: {target_id: $(obj).data('tid'), source_id: $(obj).data('sid'), state:state},
                success: function (json) {
                    if(json.code === 0){
                    } else {
                        alert(json.msg);
                    }
                }
            })
        }

        function selectAll(id, state) {
            $('#td-' + id).find('input[type=checkbox]').each(function(idx, obj){
                if(state == 1) {
                    if( !$(obj).is(':checked') ){
                        $(obj).prop("checked",'checked');
                        shangeProxy(obj);
                    }
                } else {
                    if( $(obj).is(':checked') ){
                        $(obj).prop("checked",'');
                        shangeProxy(obj);
                    }
                }

            })
        }
    </script>

@endsection
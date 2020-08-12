@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">动态票数</header>
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
                    <form class="form-horizontal" method="post">
                        {{ $ctrl->csrf_field() }}
                        <input class="form-control" name="id" type='hidden' @if($edit) readonly @endif value="@if($edit){{$edit->id}}@endif">
                        <div class="form-group">
                            <span class="col-sm-2 col-sm-2 control-label">投票时间:*</span>
                            <div class="col-sm-4">

                                <input class="form-control form_datetime" type="text" name="schedule_at" readonly @if($edit) value="{{$edit->schedule_at}}" @endif >
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-sm-2 col-sm-2 control-label">讲师:*</span>
                            <div class="col-sm-4">
                                <select class="form-control" name="tid">
                                    <option value="">全部</option>
                                    @foreach($teachers  as $key=>$value)
                                        <option value="{{$value->id}}" @if($edit && $value->id==$edit->tid) selected @endif >{{$value->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-sm-2 col-sm-2 control-label">投票总数:*</span>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="hot_num" @if($edit) value="{{$edit->hot_num}}" @endif >
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-sm-2 col-sm-2 control-label">持续时间（秒）:*</span>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="time_range" @if($edit) value="{{$edit->time_range}}" @endif >
                                <p style="color: red">将在持续时间范围内给讲师进行多次投票，每次投票间隔1-3秒,设置为0表示一次性增加,持续时间最大为600秒</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="controls text-center">
                                <button type="submit" class="btn btn-primary">确定</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('script')
    <link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-datetimepicker/css/datetimepicker-custom.css"/>
    <script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
    <link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-datepicker/css/datepicker-custom.css"/>
    <script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $(function () {
            $(".form_datetime").datetimepicker({
                format: "yyyy-mm-dd hh:ii:00",
                autoclose: true,
                language: "zh-CN",
                todayBtn: true,
                minuteStep: 1,
                startView: 1
            });
        });
    </script>
@endsection
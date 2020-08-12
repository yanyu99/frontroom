@extends('super.layouts.base')
@section('head')

@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">问题配置</header>
                <div class="panel-body">
                    <form class="form-horizontal" method="post">
                        {{ $ctrl->csrf_field() }}
                        <input class="form-control" name="id" type='hidden' @if($edit) readonly @endif value="@if($edit){{$edit->
					id}}@endif">
                        <div class="form-group">
                            <span class="col-sm-2 col-sm-2 control-label">问题:*</span>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="ask"
                                       @if($edit) value="{{$edit->ask}}" @endif ></div>
                        </div>
                        <div class="form-group">
                            <span class="col-sm-2 col-sm-2 control-label">答案一:*</span>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="answer1"
                                       @if($edit) value="{{$edit->answer1}}" @endif ></div>
                        </div>
                        <div class="form-group">
                            <span class="col-sm-2 col-sm-2 control-label">答案二:*</span>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="answer2"
                                       @if($edit) value="{{$edit->answer2}}" @endif ></div>
                        </div>
                        <div class="form-group">
                            <span class="col-sm-2 col-sm-2 control-label">答案三:*</span>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="answer3"
                                       @if($edit) value="{{$edit->answer3}}" @endif ></div>
                        </div>

                        <div class="form-group">
                            <span class="col-sm-2 col-sm-2 control-label">正确答案:*</span>
                            <div class="col-sm-4">
                                <select class="form-control" name="right_answer">
                                    <option value="1" @if($edit && $edit->right_answer == 1) selected @endif> 答案一
                                    </option>
                                    <option value="2" @if($edit && $edit->right_answer == 2) selected @endif> 答案二
                                    </option>
                                    <option value="3" @if($edit && $edit->right_answer == 3) selected @endif> 答案三
                                    </option>
                                </select></div>
                        </div>
                        <div class="form-group">
                            <span class="col-sm-2 col-sm-2 control-label">讲师：*</span>
                            <div class="col-sm-4">
                                <select name="tid" class="form-control">
                                    @foreach($teachers as $value)
                                        <option value="{{$value->
							id}}" @if($edit) @if($value->id == $edit->tid) selected @endif @endif >{{$value->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-sm-2 col-sm-2 control-label">排序:*</span>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="sort"
                                       @if($edit) value="{{$edit->sort}}" @endif ></div>
                        </div>
                        <div class="form-group form-inline">
                            <span class="col-sm-2 col-sm-2 control-label">有效期 开始:</span>
                            <div class="col-sm-10">

                                <div class="input-group date form_datetime col-md-5">
                                    <input class="form-control" size="16" type="text" value="{{$edit && strtotime( $edit->expiry_start) > 0 ? $edit->expiry_start : ''}}" readonly name="expiry_start">
                                    <span class="input-group-addon" style="width: 34px;"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon" style="width: 34px;"><span class="glyphicon glyphicon-th"></span></span>
                                </div>

                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <span class="col-sm-2 col-sm-2 control-label">有效期 结束:</span>
                            <div class="col-sm-10">

                                <div class="input-group date form_datetime col-md-5" >
                                    <input class="form-control" size="16" type="text" value="{{$edit && strtotime($edit->expiry_end) > 0 ? $edit->expiry_end : ''}}" readonly name="expiry_end">
                                    <span class="input-group-addon" style="width: 34px;"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon" style="width: 34px;"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                                <p style="color: red">开始时间和结束时间设置为空表示该问题一直有效</p>
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
    <link rel="stylesheet" type="text/css"
          href="{{$cdn}}/assets/bootstrap-datetimepicker-2.4.4/css/bootstrap-datetimepicker.min.css"/>
    <script type="text/javascript"
            src="{{$cdn}}/assets/bootstrap-datetimepicker-2.4.4/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript"
            src="{{$cdn}}/assets/bootstrap-datetimepicker-2.4.4/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
    <script type="text/javascript">
        $('.form_datetime').datetimepicker({
            format: "yyyy-mm-dd hh:ii:ss",
            language:  'zh-CN',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1
        });
    </script>
@endsection
@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')

<div class="row">
	<div class="col-sm-12">
	<section class="panel">
		<header class="panel-heading">展示图片配置</header>
		<div class="panel-body">
	<form class="form-horizontal" method="post" >
		{{ $ctrl->csrf_field() }}
		<input class="form-control" name="id" type='hidden' @if($edit) readonly @endif value="@if($edit){{$edit->id}}@endif"  >

			
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">标 题:*</span>
				<div class="col-sm-4">
					<input  class="form-control" type="text" name="title" @if($edit) value="{{$edit->title}}" @endif ></div>
			</div>
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">开始时间:*</span>
				<div class="col-sm-4">
					<input type="text"  name="s_time" @if($edit) value="{{$edit->s_time}}" @endif class="form_time form-control" readonly="" size="16">
              
				</div>
			</div>

			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">结束时间:*</span>
				<div class="col-sm-4">
					<input type="text"  name="e_time" @if($edit) value="{{$edit->e_time}}" @endif class="form_time form-control" readonly="" size="16">
				</div>
			</div>
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">讲师：*</span>
				<div class="col-sm-4">
				<select name="tid"  class="form-control">
					@foreach($teachers as $value)
					<option value="{{$value->id}}" @if($edit) @if($value->id == $edit->tid) selected  @endif @endif >{{$value->name}}</option>
					@endforeach
				</select>
				</div>
			</div>
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">描述:</span>
				<div class="col-sm-4">
					<input  class="form-control" type="text" name="dsc" @if($edit) value="{{$edit->dsc}}" @endif ></div>
			</div>
		<div class="form-group">
			<div class="controls text-center">
				<button type="submit" class="btn btn-primary">确定</button>
			</div>
		</div>
	</form>
</div>
</section></div></div>
@endsection
@section('script')
 <link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-timepicker/css/timepicker.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

<script type="text/javascript">
 $('.form_time').timepicker({
    minuteStep: 1,
    secondStep:1,
    showSeconds: false,
    showMeridian: false,
    defaultTime: false
});
$(function () {
    doUpload({
    	id:"idcardPicker",
    	intputId:"idcardImg",
    	showId:"idcard_img",
    	descId:"idcard_img_msg",
    	csrf_token:'{{ $ctrl->csrf_token() }}'
    });
})
</script>
@endsection
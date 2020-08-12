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
				<span class="col-sm-2 col-sm-2 control-label">股票名称(代码):*</span>
				<div class="col-sm-4">
					<input  class="form-control" type="text" name="stock_code" @if($edit) value="{{$edit->stock_code}}" @endif ></div>
			</div>
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">买入时间:*</span>
				<div class="col-sm-4">
					<input type="text"  name="buy_time" @if($edit) value="{{$edit->buy_time}}" @endif class="form_datetime form-control" readonly="" size="16">
              
				</div>
			</div>
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">买入价格:*</span>
				<div class="col-sm-4">
					<input  class="form-control" type="text" name="buy_pri" @if($edit) value="{{$edit->buy_pri}}" @endif ></div>
			</div>
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">卖出时间:*</span>
				<div class="col-sm-4">
					<input type="text"  name="sell_time" @if($edit) value="{{$edit->sell_time}}" @endif class="form_datetime form-control" readonly="" size="16">
              
				</div>
			</div>
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">卖出价格:*</span>
				<div class="col-sm-4">
					<input  class="form-control" type="text" name="sell_pri" @if($edit) value="{{$edit->sell_pri}}" @endif ></div>
			</div>
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">收益:*</span>
				<div class="col-sm-4">
					<input  class="form-control" type="text" name="sy" @if($edit) value="{{$edit->sy}}" @endif ></div>
			</div>
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">推荐人：*</span>
				<div class="col-sm-4">
					<select name="tid"  class="form-control">
						@foreach($teachers as $value)
						<option value="{{$value->
							id}}" @if($edit) @if($value->id == $edit->tid) selected  @endif @endif >{{$value->name}}
						</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">备注：</span>
						<div class="col-sm-8">
							<textarea  class="form-control "  type="text" name="why"  > @if($edit){{$edit->why}}@endif</textarea></div>
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
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-datetimepicker/css/datetimepicker-custom.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-datepicker/css/datepicker-custom.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
$(".form_datetime").datetimepicker({
    format: "mm-dd hh:ii",
    autoclose: true,
    language:"zh-CN",
    todayBtn: true,
    minuteStep: 1,
    startView:1
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
@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading">内参管理</header>
			<div class="panel-body">
				<form class="form-horizontal" method="post" >
					{{ $ctrl->csrf_field() }}
					<input class="form-control" name="id" type='hidden' @if($edit) readonly @endif value="@if($edit){{$edit->
					id}}@endif"  >
			
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">内容:*</span>
						<div class="col-sm-8">
							<textarea  class="form-control ckeditor"  type="text" name="text"  >@if($edit){{$edit->text}}@endif</textarea>
						</div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">时间:*</span>
						<div class="col-sm-4">
							<input  class="form-control form_datetime" type="text" readonly name="ts" @if($edit) value="{{$edit->ts}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">讲师：*</span>
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
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-datetimepicker/css/datetimepicker-custom.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-datepicker/css/datepicker-custom.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">

	$(".form_date").datepicker({
		format: "yyyy-mm-dd",
		autoclose: true,
		language:"zh-CN",
		todayBtn: true,
		startView:1
	});
	$(".form_datetime").datetimepicker({
		format: "yyyy-mm-dd hh:ii:ss",
		autoclose: true,
		language:"zh-CN",
		todayBtn: true,
		minuteStep: 1,
		startView:1
	});

</script>
@endsection
@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')

<div class="row">
	<div class="col-sm-12">
	<section class="panel">
		<header class="panel-heading">展示图片配置</header>
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
		<input class="form-control" name="id" type='hidden' @if($edit) readonly @endif value="@if($edit){{$edit->id}}@endif"  >
<!--
			
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">推广地址：</span>
				<div class="col-sm-8">
					<input  class="form-control" type="text" name="url" @if($edit) value="{{$edit->url}}" @endif ></div>
			</div>-->
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">排序值：</span>
				<div class="col-sm-4">
					<input  class="form-control" type="text" name="sort" @if($edit)  value="{{$edit->sort}}" @endif></div>
			</div>
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">图片地址：</span>
				<div class="col-sm-10">
					<span>文件大小：200k 以内(建议使用jpg或png格式，并做压缩处理) </span>
				<div class="img-upload">
					<div id="idcardPicker"></div>
					<p id="idcard_img_msg" class="webuploader-tip">
						<p>
							<input class="form-control" type="hidden" name="imgurl" id="idcardImg" value="@if($edit){{$edit->
							imgurl}}@endif"/>
							<img id="idcard_img" src="@if($edit){{$edit->imgurl}}@endif" alt="" width='400' height="130"/></p>
					</p>
				</div>
				</div>
			</div>
			<div class="form-group">
				<span class="col-sm-2 col-sm-2 control-label">状态：</span>
				<div class="col-sm-10">
				<select name="flag"  class="form-control">
					@foreach($flagDesc as $key=>$flag)
					<option value="{{$key}}" @if($edit) @if($key==$edit->flag) selected  @endif @endif >{{$flag}}</option>
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
</div></section></div></div>
@endsection
@section('script')
<script type="text/javascript">
$(function () {
    doUpload({
    	id:"idcardPicker",
    	intputId:"idcardImg",
    	showId:"idcard_img",
    	descId:"idcard_img_msg",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:200*1024,
    });
})
</script>
@endsection
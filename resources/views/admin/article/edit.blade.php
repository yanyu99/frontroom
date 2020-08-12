@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading"> 文章管理</header>
			<div class="panel-body">
				<form class="form-horizontal" method="post" >
					{{ $ctrl->csrf_field() }}
					<input class="form-control" name="id" type='hidden' @if($edit) readonly @endif value="@if($edit){{$edit->
					id}}@endif"  >
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">类 型:*</span>
						<div class="col-sm-4">
							<select name="type"  class="form-control">
								@foreach($typeDescs as $key=>$value)
								<option value="{{$key}}" @if($edit) @if($key == $edit->type) selected  @endif @endif >{{$value}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">标 题:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="title" @if($edit) value="{{$edit->title}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">讲师：*</span>
						<div class="col-sm-4">
							<select name="uid"  class="form-control">
								@foreach($teachers as $value)
								<option value="{{$value->
									id}}" @if($edit) @if($value->id == $edit->uid) selected  @endif @endif >{{$value->name}}
								</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">公告：</span>
						<div class="col-sm-8">
							<textarea  class="form-control ckeditor"  type="text" name="text"  >@if($edit){{$edit->text}}@endif</textarea>
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
<script type="text/javascript" src="{{$common_cdn}}/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">

$(function () {
    // 初始化Web Uploader
 
 

})
</script>
@endsection

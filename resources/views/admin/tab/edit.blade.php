@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading">TAB栏配置</header>
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

				<form class="form-horizontal" method="post" >
					{{ $ctrl->csrf_field() }}
					<input class="form-control" name="id" type='hidden' @if($edit) readonly @endif value="@if($edit){{$edit->
					id}}@endif"  >
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">名称:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="title" @if($edit) value="{{$edit->title}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">内容:*</span>
						<div class="col-sm-8">
							<textarea  class="form-control ckeditor"  type="text" name="text"  >@if($edit){{$edit->text}}@endif</textarea>
						</div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">排序:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="sort" @if($edit) value="{{$edit->sort}}" @endif ></div>
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
@endsection
@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading">讲师建议</header>
			<div class="panel-body">
				<form class="form-horizontal" method="post" >
					{{ $ctrl->csrf_field() }}
					<input class="form-control" name="id" type='hidden' @if($edit) readonly @endif value="@if($edit){{$edit->id}}@endif"  >
					     <div class="form-group">
            <span class="col-sm-2 col-sm-2 control-label">讲师：*</span>
            <div class="col-sm-4">
              <select name="tid"  class="form-control">
                @foreach($teachers as $value)
                <option value="{{$value->id}}" @if($edit) @if($value->id == $edit->tid) selected  @endif @endif >{{$value->name}}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">标题：</span>
						<div class="col-sm-8">
							<input  class="form-control" type="text" name="title" value="@if($edit){{$edit->title}}@endif" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">内容：</span>
						<div class="col-sm-8">
							<textarea  class="form-control ckeditor"  type="text" name="content"  >@if($edit){{$edit->content}}@endif</textarea></div>
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
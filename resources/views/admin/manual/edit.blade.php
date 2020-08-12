@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading">喊单管理</header>
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
						<span class="col-sm-2 col-sm-2 control-label">标 题:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="title" @if($edit) value="{{$edit->title}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">品种:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="variety" @if($edit) value="{{$edit->variety}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">成本价:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="cb_price" @if($edit) value="{{$edit->cb_price}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">止损价:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="zs_price" @if($edit) value="{{$edit->zs_price}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">目标价:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="mb_price" @if($edit) value="{{$edit->mb_price}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">方 向：*</span>
						<div class="col-sm-4">
							<label class="radio-inline">
								<input type="radio"  @if($edit && $edit->
								mr_mc == 1) checked  @endif @if(!$edit) checked @endif name="mr_mc" id="inlineCheckbox1" value="1"> 买入
							</label>
							<label class="radio-inline">
								<input type="radio" name="mr_mc"  @if($edit && $edit->
								mr_mc == 2) checked  @endif id="inlineCheckbox2" value="2"> 卖出
							</label>
						</div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">建议：*</span>
						<div class="col-sm-4">
							<select name="type"  class="form-control">
								@foreach($typeDescs as $key=>$value)
								<option value="{{$key}}" @if($edit) @if($key == $edit->type) selected  @endif @endif >{{$value}}</option>
								@endforeach
							</select>
						</div>
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
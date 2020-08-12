@extends('super.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading">礼物编辑</header>
			<div class="panel-body">
				<form class="form-horizontal" method="post" >
					{{ $ctrl->csrf_field() }}
					<input class="form-control" name="id" type='hidden' @if($edit) readonly @endif value="@if($edit){{$edit->id}}@endif"  >
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">名称:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="name" @if($edit) value="{{$edit->name}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 control-label">图片（114*26）：</span>
						<div class="col-sm-6">
							<div class="img-upload">
								<div id="idIMG"></div>
								<p id="idIMGTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="pic" id="idIMGInput" @if($edit)value="{{$edit->pic}}"@endif/>
										<img id="idIMGShow" @if($edit) src="{{$edit->pic}}"@endif alt="" height="100"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>
				
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">赠送所需积分:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="price" @if($edit) value="{{$edit->price}}" @endif ></div>
					</div>
					
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">所属分类：*</span>
						<div class="col-sm-4">
							<select name="cate_id"  class="form-control">
								@foreach($categorys as $key=>$value)
								<option value="{{$value->id}}" @if($edit) @if($value->id == $edit->category_id) selected  @endif @endif >{{$value->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">状态：*</span>
						<div class="col-sm-4">
							<select name="uid"  class="form-control">
								@foreach($flagDescs as $value)
								<option value="{{$key}}" @if($edit) @if($key == $edit->flag) selected  @endif @endif >{{$value}}
								</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">排序值:*</span>
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

@section("script")
<script type="text/javascript">

$(function(){
	$('.js-clear').click(function(){
    	$(this).parent().find("input").val("");
    	$(this).parent().find("img").attr("src","");
    });
    doUpload({
    	id:"idIMG",
    	intputId:"idIMGInput",
    	showId:"idIMGShow",
    	descId:"idIMGTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:50*1024,
    });
   
})
	
</script>
@endsection

@extends('admin.layouts.base')
@section('head')
	<link href="{{$common_cdn}}/js/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet">
	<link href="{{$common_cdn}}/js/ios-switch/switchery.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading">讲师配置</header>
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
						<span class="col-sm-2 col-sm-2 control-label">别名:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="j_name" @if($edit) value="{{$edit->j_name}}" @endif ></div>
					</div>

					<div class="form-group">
						<span class="col-sm-2  control-label">名称颜色：</span>
						<div class="col-sm-4">
							<input name="name_color" class="form-control dropdown-toggle" id="selected-name-color" data-toggle="dropdown" value="{{!empty($edit) ? $edit->name_color : '#FFFFFF'}}">
							<ul class="dropdown-menu">
								<li><div id="colorpalette-name-color"></div></li>
							</ul>
						</div>
					</div>

					<div class="form-group">
						<span class="col-sm-2  control-label">排行榜加粗：</span>
						<div class="col-sm-4">
							<input type="checkbox" class="js-switch" name="name_bold" @if(!empty($edit) && $edit->name_bold) checked @endif /></div>
					</div>

					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">图片(200*200)：*</span>
						<div class="col-sm-8">
							<div class="img-upload">
								<div id="idLessonImg"></div>
								<p id="idLessonImgTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="imgurl" id="idLessonImgInput" @if($edit) value="{{$edit->imgurl}}" @endif/>
										<img id="idLessonImgShow" @if($edit) src="{{$edit->imgurl}}" @endif alt="" height="100" width="100"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">展示图片(200*200)：*</span>
						<div class="col-sm-8">
							<div class="img-upload">
								<div id="idShowImg"></div>
								<p id="idShowImgTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="showimg" id="idShowImgInput" @if($edit) value="{{$edit->showimg}}" @endif/>
										<img id="idShowImgShow" @if($edit) src="{{$edit->showimg}}" @endif alt="" height="100" width="100"/></p>
								</p>
							</div>
						</div>
						<button class="btn btn-danger js-clear" type="button" >清除</button>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">描述:*</span>
						<div class="col-sm-8">
							<textarea  class="form-control ckeditor"  type="text" name="introduction"  >@if($edit){{$edit->introduction}}@endif</textarea>
						</div>
					</div>
					@if($agree_opend)
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">进度条底数:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="base" @if($edit) value="{{$edit->base}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">今日点赞基数:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="today_base" @if($edit) value="{{$edit->today_base}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">累计点赞基数:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="total_base" @if($edit) value="{{$edit->total_base}}" @endif ></div>
					</div>
					
					@endif
					@if($site->hot_opend)
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">人气基数:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="hot_base" @if($edit) value="{{$edit->hot_base}}" @endif ></div>
					</div>
					@endif
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">排序:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="sort" @if($edit) value="{{$edit->sort}}" @endif ></div>
					</div>
					<div class="form-group">
        <span class="col-sm-2 col-sm-2 control-label">是否展示:*</span>
        <div class="col-sm-4">
        <select name="show"  class="form-control">
          @foreach($flagDesc as $key=>$flag)
          <option value="{{$key}}" @if($edit && $key==$edit->show)  selected   @endif >{{$flag}}</option>
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
	<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-colorpalette/js/bootstrap-colorpalette.js" ></script>
	<script type="text/javascript" src="{{$common_cdn}}/js/ckeditor/ckeditor.js"></script>
	<script src="{{$common_cdn}}/js/ios-switch/switchery.js"></script>
	<script src="{{$common_cdn}}/js/ios-switch/ios-init.js"></script>
<script type="text/javascript">
    $('#colorpalette-name-color').colorPalette().on('selectColor', function(e) {
        $('#selected-name-color').val(e.color);
    });

	doUpload({
    	id:"idLessonImg",
    	intputId:"idLessonImgInput",
    	showId:"idLessonImgShow",
    	descId:"idLessonImgTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:200*1024,
    });
    doUpload({
    	id:"idShowImg",
    	intputId:"idShowImgInput",
    	showId:"idShowImgShow",
    	descId:"idShowImgTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:200*1024,
    });
    $('.js-clear').click(function(){
    	$(this).parent().find("input").val("");
    	$(this).parent().find("img").attr("src","");
    })
</script>
@endsection
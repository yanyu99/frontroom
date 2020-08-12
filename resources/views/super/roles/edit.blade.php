@extends('super.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading">角色编辑</header>
			<div class="panel-body">
				<form class="form-horizontal" method="post" >
					{{ $ctrl->csrf_field() }}
					<input class="form-control" name="id" type='hidden' @if($edit) readonly @endif value="@if($edit){{$edit->
					id}}@endif"  >
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">名称:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="name" @if($edit) value="{{$edit->name}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">描述:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="desc" @if($edit) value="{{$edit->desc}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">图标宽度（按高度为24等比缩放）:*</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="imgwidth" @if($edit) value="{{$edit->imgwidth}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">聊天间隔:*</span>
						<div class="col-sm-4">
							<input  class="form-control" onkeyup='this.value=this.value.replace(/\D/gi,"")' type="text" name="chat_ts" @if($edit) value="{{$edit->chat_ts}}" @endif ></div>
					</div>
					@if($proposing_opend)
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">关注个数:*</span>
						<div class="col-sm-4">
							<input  class="form-control" onkeyup='this.value=this.value.replace(/\D/gi,"")' type="text" name="follow_num" @if($edit) value="{{$edit->follow_num}}" @endif ></div>
					</div>
					@endif
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">每日可发红包金额（元）:</span>
						<div class="col-sm-4">
							<input  class="form-control" onkeyup='this.value=this.value.replace(/\D/gi,"")' type="text" name="f_luck_max_money" @if($edit) value="{{$edit->f_luck_max_money}}" @endif ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">图标(10KB)：</span>
						<div class="col-sm-10">
							<div class="img-upload">
								<div id="idICONImg"></div>
								<p id="idICONImgTip" class="webuploader-tip">
									<p>
										<input  class="form-control" type="hidden" name="imgurl" id="idICONImgInput" @if($edit) value="{{$edit->
										imgurl}}" @endif/>
										<img id="idICONImgShow" @if($edit) src="{{$edit->imgurl}}" @endif alt="" height="24"/></p>
								</p>
							</div>
						</div>
					</div>

					<div class="form-group">
						<span class="col-sm-2 control-label">后端权限:</span>
						<div class="col-sm-4">
							<div class="input-group">
								@foreach($adminMap as $key=>$value)
								<label class="checkbox-inline" style="margin-left: 10px;">
								@if($edit && $edit->role_id == App\Libs\ConstDefine::USERTYPE_SUPER_MGR_ID)
								<input   type="hidden" name="{{$key}}" value="on">
								<input   type="checkbox" name="{{$key}}" checked  disabled>
								 @elseif($edit && $edit->role_id == App\Libs\ConstDefine::USERTYPE_ROBOT_ID && ( $key !="f_chat_noaudit" && $key !="f_boardcast") )
									<input   type="hidden" name="{{$key}}" value="">
									<input   type="checkbox" name="{{$key}}"  disabled>
								 @else
									<input   type="checkbox" name="{{$key}}" @if($edit)  @if($edit->$key == 1) checked @endif @endif/>
								@endif
								<span>{{$value}}</span></label>
                       @endforeach
							</div>
						</div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 control-label">前端权限:</span>
						<div class="col-sm-4">
							<div class="input-group">
								@foreach($frontMap as $key=>$value)
								<label class="checkbox-inline" style="margin-left: 10px;">
								 @if($edit && $edit->role_id == App\Libs\ConstDefine::USERTYPE_ROBOT_ID && ( $key !="f_chat_noaudit" && $key !="f_boardcast") )
									<input   type="hidden" name="{{$key}}" value="">
									<input   type="checkbox" name="{{$key}}"  disabled>
								 @else
									<input   type="checkbox" name="{{$key}}" @if($edit)  @if($edit->$key == 1) checked @endif @endif/>
								@endif
								
								{{$value}}</label>
                       		@endforeach
							</div>
						</div>
					</div>
					@if($show_other_rooms_opend)
					<div class="form-group">
						<span class="col-sm-2 control-label">显示房间:</span>
						<div class="col-sm-4">
							<div class="input-group">
								@foreach($rooms as $key=>$value)
								<label class="checkbox-inline" style="margin-left: 10px;">
									<input   type="checkbox" name="rooms[]" value="{{$value->id}}" @if($edit)  @if(in_array($value->id,$edit->getRoomIds())) checked @endif @endif>
									<span>{{$value->name}}</span>
								</label>
                       			@endforeach
							</div>
						</div>
					</div>
					@endif
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
<script type="text/javascript">
$(function () {
    // 初始化Web Uploader
    doUpload({
    	id:"idICONImg",
    	intputId:"idICONImgInput",
    	showId:"idICONImgShow",
    	descId:"idICONImgTip",
    	csrf_token:'{{ $ctrl->csrf_token() }}',
    	fileSize:10*1024,
    });


})
</script>
@endsection
@extends('admin.layouts.base')
@section('head')
<link href="{{$common_cdn}}/js/ios-switch/switchery.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading">房间权限配置</header>
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
				<form class="form-horizontal" method="post" onsubmit="return confirm('确定要提交吗？');">
					{{ $ctrl->csrf_field() }}
					<div class="form-group">
						<span class="col-sm-4  control-label">是否开启手机验证：</span>
						<div class="col-sm-6">
							<input type="checkbox" class="js-switch" name="phone_check" @if($edit->phone_check) checked @endif /></div>
					</div>
					<div class="form-group">
						<span class="col-sm-4 control-label">短信模板：</span>
						<div class="col-sm-4">
							<input  class="form-control" type="text" name="sms_model" value="{{$edit->sms_model}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-4 control-label">注册默认角色：</span>
						<div class="col-sm-2">
						<select class="form-control" name="default_role">
						@foreach($roles as $key=>$value)
							<option value="{{$value->role_id}}" @if($edit->default_role == $value->role_id) selected @endif>
								{{$value->name}}
							</option>
						@endforeach
						</select>
						</div>
					</div>
					<div class="form-group">
						<span class="col-sm-4  control-label">是否开启聊天：</span>
						<div class="col-sm-6">
							<input type="checkbox" class="js-switch" name="chat_open" @if($edit->chat_open) checked @endif /></div>
					</div>
					<div class="form-group">
						<span class="col-sm-4  control-label">是否独立审核：</span>
						<div class="col-sm-6">
							<input type="checkbox" class="js-switch" name="single_audit" @if($edit->single_audit) checked @endif /></div>
					</div>
					<div class="form-group">
						<span class="col-sm-4  control-label">是否开启注册：</span>
						<div class="col-sm-6">
							<input type="checkbox" class="js-switch" name="reg_open" @if($edit->reg_open) checked @endif /></div>
					</div>
					<div class="form-group">
						<span class="col-sm-4  control-label">是否允许修改昵称：</span>
						<div class="col-sm-6">
							<input type="checkbox" class="js-switch" name="change_name" @if($edit->change_name) checked @endif /></div>
					</div>
					<div class="form-group">
						<span class="col-sm-4  control-label">是否允许修改密码：</span>
						<div class="col-sm-6">
							<input type="checkbox" class="js-switch" name="change_pwd" @if($edit->change_pwd) checked @endif /></div>
					</div>
					
					<div class="form-group">
						<span class="col-sm-4  control-label">是否提示游客不能发言：</span>
						<div class="col-sm-6">
							<input type="checkbox" class="js-switch" name="guest_chat_cue" @if($edit->guest_chat_cue) checked @endif /></div>
					</div>
					
					@if($show_other_rooms_opend)
					<div class="form-group">

						<span class="col-sm-4 control-label">是否显示其他房间入口：</span>
						<div class="col-sm-6">

							<input type="checkbox" class="js-switch" name="show_other_rooms" @if($edit->show_other_rooms) checked @endif /></div>
					</div>
					@endif
					
					<div class="form-group">
						<span class="col-sm-4 control-label">进入房间是否显示弹窗广告：</span>
						<div class="col-sm-6">

							<input type="checkbox" class="js-switch" name="pop_ad" @if($edit->pop_ad) checked @endif /></div>
					</div>
					<div class="form-group">
						<span class="col-sm-4 control-label">提醒游客登录的小窗口：</span>
						<div class="col-sm-2">
						<select class="form-control" name="login_pop">
						@foreach($login_pops as $key=>$value)
							<option value="{{$key}}" @if($edit->login_pop == $key) selected @endif>
								{{$value}}
							</option>
						@endforeach
						</select>
						</div>
					</div>
					<div class="form-group">
						<span class="col-sm-4 control-label">弹窗间隔(秒)：</span>
						<div class="col-sm-2">
							<input  class="form-control" type="text" name="login_pop_ts" value="{{$edit->login_pop_ts}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-4 control-label">新注册用户不能发言时间(秒)：</span>
						<div class="col-sm-2">
							<input  class="form-control" type="text" name="reg_speek_delay" value="{{$edit->reg_speek_delay}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-4 control-label">房间人数基数：</span>
						<div class="col-sm-2">
							<input  class="form-control" type="text" name="base_user" value="{{$edit->base_user}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-4 control-label">历史消息条数（最大200）：</span>
						<div class="col-sm-2">
							<input  class="form-control" type="text" name="chat_history_num" value="{{$edit->chat_history_num}}" ></div>
					</div>
					<!--<div class="form-group">
						<span class="col-sm-4 control-label">历史提问条数（最大100）：</span>
						<div class="col-sm-2">
							<input  class="form-control" type="text" name="question_history_num" value="{{$edit->question_history_num}}" ></div>
					</div>-->
					<div class="form-group">
						<span class="col-sm-4 control-label">房间密码：</span>
						<div class="col-sm-2">
							<input  class="form-control" type="text" name="pwd" value="{{$edit->pwd}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-4 control-label">视频密码：</span>
						<div class="col-sm-2">
							<input  class="form-control" type="text" name="video_pwd" value="{{$edit->video_pwd}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-4 col-sm-4 control-label">聊天关键字过滤：(半角逗号分隔)</span>
						<div class="col-sm-8">
							<textarea  class="form-control"  type="text" name="chat_filter"  >{{$edit->chat_filter}}</textarea>
						</div>
					</div>
					<div class="form-group">
						<span class="col-sm-4 col-sm-4 control-label">昵称关键字过滤：(半角逗号分隔)</span>
						<div class="col-sm-8">
							<textarea  class="form-control"  type="text" name="name_filter"  >{{$edit->name_filter}}</textarea>
						</div>
					</div>
					<div class="form-group">
						<span class="col-sm-4 control-label">过滤连续数字个数(0则不过滤)：</span>
						<div class="col-sm-2">
							<input  class="form-control" type="text" name="filter_num" value="{{$edit->filter_num}}" ></div>
					</div>
					@if($curRoom->parent == 0)
					<div class="form-group">
						<span class="col-sm-4  control-label" style="color: red;">是否将以上配置同步到所有代理房间：</span>
						<div class="col-sm-6">
							<input type="checkbox" class="js-switch" name="sync_child"  /></div>
					</div>
					@endif
					<div class="control-group">

						<div class="form-group">
							<div class="controls text-center">
								<button type="submit" class="btn btn-primary">确定</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</section>
	</div>
</div>
@endsection
@section('script')
<script src="{{$common_cdn}}/js/ios-switch/switchery.js"></script>
<script src="{{$common_cdn}}/js/ios-switch/ios-init.js"></script>
@endsection
@extends('super.layouts.base')
@section('head')
<link href="{{$common_cdn}}/js/ios-switch/switchery.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading">积分配置</header>
			<div class="panel-body">
				<form id="myForm" class="form-horizontal" method="post" action="/super/jf/index" >
					{{ $ctrl->csrf_field() }}
					@if($site->jf_opend)

					<div class="form-group">
						<span class="col-sm-2  control-label">竞猜标题：</span>
						<div class="col-sm-2">
							<input  class="form-control" type="text" name="jc_title" value="{{$edit->jc_title}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2  control-label">签到送积分数：</span>
						<div class="col-sm-2">
							<input  class="form-control" type="text" name="jf_gave" value="{{$edit->jf_gave}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2  control-label">注册送积分数：</span>
						<div class="col-sm-2">
							<input  class="form-control" type="text" name="reg_jf" value="{{$edit->reg_jf}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2  control-label">推广注册积分数：</span>
						<div class="col-sm-2">
							<input  class="form-control" type="text" name="reg_p_jf" value="{{$edit->reg_p_jf}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2  control-label">抽奖耗积积分：</span>
						<div class="col-sm-2">
							<input  class="form-control" type="text" name="jf_fortune" value="{{$edit->jf_fortune}}" ></div>
					</div>
                    <div class="form-group">
                        <span class="col-sm-2 control-label">每天抽奖次数：</span>
                        <div class="col-sm-2">
                            <input class="form-control" type="text" name="jf_fortune_once" value="{{$edit->jf_fortune_once}}" />
							<span style="color: red;">0为无限制，大于0为次数限制</span>
						</div>
                    </div>
						<div class="form-group">
							<span class="col-sm-2 control-label">抽奖是否弹出：</span>
							<div class="col-sm-6">

								<input type="checkbox" class="js-switch" name="jf_fortune_popup" @if($edit->jf_fortune_popup) checked @endif /></div>
						</div>
						<div class="form-group">
							<span class="col-sm-2 control-label">是否隐藏中奖用户：</span>
							<div class="col-sm-6">

								<input type="checkbox" class="js-switch" name="jf_hide_user" @if($edit->jf_hide_user) checked @endif /></div>
						</div>
					<div class="form-group">
						<span class="col-sm-2  control-label">竞猜消耗积分数：</span>
						<div class="col-sm-2">
							<input  class="form-control" type="text" name="jf_to" value="{{$edit->jf_to}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 control-label">竞猜开始时间:*</span>
						<div class="col-sm-10">
							<input type="text"  name="jc_s_at" @if($edit) value="{{$edit->
								jc_s_at}}" @endif class="form-control "  size="16"><span style="color: red;">以逗号分隔多次竞猜间隔的开始时间</span>
						</div>
					</div>
					<div class="form-group">
						<span class="col-sm-2 col-sm-2 control-label">竞猜结束时间:*</span>
						<div class="col-sm-10">
							<input type="text"  name="jc_e_at" @if($edit) value="{{$edit->
								jc_e_at}}" @endif class="form-control "  size="16"><span style="color: red;">以逗号分隔多次竞猜间隔的结束时间与开始时间个数相匹配</span>
						</div>
					</div>
					@for($i=1;$i<=6;$i++)
					 {{-- */$gj_ts='gj_ts'.$i;$gj_jf='gj_jf'.$i;$arr=["","一","二","三","四","五","六"]/* --}}
					<div class="form-group">
						<span class="col-sm-2  control-label">{{$arr[$i]}}号宝箱挂机时间(m):</span>
						<div class="col-sm-2">
							<input  class="form-control" type="text" name="gj_ts{{$i}}" value="{{$edit->$gj_ts}}" ></div>
					</div>
					<div class="form-group">
						<span class="col-sm-2  control-label">{{$arr[$i]}}号宝箱挂机得积分：</span>
						<div class="col-sm-2">
							<input  class="form-control" type="text" name="gj_jf{{$i}}" value="{{$edit->$gj_jf}}" ></div>
					</div>
					@endfor


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

@section("script")
<script src="{{$common_cdn}}/js/ios-switch/switchery.js"></script>
<script src="{{$common_cdn}}/js/ios-switch/ios-init.js"></script>
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-timepicker/css/timepicker.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript">
  $('.form_time').timepicker({
    minuteStep: 1,
    showSeconds: false,
    showMeridian: false,
    defaultTime: false
});


</script>
@endsection

<!DOCTYPE html>
<html>
<head>
	<title>系统注册</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta name="renderer" content="webkit"> 
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/css/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/validform/validform.css" >

	<style type="text/css">
		body{
			font: 14px/1.4 'STHeiti','Microsoft YaHei','宋体','arial';
	    	background: #eee;
		}
		h1{
			color: #0062b4;
    		font-weight: 800;
    		font-size: 17px;
    		border-bottom: 1px solid #ddd;
    		padding-bottom: 5px;
		}
		.form-body{
			background: #f6f6f6;
			border-radius: 5px;
			padding-top: 15px;
			margin-bottom: 25px;
			
		}
		.form-group{
			margin-bottom: 20px;
		}
		.btn-submit{
			width: 150px;
		}
		.Validform_checktip{
			margin-left:0px;
			position: absolute;
		}
		.placeholder { color: #aaa; }
	</style>

</head>
<body>

	<div class="container" style="max-width: 520px">
		<h1>注册</h1>
		<form id="frmRegister" class="form-signin form-horizontal" action="/auth/reg" method="post">
			@if($ctrl->errors_has('reg'))
			<div class="form-group">
				<div>
					<div id="js-validate-alert" class="alert alert-danger alert-validate" style="margin-bottom: 0px;">
						<span class="text">{{$ctrl->errors_first('reg', ':message')}}</span>
					</div>
				</div>
			</div>
			@endif
			<div class="form-body clearfix">
				{{$ctrl->csrf_field()}}
				<input type="hidden" id="room_id" name="room_id" value="{{$roomId}}" >
				<input type="hidden" value="{{$back}}" name="back" />
				<div class="col-xs-12">
					<div class="form-group">
						<label for="name"  class="col-xs-3 control-label">
							{{ $sysConfig->reg_account_tag }}
							<span class="required">*</span>
						</label>
						<div class="col-xs-9">

							<input type="text" id="name" name="name" value="{{$ctrl->old('name')}}"  datatype='username' class="form-control" placeholder="{{ $sysConfig->reg_account_tag }}（不可输入纯数字）" value="" required autofocus></div>
					</div>

					<div class="form-group">
						<label for="password"  class="col-xs-3 control-label">
							密码
							<span class="required">*</span>
						</label>
						<div class="col-xs-9">

							<input type="password" datatype='*6-16' id="password" name="password" class="form-control" placeholder="密 码" value="" required></div>
					</div>

					<div class="form-group">
						<label for="password"  class="col-xs-3 control-label">
							确认密码
							<span class="required">*</span>
						</label>
						<div class="col-xs-9">

							<input type="password"  id="passwordConfirm"  name="passwordConfirm" recheck="password" class="form-control" placeholder="确认密码" required value=""></div>
					</div>
					<div class="form-group">
						<label  class="col-xs-3 control-label">
							QQ:
						</label>
						<div class="col-xs-9">
							<input id="email" name="qq"  type="text" value="{{$ctrl->old('qq')}}" class="form-control" placeholder="输入QQ号码" value="" />
						</div>
					</div>
					<div class="form-group">
						<label  class="col-xs-3 control-label">
							手机:
							@if($roomPower->phone_check) <span class="required">*</span> @endif
						</label>
						<div class="col-xs-9">
							<input id="mobile" name="phone" @if($roomPower->phone_check) datatype='m' @endif type="text" value="{{$ctrl->old('phone')}}" class="form-control" placeholder="输入手机号码" value="" />
						</div>
					</div>
					<div class="form-group">
						<label for="code"  class="col-xs-3 control-label">
							验证码
							<span class="required">*</span>
						</label>
						<div class="col-xs-6">

							<input type="text" id="captcha" datatype='*5-5' name="captcha" class="form-control" placeholder="验证码" required></div>
						<div class="col-xs-3" style="padding-left:0px">
							<img   id="js-validate-code" alt="看不清，请点击!!" src="/auth/captcha" height="36" width="100%" />
						</div>
					</div>
					@if($roomPower->phone_check)
					<div class="form-group" >
						<label for="code"  class="col-xs-3 control-label">
							短信码
							<span class="required">*</span>
						</label>
						<div class="col-xs-6">

							<input type="text" datatype='*6-6' id="messageCode" name="smsCode" class="form-control"  placeholder="短信验证码" required ></div>
						<div class="col-xs-3" style="padding-left:0px">
							<button type="button" style="cursor:pointer;" class=" btn btn-primary" id="sent_message_code">发送</button>
						</div>
					</div>
					@endif

				</div>
			</div>

			<div class="form-group">
			
				<div class="col-xs-12">
					<button class="btn btn-primary btn-submit" type="submit">
						注 册 <i class="icon-circle-arrow-right"></i>
					</button>
					@if($ctrl->_request('showLogin'))
			<a href="/auth/login?roomid={{$roomId}}&showReg=1&back={{$back}}">已有{{ $sysConfig->reg_account_tag }}？去登陆</a>
			@endif
				</div>
			</div>
		</form>

	</div>
	<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{$common_cdn}}/js/placeholder/jquery.placeholder.js"></script>
	<script type="text/javascript" src="{{$common_cdn}}/js/validform/validform.js"></script>

	<script>
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ $ctrl->csrf_token() }}'
        }
    });

        $(function(){
        	$('[placeholder]').placeholder();
        	$('#name').focus();
            function updateValidateCode(){
        		var dateTime = new Date().getTime();
        		$validateCode.attr('src','/auth/captcha?_t=' +  dateTime);
            }
            $validateCode = $('#js-validate-code').click(function(){
            	updateValidateCode();
        	});
            $("#frmRegister").Validform({
		        tiptype: 4,
		        ajaxPost: false,
		        datatype:{
		            qq:/^[1-9][0-9]{4,9}$/,
		            username:function(gets,obj,curform,regxp){
						if(gets.length < 2 || gets.length > 10){return false;}
						if(/[\'\"]/.test(gets)){return false;}
						if(!isNaN(gets)){return false;}
						return true;
		            }
		        },
		        beforeSubmit:function(){
		           
		        },
		        callback: function(obj) {
		            
		            
		        }
		    });
        	$('#sent_message_code').on("click", sendSMS);
        	var smsTimer;
        	var TotalMilliSeconds = 0;
        	var __sendSMS = function(option) {
	            $.ajax({
	                type: 'POST',
	                url: '/auth/sms',
	                data: {
	                    phonenum: option.phonenum,
	                    captcha: option.captcha,
	                    type:option.type,
	                    roomId:option.roomId
	                },
	                dataType: 'json',
	                async: true,
	                success: function(data) {
	                    if (data.code == 0) {
	                        if (option.suc) {
	                            option.suc(data);
	                        }
	                    } else {
	                        if (option.fail) {
	                            option.fail(data);
	                        }
	                    }
	                },
	                error: option.fail,
	            });
	        };
		    function sendSMS() {

		        if (TotalMilliSeconds > 0) return
		        var phonenum = $('#mobile').val();
		        var captcha = $('#captcha').val();
		        var reg = /^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}|17[0-9]{9}$|18[0-9]{9}$/;
		        if (!reg.test(phonenum)) {
		        	 $("#mobile").next().removeClass('Validform_right')
                     $("#mobile").next().addClass('Validform_wrong')
		        	$('#mobile').next().html('请输入正确的手机号码')
		        	
		            return;
		        }
		        if (!(captcha)) {
		        	$("#captcha").next().removeClass('Validform_right')
                     $("#captcha").next().addClass('Validform_wrong')
		            $('#captcha').next().html('请输入验证码')
		            return;
		        }
		        TotalMilliSeconds = 300;
		        __sendSMS({
		            phonenum: phonenum,
		            captcha: captcha,
		            type:"reg",
		            roomId:"{{$roomId}}",
		            suc: function(data) {
		            	
						$("#sent_message_code").attr("disabled","disabled");
		                $('#sent_message_code').html("[300]秒重发");
		                TotalMilliSeconds = 300;
		                smsTimer = setInterval(takeCount, 1000);
		            },
		            fail: function(data) {
		                updateValidateCode();
		                if(data && data.code == 301){
		                	$("#mobile").next().removeClass('Validform_right')
                     		$("#mobile").next().addClass('Validform_wrong')
		        			$('#mobile').next().html(data.msg);
		                }else{
		                   $("#captcha").next().removeClass('Validform_right')
                     		$("#captcha").next().addClass('Validform_wrong')
		        			$('#captcha').next().html(data.msg);
		                }
		                $("#sent_message_code").attr("disabled","disabled");
		                $('#sent_message_code').html("[10]秒重发");
		                TotalMilliSeconds = 10;
		                smsTimer = setInterval(takeCount, 1000);
		            }
		        })
		    }

		    function takeCount() {
		        TotalMilliSeconds--;
		        if (TotalMilliSeconds == 0) {
		            clearInterval(smsTimer);
		            $("#sent_message_code").removeAttr("disabled");
		            $('#sent_message_code').html("重发验证码");
		            return;
		        }
		        $('#sent_message_code').html("[" + TotalMilliSeconds + "]秒重发");
		    }

        });

    </script>

</body>
</html>
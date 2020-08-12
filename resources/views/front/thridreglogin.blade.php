<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="renderer" content="webkit"> 
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>跳转......</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
</head>
<body>

 @if($ctrl->errors_has('login'))
  <p id="idShow">{{$ctrl->errors_first('login', ':message')}}</p>
@else
 <p id="idShow">跳转......</p>
@endif
<form id="frm1" action="/auth/thridreglogin" method="post">
	{{$ctrl->csrf_field()}}
	<input type="hidden" value="1" name="front" />
	<input type="hidden" value="{{$back}}" name="back" />
	<input type="hidden" value="{{$room_id}}" name="room_id" />
	<input type="hidden" id="account" name="account" value="">
	<input type="hidden" id="mgr" name="mgr" value="0">
</form>
<script language="javascript">
 @if(!$ctrl->errors_has('login'))
	$.ajax({
		async:false,
		url: '{{$url}}',
		type: "GET",
		dataType: 'jsonp',
		jsonp: 'jsoncallback',
		jsonpCallback:"success_jsonpCallback",
		data: {},
		timeout: 5000,
		success: function (json) {
			if(json.code == 0){
				$('#mgr').val(json.ismgr);
				$('#account').val(json.name);
				document.getElementById("frm1").submit();//提交表单 允许进入房间
			}else if(json.code == 401){
				$('#mgr').val(0);
				$('#account').val();//account 为空以游客身份进入
				document.getElementById("frm1").submit();//提交表单 允许进入房间
			}else{
				$("#idShow").html(json.msg);//其他不允许进入房间
			}
		},
		error: function(xhr){
			$("#idShow").html("接口访问失败");
		}
	});
@endif
</script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="renderer" content="webkit"> 
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>跳转......</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

 @if($ctrl->errors_has('login'))
  <p>{{$ctrl->errors_first('login', ':message')}}</p>
@else

 <p>跳转......</p>
@endif
<form id="frm1" action="/auth/login" method="post">
	{{$ctrl->csrf_field()}}
	<input type="hidden" value="1" name="front" />
	<input type="hidden" value="{{$back}}" name="back" />
	<input type="hidden" id="name" name="login" value="{{$account}}">
	<input type="hidden" id="password" name="password" value="{{$password}}" class="form-control">
</form>
<script language="javascript">
 @if(!$ctrl->errors_has('login'))
	document.getElementById("frm1").submit();
@endif
</script>
</body>
</html>
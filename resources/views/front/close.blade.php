<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	
	<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
	<style type="text/css">
		html,body{
			padding: 0;
			margin: 0;
		}
	</style>
</head>
<body style="">
<img src="{{$img}}" width="100%">
<script type="text/javascript">
	setInterval(function(){
		$.get('/isOpend',function(resp){
			if(!resp.closed){
				window.location.reload();
			}
		})
	},5000);
</script>
</body>
</html>
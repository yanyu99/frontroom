<!DOCTYPE html>
<html >
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/css/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/css/view/main/nopassword.css">
<body>
	<div class="container goin-room">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3 ">
				<h1>
					<img src="" style="max-width: 240px; min-width: 120px;" />
				</h1>
				@if($ctrl->errors_has('room'))
				<div class="alert alert-warning alert-dismissible fade in" role="alert"> <strong>错误:</strong>
					{{$ctrl->errors_first('room', ':message')}}
				</div>
				@endif
				<form id="goin-form" class="form-signin form-horizontal">
					<div class="form-group">
						<div class="col-xs-12">
							<label for="name" class="sr-only">房间名</label>
							<div class="input-group input-group-lg">
								<input type="text" class="form-control" id="roomName" name="roomName" value="" placeholder="请输入房间号码">
								<span class="input-group-btn">
									<button class="btn btn-default" type="submit">进入房间</button>
								</span>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#goin-form').submit(function(){
				var roomName = $('#roomName').val();
				window.location.href = 'http://{{$site_domain}}/v/'+ roomName;
				return false;
			});
		});
	</script>
</body>
</html>
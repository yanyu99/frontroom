<!DOCTYPE html>
<html>
<head>
	<title>用户设置</title>
	<meta name="renderer" content="webkit"> 
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/css/font-awesome/css/font-awesome.css">

	<style type="text/css">
		body{
			font: 14px/1.4 'STHeiti','Microsoft YaHei','宋体','arial';
	    	background: #fff;
		}
		h1{
			color: #0062b4;
    		border-bottom: 1px solid #ddd;
    		padding-bottom: 5px;
    		font-size: 18px;
		}
		.form-body{
			border-radius: 5px;
			margin-bottom: 75px;
			padding: 0 15px 0;
		}
		
		.form－action{
			position: fixed;
			bottom: 0;
			left: 15px;
			background: #f7f8fa;
			width: 100%;
			padding: 15px;
			margin: 0;
		}
	</style>

</head>
<body>

	<div class="container">
		<form id="js-data-form" class="form-signin form-horizontal form-body" action="/chat/turnmsg/{{$roomId}}" method="post">
		{{$ctrl->csrf_field()}}
		@foreach($messageIds as $id)
			<input type="hidden" name="messageIds[]" value="{{$id}}">
		@endforeach
			@foreach($rooms as $room)
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<div class="checkbox">
						<label>
							<input id="js-roomIds-{{$room->id}}" name="roomIds[]" type="checkbox" value="{{$room->id}}" @if($room->id == $roomId) disabled="disabled" @elseif(in_array($room->id,$roomIds)) checked @endif/>
										{{$room->name}} @if($room->id == $roomId)
							<span>(当前房间)</span>
							@else
							<span>({{$room->f_name}})</span>
							@endif
						</label>
					</div>
				</div>
			</div>
			@endforeach
			<div class="form-group form-action">
				<div class="col-xs-12">
					<button class="btn btn-md btn-primary btn-submit" type="submit">转播消息</button>
				</div>
			</div>
		</form>

	</div>

	<script type="text/javascript" src="{{$common_cdn}}/js/sha1.js"></script>
	<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="{{$common_cdn}}/js/jquery.ajaxForm-3.51.0/jquery.form.js"></script>


	<script>
        $(function(){
        	var ROOMID_SELECTED = "roomid_selected";
        	if(window.localStorage){  //或者 window.sessionStorage     
        		var roomids = localStorage.getItem(ROOMID_SELECTED);
        		if(roomids){
        			roomids = roomids.split(',');
        			$(roomids).each(function(index){
        				$('#js-roomIds-' + this).attr('checked', true);
        			});
        		}
        	}
        	
			$('#js-data-form').ajaxForm({
				dataType : 'json',
				success	: function(data){
					if(window.localStorage){
						var roomIds = [];
						$('input[name="roomIds"]:checked').each(function(){
							roomIds.push(this.value);
						});
						localStorage.setItem(ROOMID_SELECTED, roomIds);
					}
					
					if(data.code == 0){
						//parent.window.location.reload();
						if(parent.window.shareChatDialogCallback){
							parent.window.shareChatDialogCallback();
						} else {
							parent.window.location.reload();
						}
					}else{
						alert(data.msg);
					}
				},
				error : function(error){
					$('.btn-submit').removeAttr("disabled","disabled"); 
					console.log(error.status + ' error');
				}
			});
			
			$('.btn-submit').click(function(){
				setTimeout(function(){
					$(this).attr("disabled","disabled");
				},50);
			});
		});
	</script>

</body>
</html>
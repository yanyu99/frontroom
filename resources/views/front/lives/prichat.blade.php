



<!DOCTYPE html>
<html>
<head>
	<title>私信</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" >
	<meta http-equiv="Content-Type"  content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/css/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/jquery.sina-emotion.2.0.1/sina-emotion.css">

	<link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/css/view/main/chat.css">
	<link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/css/view/main/private-message.css">
	
</head>
<body>
	

<div class="ly-left nice-scroll">
	<ul class="user-list list-unstyled">
	</ul>
</div>

<div class="ly-right">
	<div class="ly-header">
		<div class="current-user-info">
			<div class="name">{{$toUser->name}}</div>
			<div class="description text-muted"></div>
		</div>
	</div>
	
	<div class="ly-body">
		 <div class="tab-content">
		  </div>
	</div>
	<!--
	<div class="ly-sider nice-scroll">
		<div class="to-user-info">
			<img class="img-circle img-thumbnail user-pic " src="{{$toUser->pic}}" alt="user">
			<label class="name">{{$toUser->name}}</label>
			<div class="description text-muted">
			</div>
		</div>
	</div>
	-->
	<div class="ly-footer">
		<form class="private-chat-form">
			<div class="private-chat-form-exFun">
				<span id="js-chat-faces-btn" class="private-chat-form-exFun-item private-icon-smile">
					表情
				</span>
				<span id="js-chat-picture-btn" class="private-chat-form-exFun-item private-icon-pic">
					图片
				</span>
			</div>
			<div class="private-chat-form-input-wrap">
				<textarea class="private-chat-form-input nice-scroll" id="js-chat-form-input" tabindex="10"></textarea>
			</div>
			<div class="chat-form-op">
				<button type="button" class="btn private-chat-form-btn send-btn" id="js-send-btn">发送</button>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery.nicescroll-3.6.0/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery.sina-emotion.2.0.1/sina-emotion.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/uploadify-2.2/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/moment.min.js"></script>>
<script type="text/javascript" src="{{$common_cdn}}/js/jsrender-1.0.0/jsrender.min.js"></script>

<script id="js-chat-message-tmpl" type="text/x-jsrender">
<div class="chat-message @{{>meClass}} clearfix" id="messages-@{{>id}}">
	<span class="dropdown chat-message-avatar" style="width:84px">
		@{{if meClass}}
		<span  style="color:#ccc;margin-left:5px;">@{{>time}}</span>
		@{{/if}}
		<img src="@{{>pic}}" alt="user">
		@{{if !meClass}}
		<span style="color:#ccc;">@{{>time}}</span>
		@{{/if}}
	</span>
	<div class="chat-message-content" style="margin-top:6px;">
		<div class="chat-message-context">
			<i class="chat-message-context-caret"></i>
			<span>@{{>message}}</span>
		</div>
	</div>
</div>
</script>

<script id="js-chat-tab-pane-tmpl" type="text/x-jsrender">
<div role="tabpanel" class="tab-pane nice-scroll" data-name="@{{>name}}" data-uid="@{{>uid}}" id="@{{>uid}}"></div>
</script>

<script id="js-chat-user-item-tmpl" type="text/x-jsrender">
<li class="user-item" role="presentation">
	<a href="#@{{>uid}}" aria-controls="@{{>name}}" role="tab" data-toggle="tab" data-uid="@{{>uid}}" data-name="@{{>name}}" data-description="@{{>description}}" data-avatar="@{{>pic}}">
		<img class="img-circle user-pic" src="@{{>pic}}" alt="user">
		<span class="text">@{{>name}}</span>
		<span class="status-online"></span>
		<span class="status-message"></span>
	</a>
	<i class="icon-times user-delete" data-uid="@{{>uid}}" data-name="@{{>name}}">x</i>
</li> 	
</script>

<script type="text/javascript">
var TIME_FORMAT = 'HH:mm';
var KEY_ENTER = 13;
var $CHAT_MESSAGE = $('#js-chat-message-tmpl');
var $CHAT_USER_ITEM = $('#js-chat-user-item-tmpl');
var $CHAT_TAB_PANE = $('#js-chat-tab-pane-tmpl');


var toUid = {{$toUser->uid}};
var selfUid = {{$user->uid}};
var screenLockStatus = 0;
var deskTopNotice = false;


$(function(){
	setSiderBarUserItem({uid:{{$toUser->uid}},name:'{{$toUser->name}}',pic:'{!!$toUser->pic!!}',active:1})
})
//私聊消息发送
function sendPrivateMessage() {
	var $chatInput = $('#js-chat-form-input');
    var message = $.trim( $chatInput.val() );
    var jsonObject = {msg: message, toUid: toUid};
    if(message.length > 0) {
    	sendPrichat(jsonObject);
    }
}

function sendPrichat(jsonObject){
	$.post('/chat/prichat/{{$roomId}}',jsonObject, chatBack);
}
function chatBack(data) {
	if(data.code != 0){
		//alert(data.msg);
	}else{
		var $chatInput = $('#js-chat-form-input');
		var message = $.trim( $chatInput.val() );
		$chatInput.val('');
		var $domWrap = $('.tab-content .tab-pane[data-uid="'+ toUid +'"]');
		output($domWrap, {
			name: '{{$fromUser->name}}',
			pic: '{{$fromUser->pic}}',
			meClass: 'chat-me',
			message: message,
			time:data.time
		});
		setTimeout(function(){
			$domWrap.scrollTop($domWrap[0].scrollHeight);
		}, 100);
	}
}
function onPrivateChatEvent(data){
	if(data.uid != '{{$fromUser->uid}}'){
		if(data.message){
			var $domWrap = $('.tab-content .tab-pane[data-uid="'+ data.uid +'"]');
			data.time = moment().format(TIME_FORMAT);
			output($domWrap, data);
			
			setTimeout(function(){
                $domWrap[0] && $domWrap.scrollTop($domWrap[0].scrollHeight);
			}, 100);
		}
		setSiderBarUserItem(data);
	}
}

function setSiderBarUserItem(data){
	var $domWrap = $('.tab-content .tab-pane[data-uid="'+ data.uid +'"]');
	
	if($domWrap.length == 0){
		$('.tab-content').append($CHAT_TAB_PANE.render(data));
		$('.user-list').append($CHAT_USER_ITEM.render(data));
		$domWrap = $('.tab-content .tab-pane[data-uid="'+ data.uid +'"]');
		
		$domWrap.niceScroll({
			cursorborder:'',
			cursorcolor:'#999',
			boxzoom:false
		});
		$.get('/chat/prichathistory/{{$roomId}}', { 'toUid': data.uid }, function(rsp){
			if(rsp.code != 0 )return;
			$.each(rsp.list, function (n, value) {
				if(value.snd_uid == selfUid){
					value.meClass = 'chat-me';
					value.uid = value.snd_uid;
					value.pic = '{{$user->pic}}';
					value.name = '{{$user->name}}';
				}else{
					value.uid = value.snd_uid;
					value.pic = data.pic;
					value.name = data.name;
				}
				outputHistory($domWrap, value);
			});
			setTimeout(function(){
				$domWrap.scrollTop($domWrap[0].scrollHeight);
				$('.tab-content .tab-pane[data-uid="'+ data.uid +'"]');
			}, 100);
		});
	}

	if(data.active){
		$('.user-list a[data-uid="'+ data.uid +'"]').click();
	}else{
		if(data.uid != toUid && data.message){
			$('.user-list a[data-uid="'+ data.uid +'"]').find('.status-message').addClass('active');
		}
	}
}

function outputHistory($domWrap, message) {
	$('#messages-'+message.id).remove();
	$domWrap.prepend($CHAT_MESSAGE.render(message)).parseEmotion();
}
function output($domWrap, message) {
	$('#messages-'+message.id).remove();
	$domWrap.append($CHAT_MESSAGE.render(message)).parseEmotion();
}

$(function(){
	var $chatCurrentUserInfo = $('.current-user-info');
	$('.user-list').delegate('a[data-toggle="tab"]', 'click', function (e) {
		var $this = $(this);
		var uid = $this.data('uid');
		var name = $this.data('name');
		var avatar = $this.data('avatar');
		var description = $this.data('description');
		var hashId = $this.attr('href');
		
		$this.find('.status-message').removeClass('active');
		$chatCurrentUserInfo.find('.name').text(name);
		$chatCurrentUserInfo.find('.description').text(description);
		$('.tab-content').find('.tab-pane').removeClass('active');
		$(hashId).addClass('active');
		
		//$('.ly-sider .to-user-info .img-circle').attr('src', avatar);
		//$('.ly-sider .to-user-info .name').text(name);
		//$('.ly-sider .to-user-info .description').text(description);
		
		window.toUid = uid;
	});
	
	$('.nice-scroll').niceScroll({
		cursorborder:'',
		cursorcolor:'#999',
		boxzoom:false
	});
	
	$('#js-chat-form-input').keyup(function (event) {
	    if (event.keyCode == KEY_ENTER) {
	    	sendPrivateMessage();
	    }
	}).focus();

	$('#js-send-btn').click(function(){
		sendPrivateMessage();
	});

	$.fn.sinaEmotion.options = {
	    rows: 72,           
	    language: 'cnname',   
	    appKey: '1362404091' 
	};
	$('#js-chat-faces-btn').click(function(event){
	    $(this).sinaEmotion('#js-chat-form-input');
	    event.stopPropagation();
	});
	
	var _init = false;
	$("#js-chat-picture-btn").click(function(){
		if(!_init){
			$("#js-chat-picture-btn").uploadify({
		        height        : 32,
		        width         : 32,
		        buttonImage: null,
		        swf: '/assets/js/uploadify-2.2/uploadify.swf',
				uploader: '/ajaxUpload?dir=chatpic',
		        fileTypeDesc  : 'Image Files',
		        fileSizeLimit : '1024K',
		        fileTypeExts  : '*.gif; *.jpg; *.png',
		        onUploadSuccess : function(file, data, response) {
		        	data = $.parseJSON(data);
		        	var text = '['+ data.img +']';
		        	var _input = $('#js-chat-form-input')[0];
		        	if (document.selection) {
		        		_input.focus();
						var cr = document.selection.createRange();
						cr.text = text;
						cr.collapse();
						cr.select();
					} else if (_input.selectionStart !== undefined) {
						var start = _input.selectionStart;
						var end = _input.selectionEnd;
						_input.value = _input.value.substring(0, start) + text + _input.value.substring(end, _input.value.length);
						_input.selectionStart = _input.selectionEnd = start + text.length;
					} else {
						_input.value += text;
					}
		        }
		    });
			_init = true;
		}
	});
    
    $('.ly-left').delegate('.user-delete','click', function(){
    	var $this = $(this);
    	$this.parent().remove();
		$('.tab-content .tab-pane[data-uid="'+ $this.data("uid") +'"]').remove();
	});
});
</script>



</body>
</html>
<!DOCTYPE html>
<html>
<head>
   <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta content="width=device-width, initial-scale=0.4,user-scalable=no,minimum-scale=0.4,maximum-scale=0.4" name="viewport">
	<title></title>
	<style type="text/css">
	html,body{

		margin: 0;
		padding: 0;
		overflow:hidden;
		background: rgba(0,0,0,0);
		color:#333;
	}
	body {

	font: 14px/1.4 'STHeiti', 'Microsoft YaHei', 'arial';
}
.right{
	float: left;
	margin-top: 116px;
	    margin-left: 43px;
	    height: 275px;
	    overflow:hidden;
}
	#idTable {

	    width: 283px;
	    color: #fff;
	}
	#idTable  td{
		padding: 3px 2px;
	}
		.bg{

			width:800px;
			height: 479px;
			background-repeat: no-repeat;
			background-image: url("{{$cdn}}/assets/img/fortune/bg2.png");
			overflow:hidden;
		}
		.yuan{
			margin-top:13px;
			margin-left: 13px;
			width:452px;
			height: 452px;
			overflow:hidden;
			background-image: url("{{$cdn}}/assets/img/fortune/yuan.png");
			position: relative;
			float: left;
		}
		.chou{
			background-image: url('{{$cdn}}/assets/img/fortune/img01.png');
			width: 134px;
			height: 171px;
			margin-top: 124px;
    		margin-left: 159px;
    		cursor: pointer;
		}
		.gift{

		    width: 106px;
		    height: 98px;
		    margin-top: 122px;
		    margin-left: 26px;
		    transform: rotate(-67deg);
		    background-size: 106px 98px;
		}
		.item{
			width:100%;height:100%;overflow:hidden;
			position: absolute;
			top: 0px;
			left: 0px;
		}
    
		@foreach($lists as $value)
		.item-{{$value->id}}{
			transform: rotate({{($value->id+1)*45}}deg);
		}
		.gift-{{$value->id}}{
			background-image: url('{{$value->imgurl}}');
		}
		@endforeach


		@keyframes animated_div
		{
			@for($i=0;$i <= 10;++$i)
			{{$i*10}}%	{transform: rotate({{$i*36}}deg);}
			@endfor
		}
		.transition-fast{
			transition: All 1s ease-in-out;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/artDialog/css/ui-dialog.css">
	<style type="text/css">
		.ui-dialog{
		border: 1px solid rgba(0,0,0,0);
		overflow: hidden;
	}
	.notitle-dialog{border: none;    overflow: inherit;}
	.ui-popup-modal .notitle-dialog-new{
		box-shadow:none;
	}
	.ui-popup-focus  .notitle-dialog-new{
		box-shadow:none;
	}
	.notitle-dialog-new{border: none;    overflow: inherit;background: rgba(0,0,0,0)}
	.notitle-dialog-new td.ui-dialog-header,.notitle-dialog td.ui-dialog-header {border-bottom: none;}
	.notitle-dialog-new .ui-dialog-title,.notitle-dialog .ui-dialog-title{display: none;}
	.nobg-dialog{
		background-color: transparent;
	}
	.ui-dialog-close{
		    top: 13px;
    right: 13px;
		position: absolute;
		opacity:1;
		z-index: 5;
		display: block;
		color: rgba(0,0,0,0);
	    width: 23px;
	    height: 23px;
	    background: url({{$cdn}}/assets/v2/img/v2/close.png) no-repeat;
	}
 	.notitle-dialog .ui-dialog-close{
		top: -15px;
		right: -15px;
		position: absolute;
		opacity:1;
		z-index: 5;
		display: block;
		color: rgba(0,0,0,0);
	    width: 36px;
	    height: 36px;
	    background: url({{$cdn}}/assets/img/sprite.png) no-repeat;
	}
	.notitle-dialog-new .ui-dialog-close{
		top: 41px;
		right: -15px;
		position: absolute;
		opacity:1;
		z-index: 5;
		display: block;
		color: rgba(0,0,0,0);
	    width: 36px;
	    height: 36px;
	    background: url({{$cdn}}/assets/img/sprite.png) no-repeat;
	}

	.ui-dialog-close:hover, .ui-dialog-close:focus{
		opacity: 1;
	}
	.ui-dialog-header {
	    padding: 0;
	    border: 0 none;
	    text-align: left;
	    background: #2E6DD6;
	    color: #fff;
	}
	</style>
</head>
<body>
	<div class="bg">
		<div class="yuan">
			@foreach($lists as $value)
			<div class="item item-{{$value->id}}">
				<div class="gift gift-{{$value->id}}"></div>
			</div>
			@endforeach
			<div class="item " id="idChou">
			<div class="chou"></div>
			</div>
		</div>
		<div class="right">
			<table id="idTable">
				<tbody>
				@foreach($backList as $value)
				<tr><td>{{ $jfConfig->jf_hide_user ? $value['fixed_nick'] : $value['nick'] }}</td><td>{{$value['dsc']}}</td></tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="{{$common_cdn}}/js/artDialog/dialog-min2.js"></script>

	<script type="text/javascript">
		var CONF_JF_HIDE_USER = '{{$jfConfig->jf_hide_user}}';
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': '{{ $ctrl->csrf_token() }}'
	        }
	    });
	    var __runing__ = false;
		$('.chou').click(function(){
			if(__runing__)return;
			__runing__ = true;
			$('#idChou').css('transition',"none");
			$('#idChou').css('transform',"rotate(0deg)");
			$.post("/fortune/got",{},function(resp){
				if(resp.code == 0){
					run(resp.got);
				}else{
					setTimeout(function(){
						__runing__ = false;
					},500);
					if(resp.code == 401 && window.parent.showLoginDialog){
						window.parent.showLoginDialog();
					}else{
						 dialog({title:"提示",content:resp.msg,quickClose: true}).show();
					}
				}
			})
		});
		function run(id){
			var numSecond = parseInt( Math.random()* 5 + 4 );
			$('#idChou').css('transition',"All "+numSecond+"s cubic-bezier(0.82, 0.3, 0, 0.46)");
			var num =  parseInt( Math.random()* 8 + 3 );
			var rotate = num* 360 + (id-1) * 45 + parseInt( Math.random()*35 + 4);
			$('#idChou').css('transform',"rotate("+rotate+"deg)");
			setTimeout(function(){
				__runing__ = false;
				$.post("/fortune/gotresult",{id:id},function(resp){
					if(resp.code == 0){
						dialog({title:"提示",content:'恭喜你' + resp.result.dsc + '，请联系官方客服。',quickClose: true}).show();
					}
				});
			},(numSecond)*1000);
		}
		function onRecvMsg(data){  // 未使用
			if(data.cmd == "cmd_fortune"){
			    var nick = CONF_JF_HIDE_USER ? data.fixed_nick : data.nick ;
				$("#idTable tbody").append("<tr><td>"+nick+"</td><td>"+data.dsc+"</td></tr>")
			}
		}
		setInterval(function(){
			var scrollHeight = $(".right")[0].scrollHeight;
			var height = $(".right").height();
			var df = scrollHeight - height;
			var st = $(".right").scrollTop();
			if(df > st){
				$(".right").scrollTop(st+2);
			}

		},100)
	</script>
</body>
</html>
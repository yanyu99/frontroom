<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body{
			background-image: url({{$cdn}}/assets/img/fxts/bg.png);
			    background-repeat: no-repeat;
			    width: 450px;height:308px;margin: 0px;
			    position: relative;
		}
		.title{
			margin-left: 68px;
			margin-top: 14px;
			font-size: 20px;
			color: #fff;
			display: inline-block;
		}
		.content{
			color: red;
			padding: 50px 40px 10px 40px;
		}
		.btn{
			background-image: url({{$cdn}}/assets/img/fxts/ok.png);
			background-repeat: no-repeat;
			    padding: 14px 43px;
			    position: absolute;
			    bottom: 22px;
			    right: 22px;


		}
		.btn1{
			background-image: url({{$cdn}}/assets/img/fxts/ok1.png);
			background-repeat: no-repeat;
			    padding: 14px 43px;
			    position: absolute;
			    bottom: 22px;
			    right: 22px;


		}
		.checkbox{
		 	position: absolute;
		    bottom: 27px;
		    right: 120px;
		    color: #666;
		}
	</style>
</head>
<body style="">
<span class="title">风险提示</span>
@if($allow)
<div class="content">您即将游览的建议是讲师个人对市场的分析和解读，仅供学习交流使用，不构成操作依据，投资有风险，入市需谨慎。
      客户的成交单据必须是建立在自己的自主决定之上。交易所、会员单位（及其分支机构）及前述主体的工作人员提供的任何关于市场的分析和解读，仅供客户参考，不构成任何要约。由此而造成的交易风险由客户自行承担。</div>
      <div class="checkbox" ><input id="idCheck" onclick="onChange()"  type="checkbox" name="">我已阅读并同意</div>
<a id="idBtn" href="javascript:;" class="btn1" onclick="onOk()"></a>
@else
<div class="content" style="font-size: 18px;color: red;">
	对不起，你没有权限查看操作建议，请联系房间助理
</div>
@endif
</body>
@if($allow)
<script type="text/javascript">
function onChange(){
	if(document.getElementById('idCheck').checked){
		document.getElementById('idBtn').className = "btn"
	}else{
		document.getElementById('idBtn').className = "btn1"
	}
}
	function onOk() {
		if(!document.getElementById('idCheck').checked){
			return;
		}
		@if($chosed)
		window.parent.followDialogClose(true);
		@else
		window.location.href = "/iframe/follow/{{$roomId}}";
		@endif
	}
</script>
@endif
</html>
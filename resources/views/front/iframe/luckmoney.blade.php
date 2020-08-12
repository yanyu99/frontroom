<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
	body{
		padding: 0px;
		margin: 0px;
	}
	.box{
		width:360px;
		height: 510px;
		background-image: url("{{$cdn}}/assets/img/luckmoney/bg.png");
	}
	.form-label{
		font-size: 14px;
		color: #444;
		font-weight: bold;
	}
	.form-control{

	    width: 160px;
	    height: 24px;
	    padding: 2px 12px;
	    font-size: 14px;
	    line-height: 1.42857143;
	    color: #555;
	    background-color: #fff;
	    background-image: none;
	    border: 1px solid #ccc;
	   border-radius: 4px;
	}
	.box-form{
		padding-left: 60px;
		padding-top: 154px;
		width: 240px;
	}
	.from-group{
		margin-top: 20px;
	}
	.btn-submit{
		width: 105px;
		height: 34px;
	    border: none;
		border-radius: 5px;
		margin-left:67px;
		margin-top: 10px;
		background-image: url('/assets/img/luckmoney/send.png')
	}
	.money-warp h1{
		color: red;
		margin: 10px 0px;
	}
	.money-warp h4{
		margin: 10px 0px;
	}
	</style>
</head>
<body>
<div class="box">
	<div class="box-form">
	<form id="js-data-form" method="post" action="/luckmoney/send/{{$roomId}}">
	{{$ctrl->csrf_field()}}
		<div class="from-group">
			<label for="name" class="form-label">
				金额：
			</label>
			<input type="text" id="moneyInput"  onkeyup='this.value=this.value.replace(/\D/gi,"")'  name="money" value="1" class="form-control" required autofocus>
		</div>

		<div class="from-group">
			<label for="name"  class="form-label">
				个数：
			</label>
			<input type="text" name="num" value="1"   onkeyup='this.value=this.value.replace(/\D/gi,"")' class="form-control" required >
		</div>
		<div class="from-group">
			<label for="name" style="vertical-align:27px;" class="form-label">
				备注：
			</label>
			<textarea type="text" style="height: 50px;resize:none;"  name="text" class="form-control" required >恭喜发财</textarea> 
		</div>
		<div class="money-warp">
			<h1 id="idMoney" style="text-align: center;">￥1</h1>
			<h4 style="text-align: center;">余额￥{{$money}}@if($money <= 0)，今日红包已经发送完了@endif</h4>
		</div>
		<button class="btn-submit" @if($money <= 0 ) disabled @endif></button>
	</form>
	</div>
</div>
@if($money > 0)
<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="{{$common_cdn}}/js/jquery.ajaxForm-3.51.0/jquery.form.js"></script>
<script type="text/javascript">
var leftMoney = {{$money}};
$('#moneyInput').change(function(){
	$('#idMoney').html("￥"+$(this).val());
})
	$('#js-data-form').ajaxForm({
		dataType : 'json',
		success	: function(data){
			if(data.code == 0){
				if(parent.window.sendLuckMoneyCallback){
					parent.window.sendLuckMoneyCallback();
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
		console.log('disabled');
		setTimeout(function(){
			$(this).attr("disabled","disabled");
		},50);
	});
</script>
@endif
</body>
</html>
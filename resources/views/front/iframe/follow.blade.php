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
			color: #666;
			padding: 50px;
		}
		.btn{
			background-image: url({{$cdn}}/assets/img/fxts/ok.png);
			background-repeat: no-repeat;
			    padding: 14px 43px;
			    position: absolute;
			    bottom: 22px;
			    right: 22px;
			    border: none;


		}
	</style>
	<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
</head>
<body style="">
<span class="title">请选择老师</span>
 <form  method="post" action="/live/follow">
<div class="content">

	@foreach($teachers as $value)
	 <input  class="mycheckbox"  type="checkbox" value="{{$value->id}}" name="tids[]"  @if(isset($tidMap[$value->id])) checked @endif>
      <span>{{$value->name}}</span>
	@endforeach

</div>
<button class="btn" type="submit"></button> 
</form>
</body>
<script type="text/javascript">
	var max = '{{$follow_num}}';
  $('.mycheckbox').click(function(){
    var num = 0;
    $('.mycheckbox').each(function(){
      if( $(this).is(':checked') ){
        num++;
      }
    })
    if(num > max){
      alert("对不起，你只能选择" + max + "个项目!");
      $(this).prop("checked",false);
    }
  })
</script>
</html>
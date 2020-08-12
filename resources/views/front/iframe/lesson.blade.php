<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta content="width=device-width, initial-scale=1,user-scalable=no,minimum-scale=1.0,maximum-scale=1.0" name="viewport">

	<title></title>
	<style type="text/css">
	
	@if(!$mobile)html,body{overflow:hidden;width:100%;height:100%}@endif 
	
body{margin:0 auto;padding:0;word-wrap:break-word;font-size:14px;font-family:"Microsoft YaHei",Arial,Helvetica,sans-serif;word-break:break-all}
div,form,h1,ol,ul,li,dl,dt,dd,h2,h3,h4,h5,h6,span,p,img{margin:0;padding:0;border:0}
img{vertical-align:middle}
fieldset{border:none 0}
a{outline:0;text-decoration:none}
a:hover{text-decoration:underline;star:expression(this.onFocus = this.blur())}
:focus{outline:0}
li{list-style:none}
input,label,select,option,textarea,Chat_Send_Msg button,fieldset,legend{font-size:14px;font-family:"Microsoft YaHei",Arial,Helvetica,sans-serif}
.clear{line-height:0;font-size:0;clear:both;height:0}
.clearfix:before,.clearfix:after{ 
    content:""; 
    display:table; 
} 
.clearfix:after{clear:both; } 
.clearfix{ 
    *zoom:1;/*IE/7/6*/
}
html[xmlns] .clearfix{display:block;}
*html .clearfix{height:1%;}
html[xmlns] .clearfix{display:block}
* html .clearfix{height:1%}
.fl{float:left}
.fr{float:right}
		.jg_kcb{ width:100%; background:url(@if(!$sysConfig->lessonImg){{$cdn}}/assets/img/kcgg.png?1 @else {{$sysConfig->lessonImg}} @endif) repeat-y; background-size:100% 100%; padding:20px 0; @if(!$mobile)height:100%;@endif }
		


		.jg_kcb h2{ text-align:center; font-size:32px; text-align:center; color:#fff; font-weight:normal;}
		.jg_kcb_list { padding:20px 0;background:url({{$cdn}}/assets/img/zbkcb.png) no-repeat center top; margin-top:20px;}
		.jg_kcb_list_nr{ width:450px; margin:0 auto;}
		.jg_kcb_list_fl{ width:175px; text-align:right;}
		.jg_kcb_list li{ line-height:35px; text-align:center; color:#fff; font-size:16px;}
		.jg_kcb_span{ padding:0 15px;}
		.jg_kcb_color{ color:#ff0;}
		.jg_tecer{ width:65px; display:inline-block; text-align:left;}
@media screen and (max-width: 500px){
		.jg_kcb h2{ text-align:center; font-size:24px; text-align:center; color:#fff; font-weight:normal;}
		.jg_kcb_list { padding:20px 0;background:url({{$cdn}}/assets/img/zbkcb.png) no-repeat center top; margin-top:20px;}
		.jg_kcb_list_nr{ width:319px; margin:0 auto;}
		.jg_kcb_list_fl{ width:123px; text-align:right;}
		.jg_kcb_list li{ line-height:35px; text-align:center; color:#fff; font-size:14px;}
		.jg_kcb_span{ padding:0 2px;}
		.jg_kcb_color{ color:#ff0;}
		.jg_tecer{ width:56px; display:inline-block; text-align:left;}
}
	</style>
</head>
<body>
<div class="jg_kcb">
	<h2 id="div_title">{{date("m月d日")}}{{$sysConfig->lesson_pre}}</h2>
	<div class="jg_kcb_list">
		<ul id="courseMt">
		@foreach($lessons as $lesson)
			<li>
			    <div class="clearfix jg_kcb_list_nr">
			        <div class="fl jg_kcb_list_fl clearfix">
			            <div class="jg_tecer fl @if($lesson->type > 0)jg_kcb_color @endif">@if($lesson->$teacher){{$lesson->$teacher->name}} @endif</div>
			            <div class="fr @if($lesson->type > 0)jg_kcb_color @endif">{{$lesson->$title}}</div>
			        </div>
			        
			        <div class="fl">
			        <span class="jg_kcb_span">●</span> 
			        直播时间：
			        <span data-sat="{{$lesson->s_at}}" data-eat="{{$lesson->e_at}}" data-dsc="{{$lesson->$dsc}}"  class="jg_kcb_color lesson-time">
			        @if($lesson->$dsc)
			        {{$lesson->$dsc}}
			        @else
			        @if($lesson->s_at <= date("H:i") && $lesson->e_at >= date("H:i"))
			        正在直播中
			        @else
			        {{$lesson->s_at}}-{{$lesson->e_at}}
			        @endif
			        @endif
			        </span></div>
			    </div>
			</li>
    	@endforeach
		</ul>
	</div>
</div>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
<script type="text/javascript">
	setInterval(function(){
		
		$.each($('.lesson-time'),function(){
			if($(this).data('dsc') != ""){
				return;
			}
			var sat = $(this).data('sat');
			var eat = $(this).data('eat');
			var now = new Date();
			var hour = now.getHours();
			var minute = now.getMinutes();
			if(hour < 10){
				hour = "0"+hour;
			}
			if(minute < 10){
				minute = "0"+minute;
			}
			var cur =  hour + ":" + minute;
			if(cur >= sat && cur <= eat){
				$(this).html("正在直播中");
			}else{
				$(this).html(sat+"-"+eat);
			}
		})
	},1000);
	$(".jg_kcb").resize(function(){
		window.parent.setIframeHeight($(".jg_kcb").height());
	})
</script>
</body>
</html>
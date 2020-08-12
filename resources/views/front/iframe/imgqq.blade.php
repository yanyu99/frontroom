<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
	html,body{overflow:hidden;width:100%;height:100%}
	body{margin:0 ;padding:0;word-wrap:break-word;font-size:14px;font-family:"Microsoft YaHei",Arial,Helvetica,sans-serif;word-break:break-all}
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
	.tan_qq1 li {margin-right:12px;float: left;}
	</style>
</head>
<body style="width: 800px;height: 300px;position: relative;">
<img src="{{$img}}" width="100%" height="100%">
<div class="tan_qq1" style="position: absolute;top: 220px;left: 92px;width: 576px;">
	{{-- */$i=0;/* --}}
@foreach($qqs as $value)
@if(++$i <= 12)  
    <li>
        <a href="http://wpa.qq.com/msgrd?v=3&amp;uin={{$value->qq}}&amp;site=qq&amp;menu=yes" target="_blank">
        	<img src="{{$cdn}}/assets/img/qq_ico1.png">
        </a>
    </li>
@endif
@endforeach
</div>
</body>
</html>
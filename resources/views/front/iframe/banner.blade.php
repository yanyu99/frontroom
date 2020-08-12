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
	
	.banner-num {
		position: absolute;
		bottom: 0px;
		left: 50%;
		z-index: 999;
	}
	.banner-num ul {
		overflow: hidden;
	}


	.banner-num li {
		color: transparent;
		float: left;
		margin-left: 6px;
		cursor: pointer;
		width: 30px;
		height: 30px;

		background-image: url({{$cdn}}/assets/img/brand/tap-normal.png);
	}
	.banner-num li.on {
		background-image: url({{$cdn}}/assets/img/brand/tap-active.png);
	}
	</style>
</head>
<body >
<div style="width: {{$width}}px;height: {{$height}}px;position: relative;">
	<ul id="Ul_dscontent" class="dscontent">
		@foreach($imgurls as $key =>$value)
		<li style="width: 100%; display: none;">
			<img style="height: auto; width: {{$width}}px;height: {{$height}}px;" src="{{$value}}"></li>
		@endforeach
	</ul>
	<div class="banner-num" >
		<ul id="Ul_Pop" style="margin-bottom:0px;margin-left: -50%" >
			@foreach($imgurls as $key => $value)
			<li @if($key == 0) class="on" @endif data-id='{{$key}}' ></li>
			@endforeach
		</ul>
	</div>
</div>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(function(){
		var bannerIndex = 0;
	    var $popLi = $('#Ul_Pop li');
	    var $dscontentLi = $('#Ul_dscontent li');
	    var max = $popLi.length;
	    var bannerInterval = setInterval(function() {
	        bannerIndex = (bannerIndex+1) % max;
	        setBannerNum(bannerIndex);
	    }, 10000);
	    
	    var setBannerNum = function(num) {
	        $popLi.removeClass('on');
	        $popLi.eq(num).addClass('on');
	        $dscontentLi.hide();
	        $dscontentLi.eq(num).show();
	    };
	    setBannerNum(bannerIndex);
	    $popLi.click(function() {
	        var $this = $(this);
	        setBannerNum(parseInt($this.attr("data-id")));
	    });
	})
</script>
</body>
</html>
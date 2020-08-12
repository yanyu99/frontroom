
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>

	<style>
*{padding:0;margin:0;font-family:Tahoma,"Microsoft Yahei",Simsun,Arial,Helvetica,sans-serif;}
body{overflow: hidden;}
li{list-style:none;}
img{border:none;}
a{text-decoration:none;}
.clear{clear:both}
.fl{float:left;}
.fr{float:right;}

/**/

@if($agree_opend)
#dialog{width: 920px; height: 594px;margin:0px auto}
@else
#dialog{width: 920px; height: 448px;margin:0px auto}
@endif
#dialog .dialog-content{width: 100%;height: 100%;overflow: auto;background-color: #f7f1eb;border-radius: 5px;}
#experts{margin: 20px 20px 0;border: 1px solid #002e66;    overflow: hidden;}
.experts_btns{background: #162b40;color: #fff;font-size: 18px;height: 48px;line-height: 48px;text-align: center;width: 880px;}
.experts_btns li{border-right: 1px solid #194474;float: left;position: relative;left: 0;top: 0;  padding: 0px 20px;cursor:pointer}
.experts_btns li:hover{color:#9FC0E2}
.experts_btns li.experts_btns_current span{width: 14px;height: 3px;position: absolute;left: 50%;margin-left: -7px;top: 100%;background:url({{$cdn}}/assets/img/li_sanjia.png) no-repeat center center;}
.experts_btns_current{color: #5b9ce0;background: url({{$cdn}}/assets/img/li_bg.jpg) no-repeat center 0px;}
li.experts_btns_current:hover{color: #5b9ce0;}
.experts_detail{width: 810px;margin: auto;font-family: "SimSun";}
.experts_detail .li_appear{display: block;}
.experts_detail dl{border: 1px dashed #4d92f0;height: 295px;margin: 20px 0;overflow:hidden;padding: 18px 10px 10px 10px;}
.experts_detail dl dt{height: 250px;width: 200px;color: #000;float: left;text-align: center; no-repeat center top;margin:0px 10px;}
.experts_detail dl dd{font-size: 14px;line-height: 28px;color: #666;float: left;width: 555px;margin-left:10px;  overflow: auto;height: 100%;}
.experts_detail dl dt img{width:200px;height:250px;border-radius:10px;}
.experts_detail dl dt p{padding-top:5px;font-size:18px;}
.experts_detail_contain{overflow: hidden;width: 100%;margin: 0;height: 140px;}
.experts_zan{font-family: "Microsoft YaHei";float: left;width: 606px;}
.zan_per{color: #666;font-size: 18px;height: 45px;text-align: left;}
.experts_zan span{height: 45px;}
.zan_per_word{width: 543px;}
.zan_full{background: #e0e3ef;height: 45px;}
.zan_full .zan_length{background: #ecbd00;height: 100%;width: 30px;  float: left;}
.zan_num{color: #a4a4a4;font-size: 14px;padding-top: 20px;}
.experts_detail_contain a{float: right;padding: 0 10px;}
</style>
</head>

<body>

	<div id="dialog">

		<div class="dialog-content" style="background-color: #ebf1f7; background-position: initial initial; background-repeat: initial initial;">
			<div id="experts">
				<ol class="experts_btns">
				@foreach($teacherInfos as $key=> $value)
					<li @if($key == 0) class="experts_btns_current" @endif style="">
						<span></span>
						{{$value->name}}
					</li>
				@endforeach
				</ol>
				<ul class="experts_detail">
					@foreach($teacherInfos as $key=> $value)
					<li class="li_appear" @if($key != 0)  style="display: none;" @endif>
						@if($agree_opend != 2)
						<dl>
							@if($value->imgurl)<dt>
								<img src="{{$value->imgurl}}"/>
								<p>{{$value->j_name}}</p>
							</dt>
							@endif
							<dd @if(!$value->imgurl) style="width:770px;" @endif>
								{!!$value->introduction!!}
							</dd>
						</dl>
						@endif
						@if($agree_opend && $agree_opend !=3)
						<div class="experts_detail_contain" @if($agree_opend == 2) style="margin-top: 10px;" @endif>
					<div class="experts_zan" >
						<p class="zan_per">
							<span class="zan_per_word">喜欢{{$value->name}}的分析，就给TA点个赞吧！</span>
						</p>
						<p class="zan_full"><span class="zan_length" style="width:@if($value->base && (($value->total+$value->total_base)*100/$value->base < 100)){{($value->total+$value->total_base)*100/$value->base}}%@else 100%@endif"></span></p>
						@if($agree_opend == 1)
						<p class="zan_num" day_count="{{$value->today+$value->total_base}}" month_count="{{$value->total}}">今日获赞：{{$value->today+$value->today_base}}, 累计：{{$value->total+$value->total_base}}</p>
						@endif
					</div>
					<a href="javascript:" rel="{{$value->id}}" onclick="specialist_vote(this)"><img src="{{$cdn}}/assets/img/zan_point.png" width="121"></a>
				</div>
				@endif
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
	@if($agree_opend)
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/artDialog/css/ui-dialog.css">
	<script type="text/javascript" src="{{$common_cdn}}/js/artDialog/dialog-min.js"></script>
	@endif
		
	<script>
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ $ctrl->csrf_token() }}'
        }
    });
	var sum=13;
	$(".experts_btns li").click(function(){
		$(".experts_btns li").removeClass("experts_btns_current");
		$(this).addClass("experts_btns_current");
		var index=$(this).index();
		$(".experts_detail li.li_appear").hide();
		$(".experts_detail li.li_appear").eq(index).show();
	});
	@if($agree_opend)
	function specialist_vote(e){
			
		$.post('/live/agree/{{$roomId}}',{'tid':e.rel},function(resp){
			if( resp.code == 0){
				dialog({title:"提示",content:"投票成功",quickClose: true}).show();
				++sum;
				var target=$(e).parent().find('.zan_num');
				target.attr({'day_count':resp.today,'month_count':resp.total});
				if(resp.base <= 0){
					resp.base = 1;
				}
				var percent= resp.total *100/resp.base;
				if(percent > 100){
					percent = 100;
				}
				percent = percent+'%';
				target.find('.zan_length').css('width',percent);
				target.html('今日获赞：'+resp.today+', 累计：'+resp.total);
			}else if(resp.code == 401){
				if(parent.showLoginDialog){
					parent.showLoginDialog();
				}else{
					dialog({title:"提示",content:"未登陆",quickClose: true}).show();
				}
			}else{
				dialog({title:"提示",content:resp.msg,quickClose: true}).show();
			}
		});
	}
	@endif
	
</script>

</body>
</html>
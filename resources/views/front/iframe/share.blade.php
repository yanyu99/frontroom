
	<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta content="width=device-width, initial-scale=1,user-scalable=no,minimum-scale=1.0,maximum-scale=1.0" name="viewport">
	<title>分享收藏</title>

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
html{
	width:100%;
	height:100%;
	font-size: 14px;
}
body{
	width:100%; 
	height:100%;
	margin: 0px;
	padding: 0px;
	overflow: hidden;
}
li{
	    vertical-align: baseline;
    font-weight: inherit;
    font-family: inherit;
    font-style: inherit;
    font-size: 100%;
    outline: 0;
    padding: 0;
    margin: 0;
    border: 0;
    list-style: none;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.share-btn {
	background-image: url("{{$cdn}}/assets/img/share-btn-icon.png");
	height: 48px;
	width: 48px;
}

.share-weibo-btn {
	background-position: 0px 53px;
}

.share-qq-btn {
	background-position: 148px -2px;
}

.share-qzone-btn {
	background-position: 99px -3px;
}
 .block {
    margin: 15px 15px 15px;
}
 .block>ul {
    padding: 0;
    margin: 0;
    list-style: none;
}
 .block>ul>li>a {
    color: #545454;
    display: block;
    border-bottom: 1px solid #f9f9f9;
    padding: 6px 0;
}
.list-inline>li {
    display: inline-block;
    padding-right: 5px;
    padding-left: 5px;
}
</style> 

<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>

</head>
<body style="">
<div>

		<div style="padding-left: 20px;">
			<h4>
				<span class="text">分享</span>
			</h4>
			<div class="block">
				<ul class="list-inline">
					<li>
						<a href="#" class="share-btn share-weibo-btn" id="js-share-weibo-btn" target="_blank"></a>
					</li>
					<li>
						<a href="#" class="share-btn share-qq-btn" id="js-share-qq-btn" target="_blank"></a>
					</li>
					<li>
						<a href="#" class="share-btn share-qzone-btn" id="js-share-qzone-btn" target="_blank"></a>
					</li>
				</ul>
			</div>
			<h4>
				<span class="text">其他操作</span>
			</h4>
			<div class="block">
				<ul>
					<li>
						<a class="js-favorite-link" href="javascript:void(0);" target="_blank">收藏到书签栏</a>
					</li>
					<li>
						<a href="/siteurl/{{$roomId}}?name={{$roomTitle}}" target="_blank">发送桌面快捷方式</a>
					</li>
				</ul>
			</div>
		</div>
		<script type="text/javascript">
		$(function() {
			var p = {
				url: '{{$tgURL}}',
				showcount: '1',
				desc: '',
				summary: '',
				title: "{{$roomTitle}}",
				site: '',
				pics: '',
				style: '203',
				width: 98,
				height: 22
			};
			var s = [];
			for (var i in p) {
				s.push(i + '=' + encodeURIComponent(p[i] || ''));
			}
			$('#js-share-qzone-btn').attr('href', 'http://connect.qq.com/widget/shareqq/index.html?' + s.join('&'));
		});
		//分享到QQ
		$(function() {
			var p = {
				url: '{{$tgURL}}',
				/*获取URL，可加上来自分享到QQ标识，方便统计*/
				desc: '',
				/*分享理由(风格应模拟用户对话),支持多分享语随机展现（使用|分隔）*/
				title: "{{$roomTitle}}",
				/*分享标题(可选)*/
				summary: '',
				/*分享摘要(可选)*/
				pics: '',
				/*分享图片(可选)*/
				flash: '',
				/*视频地址(可选)*/
				site: '',
				/*分享来源(可选) 如：QQ分享*/
				style: '201',
				width: 32,
				height: 32
			};

			var s = [];
			for (var i in p) {
				s.push(i + '=' + encodeURIComponent(p[i] || ''));
			}
			s.join('&');
			$('#js-share-qq-btn').attr('href', 'http://connect.qq.com/widget/shareqq/index.html?' + s.join('&'));
		});
		$(function() {
			$('.js-favorite-link').click(function() {
				try {
					window.external.addFavorite(sURL, sTitle);
				} catch (e) {
					try {
						window.sidebar.addPanel(sTitle, sURL, "");
					} catch (e) {
						alert("请使用Ctrl+D进行添加");
					}
				}
			});
		});
		$(function() {
			var p = {
				url: '{{$tgURL}}',
				style: 'number',
				searchPic: 'false',
				language: 'zh_cn',
				style: 'button'
			};
			var s = [];
			for (var i in p) {
				s.push(i + '=' + encodeURIComponent(p[i] || ''));
			}
			s.join('&');
			$('#js-share-weibo-btn').attr('href', 'http://service.weibo.com/share/share.php?'+s.join('&'));
		});
	</script>
	</div>
</body>
</html>
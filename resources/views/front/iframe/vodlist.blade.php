<!DOCTYPE html>
<html>
<head>
	<title>视频库</title>
	<meta charset="utf-8">
	<style type="text/css">

		html,body{
			padding: 0;
			margin: 0;
			width: 100%;
			height: 100%;
			font-family: "微软雅黑";
		}
		.item{
			float: left;
			padding: 10px;
		
		}
		.item .title{
			text-align: center;
			    max-width: 180px;
		    overflow: hidden;
		    padding: 5px 0px;
		    margin: 0px;
		    cursor: pointer;
		}
		img{
			cursor: pointer;
		}
	</style>
</head>
<body>
 {{-- */$i=0;/* --}}
@foreach($vodlist as $value)
@if($i % 3 == 0)
@if($i > 0)
<div style="clear: both;"></div>
	</div>
@endif
	<div>
@endif
 {{-- */$i++;/* --}}
<div class="item" onclick="playVod1('{{$value->liveurl}}')">
@if(empty($value->pic))

<img src="{{$cdn}}/assets/img/defvod.jpg" width="180" height="130">
@else
	<img src="{{$value->pic}}" width="180" height="130">
@endif
	<p class="title">{{$value->title}}</p>
</div>

@endforeach
<script type="text/javascript">
	function playVod1(liveurl){
		window.parent.playVod(liveurl);
	}
</script>
</body>
</html>
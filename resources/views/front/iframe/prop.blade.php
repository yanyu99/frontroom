<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body{
			background-image: url({{$cdn}}/assets/img/fxts/bg1.png);
			    background-repeat: no-repeat;
			    width: 800px;height:450px;margin: 0px;
			    position: relative;
		}
		.title{
			margin-left: 72px;
			margin-top: 14px;
			font-size: 20px;
			color: #fff;
			display: inline-block;
		}
		.content{
			color: #666;
		    height: 337px;
		    overflow-x: hidden;
		    margin-top: 50px;
		    margin-left: 40px;
		    width: 720px;
		}
		.btn{
			background-image: url({{$cdn}}/assets/img/fxts/look.png);
			background-repeat: no-repeat;
		    padding: 4px 33px;
		}
		table{
			border: 1px solid #ccc;border-collapse: collapse; width:100%;
		}
		table th{
			text-align: center;
			line-height: 39px;
		}
		table td{
			text-align: center;
			line-height: 39px;
		}
	</style>
</head>
<body style="">
<span class="title">操作建议</span>
<div class="content">
	<table border="1">
  <tr>
    <th>标题</th>
    <th>上传讲师</th>
    <th>上传时间</th>
    <!--<th>查看次数</th>-->
    <th>立即查看</th>
  </tr>
  @foreach($props as $value)
  <tr>
    <td style="max-width: 200px;">{{$value->title}}</td>
    <td>@if($value->teacher){{$value->teacher->name}}@else 讲师 @endif</td>
    <td>{{$value->created_at}}</td>
    <!--<td id="idCount{{$value->id}}">{{$value->count}}</td>-->
    <td><a href='javascript:;' onclick="onLook('{{$value->id}}')" target="_blank" class="btn"></a></td>
  </tr>
  @endforeach
</table>
</div>

</body>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>

<script type="text/javascript" src="{{$common_cdn}}/js/jquery.nicescroll-3.6.0/jquery.nicescroll.min.js"></script>
<script type="text/javascript">
	function onLook(id){
		//var countId = document.getElementById("idCount"+id);
		//countId.innerHTML = Number(countId.innerHTML)+1;
		window.parent.showPropContent(id);
	}
	$('.content').niceScroll({
        cursorborder: '',
        horizrailenabled: false,
        cursorcolor: '#999',
        boxzoom: false
    });
</script>
</html>
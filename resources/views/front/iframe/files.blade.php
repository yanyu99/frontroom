<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body{
		    background-repeat: no-repeat;
		   	margin: 0px;
		    position: relative;
		}
		
		table{
			border: 1px solid #ccc;border-collapse: collapse; width:100%;
		}
		table th{
			text-align: center;

		}
		table td{
			text-align: center;

		}
.list-inline {
    padding-left: 0;
    margin-left: -5px;
    list-style: none;
    margin: 2px;
}
.list-inline>li {
    display: inline-block;
    padding-right: 5px;
    padding-left: 5px;
}
tr{
    border-bottom: 1px solid #ccc;
}
	</style>

</head>
<body style="padding: 20px;">
@if(!$user->role->f_download)
        <div style="color: #999; line-height:24px;">
            <div>暂无权限查看此内容，如有疑问，请联系客服。</div>
            @include('front.iframe.inqqs')
        </div>
    @else
<table class="table table-condensed table-striped">
@foreach($list as $item)
<tr>

	<td style="vertical-align: middle; ">
		<a href="/live/downloadfile/{{$item->room_id}}?id={{$item->id}}" target="_blank" >
			<img src="{{$cdn}}/assets/img/filelist.png">
		</a>
	</td>
	<td style="    padding-left: 10px;">
		<div>
			<a href="/live/downloadfile/{{$item->room_id}}?id={{$item->id}}" target="_blank">{{$item->filename}}
			</a>
		</div>
		<ul class="list-inline text-muted">
		@if(!$noShowNum)
			<li>
				<small>
					<i class="icon-download"></i>
					{{$item->count}}次下载
				</small>
			</li>
		@endif
			<li>
				<small>
					<i class="icon-download"></i>
					{{$item->jf_num}}积分
				</small>
			</li>
			<li>
				<small>
					<i class="icon-user"></i>
					@if($item->ts)
					{{$item->ts}}
					@else
					{{date("Y年m月d日", strtotime($item->created_at))}}
					@endif
				</small>
			</li>
		</ul>
	</td>
</tr>
@endforeach
</table>
@endif
</body>

</html>
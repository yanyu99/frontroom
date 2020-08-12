@extends('front.v2.pc.pcbase')
@section('title')
我的积分
@endsection
@section('head')
<style type="text/css">
table{
	    border-collapse: collapse;
	    margin-top: 10px;
	}
	tr{
		border: 1px solid #ddd;
    	border-bottom: 0px;
	}
	tr:last-child{
		    border-bottom: 1px solid #ddd;
	}
	th{
		padding: 8px 0px;
		border-right:  1px solid #ddd;
	}

	th:last-child{
		border-right:  0px;
	}
	td{
		text-align: center;
		padding: 8px 0px;
		border-right:  1px solid #ddd;
	}
	th:last-child{
		border-right:  0px;
	}
	.jfuse{
		margin-top: 10px;
		margin-left: 10px;
	}
	.jfuse>span{
		color:#F78303;
	}
</style>
@endsection

@section('content')
<div class="jfuse">
	当前可用积分：<span>{{ !empty($user->extern) ? $user->extern->jf_cur : 0 }}</span> ，送礼积分：<span>{{ !empty($user->extern) ? $user->extern->jf_giftsend : 0 }}</span>
</div>
<table style="width: 100%;max-height: 442px;">
	<thead>
	<tr style="border-bottom: 2px solid #ddd;">
		<th>积分</th>
		<th>类别</th>
		<th>描述</th>
		<th>时间</th>
	</tr>
	</thead>
	<tbody style="height:400px;">
	@foreach($lists as $item)
	<tr>
		<td>{{$item->jf_num}}</td>
		<td>{{$item->jf_num > 0?'增加':'消耗'}}</td>
		<td>{{$item->dsc}}</td>
		<td>{{$item->created_at}}</td>
	</tr>
	@endforeach
	</tbody>
</table>
<div style="color: #ccc">共{{$lists->total()}}条数据</div>
    {!!$lists->render()!!}
@endsection

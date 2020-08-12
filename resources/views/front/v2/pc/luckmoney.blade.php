@extends('front.v2.pc.pcbase')
@section('title')
红包记录
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
	.title>span{
		margin-top: 7px;
	}
</style>
@endsection
@section('content')
<table style="width: 100%;max-height: 442px;">
	<thead>
	<tr style="border-bottom: 2px solid #ddd;">
		<th>发送方</th>
		<th>获得金额</th>
	</tr>
	</thead>
	<tbody style="height:400px;">
	@foreach($lists as $item)
	<tr>
		<td>{{$item->sendUser->name}}</td>   
		<td>{{$item->money/100}}</td>
	</tr>
	@endforeach
	</tbody>
</table>
<div style="color: #ccc">共{{$lists->total()}}条订单</div>
    {!!$lists->render()!!}
@endsection
<script>	
</script>




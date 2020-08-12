@extends('front.v2.pc.pcbase')
@section('title')
推广记录
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
	
</style>
@endsection
@section('content')
<table style="width: 100%;max-height: 442px;">
	<thead>
	<tr style="border-bottom: 2px solid #ddd;">
		<th>被推广人{{ $sysConfig->reg_account_tag }}</th>
		<th>昵称</th>
		<th>推广时间</th>
	</tr>
	</thead>
	<tbody>
	@foreach($lists as $item)
	<tr>
		<td>{{$item->uid}}</td>
		<td>{{$item->name}}</td>
		<td>{{$item->created_at}}</td>
	</tr>
	@endforeach
	</tbody>
</table>
<div style="color: #ccc">共{{$lists->total()}}条数据</div>
    {!!$lists->render()!!}
@endsection

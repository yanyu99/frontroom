@extends('front.shop.base')
@section('title')
积分流水
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
</style>
@endsection
@section('content')
<table style="width: 100%;max-height: 442px;">
	<thead>
	<tr style="border-bottom: 2px solid #ddd;">
		<th>编号</th>
		<th>积分变动</th>
		<th>总积分</th>
		<th>描述</th>
		<th>创建日期</th>
	</tr>
	</thead>
	<tbody>
	@foreach($lists as $item)
	<tr>
	<td>{{$item->id}}</td>
		<td>{{$item->jf_num}}</td>
        <td>{{$item->jf_left}}</td>
        <td>{{$item->dsc}}</td>
        <td>{{$item->created_at}}</td>
	</tr>
	@endforeach
	</tbody>
</table>
<div style="color: #ccc">共{{$lists->total()}}条订单</div>
    {!!$lists->render()!!}
@endsection

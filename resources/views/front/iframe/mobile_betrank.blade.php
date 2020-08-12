<table class="rank">
<thead>
  <tr >
    <th style="width: 10%">名次</th>
    <th style="width: 20%;">昵称</th>
    <th style="width: 25%;">总竞猜次数</th>
    <th style="width: 25%;">中奖次数</th>
    <th style="width: 25%;">中奖概率</th>
  </tr>
</thead>
<tbody>
{{-- */$i=0;/* --}}
@foreach($list as $item)
<tr>
	@if(++$i > 3)
	<td style="width: 10%">{{$i}}</td>
	@else
	<td style="width: 10%" ><img width="30px" src="{{$cdn}}/assets/img/phone/rank/{{$i}}.png"></td>
	@endif
	<td style="width: 20%;">{{$item->user->name}}</td>
	<td style="width: 25%;">{{$item->jc_num}}</td>
	<td style="width: 25%;">{{$item->jc_win_num}}</td>
	@if($item->jc_num)
	<td style="width: 25%;">{{intval( $item->jc_win_num*100/$item->jc_num )}}%</td>
	@else
	<td style="width: 20%;">0%</td>
	@endif
</tr>
@endforeach
</tbody>
</table>
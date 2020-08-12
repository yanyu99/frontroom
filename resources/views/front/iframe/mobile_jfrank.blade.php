<table class="rank">
<thead>
  <tr >
    <th style="width: 20%">名次</th>
    <th style="width: 40%;">昵称</th>
    <th style="width: 40%;">当前总积分</th>

  </tr>
</thead>
<tbody>
{{-- */$i=0;/* --}}
@foreach($list as $item)
<tr>
	@if(++$i > 3)
	<td style="width: 20%">{{$i}}</td>
	@else
	<td style="width: 20%" ><img width="30px" src="{{$cdn}}/assets/img/phone/rank/{{$i}}.png"></td>
	@endif
	<td style="width: 40%;">{{$item->user->name}}</td>
	<td style="width: 40%;">{{$item->jf_cur}}</td>

</tr>
@endforeach
</tbody>
</table>
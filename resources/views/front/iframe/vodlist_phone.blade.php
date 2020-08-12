
	<style type="text/css">
		.item{
			float: left;
			padding: 5px;
		
		}
		.item .title{
			text-align: center;
			    max-width: 130px;
		    overflow: hidden;
		    padding: 5px 0px;
		    margin: 0px;
		    cursor: pointer;
		}
		img{
			cursor: pointer;
		}
	</style>
 {{-- */$i=0;/* --}}
 <div style="width: 300px;margin:auto;">
@foreach($vodlist as $value)
@if($i % 2 == 0)
@if($i > 0)
<div style="clear: both;"></div>
	</div>
@endif
	<div>
@endif
 {{-- */$i++;/* --}}
<div class="item" onclick="playVod1('{{$value->liveurl}}')">
@if(empty($value->pic))
<img src="{{$cdn}}/assets/img/defvod.jpg" width="140" height="100">
@else
	<img src="{{$value->pic}}" width="140" height="100">
@endif
	<p class="title">{{$value->title}}</p>
</div>

@endforeach
</div>
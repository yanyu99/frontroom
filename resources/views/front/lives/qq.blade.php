<ul class="customer-list">
	@foreach($roomqqs as $value)
	<li>
		<a href="http://wpa.qq.com/msgrd?v=3&uin={{$value->qq}}&site=qq&menu=yes" target="_blank">
			<img src="{{$cdn}}/assets/img/kf.png" alt="user">
			<span>{{$value->name}}</span>
		</a>
	</li>
	@endforeach
</ul>
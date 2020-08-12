<style type="text/css">
	.customer-list {
	margin: 0 -15px;
}

.customer-list li {
	float: left;
	list-style-type:none;
}

.customer-list li a {
	color: #333;
	display: inline-block;
	height: 48px;
	width: 60px;
	margin: 25px 15px;
}

.customer-list li img {
	border-radius: 50%;
	height: 48px;
	width: 48px;
	display: block;
	margin: auto;
}
</style>
<ul class="customer-list">
	@foreach($roomqqs as $value)
	<li>
		<a href="http://wpa.qq.com/msgrd?v=3&uin={{$value->qq}}&site=qq&menu=yes" target="_blank">
			<span>{{$value->name}}</span>
		</a>
	</li>
	@endforeach
</ul>
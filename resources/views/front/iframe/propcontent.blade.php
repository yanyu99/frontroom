<!DOCTYPE html>
<html>
<head>
	<title>{{$prop->title}}</title>
</head>
<body>
<h1 style="text-align: center;">{{$prop->title}}</h1>
<div style="color:#999999">@if($prop->teacher){{$prop->teacher->name}}@else 讲师 @endif {{$prop->created_at}}</div>
<div>{!!$prop->content!!}</div>
</body>
</html>
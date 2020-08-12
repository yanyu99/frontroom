@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
@if($ctrl->errors_has('modify'))
<div >

	
		<h2 style="color: green;">{{$ctrl->errors_first('modify', ':message')}}</h2>


</div>
@endif
<div class="row">
  <div class="col-md-12">
    <h2>@if($site->show_ws ) 稳顺软件@endif欢迎您：{{$user->name}}</h2>
</div>
</div>

@endsection
@section('script')
@endsection
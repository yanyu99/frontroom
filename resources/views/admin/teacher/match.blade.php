@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">今日赛事</header>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" >
                        {{ $ctrl->csrf_field() }}
                        <div class="form-group">
                            <span class="col-sm-2 col-sm-2 control-label">内容:*</span>
                            <div class="col-sm-8">
                                <textarea  class="form-control ckeditor"  type="text" name="mobile_welcome"  >@if($mobile_welcome){{$mobile_welcome}}@endif</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls text-center">
                                <button type="submit" class="btn btn-primary">确定</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{$common_cdn}}/js/ckeditor/ckeditor.js"></script>
@endsection
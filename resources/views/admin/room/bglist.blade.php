
@extends('admin.layouts.base')
@section('head')
<style type="text/css">
  .chosed{
    border: 2px solid red;
  }
</style>
@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">房间背景</header>
      <div class="panel-body">
        @if($ctrl->errors_has('error'))
          <div class="form-group">
            <div>
              <div id="js-validate-alert" class="alert alert-danger alert-validate" style="margin-bottom: 0px;">
                <span class="text">{{$ctrl->errors_first('error', ':message')}}</span>
              </div>
            </div>
          </div>
        @endif

        @foreach($lists as $key=>$list)
        <div class="col-sm-4" style="margin-bottom:20px;" >
          <form method="post">
            {{ $ctrl->csrf_field() }}
            <input  class="form-control" type="hidden" name="id" value="{{$list->
            id}}"/>
            <div class="img-upload">
              <div id="idLogoImg{{$key}}"></div>
              <p id="idLogoImgTip{{$key}}" class="webuploader-tip">
                <p>
                  <input  class="form-control" type="hidden" name="imgurl" id="idLogoImgInput{{$key}}" value="{{$list->imgurl}}"/>
                  <img class="chose-img @if($list->selected) chosed @endif"  id="idLogoImgShow{{$key}}" src="{{$list->imgurl}}" alt="" height="200"/>
                  <input  class="form-control" type="hidden" name="selected"  value="{{$list->selected}}"/>
                </p>
              </p>
            </div>
            <button type="submit" class="btn btn-primary">确定</button>
          </form>
        </div>
        @endforeach
      </div>
    </section>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
$(function () {
    // 初始化Web Uploader
    @foreach($lists as $key=>$list)
    doUpload({
      id:"idLogoImg{{$key}}",
      intputId:"idLogoImgInput{{$key}}",
      showId:"idLogoImgShow{{$key}}",
      descId:"idLogoImgTip{{$key}}",
      csrf_token:'{{ $ctrl->csrf_token() }}',
      fileSize:200*1024,
//      fileName:"{{$curRoomName}}/room_bg_{{$key}}",
    });
     @endforeach
  $('.chose-img').click(function(){
    $('.chose-img').removeClass('chosed');
    $(this).addClass('chosed');
    $(this).next().val(1);
  })
})
</script>
@endsection
@extends('admin.layouts.base')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">视频库</header>
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
        <div class="adv-table">
        <div class="clearfix" >
            <div class="btn-group" style='margin-bottom:10px;'>
            <form  action="/admin/room/vodedit" method="post">
       {{ $ctrl->csrf_field() }}
              <button type="submit" class="btn btn-primary">新增</button>
              </form>
            </div>
          </div>
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        
           <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
    <thead>
        <tr role="row">
            <th >标题</th>
            <th >封面</th>
            <th >视频选择</th>
            <th >编辑</th>
        </tr>
    </thead>
    <tbody id="idTbody" role="alert" aria-live="polite" aria-relevant="all">
    {{-- */$i=1;/* --}}
    @foreach($lists as $list)
    @if($list->id > $i){{-- */$i=$list->id+1;/* --}}@endif
        <tr class="odd">
        <form id="editForm{{$list->id}}" action="/admin/room/vodedit" method="post">
       {{ $ctrl->csrf_field() }}
            <input type="hidden"  name="id" class="form-control " style="width:100%" value="{{$list->id}}">
            <td style="vertical-align: middle;">
            <input type="text"  name="title" value="{{$list->title}}" style="width:100%" class=" form-control" ></td>
            <td>
              <div class="img-upload">
                <div id="idPic{{$list->id}}"></div>
                <p id="idPic{{$list->id}}Tip" class="webuploader-tip">
                  <p>
                    <input  class="form-control" type="hidden" name="pic" id="idPic{{$list->id}}Input" value="{{$list->pic}}"/>
                    <img id="idPic{{$list->id}}Show" src="{{$list->pic}}" alt="" height="45"/></p>
                </p>
              </div>
            </td>
            <td style="vertical-align: middle;">
            
            
            <select id="m3u8_{{$list->id}}" style="width:100%" readonly name="liveurl"  class="editable form-control">
            {{-- */$selected=0;/* --}}
            <option >无</option>
              @foreach($vodList as $value)
              <option @if($vodCdn.'/'.$value->OssObject == $list->liveurl) {{-- */$selected = 1;/* --}}  selected @endif value="{{$vodCdn.'/'.$value->OssObject}}">{{date('m-d H:i',strtotime($value->StartTime))}}到{{date('m-d H:i',strtotime($value->EndTime))}}</option>
              @endforeach
              @if(!$selected && $list->liveurl)
               <option selected>过期的视频</option>
     
              @endif
            </select>
            </td>
            <td style="vertical-align: middle;">
            <a data-id="{{$list->id}}" class="btn btn-success edit" href="javascript:;">保存</a>
            <a href="javascript:;" data-id="{{$list->id}}" class="btn btn-success btnpreview">预览</a></form>
            <form  action="/admin/room/voddel" method="post">
              {{ $ctrl->csrf_field() }}
              <input type="hidden"  name="id" class="form-control " style="width:100%" value="{{$list->id}}">
              <button type="submit" class="btn btn-danger">删除</button>
              </td>
            </form>
            
            </td>
            </form>
            
        </tr>
       @endforeach
    </tbody>
</table>
 
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{$cdn}}/assets/js/artDialog.js?v={{$webver}}&skin=default"></script>
<script type="text/javascript" src="{{$cdn}}/assets/js/aodianplayer.js?v={{$webver}}"></script>
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-timepicker/css/timepicker.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

<script type="text/javascript">
$(function(){
  $('body').on('click',".edit",function(){
    //if($(this).hasClass("opend")){
      $(this).parent().parent().find(".editable").prop('readonly',false);
      $('#editForm'+$(this).attr('data-id')).submit();
   // }else{
    //  $(this).addClass("opend");
    //  $(this).html("保存");
    //  $(this).parent().parent().find(".editable").prop('readonly',false);
    //}
  })
  $('.btnpreview').on("click",function(){
    var id = "m3u8_"+$(this).data('id');
    var m3u8 = $('#'+id).val();
    if(m3u8){
      videoPlayer(m3u8,m3u8,'960','720');
    }
  });
@foreach($lists as $list)
  doUpload({
    id:"idPic{{$list->id}}",
    intputId:"idPic{{$list->id}}Input",
    showId:"idPic{{$list->id}}Show",
    descId:"idPic{{$list->id}}Tip",
    csrf_token:'{{ $ctrl->csrf_token() }}',
//  fileName:"{{$curRoomName}}/logo",
  });
@endforeach
});

function videoPlayer(url,m3u8,w,h){
    w  = w > 0 ? (w > 650 ? 650 : w) : 450;
    h = h > 0 ? (h > 420 ? 420 : h) : 180;
    var dlg = art.dialog({
        title: '视频播放',
        content: '<div id="videoPlayer"></div>',
        lock: true,
        resize: false,
        padding: '0px',
        top:'10%',
        left:'25%'
    });
    var tmp = "";
    if(tmp == 2){
        var tmp_url = $.parseUrl(url);
        var tmp_m3u8 = $.parseUrl(m3u8);
        url = tmp_url['protocol']+'://'+tmp_url['host']+'/tmp'+tmp_url['path'];
        m3u8 = tmp_m3u8['protocol']+'://'+tmp_m3u8['host']+'/tmp'+tmp_m3u8['path'];
    }
    var options = {
        container:'videoPlayer',//播放器容器ID，必要参数
        /* 以下为可选参数*/
        width: w,//视频宽度，可用数字、百分比等
        height: h,//视频高度，可用数字、百分比等
        autostart: false,//是否自动播放，默认为false
        stretching: '3',//设置全屏模式,1代表按比例撑满至全屏,2代表铺满全屏,3代表视频原始大小,默认值为1
        controlbardisplay: 'enable'//是否显示控制栏，值为：disable、enable默认为disable
    };
    if(url){
        options['videoUrl'] = url;//mp4/flv播放地址，必要参数
    }
    if(m3u8){
        options['hlsUrl'] = m3u8;//m3u8播放地址，必要参数
    }
    var aodianpaly = new aodianPlayer(options);
}
 $('.form_time').timepicker({
    minuteStep: 1,
    secondStep:1,
    showSeconds: false,
    showMeridian: false,
    defaultTime: false
});
</script>
@endsection

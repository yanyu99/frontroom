
@if(isset($signPackage))
  <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
  <script type="text/javascript">
wx.config({
  debug: false,
  appId: '{{$signPackage["appId"]}}',
  timestamp:'{{$signPackage["timestamp"]}}',
  nonceStr: '{{$signPackage["nonceStr"]}}',
  signature: '{{$signPackage["signature"]}}',
  jsApiList: [
    'onMenuShareTimeline',
    'onMenuShareAppMessage'
  ]
});
var shareData = {
    title: '@yield('title')',
    link: '{{$signPackage["url"]}}',
    desc:'{!!$config->description!!}',
    imgUrl:imgUrl,
    trigger: function (res) {},
    success: function (res) {

    },
    cancel: function (res) {},
    fail: function (res) {}
}
wx.ready(function(){
    wx.onMenuShareTimeline(shareData);
    wx.onMenuShareAppMessage(shareData);
});
</script>
@endif
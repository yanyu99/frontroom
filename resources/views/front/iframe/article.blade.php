<!DOCTYPE html>
<html>
<head>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta content="width=device-width, initial-scale=1,user-scalable=no,minimum-scale=1.0,maximum-scale=1.0" name="viewport">
    
	<title></title>
	<style type="text/css">
	html,body{overflow:hidden;width:100%;height:100%}
body{margin:0 auto;padding:0;word-wrap:break-word;font-size:14px;font-family:"Microsoft YaHei",Arial,Helvetica,sans-serif;word-break:break-all}
div,form,h1,ol,ul,li,dl,dt,dd,h2,h3,h4,h5,h6,span,p,img{margin:0;padding:0;border:0}
img{vertical-align:middle}
fieldset{border:none 0}
a{outline:0;text-decoration:none}
a:hover{text-decoration:underline;star:expression(this.onFocus = this.blur())}
:focus{outline:0}
li{list-style:none}
input,label,select,option,textarea,Chat_Send_Msg button,fieldset,legend{font-size:14px;font-family:"Microsoft YaHei",Arial,Helvetica,sans-serif}
.clear{line-height:0;font-size:0;clear:both;height:0}
.clearfix:before,.clearfix:after{ 
    content:""; 
    display:table; 
} 
.clearfix:after{clear:both; } 
.clearfix{ 
    *zoom:1;/*IE/7/6*/
}
html[xmlns] .clearfix{display:block;}
*html .clearfix{height:1%;}
html[xmlns] .clearfix{display:block}
* html .clearfix{height:1%}
.fl{float:left}
.fr{float:right}
.option-list {
  padding: 3px;
  line-height: 18px;
}

.btn {
    background-color: #107bcf;
}
.btn-xs {
    padding: 1px 5px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
}
.btn-info {
    color: #fff;
    background-color: #5bc0de;
    border-color: #46b8da;
}
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}
.option-list a {
  color: #333;
}

.option-list .media {
  margin-top: 10px;
  padding-bottom: 10px;
  border-bottom: 1px solid #ddd;
}

.option-list .media .media-left {
  text-align: center;
  width: 120px;
  font-size: 14px;
}

.option-list .media .media-left a {
  color: #2d6fc3 !important;
}

.option-list img.media-object {
  width: 54px;
  width: 54px;
  padding: 2px;
  border-bottom: 1px solid #ddd;
  margin: 0 15px;
}

.option-list h5.media-heading {
  font-size: 15px;
  font-weight: bold;
  line-height: 24px;
  margin-bottom: 0;
}

.option-list .media-body {
  width: 100%;
    display: block;
}

.option-list .media-meta a {
  color: #999;
}

.option-list .media-meta {
  margin-bottom: 2px;
}

.option-list .media-summay {
  margin-bottom: 10px;
  height: 25px;
}

.active .media-summay {
  height: auto;
      word-wrap: break-word;
}

</style>
</head>
<body style="overflow-y: auto;">
    
    @if(!$user->role->f_manual)
        <div style="color: #999; line-height:24px;">
            <div>暂无权限查看此内容，如有疑问，请联系客服。</div>
            @include('front.lives.qq')
        </div>
    @else
      <div class="option-list ">
        @foreach($list as $item)
        <div class="media" id="article_{{$item->id}}">
    <div class="media-body">
      <h5 class="media-heading" style="line-height: 1.3em;">{{$item->title}}</h5>
      <ul class="media-meta list-inline text-muted" style="font-size:12px;">
        <li>
          <span class="text">{{$item->time}}</span>
        </li>
        <li>
          <span class="text">阅读:</span>
          <span class="js-article-reader-num">{{$item->count}}</span>
        </li>
        <li class="pull-right">ss
          <span class="text">作者:</span>
          <span>@if($item->teacher) {{$item->teacher->name}} @endif</span>
        </li>
      </ul>
      <div class="media-summay clearfixed">{!!$item->text!!}</div>
    </div>
    <ul class="media-meta list-inline text-muted"  style="font-size:12px;margin-top: 5px;">
      <li class="pull-right">
        <a class="btn btn-info btn-xs js-article-reader-btn" data-id="{{$item->id}}" data-display="collapse" style="color: #fff">查看全文</a>
      </li>
    </ul>
  </div>
        @endforeach
      </div>
      @endif  
 <script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
      <script type="text/javascript">
        $(function(){
    $('.option-list .media-summay img').attr("title", "点击查看原图");
    $('.js-article-reader-btn').click(function() {
        var $this = $(this);
        id = $this.data('id'),
            isExpend = $this.data('display');

        if (isExpend == 'expend') {
            $this.parents('.media').removeClass('active');
            $this.data("display", "collapse");
        } else {
            $this.parents('.media').addClass('active');
            var $readerNum = $this.parents('.media').find('.js-article-reader-num');
            var readerNum = parseInt($readerNum.text());
            $readerNum.text(readerNum + 1);
            $this.data("display", "expend");
            $.post('/live/article/{{$roomId}}' + '?id=' + id,{},function(text, status){
                if(text && text.count){
                    $readerNum.text(text.count);
                }
            });
        }
    });
    //图片放大
    $('.option-list .media-summay').delegate('img', 'click', function() {
        window.parent.popImg($(this).attr('src'))
    });
  });
      </script>
</body>
</html>




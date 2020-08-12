<!DOCTYPE html>
<html>
<head>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta content="width=device-width, initial-scale=0.5,user-scalable=no,minimum-scale=0.5,maximum-scale=0.5" name="viewport">
    
	<title>竞猜</title>
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
.bet_box{

    width: 570px;
    height: 340px;
}
.item{
    margin-right: 20px;
}
.bet-type-bg{
    width: 170px;
    height: 160px;
    background-repeat: no-repeat;
    background-position: center;
    font-size: 12px;
    color: #fff;
    text-align: left;
}

.bet-type-bg1{
    background-image:url({{$cdn}}/assets/img/bet/item_bg.png);
}
.bet-type-bg2{
    background-image:url({{$cdn}}/assets/img/bet/item_bg1.png);
}
.bet-type-bg3{
    background-image:url({{$cdn}}/assets/img/bet/item_bg2.png);
}
.bet-type{
   width: 101px;
   height: 22px;
   margin-top: 8px;
   margin-left: 35px;
   background-repeat: no-repeat;
   background-position: center;
   cursor: pointer;
}

.bet-type1{
    background-image:url({{$cdn}}/assets/img/bet/bet.png) ;
}
.bet-type2{
    background-image:url({{$cdn}}/assets/img/bet/bet1.png) ;
}
.bet-type3{
    background-image:url({{$cdn}}/assets/img/bet/bet2.png) ;
}
.line{
    background:url({{$cdn}}/assets/img/bet/line.png) center;
    margin: 0px 50px;
    height: 5px;
}
.guess-bar-up {
    background-color: #f7b4b1;
}
.guess-bar-draw {
    background-color: #dce9f7;
}
.guess-bar-draw span {
    background-color: #7ba8d9;
    width: 50%;
}
.guess-bar-down {
    background-color: #cef3ec;
}
.guess-bar-text{
    margin-top: 1px;
    margin-left: 35px;
    color: #333;
    font-size:12px;
}
.guess-bar-down span {
    background-color: #60bdab;
    width: 10%;
}
.guess-bar {
    width: 101px;
    margin-top: 5px;
    margin-left: 35px;
    height: 10px;
    border-radius: 10px;
    position: relative;
    margin-left: 35px;
}
.guess-bar-up span {
    background-color: #f65b54;
    width: 10%;
}
.guess-bar span {
    height: 10px;
    border-radius: 10px;
    position: absolute;
    left: 0;
    bottom: 0;
}
</style>
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/artDialog/css/ui-dialog.css">

<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/artDialog/dialog-min.js"></script>
<script type="text/javascript">
    $(function(){
        $('.bet-type').click(function(){
            var betType = $(this).attr('data-type');
            $.post("/live/bet/{{$roomId}}",{'bet_type':betType},function(resp,text){
               var mydialog = dialog({title:"提示",content:resp.msg,quickClose: false}).show();
               setTimeout(function(){
                mydialog.remove();
               },3000);
               if(resp.code == 0){
                for(var i in resp.data){
                    $("#guess_bar_"+i + " span").css('width',resp.data[i]+"%")
                    $("#guess_text_"+i).html(resp.data[i]+"%")
                }
               }
            })
        })
    })
</script>
</head>
<body>
<div class="bet_box">
    <div style="padding-top: 29px;">
        <h1 style="text-align: center;font-weight: normal;color: rgb(255,145,69)">
        {{$jfConfig->jc_title}}</h1>
        <div class="line"></div>
        <h2 style="text-align: center;color: #fff;font-weight: normal;font-size: 16px;">({{date("Y-m-d")}})</h2>
    </div>
    <div style="margin-top: 20px">
        <div class="fl item">
            <div class="bet-type-bg bet-type-bg1">
                <div  style="padding-left: 59px;padding-top: 124px;">涨跌>10点</div>
            </div>
            <div class="bet-type bet-type1" data-type="1"></div>
            <p class="guess-bar guess-bar-up" id="guess_bar_1"><span style="width: {{$betRes[1]}}%;"></span></p>
            <p class="guess-bar-text"><span id="guess_text_1">{{$betRes[1]}}%</span>的人看涨</p>
        </div>
        <div class="fl item">
            <div class="bet-type-bg bet-type-bg2">
                <div  style="padding-left: 25px;padding-top: 120px;">-10点&le;涨跌&le;10点</div>
            </div>
            <div class="bet-type bet-type2" data-type="2">
                
            </div>
            <p class="guess-bar guess-bar-draw" id="guess_bar_2"><span style="width: {{$betRes[2]}}%;"></span></p>
            <p class="guess-bar-text"><span id="guess_text_2">{{$betRes[2]}}%</span>的人看平</p>
        </div>
        <div class="fl item">
            <div class="bet-type-bg bet-type-bg3">
                <div  style="padding-left: 44px;padding-top: 124px;">涨跌<-10点</div>
            </div>
            <div class="bet-type bet-type3" data-type="3"></div>
            <p class="guess-bar guess-bar-down" id="guess_bar_3"><span style="width: {{$betRes[3]}}%;"></span></p>
            <p class="guess-bar-text"><span id="guess_text_3">{{$betRes[3]}}%</span>的人看跌</p>
        </div>
    </div>
</div>

</body>
</html>
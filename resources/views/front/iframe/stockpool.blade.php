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
	html,body{width:100%;height:100%}
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
		.jinguchi_box {padding:20px;}
.jinguchi_box h5 {font-size:24px;font-weight:normal; padding:10px 0; text-align:center}
.jinguchi_li {padding-bottom:10px;}
.jinguchi_li ul {background:#efefef; padding:5px 10px; border:solid #ddd 1px; }
.jinguchi_li ul li{ float:left; width:33.3%;}
.jinguchi_li .jinguchi_ly {padding:5px 10px;border-bottom:solid #ddd 1px;border-left:solid #ddd 1px;border-right:solid #ddd 1px;}
.jinguchi_box .tan_qq1 {background:#264b71;padding:10px;color:#fff;text-align:left; font-size:24px;}
.jinguchi_box .tan_qq1 li {margin-right:12px;float: left;}
.jinguchi_fx { padding-bottom:20px;line-height:20px;}
.jinguchi_fx h6{font-size:18px ;color:#f00;padding-bottom:10px; text-align:center;}
table{
    width: 100%;
    border-spacing: 0;
    border-collapse: collapse;
    border-top: 1px solid #ccc;
    border-left: 1px solid #ccc;
}
th{
    border-bottom: 1px solid #ccc;
    border-right: 1px solid #ccc;
    padding: 5px 0px;
}

td{
    text-align: center;
     border-bottom: 1px solid #ccc;
    border-right: 1px solid #ccc;
     padding: 5px 0px;
}
.pagination {
    display: inline-block;
    padding-left: 0;
    margin: 20px 0;
    border-radius: 4px;
}
.pagination>li {
    display: inline;
}
.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    z-index: 2;
    color: #fff;
    cursor: default;
    background-color: #337ab7;
    border-color: #337ab7;
}
.pagination>li:first-child>a, .pagination>li:first-child>span {
    margin-left: 0;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}
.pagination>.disabled>a, .pagination>.disabled>a:focus, .pagination>.disabled>a:hover, .pagination>.disabled>span, .pagination>.disabled>span:focus, .pagination>.disabled>span:hover {
    color: #777;
    cursor: not-allowed;
    background-color: #fff;
    border-color: #ddd;
}
.pagination > li > a, .pagination > li > span {
    background-color: #EFF2F7;
    border: 1px solid #EFF2F7;
    float: left;
    line-height: 1.42857;
    margin-left: 1px;
    padding: 6px 12px;
    position: relative;
    text-decoration: none;
    color: #535351;
}
.pagination > li > a, .pagination > li > span {
    background-color: #EFF2F7;
    border: 1px solid #EFF2F7;
    float: left;
    line-height: 1.42857;
    margin-left: 1px;
    padding: 6px 12px;
    position: relative;
    text-decoration: none;
    color: #535351;
}

	</style>
</head>
<body><div class="jinguchi_box">

    <table>
        <thead>
            <tr>
                <th>股票名称(代码)</th>
                <th>买入时间</th>
                <th>买入价格</th>
                <th>卖出时间</th>
                <th>卖出价格</th>
                <th>收益</th>
                <th>推荐人</th>
                <th>描述</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stockPools as $stockPool)
            @if($stockPool->teacher)
                <tr>
                    <td>{{$stockPool->stock_code}}</td>
                    <td>{{$stockPool->buy_time}}</td>
                    <td>{{$stockPool->buy_pri}}</td>
                    <td>{{$stockPool->sell_time}}</td>
                    <td>{{$stockPool->sell_pri}}</td>
                    <td>{{$stockPool->sy}}</td>
                    <td>{{$stockPool->teacher->name}}</td>
                    <td style="max-width:150px;word-wrap: break-word;">{{$stockPool->why}}</td>
                </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    <div>
        {!!$stockPools->render()!!}
    </div>
    @if($qqs->count() > 0)
    <div class="tan_qq1 clearfix box_Fillet3" id="jgcKf" style="margin-top: 5px;">
        <h6>会员查看请登录，非会员请联系下方老师助理领取登录密码</h6>
        <div class="tan_qq1" id="jinguchi_qq1">
        @foreach($qqs as $value)
            <li>
                <a href="http://wpa.qq.com/msgrd?v=3&amp;uin={{$value->qq}}&amp;site=qq&amp;menu=yes" target="_blank"><img src="{{$cdn}}/assets/img/qq_ico.png"></a>
            </li>
        @endforeach
            
        </div>
    </div>
    @endif
   <!-- <div style="padding:10px;">以上仅为研究部观点，不作为具体操作建议，据此操作盈亏自负，股市有风险，投资需谨慎！</div>-->
</div>

</body>
</html>




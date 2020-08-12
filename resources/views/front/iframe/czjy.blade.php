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
table {
    border-spacing: 0;
    border-collapse: collapse;
    width: 100%;
}
.table thead > tr > th, .table tbody > tr > th, .table tfoot > tr > th, .table thead > tr > td, .table tbody > tr > td, .table tfoot > tr > td {
    padding: 5px;
}
tr{
  border-bottom: 1px solid #ddd;
}
td{
    text-align: center;
}
.jinguchi_box{
  padding: 2px 10px;
}
</style>

</head>
<body><div class="jinguchi_box">
    
    @if(!$user->role->f_manual)
        <div style="color: #999; line-height:24px;">
            <div>暂无权限查看此内容，如有疑问，请联系客服。</div>
            @include('front.iframe.inqqs')
        </div>
    @else
        <table class="table dataTable" >
            <thead>
              <tr role='row' >
                <th >标题</th>
                <th >状态</th>
                <th >品种</th>
                <th >方向</th>
                <th >成本价</th>
                 <th >止损价</th>
                  <th >目标价</th>
                   <th >建仓时间</th> 
              </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
            {{-- */$i=0;/* --}}
            @foreach($list as $manual)
            <tr>
     
                  <td>{{$manual->title}}</td>
                  <td >{{$typeDescs[$manual->type]}}</td>
                  <td>{{$manual->variety}}</td>
                  <td>{{$mrMcDescs[$manual->mr_mc]}}</td>
                  <td>{{$manual->cb_price}}</td>
                  <td>{{$manual->zs_price}}</td>
                  <td>{{$manual->mb_price}}</td>
                  <td>{{date('m-d H:i',strtotime($manual->created_at))}}</td>
            </tr>
            @endforeach
            </tbody>
            </table>
    
    <div style="padding:10px;color: red;">以上仅为研究部观点，不作为具体操作建议，据此操作盈亏自负，股市有风险，投资需谨慎！</div>
</div>@endif

</body>
</html>




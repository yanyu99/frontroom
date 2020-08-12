<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1,user-scalable=no,minimum-scale=1.0,maximum-scale=1.0" name="viewport">
    <link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/css/flexible.css">
    <script type="text/javascript" src="{{$cdn}}/assets/js/flexible.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>我的积分</title>
</head>
<style>
    html, body, p {
        padding: 0;
        margin: 0;
        border: 0;
        font-family: '微软雅黑';
        font-size: 0.1867rem;
        background-color: #f1f1f1;
    }
    a {
        text-decoration: none;
    }

    html, body {
        background-color: #f1f1f1;
    }
    .rec_title{
        width: 100%;
        height:1.44rem;
        background-color:#fff;
        color:#949595;
        font-size:0.4533rem;
        line-height: 1.44rem;
        padding-left:0.8rem;
    }
    .rec_title>span{
        color:#FC7700;
    }
    .rec_head{
        width: 100%;
        height:1.1733rem;
        display: flex;
        display: -webkit-flex;
        -webkit-align-items: center;
        padding: 0 0 0 0.32rem;
        background-color: #fff;
    }
    .rec_head ._back{
        display: block;
    }
    .rec_head >a:visited{
    text-decoration: none;
    }
    .rec_head >a:link{
        text-decoration: none;
    }
    .rec_head ._back .back{
        margin-top: 0.2667rem;
        width: 0.4533rem;
        height: 0.6533rem;
    }
    .rec_head .title{
        width: 2.5rem;
        height: 1.1733rem;
        font-size:0.4533rem;
        color: #3b3b3b; 
        text-align: center;
        line-height: 1.1733rem;
        margin-left: 0.2rem;
    }
    .rec_content{
        width: 100%;
        height: auto;
        margin-top: 0.2667rem;
    }
    .rec_content table .head{
        width: 100%;
        height:1.0133rem;
        background: #f1f1f1;
        border-top: 2px solid #dedede;
    }
    .rec_content table .head>th{
        width: 15%;
        height: 1.0133rem;
        font-size: 0.4rem;
        color: #101010;
        text-align: center;
        line-height: 1.0133rem;
    }
    .rec_content table .head>th:nth-child(1){
         width: 15%;
    }
    .rec_content table .head>th:nth-child(2){
         width: 15%;
    }
    .rec_content table .head>th:nth-child(3){
         width: 30%;
    }
    .rec_content table .head>th:nth-child(4){
         width: 30%;
    }
    .rec_content table .cont{
        width: 100%;
        height: 1.0933rem;
        background-color: #fff;
        border-top: 2px solid #dedede;
    }
    .rec_content table .cont:last-child{
         border-bottom: 2px solid #dedede;
    }
    .rec_content table .cont>td{
        width: 15%;
        height: 1.0933rem;
        font-size: 0.3467rem;
        text-align: center;
    }

    #div-iscroll {
        position: absolute;
        bottom: 0px;
        top: 2.6133rem;
        width: 100%;
        overflow-y: auto;
        overflow-x: hidden;
    }
</style>
<body style="overflow-x: hidden;">
    <div class="rec_head">
        <a href="/user/info" class="_back">
            <div class="back"  style="background: url('{{$cdn}}/assets/img/user/arrowL.png') center center no-repeat;background-size: contain;float:left; ">
            </div>
            <div class="title">
                我的积分
            </div>
        </a>
        
    </div>
    <div class="rec_content">
        <div class="rec_title">当前可用积分：<span>{{ !empty($user->extern) ? $user->extern->jf_cur : 0 }}</span> ，送礼积分：<span>{{ !empty($user->extern) ? $user->extern->jf_giftsend : 0 }}</span>
        </div>
        <div id="div-iscroll">
            <div>
                <table width="100%" height="auto" border="0" cellspacing="0" cellpadding="0" class="main">
                    <thead>
                        <tr class="head">
                            <th width="16%">积分</th>
                            <th>类别</th>
                            <th>描述</th>
                            <th>时间</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-jfrecord">

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="{{$cdn}}/assets/js/iscroll-probe.js"></script>
<script type="text/javascript">
    $(function () {
        var myScroll = new IScroll('#div-iscroll', {
            scrollbars: true,
            probeType: 2,
            mouseWheel: true,
            preventDefault: false
        });

        myScroll.on("scrollEnd", function () {
            console.log('y:', this.y, this.distY, this.wrapperHeight, this.pointY);
            if (this.distY < 0) {
                nextPage();
            }
        });
        var page = 0;
        var num = 20;
        var end = false;
        var getting = false;

        function nextPage() {
            if (end || getting) {
                return;
            }
            page += 1;
            console.log('/user/listjfrecord', 'page', page, 'end', end);
            getting = true;
            $.ajax({
                url: '/user/listjfrecord?page=' + page,
                method: 'get',
                success: function (data) {
                    if (data.code != 0) {
                        console.log('/user/listjfrecord error', data.code);
                        return;
                    }
                    console.log('/user/listjfrecord', data.list.length);
                    end = data.list.length < num ? true : false;
                    $.each(data.list, function (idx, val) {
                        var el = '<tr class="cont"> \
                                <td>' + val.jf_num + '</td> \
                                <td>' + (val.jf_num>0?'增加':'消耗') + '</td> \
                                <td>' + val.dsc + '</td> \
                                <td>' + val.created_at + '</td> \
                              </tr>';
                        $('#tbody-jfrecord').append(el);
                        setTimeout(function () {
                            myScroll.refresh();
                        }, 1000)
                    });
                }
            });

            getting = false;
        }

        nextPage();

    });
</script>
</html>

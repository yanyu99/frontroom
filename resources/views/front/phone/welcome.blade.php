<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1,user-scalable=no,minimum-scale=1.0,maximum-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/css/flexible.css">
    <script type="text/javascript" src="{{$cdn}}/assets/js/flexible.js"></script>
    <script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
    <title>{{$room->title}}</title>
</head>
<style type="text/css">
    html,body,ul,li{
        padding:0;
        margin:0;
        border:0;
        font-size: 0.1867rem;
        font-family: "微软雅黑";
    }
    html, body {
        width: 100%;
        height: 100%;
        background-color: #f1f1f1;
        position: fixed;
    }
    .not_head{
        width: 100%;
        height:2.7333rem;
        background-color: #fff;
        margin-top: 0.3333rem;
        padding: 0.22rem 0 0.56rem 0;
        border-top:2px solid #E1E1E1;
        border-bottom:2px solid #E1E1E1;
    }
    .not_head >h4{
        width: 100%;
        height: 0.7333rem;
        color: #575757;
        font-size:0.4267rem;
        padding: 0.1rem 0 0 0.4rem;
        font-weight: bold;
    }
    .not_head p{
        width: 100%;
        height: 1.04rem;
        color: #919191;
        font-size: 0.32rem;
        margin-top: 0.1333rem;
        padding: 0 0 0 0.4rem;
    }
    .not_player{
        width: 100%;
        height: 5.76rem;
        background-color: white;
        padding-top: 0.1333rem;
    }
    .not_player h4{
        color: #575757;
        font-size: 0.4267rem;
        padding: 0.1333rem 0 0 0.4rem;
        font-weight: bold;
    }
    .not_player .player{
        width: 100%;
        height:2.7rem;
        border-bottom:3px solid #E1E1E1;
        overflow:hidden;
    }
    .not_player .player ._player{
        display: flex;
        display: -webkit-flex;
        -webkit-flex-wrap:nowrap;
        height:2.7rem;
        overflow-x: scroll;
    }
    ::-webkit-scrollbar {
        display: none;
    }

    .not_player .player .top{
        width: 1.7333rem;
        height: 2.2rem;
        margin-left: .78rem;
        margin-top: 0.2667rem;
        text-align: center;
    }
    .not_player .player .top:last-child{
        margin-right: .7rem;
    }
    .not_player .player .top>img{
        width: 2.3333rem;
        height:2.3333rem;
        border-radius: 50%;
        margin-bottom: 0.2rem;
    }
    .not_player .player .top>span{
        font-size: 0.2667rem;
        color:#949595;
    }
    .not_player .follow{
        width:100%;
        height:2.3rem;
        border-bottom:3px solid #E1E1E1;
        float:left;
    }
    .not_player .follow .num{
        width: 100%;
        height: 0.6667rem;
    }
    .not_player .follow .num>p{
        width: 2.9333rem;
        height:100%;
        float: left;
        text-align: center;
        font-size: 0.2667rem;
        color:#444;
        line-height: 0.6667rem;
    }
    .not_player .follow .num>p>span{
        color:#fc7700;
    }
    .not_player .follow .per{
        width:100%;
        height: 1rem;
        overflow: hidden;
        margin-top: 0.1333rem;
    }

    .not_player .follow .per li{
        height: .85rem;
        margin-top: 0.2667rem;
        position: absolute;
        background-color: white;
        overflow-x:scroll;
    }
    ::-webkit-scrollbar {
        display: none;
    }
    
    .not_player .follow .per li.dis{
        display: block;
        z-index: 10;
    }
    .not_player .follow .per li.hid{
        display: none;
    }
    .not_tody{
        width: 100%;
        height:6.1rem;
        background-color: white;
        margin-top: 0.2667rem;
        border-top:2px solid #E1E1E1;
        border-bottom:2px solid #E1E1E1;
    }
    .not_tody >h4{
        color: #575757;
        font-size: 0.4267rem;
        padding: 0.25rem 0 0 0.4rem;
        font-weight: bold;
    }
    .not_tody .text{
        width: 100%;
        height:auto;
        font-size: 0.2667rem;
        padding: 0.1333rem 0 0 0.4rem;
        color:#A1A1A1;
        overflow: auto;
    }
   .not_into{
        display: block;
        width: 100%;
        height:1.3333rem;
        margin-top: 0.1333rem;
        color: #fff;
        font-size: 0.5867rem;
        background-color: #00aeee;
        text-align: center;
        line-height: 1.3333rem;
        position: fixed;
        left:0;
        bottom: 0;
    }
     
</style>
<body style="overflow-x: hidden;">
<div class="not_head">
    <h4>房间公告</h4>
    <p>{{$room->notice_msg}}</p>
</div>
<div class="not_player">
    <h4>参赛选手</h4>
    <div class="player" id="player">
        <ul class="_player">
            @foreach($teachers as $key =>$teacher)
                @if($teacher)
                    <li data-id="{{$teacher['id']}}" 
                        id="hot-tid-{{$teacher['id']}}"  
                        data-hot="{{$teacher['hot_got']+$teacher['hot_base']}}"
                        data-jf="{{$teacher['jf_got']}}"
                        class="top">
                        <img src="{{ !empty($teacher['imgurl']) ? $teacher['imgurl'] : '/assets/img/user/user.png' }}" style="width: 1.56rem;height: 1.56rem;">
                        <span>{{$teacher['name']}}</span>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

    <div class="follow">
        <div class="num">
            <p>人气：<span id="pop"></span></p>
            <!-- <p>礼物总数：<span id="sum"></span></p> -->
        </div>
        <div class="per" id="per" style="overflow-x: auto;">
            @foreach($teachers as $key =>$teacher)
                @if($teacher)
                    <div  id="user-{{$teacher['id']}}" class="user-list" style="display: none">
                        @foreach($teacher['hot_user'] as $user)
                            <span><img src="{{$user['user']['pic']}}" style="width:0.8rem;height: 0.8rem;border-radius: 50%;margin-left:0.5rem;"/></span>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
<div class="not_tody">
    <h4>今日赛事</h4>
    <div class="text">
        {!! $mobile_welcome !!}
    </div>
</div>
<a class="not_into" href="/?_skip=1&_enter=1">进入赛场</a>
</body>
<script type="text/javascript">
    $(function () {
        $('#player').on('click','li',function () {
            var id = $(this).data('id');
            $('.user-list').css({'display':'none'});
            $('#user-' + id).css({'display':'inline-flex'});
            $('#pop').text($(this).data('hot'));
            $('#per').scrollLeft(0);
            // $('#sum').text($(this).data('jf'));
        });
        $('.user-list:eq(0)').css({'display':'inline-flex'});
        $('#pop').html($('#player li:eq(0)').data('hot'));
        // $('#sum').html($('#player li:eq(0)').data('jf'));

    });

</script>
</html>




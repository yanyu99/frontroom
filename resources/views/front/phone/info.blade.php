<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1,user-scalable=no,minimum-scale=1.0,maximum-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/css/flexible.css">
    <script type="text/javascript" src="{{$cdn}}/assets/js/flexible.js"></script>
    <title>个人中心</title>
</head>
<style type="text/css">
    html, body, p, ul, li {
        padding: 0;
        border: 0;
        margin: 0;
        font-family: "微软雅黑";
        font-size: 0.1867rem;
    }
    a {
        text-decoration: none;
    }
    html, body {
        background-color: #f1f1f1;
    }
    .per_banner {
        width: 100%;
        height: 4.9867rem;
        position: relative;
    }
    .per_banner > img {
        position: absolute;
        width: 100%;
        height: 100%;
    }
    .per_banner .user {
        width: 1.8667rem;
        height: 1.8667rem;
        position: absolute;
        top: 0.5733rem;
        left: 50%;
        -webkit-transform: translate(-50%, 0);
        z-index: 1;
        border: 0.04rem solid #fff;
        border-radius: 50%;
        background: url("{{$cdn}}/assets/img/avatar/t3/32/16.png") center center no-repeat;
        background-size: contain;
    }
    .per_banner .name {
        width: 100%;
        height: 0.4267rem;
        text-align: center;
        line-height: 0.4267rem;
        color: #fff;
        font-size: 0.4267rem;
        position: absolute;
        top: 2.9733rem;
        z-index: 1;
    }
    .per_banner .bottom {
        width: 100%;
        height: 1.6rem;
        display: flex;
        display: -webkit-flex;
        position: relative;
        top: 3.9333rem;
        z-index: 1;
    }
    .per_banner .bottom .left {
        -webkit-flex: 7;
        display: flex;
        display: -webkit-flex;
        -webkit-justify-content: center;
        padding: 0 0 0 0.4rem;
    }
    .per_banner .bottom .left .grade {
        margin-left: 0.3rem;
    }
    .per_banner .bottom .right {
        -webkit-flex: 4;
    }
    .per_banner .bottom > a, .per_banner .bottom {
        color: white;
        font-size: 0.32rem;
    }
    .per_content {
        width: 100%;
        height: auto;
        margin-top: 0.2667rem;
    }
    .per_content > li {
        width: 100%;
        height: 1.4133rem;
        background-color: white;
        border: 1px solid #e4e4e4;
        line-height: 1.4133rem;
    }
    .per_content > li:nth-child(4) {
        margin-top: 0.2667rem;
    }
    .per_content > li > a {
        color: #575757;
        font-size: 0.4267rem;
        display: block;
        display: flex;
        display: -webkit-flex;
        flex-wrap: nowrap;
        -webkit-flex-wrap: nowrap;
        -webkit-align-items: center;
    }
    .per_content > li > a > .img {
        /* width: 0.7333rem; */
        height: 0.95rem;
       /*  background: url("{{$cdn}}/assets/img/user/icon.png") center center no-repeat; */
        background-size: contain;
        margin-left: 0.5333rem;
        margin-right: 0.2667rem;
        display: flex;
        display: -webkit-flex;
        -webkit-align-items: center;
    }
    .item-icon-img{
        height: 0.95rem;
        width: 0.95rem;;
    }
    .per_content > li > a > .go {
        width: 0.4267rem;
        height: 0.6667rem;
        background: url("{{$cdn}}/assets/img/user/arrowR.png") center center no-repeat;
        background-size: contain;
        margin-left: 6rem;
    }
    .per_foot {
        width: 100%;
        height: 1.6rem;
        background-color: white;
        border: 1px solid #e4e4e4;
        position: fixed;
        bottom: 0;
        left: 0;
    }
    .per_foot > a {
        width: 50%;
        height: 100%;
        float: left;
        display: flex;
        display: -webkit-flex;
        -webkit-align-items: center;
        -webkit-justify-content: center;
    }
    .per_foot > a > div {
        width: 2rem;
        height: 100%;
        display: flex;
        display: -webkit-flex;
        flex-wrap: wrap;
        -webkit-flex-wrap: wrap;
        -webkit-align-items: center;
        -webkit-justify-content: center;
    }
    .per_foot > a .broadcast {
        width: 1.0133rem;
        height: 0.88rem;
        background: url("{{$cdn}}/assets/img/user/tabicon_02.png") center center no-repeat;
        background-size: contain;
    }
    .per_foot > a .user {
        width: 1.0133rem;
        height: 0.88rem;
        background: url("{{$cdn}}/assets/img/user/tabicon_03.png") center center no-repeat;
        background-size: contain;
    }
    .per_foot > a .broadcast + span {
        font-size: 0.3733rem;
        color: #818181;
    }
    .per_foot > a .user + span {
        font-size: 0.3733rem;
        color: #00aeee;
    }

</style>
<body style="overflow-x: hidden;">
<div class="per_banner">
    <img src="{{$cdn}}/assets/img/user/topbg.jpg" width="100%" height="100%">
    <div class="user" style=""></div>
    <div class="name">{{$user->name}}</div>
    <div class="bottom">
        <div class="left">
            <span>我的角色 : </span>
            <div class="grade">{{$user->role->name}}</div>
        </div>
        <a class="right" href="/auth/logout?referer=%2F&mobile=1">
            登出
        </a>
    </div>
</div>
<ul class="per_content">
    {{-- */
        $menu_list = [
                '我的积分' => [
                    'pic' => $cdn . '/assets/img/user/icon_02.png',
                    'href' => '/user/jfrecord',
                    'icon'=>'1',
                ],
                '红包记录'=> [
                    'pic' => $cdn . '/assets/img/user/icon_03.png',
                    'href' => '/user/luckmoney',
                    'icon'=>'2',
                ],
                '推广记录'=>[
                    'pic' => $cdn . '/assets/img/user/icon_04.png',
                    'href' => '/user/recommend',
                    'icon'=>'3',
                ]
            ];
        if( !empty($power_config) && $power_config->change_pwd ){
            $menu_list['修改密码'] = [
                'pic' => $cdn . '/assets/img/user/icon_05.png',
                'href' => '/user/editpwd',
                'icon'=>'4',
            ];
        }
     /* --}}
    @foreach($menu_list as $key => $item)
        <li class="{{$item['icon']}}">
            <a href={{$item['href']}}>
                <div class="img"><img class="item-icon-img" src="{{$item['pic']}}" alt=""></div>
                <span>{{$key}}</span>
                <div class="go"></div>
            </a>
        </li>
    @endforeach
</ul>
<div class="per_foot">
    <a href="/?_skip=1">
        <div id="broadcast">
            <div class="broadcast"></div>
            <span>直播间</span>
        </div>
    </a>
    <a href="/user/info">
        <div>
            <div class="user"></div>
            <span>个人中心</span>
        </div>
    </a>
</div>
</body>
</html>

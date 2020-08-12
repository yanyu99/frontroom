<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>系统登录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/css/phone/room.css?v={{$webver}}">

    <style type="text/css">
        html {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #backgroundImage {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: -1;
        }
        #backgroundImage img {
            width: 100%;
            height: 100%;
        }
        .container {
            background-color: #DFBF6C;
            position: absolute;
            top: 33%;
            left: 5%;
            width: 90%;
            z-index: 10;
        }
        .ul-group {
            margin-left: 10%;
            width: 80%;
        }
        .li-item {
            margin-bottom: 0.5rem;
            height: 3rem;
        }
        .login-title {
            text-align: center;
            width: 100%;
            color: #543706;
        }
        .login-submit {
            border: 0.2rem solid #4B2B02;
            -moz-border-radius: 0.2rem;
            -webkit-border-radius: 0.2rem;
            border-radius: 0.2rem;
            width: 60%;
            height: 2.2rem;
            font-size: 1.4rem;
            color: #E7CD76;
            background: #4B2B02;
        }
        .input-submit{
            height: 2.5rem;
            margin-left: 20%;
            vertical-align: middle;
            line-height: 2.5rem;
        }
        .login-error {
            color: red;
        }
        .input-text{
            height: 1.8rem;
            width: 70%;
        }
    </style>
</head>
<body>
<div id="backgroundImage">
    <img src="{{ !empty($sysConfig->reg2_mobile_bg) ?  $sysConfig->reg2_mobile_bg : $cdn . '/assets/img/phone/login/coupon_mobile_bg.jpg'}}"/>
</div>
<div class="container">

    <form id="js-data-form" action="/auth/login" method="post">
        {{$ctrl->csrf_field()}}
        <input type="hidden" value="1" name="front"/>
        <input type="hidden" value="{{$back}}" name="back"/>
        <input type="hidden" value="{{$roomId}}" name="roomId"/>

        <ul class="ul-group">
            <li>
                <h1 class="login-title">入场券</h1>
                @if($ctrl->errors_has('login'))
                    <span class="login-error">{{$ctrl->errors_first('login', ':message')}}</span>
                @endif
            </li>
            <li class="li-item">
                <span class="input-login">
                    <i class="span-i">
                        券号：
                    </i>
                    <input class="input-text" id="name" name="login" placeholder="" value="{{$ctrl->old('login')}}" type="text">
                </span>
            </li>
            <li class="li-item">
                <span class="input-password">
                    <i class="span-i">
                        密码：
                    </i>
                    <input class="input-text" id="password" name="password" placeholder="" type="password">
                </span>
            </li>
            <li class="li-item">
                <span class="input-submit">
                    <button class="login-submit" type="submit">
                        登 录
                    </button>
                </span>
            </li>
        </ul>
    </form>
</div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style type="text/css">
        html, body, ul, li, p {
            padding: 0px;
            border: 0px;
            margin: 0px;
            font-family: "微软雅黑";
            font-size: 14px;
        }

        html, body {
            overflow: hidden;
        }

        .container {
            width: 1110px;
            height: 564px;
            padding: 5px;
        }

        .sider {
            width: 165px;
            height: 100%;
            border: 1px solid #EEE;
            background-color: #f2f2f2;
            float: left;
        }

        .warp {
            float: left;
            padding-left: 10px;
            width: 930px;
            height: 100%;

            overflow: hidden;
        }

        .warp .title {
            height: 40px;
            border-bottom: 1px solid #EEE;
            line-height: 40px;

        }

        .warp .title span {
            line-height: 26px;
            padding-left: 10px;
            display: inline-block;
            border-left: 2px solid #189ccf;
        }

        .warp .content {
            clear: both;
            height: 10px;

        }

        a {
            text-decoration: inherit;
            color: #333;
        }

        .sider a {
            display: block;
            width: 100%;
            text-align: center;
            line-height: 38px;
            height: 38px;
            font-size: 16px;
            color: #0293ca;
        }

        .sider .on {
            background-color: #0293ca;
            color: #eee;
        }

        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 10px 0;
            border-radius: 4px;
        }

        .pagination > li {
            display: inline;
        }

        .pagination > .active > a, .pagination > .active > a:focus, .pagination > .active > a:hover, .pagination > .active > span, .pagination > .active > span:focus, .pagination > .active > span:hover {
            z-index: 2;
            color: #fff;
            cursor: default;
            background-color: #337ab7;
            border-color: #337ab7;
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

        .pagination > li:first-child > a, .pagination > li:first-child > span {
            margin-left: 0;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }

        .pagination > .disabled > a, .pagination > .disabled > a:focus, .pagination > .disabled > a:hover, .pagination > .disabled > span, .pagination > .disabled > span:focus, .pagination > .disabled > span:hover {
            color: #777;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd;
        }
    </style>
    @yield('head')
</head>
<body>
<div class="container">
    <div class="sider">
        <a @if($ctrl->path() == 'shop/myorder') class="on" @endif href="/shop/myorder">我的订单</a>
        <a @if($ctrl->path() == 'shop/myjf') class="on" @endif href="/shop/myjf">积分流水</a>
        @foreach($shopCategorys as $item)
            <a @if($item->id == $categoryId) class="on"
               @endif  href="/shop/commoditys/{{$item->id}}">{{$item->name}}</a>
        @endforeach
    </div>
    <div class="warp">
        <div class="title">
            <span>@yield("title")</span>
        </div>
        <div class="content">
            @yield('content')
        </div>
        <div>

        </div>
    </div>
</div>
</body>
</html>
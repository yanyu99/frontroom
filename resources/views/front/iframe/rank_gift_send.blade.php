<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <style type="text/css">
        body {
            background-repeat: no-repeat;
            width: 280px;
            height: 380px;
            margin: 0px;
            color: #000;
            position: relative;
            overflow: hidden;
            font-family: "Microsoft YaHei";
        }

        table {
            width: 280px;
        }

        tr {
            line-height: 30px;
            color: #000;
            font-size: 14px;
            text-align: center;
        }

        td {
            white-space: nowrap;
            max-width: 60px;
            overflow: hidden;
        }

        .rank-border {
            width: 26px;
            height: 26px;
            overflow: hidden;
            border-radius: 15px;
            background: #E5E5E5;
            line-height: 26px;
            margin: auto;
        }

        .rank-border-1 {
            background: #F3D10B;
        }

        .rank-border-2 {
            background: #B2B2B2;
        }

        .rank-border-3 {
            background: #CB6500;
        }
    </style>
    <script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
</head>
<body style="">

<table>
    <thead>
    <tr>
        <th style="width: 20%">名次</th>
        <th style="width: 40%">昵称</th>
        <th style="width: 40%">送礼积分</th>
    </tr>
    </thead>
    <tbody>
    {{-- */$i=1;/* --}}
    @foreach($list as $item)
        <tr>
            <td style="width: 20%">
                <div class="rank-border rank-border-{{$i}}">{{$i++}} </div>
            </td>
            <td style="width: 40%;">{{$item->user->name}}</td>
            <td style="width: 40%;">{{$item->jf_giftsend}}</td>

        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
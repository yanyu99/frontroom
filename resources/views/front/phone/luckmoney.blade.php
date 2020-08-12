<!doctype html>
<html lang="en">
<head>
    <meta content="width=device-width, initial-scale=1,user-scalable=no,minimum-scale=1.0,maximum-scale=1.0" name="viewport">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/css/flexible.css">
    <link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/css/phone_rem/common.css">
    <script type="text/javascript" src="{{$cdn}}/assets/js/flexible.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>红包记录</title>
    <style type="text/css">
        #div-iscroll {
            position: absolute;
            bottom: 0px;
            top: 1.1733rem;
            width: 100%;
            overflow-y: auto;
            overflow-x: hidden;
        }
    </style>
</head>
<body style="overflow-x: hidden;">
<div class="rec_head">
     <a href="/user/info" class="_back">
            <div class="back"  style="background: url('{{$cdn}}/assets/img/user/arrowL.png') center center no-repeat;background-size: contain;float:left; ">
            </div>
            <div class="title">
                红包记录
            </div>
        </a>
</div>
<div class="rec_content" id="div-iscroll">
    <div>
        <table width="100%" height="auto" border="0" cellspacing="0" cellpadding="0" class="main">
            <thead>
            <tr class="head">
                <th>发送方</th>
                <th>获得金额</th>
            </tr>
            </thead>
            <tbody id="tbody-luckmoney">
            </tbody>

        </table>
    </div>
</div>
</body>
</html>
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
            console.log('/user/listluckmoney', 'page', page, 'end', end);
            getting = true;
            $.ajax({
                url: '/user/listluckmoney?page=' + page,
                method: 'get',
                success: function (data) {
                    if (data.code != 0) {
                        console.log('/user/listluckmoney error', data.code);
                        return;
                    }
                    console.log('/user/listluckmoney', data.list.length);
                    end = data.list.length < num ? true : false;
                    $.each(data.list, function (idx, val) {
                        var el = '<tr class="cont"> \
                                <td>' + val.sendUser.name + '</td> \
                                <td>' + (val.money/100) + '</td> \
                              </tr>';
                        $('#tbody-luckmoney').append(el);
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
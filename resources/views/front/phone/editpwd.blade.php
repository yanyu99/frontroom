<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1,user-scalable=no,minimum-scale=1.0,maximum-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{$cdn}}/assets/css/flexible.css">
    <script type="text/javascript" src="{{$cdn}}/assets/js/flexible.js"></script>
    <link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/artDialog/css/ui-dialog.css">
    <title>密码</title>
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
    .co_head {
        width: 100%;
        height: 1.1733rem;
        padding: 0 0.32rem;
        display: flex;
        display: -webkit-flex;
        -webkit-align-items: center;
    }
    .co_head ._back{
        display: block;
        float: left;
    }
    .co_head >a:visited{
        text-decoration: none;
    }
    .co_head >a:link{
        text-decoration: none;
    }
    .co_head .back {
        width: 0.4533rem;
        height: 0.6533rem;
        background: url('{{$cdn}}/assets/img/user/arrowL.png') center center no-repeat;
        background-size: contain;
        margin-top: 0.2667rem;
    }
    .co_head .title {
        width: 2.5rem;
        height: 1.1733rem;
        font-size: 0.4533rem;
        color: #3b3b3b;
        text-align: center;
        line-height: 1.1733rem;
        margin-left: 0.2rem;
    }
    .co_content {
        width: 100%;
        height: auto;
        display: flex;
        display: -webkit-flex;
        flex-wrap: wrap;
        -webkit-align-items: center;
        background-color: #fff;
    }
    .co_content form {
        width: 100%;
    }
    .co_content li {
        width: 100%;
        height: 2.1333rem;
        border-top: 1px solid #e1e1e1;
        background-color: #fff;
        padding: 0 0 0 0.4667rem;
    }
    .co_content li:nth-child(3) {
        border-bottom: 1px solid #e1e1e1;
    }
    .co_content li > div {
        width: 100%;
        height: 0.6933rem;
        color: #565656;
        font-size: 0.4rem;
        margin-top: 0.5333rem;
    }
    .co_content li input {
        width: 100%;
        height: 0.5333rem;
        border: 0;
        outline: 0;
        font-size: 0.4rem;
    }
    .co_submit {
        width: 9.6rem;
        height: 1.3333rem;
        margin-top: 0.1333rem;
        margin-left: 0.2rem;
    }
    .edit-btn {
        display: block;
        width: 100%;
        height: 100%;
        color: #fff;
        font-size: 0.5867rem;
        border: 0;
        background-color: #00aeee;
        text-align: center;
        line-height: 1.3333rem;
    }
    input::-webkit-input-placeholder {
        font-size: 0.2933rem;
    }
    input:-moz-placeholder {
        font-size: 0.2933rem;
    }
    input::-moz-placeholder {
        font-size: 0.2933rem;
    }
    input:-ms-input-placeholder {
        font-size: 0.2933rem;
    }
    .ui-dialog-title,.ui-dialog-content{
        font-size: 0.4rem;
    }
</style>
<body style="overflow-x: hidden;">
<div class="co_head">
    <a href="/user/info" class="_back">
            <div class="back"  style="background: url('{{$cdn}}/assets/img/user/arrowL.png') center center no-repeat;background-size: contain;float:left; ">
            </div>
            <div class="title">
                修改密码
            </div>
    </a>
</div>
<form action="">
    <ul class="co_content">
        <li>
            <div>原始密码</div>
            <input type="password" id="old_pasw" placeholder="请输入原密码">
        </li>
        <li>
            <div>新密码</div>
            <input type="password" id="new_pasw" placeholder="请输入新密码">
        </li>
        <li>
            <div>新密码确认</div>
            <input type="password" id="repeat_pasw" placeholder="再次输入新密码">
        </li>
    </ul>
    <div class="co_submit">
        <span class="edit-btn"  onclick="submitPwd()" >确认修改</span>
    </div>

</form>
</body>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/artDialog/dialog-min2.js"></script>
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ $ctrl->csrf_token() }}'
            }
        });
    });

    function submitPwd(){
        var old_pasw = $('#old_pasw').val(),
                new_pasw = $('#new_pasw').val(),
                repeat_pasw = $('#repeat_pasw').val();

        if(old_pasw.length==0 || new_pasw.length==0 || repeat_pasw.length==0){
            dialog({title:"提示",content:"请输入原密码和新密码!",quickClose: true}).show();
            return ;
        }
        if(new_pasw!=repeat_pasw){
            dialog({title:"提示",content:"两次输入的密码不一致!",quickClose: true}).show();
            return ;
        }
        $.ajax({
            type: 'POST',
            url: '/user/editpwd',
            data: {old_pwd:old_pasw, new_pwd:new_pasw, repeat_pwd: repeat_pasw},
            dataType: 'json',
            async: true,
            success: function(data) {
                if(data.code==0){
                    dialog({title:"提示",content:"修改成功",quickClose: true,}).show();
                    setTimeout(function(){
                        location.href = '/?_skip=1';
                    }, 1000);
                } else {
                    dialog({title:"提示",content:data.msg,quickClose: true}).show();
                }
            }
        });
    }
</script>
</html>


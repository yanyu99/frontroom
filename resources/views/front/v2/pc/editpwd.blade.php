@extends('front.v2.pc.pcbase')
@section('title')
修改密码
@endsection
@section('head')
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/artDialog/css/ui-dialog.css">
<style type="text/css">
    .co_content {
        width: 100%;
        height: auto;
        display: flex;
        display: -webkit-flex;
        flex-wrap: wrap;
        -webkit-align-items: center;
        background-color: #fff;
        margin-top: 10px;
    }
    .co_content form {
        width: 100%;
    }
    .co_content .co_box {
        width: 100%;
        height: 60px;
        border: 1px solid #e1e1e1;
        background-color: #fff;
        padding: 0 0 0 0.4667rem;
    }
    .co_content .co_box > label {
        display: block;
        width: 130px;
        height:35px;
        color: #565656;
        font-size: 18px;
        margin-top: 20px;
        float: left;
    }
    .co_content .co_box .inputs {
        width: 200px;
        font-size: 20px;
        float: left;
        margin-top:20px;
        margin-left: 30px;

    }
    .co_content .co_box .inputs >input{
        border:0;
        outline: none;
    }
    .co_submit {
        width: 100px;
        height: 30px;
        margin-top: 10px;
        cursor: pointer;
    }
    .edit-btn {
        display: block;
        border-radius: 3px;
        width: 100%;
        height: 100%;
        color: #fff;
        font-size: 16px;
        border: 0;
        background-color: #00aeee;
        text-align: center;
        line-height: 30px;
    }
    input::-webkit-input-placeholder {
        font-size: 12px;
    }
    input:-moz-placeholder {
        font-size: 12px;
    }
    input::-moz-placeholder {
        font-size: 12px;
    }
    input:-ms-input-placeholder {
        font-size: 12px;
    }
    .ui-dialog-title,.ui-dialog-content{
        font-size: 18px;
    }
    .title>span{
        margin-top: 7px;
    }
</style>
@endsection
@section('content')
<form action="">
    <div class="co_content">
        <div class="co_box">
            <label>原始密码：</label>
            <div class="inputs">
                <input type="password" id="old_pasw" placeholder="请输入原密码">
            </div>
        </div>
        <div class="co_box">
            <label>新密码：</label>
            <div class="inputs">
                <input type="password" id="new_pasw" placeholder="请输入新密码">
            </div>
        </div>
        <div class="co_box">
            <label>新密码确认：</label>
            <div class="inputs">
                <input type="password" id="repeat_pasw" placeholder="再次输入新密码">
            </div>
        </div>
    </div>
    <div class="co_submit">
        <span class="edit-btn"  onclick="submitPwd()" >确认修改</span>
    </div>
</form>
@endsection
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
                    var d = dialog({title:"提示",
                        content:"修改成功",
                        ok: true,
                        statusbar: '<label><input type="checkbox">不再提醒</label>'
                    });
                    d.show();
                } else {
                    dialog({title:"提示",content:data.msg,quickClose: true}).show();
                }
            }
        });
    }
</script>

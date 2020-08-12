<!DOCTYPE html>
<html >
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>{{$room->title}}</title>
<style type="text/css">
	html{
		width: 100%;
    background-color:#f2f2f2;
	
	}
	body{
		width: 100%;
    margin:0px;
	
	}
    header img {
    width: 100%;
    margin: 0 auto;
    /* height: 215px; */
    background-size: 100%;
    z-index: 1;
    text-align: center;
  }

  .p-tit {
    text-align: center;
    font-size: 24px;
    line-height: 60px;
    color: #424242;
    margin-top: 30px;
  }

  .p-tit label {
    color: #fe9901;
  }

  header span {
    font-size: 54px;
    color: #fff;
    line-height: 315px;
    display: inline-block;
  }

  .sec-box {
    padding: 0px 22px;
  }

  .btn-ui {
    background-color: #fe9901;
    font-size: 42px;
    position: relative;
    display: block;
    margin-left: auto;
    margin-right: auto;
    padding-left: 14px;
    padding-right: 14px;
    box-sizing: border-box;
    font-size: 18px;
    text-align: center;
    text-decoration: none;
    color: #ffffff;
    line-height: 2.55555556;
    border-radius: 5px;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    overflow: hidden;
  }

  .login-a {
    font-size: 34px;
    color: #0471bd;
    text-align: center;
    line-height: 34px;
    vertical-align: middle;
    margin: 40px auto;
    width: 100%;
    display: inline-block;
  }

  .weui-cells__title+.weui-cells {
    margin-top: 0;
  }

  .weui-cells {
    margin-top: 1.17647059em;
    background-color: #ffffff;
    line-height: 1.47058824;
    font-size: 17px;
    overflow: hidden;
    position: relative;
    margin: 10px 20px;
    border: 1px solid #eee;
  }

  .weui-cell {
    height: 47px;
    padding: 5px 8px;
    position: relative;
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    align-items: center;
    /* border-bottom: 1px solid #ebebeb; */
    border: 2px solid #e8e8e8;
  }

  .weui-label {
    font-size: 16px;
    display: block;
    padding-left: 15px;
    width: 80px;
    word-wrap: break-word;
    word-break: break-all;
  }

  .weui-cell__bd {
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    flex: 1;
  }

  .weui-cells_form input,
  .weui-cells_form textarea,
  .weui-cells_form label[for] {
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  }

  .weui-input {
    width: 100%;
    border: 0;
    outline: 0;
    -webkit-appearance: none;
    background-color: transparent;
    font-size: inherit;
    color: inherit;
    height: 1.47058824em;
    line-height: 1.47058824;
    font-size: 16px;
  }

  .weui-cell__ft {
    text-align: right;
    color: #999999;
  }

  button.weui-vcode-btn {
    background-color: transparent;
    border-top: 0;
    border-right: 0;
    border-bottom: 0;
    outline: 0;
  }

  .weui-vcode-btn {
    display: inline-block;
    height: 45px;
    margin-left: 5px;
    padding: 0 0.6em 0 0.7em;
    border-left: 1px solid #e5e5e5;
    line-height: 45px;
    vertical-align: middle;
    font-size: 17px;
    color: #00aeee;
  }

  .btn-comm {
    height: 52px;
    line-height: 52px;
    font-size: 22px;
    width:100%;
    border:0 none;
  }
	</style>
</head>
<body>
<div class="login-view">

    <header>
      @if(!empty($sysConfig->mobile_pwd_bg))
         <img src="{{$sysConfig->mobile_pwd_bg}}" />
      @else
         <img src="/assets/v3/images/phone/pwd_bg_phone.jpg" title="" alt="" />
       @endif
    </header>

    <p class="p-tit ">欢迎来到  
      <label>{{$room->title}}</label>
    </p>


    <form id="goin-form" action="/verify/{{$room->id}}" method="post">
      <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
          <div class="weui-cell__hd">
            <label class="weui-label">
              <img src="/assets/v3/images/phone/lock.png"  width="30" />
            </label>
          </div>
          <div class="weui-cell__bd">
            <input class="weui-input" type="password" name ="password" id="password"  pattern="[0-9]*" placeholder="请输入房间密码" v-model="password">
          </div>
        </div>
      </div>

      <section class="sec-box">
        <button class="btn-ui btn-register  btn-comm" type="submit">进入房间</button>
      </section>
  </form>
  @if($ctrl->errors_has('verify'))
				<div class="alert alert-warning alert-dismissible fade in" role="alert" style="text-align: center;
    color: red;"> <strong>错误:</strong>
					{{$ctrl->errors_first('verify', ':message')}}
				</div>
				@endif
  </div>

</body>
</html>
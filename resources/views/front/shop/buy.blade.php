@extends('front.shop.base')
@section('title')
商品详情
@endsection
@section("head")
<style type="text/css">
.content{
  margin-top: 10px;
}
.content .info{
  padding: 5px;background-color: #f2f2f2;float: left;border: 1px solid #EEE;border-bottom: 2px solid #bcbcbc;
}
.btn{
  display: inline-block;
  padding: 3px 15px;
  border: 2px solid #0293ca;
  border-radius: 5px;
  color: #0293ca;
}
.info-right{
  float: left;
  margin-left: 20px;
}
.info-right p{
  padding: 8px 0px;
}
.pop-box{
  position: absolute;
  left: 334px;
  top: 135px;
  width: 550px;
  height: 300px;
      border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
    box-shadow: 0 0 12px #888888;

}
.pop-box .close{
  position: absolute;
    top: 1px;
    right: 6px;
    color: #666;
    font-size: 14px;
    cursor: pointer;
}
.pop-box .head{
  font-size: 18px;
    padding: 15px;
    margin: 0px;
    border-bottom: 1px solid #ccc;
}
.submit-btn{
    border: none;
    background-color: #0275d8;
    padding: 5px 29px;
    border-radius: 5px;
    color: #fff;
    font-family: 微软雅黑;
    margin-left: 84px;
    margin-top: 10px;
}
form{
    width: 300px;
    margin: auto;
    margin-top: 30px;
}
.form-item{
  margin-bottom: 10px;
}
.form-item input{
  border-radius: 5px;
  padding: 10px;
  border: none;
  border: 1px solid #ccc;

}
.msg-box{
  position: absolute;
  left: 334px;
  top: 135px;
  width: 250px;
  height: 150px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #fff;
  box-shadow: 0 0 12px #888888;
}
.msg-box .head{
    font-size: 18px;
    padding: 10px;
    margin: 0px;
    border-bottom: 1px solid #ccc;
}
.msg-box .body{
    text-align: center;
    margin-top: 30px;
}
   .msg-box .close{
  position: absolute;
    top: 1px;
    right: 6px;
    color: #666;
    font-size: 14px;
    cursor: pointer;
} 
</style>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
@endsection
@section('content')
<div class="info" >
  <img src="{{$shopCommodity->imgurl}}" style="width: 214px;height: 141px;">
</div>
<div class="info-right">
  <p>名称：{{$shopCommodity->name}}</p>
  <p>积分：<span id="idPrice" style="color: red;" data-price="{{$shopCommodity->price}}">{{$shopCommodity->price}}</span></p>
  <p>数量：<input id="idNumInput" type="text" style="width: 50px;" value="1" >库存剩余<span style="color: red;" id="idKC">{{$shopCommodity->total-$shopCommodity->saled}}</span>件</p>
  <p style="margin-top: 5px;"><a href="javascript:;" class="btn buybtn">兑换商品</a></p>
</div>
<div style="clear: both;"></div>
<div style="margin-top: 10px;">{{$shopCommodity->dsc}}</div>
<div class="pop-box" style="display: none;">
  <div class="head">填写信息</div>
  <span class="close">x</span>
  <form id="idForm" method="post" action="/shop/buy">
  <input type="hidden" name="id" value="{{$shopCommodity->id}}">
  <input type="hidden" name="num" value="1" id="idFormNum">
    <div class="form-item">
      收件人姓名：<input type="text" name="name">
    </div>
    <div class="form-item">
      收件人电话：<input type="text" name="phone">
    </div>
    <div class="form-item">
      收件人地址：<input type="text" name="address">
    </div>
    <div class="form-item">
      <button type="submit" class="submit-btn">提交</button>
    </div>
  </form>
</div>
<div class="msg-box" style="display: none;">
  <div class="head">提示</div>
  <span class="close">x</span>
  <p class="body"></p>
</div>
<script type="text/javascript">
  $(function(){
    $('.pop-box .close').click(function(){
      $('.pop-box').hide();
    })
     $('.msg-box .close').click(function(){
      $('.msg-box').hide();
    })
    var price = {{intval( $shopCommodity->price )}};
    var left ={{$shopCommodity->total-$shopCommodity->saled}};
    $('#idNumInput').keyup(function(){
      this.value=this.value.replace(/\D/g,'');
      if(this.value > left){
        this.value = left;
      }
      $('#idPrice').html($(this).val() * price );
    });
    function showMessage(msg){
      $('.msg-box').show();
      $(".msg-box p").html(msg);
    }
    $('.buybtn').click(function(){
      var num = $('#idNumInput').val();
      $('#idFormNum').val(num);
      $.post("/shop/buycheck",{"id":'{{$shopCommodity->id}}','num':num},function(resp,text ){
        if(resp.code != 0){
          if(resp.code == 102){
            showMessage('你的当前积分为'+resp.cur+",需要"+resp.need+"积分");
          }else{
            showMessage(resp.msg);
          }
          
        }else{
          $('.pop-box').show();
        }
      })
      
    })
    $('#idForm').submit(function(){
      var url = $(this).attr('action');
      var post = $(this).serialize()? $(this).serialize() : null;
      $.post(url,post,function (data){
        $('.pop-box').hide();
        if(data.code == 0){
          $("#idKC").html(data.left);
          showMessage('购买成功');
        }else{
          if(data.code == 102){
            showMessage('你的当前积分为'+data.cur+",需要"+data.need+"积分");
          }else{
            showMessage(data.msg);
          }
        }
      });
      return false;
    })
  });
</script>
@endsection

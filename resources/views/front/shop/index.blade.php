@extends('front.shop.base')
@section('title')
{{$currentCategory->name}}
@endsection
@section('head')
<style type="text/css">
  .commodity{
      float: left;
      padding: 5px;
      border: 1px solid #EEE;
      width: 213px;
      height: 188px;
      background-color: #f2f2f2;
      list-style: none;
      border-bottom: 2px solid #bcbcbc;
      margin-top: 10px;
      margin-right: 10px;
      margin-bottom: 10px;
      display: block;
    }

    .commodity .item-bottom{
      margin-top: 5px;
      border-top: 1px solid #ccc;
    }

    p {
      font-size: 12px;
      padding: 2px 5px;
    }
    
    .pagination {
      display: inline-block;
      padding-left: 0;
      margin: 20px 0;
      border-radius: 4px;
    }

</style>
@endsection

@section('content')
    <div style="height: 442px;" >
    @foreach($shopCommoditys as $key => $item)
      <a href="/shop/commodity/{{$item->id}}" class="commodity" @if($key % 4 == 3 ) style="margin-right: 0px;" @endif>
        <div><img src="{{$item->imgurl}}" style="width: 214px;height: 141px;"></div>
        <div class="item-bottom">
          <p>名称：{{$item->name}}</p>
          <p>积分：<span style="color: red;">{{$item->price}}</span></p>
        </div>
      </a>
    @endforeach

    </div>
    <div style="color: #ccc">共{{$shopCommoditys->total()}}种商品</div>
    {!!$shopCommoditys->render()!!}
   
@endsection

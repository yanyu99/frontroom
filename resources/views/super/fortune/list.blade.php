@extends('super.layouts.base')
@section('head')


@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">礼物管理</header>
      <div class="panel-body">
        <div class="adv-table">
        <div class="clearfix" >

          </div>
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        
           <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
    <thead>
        <tr role="row">
            <th >ID</th>
            <th >图片</th>
            <th >几率</th>
            <th >名称</th>
            <th>剩余个数</th>
            <th>是否谢谢参与</th>
            <th >编辑</th>
        </tr>
    </thead>
    <tbody role="alert" aria-live="polite" aria-relevant="all">
    @foreach($lists as $list)
        <tr class="odd">
        <form id="editForm{{$list->id}}" action="/super/fortune/edit" method="post">
       {{ $ctrl->csrf_field() }}
            <td ><input type="text"  readonly name="id" class="form-control" style="width:100%" value="{{$list->id}}"></td>
            <td ><div class="img-upload">
                <div id="idImg{{$list->id}}" style="float: left;"></div>
                <p id="idImg{{$list->id}}Tip"  class="webuploader-tip">
                  <p style="float: left;">
                    <input  class="form-control" type="hidden" name="imgurl" id="idImg{{$list->id}}Input" value="{{$list->imgurl}}"/>
                    <img id="idImg{{$list->id}}Show" src="{{$list->imgurl}}" alt="" height="26"/></p>
                </p>
              </div></td>
            <td ><input type="text" class="editable form-control" style="width:100%" readonly name="ratio" value="{{$list->ratio}}"></td>
            <td ><input type="text"  class="editable form-control" style="width:100%" readonly name="title" value="{{$list->title}}"></td>
            <td ><input type="text"  class="editable form-control" style="width:100%" readonly name="left" value="{{$list->left}}"></td>
            <td >
              <select  style="width:100%" readonly name="show"  class="editable form-control">
              <option value="0" @if($list->show == 0) selected @endif>是</option>
              <option value="1"  @if($list->show == 1) selected  @endif>否</option>
            </select>
            </td>
            <td ><a data-id="{{$list->id}}" class="btn btn-success edit" href="javascript:;">编辑</a></td>
            </form>
        </tr>
       @endforeach
    </tbody>
</table>

           
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
$(function(){
  $('.edit').click(function(){
    if($(this).hasClass("opend")){
      $('#editForm'+$(this).attr('data-id')).submit();
    }else{
      $(this).addClass("opend");
      $(this).html("保存");
      $(this).parent().parent().find(".editable").prop('readonly',false);
    }
  })
  @foreach($lists as $value)
   doUpload({
      id:"idImg{{$value->id}}",
      intputId:"idImg{{$value->id}}Input",
      showId:"idImg{{$value->id}}Show",
      descId:"idImg{{$value->id}}Tip",
      csrf_token:'{{ $ctrl->csrf_token() }}',
      fileSize:200*1024,
    });
  @endforeach
});
</script>
@endsection
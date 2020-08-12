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
            <th >名称</th>
            <th >单位</th>
            <th >周期(分)</th>
            <th >最大个数</th>
            <th >动画时长(秒)</th>
            <th >编辑</th>
        </tr>
    </thead>
    <tbody role="alert" aria-live="polite" aria-relevant="all">
    @foreach($lists as $list)
        <tr class="odd">
        <form id="editForm{{$list->id}}" action="/super/gifts/edit" method="post">
       {{ $ctrl->csrf_field() }}
            <td ><input type="text"  readonly name="id" class="form-control" style="width:100%" value="{{$list->id}}"></td>
            <td ><input type="text" class="editable form-control" style="width:100%" readonly name="name" value="{{$list->name}}"></td>
            <td ><input type="text" class="editable form-control" style="width:100%" readonly name="dw" value="{{$list->dw}}"></td>
            <td ><input type="text"  class="editable form-control" style="width:100%" readonly name="ts" value="{{$list->ts}}"></td>
            <td ><input type="text" class="editable form-control"  style="width:100%" readonly name="max" value="{{$list->max}}"></td>
             <td ><input type="text" class="editable form-control"  style="width:100%" readonly name="show_ts" value="{{$list->show_ts}}"></td>
            
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
});
</script>
@endsection
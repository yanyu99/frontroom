@extends('super.layouts.base')
@section('head')


@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">礼物分类</header>
      <div class="panel-body">
        <div class="adv-table">
        <div class="clearfix" >
        <div class="btn-group" style='margin-bottom:10px;'>
          <form  action="/super/giftv2/cateedit" method="post">
              {{ $ctrl->csrf_field() }}
              <button type="submit" class="btn btn-primary">新增</button>
              </form>
              </div>
            </div>
          </div>
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        
           <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
    <thead>
        <tr role="row">
            <th >ID</th>
            <th >名称</th>
            <th >排序</th>
            <th >编辑</th>
        </tr>
    </thead>
    <tbody role="alert" aria-live="polite" aria-relevant="all">
    @foreach($lists as $list)
        <tr class="odd">
        <form id="editForm{{$list->id}}" action="/super/giftv2/cateedit" method="post">
            {{ $ctrl->csrf_field() }}
            <td ><input type="text"  readonly name="id" class="form-control" style="width:100%" value="{{$list->id}}"></td>
            <td ><input type="text" class="editable form-control" style="width:100%" readonly name="name" value="{{$list->name}}"></td>
            <td ><input type="text" class="editable form-control" style="width:100%" readonly name="sort" value="{{$list->sort}}"></td> 
            <td ><a data-id="{{$list->id}}" class="btn btn-sm btn-success edit" href="javascript:;">编辑</a></form>
            <form  action="/super/shop/categorydel" method="post" style="display: inline;">
             {{ $ctrl->csrf_field() }}
             <input type="hidden"  name="id" class="form-control " style="width:100%" value="{{$list->id}}">
            <button type="submit" class="btn btn-sm btn-danger">删除</button>
            </td>
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
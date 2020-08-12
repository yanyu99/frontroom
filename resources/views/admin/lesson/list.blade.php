@extends('admin.layouts.base')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">课程管理</header>
      <div class="panel-body">
        <div class="adv-table">
        <div class="clearfix" >
            <div class="btn-group" style='margin-bottom:10px;'>
            <form  action="/admin/lesson/edit" method="post">
       {{ $ctrl->csrf_field() }}
              <button type="submit" class="btn btn-primary">新增</button>
              </form>
            </div>
          </div>
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        
           <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
    <thead>
        <tr role="row">
            <th >时间</th>
            <th >周一</th>
            <th >周二</th>
            <th >周三</th>
            <th >周四</th>
            <th >周五</th>
            <th >周六</th>
            <th >周日</th>
            <th >编辑</th>
        </tr>
    </thead>
    <tbody id="idTbody" role="alert" aria-live="polite" aria-relevant="all">
    {{-- */$i=1;/* --}}
    @foreach($lists as $list)
    @if($list->id > $i){{-- */$i=$list->id+1;/* --}}@endif
        <tr class="odd">
        <form id="editForm{{$list->id}}" action="/admin/lesson/edit" method="post">
       {{ $ctrl->csrf_field() }}
            <input type="hidden"  name="id" class="form-control " style="width:100%" value="{{$list->id}}">
            <td style="vertical-align: middle;">
            <input type="text"  name="s_at" value="{{$list->s_at}}"  class="form_time form-control" readonly="" size="16">~<input type="text"  name="e_at" value="{{$list->e_at}}"  class="form_time form-control " readonly="" size="16"></td>
            <td style="vertical-align: middle;">
            直播内容：

            <input type="text" class="editable form-control" style="width:100%" readonly name="z1_title" value="{{$list->z1_title}}">
            
            讲师：<select style="width:100%" readonly name="z1_tid"  class="editable form-control">
              @foreach($teachers as $value)
              <option value="{{$value->id}}" @if($value->id == $list->z1_tid) selected  @endif >{{$value->name}}</option>
              @endforeach
            </select>
            描述：
            <input type="text" class="editable form-control" style="width:100%" readonly name="z1_dsc" value="{{$list->z1_dsc}}">
            </td>
            <td style="vertical-align: middle;">
            直播内容：
            <input type="text" class="editable form-control" style="width:100%" readonly name="z2_title" value="{{$list->z2_title}}">
              讲师：<select style="width:100%" readonly name="z2_tid"  class="editable form-control">
              @foreach($teachers as $value)
              <option value="{{$value->id}}" @if($value->id == $list->z2_tid) selected  @endif >{{$value->name}}</option>
              @endforeach
            </select>
            描述：
            <input type="text" class="editable form-control" style="width:100%" readonly name="z2_dsc" value="{{$list->z2_dsc}}">
            
            </td>
            <td style="vertical-align: middle;">
            直播内容：<input type="text"  class="editable form-control" style="width:100%" readonly name="z3_title" value="{{$list->z3_title}}">
              讲师：<select style="width:100%" readonly name="z3_tid"  class="editable form-control">
              @foreach($teachers as $value)
              <option value="{{$value->id}}" @if($value->id == $list->z3_tid) selected  @endif >{{$value->name}}</option>
              @endforeach
            </select>
            描述：
            <input type="text" class="editable form-control" style="width:100%" readonly name="z3_dsc" value="{{$list->z3_dsc}}">
            </td>
            <td style="vertical-align: middle;">
            直播内容：<input type="text" class="editable form-control"  style="width:100%" readonly name="z4_title" value="{{$list->z4_title}}">
              讲师：<select style="width:100%" readonly name="z4_tid"  class="editable form-control">
              @foreach($teachers as $value)
              <option value="{{$value->id}}" @if($value->id == $list->z4_tid) selected  @endif >{{$value->name}}</option>
              @endforeach
            </select>
            描述：
            <input type="text" class="editable form-control" style="width:100%" readonly name="z4_dsc" value="{{$list->z4_dsc}}">
            </td>
             <td style="vertical-align: middle;">
             直播内容：<input type="text" class="editable form-control"  style="width:100%" readonly name="z5_title" value="{{$list->z5_title}}">
               讲师：<select style="width:100%" readonly name="z5_tid"  class="editable form-control">
              @foreach($teachers as $value)
              <option value="{{$value->id}}" @if($value->id == $list->z5_tid) selected  @endif >{{$value->name}}</option>
              @endforeach
            </select>
            描述：
            <input type="text" class="editable form-control" style="width:100%" readonly name="z5_dsc" value="{{$list->z5_dsc}}">
            </td>
              <td style="vertical-align: middle;">
              直播内容：<input type="text" class="editable form-control"  style="width:100%" readonly name="z6_title" value="{{$list->z6_title}}">
                讲师：<select style="width:100%" readonly name="z6_tid"  class="editable form-control">
              @foreach($teachers as $value)
              <option value="{{$value->id}}" @if($value->id == $list->z6_tid) selected  @endif >{{$value->name}}</option>
              @endforeach
            </select>
            描述：
            <input type="text" class="editable form-control" style="width:100%" readonly name="z6_dsc" value="{{$list->z6_dsc}}">
            </td>
             <td style="vertical-align: middle;">
             直播内容：<input type="text" class="editable form-control"  style="width:100%" readonly name="z7_title" value="{{$list->z7_title}}">
               讲师：<select style="width:100%" readonly name="z7_tid"  class="editable form-control">
              @foreach($teachers as $value)
              <option value="{{$value->id}}" @if($value->id == $list->z7_tid) selected  @endif >{{$value->name}}</option>
              @endforeach
            </select>
            描述：
            <input type="text" class="editable form-control" style="width:100%" readonly name="z7_dsc" value="{{$list->z7_dsc}}">
            </td>
            <td style="vertical-align: middle;">
            <a data-id="{{$list->id}}" class="btn btn-success edit" href="javascript:;">编辑</a></form>
            <form  action="/admin/lesson/del" method="post">
       {{ $ctrl->csrf_field() }}
       <input type="hidden"  name="id" class="form-control " style="width:100%" value="{{$list->id}}">
              <button type="submit" class="btn btn-danger">删除</button>
              </td>
            </form>
            
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
<script type="text/javascript" src="{{$common_cdn}}/js/jsrender-1.0.0/jsrender.min.js"></script>
 <link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-timepicker/css/timepicker.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

<script type="text/javascript">
$(function(){
  $('body').on('click',".edit",function(){
    if($(this).hasClass("opend")){
      $('#editForm'+$(this).attr('data-id')).submit();
    }else{
      $(this).addClass("opend");
      $(this).html("保存");
      $(this).parent().parent().find(".editable").prop('readonly',false);
    }
  })
  var index = {{$i}};
  $('#idNew').click(function(){
    var $newTpl = $('#js-new-tmpl');
    $('#idTbody').append($newTpl.render({id:index++}));
     $('.form_time').timepicker({
    minuteStep: 1,
    secondStep:1,
    showSeconds: false,
    showMeridian: false,
    defaultTime: false
});
  })
});
 $('.form_time').timepicker({
    minuteStep: 1,
    secondStep:1,
    showSeconds: false,
    showMeridian: false,
    defaultTime: false
});
</script>
@endsection

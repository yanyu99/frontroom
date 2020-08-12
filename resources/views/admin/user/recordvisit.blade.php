
@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">访问记录</header>
      <div class="panel-body">
        <div class="adv-table">
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">

            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
                  <form  class="form-inline" >

                    <div class="form-group">
                      <span class=" control-label">UID：</span>

                      <input  class="form-control" type="text" name="uid" value="{{$ctrl->_request("uid")}}" ></div>
                    <div class="form-group">
                      <span class=" control-label">名称：</span>

                      <input  class="form-control" type="text" name="name" value="{{$ctrl->_request("name")}}" ></div>
                    <div class="form-group">
                      <span class=" control-label">IP:</span>

                      <input  class="form-control" type="text" name="ip" value="{{$ctrl->_request("ip")}}" ></div>
                      <div class="form-group">
                    <span class="control-label">类型：</span>
                      <select class="form-control" name="type">
                        <option value="" >全部</option>
                        @foreach($typeDescs as $key=>$value)
                        <option value="{{$key}}" @if($key==$ctrl->_request('type')) selected  @endif >{{$value}}
                        </option>
                        @endforeach
                      </select>
                  </div>
                    <div class="form-group">
                      <span class=" control-label">来源：</span>

                      <input  class="form-control" type="text" name="source" value="{{$ctrl->_request("source")}}" ></div>
                    <div class="form-group">
                      <span class=" control-label">开始时间：</span>

                      <input  class="form-control form_datetime " type="text" name="c_start_at" readonly  value="{{$ctrl->_request("c_start_at")}}" ></div>

                    <div class="form-group">
                      <span class=" control-label">结束时间：</span>

                      <input  class="form-control form_datetime " type="text" name="c_end_at" readonly  value="{{$ctrl->_request("c_end_at")}}" ></div>
                    <div class="form-group">
                      <span class=" control-label"></span>

                      <button type="submit" class="btn btn-sm btn-primary">查询</button>
                      <a href="/admin/user/recordvisit" class="btn btn-sm btn-primary">清除</a>

                    </div>

                  </form>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
            <form  class="form-inline" action="/admin/user/visitexport">
                  <div class="form-group">
                    <span class="control-label">角色：</span>
                      <select class="form-control" name="role_id">
                        <option value="" >全部</option>
                        <option value="-1" @if($ctrl->_request('type') == -1) selected @endif>注册用户</option>
                        @foreach($roles as $key=>$value)
                        @if($value->role_id != App\Libs\ConstDefine::USERTYPE_SUPER_MGR_ID)
                        <option value="{{$value->role_id}}" @if($value->role_id==$ctrl->_request('type')) selected  @endif >{{$value->name}}
                        </option>
                        @endif
                        @endforeach
                      </select>
                  </div>
                    <div class="form-group">
                      <span class=" control-label">日期：</span>
                      <input  class="form-control form_date " type="text" name="c_date_at" readonly  value="{{date('Y-m-d')}}" ></div>
                    <div class="form-group">
                      <span class=" control-label"></span>
                      <button type="submit" class="btn btn-sm btn-primary">导出excel</button>
                    </div>

                  </form>
                  </div>
              </div>
            </div>
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>编号</th>
                  <th>UID</th>
                  <th>账号</th>
                  <th>昵称</th>
                  <th>IP</th>
                  <th>时间</th>
                  <th>类型</th>
                  <th>描述</th>
                  <th>来源</th>
                  <th>user-agent</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $list)
                <tr>
                  @if($list->user)
                  <td>{{$list->id}}</td>
                  <td>{{$list->uid}}</td>
                  <td>{{$list->user->account}}</td>
                  <td>{{$list->user->name}}</td>
                  <td>{{$list->ip}}</td>
                  <td>{{$list->created_at}}</td>
                  <td>{{$typeDescs[$list->type]}}</td>
                  <td>{{$list->desc}}</td>
                  <td style="max-width:300px;    word-wrap: break-word;">{{$list->source}}</td>
                  <td>{{$list->agent}}</td>
                </tr>
                @endif
      @endforeach
              </tbody>
            </table>
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_info" id="dynamic-table_info">总共 {{$lists->total()}} 条</div>
              </div>
              <div class="span6">{!!$lists->render()!!}</div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection

@section('script')
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-datetimepicker/css/datetimepicker-custom.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap-datepicker/css/datepicker-custom.css" />
<script type="text/javascript" src="{{$common_cdn}}/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">

$(".form_date").datepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
    language:"zh-CN",
    todayBtn: true,

    startView:1,
});
$(".form_datetime").datetimepicker({
    format: "yyyy-mm-dd hh:ii:ss",
    autoclose: true,
    language:"zh-CN",
    todayBtn: true,
    minuteStep: 10,
    startView:1,
});

</script>
@endsection
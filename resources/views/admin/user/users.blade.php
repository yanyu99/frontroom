@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">用户列表</header>
      <div class="panel-body">
        <div class="adv-table">
          <div class="clearfix" >
            <div style="margin-bottom:20px;" >
              <a href="/admin/user/edit" class="btn btn-primary">新增</a>
              <a href="javascript:;" style="margin-left:10px;" id="idGl" class="btn btn-success dropdown-toggle">
                高级过滤 <i class="fa fa-angle-down" aria-hidden="true"></i>
              </a>
               <a href="javascript:;" style="margin-left:10px;" id="idBatchUser" class="btn btn-success dropdown-toggle">
                批量添加用户 <i class="fa fa-angle-down" aria-hidden="true"></i>
              </a>
              <div class="btn-group" >
                    <div id="idcardPicker"></div>
                    <p id="idcard_img_msg" style="width:500px;" class="webuploader-tip"></p>
            </div>
            </div>
          </div>
          <div class="panel-body" id="idGlBody" @if(!$needShow)style="display:none;"@endif>
            <div class="row">
              <form class="form-horizontal">
                <div class="col-md-6">
                  <div class="form-group">
                    <span class="col-sm-4 control-label">用户ID：</span>
                    <div class="col-sm-8">
                      <input  class="form-control" type="text" name="uid" value="{{$ctrl->_request("uid")}}" ></div>
                  </div>
                  <div class="form-group">
                    <span class="col-sm-4 control-label">地域：</span>
                    <div class="col-sm-8">
                      <input  class="form-control" type="text" name="location"  value="{{$ctrl->_request("location")}}" ></div>
                  </div>
                  
                  <div class="form-group">
                    <span class="col-sm-4 control-label">添加人：</span>
                    <div class="col-sm-8">
                      <input  class="form-control" type="text" name="add_name"  value="{{$ctrl->_request("add_name")}}" ></div>
                  </div>
                  <div class="form-group">
                    <span class="col-sm-4 control-label">SEO：</span>
                    <div class="col-sm-8">
                      <input  class="form-control" type="text" name="seo"  value="{{$ctrl->_request("seo")}}" ></div>
                  </div>
                  <div class="form-group">
                    <span class="col-sm-4 control-label">角色：</span>
                    <div class="col-sm-8">

                      <select class="form-control" name="type">
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
                  </div>
                  <div class="form-group">
                    <span class="col-sm-4 control-label">创建时间：</span>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <input  class="form-control form_datetime" type="text" name="c_start_at"  readonly value="{{$ctrl->_request("c_start_at")}}" >
                        <span class="input-group-addon text-muted">-</span>
                        <input  class="form-control form_datetime" type="text" name="c_end_at" readonly value="{{$ctrl->_request("c_end_at")}}" ></div>
                    </div>

                  </div>
                  <div class="form-group">
                    <span class="col-sm-4 control-label">登录时间：</span>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <input  class="form-control form_datetime" type="text" name="l_start_at" readonly value="{{$ctrl->_request("l_start_at")}}"  >
                        <span class="input-group-addon text-muted">-</span>
                        <input  class="form-control form_datetime" type="text" name="l_end_at" readonly value="{{$ctrl->_request("l_end_at")}}"  ></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <span class="col-sm-4 control-label">名称：</span>
                    <div class="col-sm-8">
                      <input  class="form-control" type="text" name="name" value="{{$ctrl->_request("name")}}" ></div>
                  </div>
                  <div class="form-group">
                    <span class="col-sm-4 control-label">手机：</span>
                    <div class="col-sm-8">
                      <input  class="form-control" type="text" name="phone" value="{{$ctrl->_request("phone")}}" ></div>
                  </div>
                  <div class="form-group">
                    <span class="col-sm-4 control-label">QQ：</span>
                    <div class="col-sm-8">
                      <input  class="form-control" type="text" name="qq"  value="{{$ctrl->_request("qq")}}" ></div>
                  </div>
                  <div class="form-group">
                    <span class="col-sm-4 control-label">IP：</span>
                    <div class="col-sm-8">
                      <input  class="form-control" type="text" name="ip" value="{{$ctrl->_request("ip")}}" ></div>
                  </div>
                  <div class="form-group">
                    <span class="col-sm-4 control-label">推广人：</span>
                    <div class="col-sm-8">
                      <input  class="form-control" type="text" name="p_name"  value="{{$ctrl->_request("p_name")}}" ></div>
                  </div>
                  <div class="form-group">
                    <span class="col-sm-4 control-label"></span>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <input   type="checkbox" name="kick" @if($ctrl->_request("kick")) checked @endif/>
                        是否屏蔽?
                        <input   type="checkbox"  name="gag"   @if($ctrl->_request("gag")) checked @endif/>
                        是否禁言?
                        <input   type="checkbox" name="lookvideo" @if($ctrl->_request("lookvideo")) checked @endif/>
                        禁止看视频?
                        
                        <input   type="checkbox"  name="isRecommend"   @if($ctrl->_request("isRecommend")) checked @endif/>
                        有推广数?
                        <input   type="checkbox"  name="beRecommend"   @if($ctrl->_request("beRecommend")) checked @endif/>
                        有推广人?
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <span class="col-sm-4 control-label"></span>
                    <div class="col-sm-8">
                      <button type="submit" class="btn btn-primary">查询</button>
                      <a href="/admin/user" class="btn btn-primary">清除过滤</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          

            <div class="panel-body" id="idBatchUserBody" style="display:none;">
            <div class="row">
              <form class="form-horizontal" method="post" action="/admin/user/batchadd">
                {{ $ctrl->csrf_field() }}
                <div class="col-md-12">
                <div class="form-group">
                    <span class="col-sm-2 control-label">角色：</span>
                    <div class="col-sm-4">
                     <select class="form-control" name="type">
                        @foreach($roles as $key=>$value)
                        @if($value->role_id != App\Libs\ConstDefine::USERTYPE_SUPER_MGR_ID && $value->role_id != App\Libs\ConstDefine::USERTYPE_GUEST_ID)
                        <option value="{{$value->role_id}}" @if($value->role_id==$ctrl->_request('type')) selected  @endif >{{$value->name}}
                        </option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <span class="col-sm-2 control-label">名称：(半角逗号分隔)</span>
                    <div class="col-sm-10">
                      <textarea  class="form-control"  type="text" name="names"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <span class="col-sm-4 control-label"></span>
                    <div class="col-sm-8">
                      <button type="submit" class="btn btn-primary">创建</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
          <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
            <form  class="form-inline" action="/admin/user/export">
                  <div class="form-group">
                    <span class="control-label">角色：</span>
                      <select class="form-control" name="type">
                        <option value="" >全部</option>
                        <option value="-1" @if($ctrl->_request('type') == -1) selected @endif>注册用户</option>
                        @foreach($roles as $key=>$value)
                        @if($value->role_id != App\Libs\ConstDefine::USERTYPE_SUPER_MGR_ID)
                        <option value="{{$value->
                          role_id}}" @if($value->role_id==$ctrl->_request('type')) selected  @endif >{{$value->name}}
                        </option>
                        @endif
                        @endforeach
                      </select>
                  </div>
                    <div class="form-group">

                      <span class=" control-label">开始：</span>
                      <input  class="form-control form_datetime" type="text" name="c_q_start_at"  readonly value="{{$ctrl->_request("c_q_start_at")}}" >
       </div>
                  <div class="form-group">

                      <span class=" control-label">结束：</span>
                      <input  class="form-control form_datetime" type="text" name="c_q_end_at"  readonly value="{{$ctrl->_request("c_q_end_at")}}" ></div>
                    <div class="form-group">
                      <span class=" control-label"></span>
                      <button type="submit" class="btn btn-sm btn-primary">导出excel</button>
                    </div>

                  </form>
                  </div>
              </div>
            </div>
             <form  method="post" id="idBatch"  class="form-inline"  action="/admin/user/batchdel">
          {{ $ctrl->csrf_field() }}
              <div class="form-group" style="    display: block;">
                <button type="submit" class="btn btn-sm btn-danger muilt-submit ">批量删除</button>
              </div>
                <div class="form-group">
              </div>
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                <th><input id="idAllCheck" type="checkbox" name="">全选</th>
                  <th>操作</th>
                  <th>用户ID</th>
                  <th>账号</th>
                  <th>昵称</th>
                  <th>手机/QQ</th>

                  <th>角色</th>
                  <th>禁言</th>
                  <th>踢出</th>
                  <th>看视频</th>
                  <th>推广人</th>
                  <th>备注</th>
                  <th>推广数</th>
                  <th>添加人</th>
                  <th>SEO</th>
                <!--<th>推广注册数</th>
                -->
                <th>IP</th>
                <th>注册时间</th>
                <th>最后登录时间</th>
              </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
              @foreach($lists as $list)
              <tr>
              <td><input class="myidcheck" type="checkbox" name="ids[]" value="{{$list->uid}}"> </td>
                <td>
                  <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-sm btn-success dropdown-toggle" type="button">
                      操作
                      <span class="caret"></span>
                    </button>
                    <ul role="menu" class="dropdown-menu">
                      @if($recordvisit)
                      <li>
                        <a href="/admin/user/recordvisit?uid={{$list->uid}}">访问记录</a>
                      </li>
                      @endif
                      @if($list->recommend_num > 0)
                      <li>
                        <a href="/admin/user?parentId={{$list->uid}}">我推广的人</a>
                      </li>
                      @endif
                      @if($proposing_opend)
                      <li>
                        <a href="/admin/user/follow?uid={{$list->uid}}">编辑关注</a>
                      </li>
                      @endif
                      <li>
                        <a href="/admin/user/kick?id={{$list->uid}}">踢出</a>
                      </li>
                      <li>
                        <a href="/admin/user/gag?id={{$list->uid}}">禁言</a>
                      </li>
                      <li>
                        <a href="/admin/user/edit?id={{$list->uid}}">编辑</a>
                      </li>
                      <li>
                        <a href="/admin/user/del?id={{$list->uid}}">删除</a>
                      </li>
                    </ul>
                  </div>

                </td>
                <td>{{$list->uid}}</td>
                <td>{{$list->account}}</td>
                <td>{{$list->name}}</td>
                <td>{{$list->phone}}<br>{{$list->qq}}</td>
      
                
                <td>@if($list->role){{$list->role->name}}@endif</td>
                <td>{{$ynDesc[$list->gag]}}</td>
                <td>{{$ynDesc[$list->kick]}}</td>
                <td>{{$ynDesc[$list->lookvideo]}}</td>
                <td>@if($list->parentUser){{$list->parentUser->name}}@else 无 @endif</td>
                <td  style="max-width:100px;word-wrap: break-word;" >{{$list->description}}</td>
                 <td>{{$list->recommend_num}}</td>
                 <td>@if($list->addUser){{$list->addUser->name}}<br>({{$list->addUser->account}})@elseif($list->add_uid) 删除的用户 @else 无 @endif</td>
             <!-- <td>{{$list->recommend_reg}}</td>
              -->
              <td>{{$list->seo}}</td>
              <td>{{$list->ip}}<br>{{$list->ip_location}}</td>

              <td>{{$list->created_at}}</td>
              @if(empty($list->last_login))
              <td>-:-:-</td>
              @else
              <td>{{date('Y-m-d H:i:s',$list->last_login)}}</td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
        </form>
        <div class="row-fluid">
          <div class="span6">
            <div class="dataTables_info" id="dynamic-table_info">{{$lists->total()}}条记录</div>
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

<script type="text/javascript">
  $(function(){
    $('#idAllCheck').click(function(){
        $('.myidcheck').prop('checked',$(this).is(':checked'));
    })
    $('.myidcheck').change(function(){
        $('#idAllCheck').prop('checked',false);
    })
    

  });
  </script>

<script type="text/javascript">
  $(function(){
    $("#idGl").on('click',function(){
      $('#idBatchUserBody').slideUp('fast');
      $('#idGlBody').slideToggle('fast');
    })
      $("#idBatchUser").on('click',function(){
      $('#idGlBody').slideUp('fast');
      $('#idBatchUserBody').slideToggle('fast');
    })

    
  })

  $(function () {
      var idcardUploader = WebUploader.create({
          auto: true,
          server: '/admin/user/importuser',
          headers: {
                'X-CSRF-TOKEN': '{{ $ctrl->csrf_token() }}',
              },
          pick: {id:"#idcardPicker",label:'上传用户execl(注：单次200个)'},
          fileVal: 'Filedata',
          accept: {
              title: 'Images',
              extensions: '*',
              mimeTypes: '*',
          },
          compress:false,
          fileSingleSizeLimit:10 * 1024 * 1024    // 2 M
      });

      idcardUploader.on( 'uploadSuccess', function( file,response ) {
          if(response.code == 0){
              $('#idcard_img_msg').text('');
              window.location.reload();
          }else{
              $('#idcard_img_msg').text(response.msg);
          }
      });
      idcardUploader.on( 'uploadError', function( file ) {
          $('#idcard_img_msg').text('上传失败，请重试！');
      });
      idcardUploader.on( 'error', function( type ) {
          var errstr='';
          if (type=="Q_TYPE_DENIED"){
              errstr = "请上传png,jepg,jpg格式文件";
          }else if(type=="F_EXCEED_SIZE"){
              errstr = "文件大小不能超过2M";
          }
          $('#idcard_img_msg').text(errstr);
      });
      idcardUploader.on( 'uploadProgress', function( file, percentage ) {
          $('#idcard_img_msg').text('正在上传，请等待...'+percentage*100+"%");
      });
  })
</script>
@endsection
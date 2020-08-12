
@extends('admin.layouts.base')
@section('head')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <section class="panel">
      <header class="panel-heading">文件管理列表</header>
      <div class="panel-body">
          @if($ctrl->errors_has('error'))
              <div class="form-group">
                  <div>
                      <div id="js-validate-alert" class="alert alert-danger alert-validate" style="margin-bottom: 0px;">
                          <span class="text">{{$ctrl->errors_first('error', ':message')}}</span>
                      </div>
                  </div>
              </div>
          @endif

        <div class="adv-table">
          <div class="clearfix" >
            <div class="btn-group" style='margin-bottom:10px;'>
            
 
                    <div id="idcardPicker"></div>
                    <p id="idcard_img_msg" style="width:500px;" class="webuploader-tip"></p>
           
             
            </div>
          </div>
          <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
            @if(isset($fields))
            <div class="row-fluid">
              <div class="span6">
                <div class="dataTables_filter" id="dynamic-table_filter">
                  <form  class="form-inline" >
                    <div class="form-group">
                      类型：
                      <select class="form-control" name="field">
                        @foreach($fields as $key=>$val)
                        <option value="{{$key}}" @if($key==$ctrl->_request('field')) selected @endif >{{$val}}</option>
                        @endforeach
                      </select>
                      <input class="form-control" type="text" value="{{$ctrl->_request('val')}}" name="val" class="form-control" />
                    </div>
                    <button type="submit" class="btn btn-primary">查询</button>
                  </form>
                </div>
              </div>
            </div>
            @endif
            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
              <thead>
                <tr role="row">
                  <th>ID</th>
                  <th>文件名</th>
                  
                  <th>大小</th>
                  <th>下载次数</th>
                   <th>积分数量</th>
                  <th>上传人</th>
                  <th>上传时间</th>
                  <th>时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($lists as $file)
                <tr>
                  <td>{{$file->id}}</td>
                  <td>{{$file->filename}}</td>
                 
                  <td>{{$file->size/1024/1204}}MB</td>
                  <td>{{$file->count}}</td>
                  <td>{{$file->jf_num}}</td>
                  @if($file->user)
                  <td>{{$file->user->name}}</td>
                  @else
                  <td>已删除的用户</td>
                  @endif
                  <td>{{$file->created_at}}</td>
                  <td>{{$file->ts}}</td>
                  <td>
                    <form  style='float:left;margin-right:5px;'  method="post" action="/admin/file/del" >
                      {{ $ctrl->csrf_field() }}
                      <input  type="hidden" name="id" value="{{$file->
                      id}}">
                      <button class="btn btn-sm btn-danger">删除</button>
                    </form>
                    <form  style='float:left;margin-right:5px;'  method="post" action="/admin/file/jf" >
                      {{ $ctrl->csrf_field() }}
                      <input  type="hidden" name="id" value="{{$file->id}}">
                      <input class="form-control"  type="text" name="jf_num" value="">
                      <button class="btn btn-sm btn-success">修改积分</button>
                    </form>
                    <form  style='float:left;margin-right:5px;'  method="post" action="/admin/file/ts" >
                      {{ $ctrl->csrf_field() }}
                      <input  type="hidden" name="id" value="{{$file->id}}">
                      <input class="form-control"  type="text" name="ts" value="">
                      <button class="btn btn-sm btn-success">修改时间</button>
                    </form>
                  </td>

                </tr>
                @endforeach
              </tbody>
            </table>
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

<script type="text/javascript">
$(function () {
    var idcardUploader = WebUploader.create({
        auto: true,
        server: '/admin/file/index',
        headers: {
              'X-CSRF-TOKEN': '{{ $ctrl->csrf_token() }}',
            },
        pick: {id:"#idcardPicker",label:'上传文件'},
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
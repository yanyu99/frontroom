<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap/css/bootstrap.min.css">
</head>
<body style="width: 750px;margin-top: 20px;">
<div class="row">
  <form id="js-data-form" class="form-horizontal" method="post">
  {{$ctrl->csrf_field()}}
    <div class="col-xs-6">
      <div class="form-group">
        <label class="col-sm-3 control-label">标题:<span class="text-danger">*</span></label>
        <div class="col-sm-9">
          <input  class="form-control" type="text" required="" name="title" value="" ></div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">止损价:<span class="text-danger">*</span></label>
        <div class="col-sm-9">
          <input  class="form-control" type="text" onkeyup='this.value=this.value.replace(/\D/gi,"")'  required="" name="zs_price"  value="" ></div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">成本价:<span class="text-danger">*</span></label>
        <div class="col-sm-9">
          <input  class="form-control" type="text" onkeyup='this.value=this.value.replace(/\D/gi,"")'  required="" name="cb_price"  value="" ></div>
      </div>
     <div class="form-group">
        <label class="col-sm-3 control-label">目标价:<span class="text-danger">*</span></label>
        <div class="col-sm-9">
          <input  class="form-control" type="text" onkeyup='this.value=this.value.replace(/\D/gi,"")'  required="" name="mb_price"  value="" ></div>
      </div>
    </div>
    <div class="col-xs-6">
      <div class="form-group">
        <label class="col-sm-3 control-label">品种:<span class="text-danger">*</span></label>
        <div class="col-sm-9">
          <input  class="form-control" type="text" required="" name="variety" value="" ></div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">方向:<span class="text-danger">*</span></label>
        <div class="col-sm-9">

          <label class="radio-inline">
            <input   type="radio" checked="" name="mr_mc" value="1" />
            买入
            </label>
             <label class="radio-inline">
            <input   type="radio"  name="mr_mc" value="2"/>
            卖出
          </label>
        </div>
      </div>
      <div class="form-group">
		<label class="col-sm-3 control-label">建议:<span class="text-danger">*</span></label>
		<div class="col-sm-9">
			<select name="type"  class="form-control">
				@foreach($typeDescs as $key=>$value)
				<option value="{{$key}}" >{{$value}}</option>
				@endforeach
			</select>
		</div>
	</div>
      	<div class="form-group">
			<label class="col-sm-3 control-label">讲师:<span class="text-danger">*</span></label>
			<div class="col-sm-9">
				<select name="uid"  class="form-control">
					@foreach($teachers as $value)
					<option value="{{$value->uid}}"  >{{$value->name}}
					</option>
					@endforeach
				</select>
			</div>
		</div>
    </div>
    <div class="form-group">
		<div class="controls">
			<button type="submit" class="btn-submit btn btn-primary" style="width: 200px;margin-top: 20px;margin-left: -79px;">确定</button>
		</div>
	</div>
  </form>
</div>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="{{$common_cdn}}/js/jquery.ajaxForm-3.51.0/jquery.form.js"></script>


	<script>
        $(function(){
        	
        	
			$('#js-data-form').ajaxForm({
				dataType : 'json',
				success	: function(data){
					if(data.code == 0){
						//parent.window.location.reload();
						if(parent.window.hdDialogCallback){
							parent.window.hdDialogCallback();
						} else {
							parent.window.location.reload();
						}
					}else{
						alert(data.msg);
					}
				},
				error : function(error){
					$('.btn-submit').removeAttr("disabled","disabled"); 
					console.log(error.status + ' error');
				}
			});
			
			$('.btn-submit').click(function(){
				setTimeout(function(){
					$(this).attr("disabled","disabled");
				},50);
			});
		});
	</script>

</body>
</html>
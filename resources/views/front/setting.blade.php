<!DOCTYPE html>
<html>
<head>
	<title>用户设置</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="renderer" content="webkit"> 
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/js/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{$common_cdn}}/css/font-awesome/css/font-awesome.css">

	<style type="text/css">
		body{
			font: 14px/1.4 'STHeiti','Microsoft YaHei','宋体','arial';
	    	background: #fff;
		}
		h1{
			color: #0062b4;
    		border-bottom: 1px solid #ddd;
    		padding-bottom: 5px;
    		font-size: 18px;
		}
		.form-body{
			border-radius: 5px;
			margin-bottom: 25px;
			padding: 15px;
		}

		.form－action{
			position: fixed;
			bottom: 0;
			left: 15px;
			background: #f7f8fa;
			width: 100%;
			padding: 15px;
			margin: 0;
		}
		.checkbox-inline{
			padding-left: 0;
		}
		.control-label{
			line-height: 35px;
		}

		.uploadify{
			/* display: inline; */
		}

		.uploadify-button {
			padding: 5px 10px;
		    font-size: 12px;
		    line-height: 1.5;
		    border-radius: 1px;
		    color: #fff;
		    background-color: #5cb85c;
		    border-color: #4cae4c;
		    display: inline-block;
		    margin-bottom: 0;
		    font-weight: normal;
		    text-align: center;
		    vertical-align: middle;
		    -ms-touch-action: manipulation;
		    touch-action: manipulation;
		    cursor: pointer;
		    background-image: none;
		    border: 1px solid transparent;
		    white-space: nowrap;
		    padding: 6px 12px;
		    font-size: 14px;
		    line-height: 1.42857143!important;
		    border-radius: 2px;
		    -webkit-user-select: none;
		    -moz-user-select: none;
		    -ms-user-select: none;
		    user-select: none;
		}
		.uploadify:hover .uploadify-button {
		    color: #fff;
		    background-color: #449d44;
		    border-color: #398439;
		}
		.uploadify-queue{
			display: none;
		}
		.placeholder { color: #aaa; }
	</style>

</head>
<body>

	<div class="container">
		<h1>用户设置</h1>
		<form id="js-data-form" class="form-signin form-horizontal form-body" method="post">
		@if($ctrl->errors_has('modify'))
			<div class="form-group">
				<div>
					<div id="js-validate-alert" class="alert alert-danger alert-validate" style="margin-bottom: 0px;">
						<span class="text">{{$ctrl->errors_first('modify', ':message')}}</span>
					</div>
				</div>
			</div>
			@endif
			{{$ctrl->csrf_field()}}
			@if($changPwd)
			<div class="form-group">
				<label class="col-xs-3 control-label">
					老密码:
					<span class="text-danger">*</span>
				</label>
				<div class="col-xs-8">
					<input id="oldPassword" name="oldpwd" type="password" class="form-control"
						placeholder="可由数字、字母、中文及下划线组成" value=""/>
				</div>
			</div>

			<div class="form-group">
				<label class="col-xs-3 control-label">
					新密码:
					<span class="text-danger">*</span>
				</label>
				<div class="col-xs-8">
					<input id="confrimPassword" name="pwd" type="password" class="form-control"
						placeholder="可由数字、字母、中文及下划线组成" value=""/>
				</div>
			</div>

			<div class="form-group">
				<label class="col-xs-3 control-label">
					确认新密码:
					<span class="required  text-danger">*</span>
				</label>
				<div class="col-xs-8">
					<input id="password" name="pwd1" type="password" class="form-control"
						placeholder="可由数字、字母、中文及下划线组成" value=""/>
				</div>
			</div>
			<hr />
			@endif
			@if($canchange)
			<div class="form-group">
				<label class="col-xs-3 control-label">
					昵称:
					<span class="required  text-danger">*</span>
				</label>
				<div class="col-xs-8">
					<input id="name" name="name" type="text" class="form-control" value="{{$user->name}}"/>
				</div>
			</div>

			<hr />
			@endif

			@if(!$mobile)
			<div class="form-group">
				<span class="col-xs-3 control-label">用户头像:</span>
				
				<div class="col-xs-9">
					<img id="js-upload-image" src='{{$user->pic}}'
						style=" width: 100px; height: 100px; border:1px solid #ddd;" />
					<input type="hidden" name="pic" id="js-upload-input" tabindex="-1" 
						style="width: 100%;" value="{{$user->pic}}" />
					<span id="js-picture-btn" class="btn btn-success">选择图片</span>
				</div>
			</div>
			@else
			<input type="hidden" name="pic" id="js-upload-input" tabindex="-1" 
						style="width: 100%;" value="{{$user->pic}}" />
			@endif
			<div class="form-group form－action">
				<div class="col-xs-12">
					<button class="btn btn-md btn-primary btn-submit" type="submit">提交</button>
				</div>
			</div>
		</form>
	</div>
@if(!$mobile)
	<script type="text/javascript" src="{{$common_cdn}}/js/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="{{$common_cdn}}/js//uploadify-2.2/jquery.uploadify.min.js"></script>
	<script type="text/javascript" src="{{$common_cdn}}/js/placeholder/jquery.placeholder.js"></script>
	<script>
		
        $(function(){
        	$('[placeholder]').placeholder();

        	$('#oldPassword').focus();
        	$("#js-picture-btn").uploadify({
				width		  : 200, 
		        buttonText	  : "请选择本地图片文件",
		        swf           : '/assets/js/uploadify-2.2/uploadify.swf',
		        uploader      : '/ajaxUpload?dir=headpic',
		        fileTypeDesc  : '图片文件',
		        fileSizeLimit	  : '20K',
		        fileTypeExts  : '*.gif; *.jpg; *.png',
		        multi         : false,
		        onUploadSuccess : function(file, data, response) {
		        	var text = '['+ data +']';
		        	data = $.parseJSON(data);
		        	var $input = $('#js-upload-input');
		        	var $image = $('#js-upload-image');
		        	$input.val(data.img);
		        	$image.attr('src', data.img);
		        }
		    });
		});
		
	</script>
	@endif
</body>
</html>
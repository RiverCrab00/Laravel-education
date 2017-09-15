<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="{{asset('admin')}}/lib/html5shiv.js"></script>
<script type="text/javascript" src="{{asset('admin')}}/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="{{asset('admin')}}/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admin')}}/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admin')}}/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admin')}}/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('admin')}}/static/h-ui.admin/css/style.css" />
<link rel="stylesheet" href="{{asset('admin')}}/uploadify/uploadify.css">

<!--[if IE 6]>
<script type="text/javascript" src="{{asset('admin')}}/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>添加课时 - 课时管理 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">

</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add">
		{{csrf_field()}}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课时名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="adminName" name="lesson_name">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>所属课程：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<select class="select" name="course_id" size="1">
				<option value="">请选择所属课程</option>
				@foreach($course as $k=>$v)
					<option value="{{$k}}">{{$v}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课时时长：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<input type="text" class="input-text" value="" placeholder="" name="lesson_length">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>主讲老师：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<input type="text" class="input-text" value="" placeholder="" name="teacher_name">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>图片上传：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<input type="text" class="input-text" value="" placeholder="" name="cover_img">
			<input id="file_upload" name="file_upload" type="file" multiple="true">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>视频上传：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<input type="text" class="input-text" value="" placeholder="" name="video_address">
			<input id="file_upload2" name="file_upload" type="file" multiple="true">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">课时介绍：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<textarea name="lesson_desc" cols="" rows="" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true" onKeyUp="$.Huitextarealength(this,100)"></textarea>
			<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
		</div>
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="{{asset('admin')}}/lib/jquery/1.9.1/jquery.min.js"></script>
<script src="{{asset('admin')}}/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="{{asset('admin')}}/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="{{asset('admin')}}/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="{{asset('admin')}}/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admin')}}/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="{{asset('admin')}}/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="{{asset('admin')}}/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
	$('#form-admin-add').submit(function(e){
	    e.preventDefault();
	    var data=$(this).serialize();
	    $.ajax({
            'url':"{{url('admin/lesson/add')}}",
            'type':'post',
			'data':data,
            'dataType':'json',
			'success':function(msg){
                if(msg.info==1){
                    layer.alert('添加成功',function(){
                        parent.table.api().ajax.reload();
                        layer_close();
					});
				}else{
                    layer.alert('添加失败:'+msg.error);
				}
			}
		});
	});
    $('#file_upload').uploadify({
        'formData'     : {
            '_token'     : '{{csrf_token()}}'
        },
        'buttonText':'选择文件',
        'swf'      : '{{asset('admin')}}/uploadify/uploadify.swf',
        'uploader' : "{{url('admin/lesson/upimg')}}",
        'onUploadSuccess':function (file,data,response) {
            $("input[name='cover_img']").val(data);
            //$('#show').attr('src',data).css('width','150px');
        }
    });
    $('#file_upload2').uploadify({
        'formData'     : {
            '_token'     : '{{csrf_token()}}'
        },
        'buttonText':'选择文件',
        'swf'      : '{{asset('admin')}}/uploadify/uploadify.swf',
        'uploader' : "{{url('admin/lesson/upvideo')}}",
        'onUploadSuccess':function (file,data,response) {
            $("input[name='video_address']").val(data);
        }
    });
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>
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
<!--[if IE 6]>
<script type="text/javascript" src="{{asset('admin')}}/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>用户管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c"> 日期范围：
		<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
		<input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="title" name="">
		<button type="submit" class="btn btn-success radius" id="searchlesson" name=""><i class="Hui-iconfont">&#xe665;</i> 搜索课时</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="batchdel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="lesson_add()" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加课时</a></span> <span class="r">共有数据：<strong>88</strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="100">课时名称</th>
				<th width="100">所属课程</th>
				<th width="90">所属专业</th>
				<th width="">封面图</th>
				<th width="80">播放视频</th>
				<th width="130">添加时间</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>

		</tbody>
	</table>
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{asset('admin')}}/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('admin')}}/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="{{asset('admin')}}/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="{{asset('admin')}}/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admin')}}/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="{{asset('admin')}}/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{asset('admin')}}/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
$(function(){
	table=$('.table-sort').dataTable({
		"lengthMenu":[[5,10],[5,10]],//vla值,文本
		'paging':true,//分页
		'info':true,//分页辅助信息
		'searching':true,//搜索功能
		'ordering':true,//允许排序
		'order':[[1,'desc']],//设置默认第2列正排序
		'stateSave':false,//开启或禁用状态储存
		'processing':true,//processing指示器的显示
		'serverSide':true,//服务器模式
        "columnDefs": [{
            "targets": [0,3,4,9],
            "orderable": false
        }],
		'ajax':{
		    'url':"{{url('admin/lesson/index')}}",
			'type':"POST",
			'data':function(data){
		      data.title=$('#title').val();
		      data.datemin=$('#datemin').val();
		      data.datemax=$('#datemax').val();
			},
			'headers':{'X-CSRF-TOKEN':'{{csrf_token()}}'},
		},
		"columns":[
		    {'data':'a','defaultContent':''},
			{'data':'id'},
			{'data':'lesson_name'},
			{'data':'course.course_name'},
			{'data':'course.profession.profession_name'},
			{'data':'cover_img'},
			{'data':'video_address'},
			{'data':'created_at'},
			{'data':'status'},
			{'data':'b','defaultContent':''}
		],
		"createdRow":function(row,data,dataIndex){
		    $(row).addClass('text-c');
		    $(row).find('td:eq(0)').html('<input type="checkbox" value="'+data.id+'" name="ids[]">');
		    $(row).find('td:eq(6)').html('<input type="button" class="btn btn-success-outline radius" value="播放视频" onClick="play('+data.id+')" />')
            var str = '';
            if(data.status==1){
                $(row).find("td:eq(8)").html('<span class="label label-success radius">已启用</span>');
                str = '<a style="text-decoration:none" onClick="lesson_stop(this,'+data.id+')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>';
            }else {
                $(row).find("td:eq(8)").html('<span class="label radius">已停用</span>');
                str = '<a style="text-decoration:none" onClick="lesson_start(this,'+data.id+')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe615;</i></a>';
            }
            $(row).find('td:eq(9)').html(str+'<a title="编辑" href="javascript:;" onclick="lesson_edit('+data.id+')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="lesson_del('+data.id+')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>');
            $(row).find('td:eq(5)').html('<img src="'+data.cover_img+'" style="width: 150px"/>');
		},
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存

	});
    $('#searchlesson').click(function(){
        table.api().ajax.reload();
    });
	
});
function lesson_edit(id){
    layer_show('修改课时',"{{url('admin/lesson/update')}}/"+id);
}
function batchdel(){
    var ids=[];
    $("input:checked").each(function(){
       ids.push($(this).val());
	});
    if(ids.length==0){
        layer.msg('至少选择一个');
        return;
	}
	$.ajax({
		'type':'post',
		'url':'{{url('admin/lesson/batchdel')}}',
		'dataType':'json',
		'data':{'_token':'{{csrf_token()}}','ids':ids},
		'success':function(msg){
		    if(msg.info==1){
		        layer.msg('批量删除成功');
                table.api().ajax.reload();
			}
		}
	});
}
function lesson_del(id){
	layer.confirm('确认删除吗',function(){
	   $.ajax({
		   'type':'post',
		   'url':'{{url('admin/lesson/del')}}/'+id,
		   'dataType':'json',
		   'data':{'_token':'{{csrf_token()}}'},
		   'success':function (msg) {
			   if(msg.info==1){
			       layer.msg('删除成功!',{icon:6,time:2000});
                   table.api().ajax.reload();
			   }else{
                   layer.alert('删除失败!',{icon:6});
			   }
           },
           'error':function(msg){
		       console.log(msg.error);
		   }
	   });
	});
}
function play(id){
    layer_show('播放视频','{{url("admin/lesson/play")}}/'+id,650,500);
}
/*课时-添加*/
function lesson_add(){
	layer_show('添加课时',"{{url('admin/lesson/add')}}",600,500);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*用户-停用*/
function lesson_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '{{url("admin/lesson/status")}}/'+id,
			dataType: 'json',
			data:{'status':0,'_token':'{{csrf_token()}}'},
			success: function(msg){
			    if(msg.info==1){
                    $(obj).parents('tr').find('td:eq(8)').html('<span class="label radius">已停用</span>');
                    //在自己的前面添加如下内容
                    $(obj).before('<a style="text-decoration:none" onClick="lesson_start(this,'+id+')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe615;</i></a>');
                    $(obj).remove();
                    layer.msg('已停用!',{icon: 6,time:1000});
				}else{
                    layer.msg('错误!',{icon: 5,time:1000});
                }
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}

/*用户-启用*/
function lesson_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '{{url("admin/lesson/status")}}/'+id,
			dataType: 'json',
			data:{'status':1,'_token':'{{csrf_token()}}'},
			success: function(msg){
                if(msg.info==1){
                    $(obj).parents('tr').find('td:eq(8)').html('<span class="label label-success">已启用</span>');
                    //在自己的前面添加如下内容
                    $(obj).before('<a style="text-decoration:none" onClick="lesson_stop(this,'+id+')" href="javascript:;" title="禁用"><i class="Hui-iconfont">&#xe615;</i></a>');
                    $(obj).remove();
                    layer.msg('已启用!',{icon: 6,time:1000});
                }else{
                    layer.msg('错误!',{icon: 5,time:1000});
				}
			},
			error:function(data) {
				console.log(data.msg);
			},
		});
	});
}



/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
	layer_show(title,url,w,h);	
}
/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '',
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}
</script> 
</body>
</html>
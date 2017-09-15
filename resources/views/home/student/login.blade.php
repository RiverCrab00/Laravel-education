<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/home/img/asset-favicon.ico">
    <title>在线教育网</title>
    <link rel="stylesheet" href="/home/plugins/normalize-css/normalize.css" />
    <link rel="stylesheet" href="/home/plugins/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="/home/css/page-learing-sign.css" />
</head>

<body>
    <!-- 页面 -->
    <div class="register">
        <div class="register-head">
            <div class="wrap">
                <a href="javascript:;" class="logo">
                <img src="/home/img/asset-logoico.png" alt="logo" width="200">
            </a>
                <div class="go-regist" style="position: absolute;border-bottom: 10px;">还没有账号？<a href="#">去注册</a></div>
            </div>
        </div>
        <div class="register-body">
            <div class="register-cent">
                <img src="/home/img/asset-login_img.jpg" alt="" class="register-ico">
<form class="required-validate" id="regStudentForm" method='post' 
    action="{{url('home/student/login')}}">

    {{csrf_field()}}
    <ul class="r-position login">
        <li>
            <div class="page-header">
                <h3>欢迎登录在线教育</h3>
            </div>
        </li>
        <li>
            <div class="form-group">
                <label class="control-label">登录名：</label>
                <div class="">
                    <input type="text" class="form-control" name="std_name" placeholder="请输入登录名" value="{{old('std_name')}}" />
                    <span class="verif-span">请输入5-25个字符</span>
                    <span style='color:red'>{{$errors->first('std_name')}}</span>
                </div>
            </div>
        </li>
        <li>
            <div class="form-group">
                <label class="control-label">密码</label>
                <div class="">
                    <input type="password" class="form-control" name="password" placeholder="请输入密码" value="{{old('password')}}">
                    <span class="verif-span">请输入6-16个字符</span>
                    <span style='color:red'>{{$errors->first('password')}}</span>
                </div>
            </div>
        </li>
        <li>
            <div class="form-group">
                <label class="control-label">手机号码：</label>
                <div class="">
                    <input type="text" class="form-control" name="mobile" placeholder="请输入手机号" value="{{old('mobile')}}" style="width:50%;display:inline;" />
                    <input type="button" value="点击发送" onclick="send_msg()"/>
                    <span class="verif-span">请输入11位手机号码</span>
                    <span id="send_status" style="color:blue;"></span>
                </div>
            </div>
        </li>
        <li>
            <div class="form-group">
                <label class="control-label">接收的验证码</label>
                <div class="">
                    <input type="password" class="form-control" name="mobile_code" placeholder="请输入验证码" value="{{old('password')}}">
                    <span class="verif-span">请输入5个字符</span>
                    <span style='color:red'>{{$errors->first('mobile_code')}}</span>
                </div>
            </div>
        </li>
        <script type="text/javascript">
        //发送手机短信
        function send_msg(){
            var number = $('[name=mobile]').val();//获得手机号码

            //Ajax发送验证码短信
            $.ajax({
                url:"{{url('home/student/sms')}}",
                data:{'number':number},
                dataType:'json',
                type:'post',
                headers:{
                    'X-CSRF-TOKEN':'{{csrf_token()}}',
                },
                success:function(msg){
                    if(msg.success===true){
                        $('#send_status').html('短信发送成功');
                    }else{
                        $('#send_status').html('短信发送失败');
                    }
                }
            });
        }
        </script>

        <li>
            <div style='color:red'>{{$errors->first('errorinfo')}}</div>
        </li>
        <li class="">
            <button name="login" type="submit" class="btn btn-primary">登录</button>
        </li>
        <li class="">
            <img src="/home/img/qq.jpg" alt="" width="40" height="40" style="cursor:pointer;"
             onclick="open_login()"
            />
        </li>
    </ul>
</form>
<script type="text/javascript">
    //显示qq登录弹窗
    function open_login(){
        //window.open(url地址,自定义窗口名称,规格);
        window.open("{{url('home/student/qqlogin')}}","qq_login","width=530,height=370,top=200,left=150");
    }
</script>
            </div>
        </div>
        <div class="register-footer">
            <!--底部版权-->


        </div>
    </div>
    <!-- 页面 css js -->
    <script type="text/javascript" src="/home/plugins/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="/home/plugins/bootstrap/dist/js/bootstrap.js"></script>

</body>
/*最小高度*/
function minHeight(){
	var h = $(window).height();
	var body = parseInt(h) -400;
	var min = 410;
	if(body > min){
		$('.register-body').css('min-height',body + 'px');
	}else{
		$('.register-body').css('min-height',min + 'px');
	}
}
minHeight();	
$(window).resize(function() {
  minHeight();
});

/*登录按钮*/
$('[name=login]').click(function(){
	var username = $('[name=username]');
	var password = $('[name=password]');
	if(username.val() == ""){
		username.siblings('.verif-span').show().text('登录名不能为空');;
	}else{
		username.siblings('.verif-span').hide();
	}
	if(password.val() == ""){
		password.siblings('.verif-span').show().text('密码不能为空');;
	}else{
		password.siblings('.verif-span').hide();
	}
});
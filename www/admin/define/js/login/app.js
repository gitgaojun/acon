/**
 * 后台登录验证js
 */
/**
 * 获取验证码
 */
function getCodeImage(){
	$('#codeImage').attr("src","/admin/index.php/login/adCode?num="+Math.random());
}

$(function (){
	$("#adName").focus();//输入焦点
	$("#adName").keydown(function (event){
		if(event.which == '13'){
			$("#adName").focus();
		}
	})
	$("#adPwd").focus();
	$("#adPwd").keydown(function (event){
		if(event.which == '13'){
			$("#adPwd").focus();
		}
	})
	$("#adCode").focus();
	$("#adCode").keydown(function (event){
		if(event.which == '13'){
			$("#adCode").focus();
		}
	})
	$('#subButton').click(function (){//登录按钮单击事件
		//获取用户名称
		var adName = encodeURL($("#adName").val());
		//获取用户密码
		var adPwd = encodeURL($("#adPwd").val());
		//获取验证码
		var adCode = encodeURL($("#adCode").val());

		//验证用户输入长度和字符
		if(adName.length < 6 || adName.length >20){ $("#adCodeMsg").html("用户名:6~20  字符 数字");return;}
		if(adPwd.length < 6 || adPwd.length > 20){ $("#adCodeMsg").html("密码:6~20  字符 数字");return;}
		if(adCode.length < 4){ $("#adCodeMsg").html("验证码错误");return;}

		//ajax提交表单
		$.ajax({
			url:'/admin/index.php/login/valiableLogin',
			method:'/',
		})
	})

})


/**
 * 验证提交是否符合规范
 */
function valiAble(){


	var	adName = $("#adName").val();
	var adPwd = $("#adPwd").val();
	var adCode = $("#adCode").val();
	var adCodeMsg = $("#adCodeMsg").val();
	/*
	 * adName.length 字符串的长度
	 */
	var isPost = 1;
	if(adName.length<6){ $("#adCodeMsg").html("6~长度");return false;}
	if(adPwd.length<6){ $("#adCodeMsg").html("6~长度");return false;}
	if(adCode='' || adCode!=document.session['adCode']){ $("#adCodeMsg").html('填写正确验证码');return false;}

	if(isPost === 1){
		$.post(
				"/admin/index.php/login/valiableLogin",
				{"adName":adName,"adPwd":adPwd,"adCode":adCode},
				function(data){
					if(data.status){
						document.localtion.href="/app.html";
					}else{
						$("#adCodeMsg").html(data.msg);
					}
				}
		)
	}






}

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
			$("#adPwd").focus();
		}
	})
	$("#adPwd").keydown(function (event){
		if(event.which == '13'){
			$("#adCode").focus();
		}
	})
	$("#adCode").keydown(function (event){
		if(event.which == '13'){
			$("#subButton").trigger("click");
		}
	})


	$('#subButton').click(function (){//登录按钮单击事件
		alert(44);
		//获取用户名称
		var adName = encodeURL($("#adName").val());
		//获取用户密码
		var adPwd = encodeURL($("#adPwd").val());
		//获取验证码
		var adCode = encodeURL($("#adCode").val());
console.log(132211221);
		//验证用户输入长度和字符
		if(adName.length < 6 || adName.length >20){ $("#adCodeMsg").html("用户名:6~20  字符 数字");}
		if(adPwd.length < 6 || adPwd.length > 20){ $("#adCodeMsg").html("密码:6~20  字符 数字");return false;}
		if(adCode.length < 4){ $("#adCodeMsg").html("验证码错误");return false;}

		//ajax提交表单
		$.ajax({
			url:'/admin/index.php/login/valiableLogin',
			method:'post',
			type:"json",
			data:{"adName":adName,"adPwd":adPwd,"adCode":adCode},
			success:function (data){
				if(data.status){
					//window.location.href="www.baidu.com";
				}
			},
			fail:function (data){
				$("#adCodeMsg").html("请联系网站管理员抢修");
			}
		})
	})

})



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
		
		//获取用户名称
		var adName = encodeURI($("#adName").val());
		//获取用户密码
		var adPwd = encodeURI($("#adPwd").val());
		//获取验证码
		var adCode = encodeURI($("#adCode").val());

		//验证用户输入长度和字符
		if(adName.length < 6 || adName.length >20){ $("#adCodeMsg").html("用户名:6~20  字符 数字");return false;}
		if(adPwd.length < 6 || adPwd.length > 20){ $("#adCodeMsg").html("密码:6~20  字符 数字");return false;}
		if(adCode.length < 4){ $("#adCodeMsg").html("验证码错误");return false;}

		//ajax提交表单
		$.ajax({
		 	type:"post",
			url:'/admin/index.php/login/valiableLogin',
			dataType:"json",//返回json格式的数据
			data:"adName="+adName+"&adPwd="+adPwd+"&adCode="+adCode,
			success:function (data){
				console.log(data);
				//if(data.status){
					//window.location.href="www.baidu.com";
				//}
			},
			error:function (XMLHttpRequest,textStatus,errorThrown){
				alert(errorThrown)
			}
		})
	})

})



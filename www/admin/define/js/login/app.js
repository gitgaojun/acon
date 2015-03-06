/**
 * 后台登录验证js
 */
/**
 * 获取验证码
 */
$("#adCodeImage").click(function(){
		$.post("/login#adcode"),
		{status:'1'},
		function(data){
			if(data.status) $("#adCodeImage").html(data.adCodeImage);
		}
});

/**
 * 验证提交是否符合规范
 */
function vailAble(){
	var	adName = $("#adName").val();
	var adPwd = $("#adPwd").val();
	var adCode = $("#adCode").val();
	var adCodeMsg = $("#adCodeMsg").val();

	var isPost = 1;
	if(adName.length()<5){ $("#adCodeMsg").html("6~长度");isPost=0;}
	if(adPwd.length()<5){ $("#adCodeMsg").html("6~长度");isPost=0;}
	if(adCode='' || adCode!=document.session['adCode']){ $("#adCodeMsg").html('填写正确验证码');isPost=0;}

	if(isPost === 1){
		$.post("/login#ok"),
		{"adName":adName,"adPwd":adPwd,"adCode":adCode},
		function(data){
			if(data.status){
				document.localtion.href="/app.html";
			}else{
				$("#adCodeMsg").html(data.msg);
			}
		}
	}






}

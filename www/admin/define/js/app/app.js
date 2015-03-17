/**
 * 后台首页面js
 */
window.onload=function(){
	
	
	/* 设置头部样式  */
	
	$('#header-user').click(function(){
		//点击显示
		$('#header-ul').attr('style',"display:block");
	})
	$('.header-li').mouseover(function(){
		$('.header-li').attr('style',"background-color:rgb(178,178,178);color:rgb(78,78,78);");
	})
	//移出隐藏
	$('#header-ul').mouseout(function(){
		$('#header-ul').attr('style',"display:none");
	});
	//用户信息
	$('#userList').click(function(){
		window.location.href="/admin/index.php/user/index";
	})
	//退出登录
	$('#loginOut').click(function(){
		//window.location.href="/admin/index.php/login/loginOut";
		$.ajax({
			type:'post',
			url:'/admin/index.php/login/loginOut',
			dataType:"json",
			data:'site=admin',
			success:function(data){
				alert(data);
				if(data.status){
					window.location.href="/admin/index.php/login/index";
				}
			},
			error:function(XMLHttpRequest,textStatus,errorThrown){
				console.log('XMLHttpRequest:'+XMLHttpRequest,'textStatus:'+textStatus,'errorThrown:'+errorThrown);
			}
		});
	})
	
	
	/* 设置头部样式end */
	
	
};

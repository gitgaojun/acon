/**
 * 后台首页面js
 */

window.onload=function(){
	
	
	/* 设置头部样式  */
	/* 不能用click来弄none或者出现,统一弄mouse事件才能保证不失效 */
	$('#header-user').mouseover(function(){
		//点击显示
		$('#header-ul').attr('style',"display:block");
	});
	$('.header-li').mouseover(function(){
		$('.header-li').attr('style',"background-color:rgb(178,178,178);color:rgb(78,78,78);");
	});
	//移出隐藏
	$('#header-ul').mouseout(function(){
		$('#header-ul').attr('style',"display:none");
	});
	//用户信息
	$('#userList').click(function(){
		window.location.href="/admin/index.php/user/index";
	});
	//退出登录
	$('#loginOut').click(function(){
		//window.location.href="/admin/index.php/login/loginOut";
		$.ajax({
			type:'post',
			url:'/admin/index.php/login/loginOut',
			dataType:"json",
			data:'site=admin',
			success:function(data){
				//console.log(data);
				alert("成功退出系统");
				if(data.status){
					window.location.href="/admin/index.php/login/index";
				}
			},
			error:function(XMLHttpRequest,textStatus,errorThrown){
				console.log('XMLHttpRequest:'+XMLHttpRequest,'textStatus:'+textStatus,'errorThrown:'+errorThrown);
			}
		});
	});
	
	
	/* 设置头部样式end */



	/*  设置左边menu菜单栏样式  */
	$('.left-a').click(function(){
		$('.left-a > .left-dt').attr('style',"display:block;");
		$(this).children(".left-dt").attr('style',"display:block;");

	});

	/*  设置左边menu菜单栏样式end  */
};

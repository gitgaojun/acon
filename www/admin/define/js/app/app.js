/**
 * 后台首页面js
 */
$(function(){
    $leftLiAX = $(".ifr-left a.li-a").width()-10;
    $(".ifr-left a.li-a").css("width",$leftLiAX);
    $leftDlAX = $(".ifr-left a.dl-a").width()-20;
    $(".ifr-left a.dl-a").css("width", $leftDlAX);
});

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
    /*当我们设置这样的样式的时候先把css的全部展示样式做好，再来设置隐藏，通过js来实现显示*/

    /**
     *  用来初始化左边菜单栏状态
     */
    function init_showDiv(){
        $(".left-dt").each(function(index, domEle) {
            //domEle == this
            var $shower = $(domEle).attr("show");
            if($shower == "true"){
                $(domEle).show();
            }else{
                $(domEle).hide();
            }
        });
    }
    $(".li-a").click(function(){
        var $shower = $(this).parent(".left-li").children(".left-dt").attr("show");
        if($shower == "true"){
            $(this).parent(".left-li").children(".left-dt").attr("show", "false");
        }else {
            $(this).parent(".left-li").children(".left-dt").attr("show", "true");
        }/*
        show 控制展开
        */
        init_showDiv();
    });

	/*  设置左边menu菜单栏样式end  */




};

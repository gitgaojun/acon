/**
 * Created by jun90610@gmail.com on 2015/3/25.
 */
$(function(){
    $ifr_right_span_x = $(".ifr-right > span").width();
    $(".ifr-right > span").css("width",$ifr_right_span_x);
});

$(document).ready(function(){



    $(".layerBtn").bind("click",function(){
        var $paramId = $(this).attr("attr");
        window.location.href="/admin/index.php/sys_menu/sel?paramId="+$paramId;

    });

    $(".delBtn").bind( "click", function(){
        var $isPar = $(this).attr("isPar");
        var $conStr = $isPar < 1?"主菜单回导致下面的菜单无发显示,确认删除?":"确认删除?";
        var $isDel = confirm($conStr);
        var $attr = $(".delBtn").attr("attr");
        if($isDel == true)
        {
            $.ajax({
                type:"post",
                url:"/admin/index.php/sys_menu/del",
                dataType:"json",
                data:"attr="+$attr,
                success:function(data){
                    if(data.status){
                        window.location.href="/admin/index.php/sys_menu/index";
                    }
                },
                error:function (XMLHttpRequest,textStatus,errorThrown){
                    console.log('XMLHttpRequest:'+XMLHttpRequest);
                    console.log('textStatus:'+textStatus);
                    console.log('errorThrown:'+errorThrown);
                }

            });
        }
    });

});

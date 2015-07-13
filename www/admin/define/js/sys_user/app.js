/**
 * Created by jun90610@gmail.com on 2015/4/3.
 */

$(document).ready(function(){
    $(".layerBtn").bind("click", function(){
        var $dataType = $(this).attr("data");
        var $attr = $(this).attr("attr");
        window.location.href="/admin/index.php/sys_user/"+$dataType+"?attr="+$attr;
    });

    $(".delBtn").bind("click", function(){
        var $isPar = $(this).attr("isPar");
        var $isDel = confirm("确认删除?");
        var $attr = $(this).attr("attr");
        if($isDel == true)
        {
            $.ajax({
                type:"post",
                url:"/admin/index.php/sys_user/del",
                dataType:"json",
                data:"attr="+$attr,
                success:function(data){
                    if(data.status){
                        window.location.href="/admin/index.php/sys_user/index";
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

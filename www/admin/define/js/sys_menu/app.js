/**
 * Created by jun90610@gmail.com on 2015/3/25.
 */
$(function(){
    $ifr_right_span_x = $(".ifr-right > span").width();
    $(".ifr-right > span").css("width",$ifr_right_span_x);
});

$(document).ready(function(){



    $(".layerBtn").bind("click",function(){


    /* ajax取数据start */
        var $modelType = $(this).attr("data");
        var $paramId = $(this).attr("attr");
        $.ajax({
            type:"post",
            url:"/admin/index.php/sys_menu/"+$modelType,
            dataType:"json",
            data:"paramId="+$paramId,
            global:{},
            success:function (result){

                if(result.status){
                    /*传值操作数据*/

                    innerLayer(result.data, $modelType);

                }else{
                    console.log("取出数据失败");
                }
            },
            error:function (XMLHttpRequest,textStatus,errorThrown){
                console.log('XMLHttpRequest:'+XMLHttpRequest);
                console.log('textStatus:'+textStatus);
                console.log('errorThrown:'+errorThrown);
            }


        });



    /* ajax取数据end */

        /*ajax得到的数据注入到遮盖层中去start*/
        /**
         * 数据注入遮盖层
         * @param $data
         * @param $type
         */
        function innerLayer($data, $type){
            var $layerType = "layer_"+$type;

            $.each($data,function(index, element){
                //$(".layer_sel span.m_id").text("1");
                $("." + $layerType + " " +"span" + "." + index).text(element);
            });
            /*给按钮添加m_id值*/
            $(".add-btn").attr("href","/admin/index.php/sys_menu/add");
            $(".update-btn").attr("href","/admin/index.php/sys_menu/update"+"?attr="+$data.m_id);
            $(".ifr-right").html($(".layer_sel").html());

            $($(".layer_sel").html(""));
        }

        /*ajax得到的数据注入到遮盖层中去end*/

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

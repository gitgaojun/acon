/**
 * Created by jun90610@gmail.com on 2015/3/25.
 */
$(function(){
    $ifr_right_span_x = $(".ifr-right > span").width() - 30;
    $(".ifr-right > span").css("width",$ifr_right_span_x);
});

$(document).ready(function(){


    /*弹出遮罩层start */
    $(".layerBtn").bind("click",function(){
        $("#layer").css( "display","block" );
    /*弹出遮罩层end */


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
            $layerType = "layer_"+$type;

            $.each($data,function(index, element){
                //$(".layer_sel span.m_id").text("1");
                $("." + $layerType + " " +"span" + "." + index).text(element);
            });

            $(".layer_sel").css("display","block");
        }

        /*ajax得到的数据注入到遮盖层中去end*/

    });

});

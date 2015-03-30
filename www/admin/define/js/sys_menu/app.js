/**
 * Created by jun90610@gmail.com on 2015/3/25.
 */

$(document).ready(function(){



    $(".layerBtn").bind("click",function(){

         /*弹出遮罩层样式效果start */
        $topWidth = $(window.parent.document).width();//文档的宽度
        $topHeight = $(window.parent.document).height();//文档的高度
         /*iframe 定位iframe框架外面的元素 window.parent.document.getElementById("id_name") */
        var $layer = window.parent.document.getElementById("layer");
        $($layer).css({
            "display":"block",
            "position":"relative",
            "width":$topWidth,
            "height":$topHeight,
            "background-color":"rgb(125,125,125)",
            "filter":"alpha(opacity=50)",/* IE滤镜，透明度50%*/
            "-moz-opacity":"0.5", /*Firefox私有，透明度50%*/
            "opacity":"0.5",/*其他，透明度50%*/
            "z-index":"101"
        });
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
            //$($layerType).children("m_id").innerHTML($data.m_id);
            $.each($data,function(index, element){
                $($layerType).children("."+element).innerHTML(element);
            });

            alert($(".layerBody").contents());
        }

        /*ajax得到的数据注入到遮盖层中去end*/

    });

});

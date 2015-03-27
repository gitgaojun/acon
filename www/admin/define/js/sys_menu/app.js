/**
 * Created by jun90610@gmail.com on 2015/3/25.
 */

$(document).ready(function(){


    $(".layerBtn").bind("click",function(){
    /* 弹出遮罩层样式效果start */
        $topWidth = $(window.parent.document).width();//文档的宽度
        $topHeight = $(window.parent.document).height();//文档的高度
        /* iframe 定位iframe框架外面的元素 window.parent.document.getElementById("id_name") */
        var $layer = window.parent.document.getElementById("layer");
        $($layer).css({
            "display":"block",
            "position":"relative",
            "width":$topWidth,
            "height":$topHeight,
            "background-color":"rgb(125,125,125)",
            "filter":"alpha(opacity=50)", /*IE滤镜，透明度50%*/
            "-moz-opacity":"0.5", /*Firefox私有，透明度50%*/
            "opacity":"0.5",/*其他，透明度50%*/
            "z-index":"101"
        });
    /* 弹出遮罩层end */

    /* ajax取数据start */
        var $modelType = $(this).attr("data");
        var $paramId = $(this).attr("attr");
        $.ajax(function(){
            
        });



    /* ajax取数据end */




    });

});

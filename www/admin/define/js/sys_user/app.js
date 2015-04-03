/**
 * Created by jun90610@gmail.com on 2015/4/3.
 */

$(document).ready(function(){
    $(".layerBtn").bind("click", function(){
        var $dataType = $(this).attr("data");
        var $attr = $(this).attr("attr");
        window.location.href="/admin/index.php/sys_user/"+$dataType+"?attr="+$attr;
    });
});

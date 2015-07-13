/**
 * Created by jun90610@gmail.com on 2015/4/8.
 */
window.onload=function(){
    $(".update-btn").bind("click",function(){
        $url = $(this).attr("attr");
        $gName = $("#g_name").val();
        $gDesc = $("#g_desc").val();
        var $isSub = 1;
        if($gName.length < 1 ){
            $isSub = 0;
        }

        if($isSub){
            $dataFrom = $("#selForm").serialize();
            var $oldTime = new Date();
            var $startTime = $oldTime.getTime();
            var $uId = $(".mId").val();
            $.ajax({
                type:"post",
                url:$url,
                dataType:"json",
                data:$dataFrom,
                success:function(data){
                    var $newTime = new Date();
                    var $endTime = $newTime.getTime();
                    var $showTime = ($endTime-$startTime)/1000;
                    if(data.status){

                        $("#msg").addClass("red").show().html("修改成功."+"用时:"+$showTime+"s");

                    }else{
                        $("#msg").addClass("red").show().html(data.message+".用时:"+$showTime+"s");
                    }
                },
                error:function (XMLHttpRequest,textStatus,errorThrown){
                    console.log('XMLHttpRequest:'+XMLHttpRequest,'textStatus:'+textStatus,'errorThrown:'+errorThrown);
                }
            });
        }

    });


    $("#all").bind("click",function(){
        /**
         * attr操作的是普通非原型对象（可移除）
         * prop 操作的原型对象
         */
        $isAll = $("#all").prop("checked");
        if($isAll){
            $("#check-tab input:checkbox").prop("checked",true);
        }else{
            $("#check-tab input:checkbox").prop("checked",false);
        }

    });




}



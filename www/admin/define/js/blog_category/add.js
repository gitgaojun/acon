/**
 * Created by jun90610@gmail.com on 2015/4/14.
 */

$(document).ready(function(){

    $("#sub-a").bind("click",function(){
        $c_name = $("#c_name").val();
        $addFormData = $("#addForm").serialize();
            var $oldTime = new Date();
            var $startTime = $oldTime.getTime();
            $.ajax({
                type:"post",
                url:"/admin/index.php/blog_category/into",
                dataType:"json",
                data:$addFormData,
                success:function (data){
                    var $newTime = new Date();
                    var $endTime = $newTime.getTime();
                    var $showTime = ($endTime-$startTime)/1000;
                    if(data.status){

                        $("#msg").addClass("red").show().html("添加成功"+"用时:"+$showTime+"s");

                    }else{
                        $("#msg").addClass("red").show().html(data.message+"。用时:"+$showTime+"s");
                    }
                },
                error:function (XMLHttpRequest,textStatus,errorThrown){
                    console.log('XMLHttpRequest:'+XMLHttpRequest,'textStatus:'+textStatus,'errorThrown:'+errorThrown);
                }
            });



    });






});
/**
 * Created by jun90610@gmail.com on 2015/4/14.
 */



$(document).ready(function(){

    $("#sub-a").bind("click",function(){

        $c_name = $("#c_name").val();

        $addFormData = $("#addForm").serialize();

        if($c_name == ''){
            $("#c_name").focus().css("outline","1px solid red");//输入焦点
            $(".isSub").val(0);
        }



        if($(".isSub").val()){
            var $isSub = confirm("提交修改?");
            if(!$isSub){
                return false;
            }

            var $oldTime = new Date();
            var $startTime = $oldTime.getTime();
            var $uId = $(".mId").val();
            $.ajax({
                type:"post",
                url:"/admin/index.php/blog_category/flush",
                dataType:"json",
                data:$addFormData+"&attr="+$uId ,
                success:function (data){
                    var $newTime = new Date();
                    var $endTime = $newTime.getTime();
                    var $showTime = ($endTime-$startTime)/1000;
                    if(data.status){

                        $("#msg").addClass("red").show().html("修改成功."+"用时:"+$showTime+"s");

                    }else{
                        $("#msg").addClass("red").show().html(data.message);
                    }
                },
                error:function (XMLHttpRequest,textStatus,errorThrown){
                    console.log('XMLHttpRequest:'+XMLHttpRequest,'textStatus:'+textStatus,'errorThrown:'+errorThrown);
                }
            });
        }


    });







});


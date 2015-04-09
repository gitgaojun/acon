/**
 * Created by jun90610@gmail.com on 2015/4/9.
 */


$(document).ready(function(){

    $("#sub-a").bind("click",function(){
        $url=$(this).attr("attr");
        $g_name = $("#g_name").val();
        $addFormData = $("#addForm").serialize();

        if($g_name == ''){
            $("#g_name").focus().css("outline","1px solid red");//输入焦点
            $(".isSub").val(0);
        }


        if($(".isSub").val()){
            $("#sub-a").ajaxStart(function(){
                $("#msg").css("color","grey").show().html("正在请求数据...");
            });
            $("#sub-a").ajaxStop(function(){
                $("#msg").css("color","grey").html("正在请求数据...").hide(3000);
            });
            var $oldTime = new Date();
            var $startTime = $oldTime.getTime();
            $.ajax({
                type:"post",
                url:$url,
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
        }


    });



    $("#g_name").focus();//输入焦点
    $("#g_name").blur(function (){
        $g_name = $("#g_name").val();

        if($g_name == ''){
            $("#g_name").focus();
            $(".g_name_err").text("不为空").addClass("red");
            $("#g_name").css("outline","1px solid red");//输入焦点
            $(".isSub").val(0);
            return false;
        }else{
            $("#g_name").css("outline","none");
            $(".g_name_err").text("*").removeClass("red");
        }
        $("#g_desc").focus();

    });

    $("#g_name").keydown(function (event){
        $g_name = $("#g_name").val();

        if(event.which == '13'){
            if($g_name == ''){
                $("#g_name").focus();
                $(".g_name_err").text("不为空").addClass("red");
                $("#g_name").css("outline","1px solid red");//输入焦点
                $(".isSub").val(0);
                return false;
            }else{
                $("#g_name").css("outline","none");
                $(".g_name_err").text("*").removeClass("red");
            }
            $("#g_desc").focus();
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



});
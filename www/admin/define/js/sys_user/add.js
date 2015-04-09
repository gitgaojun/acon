/**
 * Created by jun90610@gmail.com on 2015/4/7.
 */

$(document).ready(function(){

    $("#sub-a").bind("click",function(){
        $u_name = $("#u_name").val();
        $u_relname = $("#u_relname").val();
        $u_pwd = $("#u_pwd").val();
        $addFormData = $("#addForm").serialize();

        if($u_name == ''){
            $("#u_name").focus().css("outline","1px solid red");//输入焦点
            $(".isSub").val(0);
        }
        if($u_relname == ''){
            $(".u_relname").css("outline","1px solid red");
            $(".isSub").val(0);
        }
        if($u_pwd == ''){
            $(".u_pwd").css("outline","1px solid red");
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
                url:"/admin/index.php/sys_user/into",
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



    $("#u_name").focus();//输入焦点
    $("#u_name").blur(function (){
        $u_name = $("#u_name").val();

        if($u_name == ''){
            $("#u_name").focus();
            $(".u_name_err").text("不为空").addClass("red");
            $("#u_name").css("outline","1px solid red");//输入焦点
            $(".isSub").val(0);
            return false;
        }else{
            $("#u_name").css("outline","none");
            $(".u_name_err").text("*").removeClass("red");
        }
        $("#u_relname").focus();

    });

    $("#u_name").keydown(function (event){
        $u_name = $("#u_name").val();

        if(event.which == '13'){
            if($u_name == ''){
                $("#u_name").focus();
                $(".u_name_err").text("不为空").addClass("red");
                $("#u_name").css("outline","1px solid red");//输入焦点
                $(".isSub").val(0);
                return false;
            }else{
                $("#u_name").css("outline","none");
                $(".u_name_err").text("*").removeClass("red");
            }
            $("#u_relname").focus();
        }
    });
    $("#u_relname").blur(function(){
        $u_relname = $("#u_relname").val();
        if($u_relname == ''){
            $(".u_relname").focus().css("outline","1px solid red");
            $(".u_relname_err").text("不为空").addClass("red");
            $(".isSub").val(0);
            return false;
        }else{
            $("#u_relname").css("outline","none");
            $(".u_relname_err").text("*").removeClass("red");
        }
        $("#u_pwd").focus();
    });
    $("#u_relname").keydown(function(){
        $u_relname = $("#u_relname").val();

        if(event.which == '13'){
            if($u_relname == ''){
                $(".u_relname").focus().css("outline","1px solid red");
                $(".u_relname_err").text("不为空").addClass("red");
                $(".isSub").val(0);
                return false;
            }else{
                $("#u_relname").css("outline","none");
                $(".u_relname_err").text("*").removeClass("red");
            }
            $("#u_pwd").focus();
        }
    });
    $("#u_pwd").blur(function(){
        $u_pwd = $(".u_pwd").val();
        if($u_pwd == ''){
            $(".u_pwd").focus().css("outline","1px solid red");
            $(".u_pwd_err").text("填写字母数字").addClass("red");
            $(".isSub").val(0);
            return false;
        }else{
            $("#u_pwd").css("outline","none");
            $(".u_pwd_err").text("*").removeClass("red");
        }
        $("#sub-a").trigger("click");
    });
    $("#u_pwd").keydown(function(){
        $u_pwd = $(".u_pwd").val();
        if(event.which == '13'){
            if($u_pwd == ''){
                $(".u_pwd").focus().css("outline","1px solid red");
                $(".u_pwd_err").text("填写字母数字").addClass("red");
                $(".isSub").val(0);
                return false;
            }else{
                $("#u_pwd").css("outline","none");
                $(".u_pwd_err").text("*").removeClass("red");
            }
            $("#sub-a").trigger("click");
        }
    });




});

/**
 * Created by jun90610@gmail.com on 2015/4/7.
 */

$(document).ready(function(){

    $("#sub-a").bind("click",function(){
        $u_relname = $("#u_relname").val();
        $u_name = $("#u_name").val();

        $addFormData = $("#addForm").serialize();

        if($u_name == ''){
            $("#u_name").focus().css("outline","1px solid red");//输入焦点
            $(".isSub").val(0);
        }
        if($u_relname == ''){
            $(".u_relname").css("outline","1px solid red");
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
                url:"/admin/index.php/sys_user/flush",
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
        if(event.which == '13'){
            $("#sub-a").trigger("click");
        }
    });

    $("#u_pwd").keydown(function(){
        if(event.which == '13'){
            $("#sub-a").trigger("click");
        }
    });




});

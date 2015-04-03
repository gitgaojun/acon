/**
 * Created by jun90610@gmail.com on 2015/4/2.
 */
$(document).ready(function(){

    $("#sub-a").bind("click",function(){
        $m_url = $("#m_url").val();
        $m_name = $("#m_name").val();
        $m_sort = $("#m_sort").val();
        $addFormData = $("#addForm").serialize();

        if($m_name == ''){
            $("#m_name").focus().css("outline","1px solid red");//输入焦点
            $(".isSub").val(0);
        }
        if($m_url == ''){
            $(".m_url").css("outline","1px solid red");
            $(".isSub").val(0);
        }
        if($m_sort == ''){
            $(".m_sort").css("outline","1px solid red");
            $(".isSub").val(0);
        }

        if($(".isSub").val()){
            var $isSub = confirm("提交修改?");
            if(!$isSub){
                return false;
            }

            var $oldTime = new Date();
            var $startTime = $oldTime.getTime();
            var $mId = $(".mId").val();
            $.ajax({
                type:"post",
                url:"/admin/index.php/sys_menu/flush",
                dataType:"json",
                data:$addFormData+"&attr="+$mId ,
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



    $("#m_name").focus();//输入焦点
    $("#m_name").blur(function (){
        $m_name = $("#m_name").val();

        if($m_name == ''){
            $("#m_name").focus();
            $(".m_name_err").text("不为空").addClass("red");
            $("#m_name").css("outline","1px solid red");//输入焦点
            $(".isSub").val(0);
            return false;
        }else{
            $("#m_name").css("outline","none");
            $(".m_name_err").text("*").removeClass("red");
        }
        $("#m_url").focus();

    });

    $("#m_name").keydown(function (event){
        $m_name = $("#m_name").val();

        if(event.which == '13'){
            if($m_name == ''){
                $("#m_name").focus();
                $(".m_name_err").text("不为空").addClass("red");
                $("#m_name").css("outline","1px solid red");//输入焦点
                $(".isSub").val(0);
                return false;
            }else{
                $("#m_name").css("outline","none");
                $(".m_name_err").text("*").removeClass("red");
            }
            $("#m_url").focus();
        }
    });
    $("#m_url").blur(function(){
        $m_url = $("#m_url").val();
        if($m_url == ''){
            $(".m_url").focus().css("outline","1px solid red");
            $(".m_url_err").text("不为空").addClass("red");
            $(".isSub").val(0);
            return false;
        }else{
            $("#m_url").css("outline","none");
            $(".m_url_err").text("*").removeClass("red");
        }
        $("#m_sort").focus();
    });
    $("#m_url").keydown(function(){
        $m_url = $("#m_url").val();

        if(event.which == '13'){
            if($m_url == ''){
                $(".m_url").focus().css("outline","1px solid red");
                $(".m_url_err").text("不为空").addClass("red");
                $(".isSub").val(0);
                return false;
            }else{
                $("#m_url").css("outline","none");
                $(".m_url_err").text("*").removeClass("red");
            }
            $("#m_sort").focus();
        }
    });
    $("#m_sort").blur(function(){
        $m_sort = $(".m_sort").val();
        if($m_sort == ''){
            $(".m_sort").focus().css("outline","1px solid red");
            $(".m_sort_err").text("不为空的数字").addClass("red");
            $(".isSub").val(0);
            return false;
        }else{
            $("#m_sort").css("outline","none");
            $(".m_sort_err").text("*").removeClass("red");
        }
        $("#m-dis-y").focus();
    });
    $("#m_sort").keydown(function(){
        $m_sort = $(".m_sort").val();
        if(event.which == '13'){
            if($m_sort == ''){
                $(".m_sort").focus().css("outline","1px solid red");
                $(".m_sort_err").text("不为空的数字").addClass("red");
                $(".isSub").val(0);
                return false;
            }else{
                $("#m_sort").css("outline","none");
                $(".m_sort_err").text("*").removeClass("red");
            }
            $("#m-dis-y").focus();
        }
    });
    $("#m-dis-y").keydown(function (event){
        if(event.which == '13'){
            $("#sub-a").trigger("click");
        }
    })



});
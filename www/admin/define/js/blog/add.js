/**
 * Created by jun90610@gmail.com on 2015/5/4.
 */
$(document).ready(function(){
    function Trim(Str)
    {
        return Str.replace('(^\s*)|(\s*$)/g', "");
    }

    $("#sub-a").bind("click",function() {
        $addFormData = $("#addForm").serialize();
        var $b_title = $("#b_title").val();
        var $b_content = $("#b_content").val();
        if(($b_title == null) || (Trim($b_title).length=0))
        {
            $(".b_title_err").html("不能为空");
            return false;
        }
        if(($b_content == null) || (Trim($b_content).length=0))
        {
            $(".b_content_err").html("不能为空");
            return false;
        }

        $.ajax({
            type:"post",
            url:"/admin/index.php/blog/insert",
            datatype:"json",
            data:$addFormData,
            success:function(data){
                console.log(data);
            }
        });

    });
});
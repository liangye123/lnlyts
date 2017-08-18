@include('Home.layouts.myhead')
        <!--个人中心-->
<div class="wrapper wbgcolor">
    <div class="w1200 personal">
        <div class="credit-ad"><img src="../Home/images/clist1.jpg" width="1200" height="96"></div>
        @include('Home.layouts.myleft')
        <div style="margin-top: 40px" align="center">
            <form action="bind_mail_success" method="post">
                <table style="width: 500px;height: 200px">
                    <input type="hidden" name="id" value="{{$id}}">
                    <tr>
                        <td>请输入邮箱号码：</td>
                        <td><input type="text" id="mail" style="border-color:darkblue; border-style: solid" name="email"><span id="mail_prompt"></span></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" id="bind_mail" style="background-color:darkorange; width: 80px;height: 30px; color: white" value="绑定邮箱"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
@include('Home.layouts.foot')
<script>
    $(document).ready(function(){
        $(":submit[id=bind_mail]").click(function(check){
            var val = $(":text[id=mail]").val();
            var mail=$("#mail").val()
            var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
            var flag=reg.test(mail)
            if(flag==false){
                $("#mail_prompt").html('<span style="color: red">邮箱格式不正确</span>')
                $(":text[id=mail]").focus();
                check.preventDefault();//此处阻止提交表单
            }else{
                $.ajax({
                    url:"mail_one",
                    data:{mail:mail},
                    dataType:"json",
                    async:false,//调整为同步请求
                    type:"GET",
                    success:function(msg){
                        res_info=msg
                    }
                })
                if(res_info==1){
                    $("#mail_prompt").html('<span style="color: red">该邮箱已被绑定</span>')
                    $(":text[id=mail]").focus();
                    check.preventDefault();//此处阻止提交表单
                }

            }



        });
    });

</script>

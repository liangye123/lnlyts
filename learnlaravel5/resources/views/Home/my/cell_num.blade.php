@include('Home.layouts.myhead')
        <!--个人中心-->
<div class="wrapper wbgcolor">
    <div class="w1200 personal">
        <div class="credit-ad"><img src="../Home/images/clist1.jpg" width="1200" height="96"></div>
        @include('Home.layouts.myleft')
        <div style="margin-top: 40px" align="center">
            <form action="sava_phone" method="post">
                <table style="width: 500px;height: 200px">
                    <tr>
                        <td>原手机号码：</td>
                        <td>{{$phone}}</td>
                    </tr>
                    <input type="hidden" name="phone_old" value="{{$phone}}">
                    <tr>
                        <td>输入新手机号：</td>
                        <td><input type="text" style="border-color:darkblue; border-style: solid" name="phone_new" id="phone1"><span id="phone_1"></span></td>
                    </tr>
                    <tr>
                        <td>再次输入手机号：</td>
                        <td><input type="text" style="border-color:darkblue; border-style: solid" name="re_phone_new" id="phone2"><span id="phone_2"></span></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" style="background-color:darkorange; width: 80px;height: 30px; color: white" value="修改绑定手机"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
@include('Home.layouts.foot')

<script>
    //新邮箱
    $(document).on("blur","#phone1",function(){
        phone1=$(this).val()
        if(phone1!=""){
            var reg = /^1[0-9]{10}$/;
            var flag = reg.test(phone1); //true
            if(flag){
                $("#phone_1").html('<span style="color: green">通过验证</span>')
            }else{
                $("#phone_1").html('<span style="color: red">手机格式不正确</span>')
            }
        }else {
            $("#phone_1").html('<span style="color: red">手机不能为空</span>')
        }
    })
    //确认新邮箱
    $(document).on("blur","#phone2",function(){
        phone2=$(this).val()
        if(phone1!=phone2){
            $("#phone_2").html('<span style="color: red">手机号码不一致</span>')
        }else

        if(phone2!=""){
            var reg = /^1[0-9]{10}$/;
            var flag = reg.test(phone2); //true
            if(flag){
                $("#phone_2").html('<span style="color: green">通过验证</span>')
            }else{
                $("#phone_2").html('<span style="color: red">手机格式不正确</span>')
            }
        }else {
            $("#phone_2").html('<span style="color: red">手机不能为空</span>')
        }
    })
</script>

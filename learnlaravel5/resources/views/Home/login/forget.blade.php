@include('Home.layouts.loginhead')
        <!--注册-->
<div class="wrap">
    {{--<form id="LonginForm" name="LonginForm" action="" method="post">--}}
    <div class="tdbModule loginPage">
        <div class="registerTitle">修改密码</div>
        <div class="registerCont">
            <ul>
                {{--<li class="error">--}}
                {{--<span id="prrintInfo" data-info=""><span>请输入正确用户名</span></span>--}}
                {{--</li>--}}
                <form action="updatepwd" method="post" id="checkSub">
                    <li>
                        <span class="dis">新的密码：</span>
                        <input class="input" type="text" name="password" id="password" maxlength="24" tabindex="1" autocomplete="off">
                        <span id="passwordAlt" data-info="6-24个字符，英文、数字组成，区分大小写">6-20字符 , 字母、数字、下划线组成</span>
                        {{--<a id="sssdfasdfas" href="#" class="blue">注册用户</a>--}}
                    </li>

                    <li>
                        <span class="dis">确认密码：</span>
                        <input class="input" type="password" name="repassword" id="repassword" maxlength="24" tabindex="1" autocomplete="off">
                        <span></span>
                        {{--<a href="" id="pawHide" class="blue">忘记密码</a>--}}
                    </li>
                    <li class="telNumber"> <span class="dis">手机号码:</span>
                        <input type="text" class="input _phoneNum" id="phone" name="phone" tabindex="1" maxlength="11">
                        <input type="button" id="btn" value="免费获取验证码" onclick="sendemail()" class="button radius1 _getkey" /> </a> <span id="phoneJy" data-info="请输入您的常用电话"></span></li>
                    <li class="telNumber"><span class="dis">短信验证码:</span>
                        <input id="phonVerify" type="text" class="input input1  _phonVerify" data-_id="phonVerify" name="code" tabindex="1">
                        <span class="info" id="phonVerifys" data-info="请输入手机验证码"></span></li>
                    {{--<li>--}}
                    {{--<span class="dis">验证码：</span><input type="text" onkeyup="verify(this)" id="jpgVerify" style="width:166px;" class="input" name="yzm" data-msg="验证码" maxlength="4" tabindex="1" autocomplete="off">--}}
                    {{--<img src="Home/images/code.jpg" id="yanzheng" alt="点击更换验证码" title="点击更换验证码" style="cursor:pointer;" class="valign">--}}
                    {{--<a href="javascript:void(0);" onclick="changge();" class="blue">看不清？换一张</a>--}}
                    {{--</li>--}}
                    <li class="btn">
                        <input type="submit"  value="立即修改" >
                    </li>

            </ul>
            </form>
        </div>
    </div>
    </form>
</div>
<script>

    $('#password').blur(function(){
        checkpassword();
    });

    $('#repassword').blur(function(){
        checkOne();
    });

    $('#phonVerify').blur(function(){
        checkdx();
    });

    $('#phone').blur(function(){
        sendemail();
    })

    $('#checkSub').submit(function(){
        if(!(!checkOne() || !checkpassword())){
            return true;
        }
        return false;
    });

    //验证密码
    function checkpassword(){
        var reg = /^(\w){6,20}$/;
        var pwd = $('#password').val();
        if(reg.test(pwd)){
            $('#password').next().html('√');
            $('#password').css('border-color', 'green');
            return true;
        }else{
            $('#password').css('border-color', 'red');
            return false;
        }
    }

    //验证密码一致性
    function checkOne(){
        var result = checkpassword();
        if(!result){
            return false;
        }
        var pwd = $('#password').val();
        var repwd = $('#repassword').val();
        if(pwd != repwd){
            $('#repassword').next().html('密码不一致');
            $('#repassword').css('border-color', 'red');
            return false;
        }else{
            $('#repassword').css('border-color', 'green');
            $('#repassword').next().html('√');
            return true;
        }
    }

    var countdown=60;
    function sendemail(){

        var reg = /^1[3,5,7,8]\d{9}$/;
        var tel = $('#phone').val();
        if(tel==""){
            alert("请输入手机号");
            return false;
        }
        if (!reg.test(tel)){
            alert("手机号错误")
            $('#phone').css('border-color','red');
            return false;
        }
        var obj = $("#btn");
        settime(obj);
        $.ajax({
            type: 'get',
            url: 'http://www.duoying.com/checktel',
            data: {tel: tel},
            success: function (res){
                if (res == 1){
                    $("#phoneJy").html("该手机号已注册");
                    return false;
                }else{
//                    $("#phoneJy").html("验证码已发送");
                }
            }

        })
    }
    function settime(obj){ //发送验证码倒计时
        if (countdown == 0) {
            obj.attr('disabled',false);
            //obj.removeattr("disabled");
            obj.val("免费获取验证码");
            countdown = 60;
            return;
        } else {
            obj.attr('disabled',true);
            obj.val("重新发送(" + countdown + ")");
            countdown--;
        }
        setTimeout(function(){
                    settime(obj) }
                ,1000)
    }
    //手机验证码
    function checkdx(){

        var reg=/^\d{4}$/
        var tel = $('#phone').val();
        var code = $('#phonVerify').val();
//        if(!reg.test(code)){
//            $('#phonVerify').css('border-color','red');
//            return false;
//        }

        $.ajax({
            type: 'get',
            url: 'http://www.duoying.com/checkcode',
            data: {tel: tel, code:code},
            success: function (res){
                if(res==3){
                    $('#phonVerify').next().html('√');

                }else if(res==4)
                {
                    $('#phonVerify').next().html('验证码失效,请重新获取');
                    return false;
                }else if(res==5)
                {
                    $('#phonVerify').next().html('验证码错误,请重新获取');
                    return false;
                }else{
                    $('#phonVerify').next().html('未知错误！');
                    return false;
                }
            }
        });

    }
</script>

@include('Home.layouts.foot')
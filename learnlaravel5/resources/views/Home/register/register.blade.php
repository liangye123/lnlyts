@include('Home.layouts.registerhead')
        <!--注册-->
<div class="wrap">
    <div class="tdbModule register">
        <div class="registerTitle">注册账户</div>
        <div class="registerLc1">
            <p class="p1">填写账户信息</p>
            <p class="p2">验证手机信息</p>
            <p class="p3">注册成功</p>
        </div>
        <div class="registerCont">
            <ul>
                <form action="regadd" method="post" id="checkSub">
                    <li><span class="dis">用户名:</span>
                        <input type="text" name="userName" id="userName" class="input _userName" maxlength="24" tabindex="1">
                        <span id="userNameAlt" data-info="6-24个字符，字母开头，字母、数字下划线组成">4-10个字符，汉字，字母，数字组成</span></li>
                    <li><span class="dis">密码:</span>
                        <input type="password" name="password" id="password" class="input _password" maxlength="24" tabindex="1">
                        <span id="passwordAlt" data-info="6-24个字符，英文、数字组成，区分大小写">6-20字符 , 字母、数字、下划线组成</span></li>
                    <li><span class="dis">确认密码:</span>
                        <input type="password" name="repassword" id="repassword" class="input _repeatPassword" maxlength="24" tabindex="1">
                        <span id="repeatPasswordAlt" data-info="请再次输入密码">请再次输入密码</span></li>
                    {{--<li> <span class="dis">验证码:</span>--}}
                        {{--<div style="margin-left: 165px;">--}}
                            {{--<input type="text" id="code_input" class="input input1 _yanzhengma" placeholder="请输入验证码" maxlength="5" tabindex="1">--}}
                            {{--<div id="v_container" style="width: 200px;height: 50px;"></div>--}}
                            {{--<span style="padding-left: 270px;" class="button radius1 _getkey"><input type="button" id="my_button" value="验证"   /></span>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                    <li class="telNumber"> <span class="dis">手机号码:</span>
                        <input type="text" class="input _phoneNum" id="phone" name="phone" tabindex="1" maxlength="11">
                        <input type="button" id="btn" value="免费获取验证码" onclick="sendemail()" class="button radius1 _getkey" /> </a> <span id="phoneJy" data-info="请输入您的常用电话"></span></li>
                    <li class="telNumber"><span class="dis">短信验证码:</span>
                        <input id="phonVerify" type="text" class="input input1  _phonVerify" data-_id="phonVerify" name="code" tabindex="1">
                        <span class="info" id="phonVerifys" data-info="请输入手机验证码"></span></li>
                    <!--<li> <span class="dis">推 荐 人:</span>-->
                    <!--<input type="text" class="input input1 _invist">-->
                    <!--<span class="_invist_msg">请填写推荐人账户名，如无推荐人请留空</span> </li>-->
                    <li class="agree">
                        <input id="protocol" type="checkbox" value="" checked="">
                        我同意《<a href="#" target="_black">多盈理财注册协议</a>》 <span id="protocolAlt" data-info="请查看协议">请查看协议</span></li>
                    <li class="btn radius1 _ajaxSubmit"><input type="submit" value="下一步"></li>
            </ul>
            </form>
        </div>
    </div>
</div>
<!--网站底部-->
<script>
    $('#userName').blur(function(){
        checkname();
    });
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

    $('#protocol').click(function(){
        checkterms();
    })
    $('#checkSub').submit(function(){
        if(!( !checkpassword() || !checkOne() || !checkterms() || !checkdx() || !sendemail())){
            return true;
        }
        return false;
    });
    //验证用户名
    function checkname(){
        var reg = /^[\u4e00-\u9fa5_a-zA-Z0-9_]{4,10}$/;
        var userName = $('#userName').val();
        if(reg.test(userName)){
            $.ajax({
                type: 'get',
                url: 'http://www.duoying.com/checkuname',
                data: {username:userName },
                success: function (res){
                    if(res==1){
                        $('#userName').next().html('用户名已存在');
                        return false;
                    }else{
                        $('#userName').next().html('√');
                        $('#userName').css('border-color', 'green');
                        return true;
                    }
                }
            })

        }else{
            $('#userName').css('border-color', 'red');
            return false;
        }
    }
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

        $.ajax({
            type: 'get',
            url: 'http://www.duoying.com/checkphone',
            data: {tel: tel},
            success: function (res){
                if (res == 1){
                    alert("该手机号已注册");
                    return false;
                }else{
                    var obj = $("#btn");
                    settime(obj);
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
    //验证码

    var verifyCode = new GVerify("v_container");

    document.getElementById("my_button").onclick = function(){
        var res = verifyCode.validate(document.getElementById("code_input").value);
        if(res){
            alert("验证正确");
            return ture;
        }else{
            alert("验证码错误");
            return false;
        }
    }
    //服务条款
    function checkterms(){
        var isChecked = $("#protocol").is(":checked");
        //        alert(isChecked);
        if(isChecked==true){
            return ture;
        }else{
            return false;
        }
    }
    </script>
@include('Home.layouts.foot')

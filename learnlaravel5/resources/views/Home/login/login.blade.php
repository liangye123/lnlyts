@include('Home.layouts.loginhead')
<!--注册-->
<div class="wrap">
 {{--<form id="LonginForm" name="LonginForm" action="" method="post">--}}
	<div class="tdbModule loginPage">
		<div class="registerTitle">用户登录</div>
		<div class="registerCont">
			<ul>
				{{--<li class="error">--}}
				    {{--<span id="prrintInfo" data-info=""><span>请输入正确用户名</span></span>--}}
			    {{--</li>--}}
				<form action="checklogin" method="post" id="checkSub">
				<li>
					<span class="dis">用户名：</span>
					<input class="input" type="text" onblur="userNameJy()" name="username" id="userName" maxlength="24" tabindex="1" autocomplete="off">
					<span>4-10个字符，汉字，字母，数字组成</span>
				    {{--<a id="sssdfasdfas" href="#" class="blue">注册用户</a>--}}
				</li>
	                
				<li>
				   <span class="dis">密码：</span>
					<input class="input" type="password" name="password" id="password" maxlength="24" tabindex="1" autocomplete="off">

				   <a href="forget" id="pawHide" class="blue">忘记密码</a>
				</li>
				{{--<li>--}}
				  {{--<span class="dis">验证码：</span><input type="text" onkeyup="verify(this)" id="jpgVerify" style="width:166px;" class="input" name="yzm" data-msg="验证码" maxlength="4" tabindex="1" autocomplete="off">--}}
						{{--<img src="Home/images/code.jpg" id="yanzheng" alt="点击更换验证码" title="点击更换验证码" style="cursor:pointer;" class="valign">--}}
					{{--<a href="javascript:void(0);" onclick="changge();" class="blue">看不清？换一张</a>--}}
				{{--</li>--}}
				<li class="btn"> 
					<input type="submit"  value="立即登录" >
				</li>

			</ul>
		</form>
		</div>
	</div>
 </form>
</div>
<script>
	$('#userName').blur(function(){
		checkname();
	});
	$('#password').blur(function(){
		checkpassword();
	});

	$('#checkSub').submit(function(){
		if(!(!checkpassword())){
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
				url: 'http://www.duoying.com/checkname',
				async: false,
				data: {username:userName },
				success: function (res){
					if(res==2){
						$('#userName').css('border-color', 'red');
						$('#userName').next().html('用户名不存在');
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


</script>

@include('Home.layouts.foot')
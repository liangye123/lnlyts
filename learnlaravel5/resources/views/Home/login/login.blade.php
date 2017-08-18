<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>p2p网贷平台</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="Home/css/common.css" rel="stylesheet" />
<link href="Home/css/register.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="Home/script/jquery.min.js"></script>
<script type="text/javascript" src="Home/script/common.js"></script>
<script src="Home/script/login.js" type="text/javascript"></script>
</head>
<body>
<header>
  <div class="header-top min-width">
    <div class="container fn-clear"> <strong class="fn-left">咨询热线：400-668-6698<span class="s-time">服务时间：9:00 - 18:00</span></strong>
      <ul class="header_contact">
        <li class="c_1"> <a class="ico_head_weixin" id="wx"></a>
          <div class="ceng" id="weixin_xlgz" style="display: none;">
            <div class="cnr"> <img src="Home/images/code.png"> </div>
            <b class="ar_up ar_top"></b> <b class="ar_up_in ar_top_in"></b> </div>
        </li>
        <li class="c_2"><a href="#" target="_blank" title="官方QQ" alt="官方QQ"><b class="ico_head_QQ"></b></a></li>
        <li class="c_4"><a href="#" target="_blank" title="新浪微博" alt="新浪微博"><b class="ico_head_sina"></b></a></li>
      </ul>
      <ul class="fn-right header-top-ul">
        <li> <a href="index.html" class="app">返回首页</a> </li>
        <li>
          <div class=""><a href="register.html" class="c-orange" title="免费注册">免费注册</a></div>
        </li>
        <li>
          <div class=""><a href="login.html" class="js-login" title="登录">登录</a></div>
        </li>
      </ul>
    </div>
  </div>
  <div class="header min-width">
    <div class="container">
      <div class="fn-left logo"> <a class="" href="index.html"> <img src="Home/images/logo.png"  title=""> </a> </div>
      <ul class="top-nav fn-clear">
        <li class="on"> <a href="index.html">首页</a> </li>
        <li> <a href="list.html" class="">我要投资</a> </li>
        <li> <a href="帮助中心.html">安全保障</a> </li>
        <li class="top-nav-safe"> <a href="个人中心首页.html">我的账户</a> </li>
        <li> <a href="公司简介.html">关于我们</a> </li>
      </ul>
    </div>
  </div>
</header>
<!--注册-->
<div class="wrap">
 <form id="LonginForm" name="LonginForm" action="" method="post">
	<div class="tdbModule loginPage">
		<div class="registerTitle">用户登录</div>
		<div class="registerCont">
			<ul>
				<li class="error">
				    <span id="prrintInfo" data-info=""><span>请输入正确用户名</span></span>
			    </li>
				<li>
					<span class="dis">用户名：</span><input class="input" type="text" onblur="userNameJy()" name="j_username" id="userName" maxlength="24" tabindex="1" autocomplete="off"> 
				    <a id="sssdfasdfas" href="#" class="blue">注册用户</a>
				</li>
	                
				<li>
				   <span class="dis">密码：</span><input class="input" type="password" name="password" id="password" maxlength="24" tabindex="1" autocomplete="off">  
				   <a href="#" id="pawHide" class="blue">忘记密码</a>
				</li>
				<li>
				  <span class="dis">验证码：</span><input type="text" onkeyup="verify(this)" id="jpgVerify" style="width:166px;" class="input" name="yzm" data-msg="验证码" maxlength="4" tabindex="1" autocomplete="off">
						<img src="Home/images/code.jpg" id="yanzheng" alt="点击更换验证码" title="点击更换验证码" style="cursor:pointer;" class="valign">
					<a href="javascript:void(0);" onclick="changge();" class="blue">看不清？换一张</a>
				</li>
				<li class="btn"> 
					<input type="button" class="radius1" value="立即登录" id="submitBtn" onclick="sublogin()" disabled="disabled">
				</li>
			</ul>
		</div>
	</div>
 </form>
</div>
@include('Home.layouts.foot')
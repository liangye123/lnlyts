@section('head')
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>p2p网贷平台</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="Home/css/common.css" rel="stylesheet" />
<link href="Home/css/index.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="Home/script/jquery.min.js"></script>
<script type="text/javascript" src="Home/script/common.js"></script>

<style>
/*上下滚动*/
#scrollDiv {
  width: 400px;
  height: 30px;
  line-height: 30px;
  overflow: hidden;
}
#scrollDiv li {
  height: 30px;
  padding-left: 10px;
}
</style>
<script type="text/javascript">
// 上下滚动
function AutoScroll(obj) {
    $(obj).find("ul:first").animate({
        marginTop: "-25px"
    },
    500,
    function() {
        $(this).css({
            marginTop: "0px"
        }).find("li:first").appendTo(this);
    });
}
$(document).ready(function() {
    var myar = setInterval('AutoScroll("#scrollDiv")', 3000);
    $("#scrollDiv").hover(function() {
        clearInterval(myar);
    },
    function() {
        myar = setInterval('AutoScroll("#scrollDiv")', 3000)
    }); //当鼠标放上去的时候，滚动停止，鼠标离开的时候滚动开始
});


</script>
</head>
<body>
<header>
  <div class="header-top min-width">
    <div class="container fn-clear"> <strong class="fn-left">咨询热线：400-668-6698<span class="s-time">服务时间：9:00 - 18:00</span></strong>
      <ul class="header_contact">
        <li class="c_1"> <a class="ico_head_weixin" id="wx"></a>
          <div class="ceng" id="weixin_xlgz" style="display: none;">
            <div class="cnr"> <img src="{{URL::asset('/')}}Home/images/code.png"> </div>
            <b class="ar_up ar_top"></b> <b class="ar_up_in ar_top_in"></b> </div>
        </li>
        <li class="c_2"><a href="#" target="_blank" title="官方QQ" alt="官方QQ"><b class="ico_head_QQ"></b></a></li>
        <li class="c_4"><a href="#" target="_blank" title="新浪微博" alt="新浪微博"><b class="ico_head_sina"></b></a></li>
      </ul>
      <ul class="fn-right header-top-ul">
        <li> <a href="../index" class="app">返回首页</a> </li>
        <li>

          <div class=""><a href="register" class="c-orange" title="免费注册">免费注册</a></div>
        </li>
        <li>
          <div class=""><a href="login" class="js-login" title="登录">登录</a></div>
        </li>

          <li><div style="color: #0fa24e"><a href="loginout" class="js-login" title="退出">{{session('user_name')}}</a></div></li>
      </ul>
    </div>
  </div>
  <div class="header min-width">
    <div class="container">
      <div class="fn-left logo"> <a class="" href="../index"> <img src="{{URL::asset('/')}}Home/images/logo.png"  title=""> </a> </div>
      <ul class="top-nav fn-clear">
        <li class="on"> <a href="../index">首页</a> </li>
        <li> <a href="../invest/index" class="">我要投资</a> </li>
        <li> <a href="../safe/index">安全保障</a> </li>
        <li class="top-nav-safe"> <a href="../my/index">我的账户</a> </li>
        <li> <a href="../company/introduce">关于我们</a> </li>
      </ul>
    </div>
  </div>
</header>
@show
@include('Home.layouts.myhead')
<!--个人中心-->
<div class="wrapper wbgcolor">
    <div class="w1200 personal">
        <div class="credit-ad"><img src="../Home/images/clist1.jpg" width="1000" height="80"></div>
        @include('Home.layouts.myleft')
        <label id="typeValue" style="display:none;"> </label>
        <style type="text/css">
            .wdhb-tab .on  a{color:#fff;}
        </style>
        <div class="personal-main">
            <div class="personal-zqzr personal-xtxx" style="min-height: 500px;">
                <h3><i>我的红包</i></h3>
                <div class="lx-wdhb"> <span class="pay-title">兑换红包</span> <span class="pay-number">
          <form id="codeForm" name="codeForm" method="get" action="exchange">
              <input id="codeForm1" type="text" name="id_code" class="pay-money-txt">
              <input type="submit" value="兑换" class="btn-dh btn-num">
              <span class="cz-error" style="display:none;"> <span class="error">红包兑换码不能为空！</span> </span>
          </form>
          <script>
              /*$(".btn-num").click(function(){
               var num=$("#codeForm1").val();
               if(num==""){
               return false;
               }
               $.ajax({
               type:'get',
               url:'ecchange',
               data:{codeForm1:num},
               success:function(msg){
               alert(msg);
               }
               });
               });*/
              //<![CDATA[
              $(function(){
                  if(true){
                      $("#codeForm1").val("输入验证码，兑换相应面值的红包");
                  }
                  $("#codeForm1").blur(function(){
                      var code = $(this).val();
                      if(undefined == code || null == code || "" == code || "输入验证码，兑换相应面值的红包" == code){
                          $(this).val("输入验证码，兑换相应面值的红包");
                          $(".cz-error").css({"display": "block"});
                      }
                  });
                  $("#codeForm1").focus(function(){
                      $(".cz-error").css({"display": "none"});
                      var code = $(this).val();
                      if(undefined != code && null != code && "输入验证码，兑换相应面值的红包" == code){
                          $(this).val("");
                      }
                  });
              })

              function checkExchangeCode(){
                  var code = $("#codeForm1").val();
                  if(undefined == code || null == code || "" == code || "输入验证码，兑换相应面值的红包" == code){
                      $(this).val("输入验证码，兑换相应面值的红包");
                      $(".cz-error").css({"display": "block"});
                      return false;
                  }
                  return true;
              }
              //]]>
          </script>
          </span> </div>
                <form id="form" name="form" method="post" action="">
                    <script type="text/javascript">clearPage = function() {PrimeFaces.ab({source:'form:j_idt76',formId:'form',process:'form:j_idt76',params:arguments[0]});}</script>
          <span id="form:dataTable">
          <div id="wdhb-tab" class="wdhb-tab">
              <ul>
                  <li class="on"><a href="redbag?key=0" title="未使用">未使用 </a> </li>
                  <li><a href="redbag?key=1" title="已使用" >已使用 </a> </li>
                  <li><a href="redbag?key=2" title="已过期">已过期 </a> </li>
              </ul>
          </div>
          <div class="wdhb-title"><span class="wdhb-name">红包名称</span><span class="wdhb-con">红包验证码</span><span class="wdhb-deadline">截止日期</span> <span class="wdhb-status">状态</span> </div>
          <div class="zqzr-list">
              <ul>
                  @foreach($data as $v)
                      <li><span class="wdhb-name">现金{{$v->money}}元</span><span class="wdhb-con">{{$v->cdkey}}</span><span class="wdhb-deadline">{{$v->end_time}}</span> <span class="wdhb-status">
                      @if ($v->start == 0)
                                  <a href="redbag?key=0">未使用</a>
                              @elseif ($v->start == 1)
                                  <a href="redbag?key=1">已使用</a>
                              @else
                                  <a href="redbag?key=2">已过期</a>
                              @endif
                     </span></li>
                  @endforeach
              </ul>
          </div>
          <!--<div style="float:left; width:760px;height:200px;padding-top:100px; text-align:center;color:#d4d4d4; font-size:16px;">
					 <img src="images/nondata.png" width="60" height="60"><br><br>
					   暂无红包记录</div>-->
          </span>
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
@include('Home.layouts.foot')


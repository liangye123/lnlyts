@include('Home.layouts.myhead')
<!--个人中心-->
<div class="wrapper wbgcolor">
    <div class="w1200 personal">
        <div class="credit-ad"><img src="../Home/images/clist1.jpg" width="1200" height="96"></div>
        @include('Home.layouts.myleft')
        <label id="typeValue" style="display:none;"> </label>
        <div class="personal-main">
            <div class="personal-zqzr personal-xtxx" style="min-height: 500px;">
                <h3> <i>兑换历史</i> </h3>
                <div class="wdhb-title wdhb-dhls"> <span class="wdhb-yzm">验证码</span><span class="wdhb-con">兑换红包名称</span><span class="wdhb-deadline">兑换日期</span> </div>
                <form id="form" name="form" method="post" action="">
                    <div class="zqzr-list">
                        <ul>
                            @foreach($data as $v)
                                <li><span class="wdhb-yzm">{{$v->idcode}}</span><span class="wdhb-con">现金红包{{$v->money}}元</span><span class="wdhb-deadline">{{$v->add_time}}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <!--<div style="float:left; width:760px;height:200px;padding-top:100px; text-align:center;color:#d4d4d4; font-size:16px;">
                               <img src="/site/themes/default/style/../images/nondata.png" width="60" height="60"><br><br>
                                 暂无兑换记录</div>-->
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
@include('Home.layouts.foot')
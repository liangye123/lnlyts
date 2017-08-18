@include('Home.layouts.investhead')
<!--信息详细-->
<div class="item-detail wrap">
  <div class="breadcrumbs"> <a href="index.html">首页</a>&gt; <a href="#">散标投资列表</a>&gt; <span class="cur">项目详情</span> </div>
  <div class="item-detail-head clearfix" data-target="sideMenu">
    <div class="hd"> <i class="" title="车易贷"></i>
      <h2><?php echo $data['productName']?></h2>
    </div>
    <div class="bd clearfix">
      <div class="data">
        <ul>
          <li> <span class="f16">借款金额</span><br>
            <span class="f30 c-333" id="account"><?php echo number_format($data['productAmount'],2)?></span>元 </li>
          <li class="relative"><span class="f16">年利率</span><br>
            <span class="f30 c-orange"><?php echo number_format($data['rate'],2)?>%</span> </li>
          <li><span class="f16">借款期限</span><br>
            <span class="f30 c-333"><?php echo $data['deadline']?></span>个月 </li>
          <li><span class="c-888">借款编号：</span><?php echo $data['sn']?></li>
          <li><span class="c-888">发标日期：</span><?php echo $data['investTime']?></li>
          <li><span class="c-888">保障方式：</span>100%本息垫付</li>
          <li><span class="c-888">还款方式：</span><?php echo $data['repaymentmethods']?></li>
          {{--<li class="colspan"> <span class="c-888 fl">投标进度：</span>--}}
            {{--<div class="progress-bar fl"> <span style="width:100%"></span> </div>--}}
            {{--<span class="c-green">100%</span> </li>--}}
          <li> <span class="c-888">投资范围：</span> <span id="account_range"> 50元~
            不限 </span> </li>
        </ul>
      </div>

        <?php if($data['contact'] == 0) { ?>


          <div class="inner">

            <?php if($userdata['username'] == ''){ ?>

                   <div class="text"> 账户余额：&nbsp;&nbsp;<a href="../login">登陆</a>&nbsp;&nbsp;&nbsp;&nbsp;后可见<br>

              <?php }else{ ?>
                     <form action="../invest/order" method="post">
                         <div class="text"> 账户余额：&nbsp;&nbsp;<span class="f24 c-333" style="color: red"><?php echo $userdata['money']?>&nbsp;&nbsp;</span>元
                         <a href="../my/recharge1" style="margin-left: 100px;">充值</a><br>
                           <input type="hidden" name="user_id" value="<?php echo $userdata['id']?>">
                           <input type="hidden" name="id" value="<?php echo $data['id']?>">
                         <input id="orderAmount" name="orderAmount" type="text" style="width: 300px; height: 40px;margin-top: 20px;margin-bottom: 20px;" placeholder="输入加入金额，为1,000的整数倍"><br>
                        <span id="result" style="color: red"></span><br>
                     <?php } ?>

                  <span>剩余金额：<font color="green" id="productAmount"><?php echo number_format($data['productAmount']-$data['repayments'],2);?></font>元</span>
                  &nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 30px;">结束剩余</span>
                  <br><span>加入上限：<font color="red" id="investLimit"><?php echo number_format($data['investLimit'],2)?></font>元</span>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 20px;"><font color="red"><?php echo $ensj;?></font>天</span>
                  <br>
                     <input type="submit" id="button" style="width: 300px;height: 40px;background-color: #ff8e3a;margin-top: 10px;" value="加入">
                     </form>

                   </div>

          </div>


        <?php }else{ ?>

               <?php if($data['start'] == 0) { ?>

                          <div class="inner">
                            <div class="text"><span style="float: right;font-size: 20px;"><?= $data['jx']?></span><br>
                             <font color="#ff6037"><span class="f24 c-333" style="font-size: 60px;"><?= $data['number']?></span>人</font><br>
                              <span style="font-size: 10px;">加入人次</span> </div>
                            <i class="icon icon-status icon-status1" style="float: right"></i>

                          </div>
               <?php }else{ ?>

      <div class="inner">
        <div class="text"> 距离退出还有：<span></span>天<br>
          剩余期限：<span class="f24 c-333">29天</span> <br>
          下期还款日： <span class="f20 c-333">2015-10-13</span> </div>
        <i class="icon icon-status icon-status1" style="float: right"></i>

      </div>
               <?php } ?>



    <?php } ?>

      {{--<i class="icon icon-status icon-status1"></i>--}}
    </div>
  </div>
    {{--<script src="../Home/script/jquery.alerts.js" type="text/javascript"></script>--}}
    <!-- Dependencies -->

    <script>
         $(function(){
           $("#button").attr("disabled","disabled");
         })
         $('#orderAmount').keyup(function(){
               //订单金额
                var orderAmount = $('#orderAmount').val();
//                var zer =  fmoney(orderAmount,2);
               //上限金额
                var investLimit = $('#investLimit').html();
              //剩余金额
                var productAmount = $('#productAmount').html();
               //去掉金额字符的，号以及。
                var investLimit = investLimit.replace(',','');
                var investLimit = parseInt(investLimit);
                var productAmount = productAmount.replace(',','');
                var productAmount = productAmount.replace(',','');
                 var productAmount = parseInt(productAmount);
//               alert(productAmount);
                var re = /^[0-9]*[0-9]$/i;       //校验是否为数字
                 if(re.test(orderAmount) && orderAmount%1000===0) {
                    if (orderAmount > investLimit){
                      $(this).css('border-color', 'red');
                      $('#result').html("单笔输入最多不能超过"+investLimit+"");
                      $("#button").attr("disabled","disabled");
                    }else if(orderAmount > productAmount){

                      $(this).css('border-color', 'red');
                      $('#result').html("超出余额，余额为"+productAmount+"");
                      $("#button").attr("disabled","disabled");

                    }else{
                      $(this).css('border-color', 'green');
                      $('#result').html("");
                      $("#button").attr("disabled",false);
                    }
                 }else {
                      $(this).css('border-color', 'red');
                      $('#result').html("输入金额需为1,000元的整数倍");
                      $("#button").attr("disabled","disabled");
                 }
         })

         function fmoney(s, n) {
           n = n > 0 && n <= 20 ? n : 2;
           s = parseFloat((s + "").replace(/[^\d\.-]/g, "")).toFixed(n) + "";
           var l = s.split(".")[0].split("").reverse(), r = s.split(".")[1];
           t = "";
           for (i = 0; i < l.length; i++) {
             t += l[i] + ((i + 1) % 3 == 0 && (i + 1) != l.length ? "," : "");
           }
           return t.split("").reverse().join("") + "." + r;
         }
    </script>
  <div class="item-detail-body clearfix mrt30 ui-tab">
    <div class="ui-tab-nav hd"> <i class="icon-cur" style="left: 39px;"></i>
      <ul>
        <li class="nav_li active" id="nav_1"><a href="javascript:;">借款信息</a></li>
        <li class="nav_li" id="nav_2"><a href="javascript:;">投资记录</a> <i class="icon icon-num1" style="margin-left: -15px;"> <span id="tender_times">23</span> <em></em> </i> </li>
        <li class="nav_li" id="nav_3"><a href="javascript:;">还款列表</a></li>
      </ul>
    </div>
    <div class="bd">
      <div class="ui-tab-item active" style="display: block;">
        <div class="borrow-info">
          <dl class="item">
            <dt>
              <h3>借款人介绍</h3>
            </dt>
            <dd>
              <div class="text">
                <p class="MsoNormal" style="margin-left:0cm;text-indent:0cm;"> 借款人信息介绍：</p>
                <p class="MsoNormal" style="margin-left:0cm;text-indent:0cm;"> 借款人赵女士，<span>1988</span>年出生，大专学历，未婚，户籍地址为四川省古蔺县，现居住于成都市成华区。</p>
                <p class="MsoNormal" style="margin-left:0cm;text-indent:0cm;"> 借款人工作情况：</p>
                <p class="MsoNormal" style="margin-left:0cm;text-indent:0cm;"> 赵女士为成都某服装店老板，月收入<span>2</span>万元，收入居住稳定。</p>
                <p class="MsoNormal" style="margin-left:0cm;text-indent:0cm;"> 借款人资产介绍：</p>
                <p class="MsoNormal" style="margin-left:0cm;text-indent:0cm;"> 赵女士有<span>1</span>辆全款长安福特福克斯汽车。</p>
                <p class="MsoNormal" style="margin-left:0cm;text-indent:0cm;"> 详细资金用途：</p>
                <p class="MsoNormal" style="margin-left:0cm;text-indent:0cm;"> 借款人申请汽车质押贷款，贷款用于资金周转。</p>
              </div>
            </dd>
          </dl>
          <dl class="item">
            <dt>
              <h3>审核信息</h3>
            </dt>
            <dd>
              <div class="verify clearfix">
                <ul>
                  <li><i class="icon icon-4"></i><br>
                    身份证</li>
                  <li><i class="icon icon-5"></i><br>
                    户口本</li>
                  <li><i class="icon icon-6"></i><br>
                    结婚证</li>
                  <li><i class="icon icon-7"></i><br>
                    工作证明</li>
                  <li><i class="icon icon-8"></i><br>
                    工资卡流水</li>
                  <li><i class="icon icon-9"></i><br>
                    收入证明</li>
                  <li><i class="icon icon-10"></i><br>
                    征信报告</li>
                  <li><i class="icon icon-11"></i><br>
                    亲属调查</li>
                  <li><i class="icon icon-19"></i><br>
                    行驶证</li>
                  <li><i class="icon icon-20"></i><br>
                    车辆登记证</li>
                  <li><i class="icon icon-21"></i><br>
                    车辆登记发票</li>
                  <li><i class="icon icon-22"></i><br>
                    车辆交强险</li>
                  <li><i class="icon icon-23"></i><br>
                    车辆商业保险</li>
                  <li><i class="icon icon-24"></i><br>
                    车辆评估认证</li>
                </ul>
              </div>
            </dd>
          </dl>
          <dl class="item">
            <dt>
              <h3>风控步骤</h3>
            </dt>
            <dd>
              <div class="text">
                <p class="MsoNormal" style="margin-left:0cm;text-indent:0cm;"> 调查：风控部对借款人各项信息进行了全面的电话征信，一切资料真实可靠。<span></span> </p>
                <p class="MsoNormal" style="margin-left:0cm;text-indent:0cm;"> 抵押物：全款长安福特福克斯汽车，车牌号：川<span>AYY***</span>，新车购买于<span>2013</span>年，裸车价<span>14</span>万，评估价<span>5</span>万。 </p>
                <p class="MsoNormal" style="margin-left:0cm;text-indent:0cm;"> 权证：汽车已入库、已办理相关手续等。 </p>
                <p class="MsoNormal" style="margin-left:0cm;text-indent:0cm;"> 担保：质押物担保。 </p>
                <p class="MsoNormal" style="margin-left:0cm;text-indent:0cm;"> 结论：此客户为老客户，上笔贷款<span>4</span>万元，标的号为<span>20150745682</span>，已结清，现因资金周转，再次申请贷款。借款人居住稳定，收入来源可靠，经风控综合评估，同意放款<span>4</span>万。 </p>
                <p class="MsoNormal" style="margin-left:0cm;text-indent:0cm;"> 保障：借款逾期<span>48</span>小时内，易贷风险准备金先行垫付。 </p>
              </div>
              <div class="step clearfix">
                <ul>
                  <li><i class="icon icon-1"></i>资料审核</li>
                  <li><i class="icon icon-2"></i>实地调查</li>
                  <li><i class="icon icon-3"></i>资产评估</li>
                  <li class="no"><i class="icon icon-4"></i>发布借款</li>
                </ul>
              </div>
              <div class="conclusion f16"> 结论：经风控部综合评估， <span class="c-orange">同意放款40,000.00元；</span> <i class="icon icon-status icon-status1"></i> </div>
            </dd>
          </dl>

        </div>
      </div>
      <div class="ui-tab-item" style="display: none;">
        <div class="repayment-list"> 目前投标总额：<span class="c-orange">40,000.00 元</span>&nbsp;&nbsp;
          剩余投标金额：<span class="c-orange">0.00 元</span>
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
              <tr>
                <th>投标人</th>
                <th>投标金额</th>
                <th>投标时间</th>
                <th>投标方式</th>
              </tr>
            </tbody>


            <tbody id="repayment_content">
              <tr>
                <td>筱*** </td>
                <td><span class="c-orange">￥652.00</span></td>
                <td>2015-09-13 14:22:01</td>
                <td>自动</td>
              </tr>

            </tbody>


            <tfoot>
              <tr class="page-outer">
                <td colspan="4" align="center"><div class="pagination clearfix"><span class="page" id="repayment_content_pager"><a class="disabled"> 上一页 </a><a class="curr">1</a><a href="javascript:void(0)">2</a><a href="javascript:void(0)" next="2">下一页</a><em>共2页</em>
                    <dl class="page-select">
                      <dt><span>1</span><i class="icon icon-down"></i></dt>
                      <dd style="display: none;"><a href="javascript:;" total="23" spaninterval="2" content="repayment_content">1</a><a href="javascript:;" total="23" spaninterval="2" content="repayment_content">2</a></dd>
                    </dl>
                    </span></div></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="ui-tab-item" style="display: none;">
        <div class="repayment-list"> 已还本息：<span class="c-orange">0.00元</span>&nbsp;&nbsp;
          待还本息：<span class="c-orange">40,400.00元</span>&nbsp;&nbsp;(待还本息因算法不同可能会存误差，实际金额以到账金额为准！)
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <th>合约还款日期</th>
                <th>期数</th>
                <th>应还本金</th>
                <th>应还利息</th>
                <th>应还本息</th>
                <th>还款状态</th>
              </tr>
              <tr>
                <td>2015-10-13</td>
                <td>1</td>
                <td>40,000.00元</td>
                <td>400.00元</td>
                <td>40,400.00元</td>
                <td>还款中</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@include('Home.layouts.foot')
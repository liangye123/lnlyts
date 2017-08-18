@include('Home.layouts.investhead')
<!--列表-->
<div class="page-filter wrap">
  <div class="breadcrumbs"><a href="index.html">首页</a>&gt;<span class="cur">散标投资列表</span></div>
  <div class="invest-filter" data-target="sideMenu">
    <div class="filter-inner clearfix">
      <div class="filter-item">
        <div class="hd">
          <h3>筛选投资项目</h3>
          <label>
          <input id="filterMulti" name="multiple_choice" type="checkbox">
          多选</label>
        </div>
        <div class="bd">
          <dl>
            <dt>项目类型</dt>
            <dd>
              <ul>
                <li class="n1"><a href="javascript:url('post_type','');" id="post_type_" class="active">不限</a></li>
                <?php foreach($data as $k=>$v) { ?>
                <li class="n2"><a href="javascript:url('post_type','car');" id="post_type_car" class="lx" attr-id="<?php echo $v->id?>"><?php echo $v->typeName?></a></li>
                <?php } ?>
              </ul>
            </dd>
          </dl>
          <dl>
            <script>
              $('.lx').click(function(){
                    var id = $(this).attr('attr-id');
//                 alert(id);
//                    $(this).css('background-color:#00ff00');
                $.ajax({
                       type:"POST",
                       url:"typeShow",
                       data:{id:id},
                       success:function(data){
                         var str="";
                         $.each(data,function(k,v){
                           str+="<div class='item'>";
                           str+="<ul>";
                           str+="<li class='col-330 col-t'><a href='infor?id="+v.id+"' target='_blank'></a><a class='f18' href='../invest/infor' title='"+ v.productName+"' target='_blank'>"+ v.productName+"</a></li>";
                           str+="<li class='col-180'><span class='f20 c-333'>"+ v.productAmount+"</span>元</li>";
                           str+="<li class='col-110 relative'><span class='f20 c-orange'>"+ v.rate+"</span></li>";
                           str+="<li class='col-150'> <span class='f20 c-333'>"+ v.deadline+"</span>个月 </li>";
                           str+="<li class='col-150'>"+ v.repaymentmethods+"</li>";
                           str+="<li class='col-120'>";
                           str+="</li>";
                               if(v.contact == 1){
                                       str+="<li class='col-120-2'> <a class='ui-btn btn-gray' href='infor.html'>还款中</a> </li>";
                                }else{
                                       str+="<li class='col-120-2'> <a class='ui-btn btn-gray' style='background-color: green' href='infor?id="+v.id+"'>加入</a> </li>";
                                }
                         str+="</ul>";
                         str+="</div>";
                         })
                         $('#div').html(str);

                       }
                })
              })
            </script>
            {{--<dt>年利率</dt>--}}
            {{--<dd>--}}
              {{--<ul>--}}
                {{--<li class="n1"><a href="javascript:url('borrow_interestrate','');" id="borrow_interestrate_" class="active">不限</a></li>--}}
                {{--<li class="n2"><a id="borrow_interestrate_1" href="javascript:url('borrow_interestrate','1');">12%以下</a> </li>--}}
                {{--<li class="n3"><a id="borrow_interestrate_2" href="javascript:url('borrow_interestrate','2');">12%-14%</a> </li>--}}
                {{--<li class="n4"><a id="borrow_interestrate_3" href="javascript:url('borrow_interestrate','3');">14%-16%</a> </li>--}}
                {{--<li class="n5"><a id="borrow_interestrate_4" href="javascript:url('borrow_interestrate','4');">16%及以上</a> </li>--}}
              {{--</ul>--}}
            {{--</dd>--}}
          {{--</dl>--}}
          {{--<dl>--}}
            {{--<dt>期限</dt>--}}
            {{--<dd>--}}
              {{--<ul>--}}
                {{--<li class="n1"><a href="javascript:url('spread_month','');" id="spread_month_" class="active">不限</a> </li>--}}
                {{--<li class="n2"><a id="spread_month_1" href="javascript:url('spread_month','1');">1月以下</a> </li>--}}
                {{--<li class="n3"><a id="spread_month_2" href="javascript:url('spread_month','2');">1-3月</a> </li>--}}
                {{--<li class="n4"><a id="spread_month_3" href="javascript:url('spread_month','3');">3-6月</a> </li>--}}
                {{--<li class="n5"><a id="spread_month_4" href="javascript:url('spread_month','4');">6-12月</a> </li>--}}
                {{--<li class="n6"><a id="spread_month_5" href="javascript:url('spread_month','5');">12月及以上</a> </li>--}}
              {{--</ul>--}}
            {{--</dd>--}}
          {{--</dl>--}}
          {{--<dl class="repayment">--}}
            {{--<dt>还款方式</dt>--}}
            {{--<dd>--}}
              {{--<ul>--}}
                {{--<li class="n1"><a href="javascript:url('repay_style','');" id="repay_style_" class="active">不限</a></li>--}}
                {{--<li class="n2"><a id="repay_style_end" href="javascript:url('repay_style','end');">到期还本付息</a> </li>--}}
                {{--<li class="n2"><a id="repay_style_endmonth" href="javascript:url('repay_style','endmonth');">按月付息,到期还本</a> </li>--}}
                {{--<li class="n2"><a id="repay_style_month" href="javascript:url('repay_style','month');">等额本息</a> </li>--}}
              {{--</ul>--}}
            {{--</dd>--}}
          {{--</dl>--}}
        </div>
      </div>
      <div class="common-problem">
        <h3>常见问题</h3>
        <ul>
          <li><a href="#">什么是债权贷？</a></li>
          <li><a href="#">关于"债权贷"产品的说明</a></li>
          <li><a href="#">易贷网P2P理财收费标准</a></li>
          <li><a href="#">债权贷和房易贷、车易贷有什么区别？</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="invest-list mrt30 clearfix">
    <div class="hd">
      <h3>投资列表</h3>
      <div class="count">
        <ul>
          <li class="line">散标投资交易金额&nbsp;&nbsp;<span class="f20 bold">73.54亿元</span></li>
          <li>累计赚取收益&nbsp;&nbsp;<span class="f20 bold">2.52亿元</span></li>
        </ul>
      </div>
    </div>
    <div class="bd">
      <div class="invest-table clearfix">
        <div class="title clearfix">
          <ul>
            <li class="col-330">借款标题</li>
            <li class="col-180"><a href="javascript:url('order','account_up');" class="">借款金额</a> </li>
            <li class="col-110"><a href="javascript:url('order','apr_up');" class="">年利率</a> </li>
            <li class="col-150"><a href="javascript:url('order','period_up');" class="">借款期限</a> </li>
            <li class="col-150">还款方式</li>
            <li class="col-120"><a href="javascript:url('order','scale_up');" class=""></a></li>
            <li class="col-120-t">操作</li>
          </ul>
        </div>
        <!------------投资列表-------------->
        <div id="div">
        <?php foreach($info as $k=>$v) { ?>
        <div class="item">
          <ul>
            <li class="col-330 col-t"><a href="infor?id=<?php echo $v->id?>" target="_blank"></a><a class="f18" href="infor?id=<?php echo $v->id?>" title="<?php echo $v->productName ?>" target="_blank"><?php echo $v->productName ?> </a></li>
            <li class="col-180"><span class="f20 c-333"><?php echo $v->productAmount?></span>元</li>
            <li class="col-110 relative"><span class="f20 c-orange"><?php echo $v->rate?></span></li>
            <li class="col-150"> <span class="f20 c-333"><?php echo $v->deadline?></span>个月 </li>
            <li class="col-150"><?php echo $v->repaymentmethods?></li>
            <li class="col-120">
            </li>
            <?php if($v->contact == 1) { ?>
            <li class="col-120-2"> <a class="ui-btn btn-gray" href="infor.html">还款中</a> </li>
            <?php }else{ ?>
            <li class="col-120-2"> <a class="ui-btn btn-gray" style="background-color: green" href="infor?id=<?php echo $v->id?>">加入</a> </li>
            <?php } ?>
          </ul>
        </div>
       <?php } ?>
        </div>
        <!------------投资列表-------------->
      </div>
      <div class="pagination clearfix mrt30"> <span class="page"><a href="javascript:void(0);" onclick="">首页</a><a href="javascript:void(0);" onclick="">上一页</a>&nbsp;<a class="curr" href="javascript:;">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">5</a> <a href="javascript:void(0);" onclick="#">下一页</a><a href="javascript:void(0);" onclick="#">尾页</a>&nbsp;<em>共2297页&nbsp;</em></span>
        <dl class="page-select">
          <dt><span>1</span><i class="icon icon-down"></i></dt>
          <dd style="display: none;">
            <ul name="nump" id="jsnump">
              <li><a href="##" onclick="page_jump(&quot;this&quot;,1)">1</a></li>
              <li><a href="##" onclick="page_jump(&quot;this&quot;,2)">2</a></li>
              <li><a href="##" onclick="page_jump(&quot;this&quot;,3)">3</a></li>
            </ul>
          </dd>
        </dl>
      </div>
      
    </div>
  </div>
</div>
@include('Home.layouts.foot')
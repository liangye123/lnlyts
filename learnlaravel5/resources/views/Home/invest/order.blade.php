@include('Home.layouts.investhead')
        <!--信息详细-->
<style>
    #ord tr{
        height: 80px;
    }
    #ord tr td input{
            height: 40px;
            width: 400px;
            text-align: right;

    }
</style>
<div class="item-detail wrap">

</div>

        <div class="item-detail-body clearfix mrt30 ui-tab">
            <form action="../invest/addOrder" method="post">
            <center>
            <table id="ord">
                <tr>
                    <td>项目名称：</td>
                    <td><input type="text" disabled="disabled" value="<?= $data['productName']?>">
                         <input type="hidden" name="productName" value="<?= $data['productName']?>">
                    </td>
                </tr>
                <tr>
                    <td>投资金额：</td>
                    <td><input type="text" disabled="disabled" value="<?= number_format($data['order_money'],2)?>">
                        <input type="hidden" name="order_money"  value="<?= number_format($data['order_money'],2)?>">
                    </td>
                </tr>
                <tr>
                    <td>年利率：</td>
                    <td><input type="text" disabled="disabled" value="<?= number_format($data['rate'],2)?>">%
                        <input type="hidden" name="rate" value="<?= number_format($data['rate'],2)?>">
                    </td>
                </tr>
                <tr>
                    <td>结束时间：</td>
                    <td><input type="text" disabled="disabled" value="<?= $data['interestEndTime']?>">
                        <input type="hidden" name="interestEndTime" value="<?= $data['interestEndTime']?>">
                    </td>
                </tr>
                <tr>
                    <td>期限时长：</td>
                    <td><input type="text" disabled="disabled" value="<?= $data['deadline']?>">个月
                         <input type="hidden" name="deadline" value="<?= $data['deadline']?>">
                    </td>
                </tr>
                <tr>
                    <td>年息：</td>
                    <td><input type="text" disabled="disabled" value="<?= $data['annualinterest']?>">元
                        <input type="hidden" name="annualinterest" value="<?= $data['annualinterest']?>">
                    </td>
                </tr>
                <tr>
                    <td>未使用红包：</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="去支付" style="width:150px;text-align: center;background-color: green">
                        <a href="../invest/index"><input type="button" style="width:150px;text-align: center;background-color: red" value="取消"></a>
                    </td>
                </tr>
            </table>
            </center>
            </form>
    </div>

@include('Home.layouts.foot')
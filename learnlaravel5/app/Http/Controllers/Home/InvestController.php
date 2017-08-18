<?php
namespace App\Http\Controllers\Home;
use DB;
use App\Http\Controllers\Controller;
//use App\Http\Model\Home\invest;
use Illuminate\Support\Facades\Input;

use App\Productclass;
use App\Productinfo;
use App\Userinfo;
use App\RedBag;
//首页
class InvestController extends Controller{

    //我要投资首页展示
    public function index()
    {
        $model = new Productclass();
        $Productinfo = new Productinfo();
        $data = $model->Show();
        $info = $Productinfo->Show();
        return view('Home/invest/index',['data' => $data,'info'=>$info]);
    }
    //投资分类下项目的展示
    public function typeShow()
    {
        $id = input::get('id');
        $Productinfo = new Productinfo();
        $data = $Productinfo->whereShow($id);
        $info =  ajaxJsonencode($data);

        return $info;
    }

    //项目详情
    public function infor()
    {
        $id = input::get('id');
        $user_id = session('user_id');
//        $user_id = 1;
//        p($name);die;
        //项目详情表
        $Productinfo = new Productinfo();
        //用户详情表
        $userinfo = new Userinfo();
        //项目详情数组
        $data = $Productinfo->oneShow($id);
        //用户详情数组
        $userdata = $userinfo->oneShow($user_id);
        //处理数组
        $info =  ajaxJsonencode($data);
        //处理数组
        $info2 =  ajaxJsonencode($userdata);
        $sj = diffBetweenTwoDays($info['entime'],date('Y-m-d'));
//        $jssj = diffBetweenTwoDays(date("Y-m-d",strtotime("+3 month",time())));
        if($info['contact'] == 1){

            if(date('Y-m-d') == $info['entime']){
                //计算出距离这个投资项目结束时长还有多少天
                $jssj = diffBetweenTwoDays(date('Y-m-d'),date("Y-m-d",strtotime("+".$info['deadline']." month",strtotime("".$info['entime'].""))));
                //计算出用户已经收益多钱
                $info['start'] = 1;
                p($jssj);die;
            }else{
                $info['jx'] = "已完成";
                $info['start'] = 0;
//                p($info);die;
            }

        }else{
                $info = $info;
        }

        return view('Home/invest/infor',['data'=>$info,'userdata'=>$info2,'ensj'=>$sj]);

    }
  // 校验身份证号码 邮箱是否绑定
    public function jiaoyan()
    {
        $user_id = input::get('user_id');
        $userinfo = new Userinfo();
        $userdata = $userinfo->oneShow($user_id);
        $data = ajaxJsonencode($userdata);
        if(empty($data['idcard']) || empty($data['email'])){
                return 0;
        }else{
                return 1;
        }
//        p($data);
    }


    public function order()
    {
        //用户ID
        $user_id = input::get('user_id');
        //项目ID
        $id = input::get('id');
        //投资金额
        $orderAmount = input::get('orderAmount');
        //用户MODEL
        $userinfo = new Userinfo();
        //用户详情
        $userdata = ajaxJsonencode($userinfo->oneShow($user_id));
        //判断身份证 邮箱是否为空
        if(empty($userdata['idcard']) || empty($userdata['email'])){
            return view('Home/invest/orderr');
        }else{
            $Productinfo = new Productinfo();
            $RedBag = new RedBag();
            //项目详情数组
            $data = ajaxJsonencode($Productinfo->oneShow($id));
            //查找未使用的红包
            $rebData = ajaxJsonencode($RedBag->showData());
            $info = array(
                 'user_id'          =>$userdata['id'],
                 'order_money'     =>$orderAmount,
                 'rate'             =>$data['rate'],
                 'deadline'         =>$data['deadline'],
                 'interestEndTime' =>endTime($data['deadline'],$data['entime']),
                 'annualinterest'  =>nianXi($orderAmount,$data['rate']),
                 'productName'      =>$data['productName']
             );
            return view('Home/invest/order',['data'=>$info,'rebData'=>$rebData]);
        }
    }
    //订单添加
    public function addOrder()
    {
        $data = input::get();
        p($data);
    }
}
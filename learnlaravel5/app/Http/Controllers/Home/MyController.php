<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Cache;
use DB;
use Illuminate\Support\Facades\Session;
set_time_limit(0);

use App\Http\Model\Home\RedBag;
use App\Http\Model\Home\My;
use App\Http\Model\Home\Bank;
use App\Http\Model\Home\Common;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Session\CookieSessionHandler;




//首页
class MyController extends Controller{

    public function index()
    {
        return view('Home/my/index');
    }
	//资金记录
    public function capital(){
        return view('Home/my/capital');  
    }   
    //投资记录
    public function invest(){
        return view('Home/my/invest');
    }    
    //回款计划
    public function backplan(){
    	return view('Home/my/backplan');
    }
    public function Arr($arr){
        return json_decode(json_encode($arr),true);
    }
    //开通第三方
    public function openthird(){
//        Cache::put('id',1,60);
//        session('user_id')
//        $user_id=Cache::get('id');
         $user_id = session('user_id');
        $model=new My();
        if($post=Input::get()){
            $post['user_id']=$user_id;
            $res=$model->openthird($post);
            if($res==1){
                echo 1;
            }
        }
        // return view('Home/my/openthird');
    }
    // public function ok(){
    //     return view('Home/my/ok');
    // }
    //渲染第三方
    public function openthird1(){
        $user_id = session('user_id');
        $model=new My();
        $model1=new Bank();
        $data=$model->getuser($user_id);
        // print_r($data);
        $banks=$model1->banks();
        // print_r($banks);
        return view('Home/my/openthird1',['data'=>$data,'banks'=>$banks]);
    }
    //充值
    public function recharge(){
        $model=new My();
        if($post=Input::get()){
            $res=$model->recharge($post);
            if($res==0){
                echo 0;
            }else{
                echo 1;
            }
        }
        // return view('Home/my/recharge');
    }
    //充值1
    public function recharge1(){
        $user_id = session('user_id');
        $model=new My();
        $model1=new Bank();
        $banks=$model1->banks();
        $res=$model->getuser($user_id);
        $res=$this->Arr($res);
        if($res['thirds']==0){
            return view('Home/my/recharge');
        }else{
            $userbankcard=$model1->userbankcard($user_id);
            $userbankcard=$this->Arr($userbankcard);
            foreach($userbankcard as $k=>$v){
                $idcard=substr($v['idcard'],-17,-1);
                $card_num=substr($v['card_num'],-15,-1);
                $zer = str_replace($idcard, "****************", $v['idcard']);
                $zer2 = str_replace($card_num, "****", $v['card_num']);
                $userbankcard[$k]['idcard'] = $zer;
                $userbankcard[$k]['card_num'] = $zer2;
            }
            return view('Home/my/recharge1',['userbankcard'=>$userbankcard,'banks'=>$banks]);
        }
    }
    //提现执行：
    public function withdrawals(){
        if($post=Input::get()){
            print_r($post);
        }
        // return view('Home/my/withdrawals');
    }
    //提现渲染
    public function withdrawals1(){
        Cache::put('id',1,60);
        $user_id=Cache::get('id');
        $model=new My();
        $res=$model->getuser($user_id);
        $res=$this->Arr($res);
        print_r($res);
        if($res['thirds']==0){
            return view('Home/my/recharge');
        }else{
            return view('Home/my/withdrawals1',['res'=>$res]);
        }
    }
    //红包
    public function redbag(){
        $id   = session('user_id');
//        $arr  = $id[0]->id;
        if(empty($id)){
            return redirect('login');
        }
        $key  = Input::get('key');
        $data = RedBag::getRedBag($id,$key);
        return view('Home/my/redbag',['data'=>$data]);
    }
    //兑换历史
    public function exchange()
    {
        $id   = session('user_id');
//        $id   = Cookie::get('user');
//        $arr  = $id[0]->id;
        $code = Input::get('id_code');
        $re   = RedBag::setAdd($id,$code);
        $data = RedBag::getRedLog($id);
        return view('Home/my/exchange', ['data' => $data]);

    }
    //系统信息
    public function system(){
    	return view('Home/my/system');
    }       
    //账户设置
    public function account(){

        $common = new Common();
        $id=session('user_id');

        $persion_info = $common->oneCommon("id",$id);
        $position=strpos($persion_info['email'],"@");
        $num=strlen($persion_info['email']);
        $persion_info['email_m']=substr($persion_info['email'],0,3)."****".substr($persion_info['email'],$position-$num);
        $persion_info['idcard_m']=substr($persion_info['idcard'],0,3)."****".substr($persion_info['idcard'],-4);
        $persion_info['telephone_m']=substr($persion_info['telephone'],0,3)."****".substr($persion_info['telephone'],-4);
        return view('Home/my/account',['persion_info'=>$persion_info]);
    }      
    //新手入门
    public function novice(){
    	return view('Home/my/novice');
    }
    //手机验证
    public function phone(){
        $code=rand(1000,9999);
        $phone=Input::get("phone");
        $AppKey=24375;
        $Sign="9503082079b3022712df67ec72d9fde7";
        $tempid=51106;
        $param=urlencode("usernm=admin&code=$code");
        $url="http://api.k780.com/?app=sms.send&tempid=$tempid&param=$param&phone=$phone&appkey=$AppKey&sign=$Sign&format=json";
        $data=file_get_contents($url);
        if(json_decode($data,true)['success']==1){
            exit(json_encode($code));
        }

    }
    //修改手机号码页面
    public function cell_num(){
        $phone = Input::get('phone');
        return view('Home/my/cell_num',['phone'=>$phone]);
    }
    //修改手机号码
    public function sava_phone(){
        $input=Input::all();;
        $phone_old=$input['phone_old'];
        $phone_new=$input['phone_new'];
        $re_phone_new=$input['re_phone_new'];
        if($phone_new!=$re_phone_new){
            return redirect("my/cell_num?phone=$phone_old");
        }else{
            $common=new Common();
            $data['telephone'] = $phone_new;
            $res=$common->updCommon("telephone",$phone_old,$data);
            if($res){
                return redirect("my/account");
            }else{
                return redirect("my/cell_num?phone=$phone_old");
            }
        }
    }
    //身份证验证表单页面
    public function identity(){
        $id=Input::get("id");
        return view("Home/my/Aut_identity",["id"=>$id]);
    }
    //身份证验证
    public function Aut(){
        $input=Input::all();
        $id=$input['id'];
        $identity=$input["identity"];
        $common=new Common();
        $data['idcard'] = $identity;
        $res=$common->updCommon("id",$id,$data);
        if($res){
            return redirect("my/account");
        }else{
            return redirect("my/identity?id=$id");
        }

    }
    //修改密码
    public function sell_password(){
        $input=Input::all();
        $id=$input["id"];
        $password_old=md5($input["password_old"]);

        $password_new=$input["password_new"];
        $common=new Common();
        $persion_info=$common->oneCommon("id",$id);//获取个人信息

        if($persion_info['password']==$password_old){

            $data['password'] = $password_new;
            $res=$common->updCommon("id",$id,$data);
            if($res){
                echo "<script> alert('修改密码成功');location.href='account'; </script>";;
            }else{
                echo "<script> alert('修改密码失败');location.href='account'; </script>";
            }
        }else{
            echo "<script> alert('请输入正确的原密码');location.href='account'; </script>";
        }
    }
    //修改绑定邮箱
    public function sell_email(){
        $input=Input::all();
        $email= $input['email'];
        $ids=$input['ids'];
        $common=new Common();

        $data['email'] = $email;
        $res=$common->updCommon("id",$ids,$data);
        if($res){
            exit(json_encode(1));
        }else{
            exit(json_encode(0));
        }
    }
    //验证身份号码
    public function idcard(){
        $idcard=Input::get("idcard");
        $id_info=DB::table("userinfo")->where('idcard', $idcard)->get();
        if($id_info!=array()){
            exit(json_encode(2));
        }else{
            $AppKey=26752;
            $Sign="b956a5a33deaa11d0d42644498bf243c";
            $url="http://api.k780.com/?app=idcard.get&idcard=$idcard&appkey=$AppKey&sign=$Sign&format=json";
            $data=file_get_contents($url);
            $res=json_decode($data,true)['success'];
            exit(json_encode($res));
        }
    }



}
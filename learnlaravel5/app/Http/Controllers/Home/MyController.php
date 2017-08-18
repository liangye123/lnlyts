<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;


use App\Http\Model\Home\Common;

use App\Http\Model\Home\My;
use Cache;
//use App\Http\Model\Home\my;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
set_time_limit(0);

use App\Http\Middleware\RedBag;
//use App\Http\Model\Home\my;
//use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Session\CookieSessionHandler;
//use DB;
//use Illuminate\Support\Facades\Request;

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
     //开通第三方
    public function openthird(){
    	return view('Home/my/openthird');
    }
     //开通第三方1
    public function openthird1(){
        Cache::put('id',1,60);
        $user_id=Cache::get('id');
        $model=new My();
        $data=$model->getuser($user_id);
        if($post=Input::get()){
            $post['user_id']=$user_id;
            $res=$model->openthird1($post);
            if($res){
                echo json_encode(1);
            }
        }
        return view('Home/my/openthird1',['data'=>$data]);
    }     
    //充值
    public function recharge(){
    	return view('Home/my/recharge');
    }
     //充值1
    public function recharge1(){
    	return view('Home/my/recharge1');
    }    
    //提现
    public function withdrawals(){
    	return view('Home/my/withdrawals');
    } 
    //提现1
    public function withdrawals1(){
    	return view('Home/my/withdrawals1');
    }       
    //红包
    public function redbag(){
    	return view('Home/my/redbag');
    }      
    //兑换历史
    public function exchange(){
    	return view('Home/my/exchange');
    }       
    //系统信息
    public function system(){
    	return view('Home/my/system');
    }       
    //账户设置
    public function account(){

        $common = new Common();
        $id=2;
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
        $reg="/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/";
        preg_match($reg,$identity,$res);
        if($res==array()){
            echo "<script> alert('身份证格式不正确,请重新输入');location.href='identity?id=".$id."'; </script>";
        }else{
            $common=new Common();
            $find_idcard=$common->selectOne("idcard",$identity);
            if($find_idcard!=array()){
                echo "<script> alert('该身份证已注册');location.href='identity?id=".$id."'; </script>";
            }else{
                $AppKey=26752;
                $Sign="b956a5a33deaa11d0d42644498bf243c";
                $url="http://api.k780.com/?app=idcard.get&idcard=$identity&appkey=$AppKey&sign=$Sign&format=json";
                $datas=file_get_contents($url);
                $idcard_res=json_decode($datas,true)['success'];
                if($idcard_res==1){
                    $data['idcard'] = $identity;
                    $res=$common->updCommon("id",$id,$data);
                    if($res){
                        return redirect("my/account");
                    }else{
                        return redirect("my/identity?id=$id");
                    }
                }else{
                    echo "<script> alert('该身份证不存在');location.href='identity?id=".$id."'; </script>";
                }



            }
        }
    }
    //修改密码
    public function sell_password(){
        $input=Input::all();
        $id=$input["id"];
        $password_old=$input["password_old"];
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

    //开通第三方
    public function open_pay(){
//        $realname=Input::get("realname");
//        $idcard=Input::get("idcard");
//        $paypwd=Input::get("paypwd");
        exit(json_encode(1));
    }
    //绑定邮箱表单
    public function bind_mail(){
      $id=Input::get("id");
      return view("Home/my/bind_mail",["id"=>$id]);
    }
    //绑定邮箱
    public function bind_mail_success(){
        $input=Input::all();
        $id=$input["id"];
        $email=$input["email"];
        $common=new Common();
        $data['email'] = $email;
        $res=$common->updCommon("id",$id,$data);
        if($res){
            return redirect("my/account");
        }

    }
    //绑定邮箱是否唯一
    public function mail_one(){
        $mail=Input::get("mail");
        $common=new Common();
        $arr=$common->selectOne("email",$mail);
        if($arr==array()){
            exit(json_encode(0));
        }else{
            exit(json_encode(1));
        }

    }
    

}
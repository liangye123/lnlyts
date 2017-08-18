<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Http\Model\Home\register;
use Illuminate\Support\Facades\Input;
use DB;
use Redis;
use App\Userinfo;
//注册
class RegisterController extends Controller{
    public function register(){
    	return view('Home.register/register');
    }
    //检测用户名
    public function checkuname()
    {
        $username = Input::get('username');
        $model = new Userinfo();
        $res = $model->checkuhm($username);
        if($res==1){
            echo 1;
        }else{
            echo 2;
        }
    }
    //检测手机号
    public function checkphone()
    {
        $phone = Input::get('tel');
        $model = new Userinfo();
        $res = $model->checksjh($phone);
        if($res==1){
            echo 1;
        }else{
            echo 2;
        }
    }

    //忘记密码
    public function checktel()
    {
        $phone = Input::get('tel');
        $model = new Userinfo();
        $res = $model->dxcode($phone);
       if($res==2){
           echo 2;
       }

    }

    //比对手机验证码
    public function checkcode()
    {
        $model = new Userinfo();
        $res = $model->checkyzm();
       if($res==3){
           echo 3;
       }else if($res==4){
           echo 4;
       }else{
           echo 5;
       }
    }

    public function regadd()
    {
        $data = Input::All();
        $username = $data['userName'];
        $password = $data['password'];
        $phone = $data['phone'];
        $data = array(
            'username'=>$username,
            'password'=>md5($password),
            'telephone'=>$phone
        );
        $model = new Userinfo();
        $res = $model->regrk($data);
        if($res==1){
                return redirect('register1');
            }

    }

    public function register1(){
        return view('Home/register/register1'); 
    }  
}







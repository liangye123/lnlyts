<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Http\Model\Home\login;
use Illuminate\Support\Facades\Input;
use Cache;
use DB;
use App\Http\Model\Home\Userinfo;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
//首页
class LoginController extends Controller{
    public function index()
    {
        return view('Home/login/login');
    }

    public function checkname()
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

    public function checklogin()
    {
        $data = Input::All();
        $username = $data['username'];
        $password = md5($data['password']);
        $model = new Userinfo();
        $res = $model->dlsd($username,$password);
        if($res==1){
            return view('Home/index/index');
        }else{
            echo "密码错误";
        }

    }

    //忘记密码
    public function forget()
    {
            return view('Home/login/forget');
    }
    //修改密码
    public function updatepwd()
    {
        $data = Input::All();
        $pwd = md5($data['password']);
        $repwd = md5($data['repassword']);
        $phone = $data['phone'];
        $model = new Userinfo();
        $res = $model->xgmm($phone,$pwd,$repwd);
        if($res==1){
            return view('Home/login/login');
        }
    }

    public function loginout()
    {
        Session::forget('user_id');
        Session::forget('user_name');
        return view('Home/login/login');
    }
}
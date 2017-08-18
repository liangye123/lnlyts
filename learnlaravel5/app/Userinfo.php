<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 2017/8/16
 * Time: 9:14
 */

namespace App;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use DB;
use Redis;
use Illuminate\Http\Request;
class Userinfo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function oneShow($id)
    {
        $data = DB::table('userinfo')->where("id",$id)->first();
        return $data;
    }
    //检测用户名
    public function checkuhm($username)
    {
        $res = DB::table('userinfo')->where('username',$username)->first();
        if($res){
            return 1;
        }else{
            return 2;
        }
    }

    //检测手机号
    public function checksjh($phone)
    {
        $res = DB::table('userinfo')->where('telephone',$phone)->get();
        if(!empty($res)){
            return  1;
        }else{
            //生成手机验证码
            $code = rand(1000,9999);
            $redis = new Redis();
            $redis->connect('127.0.0.1', 6379);
            $redis->setex($phone,60,$code);
            $code = urlencode("code='$code'");
            $url="http://api.k780.com/?app=sms.send&tempid=51106&param={$code}&phone={$phone}&appkey=24375&sign=9503082079b3022712df67ec72d9fde7&format=json";
            $res = file_get_contents($url);
            if($res){
                return  2;
            }
        }
    }

    //忘记密码手机验证
    public function dxcode($phone)
    {
//        $res = DB::table('userinfo')->where('telephone',$phone)->get();
        //生成手机验证码
        $code = rand(1000,9999);
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis->setex($phone,60,$code);
        $code = urlencode("code='$code'");
        $url="http://api.k780.com/?app=sms.send&tempid=51106&param={$code}&phone={$phone}&appkey=24375&sign=9503082079b3022712df67ec72d9fde7&format=json";
        $res = file_get_contents($url);
        if($res){
            return 2;
        }
    }

    //对比手机验证码
    public function checkyzm()
    {
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $phone = Input::get('tel');
        $code = Input::get('code');
        $val = $redis->get($phone);
        if($code==$val){
            return  3;
        }elseif($val==''){
            return 4;
        }else{
            return 5;
        }
    }

    //注册入库
    public function regrk($data)
    {
        $res = DB::table('userinfo')->insert($data);
        if($res){
            return 1;
        }
    }

    //检测登录
    public function checkdl($username,$password)
    {
        //1用户名密码不正确
        //2用户是否被锁定
        //3验证用户的锁定时间不是当天
        $last_time = time();
        $reg  = DB::table('userinfo')->where('username',$username)->first();

        //判断登陆时间是否是当天
        if(date('Ymd',$reg['last_time']) !=date('Ymd')){

        }




        if($reg){
            $user_id = $reg->id;
            //把用户信息存储到session里
            session(['user_id'=>$user_id]);
            session(['user_name'=>$username]);
            //$name = session('name');
            $arr = array(
                'last_time'=>$last_time
            );
            $res = DB::table('userinfo')->where('username',$username)->update($arr);
            if($res){
                return 1;
            }


        }else{
            return 2;

        }
    }

    //修改密码
    public function xgmm($phone,$pwd,$repwd)
    {
        $info = DB::table('userinfo')->where('telephone',$phone)->first();
        $id = $info->id;
        if($pwd==$repwd){
            $arr = array(
                'password'=>$pwd
            );
            $res = DB::table('userinfo')->where('id',$id)->update($arr);
            if($res){
                return 1;
            }
        }
    }
    //备份登录
    public function dlsd($username,$password)
    {
        $last_time = time();
        $info  = DB::table('userinfo')->where(['username'=>$username,'password'=>$password])->first();
        if($info){
            $user_id = $info->id;
            //把用户信息存储到session里
            session(['user_id'=>$user_id]);
            session(['user_name'=>$username]);
            //$name = session('name');
            $arr = array(
                'last_time'=>$last_time
            );
            $res = DB::table('userinfo')->where('username',$username)->update($arr);
            if($res){
                return 1;
            }


        }else{
            return 2;

        }
    }
}
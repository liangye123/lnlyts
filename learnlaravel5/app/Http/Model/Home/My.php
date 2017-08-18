<?php

namespace App\Http\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;


/**
 * 此model层用来处理用户登录
 */
class My extends Model
{    
    /*
     * 查询用户信息
     */
    public function getuser($user_id)
    {
        return DB::table('userinfo')
        ->select('email', 'telephone','thirds','money')
        ->where('id',$user_id)
        ->first();    	
    }
    /*
     * 开通第三方账户
     */    
    public function openthird($post)
    {
        $status='';
        $user_id=$post['user_id'];
        $paypwd=$post['paypwd'];
        $post['paypwd']=md5($paypwd);
        $post['time']=date("Y-m-d H:i:s",time());
        $start = ajaxJsonencode(DB::table('userinfo')->where('id',$user_id)->first());

            if($start['thirds'] == 0){

                $res1=DB::table('userinfo')->where('id',$user_id)->update(['thirds'=>1]);
            }
            $str='abcdefghijklmnopqrstuvwxyz0123456789';
            $post['third_name']='DY_'.substr(str_shuffle($str).time(),-15,15);
            $res2=DB::table('thirds')->insert([$post]);
            if($res2){
                return 1;
            }else{
                 return 0;
            }
    }  
     /*
     * 充值事务处理：
     */    
    public function recharge($post)
    {
        $thirds_id=$post['thirds_id'];
        $user_id=$post['user_id'];
        $rech_money=$post['rech_money'];
        $paypwd=$post['paypwd'];
        $paypwd=md5($paypwd);
        // $thirds_id=1;
        // $user_id=1;
        // $rech_money=300;
        // $paypwd=md5(111111);
        $status='';
        // 第三方余额
        $money1=DB::table('thirds')->where('id',$thirds_id)->select('money')->first();
        $money1=json_decode(json_encode($money1),true);
        $money1=$money1['money']-$rech_money;
        // return $money1;
        // 用户表余额
        $money2=DB::table('userinfo')->where('id',$user_id)->select('money')->first();
        $money2=json_decode(json_encode($money2),true);
        $money2=$money2['money']+$rech_money;
        // return $money2;
        $time=date("Y-m-d H:i:s",time());
        DB::beginTransaction();  
        try {
            //第三方减
            $rech1 = DB::table('thirds')->where(['id'=>$thirds_id,'paypwd'=>$paypwd])->update(['money' => $money1]);
            //更新用户余额
            $rech2 = DB::table('userinfo')->where('id', $user_id)->update(['money' => $money2]);
            //更新充值提现表
            $rech3 = DB::table('rech')->insert(['id'=>'','user_id'=>$user_id,'rech_money'=>$rech_money,'rech_time'=>$time,'type'=>1]);  
            if($rech1&&$rech2&&$rech3){  
                DB::commit();  
                $status=0;
            }  
        } catch (\Exception $e) {
            DB::rollBack(); 
            $status=1;
             exit($e->getMessage());   
        }
        if($status==0){
            return 0;
        }else{
            return 1;
        }
    }   

    //     public function getuser($user_id)
    // {
    //     return DB::table('userinfo')
    //         ->select('email', 'telephone')
    //         ->where('id',$user_id)
    //         ->first();
    // }
    // public function openthird($post)
    // {
    //     $str='abcdefghijklmnopqrstuvwxyz0123456789';
    //     $post['third_name']='DY_'.substr(str_shuffle($str).time(),-15,15);
    //     return DB::table('thirds')
    //         ->insert([$post]);
    // }
}

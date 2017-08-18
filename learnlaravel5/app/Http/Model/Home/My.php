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
        ->select('email', 'telephone')
        ->where('id',$user_id)
        ->first();    	
    }
    public function openthird($post)
    {
        $str='abcdefghijklmnopqrstuvwxyz0123456789';
        $post['third_name']='DY_'.substr(str_shuffle($str).time(),-15,15);   
        return DB::table('thirds')
        ->insert([$post]);
    }

}
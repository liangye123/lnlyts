<?php

namespace App\Http\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;

/**
 * 此model层用来处理银行卡信息
 */
class Bank extends Model
{    
    /*
     * 查询银行
     */
    public function banks()
    {
        return DB::table('bank')->get();    	
    }
    /*
     * 查询用户绑定的银行卡
     */
    public function userbankcard($user_id)
    {
        return DB::table('thirds')
        ->leftJoin('bank', 'thirds.bank_id', '=', 'bank.bank_id')
        ->where('user_id',$user_id)
        ->get();    	
    }

}
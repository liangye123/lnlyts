<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/8/14
 * Time: 20:16
 */

namespace App\Http\Middleware;

use Illuminate\Routing\Console\MiddlewareMakeCommand;
use Illuminate\Support\Facades\DB;

class RedBag extends MiddlewareMakeCommand
{
    public static function getRedBag($id,$key)
    {
        $data=DB::select("select * from redpacket where user_id = $id and start = '$key'");
        return $data;
    }

    public static function getRedLog($id)
    {
        //$red=DB::table('red_log');
        //$data=$red->where("user_id","$id")->orderBy('add_time','desc')->get();
        $data=DB::select("select * from red_log where user_id = $id order by add_time desc");
        return $data;
    }

    public static function setAdd($id,$code)
    {
        $red = DB::table('redpacket');
        if ($code) {
            $money = $red->where('cdkey', "$code")->first();
            $now=date("Y-m-d",time());
            $time=$money->end_time;
            if($now>$time){
                return false;
            }
            if ($code == $money->cdkey) {
                $re = DB::table('red_log')->insert([
                    'user_id' => $id,
                    'idcode' => $money->cdkey,
                    'money' => $money->money,
                    'add_time' => $now
                ]);
            }
            if ($re) {
                $red->where("user_id", "$id")->update(['start' => 1]);
            }
                return $re;
            } else {
                self::getRedLog($id);
            }
    }

}
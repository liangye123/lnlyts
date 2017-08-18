<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 2017/8/16
 * Time: 14:58
 */

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class RedBag extends Model
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

    public static function showData()
    {
        $data = DB::table('redpacket')->where("start",0)->get();
        return $data;
    }
}
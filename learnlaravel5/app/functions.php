<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/8/15
 * Time: 14:09
 */
// json_encode 返回
     function ajaxJsonencode($data)
     {

         $data = json_encode($data);
         return json_decode($data,true);
     }
//print_r 打印
    function p($data)
    {
         echo "<pre>";
         print_r($data);
    }
 //计算两个时间相差多少天
    function diffBetweenTwoDays ($day1, $day2)
    {
        $second1 = strtotime($day1);
        $second2 = strtotime($day2);

        if ($second1 < $second2) {
            $tmp = $second2;
            $second2 = $second1;
            $second1 = $tmp;
         }
        return ($second1 - $second2) / 86400;
   }
//年息
    function nianXi($money,$reta)
    {
            $re = $reta/1000;
            $mo = $money*$re;
            return $mo;
    }
//结束时间
    function endTime($qixian,$sj)
    {
        return date("Y-m-d",strtotime("+".$qixian." month",strtotime($sj)));
    }



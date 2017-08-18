<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 2017/8/16
 * Time: 14:47
 */

namespace App\Http\Model\Home;

use Illuminate\Database\Eloquent\Model;
use DB;
class Common extends Model
{
    protected $table = 'userinfo';
    public $timestamps = false;
    public function readCommon()//查
    {
        return $this->all()->toArray();
    }
    public function oneCommon($data,$arr)//单条查询
    {
        return $this->where($data,$arr)->first()->toArray();
    }
    public function delCommon($data)//删
    {
        $Common = $this->where($data);
        return $Common->delete();
    }
    public function updCommon($data,$list,$arr)//改
    {
        $Common = $this->where($data,$list);
        return $Common->update($arr);
    }
    public function addCommon($data)//增
    {
        return DB::table('Common')->insert($data);
    }
}
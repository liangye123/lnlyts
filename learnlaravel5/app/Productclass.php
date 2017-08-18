<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Productclass extends Model
{
    /**
     * The attributes that are mass assignable.
     *   项目名称model
     * @var array
     */
    protected $fillable = [
        'name','pwd','age'
    ];
    protected $table='productclass';
    public $timestamps=false;
    //查询
    public function Show()
    {
       $data = DB::table('productclass')->get();
        return $data;
    }


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

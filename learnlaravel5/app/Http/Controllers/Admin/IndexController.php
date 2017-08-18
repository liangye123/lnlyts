<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\index;
use Illuminate\Support\Facades\Input;


//首页
class IndexController extends Controller{
    public function index()
    {
        return view('Admin/index/index');
    }    
    public function welcome()
    {
        return view('Admin/index/welcome');
    }
}
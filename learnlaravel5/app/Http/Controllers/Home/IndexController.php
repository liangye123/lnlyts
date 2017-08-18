<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Http\Model\Home\index;
use Illuminate\Support\Facades\Input;


//首页
class IndexController extends Controller{
    public function index()
    {
        return view('Home/Index/index');
    }
}
<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Http\Model\Home\index;
use Illuminate\Support\Facades\Input;
use Monolog\Handler\HandlerWrapperTest;
use App\Exceptions\Handler;

//首页
class IndexController extends Controller{
    public function index()
    {
        return view('Home/Index/index');
    }
}
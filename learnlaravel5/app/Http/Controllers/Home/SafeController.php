<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Http\Model\Home\safe;
use Illuminate\Support\Facades\Input;

//首页
class SafeController extends Controller{
    public function index()
    {
        return view('Home/safe/index');
    }
}

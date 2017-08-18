<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Http\Model\Home\login;
use Illuminate\Support\Facades\Input;


//首页
class LoginController extends Controller{
    public function index()
    {
        return view('Home/login/login');
    }
}
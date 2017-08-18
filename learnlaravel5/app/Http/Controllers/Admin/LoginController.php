<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\login;
use Illuminate\Support\Facades\Input;


//登录
class LoginController extends Controller{
    public function index()
    {
        return view('Admin/login/index');
    }
}
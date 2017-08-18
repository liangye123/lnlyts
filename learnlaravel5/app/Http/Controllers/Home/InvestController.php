<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Http\Model\Home\invest;
use Illuminate\Support\Facades\Input;


//首页
class InvestController extends Controller{
    public function index()
    {
        return view('Home/invest/index');
    }
    public function infor()
    {
        return view('Home/invest/infor');
    }    
}
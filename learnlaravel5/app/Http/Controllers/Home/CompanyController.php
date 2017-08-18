<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Http\Model\Home\company;
use Illuminate\Support\Facades\Input;


//首页
class CompanyController extends Controller{
    public function index()
    {
        return view('Home/company/index');
    }
    // 网站公告
    public function website(){
        return view('Home/company/website');
    }    
    // 媒体报道
    public function media(){
    	return view('Home/company/media');
    }    
    // 公司简介
    public function introduce(){
    	return view('Home/company/introduce');
    }   
     //管理团队
    public function manage(){
    	return view('Home/company/manage');
    }    
    // 合作伙伴
    public function  partner(){
    	return view('Home/company/partner');
    }    
    // 团队风采
    public function styles(){
    	return view('Home/company/styles');
    }    
    // 法律政策
    public function legalpolicy(){
    	return view('Home/company/legalpolicy');
    }    
    // 法律声明
    public function statement(){
    	return view('Home/company/statement');
    }    
    // 资费说明
    public function postage(){
    	return view('Home/company/postage');
    }   
     // 招贤纳士
    public function personnel(){
    	return view('Home/company/personnel');
    }    
    // 联系我们
    public function contact(){
    	return view('Home/company/contact');
    }
    // 公司公告详细
    public function notice(){
        return view('Home/company/notice');
    }            
}
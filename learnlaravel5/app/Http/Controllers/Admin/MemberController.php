<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\member;
use Illuminate\Support\Facades\Input;


//会员
class MemberController extends Controller{
    public function lists(){
    	return view('Admin/member/lists');
    }
    public function add(){
    	return view('Admin/member/add');  
    }       
    public function del(){
    	return view('Admin/member/del'); 
    }   

}
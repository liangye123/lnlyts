<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\product;
use Illuminate\Support\Facades\Input;


//产品
class ProductController extends Controller{
    // 产品列表
    public function lists(){
    	return view('Admin/product/lists');
    }    
    // 添加产品
    public function add(){
    	return view('Admin/product/add');
    }    
    // 产品分类
    public function category(){
    	return view('Admin/product/category');
    }
    // 产品分类添加
    public function category_add(){
    	return view('Admin/product/category_add'); 
    }


}
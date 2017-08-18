<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
header('content-type:text/html;charset=utf8');
Route::get('/', function () {
    return view('welcome');
});
//前台 首页
Route::any('index', 'Home\IndexController@index');
//前台 登录
Route::any('login', 'Home\LoginController@index');
Route::any('loginout', 'Home\LoginController@loginout');
Route::any('forget', 'Home\LoginController@forget');
Route::any('checklogin', 'Home\LoginController@checklogin');
Route::any('checkname', 'Home\LoginController@checkname');
Route::any('updatepwd', 'Home\LoginController@updatepwd');
//前台 注册

Route::any('register', 'Home\LoginController@index');

Route::any('register', 'Home\RegisterController@register');
          //验证
Route::any('checkphone', 'Home\RegisterController@checkphone');
Route::any('checktel', 'Home\RegisterController@checktel');
Route::any('checkcode', 'Home\RegisterController@checkcode');
Route::any('regadd', 'Home\RegisterController@regadd');
Route::any('checkuname', 'Home\RegisterController@checkuname');
//前台 注册成功
Route::any('register1', 'Home\RegisterController@register1');

//Route:;group(['middleware'=>['web','checkflogin']],function(){
//
//});

//防非法登录中间件
//Route::any('my/index', function (){
//
//    //我的账户 个人中心首页
//
//})->middleware('checkflogin');

Route::any('my/index', 'Home\MyController@index');
	//资金记录
Route::any('my/capital', 'Home\MyController@capital');
	//投资记录
Route::any('my/invest', 'Home\MyController@invest');
    //回款计划
Route::any('my/backplan', 'Home\MyController@backplan');
	//开通第三方
Route::any('my/openthird', 'Home\MyController@openthird');
     //开通第三方1
Route::any('my/openthird1', 'Home\MyController@openthird1');
    //充值
Route::any('my/recharge', 'Home\MyController@recharge');
     //充值1
Route::any('my/recharge1', 'Home\MyController@recharge1');
    //提现
Route::any('my/withdrawals', 'Home\MyController@withdrawals');
    //提现1
Route::any('my/withdrawals1', 'Home\MyController@withdrawals1');
    //红包
Route::any('my/redbag', 'Home\MyController@redbag');
    //兑换历史
Route::any('my/exchange', 'Home\MyController@exchange');
    //系统信息
Route::any('my/system', 'Home\MyController@system');
    //账户设置
Route::any('my/account', 'Home\MyController@account');
    //新手入门
Route::any('my/novice', 'Home\MyController@novice');


//我要投资 首页
Route::any('invest/index', 'Home\InvestController@index');
//我要投资 详情
Route::any('invest/infor', 'Home\InvestController@infor');
//校验
Route::any('invest/jiaoyan', 'Home\InvestController@jiaoyan');
//分类查询
Route::any('invest/typeShow', 'Home\InvestController@typeShow');
//订单展示
Route::any('invest/order', 'Home\InvestController@order');
//添加订单
Route::any('invest/addOrder', 'Home\InvestController@addOrder');



//手机验证
Route::any('my/phone', 'Home\MyController@phone');
//修改手机页面
Route::any('my/cell_num', 'Home\MyController@cell_num');
//修改手机
Route::any('my/sava_phone', 'Home\MyController@sava_phone');
//身份证表单页面
Route::any('my/identity', 'Home\MyController@identity');
//验证身份证号码
Route::any('my/Aut', 'Home\MyController@Aut');
//邮箱修改
Route::any('my/sell_email', 'Home\MyController@sell_email');
//修改密码
Route::any('my/sell_password', 'Home\MyController@sell_password');
//验证身份证号码是否合法
Route::any('my/idcard', 'Home\MyController@idcard');



//安全保障
Route::any('safe/index', 'Home\SafeController@index');

//关于我们 首页
 Route::any('company/index', 'Home\CompanyController@index');
    // 网站公告
 Route::any('company/website', 'Home\CompanyController@website');
    // 媒体报道
 Route::any('company/media', 'Home\CompanyController@media');  
    // 公司简介 
 Route::any('company/introduce', 'Home\CompanyController@introduce');
     //管理团队
 Route::any('company/manage', 'Home\CompanyController@manage');   
    // 合作伙伴
 Route::any('company/partner', 'Home\CompanyController@partner');
    // 团队风采
 Route::any('company/styles', 'Home\CompanyController@styles');
    // 法律政策
 Route::any('company/legalpolicy', 'Home\CompanyController@legalpolicy');
    // 法律声明
 Route::any('company/statement', 'Home\CompanyController@statement');
    // 资费说明
 Route::any('company/postage', 'Home\CompanyController@postage');
     // 招贤纳士
 Route::any('company/personnel', 'Home\CompanyController@personnel'); 
    // 联系我们
 Route::any('company/contact', 'Home\CompanyController@contact');    
    // 公司公告详细
 Route::any('company/notice', 'Home\CompanyController@notice');
//后台  首页
Route::any('admin/index', 'Admin\IndexController@index');

Route::any('admin/welcome', 'Admin\IndexController@welcome');
    //登录
Route::any('admin/login', 'Admin\LoginController@index');
    //会员列表
Route::any('admin/member/lists', 'Admin\MemberController@lists');
    // 会员添加
Route::any('admin/member/add', 'Admin\MemberController@add');
    //会员删除
Route::any('admin/member/del', 'Admin\MemberController@del');
    //产品管理 产品列表
Route::any('admin/product/lists', 'Admin\ProductController@lists');
    //产品管理 添加产品
Route::any('admin/product/add', 'Admin\ProductController@add');
    //产品管理 产品分类
Route::any('admin/product/category','Admin\ProductController@category');
    //产品管理 产品分类添加
Route::any('admin/product/category_add','Admin\ProductController@category_add');
    //管理员  角色
Route::any('admin/rbac/role', 'Admin\RbacController@role');
    //管理员  角色添加
Route::any('admin/rbac/role_add', 'Admin\RbacController@role_add');
    //权限
Route::any('admin/rbac/permission', 'Admin\RbacController@permission');
    // 管理员列表
Route::any('admin/rbac/admin_list', 'Admin\RbacController@admin_list');
    // 管理员添加
Route::any('admin/rbac/admin_add', 'Admin\RbacController@admin_add');



Route::get('cookieset', function()
{
    $foreverCookie = Cookie::forever('forever', 'Success');
    $tempCookie = Cookie::make('temporary', 'My name is fantasy', 5);//参数格式：$name, $value, $minutes
    return Response::make()->withCookie($foreverCookie)->withCookie($tempCookie);
});

Route::get('cookietest', function()
{
    $forever = Cookie::get('forever');
    $temporary = Cookie::get('temporary');
    return View::make('cookietest', array('forever' => $forever, 'temporary' => $temporary, 'variableTest' => 'it works'));
});






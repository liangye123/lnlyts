<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\rbac;
use Illuminate\Support\Facades\Input;


//登录
class RbacController extends Controller{
	    //管理员  角色
    public function role(){
    	return view('Admin/rbac/role');
    }
    //管理员  角色添加
    public function role_add(){
    	return view('Admin/rbac/role_add');
    }
    //权限
    public function permission(){
    	return view('Admin/rbac/permission');
    }
    // 管理员列表
    public function admin_list(){
    	return view('Admin/rbac/admin_list');
    }
    // 管理员添加
    public function admin_add(){
    	return view('Admin/rbac/admin_add');
    }

}
//    // 角色添加
//     public function role_add(){
//         $this->display('Rbac/role_add');
//     }    
//     // 权限管理
//     public function permission(){
//         $User = D("Item"); 
//         $info=$User->user(); 
//         print_r($info);        
//         $this->display('Rbac/permission');
//     }       
//     // 权限添加
//     public function permission_add(){
//         $this->display('Rbac/permission_add');
//     }    
//     // 管理员列表
//     public function lists(){
//         $User = D("Assignment"); 
//         $info=$User->user(); 
//         print_r($info);             
//         $this->display('Rbac/lists');
//     }    
//     // 管理员添加
//     public function admin_add(){
//         $this->display('Rbac/admin_add');
//     }
// } 
// class RbacController extends Controller{
//     public $user;
//     //构造方法实例化cookie
//     public function __construct(){
//         session_start();
//         $this->user=$_SESSION['user_name'];
//     }
//     //user用户管理首页展示
//     function user(){
//         $model=new Rbac();
//         $data=$model->getUser();
//         return view('rbac/user',['data'=>$data]);
//     }
//     //添加用户执行
//     function addUser(){
//         $model=new Rbac();
//         $post=Input::all();
//         $model->addUsers($post);
//         return redirect()->action('Home\RbacController@user');
//     }
//     //删除用户
//     function deluser(){
//         $user_id=Input::get('user_id');
//         $model=new Rbac();
//         $model->delUser($user_id);
//         $model->delUserrole($user_id);
//         return redirect()->action('Home\RbacController@user');
//     }
//     //查出用户下所有角色页面
//     function userrole(){
//         $user_id=Input::get('user_id');
//         //查出所有角色
//         $model=new Rbac();
//         $data=$model->getRole();
//         $data=json_decode(json_encode($data),true);
//         $data=array_column($data,'name');
//         $res=$model->getUserrole($user_id);
//         $res=json_decode(json_encode($res),true);
//         $res=array_column($res,'item_name');
//         return view('rbac/userrole',['data'=>$data,'res'=>$res,'user_id'=>$user_id]);
//     }
//     //执行添加用户下角色页面
//     function douserrole(){

//         $model=new Rbac();
//         $post=Input::all();
//         $user_id=$post['user_id'];
//         $model->delUserrole($user_id);
//         $data=array();
//         foreach($post['item_name'] as $k=>$v){
//             $data[$k]['user_id']=$user_id;
//             $data[$k]['item_name']=$v;
//             $data[$k]['created_at']=time();
//         }
//         $model->addUserrole($data,$user_id);
//         return redirect()->action('Home\RbacController@userrole',['user_id'=>$user_id]);
//     }
//     //角色展示页面
//     function role(){
//         $model=new Rbac();
//         //展示所有角色
//         $data=$model->getRole();
//         $data=json_decode(json_encode($data),true);
//         return view('rbac/role',['data'=>$data]);
//     }
//     //角色分配权限页面
//     function rolepower(){
//         $role=Input::get('role');
//         //查询所有权限
//         $model=new Rbac();
//         //获取控制器名字
//         $ctrl=$model->getPowerctrl();
//         $res=$model->getRolepower($role);
//         $ctrl=json_decode(json_encode($ctrl),true);
//         $res=json_decode(json_encode($res),true);
// //        var_dump($ctrl);
// //        var_dump($res);die;
//         $newRes=array();
//         $new=array();
//         foreach($res as $k=>$v){
//             $vvres=explode('/',$v['child']);
//             $newRes[$vvres[0]][]=$vvres[1];
//             $new[]=$vvres[0];
//         }
//         foreach($ctrl as $k=>$v){
//             $vres=$model->getCtrlpower($v['id']);
//             $vres=json_decode(json_encode($vres),true);
//             if(!empty($vres)){
//                 if(in_array($v['name'],$new)){
//                     foreach($vres as $vrk=>$vrvv){
//                         if($rr=in_array($vrvv['name'],$newRes[$v['name']])){
//                             $vres[$vrk]['checked']='checked';
//                         }
//                     }
//                 }
//                 $data[$v['name']]=$vres;
//             }
//         }

//         //渲染模板
//         return view('rbac/rolepower',['data'=>$data,'res'=>$res,'role'=>$role]);
//     }
//     //执行角色分配权限操作
//     function dorolepower(){
//         $get=Input::get();
//         $role=explode(',',$get['role']);
//         $rolename=$get['rolename'];
//         $newArr=array();
//         foreach($role as $v){
//             $arr=explode('|',$v);
//             $newArr[$arr[0]][]=$arr[1];
//         }
//         $data=array();
//         $i=0;
//         foreach($newArr as $k=>$v){
//             foreach($v as $kk=>$vv){
//                 $data[$i]['parent']=$rolename;
//                 $data[$i]['child']=$k.'/'.$vv;
//                 $i++;
//             }
//         }

//         $model=new Rbac();
//         $model->delRolepower($rolename);
//         $model->addRolepower($data);
//         echo "<script>location.href='"."rolepower?role=$rolename"."'</script>";
//     }
//     //添加角色页面
//     function addrole(){
//         $role=Input::all()['role'];
//         $data['name']=$role;
//         $data['description']='创建了'.$role.'角色';
//         $data['created_at']=time();
//         $data['updated_at']=time();
//         $model=new Rbac();
//         $model->addItem($data,1,'-1');
//         return redirect()->action('Home\RbacController@role');
//     }
//     function delroles(){
//         $role=Input::get('role');
//         $model=new Rbac();
//         $model->delRolepower($role);
//         $model->delrole($role);
//         return redirect()->action('Home\RbacController@role');
//     }
//     //权限管理页面展示
//     function power(){
//         $model=new Rbac();
//         //获取控制器名字
//         $ctrl=$model->getPowerctrl();
//         $ctrl=json_decode(json_encode($ctrl),true);
//         foreach($ctrl as $k=>$v){
//             $data[$v['name']]=json_decode(json_encode($model->getCtrlpower($v['id'])),true);
//         }
//         return view('rbac/power',['ctrl'=>$ctrl,'data'=>$data]);
//     }
//     //添加权限下的控制器，执行添加控制器操作
//     function addCtrl(){
//         $ctrl=Input::all()['ctrl'];
//         $data['name']=$ctrl;
//         $data['description']='创建了'.$ctrl.'控制器';
//         $data['created_at']=time();
//         $data['updated_at']=time();
//         $model=new Rbac();
//         $model->addItem($data,3,0);
//         return redirect()->action('Home\RbacController@power');
//     }
//     //添加权限下   控制器下的权限
//     function addPower(){
//         $ctrl_id=Input::all()['ctrl_id'];
//         if(empty($ctrl_id)){
//             echo "<script>alert('请选择控制器');history.back()</script>";
//         }
//         $power=Input::all()['power'];
//         $data['name']=$power;
//         $data['description']='创建了'.$power.'权限';
//         $data['created_at']=time();
//         $data['updated_at']=time();
//         $model=new Rbac();
//         $model->addItem($data,2,$ctrl_id);
//         return redirect()->action('Home\RbacController@power');
//     }
//     //批量删除权限
//     function delAll(){
//         $id=explode(',',Input::get('id'));
//         $newArr=array();
//         foreach($id as $v){
//             $arr=explode('|',$v);
//             $newArr[$arr[0]][]=$arr[1];
//         }
//         $model=new Rbac();
//         $model->delAll($newArr);
//         return redirect()->action('Home\RbacController@power');
//     }
//     //删除单个权限
//     function delpower(){
//         $id=Input::get('id');
//         $arr=explode('|',$id);

//         $model=new Rbac();
//         $model->delpower($arr);
//         return redirect()->action('Home\RbacController@power');
//     }
//     //删除控制器
//     function delctrl(){
//         $ctrl=Input::get('ctrl');
//         $model=new Rbac();
//         $model->delctrlpower($ctrl);
//         return redirect()->action('Home\RbacController@power');
//     }
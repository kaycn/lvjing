<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {

    public function index(){
    	if($_SESSION['code'] === 0){
            $m = M("user");
            $count      = $m->where("status = 0")->count();
            $Page       = new \Think\Page($count,10);
            $show       = $Page->show();// 分页显示输出
            $list = $m->where("status = 0")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign("list",$list);
            $this->assign('page',$show);// 赋值分页输出
    	$this->display();
    	}
    	else{
    		$this->error("你没有权限");
    	}
    }

    public function recovery(){
            $m = M("user");
            $count      = $m->where("status = 1")->count();
            $Page       = new \Think\Page($count,10);
            $show       = $Page->show();// 分页显示输出
            $list = $m->where("status = 1")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign("list",$list);
            $this->assign('page',$show);// 赋值分页输出
            $this->display();
    }

    public function delete(){
        $id = $_GET['id'];
        $m =M("user");
        $result = $m->where("id = {$id}")->setField('status',1);
        if($result>0){
            $this->success("成功！");
        }else{
            $this->error("失败！");
        }
    }

    public function xianshi(){
        $id = $_GET['id'];
        $m =M("user");
        $result = $m->where("id = {$id}")->setField('status',0);
        if($result>0){
            $this->success("成功！");
        }else{
            $this->error("失败！");
        }
    }

    public function reallydelete(){
        $id = $_GET['id'];
        if(empty($id)){
            $this->error("非法操作");
        }else{
            $m = M("user");
            $result = $m->where("id = {$id}")->delete();
            $this->myRelust($result);
        }
    }
    
    public function newuser(){
    	
    	$this->display();
    }
    
    public function reg(){
        $m=M("user");
        $username = I('post.username');
        $password = I('post.password');
        $name = I('post.truename');
        $passtwo = I('post.repassword');
            $usernameCheck = $m->where("username = '{$username}'")->find();
            if($usernameCheck || $username == '' || $password == '' || $passtwo != $password){
                $this->error("帐户名已经注册或两次密码不一致！");
            }else{
                $data = $m->create();
                $datapost = $_POST;
                 $arr = array_keys($_POST);
			     
			    $code = array("index"=>1,"demoa"=>1);
			    foreach($arr as $vo){       
			        if(preg_match("/code*/",$vo)){
			        	$i = $datapost[$vo];
			        	$code["$i"] = 1;			        	
			        }
			    }

			    $data['code'] = json_encode($code);
                unset($data['repassword']);
                $data['ip']=$_SERVER["REMOTE_ADDR"];
                $data['ctime']=time();
                $data['password']=md5($password);
                $data['lasttime']=time();
                $data['admin']=0;
                $data['status']=0;
                $data['email']='';
                $data['pic']='./Public/Uploads/default.png';
                $result = $m->add($data);
                if($result>0){     
                    $this->success("注册成功，回去登陆");
                }else{
                    $this->error("注册失败，我也不知道为什么");
                }
            }
        
    }
    

}

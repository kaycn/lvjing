<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends BaseController {
    public function index(){
        if($_SESSION['muser']==null || $_SESSION['muser']== ''){
            $this->error("非法操作",U('Index/index'));
        }
        $m=M("user");
        $userid = $_SESSION['mid'];
        $userInfo = $m->where("id={$userid}")->find();
        $this->assign("userInfo",$userInfo);
        $this->check_them(ACTION_NAME);
    }
    
    

    public function reg(){
        $m=M("user");
        $code = I('post.code');
        $username = I('post.username');
        $password = I('post.password');
        $name = I('post.truename');
        $passtwo = I('post.repassword');
        $data = $m->create();
        
        $arr = array_keys($data);
        $i = 0;
        $code = array();
        foreach($arr as $vo){       
        if(preg_match("/code[0-9]*/",$vo)){
        	$code[$i] = $data[$vo];
        	uset($data[$vo]);
        }
        $i++;
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
               
    }


    public function login(){
        $username = I('post.username');
        $password = md5($_POST['password']);
        $m=M("user");
        $result = $m->where("username = '{$username}' AND password = '{$password}' AND status = 0 AND admin = 0")->find();
        if($result>0){
            $_SESSION['muser']=$result['truename'];
            $_SESSION['memail']=$result['email'];
            $_SESSION['mid']=$result['id'];
            $_SESSION['mlasttime']=$result['lasttime'];
            $m->where("id = {$result['id']}")->setField('lasttime',time());
            $_SESSION['mlastip']=$result['ip'];
            $m->where("id = {$result['id']}")->setField('ip',$_SERVER["REMOTE_ADDR"]);
            $this->success("登陆成功！");
        }else{
            $this->error("登陆失败！");
        }
    }

    public function logout(){
        $_SESSION['muser']=null;
        $_SESSION['memail']=null;
        $_SESSION['mid']=null;
        $this->success("退出成功！");
    }


        public function changePass(){
            if($_SESSION['muser']==null || $_SESSION['muser']== ''){
                $this->error("非法操作",U('Index/index'));
            }
            $one = $_POST['passone'];
            $two = $_POST['passtwo'];
            if($one != $two || $one == '' || $two == ''){
                $this->error("对不起，两次密码不一致");
            }else{
                $m=M("user");
                $id = $_SESSION['mid'];
                $pass = md5($one);
                $result = $m->where("id={$id}")->setField('password',$pass);
                if($result>0){
                    $this->success("修改成功!");
                }else{
                    $this->error("修改失败！");
                }
            }
        }


        /*改变头像*/
        public function changePic(){
            if($_SESSION['muser']==null || $_SESSION['muser']== ''){
                $this->error("非法操作",U('Index/index'));
            }
            if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $_POST['data'], $result)){
                $type = $result[2];
                $id = $_SESSION['mid'];
                $new_file = "./Public/Uploads/UserPic/{$id}.{$type}";
                if(!in_array($type,array('jpg', 'gif', 'png', 'jpeg'))){
                    echo '2';exit;
                }else{
                    if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $_POST['data'])))){
                        $m = M('user');
                        $id = $_SESSION['mid'];
                        $result = $m->where("id={$id}")->setField('pic',"./Public/Uploads/UserPic/{$id}.{$type}");
                        echo '1';exit;
                    }else{
                        echo '2';exit;
                    }
                }
            }
    }
        /*判断当前文件是否存在*/
        private function check_them($file){
            $now_them = include "./Application/Home/Conf/config.php";
            $now_them = $now_them['DEFAULT_THEME'];
            $file_name = "./Application/Home/View/{$now_them}/User/{$file}.html";
            if(is_file($file_name)){
                $this->display();
            }else{
                $this->theme('Default')->display();
            }
        }










        }

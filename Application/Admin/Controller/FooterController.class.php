<?php
namespace Admin\Controller;
use Think\Controller;
class FooterController extends CommonController {
    public function index(){     	     
	        $m = M("footer");
	        $one = $m -> where("fid=0")->select();
	        $two = $m -> where("fid!=0") -> select();
	        $this->assign('one',$one);
	        $this->assign('two',$two);
    	    $this->display();
    }

    public function catadd(){
    	$this->display();
    }
    
    public function test($count,$list){
    	 for($i=0;$i<$count;$i++){
   			if($list[$i]['type'] < 1){
   				$list[$i]['type']="图片文章";
   			}
   			else{
   				$list[$i]['type']="普通文章";				
   			}
   		   } 
   		   return $list;
    }

    public function add(){
        $m=M("footer");
        $arr = $m->select();
        $arr = $this->tree($arr);
        $this->assign("arr",$arr);
        $this->display();
    }

    public function doadd(){
        $m = M("footer");
        while (list($key,$val)= each($_POST)){
            if(preg_match('/link/',$key,$str)){
                preg_match('/[0-9]+/',$key,$num);
                $data['link'] = $val;
                $num = $num[0];
                $re = $m ->where("id=$num")->save($data);
                $data = "";
            }
            else{
                $data['name'] = $val;
                $re = $m ->where("id=$key")->save($data);
                $data = "";
                echo 1;
            }

        }
        $this -> success("更改成功" );

    }

    public function delete(){
        $m=M("category");
        $id = $_GET['id'];
        $check = $m->where("fid= {$id}")->find();
        if($check != null){
            $this->error("你小弟还没清理干净呢");
        }else{
            $result = $m->delete($id);
        }
        if($result>0){
            $this->success("删除成功！");
        }else{
            $this->error("删除失败！");
        }
    }


    public function edit(){
        $id = $_GET['id'];
        $m=M("category");
        $arr = $m->where("id = {$id}")->find();
        $this->assign("arr",$arr);
        $arrs = $m->select();
        $arrs = $this->tree($arrs);
        $this->assign("arrs",$arrs);     
         $arr1 = array("图片文章","普通文章");
        $this -> assign('arr1',$arr1);
        $this->display();
    }

    public function doedit(){
        $id = $_GET['id'];
        $m = M("category");
        $result = $m->where("id = {$id}")->save($m->create());
        if($result>0){
            $this->success("修改成功！");
        }else{
            $this->error("修改失败！");
        }
    }














}


<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends CommonController {
    public function index(){     	     
	        $m = M("category");	        
	        $count      = $m->count();
	        $Page       = new \Think\Page($count,10);
	        $show       = $Page->show();	       
            $list = $m->limit($Page->firstRow.','.$Page->listRows)->select();            
            for($i=0;$i<count($list);$i++){
   			if($list[$i]['type'] < 1){
   				$list[$i]['type']="图片文章";
   			}
   			else{
   				$list[$i]['type']="普通文章";				
   			}
   		   } 
   		   
			$list = $this -> tree($list);
            $this->assign("arr",$list);
            $this->assign("page",$show);
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
        $m=M("category");
        $arr = $m->select();
        $arr = $this->tree($arr);
        $this->assign("arr",$arr);
        $arr1 = array("图片文章","普通文章");
        $this -> assign('arr1',$arr1);
        $this->display();
    }

    public function doadd(){
        $m = M("category");
        $result = $m->add($m->create());
        if($result>0){
            $this->success("添加成功！");
        }else{
            $this->error("添加失败！");
        }
    }

    public function di(){
        $this -> success("添加成功" );
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

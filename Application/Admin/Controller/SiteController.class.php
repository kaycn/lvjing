<?php
namespace Admin\Controller;
use Think\Controller;
class SiteController extends CommonController {
    public function index(){
    	$m=M("category");
        $arr = $m->select();
        $arr = $this->tree($arr);
        $this->assign("arr1",$arr);
        $m = M("sites");
        $arr = $m->find(1);
        preg_match_all('/\/Public\/Uploads\/[0-9]+\-[0-9]+\-[0-9].\/[a-z0-9]+\.[a-z]+/',$arr['pic1'],$vpic);
        $vpic = $vpic[0];
        $this -> assign("pic1",$vpic);
        $this->assign("arr",$arr);
        $this->display();
    }
    
    public function mulu(){
    	$m=M("category");
        $arr = $m->select();
        $arr = $this->tree($arr);
        $this->assign("arr1",$arr);
        $m = M("indexmulu");
        $arr = $m->find(1);
        
        $this->assign("arr",$arr);
        $this -> display();
    	
    }

    public function upload_logo(){
        $name = I('post.name');
        $result = $this->common_ajax_upload($name,1);
        $this->ajaxReturn($result);
    }

    public function doedit(){
        $m = M("sites");
        $data = $m->create();
        $data['qq'] = preg_replace('# #', '', $data['qq']);
        $result = $m->where("id = 1")->save($data);
        if($result){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }
    
        public function mdoedit(){
        $m = M("indexmulu");
        $data = $m->create();
        
        $result = $m->where("id = 1")->save($data);
 
        if($result){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }

}

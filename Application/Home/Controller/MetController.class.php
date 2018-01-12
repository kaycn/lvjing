<?php
namespace Home\Controller;
use Think\Controller;
class MetController extends BaseController {
    public function index(){
    		$id = I("get.id")?:2;
            $m1=M("category");
            $re1 = $m1 -> field ("name,fid") -> where("id = $id") -> select();
    	   	$this -> assign('name',$re1[0]['name']);
    	   	$fid = $re1[0]['fid'];	
            $m = M("demoa");          
          	$count = $m -> where("status=0 AND fid=$id") -> count();
          	$page = new \Think\Page($count,5);
          	$re = $m -> field("title,pic1,id") -> where("status=0 AND fid=$id") ->limit($page->firstRow.','.$page->listRows) -> select();
          	$show = $page ->show();
          	$this -> assign("re",$re);
          	$this -> assign("count",$count);
          	$this -> assign("page",$show);
          	$this -> display();
          	
    }


    public function serch(){
        $keywords = I("post.keywords");
        $m=M("article");
        $where['title']  = array("like","%{$keywords}%");
        $arr = $m->where($where)->select();
        $count = $m->where($where)->count();
        $this->assign("count",$count);
        $this->assign("arr",$arr);
        $this->assign("keywords",$keywords);
        $this->display();
    }

    public function yaoqingma(){
        $this->assign("is_active","003");
        $this->display();
    }
}

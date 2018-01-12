<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
            $slides = M("Ksildes");
            $slidesList = $slides->order("id desc")->where("status=1")->select();
            $slidesList = $this -> checkimg($slidesList,4);
            $this->assign("sildesList",$slidesList);
            $m = M("indexmulu");
            $arr = $m->find(1); 
            $this->assign('arr',$arr);
            //获取底栏目信息
            $m = M("demoa");
            $fid2 = $arr['indexfid2'];
            $re2 = $m -> where("fid=$fid2") -> select();
            $count = count($re2);
            if($count>4){
                $count = 4;
            }
            for($i=0;$i<$count;$i++){
                $str=preg_replace("/<(.*?)>/si","",$re2[$i]['content']); //
               $re2[$i]['content'] =  mb_substr($str,0,30,'utf-8');
            }
            $this -> assign("re2",$re2);
            $fid3 = $arr['indexfid3'];
            $re3 = $m -> where("fid=$fid3") -> select();
            $this -> assign("re3",$re3);        
            $this->display();
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

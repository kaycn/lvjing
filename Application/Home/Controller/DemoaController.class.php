<?php
namespace Home\Controller;
use Think\Controller;
class DemoaController extends BaseController {
    public function index($id){
        if(!isset($id)) {
            $id = I("get.id") ?: 7;
        }
        $title = $this -> mulu($id);
        $this -> assign("title",$title);
        $m=M("demoa");
        $re = $m -> field('content,pic1,pic2,pic3,pic4,title,type') ->where("status=0 AND id=$id") ->select();
        $re = $re[0];      
        if($re['type']<1){
        $arr = array($re['pic1'],$re['pic2'],$re['pic3'],$re['pic4']);
        $arr1 = array();
        for($i=0;$i<=4;$i++){
        	if($arr[$i]!=""){
        		$arr1[$i] = $arr[$i];
        	}
        }
		$this -> assign('title',$re['title']);
		$this -> assign('content',$re['content']);
		$this -> assign('mag',$arr1);
		$this -> display('index');
		}
		else{	         		         
		         	$this -> assign('re',$re);
		          	$this -> display("yilu");
		}

    }
    
    //获取栏目目录
    
    public function mulu($id = 14){

    	$m = M("demoa");
    	$re = $m -> field("fid,title")->where("id = $id")->select();
    	$arr =array();
    	$ree = $re[0]['fid']; 	
    	$m = M("category");
    	$re1 = $m -> field("fid,name")->where("id=$ree")->select();
    	$arr[0]['name'] = $re1[0]['name'];
    	$arr[0]['id'] = $ree;
    	$i = 1;
    	$a =$re1[0]['fid'];
    	while($re1[0]['fid']!=0){
    		
    		$re1 = $m -> field("fid,name")->where("id=$a")->select(); 
    		$arr[$i]['name'] = $re1[0]['name']; 
    		$arr[$i]['id'] = $a;
    		$a =$re1[0]['fid'];
    		$i++;   		
    	}
    	
    	$i--;
    	$this->assign('navat',$arr[$i]['id']);
    		//var_dump($arr[$i]['id']);    	
    	 //var_dump($arr);
    	 $fid = array_reverse($arr);
    	 $fidid = $fid[0]['id'];
    	 $re =$m -> where("fid=$fidid")->select();
    	 $this ->assign("fid",$re);
    	 $this -> assign('column',$fid);

    }
    
        public function metmulu($id=27){

    	$arr =array();
    	$m = M("category");
    	$re1 = $m -> field("fid,name")->where("id=$id")->select();
    	$arr[0]['name'] = $re1[0]['name'];
    	$arr[0]['id'] = $id;
    	$i = 1;
    	$a =$re1[0]['fid'];
    	while($re1[0]['fid']!=0){
    		
    		$re1 = $m -> field("fid,name")->where("id=$a")->select(); 
    		$arr[$i]['name'] = $re1[0]['name']; 
    		$arr[$i]['id'] = $a;
    		$a =$re1[0]['fid'];
    		$i++;   		
    	}
    	$i =$i-1;
    	$this->assign('navat',$arr[$i]['id']);
    		//var_dump($arr[$i]['id']);    	
    	 //var_dump($arr);
    	 $fid = array_reverse($arr);
    	 $fidid = $fid[0]['id'];
    	 $re =$m -> where("fid=$fidid")->select();
    	 $this ->assign("fid",$re);
    	 $this -> assign('column',$fid);
    	 

    	

    }
    
    public function met(){
    	    $id = I("get.id")?:2;
            $m1=M("category");
            $re1 = $m1 -> field ("name,fid,type") -> where("id = $id") -> select();
    	   	$this -> assign('name',$re1[0]['name']);
    	   	$title = $this -> metmulu($id);
 			//$this->assign('title',$title);
 			//导航栏点亮
// 			while($re1[0]['fid']!=0){
// 				$i = $re1[0]['fid'];
// 				$re1 = $m1->field("fid")->where("id=$i")->select();
// 				$navat = $i;
// 			}
 			//$this -> assign('navat',$navat);
    	   	//判断是否是3级目录
    	   	$fid = $re1[0]['fid'];
    	   	$lu = $m1 -> where("id=$fid") -> count();    	 
    	   	if($re1[0]['type'] < 1){
    	   	$m = M("demoa");          
          	$count = $m -> where("status=0 AND fid=$id") -> count();
          	$page = new \Think\Page($count,9);
          	$re = $m -> field("title,pic1,id,content") -> where("status=0 AND fid=$id") ->limit($page->firstRow.','.$page->listRows) -> select();
          	for($i=0;$i<count($re);$i++){
                $str=preg_replace("/<(.*?)>/si","",$re[$i]['content']); //
                $re[$i]['content'] =  mb_substr($str,0,30,'utf-8');
            }
          	$show = $page ->show();
          	$this -> assign("re",$re);
          	$this -> assign("count",$count);
          	$this -> assign("page",$show);
          	if($count==1){
                $id = $m ->field('id')-> where("status=0 AND fid=$id") -> select();
                $this -> index($id[0]['id']);
            }else{
          	    $this->display();
            }
    	   	}else{
    	   		if($lu==1){ 
		    	   	$m = M("demoa");          
		         	$re = $m -> field("title,content")->where("status=0 AND fid=$id")->select();
		         	if(count($re)==1){		         
		         	$this -> assign('re',$re[0]);
		          	$this -> display("yilu");
		          }
		            else{
		          	$m = M("demoa");  
		         	$re = $m->where("status=0 AND fid=$id")->select();
		         	$this -> assign('re',$re);
		          	$this -> display("lu");
		          }		          
		        }
		        else{
    	   		    $this->error('非法操作');
                }
		          
    	   	}
    	   	
    	   		
    	   	
    	   	//$fid = $re1[0]['fid'];	
    	   
    }
    
    public function mets(){
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

    public function replay(){
        $GtSdk = new \Org\Util\GeetestLib($this->CAPTCHA_ID,$this->PRIVATE_KEY);
        $user_id = $_SESSION['user_id'];
        if ($_SESSION['gtserver'] == 1) {
            $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $user_id);
            if (!$result) {
                $this->error("验证码不正确");
            }
        }else{
            if (!$GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
                $this->error("验证码不正确");
            }
        }
        if($_POST['name'] == '' || $_POST['email'] == '' || $_POST['content'] == ''){
            $this->error("最恨提交空数据");
        }
        $aid = I("get.id");
        $m =M("comment");
        $data = $m->create();
        $data['aid'] = $aid;
        $data['ctime']=time();
        if($_SESSION['muser']!=null || $_SESSION['muser']!= ''){
            $data['uid'] = $_SESSION['mid'];
        }
        $result = $m->add($data);
        if($result>0){
            $mm = M("article");
            if(!$this->email_set['comment_set']){
                $m = M('email_type');
                $info= $m->find(1);
                $article= $mm->find($aid);
                $info['send_comment_content'] = $info['send_comment_content']."<br/>回复帖子标题：<a href = '".$_SERVER['HTTP_REFERER']."' target = '_blank'>{$article['title']}</a><br/>回复署名：{$_POST['name']}<br/>回复内容：{$_POST['content']}";
                $this->MySmtp($this->admin_email,$info['send_comment_title'],$info['send_comment_content']);
            }
            $this->success("回复成功！");
        }else{
            $this->error("回复失败！");
        }
    }

    public function get_replay(){
        $id  = intval(I("post.id"));
        $num = intval(I("post.num"));
        $prefix  = C('DB_PREFIX');
        $m = M("comment");
        $sql=  "SELECT a.*,b.pic FROM {$prefix}comment a left join {$prefix}user b ON a.uid = b.id  where a.status = 0 and a.aid = {$id} and a.replay = 0 limit {$num},10";
        $arr = $m->query($sql);
        if(!empty($arr)){
            $arr = $this->get_son_comment($arr,$m,$prefix);
            $this->ajaxReturn($arr);
        }else{
            echo 5;
            exit;
        }
    }

    public function enarticlepassword(){
        $id = I('get.id');
        $password = I('post.password');
        $_SESSION["article_{$id}"] = $password;
        $this->success('输入成功');
    }

        /**
     * 创建父节点树形数组
     * 参数
     * $ar 数组，邻接列表方式组织的数据
     * $id 数组中作为主键的下标或关联键名
     * $pid 数组中作为父键的下标或关联键名
     * 返回 多维数组
     **/
    protected function find_parent($ar, $id='id', $pid='pid') {
      foreach($ar as $v) $t[$v[$id]] = $v;
      foreach ($t as $k => $item){
        if( $item[$pid] ){
          if( ! isset($t[$item[$pid]]['parent'][$item[$pid]]) )
             $t[$item[$id]]['parent'][$item[$pid]] =& $t[$item[$pid]];
        }
      }
      return $t;
    }

    /*获取子回复*/
    protected function get_son_comment($arr,$m,$prefix,&$newarr){
        foreach ($arr as $key => $value) {
            $newarr[$value['id']] = $arr[$key];
            $sql=  "SELECT a.*,b.pic FROM {$prefix}comment a left join {$prefix}user b ON a.uid = b.id  where a.replay = {$value['id']} and a.status = 0 ORDER BY a.id asc ";
            $check = $m->query($sql);
            if($check){
                foreach ($check as $k => $v) {
                    $newarr[$v['replay']]['son'][] = $v['id'];
                }
                $this->get_son_comment($check,$m,$prefix,$newarr);
            }
        }
        return $newarr;
    }



}

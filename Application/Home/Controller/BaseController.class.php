<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
    protected $email_set;
    protected $admin_email;
    protected $CAPTCHA_ID = "c6a8f518771d8ea164fd92890d5685b7";
    protected $PRIVATE_KEY = "5eff47a446c7f4958cef79f9e16b16c7";
    public function _initialize(){
        $fenlei = M("category");
        $fenleiListone = $fenlei->where("fid = 0")->select();
        $fenleiListtwo = $fenlei->where("fid != 0")->select();
        for($i=0;$i<count($fenleiListone);$i++){
            $id = $fenleiListone[$i]['id'];
            $count = $fenlei ->where("fid=$id") ->count();
            if($count==0){
                $fenleiListone[$i]['one'] = 0;
            }
            else{
                $fenleiListone[$i]['one'] = 1;
            }
        }
        $this ->assign("fenleiListone",$fenleiListone);
        $this->assign("fenleiListtwo",$fenleiListtwo);
        $Site = M("sites");
        $SiteInfo =$Site->find(1);
       $q = preg_match_all('/[^0-9]*[0-9]*/',$SiteInfo['qq'],$qq);
		for($i=0;$i<count($qq[0])-1;$i++){
			preg_match('/[^0-9]*/',$qq[0][$i],$name[$i]['name']);
			preg_match('/[0-9]+/',$qq[0][$i],$name[$i]['num']);
			
		}
        preg_match_all('/\/Public\/Uploads\/[0-9]+\-[0-9]+\-[0-9].\/[a-z0-9]+\.[a-z]+/',$SiteInfo['pic1'],$vpic);
        $vpic = $vpic[0];
        $this -> assign("pic1",$vpic);
        $this->SiteInfo = $SiteInfo;
        $this ->assign("qq",$name);
        $this->assign("SiteInfo",$SiteInfo);
        $m = M("footer");
        $one = $m -> where("fid=0")->select();
        $two = $m -> where("fid!=0") -> select();
        $this->assign('one',$one);
        $this->assign('two',$two);
        $this->assign("imglog",$this->imglog);
               
       
        
       
    }

    /*发送邮件方法*/
    protected function MySmtp($smtpemailto,$mailtitle,$mailcontent){
        $email = new \Org\Util\Smtp();
        $email->smtp($this->email_set['smtpserver'],$this->email_set['smtpserverport'],true,$this->email_set['smtpuser'],$this->email_set['smtppass']);
        $email->debug = false;//是否显示发送的调试信息
        $state = $email->sendmail($smtpemailto,$this->email_set['smtpusermail'], $mailtitle, $mailcontent,"HTML");
    }


    /*极验验证验证码*/
    public function EchoMyVerify(){
        $GtSdk = new \Org\Util\GeetestLib($this->CAPTCHA_ID,$this->PRIVATE_KEY);
        $user_id = "test";
        $status = $GtSdk->pre_process($user_id);
        $_SESSION['gtserver'] = $status;
        $_SESSION['user_id'] = $user_id;
        echo $GtSdk->get_response_str();
    }

    public function CheckMyVerify(){

    }
    
    public function checkimg($re,$num=4){
    	if($re[0]){
    	$re = $re[0];
        $arr = array($re['pic1'],$re['pic2'],$re['pic3'],$re['pic4']);
        $arr1 = array();
        for($i=0;$i<=$num;$i++){
        	if($arr[$i]!=""){
        		$arr1[$i] = $arr[$i];
        	}
        }
        return $arr1;
    	}
    	else{
    		return false;
    	}
    }

}

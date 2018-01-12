<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo ($SiteInfo['title']); ?></title>
			<meta name = "keywords" content="<?php echo ($SiteInfo["keywords"]); ?>" >
		    <meta name = "description" content="<?php echo ($SiteInfo["description"]); ?>" >
			<link rel="stylesheet" href="/Public/css/style.css" />
			<link href="/Public/css/zzsc.css" rel="stylesheet" type="text/css" />
			<link rel="stylesheet" href="/Public/css/footer.css" />
			<script type="text/javascript" src="/Public/js/jquery-1.8.3.js"></script>
			<script type="text/javascript"src="/Public/js/layer.js"></script>
			<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
</head>
	</head>
	<body ontouchstart>

	

		
		<div class="nav">
			<div class="logo" title=""><a href="/Public"><img height="80px" src="<?php echo ($SiteInfo['logo']); ?>"></a></div>
	<ul>
		
<?php if(isset($navat)): ?><li class=""><a href="/">网站首页</a></li>
<?php else: ?>
	<li class="style"><a href="/">网站首页</a></li><?php endif; ?>
	
	<?php if(is_array($fenleiListone)): foreach($fenleiListone as $key=>$vo): if($navat == $vo['id']): ?><li class="style"><a href="<?php echo U('demoa/met',array('id'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a>
			<?php else: ?>
		<li class=""><a href="<?php echo U('demoa/met',array('id'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a><?php endif; ?>
			<div class="nav2">
				 <?php if(is_array($fenleiListtwo)): foreach($fenleiListtwo as $key=>$vs): if($vo["id"] == $vs['fid']): ?><a href="<?php echo U('Demoa/met',array('id'=>$vs['id']));?>"  is_active = "active_<?php echo ($vs["id"]); ?>"><p><?php echo ($vs["name"]); ?></p></a><?php endif; endforeach; endif; ?>

			</div>
		</li><?php endforeach; endif; ?>

			</div>
		</li>
	</ul>
</div>


	<div class="demo2-img"><img src="http://www.sztechand.com/templates/default/images/lianxi.jpg" alt="" width="100%" height="211px"/></div>

		<div class="main fixed">
			<div class="mainLeft">
				<div class="menuBox">
					<div class="menuTit"><b><?php echo ($column[0][name]); ?></b></div>
					<ul class="menu">
							<?php if(is_array($fid)): foreach($fid as $k=>$vo): if($column[1][id] == $vo['id']): ?><li rel="108">
									
							      <a title="<?php echo ($vo["name"]); ?>"id="fid" href="<?php echo U('Demoa/met',array('id'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a>
									   <ul class="subMenu " rel="108">
			   																																							   </ul>
						        </li>
								<?php else: ?>
								<li rel="108">
									
							      <a title="<?php echo ($vo["name"]); ?>" href="<?php echo U('Demoa/met',array('id'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a>
									   <ul class="subMenu " rel="108">
			   																																							   </ul>
						        </li><?php endif; endforeach; endif; ?>
					
                    </ul>
                                            <div class="menuBom"></div>
				</div>
			</div>
			<div class="mainRight">
				<div class="path fixed">
					<div class="pathTit"><b><?php echo ($re['title']); ?></b></div>
					<!--<a href="http://www.sztechand.com/cn/">首页</a>
	» <a href="http://www.sztechand.com/cn/lianxiwomen">联系我们</a>
	» <a href="http://www.sztechand.com/cn/lianxiwomen/zongbudizhi">总部地址</a>
-->
<div class="bread">当前位置：
<a href="/">首页</a>
	<?php if(is_array($column)): foreach($column as $key=>$vo): ?>- <a href="<?php echo U('Demoa/met',array('id'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; ?>
</div>
				</div>
				<div class="content">
					<div class="article">
							<div class="indexNewsCon">
		         <ul class="indexNewsList2">
						<?php if(is_array($re)): foreach($re as $key=>$vo): ?><li><span><?php echo (date( "Y-m-d",$vo["edittime"])); ?></span><a href="<?php echo U('Demoa/index',array('id'=>$vo['id']));?>"><?php echo ($vo['title']); ?></a></li><?php endforeach; endif; ?>
				</ul>
				</div>
							
					</div>
				</div>
			</div>
		</div>
   <div class="footer">
  	<div class="boad foot_top">
  		<div class="footer-1">
  		<div class="footer_more">
  			<img src="/Public/image/logo.png"/>
  			</div>
  		</div>
  	<div class="footer-2">
        <?php if(is_array($one)): foreach($one as $key=>$vo): ?><div class="footer_more">
            <h4 class="title01"><?php echo ($vo["name"]); ?></h4>
            <ul class="link_list">

            <?php if(is_array($two)): foreach($two as $key=>$vs): if($vo["id"] == $vs['fid']): ?><li><i class="ico_online"></i><a href="<?php echo ($vs["link"]); ?>">百度地图</a></li><?php endif; endforeach; endif; ?>

            </ul>
            </div><?php endforeach; endif; ?>
     </div>
     </div>
  </div>
   <div class="footer-b">
     <h3>  <?php echo ($SiteInfo["title"]); ?><img src="/Public/image/beianpng.png">粤公网安备 <?php echo ($SiteInfo["icp"]); ?>号</h3>
   </div>
  <!--<div id="floatright" style="right:70px;"><A href="tencent://message/?uin=2271473677&amp;Site=有事Q我&amp;Menu=yes">   
<img style="border:0px;" src=""></a></div>-->
	<!--<div class="qqserver">
  <div class="qqserver_fold">
    <div></div>
  </div>
  <div class="qqserver-body" style="display: block;">
    <div class="qqserver-header">
      <div></div>
      <span class="qqserver_arrow"></span> </div>
    <ul>
    	<?php if(is_array($qq)): foreach($qq as $key=>$vo): ?><li> <a title="点击这里给我发消息" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo ($vo["num"]["0"]); ?>&amp;site=qq&amp;menu=yes" target="_blank">
        <div>客服咨询</div>
        <span><?php echo ($vo["name"]["0"]); ?></span> </a> </li><?php endforeach; endif; ?>
      
    </ul>
  
  </div>
</div>-->
   <script>
       $(function(){
           var $qqServer = $('.qqserver');
           var $qqserverFold = $('.qqserver_fold');
           var $qqserverUnfold = $('.qqserver_arrow');
           $qqserverFold.click(function(){
               $qqserverFold.hide();
               $qqServer.addClass('unfold');
           });
           $qqserverUnfold.click(function(){
               $qqServer.removeClass('unfold');
               $qqserverFold.show();
           });
           //窗体宽度小鱼1024像素时不显示客服QQ
           $(window).bind("load resize",function(){
               resizeQQserver();
           });
       });
   </script>
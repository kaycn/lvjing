<?php if (!defined('THINK_PATH')) exit();?><!-- 调用头部文件 -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo ($SiteInfo['title']); ?></title>
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=0.3;"></head>
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
	
	<?php if(is_array($fenleiListone)): foreach($fenleiListone as $key=>$vo): if($navat == $vo['id']): if($vo['one'] == 0): ?><li class="style"><a href="<?php echo U('demoa/met',array('id'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a>
			<?php else: ?><li class="style"><a><?php echo ($vo["name"]); ?></a><?php endif; ?>
			<?php else: ?>
			<?php if($vo['one'] == 0): ?><li class=""><a href="<?php echo U('demoa/met',array('id'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a>
			<?php else: ?><li class=""><a><?php echo ($vo["name"]); ?></a><?php endif; endif; ?>
			<div class="nav2">
				 <?php if(is_array($fenleiListtwo)): foreach($fenleiListtwo as $key=>$vs): if($vo["id"] == $vs['fid']): ?><a href="<?php echo U('Demoa/met',array('id'=>$vs['id']));?>"  is_active = "active_<?php echo ($vs["id"]); ?>"><p><?php echo ($vs["name"]); ?></p></a><?php endif; endforeach; endif; ?>

			</div>
		</li><?php endforeach; endif; ?>

			</div>
		</li>
	</ul>
</div>


<!-- 本页导航栏开始 -->
<!-- 本页导航栏结束 -->

<!-- 正文开始 -->
<div class="banner">
			<div class="flash">
				<link rel="stylesheet" href="/Public/css/nivo-slider.css" type="text/css" media="screen" />
				<script type="text/javascript" src="/Public/js/jquery.nivo.slider.pack.js"></script>
				<style type="text/css">.metinfo-banner1 img{ height:720px!important;}</style>
				<div class="slider-wrapper metinfo-banner1" style="height:720px;">
					<div id="slider" class="nivoSlider">
						
						<?php if(is_array($sildesList)): foreach($sildesList as $key=>$vo): ?><img src="<?php echo ($vo); ?>" width='100%' height='720' /><?php endforeach; endif; ?>
					</div>
				</div>

				<script type="text/javascript">
                    $(document).ready(function() {
                        $('#slider').nivoSlider({effect: 'random', pauseTime:5000,directionNav:false});
                    });
				</script>
			</div>
</div>
   <!--
   	作者：offline
   	时间：2017-12-20
   	描述：图片栏
   -->
   <div class="img1">
   <h2 class="next">产品&设备</h2>

     
	<div class="carousel" data-gap="80">
		<figure>
			<?php if(is_array($pic1)): foreach($pic1 as $key=>$vo): ?><img src="<?php echo ($vo); ?>" alt=""><?php endforeach; endif; ?>
		</figure>
		<nav class="pev">
			<button class=""><<</button>
			<button id="nav" class="next1">>></button>
		</nav>
	</div>
   </div>
   <!--
   	作者：offline
   	时间：2017-12-20
   	描述：图片栏 end
   -->
   
   <!--
   	作者：kaycn
   	时间：2017-12-18
   	描述：栏目缩略
   -->
   <!-- 公司简介模块 -->
   <div class="boad gongsi">
            <div class="boad01">
                <h1 class="site-big-title"><span><?php echo ($arr['syname']); ?></span><a class="more" href="<?php echo ($arr['indexfid4']); ?>">更多 >></a></h1>
                <div class="jiesao">
                   <?php echo ($arr['synopsis']); ?>
            	</div>
            </div>
            
               
            <div class="boad02">
                <h1 class="site-big-title"><span>视频简介</span></h1>
                    <button id="vode"><img src="<?php echo ($arr['vpic']); ?>" width="590px" height="200px"/></button>
                
            </div>
              
            
    </div>
    
    <!--
    	作者：offline
    	时间：2017-12-21
    	描述：模块-->
    
    <div class="boad mk">
    <div class="mk-2">
    <h1 class="site-big-title"><span><?php echo ($arr['twoname']); ?></span><a class="more" href="<?php echo U('Demoa/met',array('id'=>$arr['indexfid2']));?>">更多 >></a></h1>
    <div class="indexNewsCon">
		<ul class="indexCaseList">
				<?php if(is_array($re2)): foreach($re2 as $key=>$vo): ?><li class="fixed">
						<div class="img"><a href="<?php echo U('Demoa/index',array('id'=>$vo['id']));?>" title=""><img src="<?php echo ($vo["pic1"]); ?>" alt="" /></a></div>
						<div class="info">
							<h4><a href="<?php echo U('Demoa/index',array('id'=>$vo['id']));?>"><?php echo ($vo["title"]); ?></a></h4>
							<p><p><?php echo ($vo["content"]); ?></p>
						</div>
					</li><?php endforeach; endif; ?>
			</ul>
		</div>
		</div>
		
		<div class="mk-1">
    <h1 class="site-big-title"><span><?php echo ($arr['threename']); ?></span><a class="more" href="<?php echo U('Demoa/met',array('id'=>$arr['indexfid3']));?>">更多 >></a></h1>
    <div class="indexNewsCon">
		<ul class="indexNewsList">
				<?php if(is_array($re3)): foreach($re3 as $key=>$vo): ?><li><span><?php echo (date( "m-d",$vo["edittime"])); ?></span><a href="<?php echo U('Demoa/index',array('id'=>$vo['id']));?>"><?php echo ($vo['title']); ?></a></li><?php endforeach; endif; ?>
			</ul>
		</div>
		</div>
	</div>
    <!--
    	作者：offline
    	时间：2017-12-21
    	描述：end
    -->
   <!--
   	作者：offline
   	时间：2017-12-18
   	描述：end
   -->
  <!--
  	作者：offline
  	时间：2017-12-18
  	描述：
  	<div class="boad">
   	<div class="boad01"></div>
   	<div class="boad02"></div>
   	<div></div>
   </div>
  --> 
<!-- 正文结束 -->
</div>
				  <script>
				;!function(){
				
				
				//页面一打开就执行，放入ready是为了layer所需配件（css、扩展模块）加载完毕
				
				//关于
				$('#vode').on('click', function(){
				  layer.open({
				  type: 2,
				  title: false,
				  area: ['630px', '360px'],
				  shade: 0.8,
				  closeBtn: 0,
				  shadeClose: true,
				  content: '<?php echo ($arr['link']); ?>'
				});
				});
				
				}();
                var a = document.getElementsByTagName('a');
                for(var i = 0; i < a.length; i++)
                {
                    a[i].addEventListener('touchstart',function(){},false);
                }
				</script>
				<script type="text/javascript">
	'use strict';

	window.addEventListener('load', function () {
		var carousels = document.querySelectorAll('.carousel');

		for (var i = 0; i < carousels.length; i++) {
			carousel(carousels[i]);
		}
	});
	
	function carousel(root) {
		var figure = root.querySelector('figure'),
			nav = root.querySelector('nav'),
			images = figure.children,
			n = images.length,
			gap = root.dataset.gap || 0,
			bfc = 'bfc' in root.dataset,
			theta = 2 * Math.PI / n,
			currImage = 0;

		setupCarousel(n, parseFloat(getComputedStyle(images[0]).width));
		window.addEventListener('resize', function () {
			setupCarousel(n, parseFloat(getComputedStyle(images[0]).width));
		});

		setupNavigation();
		
		window.setInterval(function(e=document.getElementById("nav")){ 
		 
				

				var t = e;
				if (t.tagName.toUpperCase() != 'BUTTON') return;

				if (t.classList.contains('next1')) {
					currImage++;
				} else {
					currImage--;
				}

				rotateCarousel(currImage);
			}, 3000); 

		function setupCarousel(n, s) {
			var apothem = s / (2 * Math.tan(Math.PI / n));

			figure.style.transformOrigin = '50% 50%' + -apothem + 'px';

			for (var i = 0; i < n; i++) {
				images[i].style.padding = gap + 'px';
			}for (i = 1; i < n; i++) {
				images[i].style.transformOrigin = '50% 50%' + -apothem + 'px';
				images[i].style.transform = 'rotateY(' + i * theta + 'rad)';
			}
			if (bfc) for (i = 0; i < n; i++) {
				images[i].style.backfaceVisibility = 'hidden';
			}rotateCarousel(currImage);
		}

		function setupNavigation() {
			nav.addEventListener('click', onClick, true);

			function onClick(e) {
				e.stopPropagation();

				var t = e.target;
				if (t.tagName.toUpperCase() != 'BUTTON') return;

				if (t.classList.contains('next')) {
					currImage++;
				} else {
					currImage--;
				}

				rotateCarousel(currImage);
			}
		}

		function rotateCarousel(imageIndex) {
			figure.style.transform = 'rotateY(' + imageIndex * -theta + 'rad)';
		}
	}
</script>
<!-- 调用脚部文件 -->
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
// JavaScript Document

//按需写入所需的函数名
$(function(){

	forms();
	animate();
	casenav(".caseNavWrapper","#caseNav",".hover",300,"cur");
	//gotop();

	// 二维码出现
	$('.weixin').hover(function(){
		$('.erweima').stop(true,true).fadeIn();
	},function(){
		$('.erweima').stop(true,true).fadeOut();
	});
	
	// 导航条
	$('.nav li').hover(function(){
		$(this).find('.sub').stop(true,true).fadeIn();
	},function(){
		$(this).find('.sub').stop(true,true).fadeOut();
	})

	$('.nav li').each(function(){
		var marLeft = $(this).position().left+52;
		if($(this).children().hasClass('sub')){
			$(this).find('i').css('left',marLeft);
		}
	})
	
})

//表单相关
function forms(){

	//输入框文字清空还原，控制value
	// <input type="text" value="请输入关键字" />
	$(".searchBox .text").focus(function(){
		if($(this).val() ==this.defaultValue){  
			$(this).val("");	
		} 
	}).blur(function(){
		if ($(this).val() == '') {
			$(this).val(this.defaultValue);
		}
	});
	
}


//动画相关
function animate(){
	// 滑过图片变淡
	$('.indexCaseList .img').each(function(){
		$(this).hover(function() {
			$(this).find('img').css('opacity',.7);
		}, function() {
			$(this).find('img').css('opacity',1);
		});
		
	});

	$('.monthlyCon img').hover(function(){
		$(this).stop(true, true).animate({"marginTop": "5px"})
	},function(){
		$(this).stop(true, true).animate({"marginTop": 0})
	})

	$('.teamList li').each(function(i){
		setTimeout(function(){
			$('.teamList li').eq(i).addClass('fiu');
		},i*300)
	})

	$('.picList li').each(function(i){
		setTimeout(function(){
			$('.picList li').eq(i).addClass('fiu');
		},i*300)
	})
}

//简单标签切换
function tabs(){
	/*html结构
		<div class="tabs">
		
			<div class="tabhd">
				<ul>
					<li>标题一</li>
					<li>标题二</li>
				</ul>
			</div>
			
			<div class="tabbd">
				<div>内容一</div>
				<div>内容二</div>
			</div>
			
		</div>
	*/
	var $div_li = $(".tabhd ul li");
	$div_li.click(function() {
		$(this).addClass("cur").siblings().removeClass("cur");
		var index = $div_li.index(this);
		$(".tabbd > div").eq(index).fadeIn("linear").siblings().hide();
	})
	
}

function casenav(navwrap,Dom,hover,speed,defClass){
    var $list = $(Dom).children('li'), //查找ul下的li
        listLen = $list.length,  //获取li的个数
        i = 0,
        bool = true,
        arrListInfo = [], //设置一个数组用来存放li的数据
        curIndex = 0;
    for(i=0;i<listLen;i++){
        var othis = $list.eq(i),
            nPosX = othis.position().left; //获取每一个li的left值并存入arrListInfo数组
        arrListInfo.push([nPosX]);
        //添加滑块到最后，并定位到有defClass的li下
        if(othis.hasClass(defClass)&&bool){
            $(Dom).append("<li class=\"hover\" style=\"left:"+nPosX+"\"></li>").find(hover).fadeIn(200);
            bool = false;
            curIndex = i;
        }
    }
    //鼠标经过
    setTimeout(function(){
        $list.bind("mouseover",function(){
            var index = $(this).index();
            fnAnimate(Dom,arrListInfo,index,true);
            return false;
        });
        $(navwrap).bind("mouseleave",function(){
            fnAnimate(Dom,arrListInfo,curIndex,false);
            return false;
        });
    },speed)
    //滑动函数
    function fnAnimate(d,a,x,b){
        $(d).find(hover)
           .stop(true,true)
           .animate({
            "left": a[x][0]
            },speed);
        return false;
    };
    return false;
}

<?php if (!defined('THINK_PATH')) exit();?>﻿
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>小说_免费小说下载_小说在线阅读-免费小说网</title>
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
<meta content="telephone=no" name="format-detection"/>
<script>
    var docEl = document.documentElement;
    var recalc = function(){
        var clientWidth = docEl.clientWidth;
        if (!clientWidth) return;
        if(clientWidth>=541){
            clientWidth = 541;
        }
        docEl.style.fontSize = 20 * clientWidth/360 + 'px';
    };
    recalc();
    resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
    window.addEventListener(resizeEvt, recalc, false);
</script>
<link rel="stylesheet" href="<?php echo (CSS_URL); ?>mobile.css" />
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>app.css" />
</head>
<body _pgid="33">
	
    <div class="head">
        
        <div class="head_logo" style="background: none">
            <img src="<?php echo (IMG_URL); ?>logo.png" style="margin-top: -9px;">
        </div>

        <div class="head_ulnk">
            <a href="/h5/searchrank?fpage=33&fmodule=55" class="but_search"><em></em></a>
        </div>
    </div>

<div class="menu">
	<a href="/h5/index?h5=1" class="active">首页</a>
	<a href="/h5/category/nav?h5=1" >分类</a>
	<a href="/h5/rank/index/?h5=1" >排行</a>
	
	<a href="/h5/shelf?h5=1" >书架</a>
</div>
	<div class="olnk"><script type="text/javascript" src="<?php echo (JS_URL); ?>161208477713.js"></script></div>
	<!-- 最近阅读begin -->
	<div id="footprint_id"></div>
	<!-- 最近阅读end -->
    
    <div class="home-slider">
    	<!-- 首页头条begin -->
    	
        <div id="J_focus" class="slide_banner">
            <div class="slider-top-wrap J_slideWrap" id="sliderTop">
                <ul class="slider-top-pic">
                	
                				<li data-bookId="536501" data-url="/h5/book?bookid=536501&h5=1&fpage=33&fmodule=303&_st=33_303-1_536501">
                        			<img src="<?php echo (IMG_URL); ?>1469363352485.jpg" alt="美女总裁的贴身高手" />
                     			</li>
                			
                				<li data-bookId="490327" data-url="/h5/book?bookid=490327&h5=1&fpage=33&fmodule=303&_st=33_303-2_490327">
                        			<img src="<?php echo (IMG_URL); ?>1469363376148.jpg" alt="极品修真邪少" class="lazy_img"/>
                     			</li>
                			
                				<li data-bookId="472776" data-url="/h5/book?bookid=472776&h5=1&fpage=33&fmodule=303&_st=33_303-3_472776">
                        			<img src="<?php echo (IMG_URL); ?>1469362825808.jpg" alt="超品透视" class="lazy_img"/>
                     			</li>
                			
                				<li data-bookId="117529" data-url="/h5/book?bookid=117529&h5=1&fpage=33&fmodule=303&_st=33_303-4_117529">
                        			<img src="<?php echo (IMG_URL); ?>1469362853649.jpg" alt="仙都" class="lazy_img"/>
                     			</li>
                			
                </ul>
            </div>
            <div class="indicator">
            	<i></i><i></i><i></i><i></i>
            </div>
        </div>
        
        <!-- 首页头条end -->
        
        <div class="flex flex--justify home-fenlei">
            <div class="link-in flex--fluid" ><a  href="/h5/bookfree?fpage=33&fmodule=306" style="display: block;position: relative"><em><img src="<?php echo (IMG_URL); ?>notice.png"></em><span style="color: red">公告:</span><marquee width:60% style="color: red;position: absolute;top: 0" direction="right"  scrollamount="2">更新小说3000本!</marquee></a></div>
            <!--<div class="link-in flex--fluid"><a href="/h5/bookfemale?fpage=33&fmodule=307"><em></em><i>妹子精选</i></a></div>-->
        </div>
    </div>

	<!-- 编辑力荐begin -->
    <div class="home-card home-top">
        <div class="home-card-title">
            <i class="home-icon-tit home-icon-tit-b"></i>
            <i>搜索榜单</i>
        </div>
        <div class="home-card-con">
            <?php if(is_array($recommendBook)): foreach($recommendBook as $key=>$v): ?><div class="home-book-item flex border-b touch-a" data-bookId="<?php echo ($v["book_id"]); ?>" data-url="/h5/book?bookid=533602&h5=1&fpage=33&fmodule=308&_st=33_308-1_533602">
                	<div class="book-img-border"><img src="<?php echo ($v["book_img"]); ?>" alt="超级黄金指" class="img-border"/></div>
                	<div class="book-info-sc flex--fluid">
                    	<h3 class="font-a"><?php echo ($v["book_name"]); ?></h3>
                    	<div class="desc"><?php echo ($v["book_desc"]); ?></div>
                    	<div class="other flex flex--justify">
                        	<i class="author flex--fluid"><em class="author-icon"></em><?php echo ($v["book_author"]); ?></i>
                        	<i class="item-label"><?php echo ($v["book_sign1"]); ?></i>
                        	<i class="item-state"><?php echo ($v["book_sign2"]); ?></i>
                    	</div>
                	</div>
            	</div><?php endforeach; endif; ?>
        	
        </div> 
    </div>
    <!-- 编辑力荐end -->
    
    <!-- 男生必读begin -->
    <div class="home-card home-boy" alt="男生必读">
        <div class="home-card-title title-mb flex">
            <i class="home-icon-tit home-icon-tit-b"></i>
            <i class="flex--fluid">男生必读</i>
        </div>
        <div class="home-card-con flex">
            <?php $__FOR_START_18370__=0;$__FOR_END_18370__=3;for($i=$__FOR_START_18370__;$i < $__FOR_END_18370__;$i+=1){ ?><div class="flex-fluid home-book-box home-book-box-sc touch" data-bookId="<?php echo ($boyLikeReadBook[$i]['book_id']); ?>" data-url="/h5/book?bookid=195916&h5=1&fpage=33&fmodule=309&_st=33_309-1_195916">
                	<img src="<?php echo (IMG_URL); ?>dcbw.jpg"  data-src="<?php echo ($boyLikeReadBook[$i]['book_img']); ?>" alt="<?php echo ($boyLikeReadBook[$i]['book_name']); ?>" class="img-border"/>
                	<i class="book-name"><?php echo ($boyLikeReadBook[$i]['book_name']); ?></i>
            	</div><?php } ?>
        </div>
        <div class="home-card-con flex">
            <?php $__FOR_START_22995__=3;$__FOR_END_22995__=6;for($i=$__FOR_START_22995__;$i < $__FOR_END_22995__;$i+=1){ ?><div class="flex-fluid home-book-box home-book-box-sc touch" data-bookId="<?php echo ($boyLikeReadBook[$i]['book_id']); ?>" data-url="/h5/book?bookid=535242&h5=1&fpage=33&fmodule=309&_st=33_309-1_535242">
                	<img src="<?php echo (IMG_URL); ?>dcbw.jpg" data-src="<?php echo ($boyLikeReadBook[$i]['book_img']); ?>" alt="<?php echo ($boyLikeReadBook[$i]['book_name']); ?>" class="img-border"/>
                	<i class="book-name"><?php echo ($boyLikeReadBook[$i]['book_name']); ?></i>
            	</div><?php } ?>
        	
        </div>
    </div>
    <!-- 男生必读end -->

	<!-- 女生爱看begin -->
    <div class="home-card home-girl">
        <div class="home-card-title title-mb flex">
            <i class="home-icon-tit home-icon-tit-b"></i>
            <i class="flex--fluid">女生爱看</i>
        </div>
        <div class="home-card-con flex">
            <?php $__FOR_START_14608__=0;$__FOR_END_14608__=3;for($i=$__FOR_START_14608__;$i < $__FOR_END_14608__;$i+=1){ ?><div class="flex-fluid home-book-box home-book-box-sc touch" data-bookId="<?php echo ($girlLikeReadBook[$i]['book_id']); ?>" data-url="/h5/book?bookid=486228&h5=1&fpage=33&fmodule=310&_st=33_310-1_486228">
                	<img src="<?php echo (IMG_URL); ?>dcbw.jpg"  data-src="<?php echo ($girlLikeReadBook[$i]['book_img']); ?>" alt="<?php echo ($girlLikeReadBook[$i]['book_name']); ?>" class="img-border"/>
                	<i class="book-name"><?php echo ($girlLikeReadBook[$i]['book_name']); ?></i>
            	</div><?php } ?>

        	
        </div>
        <div class="home-card-con flex">
            <?php $__FOR_START_23561__=3;$__FOR_END_23561__=6;for($i=$__FOR_START_23561__;$i < $__FOR_END_23561__;$i+=1){ ?><div class="flex-fluid home-book-box home-book-box-sc touch" data-bookId="<?php echo ($girlLikeReadBook[$i]['book_id']); ?>" data-url="/h5/book?bookid=495607&h5=1&fpage=33&fmodule=310&_st=33_310-1_495607">
                	<img src="<?php echo (IMG_URL); ?>dcbw.jpg"  data-src="<?php echo ($girlLikeReadBook[$i]['book_img']); ?>" alt="<?php echo ($girlLikeReadBook[$i]['book_name']); ?>" class="img-border"/>
                	<i class="book-name"><?php echo ($girlLikeReadBook[$i]['book_name']); ?></i>
            	</div><?php } ?>
        	
        </div>
    </div>
    <!-- 女生爱看end -->
    
    <!-- 玄幻仙侠begin -->
    <div class="home-card">
        <div class="home-card-title flex">
            <i class="home-icon-tit home-icon-tit-a"></i>
            <i class="flex--fluid">玄幻仙侠</i>
        </div>
        
        			<div class="home-book-item flex border-b touch" data-bookId="513438" data-url="/h5/book?bookid=513438&h5=1&fpage=33&fmodule=311&_st=33_311-1_513438">
                		<div class="book-img-border"><img src="<?php echo (IMG_URL); ?>dcbw.jpg" data-src="http://static.zongheng.com/upload/s_image/cover/2016/07/1468835876117.jpg" alt="九界仙尊" class="img-border"/></div>
                		<div class="book-info-sc flex--fluid">
                    		<h3 class="font-a">九界仙尊</h3>
                    		<div class="desc">千年前遭人陷害，魂魄被封。千年后重生苏醒，红颜已逝，而当年被踏在脚下的敌人，却成了名动一方的仙王……</div>
                    		<div class="other flex flex--justify">
                        		<i class="author flex--fluid"><em class="author-icon"></em>神出古异</i>
                        		<i class="item-label">奇幻修真</i>
                        		<i class="item-state">连载</i>
                    		</div>
            			</div>
        			</div>
        		
        			<a class="home-row-line flex touch-a border-b" data-bookId="524602" href="/h5/book?bookid=524602&h5=1&fpage=33&fmodule=311&_st=33_311-2_524602">
            			<span class="flex--fluid">[东方玄幻]太古战神:擒真龙灭万族</span>
            			<i class="home-icon-arrow home-row-link"></i>
        			</a>
        		
        			<a class="home-row-line flex touch-a border-b" data-bookId="457529" href="/h5/book?bookid=457529&h5=1&fpage=33&fmodule=311&_st=33_311-3_457529">
            			<span class="flex--fluid">[东方玄幻]御天神帝:踏九霄御神魔</span>
            			<i class="home-icon-arrow home-row-link"></i>
        			</a>
        		
        			<a class="home-row-line flex touch-a border-b" data-bookId="571532" href="/h5/book?bookid=571532&h5=1&fpage=33&fmodule=311&_st=33_311-4_571532">
            			<span class="flex--fluid">[东方玄幻]龙武战神:浴血杀神之路</span>
            			<i class="home-icon-arrow home-row-link"></i>
        			</a>
        		
        			<a class="home-row-line flex touch-a border-b" data-bookId="535429" href="/h5/book?bookid=535429&h5=1&fpage=33&fmodule=311&_st=33_311-5_535429">
            			<span class="flex--fluid">[东方玄幻]弑神战帝:逆天修武改命</span>
            			<i class="home-icon-arrow home-row-link"></i>
        			</a>
        		
    </div>
    <!-- 玄幻仙侠end -->
    
    <!-- 都市娱乐begin -->
    <div class="home-card" alt="都市娱乐">
        <div class="home-card-title flex">
            <i class="home-icon-tit home-icon-tit-a"></i>
            <i class="flex--fluid">都市娱乐</i>
        </div>
        
        			<div class="home-book-item flex border-b touch" data-bookId="385426" data-url="/h5/book?bookid=385426&h5=1&fpage=33&fmodule=312&_st=33_312-1_385426">
                		<div class="book-img-border"><img src="<?php echo (IMG_URL); ?>dcbw.jpg" data-src="http://static.zongheng.com/upload/s_image/cover/2016/01/1452754293923.jpg" alt="权道同谋" class="img-border"/></div>
                		<div class="book-info-sc flex--fluid">
                    		<h3 class="font-a">权道同谋</h3>
                    		<div class="desc">中国的《纸牌屋》（HOUSE　OF　CARDS）,最好的都市职场小说。</div>
                    		<div class="other flex flex--justify">
                        		<i class="author flex--fluid"><em class="author-icon"></em>广渠门内</i>
                        		<i class="item-label">职场商战</i>
                        		<i class="item-state">连载</i>
                    		</div>
            			</div>
        			</div>
        		
        			<a class="home-row-line flex touch-a border-b" data-bookId="408035" href="/h5/book?bookid=408035&h5=1&fpage=33&fmodule=312&_st=33_312-2_408035">
            			<span class="flex--fluid">[都市异能]绝品狂医:传承龙族医术</span>
            			<i class="home-icon-arrow home-row-link"></i>
        			</a>
        		
        			<a class="home-row-line flex touch-a border-b" data-bookId="561541" href="/h5/book?bookid=561541&h5=1&fpage=33&fmodule=312&_st=33_312-3_561541">
            			<span class="flex--fluid">[都市生活]纯情巨星:重生玩转跑男</span>
            			<i class="home-icon-arrow home-row-link"></i>
        			</a>
        		
        			<a class="home-row-line flex touch-a border-b" data-bookId="538676" href="/h5/book?bookid=538676&h5=1&fpage=33&fmodule=312&_st=33_312-4_538676">
            			<span class="flex--fluid">[都市生活]邪气兵王:叱咤天下兵神</span>
            			<i class="home-icon-arrow home-row-link"></i>
        			</a>
        		
        			<a class="home-row-line flex touch-a border-b" data-bookId="494196" href="/h5/book?bookid=494196&h5=1&fpage=33&fmodule=312&_st=33_312-5_494196">
            			<span class="flex--fluid">[都市异能]天才邪少:高手醒来袭胸</span>
            			<i class="home-icon-arrow home-row-link"></i>
        			</a>
        		
    </div>
    <!-- 都市娱乐end -->
    
    <!-- 科幻历史begin -->
    <div class="home-card" alt="科幻历史">
        <div class="home-card-title flex">
            <i class="home-icon-tit home-icon-tit-a"></i>
            <i class="flex--fluid">科幻历史</i>
        </div>
        
        			<div class="home-book-item flex border-b touch" data-bookId="461547" data-url="/h5/book?bookid=461547&h5=1&fpage=33&fmodule=313&_st=33_313-1_461547">
                		<div class="book-img-border"><img src="<?php echo (IMG_URL); ?>dcbw.jpg" data-src="http://static.zongheng.com/upload/s_image/cover/2015/04/1429075137270.jpg" alt="超能纪元" class="img-border"/></div>
                		<div class="book-info-sc flex--fluid">
                    		<h3 class="font-a">超能纪元</h3>
                    		<div class="desc">凝结基因符文，走出一条独一无二的超能进化线路</div>
                    		<div class="other flex flex--justify">
                        		<i class="author flex--fluid"><em class="author-icon"></em>黄金沙加</i>
                        		<i class="item-label">科技时代</i>
                        		<i class="item-state">连载</i>
                    		</div>
            			</div>
        			</div>
        		
        			<a class="home-row-line flex touch-a border-b" data-bookId="413680" href="/h5/book?bookid=413680&h5=1&fpage=33&fmodule=313&_st=33_313-2_413680">
            			<span class="flex--fluid">[虚拟网游]网游之野望:体能大进化</span>
            			<i class="home-icon-arrow home-row-link"></i>
        			</a>
        		
        			<a class="home-row-line flex touch-a border-b" data-bookId="462683" href="/h5/book?bookid=462683&h5=1&fpage=33&fmodule=313&_st=33_313-3_462683">
            			<span class="flex--fluid">[穿梭时空]神级猎杀者:杀光穿越党</span>
            			<i class="home-icon-arrow home-row-link"></i>
        			</a>
        		
        			<a class="home-row-line flex touch-a border-b" data-bookId="545403" href="/h5/book?bookid=545403&h5=1&fpage=33&fmodule=313&_st=33_313-4_545403">
            			<span class="flex--fluid">[穿越历史]三国之小虫成神:抢貂蝉</span>
            			<i class="home-icon-arrow home-row-link"></i>
        			</a>
        		
        			<a class="home-row-line flex touch-a border-b" data-bookId="532791" href="/h5/book?bookid=532791&h5=1&fpage=33&fmodule=313&_st=33_313-5_532791">
            			<span class="flex--fluid">[穿越历史]三国极品枭雄:群雄并起</span>
            			<i class="home-icon-arrow home-row-link"></i>
        			</a>
        		
    </div>
    <!-- 科幻历史end -->
    
    <!-- 热门分类begin -->
    <div class="home-card" alt="热门作品">
        <div class="home-card-title flex">
            <i class="home-icon-tit home-icon-tit-a"></i>
            <i class="flex--fluid">热门作品</i>
        </div>
        
        			<div class="home-book-item flex border-b touch" data-bookId="239426" data-url="/h5/book?bookid=239426&h5=1&fpage=33&fmodule=314&_st=33_314-1_239426">
                		<div class="book-img-border"><img src="<?php echo (IMG_URL); ?>dcbw.jpg" data-src="http://static.zongheng.com/upload/s_image/cover/2015/03/1426236643535.jpg" alt="末世之淘汰游戏" class="img-border"/></div>
                		<div class="book-info-sc flex--fluid">
                    		<h3 class="font-a">末世之淘汰游戏</h3>
                    		<div class="desc">觉得这个世界怎么样？无聊。毁灭掉算了，重新创造一个世界吧！</div>
                    		<div class="other flex flex--justify">
                        		<i class="author flex--fluid"><em class="author-icon"></em>穿越时空的眼</i>
                        		<i class="item-label">末世危机</i>
                        		<i class="item-state">连载</i>
                    		</div>
            			</div>
        			</div>
        		
        			<a class="home-row-line flex touch-a border-b" data-bookId="533182" href="/h5/book?bookid=533182&h5=1&fpage=33&fmodule=314&_st=33_314-2_533182">
            			<span class="flex--fluid">[奇幻修真]御天邪神:装最牛的逼</span>
            			<i class="home-icon-arrow home-row-link"></i>
        			</a>
        		
        			<a class="home-row-line flex touch-a border-b" data-bookId="408644" href="/h5/book?bookid=408644&h5=1&fpage=33&fmodule=314&_st=33_314-3_408644">
            			<span class="flex--fluid">[科技时代]通关基地:纵横宇宙星际</span>
            			<i class="home-icon-arrow home-row-link"></i>
        			</a>
        		
        			<a class="home-row-line flex touch-a border-b" data-bookId="388123" href="/h5/book?bookid=388123&h5=1&fpage=33&fmodule=314&_st=33_314-4_388123">
            			<span class="flex--fluid">[都市生活]超强兵王:雇佣兵的王者</span>
            			<i class="home-icon-arrow home-row-link"></i>
        			</a>
        		
        			<a class="home-row-line flex touch-a border-b" data-bookId="508146" href="/h5/book?bookid=508146&h5=1&fpage=33&fmodule=314&_st=33_314-5_508146">
            			<span class="flex--fluid">[末世危机]黑暗时代:争夺最后生机</span>
            			<i class="home-icon-arrow home-row-link"></i>
        			</a>
        		
    </div>
    <!-- 热门分类end -->
    
    <!-- 完本经典begin -->
    <div class="home-card" alt="完本经典">
        <div class="home-card-title title-mb flex">
            <i class="home-icon-tit home-icon-tit-b "></i>
            <i class="flex--fluid">完本经典</i>
        </div>
        <div class="home-card-con flex">
        	
        		<div class="flex-fluid home-book-box home-book-box-sc touch" data-bookId="206385" data-url="/h5/book?bookid=206385&h5=1&fpage=33&fmodule=315&_st=33_315-1_206385">
                	<img src="<?php echo (IMG_URL); ?>dcbw.jpg" data-src="http://static.zongheng.com/upload/s_image/cover/2013/06/1372424588934.jpg" alt="西凉铁骑" class="img-border"/>
                	<i class="book-name">西凉铁骑</i>
            	</div>
        	
        		<div class="flex-fluid home-book-box home-book-box-sc touch" data-bookId="533345" data-url="/h5/book?bookid=533345&h5=1&fpage=33&fmodule=315&_st=33_315-2_533345">
                	<img src="<?php echo (IMG_URL); ?>dcbw.jpg" data-src="http://static.zongheng.com/upload/s_image/cover/2016/07/1468836123197.jpg" alt="透视神瞳" class="img-border"/>
                	<i class="book-name">透视神瞳</i>
            	</div>
        	
        		<div class="flex-fluid home-book-box home-book-box-sc touch" data-bookId="161630" data-url="/h5/book?bookid=161630&h5=1&fpage=33&fmodule=315&_st=33_315-3_161630">
                	<img src="<?php echo (IMG_URL); ?>dcbw.jpg" data-src="http://static.zongheng.com/upload/s_image/cover/2014/11/1416120815005.jpg" alt="魔兽争霸异界纵横" class="img-border"/>
                	<i class="book-name">魔兽争霸异界纵横</i>
            	</div>
        	
        </div>
    </div>
    <!-- 完本经典end -->
    
    <!-- 新书精选begin -->
    <div class="home-card" alt="新书精选">
        <div class="home-card-title title-mb flex">
            <i class="home-icon-tit home-icon-tit-b"></i>
            <i class="flex--fluid">新书精选</i>
        </div>
        <div class="home-card-con flex">
        	
        		<div class="flex-fluid home-book-box home-book-box-sc touch" data-bookId="564742" data-url="/h5/book?bookid=564742&h5=1&fpage=33&fmodule=316&_st=33_316-1_564742">
                	<img src="<?php echo (IMG_URL); ?>dcbw.jpg"  data-src="http://static.zongheng.com/upload/s_image/cover/2016/04/1461858235076.jpg" alt="超脱万象" class="img-border"/>
                	<i class="book-name">超脱万象</i>
            	</div>
        	
        		<div class="flex-fluid home-book-box home-book-box-sc touch" data-bookId="574471" data-url="/h5/book?bookid=574471&h5=1&fpage=33&fmodule=316&_st=33_316-2_574471">
                	<img src="<?php echo (IMG_URL); ?>dcbw.jpg"  data-src="http://static.zongheng.com/upload/s_image/cover/2016/06/1466143091433.png" alt="星辰争霸" class="img-border"/>
                	<i class="book-name">星辰争霸</i>
            	</div>
        	
        		<div class="flex-fluid home-book-box home-book-box-sc touch" data-bookId="545946" data-url="/h5/book?bookid=545946&h5=1&fpage=33&fmodule=316&_st=33_316-3_545946">
                	<img src="<?php echo (IMG_URL); ?>dcbw.jpg"  data-src="http://static.zongheng.com/upload/s_image/cover/2016/03/1457603813025.jpg" alt="贵女娇妃" class="img-border"/>
                	<i class="book-name">贵女娇妃</i>
            	</div>
        	
        </div>
        <div class="home-card-con flex">
            
        		<div class="flex-fluid home-book-box home-book-box-sc touch" data-bookId="567500" data-url="/h5/book?bookid=567500&h5=1&fpage=33&fmodule=316&_st=33_316-1_567500">
                	<img src="<?php echo (IMG_URL); ?>dcbw.jpg"  data-src="http://static.zongheng.com/upload/s_image/cover/2016/06/1465184287879.jpg" alt="校花的近身狂少" class="img-border"/>
                	<i class="book-name">校花的近身狂少</i>
            	</div>
        	
        		<div class="flex-fluid home-book-box home-book-box-sc touch" data-bookId="569630" data-url="/h5/book?bookid=569630&h5=1&fpage=33&fmodule=316&_st=33_316-2_569630">
                	<img src="<?php echo (IMG_URL); ?>dcbw.jpg"  data-src="http://static.zongheng.com/upload/s_image/cover/2016/06/1466477068916.jpg" alt="人族末路" class="img-border"/>
                	<i class="book-name">人族末路</i>
            	</div>
        	
        		<div class="flex-fluid home-book-box home-book-box-sc touch" data-bookId="558602" data-url="/h5/book?bookid=558602&h5=1&fpage=33&fmodule=316&_st=33_316-3_558602">
                	<img src="<?php echo (IMG_URL); ?>dcbw.jpg"  data-src="http://static.zongheng.com/upload/s_image/cover/2016/05/1462246716858.jpg" alt="甜蜜辣妻：亿万总裁太温柔" class="img-border"/>
                	<i class="book-name">甜蜜辣妻：亿万总裁太温柔</i>
            	</div>
        	
        </div>
    </div>
    <!-- 新书精选end -->
    
    
    
    <!-- 网站公告begin -->
    <div class="home-card" alt="网站公告">
        <div class="home-card-title home-gonggao flex">
            <i class="home-icon-tit home-icon-gonggao"></i>
            <i class="flex--fluid">网站公告</i>
        </div>
        
                     		<a class="home-row-line flex touch-a border-b" href="http://news.zongheng.com/subject/nc/124.html?page=33&fmodule=317&_st=33_317-1">
           						<span class="flex--fluid">7月月票榜新星梁不凡《超品战兵》</span>
            					<i class="home-icon-arrow home-row-link"></i>
        					</a>
                		
                     		<a class="home-row-line flex touch-a border-b" href="http://news.zongheng.com/subject/nc/120.html?page=33&fmodule=317&_st=33_317-2">
           						<span class="flex--fluid">6月月票榜新星三观犹在《在中原行镖的日子》</span>
            					<i class="home-icon-arrow home-row-link"></i>
        					</a>
                		
                     		<a class="home-row-line flex touch-a border-b" href="http://news.zongheng.com/subject/nc/122.html?page=33&fmodule=317&_st=33_317-3">
           						<span class="flex--fluid">6月月票榜冠军更俗《踏天无痕》</span>
            					<i class="home-icon-arrow home-row-link"></i>
        					</a>
                		
    </div>
    <!-- 网站公告end -->
    
<script type="text/javascript" src="<?php echo (JS_URL); ?>zepto.min.js"></script>
<script src="<?php echo (JS_URL); ?>swipe.js"></script>

<footer>
	<!-- 登录之前 -->
    <div class="fl" id="sp_unlogin">
    	<a href="http://passport.zongheng.com/wap/user/login.do?fpage=33&fmodule=52" >登录</a> | 
    	<a href="http://passport.zongheng.com/bdpass/wapRegister.do" >注册</a>
    </div>
    <!-- 登录之后 -->
    <div id="sp_nickname" class="fl" style="display: none">
    	<a href="/h5/home"><span></span></a> | 
	    <a href="/h5/user/logout?fpage=33&fmodule=53">退出</a>
    </div>
	<div class="fr">
		<a href="/h5/help?fpage=33&fmodule=54">我要吐槽</a>
	</div>
	<div class="cl0"></div>
	
	

<form action="/h5/search" method="GET">
	<div class="searchbox">
		<div>
			<input placeholder="请输入关键字" value="" maxlength="15" name="keywords">
		</div>
		<div class="search_go"></div>
	</div>
	<input type="hidden" name="field" id="field" value="all"/>
</form>

	
	<div>
		<a href="/adapter?tag=wap">极速版</a> | <a class="active">触屏版</a> | <a href="/adapter?tag=pc">电脑版</a> | <a href="http://news.zongheng.com/zhuanti/2015/appdl/index.html" >客户端</a>
	</div>
	<span class="copyright">©版权归百度文学旗下纵横中文网所有</span>
</footer>




<script>
$(function(){
    var mfocus = document.querySelector("#J_focus");
    slide(mfocus).stop();
        setTimeout(function() {
            window.GfocusSlide.start();
        }, 0)
    function slide(elem) {
        var wrap = elem.querySelector("div.J_slideWrap"),
        nav = elem.querySelector("div.indicator");
        GfocusSlide = swipe(wrap, {
            auto: 5000,
            speed: 500,
            continuous: true,
            nav: nav
        });
        return GfocusSlide
    }

    //焦点图
    
    if(window.devicePixelRatio && window.devicePixelRatio >=2){ //判断是否为Retina屏
        document.querySelector("body").className = "hairlines"
    } 
    imgload($(".img-border"));
    bindTouch(".touch,.touch-a","hover")
    
    $(".gamebox a").click(function(e){
        e.stopPropagation();
        var index = $(this).closest(".gamebox").attr("index");
        postStat("download", "首页游戏下载","indexGameDownload"+index);
    });
    
    $(".gamebox").click(function(){
        var index = $(this).attr("index");
        postStat("gamelink", "首页游戏链接","indexGamelink"+index);
        var _this = $(this);
        setTimeout(function() {
            window.location.href = _this.attr("gameUrl");
        }, 500);
    });

    $("#game a").click(function(){
        postStat("moreGame", "首页更多游戏","indexMoreGame");
        var _this = $(this);
        setTimeout(function() {
            window.location.href = _this.attr("url");
        }, 500);
    });
    
    $(".slider-top-pic li,.home-book-item,.home-book-box").click(function(){
        goBook(this);
    });
})
</script>
</body>
</html>
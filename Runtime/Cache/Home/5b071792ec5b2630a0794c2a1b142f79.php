<?php if (!defined('THINK_PATH')) exit();?>






<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>热门小说排行榜_小说排行榜完结版-纵横中文网手机版</title>
    <meta name="keywords" content="小说排行榜,小说排行榜完结版,热门小说排行榜"/>
    <meta name="description" content="纵横中文网小说排行榜提供小说排行榜完结版，涵盖原创、免费、最新、热门小说排行榜等，种类覆盖穿越小说,玄幻小说,言情小说,都市小说,官场小说,武侠小说,网游小说,历史小说等多种小说。"/>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="<?php echo (CSS_URL); ?>mobile_1.css">
    <script type="text/javascript" src="<?php echo (JS_URL); ?>zepto.min.js"></script>
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>app.css" />

</head>

<body  _pgid="34">

<div class="head">

    <div class="head_logo" style="background: none">
        <img src="<?php echo (IMG_URL); ?>logo.png" width="150px" style="margin-top: -9px;">
    </div>
    <div class="head_ulnk">
        <a href="/Home/Book/searchShow.html" class="but_search"><em></em></a>
    </div>
</div>

<div class="menu">
    <a href="/Home/Index/index.html" >首页</a>
    <a href="/Home/Book/category.html" >分类</a>
    <a href="/Home/Book/rank.html" class="active">排行</a>
    <a href="/Home/User/person.html" >个人中心</a>
</div>



<!-- h5ios游戏推荐 -->

<!--&lt;!&ndash;纵横月票榜start&ndash;&gt;-->
<!--<h3 class="cat_tit"><em></em>热搜榜单<a href="/h5/rank?type=1" class="top_more"><em></em>查看榜单</a></h3>-->
<!--<div class="top_list">-->

    <!--<a href="/h5/book?bookid=568097&fpage=34&fmodule=14&_st=34_14-1_568097"><em>1</em>万域之王<span class="num">11511</span></a>-->

    <!--<a href="/h5/book?bookid=411993&fpage=34&fmodule=14&_st=34_14-2_411993"><em>2</em>最强狂兵<span class="num">10233</span></a>-->

    <!--<a href="/h5/book?bookid=468543&fpage=34&fmodule=14&_st=34_14-3_468543"><em>3</em>十方神王<span class="num">5064</span></a>-->

    <!--<a href="/h5/book?bookid=578824&fpage=34&fmodule=14&_st=34_14-4_578824"><em>4</em>儒武争锋<span class="num">4446</span></a>-->

    <!--<a href="/h5/book?bookid=564558&fpage=34&fmodule=14&_st=34_14-5_564558"><em>5</em>无间枭雄<span class="num">3898</span></a>-->

<!--</div>-->
<!--&lt;!&ndash;纵横月票榜end&ndash;&gt;-->

<!--男生热门榜start-->
<h3 class="cat_tit"><em></em>用户收藏榜单<a  class="top_more"><em></em>收藏量</a></h3>
<div class="top_list">
    <?php if(is_array($collect)): foreach($collect as $k=>$v): ?><a href="/Home/Book/detail.html?bookId=<?php echo ($v["id"]); ?>"><em><?php echo ($k+1); ?></em><?php echo ($v["book_name"]); ?><span class="num"><?php echo ($v["num"]); ?></span></a><?php endforeach; endif; ?>


</div>
<!--男生热门榜end-->

<!--女生热门榜start-->
<h3 class="cat_tit"><em></em>字数最长小说榜单<a class="top_more"><em></em>小说字数</a></h3>
<div class="top_list">

    <?php if(is_array($maxLen)): foreach($maxLen as $k=>$v): ?><a href="/Home/Book/detail.html?bookId=<?php echo ($v["id"]); ?>"><em><?php echo ($k+1); ?></em><?php echo ($v["book_name"]); ?><span class="num"><?php echo (getLen($v["book_len"])); ?></span></a><?php endforeach; endif; ?>

</div>
<!--女生热门榜end-->

<!--潜力新书榜start-->
<h3 class="cat_tit"><em></em>字数最少小说榜单<a class="top_more"><em></em>小说字数</a></h3>
<div class="top_list">

    <?php if(is_array($minLen)): foreach($minLen as $k=>$v): ?><a href="/Home/Book/detail.html?bookId=<?php echo ($v["id"]); ?>"><em><?php echo ($k+1); ?></em><?php echo ($v["book_name"]); ?><span class="num"><?php echo (getLen($v["book_len"])); ?></span></a><?php endforeach; endif; ?>

</div>
<!--潜力新书榜end-->

<!--完本精品榜start-->
<h3 class="cat_tit"><em></em>潜力新书榜单<a class="top_more"><i class="iconfont">&#xe609;</i>更新时间</a></h3>
<div class="top_list">
    <?php if(is_array($mostNew)): foreach($mostNew as $k=>$v): ?><a href="/Home/Book/detail.html?bookId=<?php echo ($v["id"]); ?>"><em><?php echo ($k+1); ?></em><?php echo ($v["book_name"]); ?><span class="num"><?php echo (substr($v["last_update"],0,10)); ?></span></a><?php endforeach; endif; ?>
</div>
<!--完本精品榜end-->


<footer>
    <!-- 登录之前 -->
    <?php $username=session('username'); if(empty($username)){ ?>
    <div class="fl" id="sp_unlogin">
        <a href="/Home/User/pageLogin.html" >登陆</a> |
        <a href="/Home/User/register.html" >注册</a>
    </div>
    <?php }else{ ?>
    <!-- 登录之后 -->
    <div id="sp_nickname" class="fl">
        <a href="/Home/User/person.html"><span><?php $username=session('username');echo empty($username)?'登陆':$username; ?></span></a> |
        <a href="/Home/User/logOutAction.html">退出</a>
    </div>
    <?php } ?>
    <div class="fr">
        <a onclick="alert('谁要你吐槽的啊!!')">我要吐槽</a>
    </div>
    <div class="cl0"></div>



    <form action="" method="GET">
        <div class="searchbox">
            <div>
                <input placeholder="请输入关键字" value="" maxlength="15" name="keywords">
            </div>
            <div class="search_go"></div>
        </div>
        <input type="hidden" name="field" id="field" value="all"/>
    </form>


    <!--<div>-->
    <!--<a href="/adapter?tag=wap">极速版</a> | <a class="active">触屏版</a> | <a href="/adapter?tag=pc">电脑版</a> | <a href="http://news.zongheng.com/zhuanti/2015/appdl/index.html" >客户端</a>-->
    <!--</div>-->
    <span class="copyright">所有书籍均来自于互联网,如有侵犯,请联系<a href="http://wpa.qq.com/msgrd?v=3&uin=1034996580&site=qq&menu=yes">管理员</a>删除!</span>
</footer>

</body>
</html>
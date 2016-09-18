<?php if (!defined('THINK_PATH')) exit();?>






<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>小说分类推荐-纵横中文网手机版</title>
    <meta name="keywords" content="小说分类推荐"/>
    <meta name="description" content="纵横中文网小说分类推荐频道,精选玄幻小说、网游小说、言情小说、穿越小说、都市小说等多种热门小说,满足你多样的需求。"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="<?php echo (CSS_URL); ?>mobile3.css">
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>app.css" />
    <script type="text/javascript" src="<?php echo (JS_URL); ?>zepto.min.js"></script>

    <div class="olnk"><script type="text/javascript" src="<?php echo (JS_URL); ?>zepto.min.js"></script></div>

</head>

<body  _pgid="35">

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
    <a href="/Home/Book/category.html" class="active" >分类</a>
    <a href="/Home/Book/rank.html" >排行</a>
    <a href="/Home/User/person.html" >个人中心</a>
</div>


<!-- h5ios游戏推荐 -->

<!--奇幻玄幻 start-->
<div class="gline"></div>
<div class="cat_box">
    <h3 class="cat_tit"><em></em><a href="/h5/category?cPid=1&bookType=0">所有分类</a></h3>
    <div>
        <ul class="cat_list">
            <li><a href="/Home/Book/category2.html?bookType=玄幻">玄幻小说</a></li>
            <li><a href="/Home/Book/category2.html?bookType=修真">修真小说</a></li>
            <li><a href="/Home/Book/category2.html?bookType=网游">网游小说</a></li>
            <li><a href="/Home/Book/category2.html?bookType=科幻">科幻小说</a></li>
            <li><a href="/Home/Book/category2.html?bookType=都市">都市小说</a></li>
            <li><a href="/Home/Book/category2.html?bookType=历史">历史小说</a></li>
            <li><a href="/Home/Book/category2.html?bookType=完本">完本小说</a></li>
            <li><a href="/Home/Book/category2.html?bookType=更新">更新小说</a></li>
        </ul>
    </div>
</div>
<!--奇幻玄幻end-->


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



<script type="text/javascript" src="<?php echo (JS_URL); ?>a.js"></script>

</body>
</html>
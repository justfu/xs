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
    <div class="fl" id="sp_unlogin">
        <a href="http://passport.zongheng.com/wap/user/login.do?fpage=33&fmodule=52" >登录</a> |
        <a href="http://passport.zongheng.com/bdpass/wapRegister.do" >注册</a>
    </div>
    <!-- 登录之后 -->
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


    <!--<div>-->
    <!--<a href="/adapter?tag=wap">极速版</a> | <a class="active">触屏版</a> | <a href="/adapter?tag=pc">电脑版</a> | <a href="http://news.zongheng.com/zhuanti/2015/appdl/index.html" >客户端</a>-->
    <!--</div>-->
    <span class="copyright">所有书籍均来自于互联网,如有侵犯,请联系<a href="http://wpa.qq.com/msgrd?v=3&uin=1034996580&site=qq&menu=yes">管理员</a>删除!</span>
</footer>
<script type="text/javascript">
    (function(){
        var logoned = $("#sp_nickname");
        var unlogin = $("#sp_unlogin");


        var _isLogin = getCk("logon");
        if(_isLogin != null && _isLogin !="" && _isLogin!="undefined"){
            var nickName = (getCk("logon")!= null) ? Base64.decode(getCk("logon").split("|")[3]):null;
            unlogin.hide();
            logoned.show().find("span").html(nickName);
        }else{
            $.ajax({
                url: 'http://zongheng.baidu.com/getbduss.do',
                data: {ret:0,tag:1},
                error: function(){},
                dataType : 'jsonp',
                beforeSend: function(){},
                success: function(data){
                    if(data.errCode==0){
                        if(window.location.pathname && window.location.pathname.indexOf('shelf')!=-1){
                            location.reload();
                        }else{
                            var nickName = (getCk("logon")!= null) ? Base64.decode(getCk("logon").split("|")[3]):null;
                            unlogin.hide();
                            logoned.show().find("span").html(nickName);
                        }
                    }
                },
                complete: function(){},
                timeout : 10000
            })
        }

        if($("#footprint_id").length>0){
            $.ajax({
                url: 'http://m.zongheng.com/h5/ajaxGetFootPrint',
                error: function(){},
                dataType : 'html',
                success: function(data){
                    if(data!=null){
                        $("#footprint_id").append(data);
                    }
                }
            })
        }

    })()
</script>

<script type="text/javascript">
    var mstatSign = {
        v:'h5',
        bdcode:'http://hm.baidu.com/hm.gif?si=08a75cda7645e41f2d08825a3a78199b&amp;et=0&amp;nv=1&amp;st=1&amp;v=wap-2-0.3&amp;rnd=129346454'.replace(/&amp;/g, "&"),
        haocode:'http://www.hao123.com/t.gif?pid=201&amp;pf=3&amp;lo=0&amp;zhId=&amp;freeFr=&amp;zhTu=0&amp;et=0&amp;nv=1&amp;st=1&amp;v=wap-2-0.3&amp;rnd=142257505&amp;ucbs=0'.replace(/&amp;/g, "&"),
        ud:"03"
    };
    var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    document.write(unescape("%3Cspan id='cnzz_stat_icon_30088903'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "w.cnzz.com/c.php%3Fid%3D30088903' type='text/javascript'%3E%3C/script%3E"));

    (function() {
        var head = document.getElementsByTagName('head')[0];
        var addStat = document.createElement('script');
        addStat.setAttribute('type', 'text/javascript');
        addStat.setAttribute('src', 'http://static.zongheng.com/h5/js/mstat.js');
        head.appendChild(addStat);
        addStat.onload = function() {
            mstatGo.send()
        }
    })();

</script>


<script type="text/javascript">
    $(function(){
        $(".gamebox a").click(function(e){
            e.stopPropagation();
            postStat("download", "末页游戏下载","catPageDown");
        });
    });

    $(".gamebox").click(function(){
        var index = $(this).attr("index");
        postStat("gamelink", "末页游戏链接","catPageGamelink");
        var _this = $(this);
        setTimeout(function() {
            window.location.href = _this.attr("gameUrl");
        }, 500);
    });
</script>


<script type="text/javascript" src="<?php echo (JS_URL); ?>a.js"></script>

</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>搜索</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="<?php echo (CSS_URL); ?>mobile2.css">
    <script type="text/javascript" src="<?php echo (JS_URL); ?>zepto.min.js"></script>
</head>

<body>
<div class="subhead">
    <a href="/Home/Index/index.html">返回</a>
    <a>搜索</a>
    <a href="/Home/Index/index.html" class="ind">首页</a>
</div>
<form action="/Home/Book/searchShow.html.html" method="GET">
    <div class="search_t">
        <div class="searchbox">
            <div><input placeholder="请输入关键字" value="" maxlength="15" name="keywords"></div>
            <div class="search_go" ></div>
        </div>
    </div>
    <input type="hidden" name="field" id="field" value="all"/>
</form>


<h3 class="cat_tit"><em></em>热搜作品</h3>
<div class="top_list">
    <?php if(is_array($hotSearch)): foreach($hotSearch as $k=>$v): ?><a href="/Home/Book/detail.html?bookId=<?php echo ($v["id"]); ?>"><em><?php echo ($k+1); ?></em><?php echo ($v["book_name"]); ?><span class="peo"><?php echo ($v["book_author"]); ?></span></a><?php endforeach; endif; ?>

</div>

<h3 class="cat_tit"><em></em>热搜标签</h3>
<div class="search_tags">
    <div class="tags">

        <a href="/Home/Book/category2.html?bookType=玄幻">玄幻</a>

        <a href="/Home/Book/category2.html?bookType=修真">修真</a>

        <a href="/Home/Book/category2.html?bookType=网游">网游</a>

        <a href="/Home/Book/category2.html?bookType=玄幻">科幻</a>

    </div>
    <div class="tags">

        <a href="/Home/Book/category2.html?bookType=都市">都市</a>

        <a href="/Home/Book/category2.html?bookType=历史">历史</a>

        <a href="/Home/Book/category2.html?bookType=完本">完本</a>

        <a href="/Home/Book/category2.html?bookType=更新">更新</a>

    </div>
    <div class="tags">

        <a href="/Home/Book/category2.html?bookType=搞笑">搞笑</a>

        <a href="/Home/Book/category2.html?bookType=玄幻">玄幻</a>

        <a href="/Home/Book/category2.html?bookType=升级">升级</a>
        <a href="/Home/Book/category2.html?bookType=升级">升级</a>

        <a href="/Home/Book/category2.html?bookType=废柴">废柴</a>

    </div>
</div>

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


<script>
    $(".clear_sr").click(function(){
        $.ajax({
            url:mDomainName+"/ajax/clear/searchHistory"+mRefer,
            error: function(){zh_mini_pop(errorItem)},
            dataType : 'jsonp',

            success: function(data){
                zh_mini_pop(data.message,function(){
                    if(data.code==0){
                        $(".search_list,.cat_tit2").remove()
                    }
                });
            }
        })
        postStat("json","清空搜索记录","clearsh");
    });
</script>

</body>
</html>
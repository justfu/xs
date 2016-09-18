<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo ($bookType); ?>小说-免费小说阅读网手机版</title>
    <meta name="keywords" content="奇幻玄幻小说,奇幻玄幻小说,奇幻玄幻小说排行榜,奇幻玄幻小说排行榜,奇幻玄幻完本小说"/>
    <meta name="description" content="看热门原创奇幻玄幻小说、奇幻玄幻小说就到纵横中文网，这里有最好看的奇幻玄幻小说排行榜、奇幻玄幻小说完本等，提供阅读与下载。"/>

    <title>小说分类推荐-免费小说阅读网手机版</title>
    <meta name="keywords" content="小说分类推荐"/>
    <meta name="description" content="纵横中文网小说分类推荐频道,精选玄幻小说、网游小说、言情小说、穿越小说、都市小说等多种热门小说,满足你多样的需求。"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="<?php echo (CSS_URL); ?>mobile_2.css">
    <script type="text/javascript" src="<?php echo (JS_URL); ?>zepto.min.js"></script>
</head>

<body _pgid="53">



<div class="subhead">
    <a href="/Home/Book/category.html">返回</a>
    <a><?php echo ($bookType); ?></a>
    <a href="/Home/User/person.html" style="background: none;width: 60px;" class="bs">个人中心</a>
</div>
<h2 class="cat_tit"><em></em><?php echo ($bookType); ?></h2>
<div class="tab_tit" id="cat_subtab">
    <span class="active" type="1">热门</span>
    <span type="2">新书</span>
    <span type="3">更新中</span>
    <span type="4">完本</span>
</div>
<div id="cateList_wap" class="book_slist">
    <!--保留结构备份，实际上线可删除start-->

    <!--保留结构备份，实际上线可删除end-->
</div>
<div id="view_more" class="sbut">
    <span class="view_more">查看更多</span>
</div>

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
<script>
    var num=10;
    var bookType = '<?php echo ($bookType); ?>';
    function loadCategory(type,page,num){
        var insertHtml="";
        $.ajax({
            url: '/Home/Book/category3',
            data:{
                type:type,
                pageSize:num,
                pageNum:page,
                bookType:bookType
            },
            error: function(){zh_mini_pop(errorItem);},
            dataType : 'json',
            beforeSend: function(){
                if(page==1){
                    $("#cateList_wap").html(loadingItem);
                    $("#view_more").html('')
                }else{
                    $("#view_more").html('<span class="view_more">更多内容读取中...</span>')
                }
            },
            success: function(data){
                if(data.status1==-2){
                    if(page==1){
                        $("#cateList_wap").html(noItemCon("书籍"));
                        $("#view_more").html("");
                        return false;
                    }else{
                        $("#view_more").html(noMoreItem);
                        return false;
                    }
                }else if(data.ajaxResult==-1){
                    zh_mini_pop(errorItem);
                }else{
                    var curData = eval('var a=' + data.data);
                    for (i = 0; i < a.length; i++) {
                        insertHtml += '<div class="bookbox" bookId="' + a[i].id + '"><div class="bookimg">';
                        insertHtml += '<img src=' + a[i].book_img + ' orgsrc=' + a[i].book_img + '>';
//                    insertHtml+='<img src='+a[i].book_img+'>';
                        insertHtml += '</div><div class="bookinfo"><h4 class="bookname"><div>' + a[i].book_name + '</div></h4>';
                        insertHtml += '<div class="author">' + a[i].book_author + '</div>';
                        insertHtml += '<div class="cat"></div><div class="cl0"></div>';
                        if (a[i].is_over == 2) {
                            insertHtml += '<div class="update"><span>已完结</span></div>';
                        } else {
                            insertHtml += '<div class="update"><span>更新至：</span>' + a[i].lastChapterTitle + '</div>';
                        }
                        insertHtml += '<div class="intro_line"><span>简介：</span>' + a[i].book_desc + '</div></div></div>';
                    }
                    page==1?$("#cateList_wap").html(insertHtml):$("#cateList_wap").append(insertHtml);
                    $(".bookbox").unbind("click").click(function(){
                        location.href='detail.html?bookId='+$(this).attr('bookId');
                    });
                    a.length<num?$("#view_more").html(noMoreItem):
                            $("#view_more").html('<span class="view_more" onclick="loadCategory('+type+','+(page+1)+','+num+')">查看更多</span>');
                    imgload($(".bookimg img"));
                }
            },
            complete: function(){},
            timeout : 10000
        })
    }
    var type=1;
    $(function(){
        $("#cat_subtab span").click(function(){
            $(this).addClass("active").siblings().removeClass("active");
            type = $(this).attr("type");
            if (type <= 0 || type == "") {
                type = 1;
            }
            loadCategory(type,1,num);
        })
        $("#cat_subtab span").eq(0).click();
    });
</script>

</body>
</html>
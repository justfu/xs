<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <title>鬼王的金牌宠妃章节阅读,潇湘书院手机触屏版</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
    <script src="<?php echo (JS_URL); ?>xiaoxiang.min.js"></script>
    <link href="<?php echo (CSS_URL); ?>mcommon.css" rel="stylesheet" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="format-detection" content="email=no" />
    <meta name="format-detection" content="adress=no" />
    <script src="<?php echo (JS_URL); ?>jquery.min.js"></script>
    <script src="<?php echo (JS_URL); ?>site.js"></script>
    <script src="<?php echo (JS_URL); ?>readchapter.js"></script>
    <script src="<?php echo (JS_URL); ?>zbox.js"></script>
    <link href="<?php echo (CSS_URL); ?>css2.css" rel="stylesheet" />
    <link href="<?php echo (CSS_URL); ?>readercss.css" rel="stylesheet" />
    <link href="<?php echo (CSS_URL); ?>zbox.css" rel="stylesheet" />
    <style type="text/css">
        .model { background:#ECD9AC; color:#3C3C3C; font-size:16px; font-family:STSong; line-height:30px; }
    </style>
    <script>
        function __fn() {
            var tempW = 750;
            var objiframe = window.parent.document.getElementsByTagName('iframe')[0];
            var winwidth = $(window).width() > 0 ? $(window).width() : $(objiframe).width();
            var size = parseInt($(window).width() * 100 / tempW);
            var html = $('html').eq(0);
            $(html).css({ fontSize: size + 'px' });
        }
        __fn();
        window.onresize = function () { __fn(); }
    </script>
    <script>
        //声明_czc对象:
        var _czc = _czc || [];
        //绑定siteid，请用您的siteid替换下方"XXXXXXXX"部分
        _czc.push(["_setAccount", "30068005"]);
    </script>
</head>

<body style="padding: 0;" oncontextmenu="return false" onselectstart="return false" oncopy="return false">

<div class="menuTop clearfix">
    <span class="icon iconfont icon-back" data-value="0"></span>
    <span class="icon iconfont icon-more more" data-value="3"></span>
    <span class="icon iconfont icon-download download" data-value="2"></span>
    <span id="collect" class="icon iconfont icon-collect collect " data-value="1"></span>
</div>

<div class="downloaddiv">
    <div class="downarrow"></div>
    <div>下载小说离线读，减少等待省流量</div>
    <div class="textbutton gotodownload">下载客户端，拥有此神技</div>
</div>

<div class="menuBottom">
    <div class="chapterbtndiv clearfix" id="chapterset">
        <span class="right_line" data-value="0">上一章</span>
        <span data-value="1">下一章</span>
    </div>

    <div class="menuicondiv clearfix" id="menuset">
        <div class="menuicon" data-value="0">
            <div class="icon iconfont icon-category"></div>
            <div>目录</div>
        </div>
        <div class="menuicon" data-value="1">
            <div class="icon iconfont icon-moon"></div>
            <div>设置</div>
        </div>
        <div class="menuicon" data-value="2">
            <div class="icon iconfont icon-download"></div>
            <div>下载</div>
        </div>
        <div class="menuicon" data-value="3">
            <div class="icon iconfont icon-shezhi"></div>
            <div>设置</div>
        </div>
    </div>

    <div class="txtAdjustment">
        <div class="adjustment clearfix">
            <div class="adjustLeft">字号</div>
            <div class="adjustRight fontsize clearfix" id="fontset">
                <span data-value="0">A -</span>
                <span data-value="1">A +</span>
            </div>
        </div>
        <div class="adjustment clearfix">
            <div class="adjustLeft">间距</div>
            <div class="adjustRight spacing clearfix" id="lineset">
                    <span class="spacing-left " data-value="0" data-line="20">
                        <div class="leftlinediv">
                            <div class="left-line"></div>
                            <div class="left-line"></div>
                            <div class="left-line"></div>
                        </div>
                    </span>
                    <span class="spacing-mid spacing-actived" data-value="1" data-line="14">
                        <div class="midlinediv">
                            <div class="mid-line"></div>
                            <div class="mid-line"></div>
                            <div class="mid-line"></div>
                            <div class="mid-line"></div>
                        </div>
                    </span>
                    <span class="spacing-right " data-value="2" data-line="8">
                        <div class="rightlinediv">
                            <div class="right-line"></div>
                            <div class="right-line"></div>
                            <div class="right-line"></div>
                            <div class="right-line"></div>
                            <div class="right-line"></div>
                        </div>
                    </span>
            </div>
        </div>
        <div class="adjustment clearfix">
            <div class="adjustLeft">主题</div>
            <div class="adjustRight  clearfix">
                <div class="brightness icon iconfont icon-moon moon" id="dayornight"></div>
                <div class="themediv clearfix" id="themeset">
                    <div class="theme actived"><span class="themebtn textstyle01 celoption" data-value="0">阅</span></div>
                    <div class="theme"><span class="themebtn textstyle02 celoption" data-value="1">阅</span></div>
                    <div class="theme"><span class="themebtn textstyle03 celoption" data-value="2">阅</span></div>
                    <div class="theme"><span class="themebtn textstyle04 celoption" data-value="3">阅</span></div>
                </div>
                <div class="more" id="thememore">更多</div>
            </div>
        </div>
        <div class="dclient gotodownload">下载客户端，支持更换字体、亮度调节></div>
    </div>

    <div class="themeAdjustMore clearfix" id="allthemeset">
        <div class="theme actived"><span class="themebtn textstyle01 celoption" data-value="0">阅</span></div>
        <div class="theme"><span class="themebtn textstyle02 celoption" data-value="1">阅</span></div>
        <div class="theme"><span class="themebtn textstyle03 celoption" data-value="2">阅</span></div>
        <div class="theme"><span class="themebtn textstyle04 celoption" data-value="3">阅</span></div>
        <div class="theme"><span class="themebtn textstyle05 celoption" data-value="4">阅</span></div>
        <div class="theme"><span class="themebtn textstyle06 celoption" data-value="5">阅</span></div>
        <div class="theme"><span class="themebtn textstyle07 celoption" data-value="6">阅</span></div>
        <div class="theme"><span class="themebtn textstyle08 celoption" data-value="7">阅</span></div>
        <div class="theme"><span class="themebtn textstyle09 celoption" data-value="8">阅</span></div>
        <div class="theme"><span class="themebtn textstyle10 celoption" data-value="9">阅</span></div>
        <div class="theme"><span class="themebtn textstyle11 celoption" data-value="10">阅</span></div>
        <div class="theme"><span class="themebtn textstyle12 celoption" data-value="11">阅</span></div>
        <div class="theme"><span class="themebtn textstyle13 celoption" data-value="12">阅</span></div>
        <div class="theme"><span class="themebtn textstyle14 celoption" data-value="13">阅</span></div>
        <div class="theme"><span class="themebtn textstyle15 celoption" data-value="14">阅</span></div>
    </div>
</div>

<div id="moreSet" class="moreSet-wrapper" style="display: none;">
    <ul>
        <li><a href="/Page/Default?stat_page=1_home_p1" onclick="_czc.push(['_trackEvent', '阅读页', '更多-首页']);">首页</a></li>
        <li><a href="/Page/Search" onclick="_czc.push(['_trackEvent', '阅读页', '更多-搜索']);">搜索</a></li>
        <li><a href="/Page/Shelf?stat_page=1_bookcase_p2" onclick="_czc.push(['_trackEvent', '阅读页', '更多-我的书架']);">我的书架</a></li>
        <li><a href="/Page/ClassFication?stat_page=1_category_p4" onclick="_czc.push(['_trackEvent', '阅读页', '更多-分类导航']);">分类导航</a></li>
        <li><a href="/Page/Info?stat_page=1_detail_p11&bookid=396160" onclick="_czc.push(['_trackEvent', '阅读页', '更多-作品详情']);">作品详情</a></li>
        <li><a href="/Page/Center" onclick="_czc.push(['_trackEvent', '阅读页', '更多-用户中心']);">用户中心</a></li>
        <li><a href="javascript:;" id="btnsub" onclick="_czc.push(['_trackEvent', '阅读页', '更多-批量订阅']);">批量订阅</a></li>
    </ul>
</div>

<div class="read-wrapper model" id="forsubscribe" style="display: none;">
</div>
<div class="read-wrapper model" id="currentPage">
    <div class="chname">
        <h3></h3>
        <em></em>
    </div>

    <div class="ctx">
    </div>
</div>

<div class="readsubcribe subcribemaininfo horizontalcenter" style="margin-top: 30px;">
    <div class="chaptername" id="chaptername"></div>
    <p class="price"></p>
    <p class="balance"></p>

    <div class="autosubcribe"><span class="iconfont iconfont_checkedbox"></span><span>自动订阅下一章<em>（可在“个人中心”取消）</em></span></div>

    <div class="subbtn" style="font-size: medium; margin-top: 0;">
        <span class="fenge"></span>
        <div id="divsubscribe">订阅本章</div>
        <span class="thanks">感谢支持作者，支持正版阅读</span>
    </div>
</div>

<div id="special1" class="special horizontalcenter">
    <span></span>
</div>
<div id="special2" class="special horizontalcenter">
    <span></span>
</div>

<div class="readsubcribe horizontalcenter" id="help">
    <a href="/Page/MemLvInfo"><span class="iconfont iconfont_help"></span><span>&nbsp;订阅帮助</span></a>
</div>
<div style="display: none;">

    <div class="login_bottom">
        <p><a href="http://g.xxsy.net" target="_parent">3G版</a> |
            <a href="/Page/DownLoad?stat_page=1_download_p4" target="_parent">客户端</a> |
            <a href="http://m.53kf.com/72065701/54/1" target="_parent">在线咨询</a> |
            <a href="/Page/UserSuggest" target="_parent">意见反馈</a></p>
        <p>潇湘书院版权所有(71)</p>
        <p>客服电话：400-021-8997（9:30~22:00）</p>
        <p>客服QQ：2851615751、2851615752</p>
    </div>
    <div style="display:none;">
        <img src="http://c.cnzz.com/wapstat.php?siteid=30068005&amp;r=&amp;rnd=830647184" width="0" height="0"/>
        <script src="<?php echo (JS_URL); ?>c.php" language="JavaScript" ></script>
        <img src="http://c.cnzz.com/wapstat.php?siteid=1253411493&amp;r=&amp;rnd=830647184" width="0" height="0"/>
        <script src='<?php echo (JS_URL); ?>c_1.php' language='JavaScript'></script>
    </div>
    <script src="<?php echo (JS_URL); ?>fastclick.js"></script>
    <script src="<?php echo (JS_URL); ?>xxsy.js"></script>
    <script src="<?php echo (JS_URL); ?>footjs.js"></script>

</div>
<script type="text/javascript">

    var _userid = parseInt(0);
    var _bookid = parseInt(<?php echo ($detail['book_id']); ?>);
    var _cid = parseInt(4451268);
    var _his = 1;
    var _fontsize = parseInt(16);
    var _lineheight = parseInt(30);
    var _lineheightadd = parseInt(14);
    var _bookName = "<?php echo ($detail['book_name']); ?>";
    var _isChapterList = "0";
    var _stat_page = "1_reading_p3";
    var _height = $(window).height();
    var _collection = parseInt(0);
    var _chapterfontsize = parseInt(24);
    var _chapterlineheight = parseInt(16 +18);

    window.onload = function () {

        $("#special1").css({ top: _height * 0.68 });
        $("#special2").css({ top: _height * 0.75 });
        $("#help").css({ top: _height * 0.9 });

        if (!_stat_page || _stat_page == "")
            _stat_page = "1_reading_p6";

        Reader.Init({
            UserID: _userid, CID: _cid, BookID: _bookid,
            IsHis: _his, FontSize: _fontsize, LineHeight: _lineheight,
            BookName: _bookName, IsChapterList: _isChapterList,
            Stat_Page: _stat_page, SubChapterId: _cid, Collection: _collection,
            ChapterFontSize: _chapterfontsize, ChapterLineHeight: _chapterlineheight,
            LineHeightAdd: _lineheightadd
        });

    }
</script>

</body>
</html>
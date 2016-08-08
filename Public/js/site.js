/// <reference path="jQuery.Min.js" />
/// <reference path="xxsy.js" />

(function () {

    window.Site = {
        /*公共操作数*/
        options: {
            timer: null,
            checkTimer: null
        },
        /*设置窗体标题*/
        _setBoxTitle: function (title) {
            $("#_winbox .win-header span").html(title);
        },
        /*重置窗体Top位置*/
        _resetBoxTop: function (top) {
            $("#_winbox").css({ top: top + "px" });
        },
        /*重置位置*/
        _resetPos: function () {
            var box = $("#_winbox");
            var top = ($(window).height() - box.height()) * 0.4;
            if (top < 0) top = 0;
            box.css({ top: top + "px" });
        },
        /*显示浮层*/
        showWinbox: function (title, html, cover, goHis) {

            var htm = [];
            htm.push('<div id="_winbox" class="win-box">');
            htm.push('    <div class="win-padding">');
            htm.push('        <div class="win-main">');
            htm.push('            <div class="win-header">');
            htm.push('                <span>' + title + '</span>');
            htm.push('                <button class="win-box-close">×</button>');
            htm.push('            </div>');
            htm.push('              <div class="win-line"></div>');
            htm.push('             <div id="_winBody">' + html + '</div>');
            htm.push('        </div>');
            htm.push('    </div>');
            htm.push('</div>');
            $("#_winbox").remove();
            $(htm.join("")).appendTo("body");

            Site._resetPos();
            $("button[class=win-box-close]").click(function () {
                Site.closeWinbox(goHis);
            });

            if (cover) {
                $("#_winCover").remove();
                $('<div id="_winCover" class="win-cover"></div>').appendTo("body");
                $("#_winCover").height($(document).height());
            }
        },
        /*关闭浮层*/
        closeWinbox: function (goHis) {
            $("#_winbox").remove();
            $("#_winCover").remove();
            if (Site.options.timer) clearTimeout(Site.options.timer);
            if (Site.options.checkTimer) clearInterval(Site.options.checkTimer);
            if (typeof goHis != "undefined" && goHis == 1)
                history.go(-1);
        },

        /*显示发表评论框*/
        showSendReviewbox: function (userid, bookid, callback) {
            var _isLoading = 0;

            var htm = [
                ' <ul class="group2">',
                '     <li><textarea class="area" id="_txtReviewText"></textarea></li>',
                '     <li style="text-align:right;"><span id="_spnLength">0/1000</span></li>',
                '     <li><a href="javascript:;" id="_lnkSendReview" class="button blue r3">确定发表评论</a></li>',
                ' </ul>'
            ];

            Site.showWinbox("发表评论", htm.join(""), true);
            Site.options.checkTimer = setInterval(
                function () {
                    var len = $("#_txtReviewText").val().length;
                    var spn = $("#_spnLength");
                    spn.css({ color: (len > 1000 || len < 6) ? "#f00" : "#555" });
                    spn.html(len + "/1000");
                }, 500);

            $("#_lnkSendReview").click(
                function () {
                    if (_isLoading == 1)
                        return;

                    var txt = $("#_txtReviewText").val();
                    txt = txt.replace(/(^\s*)|(\s*$)/g, "");
                    if (txt.length < 6) {
                        Util.Alert("评论内容不能少于6个字");
                        return;
                    }

                    if (txt.length > 1000) {
                        Util.Alert("评论内容不能超过1000个字");
                        return;
                    }

                    if (/(兼职|招聘)/.test(txt) == true) {
                        Util.Alert("非法词汇");
                        return;
                    }

                    _isLoading = 1;
                    Site._setBoxTitle("发送中....");

                    ajaxPostService("/Service/ServiceMethod", "book_sendreview", { userid: userid, bookid: bookid, content: txt },
                        function (res, status) {
                            _isLoading = 0
                            Site._setBoxTitle("发表评论");

                            //超时
                            if (status == 1) {
                                Util.Alert("网络连接异常，请稍后再试");
                                return;
                            }

                            //发生错误
                            if (status == 2) {
                                Util.Alert("系统错误，请稍后再试");
                                return;
                            }

                            //成功
                            if (res.Code == 0) {
                                Util.Alert("成功发表了一条评论");
                                clearInterval(Site.options.checkTimer);

                                setTimeout(function () {
                                    if (typeof callback == "function") callback();
                                    Site.closeWinbox();
                                }, 1500);
                                return;
                            }

                            Util.Alert(res.Message);
                        });
                });

        },

        /*显示确认框*/
        showConfirmbox: function (msg, callback) {
            var htm = [
                '<div id="_confirmBox" class="box" style="padding:10px 0;">',
                '    <div class="box" style="padding-bottom:10px; color:#555; line-height:24px; text-indent:28px; font-size:16px;">',
                msg,
                '    </div>',
                '    <div class="line"></div>',
                '    <ul class="group g2 m10">',
                '        <li><a href="javascript:;" data-value="1" class="button blue r3">确定</a></li>',
                '        <li><a href="javascript:;" data-value="0" class="button color2 r3">取消</a></li>',
                '    </ul>',
                '</div>'
            ];
            this.showWinbox('提示', htm.join(""), true);
            $("#_confirmBox .button").click(function () {
                var value = parseInt($(this).attr("data-value"));
                if (typeof callback == "function")
                    callback(value);
                Site.closeWinbox();
            });
        },

        /*回顶部*/
        initGotoTop: function (callback, hasload) {
            //$("#_goTop").remove();
            //$('<a id="_goTop" href="javascript:;" class="gotop"></a>').appendTo("body");
            //$("#_goTop").click(function () {
            //    if (typeof callback == "function") callback();
            //    $("body").animate({ scrollTop: 0 }, 200);
            //});
            //setInterval(function () {
            //    var top = $("body").scrollTop();
            //    top > 10 ? $("#_goTop").show() : $("#_goTop").hide();
            //}, 200);

            $("#__goTop").remove();
            if (hasload) {
                $('<div class="up" style="bottom:60px;"><a id="__goTop" class="floatbtn btn_up" style="display:none;">&nbsp;</a></div>').appendTo("body");
            } else {
                $('<div class="up"><a id="__goTop" class="floatbtn btn_up" style="display:none;">&nbsp;</a></div>').appendTo("body");
            }
            $("#__goTop").click(function () {
                if (typeof callback == "function") callback();
                $("body").animate({ scrollTop: 0 }, 200);
            });
            setInterval(function () {
                var top = $("body").scrollTop();
                var height = window.innerHeight;
                //top > 10 ? $("#__goTop").show() : $("#__goTop").hide();
                top > height ? $("#__goTop").show() : $("#__goTop").hide();
            }, 200);
        },

        /*下载*/
        showDownloadApp: function (_pagetype, qqhuodong) {
            $("#_downloadapp").remove();

            var htm = [
                    '<div class="clientContdiv">',
                    '<div class="clientfliter"></div>',
                    '<div class="clientCont clearfix">',
                    '<div class="clientleft clearfix">',
                    '<div class="clientimg">',
                    '<img src="../NewCss/image/verlogo.png"></div>',
                    '<div class="clientwords">',
                    '<div class="clienttitle">潇湘书院客户端</div>',
                    '<div>速度快，省流量，离线读</div></div></div>',
                    '<div class="clientright clearfix">',
                    '<div class="clientbtn">',
                    '<input type="button" value="立即下载" id="gotodownload"></div>',
                    '<div class="bclose" id="_closedownload"><b></b></div></div></div>'
            ]

            var ua = navigator.userAgent;
            if (qqhuodong && (ua.indexOf('Android') > -1 || ua.indexOf('Linux') > -1)) {
                htm = [
                        '<div class="clientContdiv">',
                        '<div class="clientfliter"></div>',
                        '<div class="clientCont clearfix">',
                        '<div class="clientleft clearfix">',
                        '<div class="clientimg">',
                        '<img src="http://images.xxsy.net/mxxsynet/20151209/verlogo_qqhd.png"></div>',
                        '<div class="clientwords">',
                        '<div class="clienttitle">潇湘书院客户端</div>',
                        '<div style="font-size:11px;color:#f00;">7月18~24 QQ充值随机立减</div></div></div>',
                        '<div class="clientright clearfix">',
                        '<div class="clientbtn">',
                        '<input type="button" value="立即下载" id="gotodownload"></div>',
                        '<div class="bclose" id="_closedownload"><b></b></div></div></div>'
                ]
            }

            $("body").append(htm.join(""));

            $("#gotodownload").click(function () {
                if (_pagetype == 2) {
                    _czc.push(['_trackEvent', '作品详情页', '底部悬浮下载客户端按钮']);//cnzz 统计
                }
                var isweichat = ua.toLowerCase().match(/MicroMessenger/i) == 'micromessenger';
                if (ua.indexOf('Android') > -1 || ua.indexOf('Linux') > -1) {
                    //android
                    updatedata("android");
                    if (isweichat) {
                        location.href = "http://dd.myapp.com/16891/93EA4EC9520D7710A634C0E762148352.apk?fsname=com.xxsyread_3.21_321.apk";
                    } else {
                        location.href = "http://down.xxsy.net/downapp.asp";
                    }
                } else if (ua.indexOf("Mac OS") > -1) {
                    //ios
                    updatedata("ios");
                    if (isweichat) {
                        location.href = "http://a.app.qq.com/o/simple.jsp?pkgname=com.xxsyread&g_f=991653";
                    } else {
                        location.href = "https://itunes.apple.com/cn/app/xiao-xiang-shu-yuan-xiao-shuo/id719359889?mt=8";
                    }
                } else {
                    location.href = "/Page/DownLoad?stat_page=1_download_p2";
                }
            })

            $("#_closedownload").click(function () {
                $(".clientContdiv").remove();
                Util.CookieWrite("CloseFordown", 1, 3);
            });

            function updatedata(uatype) {
                var _stat_page = "";
                if (uatype == "android") {
                    if (_pagetype == 1) {
                        _stat_page = "1_androidapp_p2"; //首页底部推广
                    } else if (_pagetype == 2) {
                        _stat_page = "1_androidapp_p3"; //详情页底部推广
                    } else if (_pagetype == 3) {
                        _stat_page = "1_androidapp_p4"; //章节目录页底部推广
                    }
                } else {
                    if (_pagetype == 1) {
                        _stat_page = "1_iosapp_p2"; //首页底部推广
                    } else if (_pagetype == 2) {
                        _stat_page = "1_iosapp_p3"; //详情页底部推广
                    } else if (_pagetype == 3) {
                        _stat_page = "1_iosapp_p4"; //章节目录页底部推广
                    }
                }

                try {
                    var c_guid = Util.CookieValue("xxsy_guid");

                    ajaxService("/Service/ServiceMethod", "stats_guid", { guid: c_guid, actionname: "", statpage: _stat_page, bookid: 0 },
                    function (res, status) {
                        if (res != null && res.Guid != "" && res.Guid != c_guid) {
                            Util.CookieWrite("xxsy_guid", res.Guid, 999);
                            localStorage.setItem("xxsy_guid", res.Guid);
                        }
                    });
                } catch (e) {
                    console.log(e.message, e.name, e.stack);
                }
            }
        }
    };

})();

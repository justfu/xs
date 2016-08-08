//Parameter
var pagename = getpagename();

$(function () {
    updateuserinfo();
});

$(".return").bind("click", function () {
    if (pagename != "") {
        _czc.push(['_trackEvent', pagename, '页面返回按钮']);
    }
    if (document.referrer == "") {
        location.href = "/Page/Default?stat_page=1_home_p1";
        return;
    }
    history.go(-1);
});
$(".home").bind("click", function () {
    location.href = "/Page/Default?stat_page=1_home_p1";
});
$(".people").bind("click", function () {
    location.href = "/Page/Center?stat_page=1_center_p1";
    return;
});
$(".search").bind("click", function () {
    location.href = "/Page/Search";
    return;
});
$(".menusearch").bind("click", function () {
    location.href = "/Page/Search";
    return;
});
$(".shujia").bind("click", function () {
    location.href = "/Page/Shelf";
    return;
});
$("#todefault").bind("click", function () {
    if ($(this).hasClass("tab_chosed")) {
        return;
    }
    location.href = "/Page/Default?stat_page=1_home_p1";
});
$("#toorder").bind("click", function () {
    if ($(this).hasClass("tab_chosed")) {
        return;
    }
    location.href = "/Page/Order?stat_page=1_bank_p1";
});
$("#toclass").bind("click", function () {
    if ($(this).hasClass("tab_chosed")) {
        return;
    }
    location.href = "/Page/ClassFication?stat_page=1_category_p1";
});
$("#tomonth").bind("click", function () {
    if ($(this).hasClass("tab_chosed")) {
        return;
    }
    location.href = "/Page/ClassFication?uid=99&stat_page=1_finished_p1";
});
$("#tofree").bind("click", function () {
    if ($(this).hasClass("tab_chosed")) {
        return;
    }
    location.href = "/Page/Free?stat_page=1_free_p1";
});


if (pagename != "") {
    $(".secmenu").append('<li><a href="javascript:_czc.push([\'_trackEvent\', \'' + pagename + '\', \'更多-下载客户端\']);window.location=\'/Page/DownLoad?stat_page=1_download_p3\'">下载客户端</a></li>');
} else {
    $(".secmenu").append('<li><a href="/Page/DownLoad?stat_page=1_download_p3">下载客户端</a></li>');
}

//FastClick
FastClick.attach(document.body);
//下拉切换
$('.second-level').click(function () {
    if ($('.secmenu').hasClass("secmenushow")) {
        $('.secmenu').removeClass("secmenushow");
    } else {
        $('.secmenu').addClass("secmenushow");
    }
    event.stopPropagation();
});

$(document).click(
    function () {
        $('.secmenu').removeClass("secmenushow");
    });

var loadimage_timer = setInterval(function () {
    loadImages();
}, 100);

function loadImages() {
    var imageList = document.querySelectorAll('img[data-src]');
    for (var i = 0; i < imageList.length; i++) {
        var top = imageList[i].getBoundingClientRect().top;
        if (top < window.innerHeight) {
            var src = imageList[i].getAttribute('src');
            var display = imageList[i].style.display;
            if ((!src || src == '') && display != 'none')
                imageList[i].setAttribute('src', imageList[i].getAttribute('data-src'));
        }

    }
}

//回到顶部
$(".btn_up").click(function () {
    $("body").animate({ scrollTop: 0 }, 200);
});

setTimeout(
    function () {
        var bp = document.createElement('script');
        bp.src = '//push.zhanzhang.baidu.com/push.js';
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    }, 0);

function updateuserinfo() {
    try {

        var ing = Util.CookieValue("update_ing");
        if (ing != "")
            return;

        var alupdate = Util.CookieValue("alupdate_userinfo");
        if (alupdate != null && alupdate != "")
            return;

        Util.CookieTimerWrite("update_ing", 1, 60, 1);

        ajaxService("/Service/ServiceMethod", "update_userinfo", {},
            function (res, status) {

                if (res != "") {
                    if (res.LastLoginAddress != "") {
                        var obj = {
                            title: "安全提示",
                            msg: "您的账号于<span class='color8'>" + res.LastLoginTime + "</span>在<span class='color8'>" + res.LastLoginAddress + "</span>登录，存在异地登陆异常。如非本人登录，建议立即修改密码，保护账号安全。",
                            submitval: "修改密码",
                            cancelval: "以后再说",
                            textalign: "left",
                            callback: function () {
                                if (res.BandMobile == 1) {
                                    window.parent.location.href = "VChangePassword";
                                } else {
                                    window.parent.location.href = "UserSet?changepass=1";
                                }
                            }
                        };
                        Util.NewConfirm(obj);
                        return;
                    }
                }
            });
    } catch (e) {
        console.log(e.message, e.name, e.stack);
    }

}

//获取路径对应页面名 cnzz统计
function getpagename() {
    var pagename = "";
    var pathnamelow = window.location.pathname.toLocaleLowerCase();
    switch (pathnamelow) {
        case "/page/info": pagename = "作品详情页"; break;
    }
    return pagename;
};
/// <reference path="jQuery.Min.js" />

(function () {
    var winHeight = $(window).height();
    $('#shortPage').css('min-height', winHeight);

    window.Util = {

        Alert: function (msg, callback) {

            var htm = [
                '<div id="_jxalertbox" class="alertbox">',
                '    <div class="alert-div"><p>' + msg + '</p></div>',
                '</div>'
            ];

            $("#_jxalertbox").remove();
            $(htm.join("")).appendTo("body");

            var box = $("#_jxalertbox");
            box.css({ top: ($(window).height() - box.height() - 30 + $(window).scrollTop()) + "px" });

            setTimeout(function () {
                $("#_jxalertbox").remove();
                if (typeof callback == "function") {
                    callback();
                }
            }, 2000);

        },

        NewAlert: function (msg, cancelval, callback) {
            var htm = [
                '<div class="overWrap">',
                '<div class="popbox newalertup">',
                '<div class="box_bd" style="width:100%;">',
                '<p class="main_text">' + msg + '</p>',
                '<div class="form" style="width:60%;margin-left:15%;">',
                '<input type="submit" value="' + cancelval + '" class="btn btn_cancel">',
                '</div>',
                '</div>',
                '</div>'
            ];

            $(".overWrap").remove();
            $("body").append(htm.join(""));

            $(".overWrap").addClass("md-overlay");

            $(".btn_cancel").bind("click", function () {
                $(".overWrap").remove();
            });
        },

        NewConfirm: function (obj) {
            var htm = [];
            htm.push('<div class="overWrap" style="z-index:9999;">');
            htm.push('<div class="popbox newalertup">');
            if (obj.title != "") {
                htm.push('<div style="font-size: 15px;font-weight: bold;display:block;">' + obj.title + '</div>');
            }
            htm.push('<div class="box_bd" style="width:100%;">');
            if (obj.textalign == "left") {
                htm.push('<p class="main_text" style="text-align:left;">' + obj.msg + '</p>');
            } else {
                htm.push('<p class="main_text">' + obj.msg + '</p>');
            }
            htm.push('<div class="form" style="width:80%;margin-left:10%;">');
            htm.push('<input type="submit" value="' + obj.submitval + '" class="btn btn_sure" id="txtgoto" style="width:40%;">');
            htm.push('<input type="submit" value="' + obj.cancelval + '" class="btn btn_cancel" style="width:40%;">');
            htm.push('</div>');
            htm.push('</div>');
            htm.push('</div>');
            htm.push('</div>');
            
            $("body").append(htm.join(""));

            $(".btn_sure").bind("click", function () {
                if (typeof obj.callback == "function") {
                    obj.callback();
                }
            });

            $(".btn_cancel").bind("click", function () {
                $(".overWrap").remove();
                if (typeof obj.cancelcallback == "function") {
                    obj.cancelcallback();
                }
            });
        },

        Loading: function (msg) {
            var htm = [
                '<div id="_jxloadingbox" class="loadingbox">',
                '    <div class="loading-div">',
                '    </div>',
                '</div>'
            ];
            $("#_jxloadingbox").remove();
            $(htm.join("")).appendTo("body");
            var lbox = $("#_jxloadingbox");
            lbox.css({ top: ($(window).height() - lbox.height()) * 0.4 + $(window).scrollTop() + "px" });
        },

        LoadingClear: function () {
            $("#_jxloadingbox").remove();
        },

        _Cookie: function (name, value, options) {

            if (typeof value != 'undefined') {

                options = options || {};
                if (value === null) {
                    value = '';
                    options.expires = -1;
                }

                var expires = '';

                if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
                    var date;
                    if (typeof options.expires == 'number') {
                        date = new Date();
                        if (options.model == 1) {
                            date.setTime(date.getTime() + (options.expires * 1000));
                        } else {
                            date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000))
                        }
                    } else {
                        date = options.expires;
                    }
                    expires = '; expires=' + date.toUTCString();
                }
                var path = options.path ? '; path=' + (options.path) : '';
                var domain = options.domain ? '; domain=' + (options.domain) : '';
                var secure = options.secure ? '; secure' : '';
                document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
            } else {
                var cookieValue = '';
                if (document.cookie && document.cookie != '') {
                    var cookies = document.cookie.split(';');
                    for (var i = 0; i < cookies.length; i++) {
                        cookie = cookies[i].replace(/^\s+|\s+$/g, '');
                        if (cookie.substring(0, name.length + 1) == (name + '=')) {
                            cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                            break;
                        }
                    }
                }
                return cookieValue;
            }
        },

        CookieValue: function (cookieName) {
            return this._Cookie(cookieName);
        },
        
        CookieForgetMeWrite: function (name, value) {
            this._Cookie(name, value, { path: '/' });
        },

        CookieWrite: function (name, value, expires) {
            this._Cookie(name, value, { path: '/', expires: expires });
        },

        CookieSessionWrite: function (name, value, expires) {
            this._Cookie(name, value, { path: '/', expires: expires, domain: '.xxsy.net' });
        },

        CookieTimerWrite: function (name, value, expires, model) {
            this._Cookie(name, value, { path: '/', expires: expires, model: model });
        },


        NumberFormat: function (number) {
            var number = parseInt(number);
            if (number > 10000) return parseInt(number / 10000) + "万";
            return number + "";
        },

        goBack: function () {
            if (document.referrer == "") {
                location.href = "/Page/Default?stat_page=1_home_p1";
                return;
            }
            history.go(-1);
        },

        /*短介绍*/
        GetShortIntro: function (Intro) {
            var value = "";
            if (Intro != "" && Intro) {
                var pattern = eval(/<[^>]+>|\s+|http[a-z0-9\\\/\&\?\:\.\%]+|\&[\w\d]{2,6}\;|\*+/g);

                value = Intro.replace(eval(pattern), "");
                if (value.length > 30) {
                    value = value.substring(0, 30) + "...";
                }
            }
            return value;
        },

        //判断用户名是否合法
        CheckName: function (nickname) {
            if (nickname.length < 3 || nickname.length > 12) {
                return "用户名长度只能在3-12位字符之间";
            }

            if (/^[(0-9A-Za-z)(\u4e00-\u9fa5)]{2,}$/ig.test(nickname) == false) {
                return "用户名只能由汉字、字母、数字组成";
            }

            if (/^1[3|4|5|8]\d{9}$/.test(nickname) == true) {
                return "用户名不能为手机号（11位数字），请修改";
            }
            return "";
        },

        //判断密码是否合法
        CheckPassWord: function (password) {
            if (password == "") {
                return "请设置新密码";
            }

            if (/^[0-9a-zA-Z]*$/g.test(password) == false) {
                return "密码只能由字母、数字组成";
            }

            if (password.length < 6 || password.length > 20) {
                return "密码长度只能在6-20位字符之间";
            }                       

            if (/^[0-9]*$/g.test(password) == true || /^[a-zA-Z]*$/g.test(password) == true) {
                if (this.CheckSameOrContinue(password) == true) {
                    return "密码太简单，试试字母+数字组合";
                }
            }
            return "";
        },

        //判断是否是相同或连续数字/字母
        CheckSameOrContinue: function (checkValue) {
            var passarr = checkValue.split("");
            //正序
            if (/^(?:(?!a[ac-z]|b[abd-z]|c[a-ce-z]|d[a-df-z]|e[a-eg-z]|f[a-fh-z]|g[a-gi-z]|h[a-hj-z]|i[a-ik-z]|j[a-jl-z]|k[a-km-z]|l[a-ln-z]|m[a-mo-z]|n[a-np-z]|o[a-oq-z]|p[a-pr-z]|q[a-qs-z]|r[a-rt-z]|s[a-su-z]|t[a-tv-z]|u[a-uw-z]|v[a-vxyz]|w[a-wyz]|x[a-xz]|y[a-y]|z[a-z]|0[02-9]|1[013-9]|2[0-24-9]|3[0-35-9]|4[0-46-9]|5[0-57-9]|6[0-689]|7[0-79]|8[0-8]|9[0-9])[a-z\d])+$/g.test(checkValue) == true) {
                return true;
            }
            //倒序
            checkValue = passarr.reverse().join("");
            if (/^(?:(?!a[ac-z]|b[abd-z]|c[a-ce-z]|d[a-df-z]|e[a-eg-z]|f[a-fh-z]|g[a-gi-z]|h[a-hj-z]|i[a-ik-z]|j[a-jl-z]|k[a-km-z]|l[a-ln-z]|m[a-mo-z]|n[a-np-z]|o[a-oq-z]|p[a-pr-z]|q[a-qs-z]|r[a-rt-z]|s[a-su-z]|t[a-tv-z]|u[a-uw-z]|v[a-vxyz]|w[a-wyz]|x[a-xz]|y[a-y]|z[a-z]|0[02-9]|1[013-9]|2[0-24-9]|3[0-35-9]|4[0-46-9]|5[0-57-9]|6[0-689]|7[0-79]|8[0-8]|9[0-9])[a-z\d])+$/g.test(checkValue) == true) {
                return true;
            }
            //是否是相同数字或相同字母            
            var sametest = passarr[0];
            for (var i = 1; i < passarr.length; i++) {
                if (sametest != passarr[i]) return false;
            }
            return true;
        },

        //判断是否是是强密码
        CheckPassStrong: function (checkValue) {
            if (checkValue.length < 6)
                return false;

            if (/^[0-9]*$/g.test(checkValue) == true || /^[a-zA-Z]*$/g.test(checkValue) == true) {
                if (this.CheckSameOrContinue(checkValue) == true) {
                    return false;
                }
            }
            return true;
        },

        //判断手机号
        CheckMobileCode: function (mobile, code) {
            if (mobile.match(/^1\d{10}$/)) {
                if (mobile.indexOf(code) >= 0)
                    return false;
            }
            return true;
        },
        
        //判断昵称是否合法
        CheckNickName: function (nickname) {
            if (nickname.length < 3 || nickname.length > 12) {
                return "昵称长度只能在3-12位字符之间";
            }

            if (/^[(0-9A-Za-z)(\u4e00-\u9fa5)]{2,}$/ig.test(nickname) == false) {
                return "昵称只能由汉字、字母、数字组成";
            }

            if (/^[0-9]*$/g.test(nickname) == true) {
                return "昵称不能为纯数字";
            }
            return "";
        },

        /*输入框*/
        SetInputClear: function (){
            $("input").bind({
                input: function () {
                    if ($(this).val() != "") {
                        $(this).parent().find(".clearinput").remove();
                        $(this).parent('.form').append('<span class="clearinput"></span');
                    } else {
                        $(this).parent().find(".clearinput").remove();
                    }
                }
            });
            
            $(".form").on('click', '.clearinput', function () {
                $(this).parent().find('.text').val('');
                $(this).remove();
            });
        },

        /*判断手机系统*/
        GetMobileUa:function(){
            var ua = navigator.userAgent.toLowerCase();
            if (ua.indexOf("mac os") > -1) {
                return "ios";
            } else {
                return "android";
            }
        }       
        
    };

    /*移除数组元素 @index:数组索引*/
    Array.prototype.remove = function (index) {
        if (index < 0) return this;
        return this.slice(0, index).concat(this.slice(index + 1, this.length));
    };

})();

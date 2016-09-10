/// <reference path="jQuery.Min.js" />
/// <reference path="xxsy.js" />
/// <reference path="Site.js" />
/// <reference path="zbox.js" />

(function () {

    window.Reader = {

        _Args: {

            UserID: 0,
            BookID: 0,
            BookName: "",
            CID: 0,
            Chapter: {},
            FontSize: 16, // 正文字号：14px 16px 18px 20px 22px 默认：16px
            LineHeight: 30, // 行间距：正文字号 + 行间距增加值 默认：30px
            LineHeightAdd: 14, // 行间距增加值：8px 14px 20px 默认：14px
            PaddingHeight: 10, // 段间距：10px
            ChapterFontSize: 26, // 章节字号=正文字号+8px
            ChapterLineHeight: 36, // 章节行间距=章节字号+10px
            ChapterContentSize: 30, // 章节名与正文间距为30px
            Pages: [],
            Index: 0,
            ScreenW: $(window).width(),
            ScreenH: $(window).height(),
            ServerNo: 1,
            IsHis: 1,
            ChapterSource: 0,
            IsShowDefaultEvent: 1,
            IsLoading: 0,
            IsChapterList: 0,
            MemberPages: "",
            MemberIndex: 0,
            IsMemberPages: 0,
            IsChanging: 0,
            Stat_Page: "",
            LastIsNotice: 0,
            SubChapterId: 0,
            CoinLess: 0,
            Collection: 0 //是否收藏 0：未收藏 1：收藏
        },

        _queryString: function (argName) {
            var value = '';
            var rgx = new RegExp('(^|&)' + argName + '=([^&]*)($|&)', 'i');
            var match = location.search.substr(1).match(rgx);
            if (match != null) {
                value = decodeURIComponent(match[2]);
            }
            return value;
        },

        _Alert: function (msg, callback) {
            var htm = [
                '<div id="_ReadAlert" class="netAnomaly">',
                '    <div class="text">' + msg + '</div>',
                '    <div class="filter"></div>',
                '</div>'
            ];

            $("#_ReadAlert").remove();
            $(htm.join("")).appendTo("body");

            var box = $("#_ReadAlert");

            setTimeout(function () {
                $("#_ReadAlert").remove();
                if (typeof callback == "function") {
                    callback();
                }
            }, 2000);
        },

        _GetClientId: function () {
            var S4 = function () {
                return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
            };
            var date = new Date();
            var str = date.getFullYear().toString();
            str += (date.getMonth() + 1).toString();
            str += date.getDate().toString();
            str += date.getHours().toString();
            str += date.getMinutes().toString();
            str += date.getSeconds().toString();
            return str + (S4() + S4() + S4() + S4() + S4() + S4() + S4() + S4());
        },

        _SetPagesNew: function () {

            var maxX = parseInt((this._Args.ScreenW - 10) / this._Args.FontSize);
            //var maxY = parseInt((this._Args.ScreenH - 40) / this._Args.LineHeight);
            var sumY = 0;
            var padding = parseInt((this._Args.ScreenW - 10 - maxX * this._Args.FontSize) / 2) + 5;
            $(".ctx").css({ padding: "0 " + padding + "px" });

            var titlemaxX = parseInt((this._Args.ScreenW - padding * 2) / this._Args.ChapterFontSize);

            //第一行是否有缩进
            var newPart = 0;
            if (this._Args.Pages[this._Args.Index].substring(0, 5) == "<p>　　") {
                newPart = 1;
            }

            if (this._Args.IsMemberPages == 1) {
                this._Args.Pages[this._Args.MemberIndex] = this._Args.MemberPages;
            }

            var beforearrtext = "";
            var lastpagetext = "";
            var afterarrtext = "";
            var temp = [];
            var before = this._Args.Pages.slice(0, this._Args.Index).join("").replace(/<p\s*data-title[\s\S]*?\/p>/gi, "");
            var after = this._Args.Pages.slice(this._Args.Index).join("").replace(/<p\s*data-title[\s\S]*?\/p>/gi, "");
            var beforearr = before.replace(/<([\/]?)(p)((:?\s*)(:?[^>]*)(:?\s*))>/gi, "").split("　　");
            var afterarr = after.replace(/<([\/]?)(p)((:?\s*)(:?[^>]*)(:?\s*))>/gi, "").split("　　");
            this._Args.Pages = [];
            this._Args.MemberPages = "";

            var chaptertitie = this._Args.Chapter.Title;

            var newTop = 1;//是否有标题 0:有 1:没有 默认1

            //标题处理
            if (chaptertitie && chaptertitie != '') {
                newTop = 0;
                var rows = Math.ceil(chaptertitie.length / titlemaxX);
                for (var j = 0; j < rows ; j++) {
                    if (sumY + Reader._Args.ChapterFontSize >= this._Args.ScreenH - 40) {
                        this._Args.Pages.push(temp.join(""));
                        temp = [];
                        sumY = 0;
                    }
                    if (j == 0) {
                        temp.push(
                            "<p data-title='title' style='padding-bottom:" + Reader._Args.ChapterContentSize + "px;'></p>"
                        );
                        sumY += Reader._Args.ChapterContentSize;
                    }
                    sumY += Reader._Args.ChapterFontSize;
                    if (j < rows - 1) {
                        temp.push(
                            "<p data-title='title' style='font-size:" + Reader._Args.ChapterFontSize + "px;line-height:" + Reader._Args.ChapterLineHeight + "px;'>" + chaptertitie.substring(j * titlemaxX, (j + 1) * titlemaxX) + "</p>"
                        );
                    } else {
                        temp.push(
                            "<p data-title='title' style='font-size:" + Reader._Args.ChapterFontSize + "px;line-height:" + Reader._Args.ChapterLineHeight + "px;padding-bottom:" + Reader._Args.ChapterContentSize + "px;'>" + chaptertitie.substring(j * titlemaxX, (j + 1) * titlemaxX) + "</p>"
                        );
                        sumY += Reader._Args.ChapterContentSize;
                    }
                }
            }

            var newpadding = 1;//是否设置段间距 0:设置 1:不设 默认1

            var newbefore = 1;//是否除了标题之外前一页还有处理 0:处理 1:未处理 默认1

            //前面页的处理
            if (beforearr.length > 0) {
                for (var i = 0; i < beforearr.length ; i++) {
                    if (beforearr[i] != "") {
                        if (newTop != 0) {//不是标题下面加一个段间距
                            sumY += Reader._Args.PaddingHeight;
                            newpadding = 0;
                        }
                        newTop = 1;

                        beforearrtext = "　　" + beforearr[i];
                        var rows = Math.ceil(beforearrtext.length / maxX);
                        for (var j = 0; j < rows ; j++) {
                            if (sumY + Reader._Args.LineHeight >= this._Args.ScreenH - 40) {
                                this._Args.Pages.push(temp.join(""));
                                temp = [];
                                sumY = 0;
                                newpadding = 1;
                            }
                            sumY += Reader._Args.LineHeight;
                            if (newpadding != 0) {
                                temp.push(
                                    "<p>" + beforearrtext.substring(j * maxX, (j + 1) * maxX) + "</p>"
                                );
                            } else {
                                temp.push(
                                    "<p style='padding-top:" + Reader._Args.PaddingHeight + "px;'>" + beforearrtext.substring(j * maxX, (j + 1) * maxX) + "</p>"
                                );
                            }

                            newpadding = 1;
                            newbefore = 0;
                        }
                    }
                }

                //前一页的处理
                if (temp.length > 0 && newbefore == 0) {

                    sumY = 0;
                    newpadding = 1;
                    newTop = 0;//前一页第一次无需行高

                    this._Args.MemberPages = temp.join("");
                    this._Args.IsMemberPages = 1;
                    this._Args.MemberIndex = this._Args.Pages.length;

                    var lasttext = temp.join("").replace(/<p\s*data-title[\s\S]*?\/p>/gi, "").replace(/<([\/]?)(p)((:?\s*)(:?[^>]*)(:?\s*))>/gi, "");
                    if (newPart == 1) {
                        lasttext = lasttext + "　　" + after.replace(/<([\/]?)(p)((:?\s*)(:?[^>]*)(:?\s*))>/gi, "");
                    } else {
                        lasttext = lasttext + after.replace(/<([\/]?)(p)((:?\s*)(:?[^>]*)(:?\s*))>/gi, "");
                    }

                    var isnewPart = 0;
                    if (temp[0].substring(0, 5) == "<p>　　") {
                        isnewPart = 1;
                    }
                    temp = [];

                    if (this._Args.MemberIndex == 0) {//插入标题
                        if (chaptertitie && chaptertitie != '') {
                            newTop = 0;
                            var rows = Math.ceil(chaptertitie.length / titlemaxX);
                            for (var j = 0; j < rows ; j++) {
                                if (sumY + Reader._Args.ChapterFontSize >= this._Args.ScreenH - 40) {
                                    this._Args.Pages.push(temp.join(""));
                                    temp = [];
                                    sumY = 0;
                                }
                                if (j == 0) {
                                    temp.push(
                                        "<p data-title='title' style='padding-bottom:" + Reader._Args.ChapterContentSize + "px;'></p>"
                                    );
                                    sumY += Reader._Args.ChapterContentSize;
                                }
                                sumY += Reader._Args.ChapterFontSize;
                                if (j < rows - 1) {
                                    temp.push(
                                        "<p data-title='title' style='font-size:" + Reader._Args.ChapterFontSize + "px;line-height:" + Reader._Args.ChapterLineHeight + "px;'>" + chaptertitie.substring(j * titlemaxX, (j + 1) * titlemaxX) + "</p>"
                                    );
                                } else {
                                    temp.push(
                                        "<p data-title='title' style='font-size:" + Reader._Args.ChapterFontSize + "px;line-height:" + Reader._Args.ChapterLineHeight + "px;padding-bottom:" + Reader._Args.ChapterContentSize + "px;'>" + chaptertitie.substring(j * titlemaxX, (j + 1) * titlemaxX) + "</p>"
                                    );
                                    sumY += Reader._Args.ChapterContentSize;
                                }
                            }
                        }
                    }

                    var lastarr = lasttext.split("　　");
                    if (lastarr.length > 0) {
                        for (var i = 0; i < lastarr.length ; i++) {
                            if (lastarr[i] != "") {
                                if (newTop != 0) {//不是标题下面加一个段间距
                                    sumY += Reader._Args.PaddingHeight;
                                    newpadding = 0;
                                }
                                newTop = 1;

                                if (i == 0 && isnewPart != 1) {
                                    lastpagetext = lastarr[i];
                                } else {
                                    lastpagetext = "　　" + lastarr[i];
                                }
                                var rows = Math.ceil(lastpagetext.length / maxX);
                                for (var j = 0; j < rows ; j++) {
                                    if (sumY + Reader._Args.LineHeight >= this._Args.ScreenH - 40) {
                                        break;
                                    }
                                    sumY += Reader._Args.LineHeight;
                                    if (newpadding != 0) {
                                        temp.push(
                                            "<p>" + lastpagetext.substring(j * maxX, (j + 1) * maxX) + "</p>"
                                        );
                                    } else {
                                        temp.push(
                                            "<p style='padding-top:" + Reader._Args.PaddingHeight + "px;'>" + lastpagetext.substring(j * maxX, (j + 1) * maxX) + "</p>"
                                        );
                                    }

                                    newpadding = 1;
                                }
                            }
                        }
                    }
                    this._Args.Pages.push(temp.join(""));
                    sumY = 0;
                    newpadding = 1;
                    newTop = 0;
                }
            }

            //当前页index
            if (newbefore == 1) {
                Reader._Args.Index = 1;
            } else {
                Reader._Args.Index = this._Args.Pages.length + 1;
                temp = [];
            }

            //后面页的处理
            if (afterarr.length > 0) {
                for (var i = 0; i < afterarr.length ; i++) {
                    if (afterarr[i] != "") {
                        if (newTop != 0) {//不是标题下面加一个段间距
                            sumY += Reader._Args.PaddingHeight;
                            newpadding = 0;
                        }
                        newTop = 1;

                        if (i == 0 && newPart != 1) {
                            afterarrtext = afterarr[i];
                        } else {
                            afterarrtext = "　　" + afterarr[i];
                        }

                        var rows = Math.ceil(afterarrtext.length / maxX);
                        for (var j = 0; j < rows ; j++) {
                            if (sumY + Reader._Args.LineHeight >= this._Args.ScreenH - 40) {
                                this._Args.Pages.push(temp.join(""));
                                temp = [];
                                sumY = 0;
                                newpadding = 1;
                            }
                            sumY += Reader._Args.LineHeight;
                            if (newpadding != 0) {
                                temp.push(
                                    "<p>" + afterarrtext.substring(j * maxX, (j + 1) * maxX) + "</p>"
                                );
                            } else {
                                temp.push(
                                    "<p style='padding-top:" + Reader._Args.PaddingHeight + "px;'>" + afterarrtext.substring(j * maxX, (j + 1) * maxX) + "</p>"
                                );
                            }

                            newpadding = 1;
                        }
                    }
                }
                if (temp.length > 0) {
                    this._Args.Pages.push(temp.join(""));
                }
            }
        },

        _SetPages: function (content,title) {

            var maxX = parseInt((this._Args.ScreenW - 10) / this._Args.FontSize);
            //var maxY = parseInt((this._Args.ScreenH - 40) / this._Args.LineHeight);
            var sumY = 0;

            var padding = parseInt((this._Args.ScreenW - 10 - maxX * this._Args.FontSize) / 2) + 5;
            $(".ctx").css({ padding: "0 " + padding + "px" });

            var titlemaxX = parseInt((this._Args.ScreenW - padding * 2) / this._Args.ChapterFontSize);
            $('.ctx').html(content);
            //var arr = this._Args.Chapter.content.split(/\<p[^>]*\>/gi);
            //
            //var chaptertitie = title;
            //alert(chaptertitie+'dsa');
            //var temp = [];
            //
            //this._Args.Pages = [];
            //
            //var newTop = 1;//是否有标题 0:有 1:没有 默认1
            //
            ////标题处理
            //if (chaptertitie && chaptertitie != '') {
            //    newTop = 0;
            //    var rows = Math.ceil(chaptertitie.length / titlemaxX);
            //    for (var j = 0; j < rows ; j++) {
            //        if (sumY + Reader._Args.ChapterFontSize >= this._Args.ScreenH - 40) {
            //            this._Args.Pages.push(temp.join(""));
            //            temp = [];
            //            sumY = 0;
            //        }
            //        if (j == 0) {
            //            temp.push(
            //                "<p data-title='title' style='padding-bottom:" + Reader._Args.ChapterContentSize + "px;'></p>"
            //            );
            //            sumY += Reader._Args.ChapterContentSize;
            //        }
            //        sumY += Reader._Args.ChapterFontSize;
            //        if (j < rows - 1) {
            //            temp.push(
            //                "<p data-title='title' style='font-size:" + Reader._Args.ChapterFontSize + "px;line-height:" + Reader._Args.ChapterLineHeight + "px;'>" + chaptertitie.substring(j * titlemaxX, (j + 1) * titlemaxX) + "</p>"
            //            );
            //        } else {
            //            temp.push(
            //                "<p data-title='title' style='font-size:" + Reader._Args.ChapterFontSize + "px;line-height:" + Reader._Args.ChapterLineHeight + "px;padding-bottom:" + Reader._Args.ChapterContentSize + "px;'>" + chaptertitie.substring(j * titlemaxX, (j + 1) * titlemaxX) + "</p>"
            //            );
            //            sumY += Reader._Args.ChapterContentSize;
            //        }
            //    }
            //}
            //
            //var newpadding = 1;//是否设置段间距 0:设置 1:不设 默认1

            //for (var i = 0; i < arr.length ; i++) {
            //    if (arr[i] != "") {
            //        if (newTop != 0) {//不是标题下面加一个段间距
            //            sumY += Reader._Args.PaddingHeight;
            //            newpadding = 0;
            //        }
            //        newTop = 1;
            //        var rows = Math.ceil(arr[i].length / maxX);
            //        for (var j = 0; j < rows ; j++) {
            //            if (sumY + Reader._Args.LineHeight >= this._Args.ScreenH - 40) {
            //                this._Args.Pages.push(temp.join(""));
            //                temp = [];
            //                sumY = 0;
            //                newpadding = 1;
            //            }
            //            sumY += Reader._Args.LineHeight;
            //            if (newpadding != 0) {
            //                temp.push(
            //                    "<p>" + arr[i].substring(j * maxX, (j + 1) * maxX) + "</p>"
            //                );
            //            } else {
            //                temp.push(
            //                    "<p style='padding-top:" + Reader._Args.PaddingHeight + "px;'>" + arr[i].substring(j * maxX, (j + 1) * maxX) + "</p>"
            //                );
            //            }
            //
            //            newpadding = 1;
            //        }
            //    }
            //}
            //
            //if (temp.length > 0) {
            //    this._Args.Pages.push(temp.join(""));
            //}
        },

        _GetChapter: function (id, notdefault, callback, isnext, BookId) {

            Util.Loading();
            Reader._Args.IsLoading = 1;
            Reader._Args.IsMemberPages = 0;

            var clientid = Util.CookieValue("CLIENTID");
            if (clientid == "") {
                clientid = this._GetClientId();
                Util.CookieWrite("CLIENTID", clientid, 9999);
            }

            ajaxService("getChapterData.html", "chapter_getdetail", { chapterid: id, bookId: _bookid},
                function (response, status) {

                    Util.LoadingClear();
                    //超时
                    Reader._Args.IsLoading = 0;
                    //未正常获取到章节
                    if (response.Code != 0) {

                        //隐藏订阅区域
                        Reader.HideSubscribeInfo();

                        //章节不存在
                        if (response.Code == 4 || response.Code == 13) {
                            Reader._Alert("章节不存在");
                            return;
                        }
                    }
                    var result = response.content;
                    Reader._Args.Chapter = result;
                    Reader._Args.Chapter.Title=response.title;
                    if (result != null) {
                        //if (Reader._Args.SubChapterId > 0) {
                        //    $("#forsubscribe").hide();
                        //    $(".valfail").hide();
                        //    Reader._Args.SubChapterId = 0;
                        //}
                        //
                        ////成功获取章节
                        //Reader._Args.ChapterSource = 0;
                        //if (result.IsChanging == 1) {
                        //    result.Content = "";
                        //}
                        Reader._Args.Chapter = result;

                        //下一章是公告章节
                        //if (Reader._Args.LastIsNotice == 0 && isnext == 1 && parseInt(Reader._Args.Chapter.VolumeId) == 999999) {
                        //    location.href = "/Page/EndContent?bookid=" + Reader._Args.BookID;
                        //    return;
                        //}
                        //
                        ////隐藏订阅区域
                        Reader.HideSubscribeInfo();
                        //
                        //if (parseInt(Reader._Args.Chapter.VolumeId) == 999999)
                        //    Reader._Args.LastIsNotice = 1;
                        //
                        //Reader._Args.IsChanging = result.IsChanging;
                        Reader._SetPages(result,'dsadsa');
                        //Reader._SetHistoryPageIndex(Reader._Args.Chapter.Id, Reader._Args.Index);
                        //if (typeof callback == "function") {
                        //    callback();
                        //}

                        // 引导
                        var _hasshow = Util.CookieValue("SHOW_READ_GUIDE");
                        if (!_hasshow || _hasshow == "") {
                            Reader.ShowGuide();
                        }
                    } else {
                        Reader._Alert("章节不存在");
                    }
                    Util.LoadingClear();
                });
        },

        _GetHistoryPageIndex: function () {

            var item = { chapterid: 0, index: 0 };
            var cval = Util.CookieValue("READ_HISTORY");

            if (cval != "") {
                var items = cval.split("|");
                for (var i = 0; i < items.length; i++) {
                    var arr = items[i].split(",");
                    if (arr.length == 3) {
                        if (this._Args.IsChapterList == 1) {
                            if (parseInt(arr[0]) == Reader._Args.BookID && parseInt(arr[1]) == Reader._Args.CID) {
                                item.chapterid = parseInt(arr[1]);
                                item.index = parseInt(arr[2]);
                                break;
                            }
                        } else {
                            if (parseInt(arr[0]) == Reader._Args.BookID) {
                                item.chapterid = parseInt(arr[1]);
                                item.index = parseInt(arr[2]);
                                break;
                            }
                        }
                    }
                }
            }

            return item;
        },

        _SetHistoryPageIndex: function (cid, index) {

            if (parseInt(Reader._Args.Chapter.VolumeId) == 999999)
                return;

            var max = 20;
            var expires = 999;

            var value = this._Args.BookID + "," + cid + "," + index;
            var cval = Util.CookieValue("READ_HISTORY");
            if (cval == "") {
                Util.CookieWrite("READ_HISTORY", value, expires);
                return;
            }
            var temp = [value];
            var items = cval.split("|");
            for (var i = 0; i < items.length; i++) {

                if (temp.length >= max) {
                    break;
                }

                var arr = items[i].split(",");
                if (arr.length == 3) {
                    if (parseInt(arr[0]) != Reader._Args.BookID) {
                        temp.push(items[i]);
                    }
                }
            }

            Util.CookieWrite("READ_HISTORY", temp.join("|"), expires);

        },

        _ShowDefault: function () {

            if (this._Args.IsHis == 1) {

                var his = this._GetHistoryPageIndex();
                if (his.chapterid != 0) {
                    this._Args.CID = his.chapterid;
                    this._Args.Index = his.index;
                }
            }

            this._GetChapter(this._Args.CID, 0,
                function () {
                    if (Reader._Args.Index > Reader._Args.Pages.length - 1) {
                        Reader._Args.Index = Reader._Args.Pages.length - 1;
                    }

                    if (Reader._Args.Index == 0) {
                        $("#currentPage").find("h3").html(Reader._Args.BookName);// + Reader._Args.Chapter.Title
                    } else {
                        $("#currentPage").find("h3").html(Reader._Args.Chapter.Title);
                    }
                    if (Reader._Args.IsChanging == 1) {
                        var htm = ['<p style="text-align: center;margin-top: 20%;font-size:17px;font-weight:bold">' + Reader._Args.Chapter.Title + '</p>',
                                    '<p style="text-align: center;margin-top: 10px;font-size:14px;">作者正在修改本章</p>',
                                    '<p style="text-align: center;margin-top: 5px;font-size:14px;">小主请谅解！</p>']
                        $("#currentPage").find(".ctx").html(htm.join(""));
                        $("#currentPage").find("em").html("1/1");
                    } else {
                        $("#currentPage").find(".ctx").html(Reader._Args.Pages[Reader._Args.Index]);
                        $("#currentPage").find("em").html((Reader._Args.Index + 1) + "/" + Reader._Args.Pages.length);
                    }

                }, 0);
        },

        _ShowPreviousPage: function (_setChapter) {

            if (this._Args.Index <= 0 && this._Args.Chapter.PreviousId == 0) {
                Reader._Alert("已到达第一章");
                return;
            }

            var currentPage = $("#currentPage");
            var nextPage = $("#nextPage");
            nextPage.css({ zIndex: 6, left: (0 - this._Args.ScreenW) + "px" });

            if (this._Args.Index <= 0) {

                this._GetChapter(this._Args.Chapter.PreviousId, 1
                    , function () {

                        var cp = $("#currentPage");
                        var np = nextPage = $("#nextPage");

                        if (_setChapter == 1) {
                            if (Reader._Args.IsChanging == 1) {
                                Reader._Args.Index = 0;
                            } else {
                                Reader._Args.Index = 1;
                            }
                        } else {
                            Reader._Args.Index = Reader._Args.Pages.length;
                        }

                        if (Reader._Args.Index <= 1) {
                            np.find("h3").html(Reader._Args.BookName);// + Reader._Args.Chapter.Title
                        } else {
                            np.find("h3").html(Reader._Args.Chapter.Title);
                        }

                        if (Reader._Args.IsChanging == 1) {
                            var htm = ['<p style="text-align: center;margin-top: 20%;font-size:17px;font-weight:bold">' + Reader._Args.Chapter.Title + '</p>',
                                        '<p style="text-align: center;margin-top: 10px;font-size:14px;">作者正在修改本章</p>',
                                        '<p style="text-align: center;margin-top: 5px;font-size:14px;">小主请谅解！</p>']
                            np.find(".ctx").html(".ctx").html(htm.join(""));
                            np.find("em").html("1/1");
                        } else {
                            np.find("em").html(Reader._Args.Index + "/" + Reader._Args.Pages.length);
                            if (Reader._Args.Pages.length > 0) {
                                np.find(".ctx").html(Reader._Args.Pages[--Reader._Args.Index]);
                            } else {
                                np.find(".ctx").html("");
                            }
                        }

                        np.stop().animate({ left: 0 }
                            , 150, function () {
                                cp.css({ zIndex: 4 }).attr({ id: "nextPage" });
                                np.css({ zIndex: 5 }).attr({ id: "currentPage" });
                            });

                        Reader._SetHistoryPageIndex(
                            Reader._Args.Chapter.Id, Reader._Args.Index
                            );

                    }, 0);
                return;
            }

            if (Reader._Args.Index <= 1) {
                nextPage.find("h3").html(Reader._Args.BookName);
            } else {
                nextPage.find("h3").html(Reader._Args.Chapter.Title);
            }
            nextPage.find("em").html(Reader._Args.Index + "/" + Reader._Args.Pages.length);
            nextPage.find(".ctx").html(Reader._Args.Pages[--Reader._Args.Index]);

            nextPage.stop().animate({ left: 0 }
                , 150, function () {
                    currentPage.css({ zIndex: 4 }).attr({ id: "nextPage" });
                    nextPage.css({ zIndex: 5 }).attr({ id: "currentPage" });
                });

            Reader._SetHistoryPageIndex(
                Reader._Args.Chapter.Id, Reader._Args.Index
                );
        },

        _ShowNextPage: function () {

            if (this._Args.Index >= this._Args.Pages.length - 1 && this._Args.Chapter.NextId == 0) {
                location.href = "/Page/EndContent?bookid=" + this._Args.BookID;
                //Reader._Alert("已是最后一章");
                return;
            }

            var currentPage = $("#currentPage");
            var nextPage = $("#nextPage");
            nextPage.css({ zIndex: 4, left: 0 });

            if (this._Args.Index >= Reader._Args.Pages.length - 1) {

                this._GetChapter(this._Args.Chapter.NextId, 1
                    , function () {

                        var cp = $("#currentPage");
                        var np = nextPage = $("#nextPage");

                        Reader._Args.Index = 0;

                        np.find("h3").html(Reader._Args.BookName);// + Reader._Args.Chapter.Title

                        if (Reader._Args.IsChanging == 1) {
                            var htm = ['<p style="text-align: center;margin-top: 20%;font-size:17px;font-weight:bold">' + Reader._Args.Chapter.Title + '</p>',
                                        '<p style="text-align: center;margin-top: 10px;font-size:14px;">作者正在修改本章</p>',
                                        '<p style="text-align: center;margin-top: 5px;font-size:14px;">小主请谅解！</p>']
                            np.find(".ctx").html(".ctx").html(htm.join(""));
                            np.find("em").html("1/1");
                        } else {
                            if (Reader._Args.Pages.length > 0) {
                                np.find("em").html((Reader._Args.Index + 1) + "/" + Reader._Args.Pages.length);
                                np.find(".ctx").html(Reader._Args.Pages[Reader._Args.Index]);
                            } else {
                                np.find("em").html(0 + "/" + Reader._Args.Pages.length);
                                np.find(".ctx").html("");
                            }
                        }

                        cp.stop().animate({ left: (0 - Reader._Args.ScreenW) + "px" }
                            , 200, function () {
                                cp.attr({ id: "nextPage" });
                                np.css({ zIndex: 5 }).attr("id", "currentPage");
                            });

                        var currentleft = np.offset().left;
                        if (currentleft < 0) {
                            np.css({ left: "0px" });
                        }

                        Reader._SetHistoryPageIndex(
                            Reader._Args.Chapter.Id, Reader._Args.Index
                            );

                    }, 1);
                return;
            }

            nextPage.find("h3").html(Reader._Args.Chapter.Title);
            nextPage.find("em").html((Reader._Args.Index + 2) + "/" + Reader._Args.Pages.length);
            nextPage.find(".ctx").html(Reader._Args.Pages[++Reader._Args.Index]);

            currentPage.stop().animate({ left: (0 - Reader._Args.ScreenW) + "px" }
                , 200, function () {
                    currentPage.attr({ id: "nextPage" });
                    nextPage.css({ zIndex: 5 }).attr("id", "currentPage");
                });

            Reader._SetHistoryPageIndex(
                Reader._Args.Chapter.Id, Reader._Args.Index
                );
        },

        _ShowMenu: function () {

            var dis = $(".menuTop").css("display");

            if (dis.toLowerCase() == "none") {
                $(".menuTop,.menuBottom").show();

                _czc.push(["_trackEvent", '阅读页', '呼出菜单']);//cnzz 统计
                return;
            }

            $(".menuTop,.menuBottom").hide();
            Reader._ShowSetBox($('#chapterset,#menuset'));
        },

        _ShowPreviousChapter: function () {

            if (this._Args.Chapter.PreviousId == 0) {
                Reader._Alert("已到达第一章");
                return;
            }

            this._Args.Index = 0;
            this._ShowPreviousPage(1);
        },

        _ShowNextChapter: function () {

            if (this._Args.Chapter.NextId == 0) {
                location.href = "/Page/EndContent?bookid=" + this._Args.BookID;
                //Reader._Alert("已到达最后一章");
                return;
            }

            this._Args.Index = this._Args.Pages.length - 1;
            this._ShowNextPage();
        },

        _ShowSendReviewBox: function () {
            Site.showSendReviewbox(
                Reader._Args.UserID, Reader._Args.BookID);
        },

        _ShowJiaYouBox: function () {
            zbox.show({ src: '/Page/SendGift?bookid=' + _bookid, width: '6.5rem', hEle: '.cheercontent' });
        },

        _ShowSetBox: function (Object) {
            Object.siblings('div').hide();
            Object.show();
        },

        _Collection: function () {//收藏
            Reader._Args.IsLoading = 1;

            if (Reader._Args.Collection == 0) {
                ajaxService("/Service/ServiceMethod", "book_addcollection", { userid: _userid, ids: _bookid },
                    function (res, status) {
                        Reader._Args.IsLoading = 0;

                        //超时
                        if (status == 1) {
                            Reader._Alert("网络连接异常，请稍后重试");
                            return;
                        }
                        //发生错误
                        if (status == 2) {
                            Reader._Alert("好像出问题了，请稍后重试");
                            return;
                        }

                        //成功
                        if (res.Code == 0) {
                            Reader._Args.Collection = 1;
                            Reader._Alert("收藏成功");
                            $("#collect").addClass("select");

                            _czc.push(['_trackEvent', '阅读页', '收藏本书']);//cnzz 统计
                        } else {
                            Reader._Alert(res.Message);
                        }
                    });
            } else {
                ajaxService("/Service/ServiceMethod", "book_deletebookcasebyids", { userid: _userid, ids: _bookid },
                    function (res, status) {
                        Reader._Args.IsLoading = 0;

                        //超时
                        if (status == 1) {
                            Reader._Alert("网络连接异常，请稍后重试");
                            return;
                        }
                        //发生错误
                        if (status == 2) {
                            Reader._Alert("好像出问题了，请稍后重试");
                            return;
                        }

                        //成功
                        if (res.Code == 0) {
                            Reader._Args.Collection = 0;
                            Reader._Alert("取消收藏成功");
                            $("#collect").removeClass("select");
                            _czc.push(['_trackEvent', '阅读页', '取消收藏本书']);//cnzz 统计
                        } else {
                            Reader._Alert(res.Message);
                        }
                    });
            }
        },

        // 初始化
        Init: function (options) {

            this._Args = $.extend(this._Args, options);
            //if (this._Args.BookName != "") { this._Args.BookName = this._Args.BookName + " → "; }

            $("#currentPage").after($("#currentPage").clone().css({ zIndex: 4 }).attr({ id: "nextPage" }));
            $(".read-wrapper").height(this._Args.ScreenH);

            // 设置订阅信息字体颜色
            var _colormode = Util.CookieValue("READER_MODE");
            if (_colormode == "1") {
                $(".readsubcribe").addClass("colorbbb");
            } else {
                var _dgcolor = 4;
                var _colorstyle = Util.CookieValue("READER_STYLE");
                if (_colorstyle != "") {
                    var _colorarr = _colorstyle.split("|");
                    if (_colorarr.length == 3) { _dgcolor = _colorarr[2]; }
                }
                if (_dgcolor == 12 || _dgcolor == 13 || _dgcolor == 14) {
                    $(".readsubcribe").addClass("colorbbb");
                }
            }

            // 绑定呼出菜单和上下页事件
            var emls = document.getElementsByClassName("read-wrapper");
            for (var i = 0; i < emls.length ; i++) {
                Reader.SetAreaFun(emls[i]);
            }
            // 订阅区
            Reader.SetAreaFun($("#chaptername")[0]);
            Reader.SetAreaFun($(".price")[0]);
            Reader.SetAreaFun($(".balance")[0]);
            Reader.SetAreaFun($(".thanks")[0]);
            Reader.SetAreaFun($(".fenge")[0]);
            Reader.SetAreaFun($(".autosubcribe span").not(".iconfont")[0]);

            // 绑定上菜单按钮事件
            $(".menuTop span").click(function () {
                var value = $(this).attr("data-value");
                switch (parseInt(value)) {
                    case 0:
                        _czc.push(['_trackEvent', '阅读页', '返回上一页']);
                        history.go(-1);
                        break;
                    case 1:
                        if (Reader._Args.UserID == 0) {
                            zbox.show({ src: '/InfoList/GetIframeLoginPage', width: '90%', height: '100%', hEle: '.cheercontent' },
                                function (uid) {
                                    setTimeout(function () {
                                        Reader._Args.UserID = uid;
                                        Reader._Collection();
                                    }, 200);
                                });
                        } else {
                            if (Reader._Args.IsLoading == 1) break;
                            Reader._Collection();
                        }
                        break;
                    case 2:
                        var dowmBox = $(".downloaddiv");
                        $("#moreSet").hide();
                        dowmBox.css("display") == "block" ? dowmBox.hide() : dowmBox.show();
                        break;
                    case 3:
                        var moreBox = $("#moreSet");
                        $(".downloaddiv").hide();
                        moreBox.css("display") == "block" ? moreBox.hide() : moreBox.show();

                        _czc.push(['_trackEvent', '阅读页', '更多 按钮']);//cnzz 统计
                        break;
                }
            });

            // 绑定下菜单按钮事件
            //1.章节设置
            $('#chapterset > span').click(function () {
                $('.downloaddiv,#moreSet').hide();
                var value = parseInt($(this).attr("data-value"));
                switch (value) {
                    case 0:
                        _czc.push(['_trackEvent', '阅读页', '上一章']);//cnzz 统计
                        Reader._ShowPreviousChapter();
                        break;
                    case 1:
                        _czc.push(['_trackEvent', '阅读页', '下一章']);//cnzz 统计
                        Reader._ShowNextChapter();
                        break;
                }
                return false;
            });

            //2.菜单设置
            $('#menuset > div').click(function () {
                $('.downloaddiv,#moreSet').hide();
                var value = parseInt($(this).attr("data-value"));
                switch (value) {
                    case 0:
                        _czc.push(['_trackEvent', '阅读页', '目录']);//cnzz 统计
                        var ahref = "/Page/ChapterList?stat_page=1_chapterlist_p2&bookid=" + Reader._Args.BookID;
                        if (parseInt(Reader._Args.Chapter.VolumeId) == 999999) {
                            ahref = ahref + "&shownotice=1";
                        }
                        location.href = ahref;
                        break;
                    case 1:
                        _czc.push(['_trackEvent', '阅读页', '评论']);//cnzz 统计
                        var ahref = "/Page/BookReview?stat_page=1_bookreview_p5&bookid=" + Reader._Args.BookID + "&bookname=" + Reader._Args.BookName;
                        location.href = ahref;
                        break;
                    case 2:
                        _czc.push(['_trackEvent', '阅读页', '加油']);//cnzz 统计
                        var ahref = "/Page/GiftRecord?stat_page=1_giftrecord_p3&bookid=" + Reader._Args.BookID + "&type=0";
                        location.href = ahref;
                        break;
                    case 3:
                        _czc.push(['_trackEvent', '阅读页', '设置按钮']);//cnzz 统计
                        var mode = Util.CookieValue("READER_MODE");
                        if (mode == "") { mode = "0"; }
                        if (mode == 0) {
                            $('#dayornight').addClass("icon-moon moon").removeClass('icon-31qing');
                        } else {
                            $('#dayornight').removeClass("icon-moon moon").addClass('icon-31qing');
                        }

                        var dv = 0;

                        var styles = Util.CookieValue("READER_STYLE");
                        if (styles != "") {
                            var arr = styles.split("|");
                            if (arr.length == 3) { dv = arr[2]; }
                        }

                        if (dv <= 3) {
                            $("#themeset [data-value=" + dv + "]").removeClass("celoption").parent().addClass("actived").siblings('div').removeClass("actived").children('span').addClass("celoption");
                        } else {
                            $('#themeset > div').removeClass("actived").children('span').addClass('celoption');
                        }

                        Reader._ShowSetBox($('.txtAdjustment'));
                        break;
                }
                return false;
            });

            //3.字体设置
            $('#fontset > span').click(function () {
                $('.downloaddiv,#moreSet').hide();
                if ($('.readsubcribe')[0].style.display == "block") return false;
                var value = parseInt($(this).attr("data-value"));

                switch (value) {
                    case 0:
                        _czc.push(['_trackEvent', '阅读页', '设置：字号变小']);//cnzz 统计
                        Reader.SetFontSize(-2);
                        break;
                    case 1:
                        _czc.push(['_trackEvent', '阅读页', '设置：字号变大']);//cnzz 统计
                        Reader.SetFontSize(2);
                        break;
                }
                return false;
            });

            //4.间距设置
            $('#lineset > span').click(function () {
                $('.downloaddiv,#moreSet').hide();
                if ($('.readsubcribe')[0].style.display == "block") return false;
                $(this).addClass('spacing-actived').siblings().removeClass('spacing-actived');

                var value = parseInt($(this).attr("data-value"));
                switch (value) {
                    case 0: _czc.push(['_trackEvent', '阅读页', '设置 间距：左一']); break;
                    case 1: _czc.push(['_trackEvent', '阅读页', '设置 间距：左二']); break;
                    case 2: _czc.push(['_trackEvent', '阅读页', '设置 间距：右一']); break;
                }

                var line = parseInt($(this).attr("data-line"));
                Reader.SetLineHeight(line);
                return false;
            });

            //5.模式设置
            $('#dayornight').click(function () {
                $('.downloaddiv,#moreSet').hide();
                var model = 0;
                if ($(this).hasClass('moon')) {
                    _czc.push(['_trackEvent', '阅读页', '设置主题：夜间模式']);
                    $(this).removeClass('icon-moon moon').addClass('icon-31qing')
                    model = 1;
                } else {
                    _czc.push(['_trackEvent', '阅读页', '设置主题：白日模式']);
                    $(this).addClass('icon-moon moon').removeClass('icon-31qing')
                }
                Reader.SetMode(model);
                return false;
            });

            //6.部分风格设置
            $('#themeset > div').click(function () {
                $('.downloaddiv,#moreSet').hide();
                $(this).addClass('actived').children('span').removeClass("celoption").parent().siblings('div').removeClass('actived').children('span').addClass("celoption");

                var value = parseInt($(this).children('span').attr("data-value"));
                switch (value) {
                    case 0: _czc.push(['_trackEvent', '阅读页', '设置主题：风格1']); break;
                    case 1: _czc.push(['_trackEvent', '阅读页', '设置主题：风格2']); break;
                    case 2: _czc.push(['_trackEvent', '阅读页', '设置主题：风格3']); break;
                    case 3: _czc.push(['_trackEvent', '阅读页', '设置主题：风格4']); break;
                }

                Reader.SetStyle($(this).children('span'));

                return false;
            });

            //7.跳转更多风格设置
            $('#thememore').click(function () {

                $('.downloaddiv,#moreSet').hide();
                var dv = 0;
                var styles = Util.CookieValue("READER_STYLE");
                if (styles != "") {
                    var arr = styles.split("|");
                    if (arr.length == 3) { dv = arr[2]; }
                }
                $("#allthemeset [data-value=" + dv + "]").removeClass("celoption").parent().addClass("actived").siblings('div').removeClass("actived").children('span').addClass("celoption");
                Reader._ShowSetBox($('#allthemeset'));
                _czc.push(['_trackEvent', '阅读页', '设置更多主题按钮']);
                return false;
            });

            //8.更多风格设置
            $('#allthemeset > div').click(function () {
                $('.downloaddiv,#moreSet').hide();
                $(this).addClass('actived').children('span').removeClass("celoption").parent().siblings('div').removeClass('actived').children('span').addClass("celoption");

                var value = parseInt($(this).children('span').attr("data-value"));
                switch (value) {
                    case 0: _czc.push(['_trackEvent', '阅读页', '设置主题：更多 风格1-1']); break;
                    case 1: _czc.push(['_trackEvent', '阅读页', '设置主题：更多 风格1-2']); break;
                    case 2: _czc.push(['_trackEvent', '阅读页', '设置主题：更多 风格1-3']); break;
                    case 3: _czc.push(['_trackEvent', '阅读页', '设置主题：更多 风格1-4']); break;
                    case 4: _czc.push(['_trackEvent', '阅读页', '设置主题：更多 风格1-5']); break;
                    case 5: _czc.push(['_trackEvent', '阅读页', '设置主题：更多 风格1-6']); break;
                    case 6: _czc.push(['_trackEvent', '阅读页', '设置主题：更多 风格2-1']); break;
                    case 7: _czc.push(['_trackEvent', '阅读页', '设置主题：更多 风格2-2']); break;
                    case 8: _czc.push(['_trackEvent', '阅读页', '设置主题：更多 风格2-3']); break;
                    case 9: _czc.push(['_trackEvent', '阅读页', '设置主题：更多 风格2-4']); break;
                    case 10: _czc.push(['_trackEvent', '阅读页', '设置主题：更多 风格2-5']); break;
                    case 11: _czc.push(['_trackEvent', '阅读页', '设置主题：更多 风格2-6']); break;
                    case 12: _czc.push(['_trackEvent', '阅读页', '设置主题：更多 风格3-1']); break;
                    case 13: _czc.push(['_trackEvent', '阅读页', '设置主题：更多 风格3-2']); break;
                    case 14: _czc.push(['_trackEvent', '阅读页', '设置主题：更多 风格3-3']); break;
                }

                Reader.SetStyle($(this).children('span'));

                return false;
            });

            //下载app
            $(".gotodownload").click(function () {
                var pagetype = 1;
                if ($(this).hasClass('textbutton')) {
                    _czc.push(['_trackEvent', '阅读页', '下载阅读']);
                    pagetype = 1;
                }
                if ($(this).hasClass('dclient')) {
                    _czc.push(['_trackEvent', '阅读页', '下载客户端，支持更换字体，亮度调节']);
                    pagetype = 2;
                }

                var ua = navigator.userAgent;
                if (ua.indexOf('Android') > -1 || ua.indexOf('Linux') > -1) {
                    Reader.updatedata("android", pagetype);
                    location.href = "http://down.xxsy.net/downapp.asp";
                } else if (ua.indexOf("Mac OS") > -1) {
                    Reader.updatedata("ios", pagetype);
                    location.href = "https://itunes.apple.com/cn/app/xiao-xiang-shu-yuan-xiao-shuo/id719359889?mt=8";
                } else {
                    location.href = "/Page/DownLoad?stat_page=1_download_p7";
                }
            })

            //自动订阅
            $(".autosubcribe > span:eq(0)").click(function () {
                var dis = $(".menuTop").css("display");
                if (dis.toLowerCase() != "none") {
                    $(".menuTop,.menuBottom").hide();
                    return;
                }

                if ($(this).hasClass("iconfont_checkedbox")) {
                    $(this).removeClass("iconfont_checkedbox").addClass("iconfont_checkbox");
                } else {
                    $(this).removeClass("iconfont_checkbox").addClass("iconfont_checkedbox");
                }
            });

            //批量订阅
            $("#moreSet #btnsub").click(function () {
                var _currentId = (Reader._Args.SubChapterId == 0 ? Reader._Args.Chapter.Id : Reader._Args.SubChapterId);
                location.href = "/Page/BatchSub?stat_page=1_batchsub_p1&bookid=" + Reader._Args.BookID + "&chapterid=" + _currentId + "&ischapterlist=" + Reader._Args.IsChapterList;
            });

            // 订阅章节
            $("#divsubscribe").click(function () {

                var dis = $(".bar03").css("display");
                var dis = $(".menuTop").css("display");
                if (dis.toLowerCase() != "none") {
                    $(".menuTop,.menuBottom").hide();
                    return;
                }

                if (Reader._Args.CoinLess == 1) {
                    location.href = "/Page/Recharge?stat_page=1_pay_p2";
                    return;
                }

                if (Reader._Args.IsLoading == 1)
                    return;

                //自动订阅
                var _auto = $(".autosubcribe > span:eq(0)").hasClass("iconfont_checkedbox") ? 1 : 0;

                _isLoading = 1;

                $("#divsubscribe").css("background", "#B9B4B4").html("处理中...");

                ajaxService("/Service/ServiceMethod", "chapter_subscribe", { userid: Reader._Args.UserID, chapterid: Reader._Args.SubChapterId, bookid: Reader._Args.BookID, auto: _auto },
                    function (data, status) {

                        Reader._Args.IsLoading = 0;

                        //成功
                        if (data.Code == 0) {
                            var res = data.Data;
                            var str = "订阅成功";
                            if (res.Mons > 0) str += ",本次订阅获取月票1张";
                            if (res.Assess > 0) str += ",本次订阅获取评价票1张";
                            Reader._Alert(str);

                            setTimeout(
                                function () {
                                    Reader.ResetSubscribeInfo();
                                }, 1500);

                            return;
                        }
                        $("#divsubscribe").css("background", "#ff8834").html("订阅本章");
                        Reader._Alert(data.Message);
                    });
            });

            this._ShowDefault();
        },
        updatedata: function (uatype, _pagetype) {
            var _stat_page = "";
            if (uatype == "android") {
                if (_pagetype == 1) {
                    _stat_page = "1_androidapp_p6"; //阅读页顶部
                } else if (_pagetype == 2) {
                    _stat_page = "1_androidapp_p7"; //阅读页底部
                }
            } else {
                if (_pagetype == 1) {
                    _stat_page = "1_iosapp_p6"; //阅读页顶部
                } else if (_pagetype == 2) {
                    _stat_page = "1_iosapp_p7"; //阅读页底部
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
        },
        // 设置字体
        SetFontSize: function (value) {

            var currSize = parseInt($(".ctx").css("font-size"));
            var msize = parseInt($(".ctx").css("font-size"));
            currSize = currSize + value;
            if (currSize < 14) {
                currSize = 14;
                if (msize <= 14) {
                    Reader._Alert('已是最小字号');
                    return;
                }
            }
            if (currSize > 22) {
                currSize = 22;
                if (msize >= 22) {
                    Reader._Alert('已是最大字号');
                    return;
                }
            }

            Reader._Args.FontSize = currSize;
            Reader._Args.LineHeight = currSize + Reader._Args.LineHeightAdd;
            Reader._Args.ChapterFontSize = currSize + 8;
            Reader._Args.ChapterLineHeight = currSize + 18;
            Reader._SetPagesNew();
            $(".ctx").css({ fontSize: currSize + "px", lineHeight: currSize + Reader._Args.LineHeightAdd + "px" });

            //Reader._Args.Index = 1;
            Reader._ShowPreviousPage();

            Util.CookieWrite("READER_FONTSIZE", currSize, 999);
            Util.CookieWrite("READER_LINEHEIGHT", currSize + Reader._Args.LineHeightAdd, 999);

        },
        // 设置行间距
        SetLineHeight: function (value) {

            //6.28修改
            var currHeightadd = value;
            var currHeight = value + Reader._Args.FontSize;
            Reader._Args.LineHeightAdd = currHeightadd;
            Reader._Args.LineHeight = currHeight;
            Reader._SetPagesNew();

            $(".ctx").css({ lineHeight: currHeight + "px" });

            //Reader._Args.Index = 1;
            Reader._ShowPreviousPage();

            Util.CookieWrite("READER_LINEHEIGHT", currHeight, 999);
            Util.CookieWrite("READER_LINEHEIGHTADD", currHeightadd, 999);
        },
        // 设置模式
        SetMode: function (mode) {

            Util.CookieWrite("READER_MODE", mode, 999);

            if (mode == 1) {
                $(".read-wrapper").css({ color: "#716865", background: "#100A0B" });
                $(".readsubcribe").addClass("colorbbb");
                return;
            }

            var color = "#4d4d4d";
            var bg = "#ecd9ac";
            var dv = 0;

            var styles = Util.CookieValue("READER_STYLE");
            if (styles != "") {
                var arr = styles.split("|");
                color = arr[0];
                bg = arr[1];
                dv = arr[2];
            }

            $(".read-wrapper").css({
                color: color,
                background: bg
            });

            if (dv == 12 || dv == 13 || dv == 14) {
                $(".readsubcribe").addClass("colorbbb");
            } else {
                $(".readsubcribe").removeClass("colorbbb");
            }
        },
        // 设置风格
        SetStyle: function (eventObject) {

            var mode = 0;
            var value = Util.CookieValue("READER_MODE");

            if (value != "") {
                mode = parseInt(value);
            }

            var color = eventObject.css("color");
            var bg = eventObject.css("background");
            var dv = eventObject.attr("data-value");

            Util.CookieWrite("READER_STYLE", color + "|" + bg + "|" + dv, 999);

            $(".read-wrapper").css({ color: color, background: bg });

            if (dv == 12 || dv == 13 || dv == 14) {
                $(".readsubcribe").addClass("colorbbb");
            } else {
                $(".readsubcribe").removeClass("colorbbb");
            }

            Util.CookieWrite("READER_MODE", 0, 999);
            $('#dayornight').addClass('icon-moon moon').removeClass('icon-31qing');
        },

        // 全本特价
        BuySpecial: function () {
            var dis = $(".menuTop").css("display");
            if (dis.toLowerCase() != "none") {
                $(".menuTop,.menuBottom").hide();
                return;
            }

            zbox.show({ src: '/Page/BuySpecialOff?bookid=' + Reader._Args.BookID + '&userid=' + Reader._Args.UserID, hEle: '.cheercontent', width: '80%' }
                    , function () {
                        Reader.ResetSubscribeInfo();
                    });
        },

        // 包月
        BuyMonth: function () {
            var dis = $(".menuTop").css("display");
            if (dis.toLowerCase() != "none") {
                $(".menuTop,.menuBottom").hide();
                return;
            }

            zbox.show({ src: '/Page/BuyMonth?userid=' + Reader._Args.UserID, hEle: '.cheercontent' }
                    , function () {
                        Reader.ResetSubscribeInfo();
                    });

        },

        //重置订阅信息
        ResetSubscribeInfo: function () {
            Reader.HideSubscribeInfo();
            Reader._Args.SubChapterId = 0;
            Reader._Args.IsHis = 0;
            Reader._Args.CID = Reader._Args.Chapter.Id;
            Reader._ShowDefault();
        },

        //隐藏订阅信息
        HideSubscribeInfo: function () {
            $("#forsubscribe").hide();
            $(".readsubcribe").hide();
            $(".special").removeClass("readsubcribe");
            $("#divsubscribe").css("background", "#ff8834").html("订阅本章");
        },

        //功能区域设置
        SetAreaFun: function (obj) {
            obj.addEventListener("click", function (e) {
                if (Reader._Args.IsLoading == 1) {
                    return;
                }
                var ww = Reader._Args.ScreenW;
                var hh = Reader._Args.ScreenH;
                var gx = 1;
                var pX = e.clientX;
                var pY = e.clientY;

                /*
                  |-------------------|
                  |            |      |
                  |            |      |
                  |            |      |
                  |      |-----|      |
                  |      |     |      |
                  |      |-----|      |---
                  |      |            | |
                  |      |            |3/8
                  |      |            | |
                  |-------------------|---
                  |--1/3-|
                */

                var menudis = $(".menuTop").css("display");
                if (menudis.toLowerCase() != "none") { gx = 3; }
                else if (pX <= ww / 3) { gx = 1; }
                else if (pX > ww * 2 / 3) { gx = 2; }
                else if (pY <= hh * 2 / 8 && pX <= ww * 2 / 3) { gx = 1; }
                else if (pY > hh * 6 / 8 && pX > ww * 1 / 3) { gx = 2; }
                else { gx = 3; }

                if (gx == 1) { Reader._ShowPreviousPage(); }
                if (gx == 3) { Reader._ShowMenu(); }
                if (gx == 2) { Reader._ShowNextPage(); }
                if (gx == 1 || gx == 2) {
                    $(".menuTop,.menuBottom").hide();
                    Reader._ShowSetBox($('#chapterset,#menuset'));
                }
                $("#moreSet,.downloaddiv").hide();
            }, false);
        },

        //引导图层
        ShowGuide: function () {
            var htm = [
                '<div id="area">',
                '<div class="mask"></div>',
                '    <div class="areadivide">',
	            '        <div class="areawidth"></div>',
	            '        <div class="areawidth">',
		        '            <div class="middletop"></div>',
		        '            <div class="middle"></div>',
		        '            <div class="middlebottom"></div>',
	            '        </div>',
	            '        <div class="areawidth"></div>',
                '    </div>',
                '    <div class="areatext verticalcenter"><p>上一页</p><p>唤出菜单</p><p>下一页</p></div>',
                '</div>']

            $("body").append(htm.join(""));
            $("#area").click(function () {
                $(this).remove();
            });

            Util.CookieWrite("SHOW_READ_GUIDE", 1, 999);
        }
    };

})();
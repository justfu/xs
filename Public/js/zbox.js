function setIframeHeight(iframe) {
    if (iframe) {
        var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow;
        if (iframeWin.document.body) {

            function setHeight() {
                iframe.height = (iframeWin.document.documentElement.scrollHeight) || (iframeWin.document.body.scrollHeight);
            }

            setHeight();
            setInterval(setHeight, 200);
        }
    }
};

(function () {
    window.zbox = {

        _callback:null,

        _timer: null,

        _setmiddle: function () {
            var $m = $('.zbox-wrapper .zbox-main');
            var x = parseInt(($(window).width() - $m.outerWidth()) * 0.5);
            var y = parseInt(($(window).height() - $m.outerHeight()) * 0.42);
            if (y < 0) y = 0;
            $m.css({ left: x + 'px', top: y + 'px' });
        },

        close: function (complete, returnvalue, callback) {
            $('.zbox-wrapper').remove();
            if (this._timer)
                clearInterval(this._timer);

            if (!complete) return;

            if (typeof callback == 'function') {
                callback();
            } else if (typeof this._callback == 'function') {
                this._callback(returnvalue);
            }            
        },

        show: function (options, closeCallback) {
            this._callback = null;
            options = $.extend({
                src: 'http://m.xxsy.net',
                width: '100%',
                height: 'auto',
                hEle: 'body',
                hOffset: 30,
                isCover: true,
                isCoverClose: false
            }, options);

            this.close();
            if (typeof closeCallback == 'function') this._callback = closeCallback;

            var html = [
                '<div class="zbox-wrapper">',
                '    <div class="zbox-cover"></div>',
                '    <div class="zbox-main" style="width:' + options.width + '">',
                '        <div class="zbox-loader"><span></span></div>',
                '        <iframe width="100%" src="' + options.src + '" frameborder="0" scrolling="no" onload="setIframeHeight(this)"></iframe>',
                '    </div>',
                '</div>'];
            $(html.join('')).appendTo('body');
            var $f = $('.zbox-wrapper iframe'), $m = $('.zbox-wrapper .zbox-main');
            this._setmiddle();

            if (options.isCover) {
                var $cover = $('.zbox-wrapper .zbox-cover');
                var h = $(document).height();
                if (h < $(window).height()) h = $(window).height();
                if (options.isCoverClose)
                    $cover.click(function () { zbox.close(closeCallback); });
                $cover.height(h);
            }

            $f.load(function () {
                var sh = options.height;
                var fn = function () { return $f.contents().find(options.hEle).height() + options.hOffset; };
                if (options.height == 'auto') {
                    setTimeout(function () {
                        zbox._timer = setInterval(
                            function () {
                                var h2 = fn();
                                if (h2 != $m.height()){
                                    //$m.height(h2);
                                    //$f.height(h2);
                                    zbox._setmiddle();
                                }                                
                            }, 200);
                    }, 2);
                    setTimeout(function () {
                        sh = fn();
                        sh += 'px';
                    }, 200);
                }

                setTimeout(function () {
                    //$m.css({ width: options.width, height: sh });
                    //$f.css({ height: sh });
                    zbox._setmiddle();
                    $f.css({ marginLeft: '0px' }).siblings().hide();
                }, 200);

            });
        },
    };
})(window);
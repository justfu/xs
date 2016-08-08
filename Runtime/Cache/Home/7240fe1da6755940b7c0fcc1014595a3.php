<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php echo ($bookDetail['book_name']); ?>章节目录,免费读书网,<?php echo ($bookDetail['book_name']); ?>手机触屏版</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta name="description" content="<?php echo ($bookDetail['book_name']); ?>章节目录,免费阅读网,<?php echo ($bookDetail['book_name']); ?>手机触屏版" />
    <meta name="keywords" content="<?php echo ($bookDetail['book_name']); ?>章节目录,免费阅读网,<?php echo ($bookDetail['book_name']); ?>手机触屏版" />
    <link href="<?php echo (CSS_URL); ?>mcommon_2.css" rel="stylesheet" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="format-detection" content="email=no" />
    <meta name="format-detection" content="adress=no" />
    <script src="<?php echo (JS_URL); ?>jquery.min.js"></script>
    <link href="<?php echo (CSS_URL); ?>css2_2.css" rel="stylesheet" />
    <link href="<?php echo (CSS_URL); ?>login.css" rel="stylesheet" />
    <link href="<?php echo (CSS_URL); ?>global.css" rel="stylesheet" />
    <link href="<?php echo (CSS_URL); ?>zbox_2.css" rel="stylesheet" />
    <link href="<?php echo (CSS_URL); ?>style.css" rel="stylesheet" />
    <script>
        function __fn() {
            var tempW = 750;
            var size = parseInt($(window).width() * 100 / tempW);
            var html = $('html').eq(0);
            $(html).css({ fontSize: size + 'px' });
        }

        __fn();
        window.onresize = function () { __fn(); }
    </script>
</head>
<body>
<div id="readbookcon" class="content">
    <div class="login_top">
        <div class="return"></div>
        <div class="menutitle"><?php echo ($bookDetail['book_name']); ?></div>
    </div>
    <script>
        $().ready(function(){
              $('.return').bind('click',function(){
                   location.href='/xs/index.php/Home/Book/detail?bookId='+<?php echo ($bookId); ?>;
              });
        });
    </script>
    <div class="m10">
        <div class="tabcss2 t2">
            <ul>
                <li class='curr3' style="width: 100%" data-value="0">目录</li>
            </ul>
        </div>
    </div>
    <div style="height: 8px;"></div>

    <div class="m2" id="chapter" style='display:'>



        <div class="listNotice">
            <div class="chapterTit clearfix">
                <span class="chapterLeft">共<?php echo ($allCounts); ?>章节</span>
                <span class="chapterRight" id="sort" data-value="1">↑倒序排列</span>
            </div>
            <div id="chapterlist">
                <?php if(is_array($chapterData)): foreach($chapterData as $key=>$v): ?><a href="">
                    <div class='chapterList clearfix '>
                        <span class="listLeft"><?php echo ($v["title"]); ?></span>
                        <span class="listRight free">免费</span>
                    </div>
                </a><?php endforeach; endif; ?>
            </div>
        </div>
        <div class="paging" id="selpageindex">
            <ul>
                <li data-value="1" style="font-size: 12px"><a href="
                <?php if($nowpage-10 > 0): ?>/xs/index.php/Home/Book/chapter?bookId=<?php echo ($bookId); ?>&page=<?php echo ($nowpage-10); ?>
                   <?php else: ?>#<?php endif; ?>
                        "><<</a> </li>
                <li data-value="2" style="font-size: 12px"><a href="
                <?php if($nowpage-1 > 0): ?>/xs/index.php/Home/Book/chapter?bookId=<?php echo ($bookId); ?>&page=<?php echo ($nowpage-1); ?>
                    <?php else: ?>#<?php endif; ?>
                    "><</a></li>
                <li>
                    <select id="selPage">
                        <?php $__FOR_START_8426__=0;$__FOR_END_8426__=$pageCount;for($i=$__FOR_START_8426__;$i < $__FOR_END_8426__;$i+=1){ ?><option value="<?php echo ($i+1); ?>" <?php if($nowpage == $i+1): ?>selected<?php endif; ?> >第<?php echo ($i+1); ?>/ <?php echo ($pageCount); ?>页</option><?php } ?>
                    </select>
                    <script>
                        $('#selPage').change(function(){
                            location.href='/xs/index.php/Home/Book/chapter?bookId=<?php echo ($bookId); ?>&page='+$(this).val();
                        });
                    </script>
                </li>
                <li data-value="3" style="font-size: 12px"><a href="
                <?php if($nowpage < $pageCount): ?>/xs/index.php/Home/Book/chapter?bookId=<?php echo ($bookId); ?>&page=<?php echo ($nowpage+1); ?>
                    <?php else: ?>#<?php endif; ?>
                    ">></a></li>
                <li data-value="4" style="font-size: 12px"><a href="
                <?php if($nowpage+10 < $pageCount): ?>/xs/index.php/Home/Book/chapter?bookId=<?php echo ($bookId); ?>&page=<?php echo ($nowpage+10); ?>
                    <?php else: ?>#<?php endif; ?>
                    ">>></a></li>
            </ul>
        </div>
    </div>


</div>

<div class="login_bottom">
    <p><a href="http://www.ilhong.cn" target="_parent">所有数据均来自互联网,如有侵权,联系QQ处理.谢谢</a>
    <p>免费读书网</p>
    <p>QQ：1034996580</p>
</div>


</body>
</html>
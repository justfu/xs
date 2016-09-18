<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <script type="text/javascript" src="<?php echo (JS_URL); ?>jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo (CSS_URL); ?>read.css">
    <link rel="stylesheet" type="text/css" href="<?php echo (CSS_URL); ?>app.css">
    <link rel="stylesheet" type="text/css" href="<?php echo (CSS_URL); ?>loading.css">
    <!--<link href="//cdn.bootcss.com/bootstrap/4.0.0-alpha.3/css/bootstrap.css" rel="stylesheet">-->
    <title><?php echo ($detail['book_name']); ?></title>
</head>
<body>
     <div id="title" style="font-size: 30px"></div>
     <div style="width: 100%;" id="content">
         <!--<div style='z-index:2000;text-align: center'><img width='150px' src='<?php echo (IMG_URL); ?>refresh.gif' /></div>-->
         <div class="spinner">
             <div class="double-bounce1"></div>
             <div class="double-bounce2"></div>
         </div>
     </div>
    <div id="nextChapter">
        <ul>
            <li id="prev">上一章</li>
            <li id="next">下一章</li>
        </ul>
    </div>
<div id="tools1">
    <div id="list" style="display: none">
    <ul>
         <li id="back">首页</li>
         <li id="category">目录</li>
         <li id="save">收藏</li>
        <?php $username=session('username');echo empty($username)?("<li id='login'>登陆"):("<li id='login' tag='1'>".$username); ?></li>
         <li id="aa">A+</li>
         <li id="ab">A-</li>
         <li id="black">夜间模式</li>
         <li id="logout" style="display: none">退出</li>
     </ul>
    </div>
    <div id="tools">

    </div>
</div>
<div class="loginbox" style="display: none">
    <div class="login_box_title"><span style="position:absolute;left: 47px;top:10px;font-size: 20px;">登陆到免费阅读网</span><span id="box_hide" class="box_hide" style="float: right;margin-right: 10px;margin-top: 9px">X</span></div>
    <div class="login_box_body">
            <div class="login_user"><input id="tel" maxlength="11" type="text" name="tel" placeholder="请输入用户名或手机号"/></div>
            <div class="login_pwd"><input id="password" maxlength="16" type="password" name="password" placeholder="请输入密码"/></div>
            <!--<div class="check_code"><input id="checkcode" maxlength="4" type="text" name="checkcode" placeholder="将右边的二进制转换成十进制"/><img id="checkimg" src="./common/getCheckCode.php" alt="单击可更换验证码" onclick="this.src='./common/getCheckCode.php?a='+Math.random()" /></div>-->
            <span style="color: red;margin-left: 33px;font-size: 15px;display: block" id="notice"></span>
        <button class="login_button">登陆</button>
        <span style="float: right;font-size: 13px;margin-top: 3px;margin-right: 5px;">没有账号 点击<em style="color: blue" id="signup">注册</em></span>
            <!--<div class="more">-->
                <!--<div style="margin-top: 12px;margin-left: 5px">快捷登陆　　　　　　　　　　　<span>没有账号？点击立即注册</span></div>-->
                <!--<hr/>-->
                <!--<div style="position: relative;bottom: -5px;">-->
                    <!--<img src="./img/qq.png" width="30px" height="30px" />-->
                    <!--<img src="./img/weibo1.png" width="30px" height="30px"/>-->
                <!--</div>-->
            <!--</div>-->
    </div>
</div>
</body>
</html>
<script>
    window.savebookId=0;
    window.savechapterId=0;
    var q=0;
    $().ready(function(){
        //初始化
        var refresh='<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>';
        var tag=$('#login').attr('tag');
        if(tag==1){
            $('#logout').show();
        }else{
            $('#logout').hide();
        }
        getChapterData(<?php echo ($detail['id']); ?>,<?php echo ((isset($chapterId) && ($chapterId !== ""))?($chapterId):0); ?>);
        function getChapterData(bookId,cid){
            savebookId=bookId;
            savechapterId=cid;
            $.ajax({
                type:'post',
                data:'bookId='+bookId+'&chapterId='+cid,
                dataType:'json',
                url:'/Home/Book/getChapterData.html',
                success:function(msg){
                    var data=msg;
                    $('#title').html(data.title);
                    $('#content').html(data.content);
                    next=data.nextChapterId;
                    pre=data.preChapterId;
                    if(data.code==404){
                        $('#next').html('尾页');
                        $('#next').bind('click',function(){
                            location.href='/Home/Book/detail.html?bookId='+bookId;
                        });
                    }else if(data.code==403){
                        $('#prev').html('首页');
                        $('#prev').bind('click',function(){
                            location.href='/Home/Book/detail.html?bookId='+bookId;
                        });
                    }
                    window.scrollTo(0,0);
                }
            });
        }
        $('#next').bind('click',function(){
            $('#content').html(refresh);
           getChapterData(<?php echo ($detail['id']); ?>,next);
        });
        $('#prev').bind('click',function(){
            getChapterData(<?php echo ($detail['id']); ?>,pre);
        });
        $('#tools').bind('click',function(){
            if($('#list').css('display')=='none'){
                $('#list').slideDown(500);
            }else{
                $('#list').slideUp(500);
            }
        });
        $('#back').bind('click',function(){
             location.href='/Home/Index/index.html';
        });
        $('#category').bind('click',function(){
            location.href='/Home/Book/chapter.html?bookId=<?php echo ($detail['id']); ?>';
        })
        $('#aa').bind('click',function(){
            var fontsize=$('#content').css('fontSize');
            fontsize=parseInt(fontsize.substring(0,2));
             $('#content').css('fontSize',fontsize+8+'px');
        });
        $('#ab').bind('click',function(){
            var fontsize=$('#content').css('fontSize');
            fontsize=parseInt(fontsize.substring(0,2));
            $('#content').css('fontSize',fontsize-8+'px');
        });
        $('#black').bind('click',function(){
            if($('body').css('color')=='rgb(77, 77, 77)'){
                $('body').css('backgroundColor','black');
                $('body').css('color','rgb(113, 104, 101)');
                $(this).css('backgroundColor','black');
                $(this).css('color','white');
//                $('#title').css('color','gold');
            }else{
                $('body').css('backgroundColor','#ECD9AC');
                $('body').css('color','rgb(77, 77, 77)');
                $(this).css('backgroundColor','white');
                $(this).css('color','rgb(77, 77, 77)');
//                $('#title').css('color','black');
            }
        });
        $('#save').bind('click',function(){
                $.ajax({
                    type:'post',
                    dataType:'json',
                    url:'/Home/User/checkIsLogin.html',
                    success:function(msg){
                        if(msg.code==200){
                            $.ajax({
                                type:'post',
                                data:'bookId='+savebookId+'&chapterId='+savechapterId,
                                dataType:'json',
                                url:'/Home/Book/saveReading.html',
                                success:function(msg){
                                    if(msg.code==200){
                                        alert('收藏成功');
                                    }else{
                                        alert(msg.msg);
                                    }
                                }
                            })
                        }else{
                            alert('请先登录后在收藏');
                            $('#notice').html('');
                            $('.loginbox').slideDown(500);
                        }
                    }
                })

        });
        $('#box_hide').bind('click',function(){
                $('.loginbox').slideUp(500);
        });
        $('#login').bind('click',function(){
            var tag=$('#login').attr('tag');
            if(tag!=1) {
                $('#notice').html('');
                $('.loginbox').slideDown(500);
            }else{
                $('.logout').show();
                alert('您已登陆!');
            }
        });
        $('#list').bind('click',function(){
            $(this).slideUp(500);
        });
        $('.login_button').bind('click',function(){
            var username=$('#tel').val();
            var password=$('#password').val();
            if(!checkUserInfo(username,password)){
                return false;
            }
            $.ajax({
                type:'post',
                data:'username='+username+'&password='+password,
                dataType:'json',
                url:'/Home/User/login.html',
                success:function(msg){
                    if(msg.code==300){
                        $('#notice').html('账号名错误');
                    }else if(msg.code==400){
                        $('#notice').html('密码错误');
                    }else{
                        $('#login').html(msg.data.username);
                        $('.loginbox').slideUp(500);
                        $('.login').unbind();
                        $('#logout').show();
                        alert('登陆成功!');
                    }
                }
            });
        });
    function checkUserInfo(username,password){
         if(username==''){
              $('#notice').html('账号名为空');
             return false;
         }else if(password==''){
              $('#notice').html('密码为空');
             return false;
         }else{
             return true;
         }
    }
    $('#logout').bind('click',function(){
        $.ajax({
            type:'post',
            dataType:'json',
            url:'/Home/User/logout.html',
            success:function(msg) {
                if (msg.code == 300) {
                    alert('退出失败');
                } else if (msg.code == 200) {
                    $('#login').html('登陆');
                    alert('退出成功');
                    $('#logout').hide();
                }
            }
        });
    });
    });
</script>
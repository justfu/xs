<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>免费阅读网登录</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <script type="text/javascript" src="<?php echo (JS_URL); ?>jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo (JS_URL); ?>jquery.rotate.js"></script>
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>pageLogin.css" />

</head>
<body>
    <h1 align="center" class="title" style="font-family: 'Trebuchet MS', sans-serif;">登录到 <a href="/Home/Index/index.html" style="color: #00AEEF;text-decoration: none" id="logo">Read-Read</a></h1>
    <div class="logo"><img id="default" src="<?php echo (IMG_URL); ?>defaultImage.png" width="90px" style="border-radius: 45px;"></div>
    <form method="post" id="loginform" action="/Home/User/loginAction.html?l=<?php echo ((isset($type) && ($type !== ""))?($type):'detail'); ?>&bookId=<?php echo ($bookId); ?>">
    <div class="login" style="background: none">
        <input type="text" name="tel" class="tel" placeholder="请输入用户名或邮箱号">
        <input type="password" name="password"  class="password" placeholder="请输入密码"/>
        <div class="submit" onclick="">登录</div>
        <span class="register"><a href="/Home/User/register.html"> 没有账号 点此处注册</a></span>
    </div>
    </form>
</body>
</html>
<script type="text/javascript">
    $().ready(function(){
        $('#logo').rotate();
        $('.tel').bind('blur',function(){
            var username=$(this).val();
            $.ajax({
                type:'post',
                url:'/Home/User/getUserLogo.html',
                data:'username='+username,
                success:function(msg){
                    if(msg.code!=404) {
                        $('#default').hide();
                        $('#logo1').remove();
                        $('#default').attr('src','<?php echo (IMG_URL); ?>defaultImage.png');
                        if (msg.code == 200) {
                            $('#default').hide();
                            console.log(msg);
                            var div= $('<div></div>');
                            div.attr('id','logo1');
                            div.css({
                                'width':'90px',
                                'height':'90px',
                                'backgroundColor':'rgb('+Math.random()*255+','+Math.random()*255+','+Math.random()*255+')',
                                'position': 'relative',
                                'left': '50%',
                                'marginLeft': '-45px',
                                'height': '90px',
                                'borderRadius': '45px',
                                'textAlign': 'center',
                                'lineHeight': '90px',
                                'backgroundColor':'rgb('+ parseInt(Math.random()*254) +','+ parseInt(Math.random()*254) +','+ parseInt(Math.random()*254) +')',
                                'fontSize':'25px',
                                'color':'white'
                            });
                            div.html(msg.data.data);
                            $('.logo').append(div);
                        } else {
                            $('#default').attr('src', msg.data.data);
                            $('#default').show();
                        }
                    }else{
                        $('#default').attr('src','<?php echo (IMG_URL); ?>defaultImage.png');
                        $('#logo1').remove();
                        $('#default').show();
                    }
                }
            });
        });
        function checkLogin(){
            var tel=$('.tel').val();
            var password=$('.password').val();
            if(tel==""){
                alert('请填写用户名');
                return false;
            }else if(password==""){
                alert('请填写密码');
                return false;
            }else{
                return true;
            }
        }
        $('.submit').bind('click',function(){
                if(checkLogin()){
                    document.getElementById('loginform').submit();
                }
        });
    });
</script>
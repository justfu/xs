<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>免费阅读网登录</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <script type="text/javascript" src="<?php echo (JS_URL); ?>jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>pageLogin.css" />

</head>
<body>
<h1 align="center" class="title" style="font-family: 'Trebuchet MS', sans-serif;">注册 Read-Read 账号</h1>
<form method="post" id="loginform" action="/Home/User/registerAction">
    <div class="login">
        <input type="text" name="username" id="username" class="tel" maxlength="6" placeholder="请输入用户名">
        <input type="text" name="email" class="tel" id="email" placeholder="请输入邮箱号">
        <input type="text" name="tel" class="tel" id="tel" placeholder="请输入手机号">
        <input type="password" name="password" class="tel" id="password" placeholder="请输入密码">
        <input type="password" name="password1"  class="password" id="password1" placeholder="请再次输入密码"/>
        <div class="submit" onclick="">注册</div>
        <span class="register"><a href="/Home/User/pageLogin.html"> 已有账号 点此处登录</a></span>
    </div>
</form>
</body>
</html>
<script type="text/javascript">
    $().ready(function(){
        function checkLogin(){
            var tel=$('#tel').val();
            var username=$('#username').val();
            var email=$('#email').val();
            var password=$('#password').val();
            var password1=$('#password1').val();
            var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(username==""){
                alert('请填写用户名');
                return false;
            }else if(email==""){
                alert('请填写邮箱');
                return false;
            }else if(tel==""){
                alert('请填写手机号');
                return false;
            }else if(password==""){
                alert('请填写密码');
                return false;
            }else if(password1==""){
                alert('请填写确认密码');
                return false;
            }else if(password!==password1){
                alert('两次输入密码不匹配,请重新输入!!!');
                return false;
            }else if(username.length>6){
                alert('用户名超出长度!!');
                return false;
            }else if(!filter.test(email)){
                alert('邮箱格式不正确!');
                return false;
            } else{
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